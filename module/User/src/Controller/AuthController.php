<?php

namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Authentication\Result;
use Zend\Uri\Uri;
use User\Form\LoginForm;
use User\Entity\User;
use Zend\Mvc\MvcEvent;

class AuthController extends AbstractActionController
{
    public function onDispatch(MvcEvent $e)
    {
        $response = parent::onDispatch($e);
        //$this->layout()->setTemplate('layout/login-layout');
        return $response;
    }

    private $entityManager;
    private $authManager;
    private $authService;
    private $userManager;

    public function __construct($entityManager, $authManager, $authService, $userManager)
    {
        $this->entityManager = $entityManager;
        $this->authManager = $authManager;
        $this->authService = $authService;
        $this->userManager = $userManager;
    }

    public function loginAction()
    {
        $this->layout()->setTemplate('layout/login-layout');
        $redirectUrl = (string)$this->params()->fromQuery('redirectUrl', '');
        if (strlen($redirectUrl)>2048) {
            throw new \Exception("Too long redirectUrl argument passed");
        }

        $this->userManager->createAdminUserIfNotExists();

        $form = new LoginForm();
        $form->get('redirect_url')->setValue($redirectUrl);

        $isLoginError = false;

        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();

            $form->setData($data);

            if ($form->isValid()) {
                $data = $form->getData();

                $result = $this->authManager->login(
                    $data['email'],
                        $data['password'],
                    $data['remember_me']
                );

                if ($result->getCode() == Result::SUCCESS) {
                    $redirectUrl = $this->params()->fromPost('redirect_url', '');

                    if (!empty($redirectUrl)) {
                        $uri = new Uri($redirectUrl);
                        if (!$uri->isValid() || $uri->getHost()!=null) {
                            throw new \Exception('Incorrect redirect URL: ' . $redirectUrl);
                        }
                    }

                    if (empty($redirectUrl)) {
                        return $this->redirect()->toRoute('home');
                    } else {
                        $this->redirect()->toUrl($redirectUrl);
                    }
                } else {
                    $isLoginError = true;
                }
            } else {
                $isLoginError = true;
            }
        }

        return new ViewModel([
            'form' => $form,
            'isLoginError' => $isLoginError,
            'redirectUrl' => $redirectUrl
        ]);
    }

    public function logoutAction()
    {
        $this->layout()->setTemplate('layout/login-layout');
        $this->authManager->logout();
        return $this->redirect()->toRoute('login');
    }

    public function notAuthorizedAction()
    {
        $this->layout()->setTemplate('layout/auth-layout');
        $this->getResponse()->setStatusCode(403);
        return new ViewModel();
    }
}
