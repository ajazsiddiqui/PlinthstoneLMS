<?php
namespace Bookings\Service;

use Bookings\Entity\Bookings;
use User\Entity\User;
use Leads\Entity\Leads;
use Customers\Entity\Customers;
use Projects\Entity\Flats;

class BookingsService
{
    
    /**
     * Doctrine entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;
    private $authService;
    
    public function __construct($authService, $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->authService = $authService;
    }
    
    
    public function addBooking($id)
    {
        $lead = $this->entityManager->getRepository(Leads::class)->findOneBy(['id'=>$id]);
        $customer = $this->entityManager->getRepository(Customers::class)->findOneBy(['id'=>$lead->getCustomerId()]);
        $flat = $this->entityManager->getRepository(Flats::class)->findOneBy(['id'=>$lead->getFlat()]);
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $this->authService->getIdentity() ], ['id' => 'ASC']);
        
        $bookings = $this->entityManager->getRepository(Bookings::class)->findOneBy(['leadId'=>$id]);
        
        if (empty($bookings)) {
            $bookings = new Bookings();
        }
        $bookings->setLeadId($id);
        $bookings->setCustomerType($lead->getCustomerType());
        
        $bookings->setFirstName($customer->getFirstName());
        $bookings->setLastName($customer->getLastName());
        $bookings->setMobile($customer->getContact());
        $bookings->setAlternateNumber($customer->getAlternateNumber());
        $bookings->setEmail($customer->getEmail());

        $bookings->setDateOfBirth($this->makeDate($customer->getBirthDate()));
        
        $bookings->setBookingDate(new \DateTime());
        $bookings->setProjectId($lead->getProject());
        $bookings->setBuildingId($lead->getBuilding());
        $bookings->setFlatNo($lead->getFlat());
        
        if (!empty($flat)) {
            $bookings->setFlatType($flat->getFlatType());
            $bookings->setSaleableArea($flat->getFlatArea());
            $bookings->setFinalFloorRise($flat->getFloorRise());
            $bookings->setDevelopmentCharges($flat->getDevCharges());
            $bookings->setClubMembership($flat->getClubMembershipCharges());
            $bookings->setParkingCharges($flat->getParkingCharges());
            $bookings->setAdvanceMantainance($flat->getAdvanceMaintanance());
            $bookings->setTotalAmount($flat->getTotalCost());
        }
        $bookings->setBookingUser($user->getId());
        $bookings->setCreatedBy($user->getId());

        $this->entityManager->persist($bookings);
        $this->entityManager->flush();
    }
    
    public function makeDate($string)
    {
        if ($string == 0 || empty($string)) {
            return null;
        } else {
            return \Datetime::createFromFormat('d-m-Y', $string);
        }
    }
}
