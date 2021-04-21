<?php

namespace Reports\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use User\Entity\User;
use Projects\Entity\Projects;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Masters\Entity\LeadSource;

class ReportsController extends AbstractActionController
{
    private $authService;
    private $entityManager;
    private $queryBuilder;
    private $logManager;
    private $LMSUtilities;
    private $logger;

    public function __construct($authService, $entityManager, $logManager, $LMSUtilities, $logger)
    {
        $this->authService = $authService;
        $this->entityManager = $entityManager;
        $this->logManager = $logManager;
        $this->LMSUtilities = $LMSUtilities;
        $this->logger = $logger;
    }

    public function init()
    {
        if ($user = $this->identity()) {
        } else {
            return $this->redirect()->toRoute('login');
        }
    }

    public function indexAction()
    {
        $projects = $this->entityManager->getRepository(Projects::class)->findAll();
        $users = $this->entityManager->getRepository(User::class)->findAll();

        return new ViewModel(['users'=>$users,'projects'=>$projects]);
    }

    public function projectreportAction()
    {
		$this->layout()->setTemplate('layout/blank');
        $request = $this->getRequest();
        if ($request->isPost()) {
            $post = $request->getPost()->toArray();

            $id = (!empty($post['project'])?$post['project']:-1);
            $dates = explode(" - ", $post['daterange']);


            $startdate = $this->LMSUtilities->makeDBDate($dates[0]);
            $enddate = $this->LMSUtilities->makeDBDate($dates[1]);


            $project_query = $this->entityManager->createQueryBuilder()->select('p')
        ->from('Projects\Entity\Projects', 'p')
        ->where('p.status = :status')
        ->setParameter('status', 1);

            if (!empty($post['project'])) {
                $project_query->andWhere('p.id = :project')->setParameter('project', $id);
            }

            $projects = $project_query->getQuery()->getResult();

            $sources = [];
            $sitevisit = [];
            $enquiry = [];

            foreach ($projects as $source) {
                $sources[] = $source->getName();

                $query = $this->entityManager->createQueryBuilder()->select('l')
          ->from('Leads\Entity\Leads', 'l')
          ->where('l.dateCreated between :startdate and :enddate')
          ->setParameter('startdate', $startdate)
          ->setParameter('enddate', $enddate)
          ->andWhere('l.project = :project')->setParameter('project', $source->getId());

                $lead = $query->getQuery()->getResult();
                $enquiry[] = count($lead);

                $query2 = $this->entityManager->createQueryBuilder()->select('l')
          ->from('Leads\Entity\Leads', 'l')
          ->where('l.dateCreated between :startdate and :enddate')
          ->andWhere('l.visited = 1')
          ->setParameter('startdate', $startdate)
          ->setParameter('enddate', $enddate)
          ->andWhere('l.project = :project')->setParameter('project', $source->getId());

                $sitevisits = $query2->getQuery()->getResult();

                $sitevisit[] = count($sitevisits);
            }

            $array = ['sources'=>$sources,'enquiry'=>$enquiry,'sitevisit'=>$sitevisit];

            $spreadsheet = new Spreadsheet();

            $spreadsheet->getProperties()->setCreator('PlinthstoneLMS')->setLastModifiedBy('PlinthstoneLMS')->setTitle('PlinthstoneLMS Leads')->setSubject('PlinthstoneLMS Leads')->setDescription('PlinthstoneLMS Leads')->setKeywords('PlinthstoneLMS Leads')->setCategory('PlinthstoneLMS Leads');

            $spreadsheet->setActiveSheetIndex(0)
    ->setCellValue('A1', 'Projects')
    ->setCellValue('B1', 'Enquiries')
    ->setCellValue('C1', 'Sitevisits');

            $n = 1;

            $count = count($array['sources']);

            for ($i=0;$i<$count;$i++) {
                $spreadsheet->setActiveSheetIndex(0)
      ->setCellValue('A' . (string)($n + 1), $array['sources'][$i])
      ->setCellValue('B' . (string)($n + 1), $array['enquiry'][$i])
      ->setCellValue('C' . (string)($n + 1), $array['sitevisit'][$i]);
                $n++;
            }

            // Rename worksheet
            $spreadsheet->getActiveSheet()->setTitle('Project Wise Report');
            $spreadsheet->setActiveSheetIndex(0);

            // Redirect output to a clientâ€™s web browser (Xlsx)
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="PlinthstoneLMS_ProjectsReport.xlsx"');
            header('Cache-Control: max-age=0');
            header('Cache-Control: max-age=1');
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
    header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    header('Pragma: public'); // HTTP/1.0
    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save('php://output');
        }
    }


    public function followupreportAction()
    {
		$this->layout()->setTemplate('layout/blank');
        $request = $this->getRequest();
        if ($request->isPost()) {
            $post = $request->getPost()->toArray();

            $dates = explode(" - ", $post['daterange']);

            $startdate = $this->LMSUtilities->makeDBDate($dates[0]);
            $enddate = $this->LMSUtilities->makeDBDate($dates[1]);

            $result = $this->entityManager->createQueryBuilder();

            $query = $result->select('l,f,p,ls,lt,t')
                ->from('Leads\Entity\Leads', 'l')
                ->join('Followups\Entity\Followups', 'f', 'WITH', 'f.leadId = l.id')
          ->join('Projects\Entity\Projects', 'p', 'WITH', 'p.id = l.project')
          ->join('Masters\Entity\LeadSource', 'ls', 'WITH', 'ls.id = l.source')
          ->join('Masters\Entity\LeadStatus', 'lt', 'WITH', 'lt.id = l.status')
          ->join('Masters\Entity\FollowupTypes', 't', 'WITH', 't.id = f.followupType')
          ->where('l.interested = :interested')
          ->andWhere('l.dateCreated between :startdate and :enddate')
          ->setParameter('startdate', $startdate)
          ->setParameter('enddate', $enddate)
          ->setParameter('interested', 1);

            if (!empty($post['project'])) {
                $query->andWhere('l.project = :project')->setParameter('project', $post['project']);
            }

            $leadstofollow = $query->getQuery()->getScalarResult();

            $spreadsheet = new Spreadsheet();

            $spreadsheet->getProperties()->setCreator('PlinthstoneLMS')->setLastModifiedBy('PlinthstoneLMS')->setTitle('PlinthstoneLMS Leads')->setSubject('PlinthstoneLMS Leads')->setDescription('PlinthstoneLMS Leads')->setKeywords('PlinthstoneLMS Leads')->setCategory('PlinthstoneLMS Leads');

            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'ID')
            ->setCellValue('B1', 'First Name')
            ->setCellValue('C1', 'Last Name')
            ->setCellValue('D1', 'Mobile No.')
            ->setCellValue('E1', 'Email')
            ->setCellValue('F1', 'Project')
            ->setCellValue('H1', 'Status')
            ->setCellValue('J1', 'Source')
            ->setCellValue('L1', 'Followup Type')
            ->setCellValue('M1', 'Follow Date')
            ->setCellValue('N1', 'Action Date')
            ->setCellValue('Q1', 'Date Created');
            $n = 1;
            foreach ($leadstofollow as $lead) {
                $spreadsheet->setActiveSheetIndex(0)
              ->setCellValue('A' . (string)($n + 1), $lead['l_id'])
              ->setCellValue('B' . (string)($n + 1), $lead['l_firstName'])
              ->setCellValue('C' . (string)($n + 1), $lead['l_lastName'])
              ->setCellValue('D' . (string)($n + 1), $lead['l_contact'])
              ->setCellValue('E' . (string)($n + 1), $lead['l_email'])
              ->setCellValue('F' . (string)($n + 1), $lead['p_name'])
              ->setCellValue('G' . (string)($n + 1), $lead['b_name'])
              ->setCellValue('I' . (string)($n + 1), $lead['ls_name'])
              ->setCellValue('J' . (string)($n + 1), $lead['lt_name'])
              ->setCellValue('L' . (string)($n + 1), $lead['t_name'])
              ->setCellValue('N' . (string)($n + 1), $lead['f_followDate'])
              ->setCellValue('Q' . (string)($n + 1), $lead['l_dateCreated']);
                $n++;
            }

            // Rename worksheet
            $spreadsheet->getActiveSheet()->setTitle('Followups Report');
            $spreadsheet->setActiveSheetIndex(0);

            // Redirect output to a clientâ€™s web browser (Xlsx)
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="PlinthstoneLMS_FollowupsReport.xlsx"');
            header('Cache-Control: max-age=0');
            header('Cache-Control: max-age=1');
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
            header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
            header('Pragma: public'); // HTTP/1.0
            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save('php://output');
        }
    }

    public function leadsreportAction()
    {
		$this->layout()->setTemplate('layout/blank');
        $request = $this->getRequest();
        if ($request->isPost()) {
            $post = $request->getPost()->toArray();
            $search_array = [];
            if ($request->isPost()) {
                (empty($post['project']) ? '' : $project = $post['project']);
            }

            $dates = explode(" - ", $post['daterange']);
            $startdate = $this->LMSUtilities->makeDBDate($dates[0]);
            $enddate = $this->LMSUtilities->makeDBDate($dates[1]);

            $result = $this->entityManager->createQueryBuilder();
            $query = $result->select('l')
            ->from('Leads\Entity\Leads', 'l')
            ->where('l.dateCreated between :startdate and :enddate')
            ->setParameter('startdate', $startdate)
            ->setParameter('enddate', $enddate);

            if (!empty($post['project'])) {
                $query->andWhere('l.project = :project')->setParameter('project', $post['project']);
            }

            $leads= $query->getQuery()->getResult();

            $spreadsheet = new Spreadsheet();

            $spreadsheet->getProperties()->setCreator('PlinthstoneLMS')->setLastModifiedBy('PlinthstoneLMS')->setTitle('PlinthstoneLMS Leads')->setSubject('PlinthstoneLMS Leads')->setDescription('PlinthstoneLMS Leads')->setKeywords('PlinthstoneLMS Leads')->setCategory('PlinthstoneLMS Leads');

            $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'First Name')->setCellValue('B1', 'Last Name')->setCellValue('C1', 'Contact.')->setCellValue('D1', 'Email')->setCellValue('E1', 'Project')->setCellValue('F1', 'Campaign')->setCellValue('G1', 'Status')->setCellValue('H1', 'Preferred Location')->setCellValue('I1', 'Source');
            $n = 1;
            foreach ($leads as $l) {
                $spreadsheet->setActiveSheetIndex(0)
          ->setCellValue('A' . (string)($n + 1), $l->getFirstName())
          ->setCellValue('B' . (string)($n + 1), $l->getLastName())
          ->setCellValue('C' . (string)($n + 1), $l->getContact())
          ->setCellValue('D' . (string)($n + 1), $l->getEmail())
          ->setCellValue('E' . (string)($n + 1), $this->LMSUtilities->getProjectName($l->getProject()))
          ->setCellValue('F' . (string)($n + 1), $this->LMSUtilities->getCampaign($l->getCampaign()))
          ->setCellValue('G' . (string)($n + 1), $this->LMSUtilities->getLeadStatus($l->getStatus()))
          ->setCellValue('H' . (string)($n + 1), $this->LMSUtilities->getLocation($l->getLocation()))
          ->setCellValue('I' . (string)($n + 1), $this->LMSUtilities->getLeadSource($l->getSource()));
                $n++;
            }

            // Rename worksheet
            $spreadsheet->getActiveSheet()->setTitle('Leads Report');
            $spreadsheet->setActiveSheetIndex(0);

            // Redirect output to a clientâ€™s web browser (Xlsx)
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="PlinthstoneLMS_LeadsReport.xlsx"');
            header('Cache-Control: max-age=0');
            header('Cache-Control: max-age=1');
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save('php://output');
        }
    }
    
    

    public function sourcereportAction()
    {
		$this->layout()->setTemplate('layout/blank');
        $lead_source = $this->entityManager->getRepository(LeadSource::class)
         ->findBy([]);
         
        $sources = [];
        $sitevisits = [];
        $enquiry = [];
         
        $request = $this->getRequest();
    
        foreach ($lead_source as $source) {
            $sources[] = $source->getName();
        
            if ($request->isPost()) {
                $post = $request->getPost()->toArray();
                $dates = explode(" - ", $post['daterange']);
            
                $startdate = $this->LMSUtilities->makeDBDate($dates[0]);
                $enddate = $this->LMSUtilities->makeDBDate($dates[1]);
            
                $query = $this->entityManager->createQueryBuilder()->select('l')
                  ->from('Leads\Entity\Leads', 'l')
                  ->where('l.dateCreated between :startdate and :enddate')
                  ->setParameter('startdate', $startdate)
                  ->setParameter('enddate', $enddate)
                  ->andWhere('l.source = :source')->setParameter(':source', $source->getId());
                
                if (!empty($post['project'])) {
                    $query->andWhere('l.project = :project')->setParameter('project', $post['project']);
                }
                  
                $lead = $query->getQuery()->getResult();
                $enquiry[] = count($lead);
              
                $query2 = $this->entityManager->createQueryBuilder()->select('l')
                  ->from('Leads\Entity\Leads', 'l')
                  ->where('l.dateCreated between :startdate and :enddate')
                  ->setParameter('startdate', $startdate)
                  ->setParameter('enddate', $enddate)
                  ->andWhere('l.visited = :visited')->setParameter('visited', 1)
                  ->andWhere('l.source = :source')->setParameter(':source', $source->getId());
                
                if (!empty($post['project'])) {
                    $query2->andWhere('l.project = :project')->setParameter('project', $post['project']);
                }
                  
                $sitevisits = $query2->getQuery()->getResult();
                $sitevisit[] = count($sitevisits);
            }
        }
        

        $array = ['sources'=>$sources,'enquiry'=>$enquiry,'sitevisit'=>$sitevisit];

        $spreadsheet = new Spreadsheet();

        $spreadsheet->getProperties()->setCreator('PlinthstoneLMS')->setLastModifiedBy('PlinthstoneLMS')->setTitle('PlinthstoneLMS Leads')->setSubject('PlinthstoneLMS Leads')->setDescription('PlinthstoneLMS Leads')->setKeywords('PlinthstoneLMS Leads')->setCategory('PlinthstoneLMS Leads');

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'Lead Source')->setCellValue('B1', 'Leads')->setCellValue('C1', 'Sitevisits');
        
        $n = 1;
        for ($i =0; $i < count($sources); $i++) {
            ;
            $spreadsheet->setActiveSheetIndex(0)
          ->setCellValue('A' . (string)($n + 1), $array['sources'][$i])
          ->setCellValue('B' . (string)($n + 1), $array['enquiry'][$i])
          ->setCellValue('C' . (string)($n + 1), $array['sitevisit'][$i]);
            $n++;
        }

        // Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('Source Wise Report');
        $spreadsheet->setActiveSheetIndex(0);

        // Redirect output to a clientâ€™s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="PlinthstoneLMS_LeadSourceReport.xlsx"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        //return new JsonModel($array);
    }


    public function campaignreportAction()
    {
		$this->layout()->setTemplate('layout/blank');
        $result = $this->entityManager->createQueryBuilder();

        $query = $result->select('c')
                    ->from('Campaigns\Entity\Campaigns', 'c');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $post = $request->getPost()->toArray();
                
            if (!empty($post['campaign'])) {
                $query->andWhere('c.id = :campaign')->setParameter('campaign', $post['campaign']);
            }
        }
            
        $campaign_details = $query->getQuery()->getResult();
            
        $spreadsheet = new Spreadsheet();

        $spreadsheet->getProperties()->setCreator('PlinthstoneLMS')->setLastModifiedBy('PlinthstoneLMS')->setTitle('PlinthstoneLMS Leads')->setSubject('PlinthstoneLMS Leads')->setDescription('PlinthstoneLMS Leads')->setKeywords('PlinthstoneLMS Leads')->setCategory('PlinthstoneLMS Leads');

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'ID')
            ->setCellValue('B1', 'Campaign Name')
            ->setCellValue('C1', 'Status')
            ->setCellValue('D1', 'Type')
            ->setCellValue('E1', 'Project')
            ->setCellValue('F1', 'From Date')
            ->setCellValue('G1', 'To Date')
            ->setCellValue('H1', 'Total Budget')
            ->setCellValue('I1', 'Total Spent')
            ->setCellValue('J1', 'No. of Enquiries')
            ->setCellValue('K1', 'Cost Per Enquiry')
            ->setCellValue('L1', 'Sitevisits');
            
        $n = 1;
        foreach ($campaign_details as $details) {
            $enquiries = $this->LMSUtilities->getCampaignLeads($details->getId());
                
            $cost_per_lead = (($enquiries >= 1)? $details->getTotalSpent() / $enquiries :'');
                
            $spreadsheet->setActiveSheetIndex(0)
              ->setCellValue('A' . (string)($n + 1), $details->getId())
              ->setCellValue('B' . (string)($n + 1), $details->getCampaignName())
              ->setCellValue('C' . (string)($n + 1), (($details->getStatus()==0)?'InActive':'Active'))
              ->setCellValue('D' . (string)($n + 1), (($details->getCampaignType()==0)?'Corporate Level':'Specific Project'))
              ->setCellValue('E' . (string)($n + 1), $this->LMSUtilities->getCampaignProjects($details->getId()))
              ->setCellValue('F' . (string)($n + 1), $details->getFromDate())
              ->setCellValue('G' . (string)($n + 1), $details->getToDate())
              ->setCellValue('H' . (string)($n + 1), $details->getTotalBudget())
              ->setCellValue('I' . (string)($n + 1), $details->getTotalSpent())
              ->setCellValue('J' . (string)($n + 1), $enquiries)
              ->setCellValue('K' . (string)($n + 1), round($cost_per_lead))
              ->setCellValue('L' . (string)($n + 1), $this->LMSUtilities->getCampaignSitevisits($details->getId()));
            $n++;
        }

        // Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('Campaign Report');
        $spreadsheet->setActiveSheetIndex(0);

        // Redirect output to a clientâ€™s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="PlinthstoneLMS_CampaignReport.xlsx"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
            header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
            header('Pragma: public'); // HTTP/1.0
            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        //return new JsonModel($array);
    }
}
