<?php

namespace Projects\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Projects\Form\ProjectsForm;
use Masters\Entity\Amenities;
use Masters\Entity\PreferredLocation;
use Projects\Entity\Projects;
use User\Entity\User;

class ProjectsController extends AbstractActionController
{
    private $authService;
    private $entityManager;
    private $logManager;
    private $dir;
    private $LMSUtilities;
    private $logger;

    public function __construct($dir, $authService, $entityManager, $logManager, $LMSUtilities, $logger)
    {
        $this->dir = $dir;
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

        if (!is_dir($dir)) {
            mkdir($_dir, 0777);
        }
        $this->dir = realpath($dir) . DIRECTORY_SEPARATOR . '';
    }


    public function indexAction()
    {
        $paginator['page'] = $this->params()->fromQuery('page', 1);
        $paginator['count'] = $this->entityManager->getUnitOfWork()->getEntityPersister(Projects::class)->count([]);
        $paginator['per_page'] = 10;
        $offset = $paginator['page'] * $paginator['per_page'] - $paginator['per_page'];

        $projects = $this->entityManager->getRepository(Projects::class)
                   ->findBy([], ['id'=>'DESC'], $paginator['per_page'], $offset);

        return new ViewModel(['projects' => $projects,'paginator' => $paginator]);
    }


    public function addAction()
    {
        $form = new ProjectsForm($this->dir);
            
        $form->get('internal_amenities')->setValueOptions($this->LMSUtilities->internalAmenitiesList());
        $form->get('external_amenities')->setValueOptions($this->LMSUtilities->externalAmenitiesList());
        $form->get('city')->setValueOptions($this->LMSUtilities->locationsList());

        $user = $this->entityManager->getRepository(User::class)
           ->findOneBy(['email'=>$this->authService->getIdentity()], ['id'=>'ASC']);

        $request = $this->getRequest();
        if ($request->isPost()) {
            $post = array_merge_recursive(
                $this->getRequest()->getPost()->toArray(),
                $this->getRequest()->getFiles()->toArray()
            );
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();
                    
                $logo = (empty($data['logo']['name'])? 0 : $data['logo']['name']);

                if (!empty($data['logo']['name'])) {
                    $this->setFileNames($data, $this->dir. DIRECTORY_SEPARATOR);
                }

                try {
                    $project = new Projects();
                    $project->setName($data['name']);
                    $project->setDeveloper($data['developer']);
                    $project->setCity($data['city']);
                    $project->setAddress($data['address']);
                    $project->setInternalAmenities($this->LMSUtilities->makeString($data['internal_amenities']));
                    $project->setExternalAmenities($this->LMSUtilities->makeString($data['external_amenities']));
                    $project->setStatus($data['status']);
                    $project->setCreatedBy($user->getId());
                    $this->entityManager->persist($project);
                    $this->entityManager->flush();
                } catch (Exception $e) {
                    $this->logger->info('Caught exception: ', $e->getMessage(), "\n");
                }
                $log = $this->logManager;
                $log->setlog('Project Added', $data['name'], $this->authService->getIdentity());//Log
                    
                $this->flashMessenger()->addSuccessMessage('New Project added successfully ', $data['name']);
            } else {
                $this->logger->info('form validator: ', $form->getMessages(), "\n");
            }

            
            return $this->redirect()->toRoute('projects', ['action'=>'index']);
        }
        return new ViewModel(['form' => $form]);
    }


    public function editAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);

        $user = $this->entityManager->getRepository(User::class)
           ->findOneBy(['email'=>$this->authService->getIdentity()], ['id'=>'ASC']);

        if ($id<1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        $project = $this->entityManager->getRepository(Projects::class)
                ->find($id);

        if ($project == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        $form = new ProjectsForm($this->dir);

        $form->get('internal_amenities')->setValueOptions($this->LMSUtilities->internalAmenitiesList());
        $form->get('external_amenities')->setValueOptions($this->LMSUtilities->externalAmenitiesList());
        $form->get('city')->setValueOptions($this->LMSUtilities->locationsList());

        if ($this->getRequest()->isPost()) {
            $data = array_merge_recursive(
                $this->getRequest()->getPost()->toArray(),
                $this->getRequest()->getFiles()->toArray()
            );
            $form->setData($data);

            if ($form->isValid()) {
                $data = $form->getData();

                $logo = (empty($data['logo']['name'])? $project->getLogo() : $data['logo']['name']);
    
                if (!empty($data['logo']['name'])) {
                    $this->setFileNames($data, $this->dir.DIRECTORY_SEPARATOR.'logos'.DIRECTORY_SEPARATOR);
                }
            
                try {
                    $project->setName($data['name']);
                    $project->setDeveloper($data['developer']);
                    $project->setLogo($logo);
                    $project->setCity($data['city']);
                    $project->setAddress($data['address']);
                    $project->setInternalAmenities($this->LMSUtilities->makeString($data['internal_amenities']));
                    $project->setExternalAmenities($this->LMSUtilities->makeString($data['external_amenities']));
                    $project->setStatus($data['status']);
                    $project->setCreatedBy($user->getId());
                    $this->entityManager->persist($project);
                    $this->entityManager->flush();
                } catch (Exception $e) {
                    $this->logger->info('Caught exception: ', $e->getMessage(), "\n");
                }

                $log = $this->logManager;
                $log->setlog('Project Edited', $data['name'], $this->authService->getIdentity());//Log

                $this->flashMessenger()->addSuccessMessage('Project updated successfully ', $data['name']);
                return $this->redirect()->toRoute('projects', ['action'=>'index']);
            } else {
                $this->logger->info('form validator: ', $form->getMessages(), "\n");
            }
        } else {
            $form->setData(array(
                'name' => $project->getName(),
                'developer' => $project->getDeveloper(),
                'logo' => $project->getLogo(),
                'city' => $project->getCity(),
                'address' => $project->getAddress(),
                'internal_amenities' => $this->LMSUtilities->getArray($project->getInternalAmenities()),
                'external_amenities' => $this->LMSUtilities->getArray($project->getExternalAmenities()),
                'status' => $project->getStatus(),
                'created_by' => $project->getCreatedBy($user->getId()),
                    ));
        }

        return new ViewModel(['form' => $form,'project'=>$project]);
    }

    public function detailsAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        $project = $this->entityManager->getRepository(Projects::class)
                ->find($id);

        $location = $this->entityManager->getRepository(PreferredLocation::class)
                 ->findOneBy(['id'=>$project->getCity(),'status'=>1]);

        $internal_amenities = $this->entityManager->getRepository(Amenities::class)
                 ->findBy(['type'=>1,'status'=>1], ['name'=>'ASC']);

        $external_amenities = $this->entityManager->getRepository(Amenities::class)
                 ->findBy(['type'=>2,'status'=>1], ['name'=>'ASC']);


        return new ViewModel(['project' => $project,'location' => $location,'internal_amenities' => $internal_amenities,'external_amenities' => $external_amenities]);
    }

    public function deleteAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        $project = $this->entityManager->getRepository(Projects::class)
                ->find($id);
        $name = $project->getName();

        $this->entityManager->remove($project);
        $this->entityManager->flush();

        $log = $this->logManager;
        $log->setlog('Project Deleted', $name, $this->authService->getIdentity());

        $this->flashMessenger()->addSuccessMessage('Project deleted ', $name);
        return $this->redirect()->toRoute('projects', ['action'=>'index']);
    }

    protected function setFileNames($data, $path)
    {
        unset($data['submit']);
        if (array_key_exists("logo", $data)) {
            if (file_exists($path. DIRECTORY_SEPARATOR . $data['logo']['name'])) {
                $this->flashMessenger()->addErrorMessage($data['logo']['name'] . ' File already exist');
            } else {
                rename($data['logo']['tmp_name'], $path. $data['logo']['name']);
				// Read and write for owner, read for everybody else
				chmod($path. $data['logo']['name'],0644);
                $this->flashMessenger()->addSuccessMessage($data['logo']['name'] . ' File Uploaded');
            }
        }
    }
}
