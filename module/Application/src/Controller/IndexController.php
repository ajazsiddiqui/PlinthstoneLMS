<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use User\Entity\User;
use Leads\Entity\Leads;
use Masters\Entity\FollowupTypes;
use Followups\Entity\Followups;
use Projects\Entity\Projects;

/**
 * This is the main controller class of the User Demo application. It contains
 * site-wide actions such as Home or About.
 */
class IndexController extends AbstractActionController
{
    private $entityManager;
    private $LMSUtilities;

    public function __construct($entityManager, $LMSUtilities)
    {
        $this->entityManager = $entityManager;
        $this->LMSUtilities = $LMSUtilities;
    }

    public function indexAction()
    {
        $user = $this->currentUser();

        $now = new \DateTime();
        $date = $now->format('Y-m-d H:i:s');
        $thirtyDaysAgo = $now->modify('-30 day');

        $now = new \DateTime();
        $sevenDaysAgo = $now->modify('-7 day')->format('Y-m-d H:i:s');

        //All Leads
        $leads['all'] = $this->entityManager->getUnitOfWork()->getEntityPersister(Leads::class)->count();
        $leads['month'] = $this->entityManager->createQueryBuilder()->select('count(leads.id)')
    ->where('leads.dateCreated between :from and :to')
    ->setParameter('from', $thirtyDaysAgo)
    ->setParameter('to', $date)
    ->from('Leads\Entity\Leads', 'leads')->getQuery()->getSingleScalarResult();
        $leads['week'] = $this->entityManager->createQueryBuilder()->select('count(leads.id)')->where('leads.dateCreated between :from and :to')->setParameter('from', $sevenDaysAgo)->setParameter('to', $date)->from('Leads\Entity\Leads', 'leads')->getQuery()->getSingleScalarResult();
    
        //Walkins
        $converts['all'] = $this->entityManager->createQueryBuilder()->select('count(leads.id)')
    ->where('leads.closed = :closed')
    ->setParameter('closed', 1)
    ->from('Leads\Entity\Leads', 'leads')->getQuery()->getSingleScalarResult();
        $converts['month'] = $this->entityManager->createQueryBuilder()->select('count(leads.id)')
    ->where('leads.closed = :closed')
    ->setParameter('closed', 1)
    ->Andwhere('leads.dateCreated between :from and :to')
    ->setParameter('from', $thirtyDaysAgo)
    ->setParameter('to', $date)
    ->from('Leads\Entity\Leads', 'leads')->getQuery()->getSingleScalarResult();
        $converts['week'] = $this->entityManager->createQueryBuilder()->select('count(leads.id)')
    ->where('leads.closed = :closed')
    ->setParameter('closed', 1)
    ->andWhere('leads.dateCreated between :from and :to')
    ->setParameter('from', $sevenDaysAgo)
    ->setParameter('to', $date)
    ->from('Leads\Entity\Leads', 'leads')->getQuery()->getSingleScalarResult();
    

        $result = $this->entityManager->createQueryBuilder();

        $query = $result->select('l,f')
            ->from('Leads\Entity\Leads', 'l')
            ->join('Followups\Entity\Followups', 'f', 'WITH', 'f.leadId = l.id')
    ->where('l.interested = :interested')
    ->setParameter(':interested', 1)
    ->setMaxResults(3)

    ->add('orderBy', 'f.followDate DESC');

        $leadstofollow = $query->getQuery()->getScalarResult();


        $i =0;
        foreach ($leadstofollow as $follow) {
            $followup = $this->entityManager->getRepository(Followups::class)->findOneBy(['leadId'=>$follow['l_id']]);
            $project = $this->entityManager->getRepository(Projects::class)->findOneBy(['id'=>$follow['l_project']]);
            $FollowupTypes = $this->entityManager->getRepository(FollowupTypes::class)->findOneBy(['id'=>$followup->getFollowupType()]);
            $leadstofollow[$i]['followup_type'] = empty($FollowupTypes)?0:$FollowupTypes->getName();
            $leadstofollow[$i]['followup_date'] = empty($FollowupTypes)?0:$followup->getFollowDate();
            $leadstofollow[$i]['project_details'] = empty($project)?0:$project->getName();
            $i++;
        }
            
        $users = $this->entityManager->getRepository(User::class)
             ->findAll();

        $username = [];
        $enquiries = [];
        $sitevisits = [];

        foreach ($users as $user) {
            $username[] = $user->getFullName();

            $leadowners = $this->entityManager->getRepository(Followups::class)
        ->findBy(['createdBy'=>$user->getId()]);

            $owners = '';
            foreach ($leadowners as $owner) {
                $owners .= $owner->getLeadId().',';
            }
            $owners = rtrim($owners, ',');
        
            (empty($owners)?$owners=$user->getId():'');

            $sql = "SELECT id FROM leads WHERE id IN (".$owners.")";
            $stmt= $this->entityManager->getConnection()->prepare($sql);
            $stmt->execute();
            $enquiry = $stmt->fetchAll();
            $enquiries[] = count($enquiry);

            $sql = "SELECT id FROM leads WHERE id IN (".$owners.") and visited = 1";
            $stmt2 = $this->entityManager->getConnection()->prepare($sql);
            $stmt2->execute();
            $sitevisit = $stmt2->fetchAll();
            $sitevisits[] = count($sitevisit);
        }

        $array = ['usernames'=>$username,'enquiries'=>$enquiries,'sitevisits'=>$sitevisits];

        return (empty($user)? $this->redirect()->toRoute('login'): new ViewModel(['projects' => $this->LMSUtilities->projectsList(),'leads' => $leads, 'converts'=>$converts, 'leadstofollow'=>$leadstofollow, 'leaderboard'=>$array]));
    }

    public function aboutAction()
    {
    }

    public function settingsAction()
    {
        $id = $this->params()->fromRoute('id');

        if ($id!=null) {
            $user = $this->entityManager->getRepository(User::class)
                    ->find($id);
        } else {
            $user = $this->currentUser();
        }

        if ($user==null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        if (!$this->access('profile.any.view') &&
            !$this->access('profile.own.view', ['user'=>$user])) {
            return $this->redirect()->toRoute('not-authorized');
        }

        return new ViewModel([
            'user' => $user
        ]);
    }
}
