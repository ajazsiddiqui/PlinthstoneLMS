<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use User\Entity\User;
use Application\Entity\Logs;

class LogsController extends AbstractActionController
{
    private $entityManager;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function indexAction()
    {
        $request = $this->getRequest();
        $post = $request->getPost()->toArray();
        $search_array = [];
        if ($request->isPost()) {
            (empty($post['s_user']) ? '' : $search_array['user'] = $post['s_user']);
        }

        $paginator['page'] = $this->params()->fromQuery('page', 1);
        $paginator['count'] = $this->entityManager->getUnitOfWork()->getEntityPersister(Logs::class)->count($search_array);
        $paginator['per_page'] = 10;
        $offset = $paginator['page'] * $paginator['per_page'] - $paginator['per_page'];

        $logs = $this->entityManager->getRepository(Logs::class)->findBy($search_array, ['id' => 'DESC'], $paginator['per_page'], $offset);

        $users = $this->entityManager->getRepository(User::class)->findAll();
        return new ViewModel(['logs' => $logs, 'paginator' => $paginator, 'users'=>$users]);
    }
}
