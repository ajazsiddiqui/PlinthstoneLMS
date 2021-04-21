<?php

namespace Notifications\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Notifications\Entity\Notifications;
use User\Entity\User;
use Leads\Entity\Leads;
use Settings\Entity\Settings;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use Notifications\Entity\SmsTemplates;
use Notifications\Entity\EmailTemplates;

class NotificationsController extends AbstractActionController
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
    }

    public function sendsmsAction()
    {
        $smstemplates = $this->entityManager->getRepository(SmsTemplates::class)
                   ->findBy([], ['id'=>'DESC']);


        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();

            $settings = $this->entityManager->getRepository(Settings::class)->findOneBy(['id' => 1 ]);
            $api = $settings->getSmsApi();

            $output = preg_replace_callback(
                '~\{(.*?)\}~',
                        function ($key) use ($data) {
                            $variable['mobile'] = $data['contact'];
                            $variable['message'] = $data['message'];
                            return $variable[$key[1]];
                        },
                        $api
            );

            $message = $this->getHtml($output);
            return $this->redirect()->toRoute('leads', ['action' => 'index']);
        } else {
            $id = (int)$this->params()->fromRoute('id', -1);
            if ($id<1) {
                $this->getResponse()->setStatusCode(404);
                return;
            }
            $lead = $this->entityManager->getRepository(Leads::class)->findOneBy(['id' => $id]);

            $contact = $lead->getContact();

            $user = $this->entityManager->getRepository(User::class)
               ->findOneBy(['email'=>$this->authService->getIdentity()], ['id'=>'ASC']);

            $this->flashMessenger()->addSuccessMessage('SMS Sent');
            return new ViewModel(['templates' => $smstemplates, 'contact' => $contact]);
        }
    }

    public function getHtml($url, $post = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        if (!empty($post)) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        }
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function sendemailAction()
    {
        $emailtemplates = $this->entityManager->getRepository(EmailTemplates::class)
                   ->findBy([], ['id'=>'ASC']);


        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();

            $lead = $this->entityManager->getRepository(Leads::class)->findOneBy(['id' => $data['lead_id']]);
            $user = $this->entityManager->getRepository(User::class)
               ->findOneBy(['email'=>$this->authService->getIdentity()], ['id'=>'ASC']);

            $settings = $this->entityManager->getRepository(Settings::class)->findOneBy(['id' => 1 ]);
            $sender_name = $settings->getNameEmailer();
            $sender_email = $settings->getEmailEmailer();

            $reciever_email = $data['email'];
            
            $message = $data['message'];

            $emailtemplate = $this->entityManager->getRepository(EmailTemplates::class)
                   ->findOneBy(['id'=>$data['emailtemplate']]);
            $subject =  $emailtemplate->getSubject();

            try {
                $mail = new PHPMailer(true);
                //Server settings
            //$mail->SMTPDebug = 3;
            $mail->IsSMTP(); // enable SMTP
            $mail->Host =  gethostbyname("smtp.gmail.com");
                $mail->SMTPAuth = true;
                $mail->Username = 'phonicworld2017@gmail.com';
                $mail->Password = 'phonic@123';
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;
                $mail->SMTPOptions = array(
            'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            )
            );
                //Recipients
                $mail->setFrom($sender_email, $sender_name);
                $mail->addAddress($reciever_email);   // Add a recipient

                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = $subject;

                $output = preg_replace_callback(
                '~\{(.*?)\}~',
                        function ($key) use ($user, $lead) {
                            $variable['first_name'] = $lead->getFirstName();
                            $variable['last_name'] = $lead->getLastName();
                            $variable['project_name'] = $lead->getProject();
                            $variable['building_name'] = $lead->getProject();
                            $variable['system_user_name'] = $user->getFullName();
                            return $variable[$key[1]];
                        },
                        $message
            );

                $mail->Body    = $output;
                //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            }

            return $this->redirect()->toRoute('leads', ['action' => 'index']);
        } else {
            $id = (int)$this->params()->fromRoute('id', -1);

            if ($id<1) {
                $this->getResponse()->setStatusCode(404);
                return;
            }

            $lead = $this->entityManager->getRepository(Leads::class)->findOneBy(['id' => $id]);
            $email = $lead->getEmail();
            $lead_id = $lead->getId();

            $user = $this->entityManager->getRepository(User::class)
               ->findOneBy(['email'=>$this->authService->getIdentity()], ['id'=>'ASC']);

            $this->flashMessenger()->addSuccessMessage('Email Sent');
            return new ViewModel(['lead_id' => $lead_id, 'templates' => $emailtemplates, 'email' => $email]);
        }
    }
}
