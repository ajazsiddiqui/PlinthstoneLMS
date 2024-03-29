<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use User\Entity\User;
use Leads\Entity\Leads;
use Zend\View\Model\JsonModel;
use Application\Entity\Cities;
use Notifications\Entity\SmsTemplates;
use Notifications\Entity\EmailTemplates;

/**
 * This is the main controller class of the User Demo application. It contains
 * site-wide actions such as Home or About.
 */
class APIController extends AbstractActionController
{
    private $entityManager;
    private $LMSUtilities;

    public function __construct($entityManager, $LMSUtilities)
    {
        $this->entityManager = $entityManager;
        $this->LMSUtilities = $LMSUtilities;
    }
	
	public function submitLeadsAction(){
		$array =[];
		$get = $_GET;
		$name = $get['name'] ?? '';
		$email = $get['email'] ?? '';
		$phone = $get['phone'] ?? '';
		$configuration = $get['configuration'] ?? '';
		$property = $get['property'] ?? 25;
	
		switch ($property) {
		  case 25:
			$url = 'https://shatrunjay.com/thank-you';
			break;
		  case 26:
			$url = 'https://estado.life/thank-you';
			break;
		  case 27:
			$url = 'https://codename-superlife.com/thank-you';
			break;
		case 719:
			$url = 'https://passcodebiglife.com/thank-you';
			break;
		  default:
			echo "";
		}
		
		if(empty($name) || empty($email)){
			$array['message'] = 'error';
			return new JsonModel($array);
		}
		
		$lead = new Leads();
		$lead->setFirstName($name);
		$lead->setLastName('');
		$lead->setContact($phone);
		$lead->setEmail($email);
		$lead->setState(0);
		$lead->setCity(0);
		$lead->setLocation(0);
		$lead->setConfiguration($configuration);
		$lead->setProject($property);
		$lead->setCampaign(10);
		$lead->setSource(10);
		$lead->setStatus(1);
		$lead->setInterested(1);
		$lead->setRemarks('');
		$lead->setCreatedBy(1);
		$this->entityManager->persist($lead);
		$this->entityManager->flush();
		
		$array['message'] = 'sent';
		
		if((int)$lead->getProject() == 719){
			$this->sendToBLOX($lead,$get);
		}
		return $this->redirect()->toUrl($url);
		
		//return new JsonModel($array);
	}
	
	public function sendToBLOX($lead, $get){

		$post_fields = [
			'first_name'=>$lead->getFirstName(),
			'last_name'=>'',
			'contact'=>$lead->getContact(),
			'email'=>$lead->getEmail(),
			'configuration'=>$lead->getConfiguration(),
			'project'=>719,
			'source'=>'microsite',
			'utm_source'=>$get['utm_source'] ?? '',
			'utm_medium'=>$get['utm_medium'] ?? '',
			'utm_campaign'=>$get['utm_campaign'] ?? '',
			'utm_term'=>$get['utm_term'] ?? '',
			'utm_adgroup'=>$get['utm_adgroup'] ?? '',
			'placement'=>$get['placement'] ?? '',
			'utm_content'=>'',
			'referer'=>'',
			'email_verified'=>'',
			'contact_verified'=>'',
			'city'=>'',
			'budget_min'=>'',
			'budget_max'=>'',
			'pincode'=>'',
			'comment'=>''
		];

		$curl = curl_init();
			$ua = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/525.13 (KHTML, like Gecko) Chrome/0.A.B.C Safari/525.13';
			curl_setopt_array($curl, array(
			CURLOPT_URL => "https://blox.xyz/webhooks/marketingleads",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_VERBOSE => true,
			CURLOPT_USERAGENT => $ua,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => $post_fields,
			CURLOPT_SSL_VERIFYHOST => 0,
			CURLOPT_SSL_VERIFYPEER => 0,
		  CURLOPT_HTTPHEADER => array(
			'Authorization: Bearer 40|RVDStNmH4O7A2BIpGGeasavhv9EttSdrQZvOjhMD',
		  )
		));

		$response = curl_exec($curl);
		
//		if(curl_errno($curl))
	//		echo 'Curl error: '.curl_error($curl);

		//print_r($response);die();
		curl_close($curl);
		
		return;
	}

	public function citiesAction(){
		$id = $this->params()->fromRoute('id');
		$state = $this->entityManager->getRepository(Cities::class)
        ->findOneBy(['id'=>$id]);
		$cities = $this->entityManager->getRepository(Cities::class)
        ->findBy(['state'=>$state->getState()]);
		
		$array =[];
		foreach ($cities as $city){
			$array[$city->getId()] = $city->getName();
		}
		return new JsonModel($array);
	}
	
	public function smstemplatesAction(){
		$id = $this->params()->fromRoute('id');
		$template = $this->entityManager->getRepository(SmsTemplates::class)
        ->findOneBy(['id'=>$id]);		

			$array[0] = $template->getContent();

		return new JsonModel($array);
	}
	
	public function emailtemplatesAction(){
		$id = $this->params()->fromRoute('id');
		$template = $this->entityManager->getRepository(EmailTemplates::class)
        ->findOneBy(['id'=>$id]);		

		$array[0] = $template->getContent();

		return new JsonModel($array);
	}
	
	public function leadsAction()
    {
		$id = $this->params()->fromRoute('id');

		$query = $this->entityManager->createQueryBuilder()->select('l')
                  ->from('Leads\Entity\Leads', 'l');
		
		if(!empty($id)){
			$query->where('l.id > :id')
                  ->setParameter('id', $id);
		}
		$leads = $query->getQuery()->getResult();
	
		$array =[];
		$i = 0;
		foreach ($leads as $lead){
			$array[$i]['id'] = (int) $lead->getId();
			$array[$i]['first_name'] = $lead->getFirstName();
			$array[$i]['last_name'] = $lead->getLastName();
			$array[$i]['email'] = $lead->getEmail();
			
			$contact =	preg_replace('/[^0-9]/', '', $lead->getContact());
			$array[$i]['contact'] =  $contact;
			$array[$i]['configuration'] = (int) $lead->getConfiguration();
			$array[$i]['source'] = (int) $lead->getSource();
			$array[$i]['project'] = (int) $lead->getProject();
			$array[$i]['date_created'] = $lead->getDateCreated();
			$i++;
			
			
		}
	
		return new JsonModel($array);
	}
    public function facebookAction()
    {
        // Create a new cURL resource
        $curl = curl_init();

        if (!$curl) {
            die("Couldn't initialize a cURL handle");
        }

        // Set the file URL to fetch through cURL
        curl_setopt($curl, CURLOPT_URL, "https://sheets.googleapis.com/v4/spreadsheets/19wbqHMlyBdBDZuyWPutBKjw8_Vd50WMmzcVbjvw1ATo/values/Sheet1?key=AIzaSyCU8gALFT-Ne5Yy56OveiFXB0YuIbcX2DA");

        // Set a different user agent string (Googlebot)
        // curl_setopt($curl, CURLOPT_USERAGENT, 'Googlebot/2.1 (+http://www.google.com/bot.html)');

        // Follow redirects, if any
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

        // Fail the cURL request if response code = 400 (like 404 errors)
        curl_setopt($curl, CURLOPT_FAILONERROR, true);

        // Return the actual result of the curl result instead of success code
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        // Wait for 10 seconds to connect, set 0 to wait indefinitely
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);

        // Execute the cURL request for a maximum of 50 seconds
        curl_setopt($curl, CURLOPT_TIMEOUT, 50);

        // Do not check the SSL certificates
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        // Fetch the URL and save the content in $html variable
        $html = curl_exec($curl);

        // Check if any error has occurred
        if (curl_errno($curl)) {
            $data['cURL error']=curl_error($curl);
            return new JsonModel($data);
        } else {
            $data = (array) json_decode($html);
            
            curl_close($curl);
            return new JsonModel($data);
        }
    }
}
