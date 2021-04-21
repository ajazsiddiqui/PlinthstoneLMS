<?php
namespace Leads\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Leads\Form\LeadsForm;
use Leads\Entity\Leads;
use Projects\Entity\Projects;
use User\Entity\User;
use Campaigns\Entity\Campaigns;
use Masters\Entity\LeadStatus;
use Masters\Entity\LeadSource;
use Followups\Entity\Followups;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Notifications\Entity\SmsTemplates;
use Notifications\Entity\EmailTemplates;

use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;


class LeadsController extends AbstractActionController
{
    private $authService;
    private $entityManager;
    private $logManager;
    private $tmp;
    private $LMSUtilities;
    private $logger;

    public function __construct($authService, $entityManager, $logManager, $tmp, $LMSUtilities, $logger)
    {
        $this->authService = $authService;
        $this->entityManager = $entityManager;
        $this->logManager = $logManager;
        $this->tmp = $tmp;
        $this->LMSUtilities = $LMSUtilities;
        $this->logger = $logger;
    }

    public function indexAction()
    {
        $request = $this->getRequest();
		$page = $this->params()->fromQuery('page', 1);
		
        $search_array = $this->params()->fromQuery('search', []);
        $search_array = empty($search_array)?[]:unserialize(base64_decode($search_array));

        $post = $request->getPost()->toArray();
        empty($post)?$post = $search_array:'';

        $query = $this->entityManager->createQueryBuilder()->select('l')
                  ->from('Leads\Entity\Leads', 'l');

        if (!empty($post)) {
            $dates = explode(" - ", $post['daterange']);
            $startdate = $this->LMSUtilities->makeDBDate($dates[0]);
            $enddate = $this->LMSUtilities->makeDBDate($dates[1]);

            $query->where('l.dateCreated between :startdate and :enddate')
                  ->setParameter('startdate', $startdate)
                  ->setParameter('enddate', $enddate)
                  ->setParameter('enddate', $enddate);

            empty($post['s_id'])?'':$query->AndWhere('l.id = :id')->setParameter('id', $post['s_id']);
            empty($post['s_customer'])?'':$query->AndWhere('l.firstName like :customer')->setParameter('customer', '%'. $post['s_customer'].'%');
            empty($post['s_project'])?'':$query->AndWhere('l.project = :project')->setParameter('project', $post['s_project']);
            empty($post['s_campaign'])?'':$query->AndWhere('l.campaign = :campaign')->setParameter('campaign', $post['s_campaign']);
            empty($post['s_status'])?'':$query->AndWhere('l.status = :status')->setParameter('status', $post['s_status']);
            empty($post['s_source'])?'':$query->AndWhere('l.source = :source')->setParameter('source', $post['s_source']);
        }
		//$query->setFirstResult($offset)->setMaxResults($paginator['per_page'])->add('orderBy', 'l.id DESC');
		$query->add('orderBy', 'l.id DESC');
        $users = $this->entityManager->getRepository(User::class)->findAll();
        $projects = $this->entityManager->getRepository(Projects::class)->findAll();
        $campaigns = $this->entityManager->getRepository(Campaigns::class)->findAll();
        $status = $this->entityManager->getRepository(LeadStatus::class)->findAll();
        $source = $this->entityManager->getRepository(LeadSource::class)->findAll();

        $smstemplates = $this->entityManager->getRepository(SmsTemplates::class)
                   ->findBy([], ['id'=>'ASC']);
        $emailtemplates = $this->entityManager->getRepository(EmailTemplates::class)
                   ->findBy([], ['id'=>'ASC']);

		// Create ZF3 paginator.
		$adapter = new DoctrineAdapter(new ORMPaginator($query, false));
		$paginator = new Paginator($adapter);
		
		// Set page number and page size.
		$paginator->setDefaultItemCountPerPage(10);        
		$paginator->setCurrentPageNumber($page);


		$count = count($adapter);

        return new ViewModel(['leads' => $paginator, 'campaigns'=>$campaigns, 'source'=>$source, 'status' => $status, 'search_array' => $post, 'users' => $users, 'projects' => $projects, 'smstemplates' => $smstemplates, 'emailtemplates' => $emailtemplates,'count'=>$count]);
    }

    public function addAction()
    {
        $form = new LeadsForm();
        $form->get('project')->setValueOptions($this->LMSUtilities->projectsList());
        $form->get('campaign')->setValueOptions($this->LMSUtilities->campaignsList());
        $form->get('source')->setValueOptions($this->LMSUtilities->LeadSourceList());
        $form->get('location')->setValueOptions($this->LMSUtilities->locationsList());
        $form->get('status')->setValueOptions($this->LMSUtilities->leadStatusList());
        $form->get('followup_type')->setValueOptions($this->LMSUtilities->followupsList());
        $form->get('state')->setValueOptions($this->LMSUtilities->getStatesList());
        $form->get('configuration')->setValueOptions($this->LMSUtilities->flatConfigurationList());
        $request = $this->getRequest();
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $this->authService->getIdentity() ], ['id' => 'ASC']);

        if ($request->isPost()) {
            $post = $request->getPost()->toArray();
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();

                try {
                    $lead = new Leads();
                    $lead->setFirstName($data['first_name']);
                    $lead->setLastName($data['last_name']);
                    $lead->setContact($data['contact']);
                    $lead->setEmail($data['email']);
                    $lead->setState($data['state']);
                    $lead->setCity($data['city']);
                    $lead->setLocation($data['location']);
                    $lead->setConfiguration($data['configuration']);
                    $lead->setProject($data['project']);
                    $lead->setCampaign($data['campaign']);
                    $lead->setSource($data['source']);
                    $lead->setStatus($data['status']);
                    $lead->setInterested($data['interested']);
                    $lead->setRemarks($data['remarks']);
                    $lead->setCreatedBy($user->getId());
                    $this->entityManager->persist($lead);
                    $this->entityManager->flush();
                } catch (Exception $e) {
                    $this->logger->info('Caught exception: ', $e->getMessage(), "\n");
                }

                $lead_id = $lead->getId();

                if ($data['interested']==1) {
                    $follow_ups = new Followups();
                    $follow_ups->setLeadId($lead_id);
                    $follow_ups->setFollowupType($data['followup_type']);
                    $follow_ups->setFollowDate($this->LMSUtilities->makeDate($data['follow_date']));
                    $follow_ups->setRemarks($data['remarks']);
                    $follow_ups->setCreatedBy($user->getId());
                    $this->entityManager->persist($follow_ups);
                    $this->entityManager->flush();
                }

                $log = $this->logManager;
                $log->setlog('Lead Added', $lead_id, $this->authService->getIdentity());
            } else {
                $this->logger->info('form validator: ', $form->getMessages(), "\n");
            }

            $this->flashMessenger()->addSuccessMessage('Lead Added '. $lead_id);
           return $this->redirect()->toRoute('leads', ['action' => 'index']);
        }

        return new ViewModel(['form' => $form]);
    }

    public function editAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $this->authService->getIdentity() ], ['id' => 'ASC']);

        if ($id < 1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        $leads = $this->entityManager->getRepository(Leads::class)->find($id);

        $form = new LeadsForm();
        $form->get('project')->setValueOptions($this->LMSUtilities->projectsList());
        $form->get('campaign')->setValueOptions($this->LMSUtilities->campaignsList());
        $form->get('source')->setValueOptions($this->LMSUtilities->LeadSourceList());
        $form->get('location')->setValueOptions($this->LMSUtilities->locationsList());
        $form->get('status')->setValueOptions($this->LMSUtilities->leadStatusList());
        $form->get('followup_type')->setValueOptions($this->LMSUtilities->followupsList());
        $form->get('state')->setValueOptions($this->LMSUtilities->getStatesList());
        $form->get('configuration')->setValueOptions($this->LMSUtilities->flatConfigurationList());

        $request = $this->getRequest();
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $this->authService->getIdentity() ], ['id' => 'ASC']);

        if ($request->isPost()) {
            $post = $request->getPost()->toArray();
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();
                try {
                    $lead = $this->entityManager->getRepository(Leads::class)->findOneBy(['id' => $id]);
                    $lead->setFirstName($data['first_name']);
                    $lead->setLastName($data['last_name']);
                    $lead->setContact($data['contact']);
                    $lead->setEmail($data['email']);
                    $lead->setState($data['state']);
                    $lead->setCity($data['city']);
                    $lead->setLocation($data['location']);
                    $lead->setConfiguration($data['configuration']);
                    $lead->setProject($data['project']);
                    $lead->setCampaign($data['campaign']);
                    $lead->setSource($data['source']);
                    $lead->setStatus($data['status']);
                    $lead->setInterested($data['interested']);
                    $lead->setRemarks($data['remarks']);
                    $lead->setCreatedBy($user->getId());
                    $this->entityManager->persist($lead);
                    $this->entityManager->flush();
                } catch (Exception $e) {
                    $this->logger->info('Caught exception: ', $e->getMessage(), "\n");
                }
        
                if ($data['interested']==1) {
                    $follow_ups = new Followups();
                    $follow_ups->setLeadId($id);
                    $follow_ups->setFollowupType($data['followup_type']);
                    $follow_ups->setFollowDate($this->LMSUtilities->makeDate($data['follow_date']));
                    $follow_ups->setRemarks($data['remarks']);
                    $follow_ups->setCreatedBy($user->getId());
                    $this->entityManager->persist($follow_ups);
                    $this->entityManager->flush();
                }

                $log = $this->logManager;
                $log->setlog('Lead Edited', $id, $this->authService->getIdentity());
            } else {
                $this->logger->info('form validator: ', $form->getMessages(), "\n");
            }

            $this->flashMessenger()->addSuccessMessage('Lead edited '. $id);
            return $this->redirect()->toRoute('leads', ['action' => 'index']);
        } else {
            $status = $this->entityManager->getRepository(LeadStatus::class)->findOneBy(['id' => $leads->getStatus()]);
            $followups = $this->entityManager->getRepository(Followups::class)->findOneBy(['leadId' => $leads->getId()], ['id'=>'DESC']);
            $form->get('status')->setValueOptions($this->LMSUtilities->leadStatusList());
            $form->get('city')->setValueOptions($this->LMSUtilities->getCityList($leads->getState()));


            $form->setData(array(
                'first_name' => $leads->getFirstName(),
                'last_name' =>  $leads->getLastName(),
                'contact' =>  $leads->getContact(),
                'email' =>  $leads->getEmail(),
                'state' =>  $leads->getState(),
                'city' =>  $leads->getCity(),
                'location' => $leads->getLocation(),
                'configuration' => $leads->getConfiguration(),
                'interested' => $leads->getConfiguration(),
                'project' => $leads->getProject(),
                'campaign' => $leads->getCampaign(),
                'source' => $leads->getSource(),
                'followup_type' => (!empty($followups) ? $followups->getFollowupType() : ''),
                'follow_date' => (!empty($followups) ? $followups->getFollowDate() : ''),
                'remarks' => (!empty($followups) ? $followups->getRemarks() : ''),
                'status' => $leads->getStatus(),
            ));
        }

        return new ViewModel(['id' => $id, 'form' => $form]);
    }

    public function excelreaderAction()
    {
        $request = $this->getRequest();
        if ($request->isPost()) {
            $post = array_merge_recursive($request->getPost()->toArray(), $request->getFiles()->toArray());
            $file = $this->tmp . DIRECTORY_SEPARATOR . $post['file']['name'];
            rename($post['file']['tmp_name'], $file);
        } else {
            die();
        }

        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load($file);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        array_shift($sheetData);
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $this->authService->getIdentity() ], ['id' => 'ASC']);

        foreach ($sheetData as $s) {
			
			if(empty($s['A'])){
				$this->flashMessenger()->addInfoMessage('Required Data is Missing or Empty Line at Bottom, All the data above that line has been added successfully');
				return $this->redirect()->toRoute('leads', ['action' => 'index', 'id' => $lead_id]);
			}
			
            $lead = new Leads();
            $lead->setFirstName($s['A']);
            $lead->setLastName($s['B']);
            $lead->setContact($s['C']);
            $lead->setEmail($s['D']);
            $lead->setProject((int) $s['E']);
            $lead->setCampaign((int) $s['F']);
            $lead->setConfiguration((int) $s['G']);
            $lead->setLocation((int) $s['H']);
            $lead->setStatus((int) $s['I']);
            $lead->setSource((int) $s['J']);
            $lead->setJunk((int) $s['K']);
            $lead->setVisited((int) $s['L']);
            $lead->setClosed((int) $s['M']);
            $lead->setInterested((int) $s['N']);
            $lead->setRemarks($s['O']);
            $lead->setCreatedBy($user->getId());
            $this->entityManager->persist($lead);
            $this->entityManager->flush();
            $lead_id = $lead->getId();

            $log = $this->logManager;
            $log->setlog('Lead Uploaded', $lead_id, $this->authService->getIdentity()); //Log
        };

        $this->flashMessenger()->addSuccessMessage('Excel Uploaded Successfully');
        return $this->redirect()->toRoute('leads', ['action' => 'index', 'id' => $lead_id]);
    }

    public function excelwriterAction()
    {
		$this->layout()->setTemplate('layout/blank');
 
        $id = $this->params()->fromRoute('id', -1);
        $search_array = unserialize(base64_decode($id));
		
		$query = $this->entityManager->createQueryBuilder()->select('l')
                  ->from('Leads\Entity\Leads', 'l');
		
		if (!empty($search_array)) {
            $dates = explode(" - ", $search_array['daterange']);
            $startdate = $this->LMSUtilities->makeDBDate($dates[0]);
            $enddate = $this->LMSUtilities->makeDBDate($dates[1]);

            $query->where('l.dateCreated between :startdate and :enddate')
                  ->setParameter('startdate', $startdate)
                  ->setParameter('enddate', $enddate);

            empty($search_array['s_id'])?'':$query->AndWhere('l.id = :id')->setParameter('id', $search_array['s_id']);
            empty($search_array['s_customer'])?'':$query->AndWhere('l.customerId = :customer')->setParameter('customer', $search_array['s_customer']);
            empty($search_array['s_project'])?'':$query->AndWhere('l.project = :project')->setParameter('project', $search_array['s_project']);
            empty($search_array['s_campaign'])?'':$query->AndWhere('l.projectCampaign = :campaign')->setParameter('campaign', $search_array['s_campaign']);
            empty($search_array['s_status'])?'':$query->AndWhere('l.status = :status')->setParameter('status', $search_array['s_status']);
            empty($search_array['s_source'])?'':$query->AndWhere('l.source = :source')->setParameter('source', $search_array['s_source']);
        }
		
		

        $leads = $query->getQuery()->getResult();

        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();

        // Set document properties
        $spreadsheet->getProperties()->setCreator('PlinthstoneLMS')->setLastModifiedBy('PlinthstoneLMS')->setTitle('PlinthstoneLMS Leads')->setSubject('PlinthstoneLMS Leads')->setDescription('PlinthstoneLMS Leads')->setKeywords('PlinthstoneLMS Leads')->setCategory('PlinthstoneLMS Leads');

        // Add some data
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'First Name')->setCellValue('B1', 'Last Name')->setCellValue('C1', 'Contact No.')->setCellValue('D1', 'Email')->setCellValue('E1', 'Project')->setCellValue('F1', 'Campaign')->setCellValue('G1', 'Configuration')->setCellValue('H1', 'Location')->setCellValue('I1', 'Status')->setCellValue('J1', 'Source');
        $n = 1;
        foreach ($leads as $l) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . (string)($n + 1), $l->getFirstName())
                ->setCellValue('B' . (string)($n + 1), $l->getLastName())
                ->setCellValue('C' . (string)($n + 1), $l->getContact())
                ->setCellValue('D' . (string)($n + 1), $l->getEmail())
                ->setCellValue('E' . (string)($n + 1), $this->LMSUtilities->getProjectName($l->getProject()))
                ->setCellValue('F' . (string)($n + 1), $this->LMSUtilities->getCampaign($l->getCampaign()))
                ->setCellValue('G' . (string)($n + 1), $l->getConfiguration())
                ->setCellValue('H' . (string)($n + 1), $this->LMSUtilities->getLocation($l->getLocation()))
                //->setCellValue('I' . (string)($n + 1), $this->LMSUtilities->getLeadStatus($l->getStatus()))
				//->setCellValue('I' . (string)($n + 1), $this->LMSUtilities->getLeadStatusCREMA($l->getID()))
				->setCellValue('I' . (string)($n + 1), '')
                ->setCellValue('J' . (string)($n + 1), $this->LMSUtilities->getLeadSource($l->getSource()));
            $n++;
        }

        // Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('Leads');

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);

        // Redirect output to a clientâ€™s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="PlinthstoneLMS.xlsx"');
        header('Cache-Control: max-age=0');

        // If you're serving to IE 9, then the following may be needed

        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed

        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        return $writer->save('php://output');
    }

    public function detailsAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);

        $lead = $this->entityManager->getRepository(Leads::class)
                    ->findOneBy(['id'=>$id]);

        $followups = $this->entityManager->getRepository(Followups::class)
                    ->findBy(['leadId'=>$id]);

        return new ViewModel(['lead'=>$lead,'followups'=>$followups]);
    }

    public function deleteAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        $lead = $this->entityManager->getRepository(Leads::class)
                  ->find($id);
        $this->entityManager->remove($lead);
        $this->entityManager->flush();

        $log = $this->logManager;
        $log->setlog('Lead Deleted ', $id, $this->authService->getIdentity());

        $this->flashMessenger()->addSuccessMessage('Lead deleted '. $id);
        return $this->redirect()->toRoute('leads', ['action'=>'index']);
    }
    
    public function closeAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        $lead = $this->entityManager->getRepository(Leads::class)
                  ->find($id);
        $lead->setClosed(1);
        $this->entityManager->persist($lead);
        $this->entityManager->flush();

        $log = $this->logManager;
        $log->setlog('Lead Closed ', $id, $this->authService->getIdentity());

        $this->flashMessenger()->addSuccessMessage('Lead Closed '. $id);
        return $this->redirect()->toRoute('leads', ['action'=>'index']);
    }
    
    public function visitedAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        $lead = $this->entityManager->getRepository(Leads::class)
                  ->find($id);
        $lead->setVisited(1);
        $lead->setClosed(1);
        $this->entityManager->persist($lead);
        $this->entityManager->flush();

        $log = $this->logManager;
        $log->setlog('Lead set to Visited ', $id, $this->authService->getIdentity());

        $this->flashMessenger()->addSuccessMessage('Lead set to Visited '. $id);
        return $this->redirect()->toRoute('leads', ['action'=>'index']);
    }
    
    public function junkAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        $lead = $this->entityManager->getRepository(Leads::class)
                  ->find($id);
        $lead->setJunk(1);
        $lead->setClosed(1);
        $this->entityManager->persist($lead);
        $this->entityManager->flush();

        $log = $this->logManager;
        $log->setlog('Lead set as Junk ', $id, $this->authService->getIdentity());

        $this->flashMessenger()->addSuccessMessage('Lead set as Junk '. $id);
        return $this->redirect()->toRoute('leads', ['action'=>'index']);
    }
}
