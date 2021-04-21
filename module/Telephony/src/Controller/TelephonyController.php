<?php

namespace Telephony\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use User\Entity\User;
use Leads\Entity\Leads;
use Telephony\Entity\Telephony;
use Customers\Entity\Customers;
use Settings\Entity\Settings;
use Projects\Entity\Projects;

class TelephonyController extends AbstractActionController
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

    public function indexAction()
    {
        $this->sync();
        
        $request = $this->getRequest();

        $search_array = $this->params()->fromQuery('search', []);
        $search_array = empty($search_array)?[]:unserialize(base64_decode($search_array));

        $post = $request->getPost()->toArray();
        empty($post)?$post = $search_array:'';

        $query = $this->entityManager->createQueryBuilder()->select('t,l')
                  ->from('Telephony\Entity\Telephony', 't')
                  ->join('Leads\Entity\Leads', 'l', 'WITH', 't.leadId = l.id');

        if (!empty($post)) {
            $dates = explode(" - ", $post['daterange']);
            $startdate = $this->LMSUtilities->makeDBDate($dates[0]);
            $enddate = $this->LMSUtilities->makeDBDate($dates[1]);

            $query->where('t.dateCreated between :startdate and :enddate')
                  ->setParameter('startdate', $startdate)
                  ->setParameter('enddate', $enddate);
            empty($post['s_project'])?'':$query->AndWhere('l.project = :project')->setParameter('project', $post['s_project']);
            empty($post['s_status'])?'':$query->AndWhere('t.action = :status')->setParameter('status', $post['s_status']);
        }

        $paginator['page'] = $this->params()->fromQuery('page', 1);
        $paginator['count'] = count($query->getQuery()->getScalarResult());
        $paginator['per_page'] = 10;
        $offset = $paginator['page'] * $paginator['per_page'] - $paginator['per_page'];

        $query->setFirstResult($offset)->setMaxResults($paginator['per_page'])->add('orderBy', 't.id DESC');

        $telephony = $query->getQuery()->getScalarResult();


        $users = $this->entityManager->getRepository(User::class)->findAll();
        $projects = $this->entityManager->getRepository(Projects::class)->findAll();
        
        $settings = $this->entityManager->getRepository(Settings::class)->findOneBy(['id' => 1 ]);
        $token =$settings->getKookooApi();

        return new ViewModel(['token' => $token, 'telephony' => $telephony, 'search_array' => $post, 'users' => $users, 'projects' => $projects, 'paginator' => $paginator]);
    }
    
    
    public function sync()
    {
        return;

    }
}

