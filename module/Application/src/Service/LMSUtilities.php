<?php
namespace Application\Service;

use Leads\Entity\Leads;
use Masters\Entity\Documents;
use Customers\Entity\Customers;
use Masters\Entity\PreferredLocation;
use Campaigns\Entity\Campaigns;
use Masters\Entity\FollowupTypes;
use Projects\Entity\Projects;
use Masters\Entity\LeadSource;
use Masters\Entity\LeadStatus;
use Leads\Entity\LeadOwners;
use Masters\Entity\VirtualNumber;
use User\Entity\User;
use Application\Entity\Cities;
use Masters\Entity\Amenities;
use Campaigns\Entity\CampaignProjects;

class LMSUtilities
{
    private $entityManager;
    private $authService;

    public function __construct($authService, $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->authService = $authService;
    }


    public function makeDate($string)
    {
        if ($string == 0 || empty($string)) {
            return null;
        } else {
            $string = str_replace("/", "-", $string);
            return \Datetime::createFromFormat('d-m-Y', $string);
        }
    }

    public function makeDBDate($string)
    {
        $string = str_replace(" ", "", $string);
        $dateObj = \DateTime::createFromFormat("d/m/Y", $string);
        $string =  $dateObj->format("Y/m/d");
        return $string;
    }

    public function getArray($string)
    {
        $values = explode(',', $string);
        $array = [];
        foreach ($values as $value) {
            $array[] = $value;
        }
        return $array;
    }

    public function makeString($array)
    {
        if (is_string($array) || empty($array)) {
            return $array;
        } else {
            $string = '';
            foreach ($array as $key => $value) {
                $string .= $value.',';
            }
            return $string;
        }
    }
    
    public function getCustomer($id)
    {
        $customer = $this->entityManager->getRepository(Customers::class)->findOneBy(['id' => $id]);
        return (empty($customer) ? null : $customer->getFirstName().' '.$customer->getLastName());
    }
    
    public function getCustomerFirstName($id)
    {
        $customer = $this->entityManager->getRepository(Customers::class)->findOneBy(['id' => $id]);
        return (empty($customer) ? null : $customer->getFirstName());
    }
    
    public function getCustomerLastName($id)
    {
        $customer = $this->entityManager->getRepository(Customers::class)->findOneBy(['id' => $id]);
        return (empty($customer) ? null : $customer->getLastName());
    }
    
    public function getCustomerContact($id)
    {
        $customer = $this->entityManager->getRepository(Customers::class)->findOneBy(['id' => $id]);
        return (empty($customer) ? null : $customer->getContact());
    }

    public function getCustomerEmail($id)
    {
        $customer = $this->entityManager->getRepository(Customers::class)->findOneBy(['id' => $id]);
        return (empty($customer) ? null : $customer->getEmail());
    }
    
    public function getUser($id)
    {
        $customer = $this->entityManager->getRepository(User::class)->findOneBy(['id' => $id]);
        return (empty($customer) ? null : $customer->getFullName());
    }
    
    public function getDocuments($ids)
    {
        if (empty($ids)) {
            return ;
        } else {
            $array = explode(',', $ids);
            $string = '';
            foreach ($array as $id) {
                $documents = $this->entityManager->getRepository(Documents::class)->findOneBy(['id' => $id]);
                $string .= (empty($documents)?'':$documents->getName().', ');
            }
            return $string;
        }
    }
    
    public function getProjectName($id)
    {
        $project = $this->entityManager->getRepository(Projects::class)->findOneBy(['id' => $id]);
        return (empty($project) ? null : $project->getName());
    }

    public function getBuildingName($id)
    {
        $building = $this->entityManager->getRepository(Buildings::class)->findOneBy(['id' => $id]);
        return (empty($building) ? null : $building->getName());
    }

    public function getLocation($id)
    {
        $location = $this->entityManager->getRepository(PreferredLocation::class)->findOneBy(['id' => $id]);
        return (empty($location) ? null : $location->getName());
    }

    public function getLeadStatus($id)
    {
        $status = $this->entityManager->getRepository(LeadStatus::class)->findOneBy(['id' => $id]);
        return (empty($status) ? null : $status->getName());
    }
	
		public function getLeadStatusCREMA($id)
    {
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_URL => 'https://www.plinthstone.com/MarketingCTIAPI/api/Survey/GetMarketingLeadStatus?leadId='.$id,
		CURLOPT_USERAGENT => 'Plinthstone cURL Request'
		));
		$resp = curl_exec($curl);
		curl_close($curl);
		$obj = json_decode($resp, true);
	   
        return (empty($obj) ? null : $obj[0]['StatusName']);
    }

    public function getCampaign($id)
    {
        $campaign = $this->entityManager->getRepository(Campaigns::class)->findOneBy(['id' => $id]);
        return (empty($campaign) ? null : $campaign->getCampaignName());
    }

    public function getLeadSource($id)
    {
        $source = $this->entityManager->getRepository(LeadSource::class)->findOneBy(['id' => $id], ['id' => 'ASC']);
        return (empty($source) ? null : $source->getName());
    }

    public function getVirtualNumber($id)
    {
        $vnumber = $this->entityManager->getRepository(VirtualNumber::class)->findOneBy(['id' => $id], ['id' => 'ASC']);
        return (empty($vnumber) ? null : $vnumber->getName());
    }
    
    public function getLeadOwners($id)
    {
        $owners = $this->entityManager->getRepository(LeadOwners::class)->findBy(['leadId' => $id]);
        $array = [];
        foreach ($owners as $owner) {
            $array[] = $owner->getOwner();
        }
        return $array;
    }
    
    public function getLeadOwnersName($id)
    {
        $owners = $this->entityManager->getRepository(LeadOwners::class)->findBy(['leadId' => $id]);
        $array = [];

        $lead_owners = '';
        foreach ($owners as $owner) {
            if (!empty($id)) {
                $users = $this->entityManager->getRepository(User::class)->findOneBy(['id' => $owner->getOwner()]);
                $lead_owners .= $users->getFullName().',';
            }
        }
        return rtrim($lead_owners, ',');
    }

    public function getProjects($string)
    {
        $string = rtrim($string, ',');
        $ids = explode(',', $string);
        $new_string = '';
        foreach ($ids as $id) {
            $project = $this->entityManager->getRepository(Projects::class)->findOneBy(['id' => $id]);
            $new_string .= $project->getName().', ';
        }
        $new_string = rtrim($new_string, ', ');
        return $new_string;
    }

    
    public function getCampaignProjects($id = null)
    {
        $campaignproject = $this->entityManager->getRepository(CampaignProjects::class)
                            ->findBy(['campaignId'=>$id]);
        $new_string = '';
        foreach ($campaignproject as $cp) {
            $project = $this->entityManager->getRepository(Projects::class)
                            ->findOneBy(['id'=>$cp->getProjectId()]);
            $new_string .= $project->getName().', ';
        }
        $new_string = rtrim($new_string, ', ');
        return $new_string;
    }
    
    public function getCampaignLeads($id = null)
    {
        $leads = $this->entityManager->getRepository(Leads::class)
                            ->findBy(['campaign'=>$id]);
        return count($leads);
    }
    
    public function getCampaignSitevisits($id = null)
    {
        $leads = $this->entityManager->getRepository(Leads::class)
                            ->findBy(['visited'=>1,'campaign'=>$id]);
        return count($leads);
    }

    //SELECT LIST DATA

    public function getStatesList($id = null)
    {
        $query = $this->entityManager->createQuery('SELECT c FROM Application\Entity\Cities c group by c.state order by c.state');
        $states = $query->getResult();
        $state_list = [];
        $state_list[0] = 'Select';
        foreach ($states as $state) {
            $state_list[$state->getId()] = $state->getState();
        }
        return $state_list;
    }

    public function getCityList($id = 0)
    {
        $citi = $this->entityManager->getRepository(Cities::class)
                            ->findOneBy(['id'=>$id]);
        $state = (empty($citi)?'0':$citi->getState());
        $query = $this->entityManager->createQuery('SELECT c FROM Application\Entity\Cities c where c.state like :state order by c.name');
        $query->setParameter('state', '%'.$state.'%');
        $cities = $query->getResult();
        $cities_list = [];
        foreach ($cities as $city) {
            $cities_list[$city->getId()] = $city->getName();
        }
        return $cities_list;
    }

    public function flatConfigurationList()
    {
        $flat_list = ['1'=>'1 BHK','2'=>'2 BHK','3'=>'3 BHK','4'=>'4 BHK',];

        return $flat_list;
    }

    public function leadStatusList()
    {
        $leads = $this->entityManager->getRepository(LeadStatus::class)->findBy([], ['name' => 'ASC']);

        $lead_list = [];
        $lead_list[0] = 'Select';
        foreach ($leads as $lead) {
            $lead_list[$lead->getID()] = $lead->getName();
        }

        return $lead_list;
    }

    public function ownersList()
    {
        $users = $this->entityManager->getRepository(User::class)->findBy([], ['fullName' => 'ASC']);

        $user_list = [];
        foreach ($users as $user) {
            $user_list[$user->getID()] = $user->getFullName();
        }

        return $user_list;
    }

    public function LeadSourceList()
    {
        $lead_sources = $this->entityManager->getRepository(LeadSource::class)->findBy([], ['name' => 'ASC']);

        $lead_source_list = [];
        foreach ($lead_sources as $lead_source) {
            $lead_source_list[$lead_source->getID()] = $lead_source->getName();
        }

        return $lead_source_list;
    }

    public function campaignsList()
    {
        $campaigns = $this->entityManager->getRepository(Campaigns::class)->findBy([], ['campaignName' => 'ASC']);

        $campaign_list = [];
        foreach ($campaigns as $campaign) {
            $campaign_list[$campaign->getID()] = $campaign->getCampaignName();
        }

        return $campaign_list;
    }

    public function yearList()
    {
        $min_year = 2017;
        $max_year = 2050;
        $location_list = [];
        for ($i = $min_year; $i <= $max_year; $i++) {
            $location_list[$i] = $i;
        }

        return $location_list;
    }

    public function projectsList()
    {
        $projects = $this->entityManager->getRepository(Projects::class)->findBy([], ['name' => 'ASC']);

        $project_list = [];
        foreach ($projects as $project) {
            $project_list[$project->getID()] = $project->getName();
        }

        return $project_list;
    }

    public function locationsList()
    {
        $locations = $this->entityManager->getRepository(PreferredLocation::class)->findBy([], ['name' => 'ASC']);

        $location_list = [];
        foreach ($locations as $location) {
            $location_list[$location->getID()] = $location->getName();
        }

        return $location_list;
    }

    public function followupsList()
    {
        $FollowupTypes = $this->entityManager->getRepository(FollowupTypes::class)->findBy([], ['name' => 'ASC']);

        $touchpoint_list = [];
        $touchpoint_list[0] = 'Select';
        foreach ($FollowupTypes as $touchpoint) {
            $touchpoint_list[$touchpoint->getID()] = $touchpoint->getName();
        }

        return $touchpoint_list;
    }

    public function VirtualNumbersList()
    {
        $numbers = $this->entityManager->getRepository(VirtualNumber::class)->findBy([], ['id' => 'ASC']);
        $number_list = [];
        foreach ($numbers as $number) {
            $number_list[$number->getID()] = $number->getName();
        }
        return $number_list;
    }


    public function usersList()
    {
        $users = $this->entityManager->getRepository(User::class)->findAll();
        $users_list = [];
        foreach ($users as $user) {
            $users_list[$user->getID()] = $user->getFullName();
        }
        return $users_list;
    }

    public function internalAmenitiesList()
    {
        $internal_amenities = $this->entityManager->getRepository(Amenities::class)
                   ->findBy(['type'=>1,'status'=>1], ['name'=>'ASC']);

        $internal_amenities_list = array();
        foreach ($internal_amenities as $internal_amenity) {
            $internal_amenities_list[$internal_amenity->getID()] = $internal_amenity->getName();
        }
        return $internal_amenities_list;
    }


    public function externalAmenitiesList()
    {
        $external_amenities = $this->entityManager->getRepository(Amenities::class)
                  ->findBy(['type'=>2,'status'=>1], ['name'=>'ASC']);

        $external_amenities_list = array();
        foreach ($external_amenities as $external_amenity) {
            $external_amenities_list[$external_amenity->getID()] = $external_amenity->getName();
        }
        return $external_amenities_list;
    }

    
    public function getJson($url, $post = null)
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
}
