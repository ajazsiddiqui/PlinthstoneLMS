<?php

namespace Settings\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Settings\Entity\Settings;
use User\Entity\User;
use Settings\Form\SettingsForm;

class SettingsController extends AbstractActionController
{
    private $_dir;
    private $authService;
    private $entityManager;
    private $logManager;
    private $LMSUtilities;
    private $logger;

    public function __construct($dir, $authService, $entityManager, $logManager, $LMSUtilities, $logger)
    {
        $this->_dir = $dir;
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
        $user = $this->entityManager->getRepository(User::class)
       ->findOneBy(['email'=>$this->authService->getIdentity()], ['id'=>'ASC']);

        $form = new SettingsForm();
        $settings = $this->entityManager->getRepository(Settings::class)->findOneBy(['id' => 1 ]);

        if ($this->getRequest()->isPost()) {
            $post = array_merge_recursive(
            $this->getRequest()->getPost()->toArray(),
            $this->getRequest()->getFiles()->toArray()
            );

            $form->setData($post);

            if ($form->isValid()) {
                $data = $form->getData();

                $logo = (empty($data['company_logo']['name'])? $settings->getCompanyLogo() : $data['company_logo']['name']);
                $favicon = (empty($data['favicon']['name'])? $settings->getFavicon() : $data['favicon']['name']);

                if (!empty($data['company_logo']['name'] && $data['favicon']['name'])) {
                    $this->setFileNames($data, $this->_dir. DIRECTORY_SEPARATOR);
                }

                try {
                    $settings->setCompanyName($data['company_name']);
                    $settings->setCompanyBrief($data['company_brief']);
                    $settings->setCompanyLogo($logo);
                    $settings->setFavicon($favicon);
                    $settings->setBrandColor($data['brand_color']);
                    $settings->setCpApproval($data['cp_approval']);
                    $settings->setPageTitle($data['page_title']);
                    $settings->setNameEmailer($data['name_emailer']);
                    $settings->setEmailEmailer($data['email_emailer']);
                    $settings->setBirthdayReminder($data['birthday_reminder']);
                    $settings->setSmsEnabled($data['sms_enabled']);
                    $settings->setSmsApi($data['sms_api']);
                    $settings->setKookooApi($data['kookoo_api']);
                    $settings->setCallApi($data['call_api']);
                    $settings->setCreatedBy($user->getId());
                    $this->entityManager->persist($settings);
                    $this->entityManager->flush();
                } catch (Exception $e) {
                    $this->logger->info('Caught exception: ', $e->getMessage(), "\n");
                }

                $log = $this->logManager;
                $log->setlog('Settings Edited', '', $this->authService->getIdentity());

                $this->flashMessenger()->addSuccessMessage('Settings Updated Successfully');
                return $this->redirect()->toRoute('settings', ['action'=>'index']);
            } else {
                $this->logger->info('form validator: ', $form->getMessages(), "\n");
            }
        } else {
            $form->setData(array(
                      'company_name' => $settings->getCompanyName(),
                    'company_brief' => $settings->getCompanyBrief(),
                    'company_logo' => $settings->getCompanyLogo(),
                      'favicon' => $settings->getFavicon(),
                      'brand_color' => $settings->getBrandColor(),
                      'cp_approval' => $settings->getCpApproval(),
                      'page_title' => $settings->getPageTitle(),
                      'name_emailer' => $settings->getNameEmailer(),
                      'email_emailer' => $settings->getEmailEmailer(),
                      'birthday_reminder' => $settings->getBirthdayReminder(),
                      'sms_enabled' => $settings->getSmsEnabled(),
              'sms_api' => $settings->getSmsApi(),
              'kookoo_api' => $settings->getKookooApi(),
              'call_api' => $settings->getCallApi(),
                          ));
        }

        return new ViewModel(['path' => $this->_dir, 'settings' =>$settings, 'form' => $form]);
    }

    protected function setFileNames($data, $path)
    {
        unset($data['submit']);
        if (array_key_exists("company_logo", $data)) {
            if (file_exists($path. DIRECTORY_SEPARATOR . $data['company_logo']['name'])) {
                $this->flashMessenger()->addErrorMessage($data['company_logo']['name'] . ' File already exist');
            } else {
                rename($data['company_logo']['tmp_name'], $path. $data['company_logo']['name']);
                $this->flashMessenger()->addSuccessMessage($data['company_logo']['name'] . ' File Uploaded');
            }
        }
        if (array_key_exists("favicon", $data)) {
            if (file_exists($path. DIRECTORY_SEPARATOR . $data['favicon']['name'])) {
                $this->flashMessenger()->addErrorMessage($data['favicon']['name'] . ' File already exist');
            } else {
                rename($data['favicon']['tmp_name'], $path. $data['favicon']['name']);
                $this->flashMessenger()->addSuccessMessage($data['favicon']['name'] . ' File Uploaded');
            }
        }
    }
}
