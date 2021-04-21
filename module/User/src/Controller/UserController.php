<?php
namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use User\Entity\User;
use User\Entity\Role;
use User\Form\UserForm;
use User\Form\PasswordChangeForm;
use User\Form\PasswordResetForm;
use Masters\Entity\SystemUserType;

class UserController extends AbstractActionController
{
    private $entityManager;

    private $userManager;
    

    public function __construct($dir, $entityManager, $userManager)
    {
        $this->dir = $dir;
        $this->entityManager = $entityManager;
        $this->userManager = $userManager;
    }
    
    public function indexAction()
    {
        if (!$this->access('user.manage')) {
            $this->getResponse()->setStatusCode(401);
            return;
        }
        
        $users = $this->entityManager->getRepository(User::class)
                ->findBy([], ['id'=>'DESC']);
        
        return new ViewModel([
            'users' => $users
        ]);
    }
    
    public function addAction()
    {
        $form = new UserForm($this->dir, 'create', $this->entityManager);
        
        $allRoles = $this->entityManager->getRepository(Role::class)
                ->findBy([], ['name'=>'ASC']);
        $roleList = [];
        foreach ($allRoles as $role) {
            $roleList[$role->getId()] = $role->getName();
        }
        
        $form->get('roles')->setValueOptions($roleList);
        
        $allUserTypes = $this->entityManager->getRepository(SystemUserType::class)
                ->findBy([], ['name'=>'ASC']);
        $UserTypesList = [];
        foreach ($allUserTypes as $userType) {
            $UserTypesList[$userType->getId()] = $userType->getName();
        }
        
        $form->get('user_type')->setValueOptions($UserTypesList);
        
        if ($this->getRequest()->isPost()) {
            $post = array_merge_recursive(
                $this->getRequest()->getPost()->toArray(),
                $this->getRequest()->getFiles()->toArray()
            );
            
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();
                
                $path = $this->dir. DIRECTORY_SEPARATOR . 'profile_pics';

                if (file_exists($path. DIRECTORY_SEPARATOR . $data['profile_pic']['name'])) {
                    $this->flashMessenger()->addErrorMessage($data['profile_pic']['name'] . ' already exist', 'alert alert-danger');
                } else {
                    rename($data['profile_pic']['tmp_name'], $path. DIRECTORY_SEPARATOR . $data['profile_pic']['name']);
                    $this->flashMessenger()->addSuccessMessage($data['profile_pic']['name'] . ' Uploaded', 'alert alert-success');
                }
                
                $user = $this->userManager->addUser($data);
                return $this->redirect()->toRoute(
                    'users',
                        ['action'=>'view', 'id'=>$user->getId()]
                );
            }
        }
        
        return new ViewModel([
                'form' => $form
            ]);
    }
    
    public function viewAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        if ($id<1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        
        $user = $this->entityManager->getRepository(User::class)
                ->find($id);
        
        if ($user == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
                
        return new ViewModel([
            'user' => $user
        ]);
    }
    
    public function editAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        if ($id<1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        
        $user = $this->entityManager->getRepository(User::class)
                ->find($id);
        
        if ($user == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        
        $form = new UserForm($this->dir, 'update', $this->entityManager, $user);
        $form->getInputFilter()->get('profile_pic')->setRequired(false);
        
        $allRoles = $this->entityManager->getRepository(Role::class)
                ->findBy([], ['name'=>'ASC']);
        $roleList = [];
        foreach ($allRoles as $role) {
            $roleList[$role->getId()] = $role->getName();
        }
        
        $form->get('roles')->setValueOptions($roleList);
        
        $allUserTypes = $this->entityManager->getRepository(SystemUserType::class)
                ->findBy([], ['name'=>'ASC']);
        $UserTypesList = [];
        foreach ($allUserTypes as $userType) {
            $UserTypesList[$userType->getId()] = $userType->getName();
        }
        
        $form->get('user_type')->setValueOptions($UserTypesList);
        
        if ($this->getRequest()->isPost()) {
            $post = array_merge_recursive(
                $this->getRequest()->getPost()->toArray(),
                $this->getRequest()->getFiles()->toArray()
            );
            $form->setData($post);
            if ($form->isValid()) {
                $data = $form->getData();

                if (empty($data['profile_pic']['name'])) {
                    $data['profile_pic']['name'] = $user->getProfilePic();
                } else {
                    $path = $this->dir. DIRECTORY_SEPARATOR . 'profile_pics';
                    if (file_exists($path. DIRECTORY_SEPARATOR . $data['profile_pic']['name'])) {
                        $this->flashMessenger()->addErrorMessage($data['profile_pic']['name'] . ' already exist', 'alert alert-danger');
                    } else {
                        rename($data['profile_pic']['tmp_name'], $path. DIRECTORY_SEPARATOR . $data['profile_pic']['name']);
                        $this->flashMessenger()->addSuccessMessage($data['profile_pic']['name'] . ' Uploaded', 'alert alert-success');
                    }
                }
                
                $this->userManager->updateUser($user, $data);
                return $this->redirect()->toRoute(
                    'users',
                        ['action'=>'view', 'id'=>$user->getId()]
                );
            }
        } else {
            $userRoleIds = [];
            foreach ($user->getRoles() as $role) {
                $userRoleIds[] = $role->getId();
            }
            
            $form->setData(array(
                    'full_name'=>$user->getFullName(),
                    'contact_no'=>$user->getContactNo(),
                    'user_type'=>$user->getUserType(),
                    'email'=>$user->getEmail(),
                    'status'=>$user->getStatus(),
                    'roles' => $userRoleIds
                ));
        }
        
        return new ViewModel(array(
            'user' => $user,
            'form' => $form
        ));
    }
    
    public function changePasswordAction()
    {
        $id = (int)$this->params()->fromRoute('id', -1);
        if ($id<1) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        
        $user = $this->entityManager->getRepository(User::class)
                ->find($id);
        
        if ($user == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        
        $form = new PasswordChangeForm('change');
        
        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            
            $form->setData($data);
            
            if ($form->isValid()) {
                $data = $form->getData();
                if (!$this->userManager->changePassword($user, $data)) {
                    $this->flashMessenger()->addErrorMessage(
                            'Sorry, the old password is incorrect. Could not set the new password.'
                    );
                } else {
                    $this->flashMessenger()->addSuccessMessage(
                            'Changed the password successfully.'
                    );
                }
                return $this->redirect()->toRoute(
                    'users',
                        ['action'=>'view', 'id'=>$user->getId()]
                );
            }
        }
        
        return new ViewModel([
            'user' => $user,
            'form' => $form
        ]);
    }
    

    public function resetPasswordAction()
    {
        $this->layout()->setTemplate('layout/login-layout');
        $form = new PasswordResetForm();
        
        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            
            $form->setData($data);
            if ($form->isValid()) {
                $user = $this->entityManager->getRepository(User::class)
                        ->findOneByEmail($data['email']);
                if ($user!=null) {
                    $this->userManager->generatePasswordResetToken($user);
                    return $this->redirect()->toRoute(
                        'users',
                            ['action'=>'message', 'id'=>'sent']
                    );
                } else {
                    return $this->redirect()->toRoute(
                        'users',
                            ['action'=>'message', 'id'=>'invalid-email']
                    );
                }
            }
        }
        
        return new ViewModel([
            'form' => $form
        ]);
    }
    
    public function messageAction()
    {
        $this->layout()->setTemplate('layout/login-layout');
        $id = (string)$this->params()->fromRoute('id');

        if ($id!='invalid-email' && $id!='sent' && $id!='set' && $id!='failed') {
            throw new \Exception('Invalid message ID specified');
        }
        
        return new ViewModel([
            'id' => $id
        ]);
    }
    
    public function setPasswordAction()
    {
        $token = $this->params()->fromQuery('token', null);
        
        if ($token!=null && (!is_string($token) || strlen($token)!=32)) {
            throw new \Exception('Invalid token type or length');
        }
        
        if ($token===null ||
           !$this->userManager->validatePasswordResetToken($token)) {
            return $this->redirect()->toRoute(
                'users',
                    ['action'=>'message', 'id'=>'failed']
            );
        }
                
        $form = new PasswordChangeForm('reset');
        
        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            
            $form->setData($data);
            
            if ($form->isValid()) {
                $data = $form->getData();
                                               
                if ($this->userManager->setNewPasswordByToken($token, $data['new_password'])) {
                    return $this->redirect()->toRoute(
                        'users',
                            ['action'=>'message', 'id'=>'set']
                    );
                } else {
                    return $this->redirect()->toRoute(
                        'users',
                            ['action'=>'message', 'id'=>'failed']
                    );
                }
            }
        }
        
        return new ViewModel([
            'form' => $form
        ]);
    }
}
