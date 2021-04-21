<?php
namespace Application\Service;

/**
 * This service is responsible for determining which items should be in the main menu.
 * The items may be different depending on whether the user is authenticated or not.
 */
class NavManager
{
    /**
     * Auth service.
     * @var Zend\Authentication\Authentication
     */
    private $authService;

    /**
     * Url view helper.
     * @var Zend\View\Helper\Url
     */
    private $urlHelper;

    /**
     * RBAC manager.
     * @var User\Service\RbacManager
     */
    private $rbacManager;
    private $translator;

    /**
     * Constructs the service.
     */
    public function __construct($authService, $urlHelper, $rbacManager, $translator)
    {
        $this->authService = $authService;
        $this->urlHelper = $urlHelper;
        $this->rbacManager = $rbacManager;
        $this->translator = $translator;
    }

    /**
     * This method returns menu items depending on whether user has logged in or not.
     */
    public function getMenuItems()
    {
        $url = $this->urlHelper;
        $items = [];

        $items[] = [
            'id' => 'home',
            'label' => $this->translator->translate('Dashboard'),
            'link'  => $url('home')
        ];

        // Display "Login" menu item for not authorized user only. On the other hand,
        // display "Admin" and "Logout" menu items only for authorized users.
        if (!$this->authService->hasIdentity()) {
            $items[] = [
                'id' => 'login',
                'label' => $this->translator->translate('Sign in'),
                'link'  => $url('login'),
                'float' => 'right'
            ];
        } else {
            if ($this->rbacManager->isGranted(null, 'folders.manage')) {
                $items[] = [
                            'id' => 'file_manager',
                            'label' => $this->translator->translate('File Manager'),
                            'link' => $url('folders', ['action'=>'index'])
                        ];
            }

            if ($this->rbacManager->isGranted(null, 'projects.manage')) {
                $items[] = [
                            'id' => 'projects',
                            'label' => $this->translator->translate('Projects'),
                            'link' => $url('projects', ['action'=>'index'])
                        ];
            }
            
            if ($this->rbacManager->isGranted(null, 'campaign.manage')) {
                $items[] = [
                    'id' => 'campaigns',
                    'label' => $this->translator->translate('Campaigns'),
                    'link'  => $url('campaign', ['action'=>'index'])
                ];
            }
        
            $leadsDropdownItems = [];

            if ($this->rbacManager->isGranted(null, 'leads.manage')) {
                $leadsDropdownItems[] = [
                            'id' => 'leads-manage',
                            'label' => $this->translator->translate('Leads'),
                            'link' => $url('leads', ['action'=>'index'])
                        ];
            }

            if ($this->rbacManager->isGranted(null, 'followups.manage')) {
                $leadsDropdownItems[] = [
                    'id' => 'followups',
                    'label' => $this->translator->translate('FollowUps'),
                    'link' =>$url('followups', ['action'=>'index'])
                        ];
                $leadsDropdownItems[] = [
                    'id' => 'telephony',
                    'label' => $this->translator->translate('Telephony'),
                    'link'  => $url('telephony', ['action'=>'index'])
                ];
            }


            if ($this->rbacManager->isGranted(null, 'walkins.manage')) {
                $leadsDropdownItems[] = [
                        'id' => 'walkins',
                        'label' => $this->translator->translate('Walkins'),
                        'link' =>$url('walkins', ['action'=>'index'])
                        ];
            }

            if (count($leadsDropdownItems)!=0) {
                $items[] = [
                    'id' => 'leads',
                    'label' => $this->translator->translate('Leads'),
                    'dropdown' => $leadsDropdownItems
                ];
            }

            $masterDropdownItems = [];

            if ($this->rbacManager->isGranted(null, 'masters.manage')) {
                $masterDropdownItems[] = [
                            'id' => 'amenities',
                            'label' => $this->translator->translate('Manage Amenities'),
                            'link' => $url('amenities', ['action'=>'index'])
                        ];
            }


            if ($this->rbacManager->isGranted(null, 'masters.manage')) {
                $masterDropdownItems[] = [
                            'id' => 'lead_source',
                            'label' => $this->translator->translate('Lead Source'),
                            'link' => $url('lead-source', ['action'=>'index'])
                        ];
            }

            if ($this->rbacManager->isGranted(null, 'masters.manage')) {
                $masterDropdownItems[] = [
                            'id' => 'lead_status',
                            'label' => $this->translator->translate('Lead Status'),
                            'link' => $url('lead-status', ['action'=>'index'])
                        ];
            }

            if ($this->rbacManager->isGranted(null, 'masters.manage')) {
                $masterDropdownItems[] = [
                            'id' => 'preferred_location',
                            'label' => $this->translator->translate('Preferred Location'),
                            'link' => $url('preferred-location', ['action'=>'index'])
                        ];
            }

            if ($this->rbacManager->isGranted(null, 'masters.manage')) {
                $masterDropdownItems[] = [
                            'id' => 'system_usertype',
                            'label' => $this->translator->translate('System Usertype'),
                            'link' => $url('system-usertype', ['action'=>'index'])
                        ];
            }

            if ($this->rbacManager->isGranted(null, 'masters.manage')) {
                $masterDropdownItems[] = [
                            'id' => 'transaction_interest',
                            'label' => $this->translator->translate('Transaction Interest'),
                            'link' => $url('transaction-interest', ['action'=>'index'])
                        ];
            }
            if ($this->rbacManager->isGranted(null, 'masters.manage')) {
                $masterDropdownItems[] = [
                            'id' => 'virtual_number',
                            'label' => $this->translator->translate('Virtual Number'),
                            'link' => $url('virtual-number', ['action'=>'index'])
                        ];
            }
            if ($this->rbacManager->isGranted(null, 'masters.manage')) {
                $masterDropdownItems[] = [
                            'id' => 'followup_types',
                            'label' => $this->translator->translate('Followup Types'),
                            'link' => $url('followup-types', ['action'=>'index'])
                        ];
            }

            if (count($masterDropdownItems)!=0) {
                $items[] = [
                    'id' => 'masters',
                    'label' => $this->translator->translate('Masters'),
                    'dropdown' => $masterDropdownItems
                ];
            }


            // Determine which items must be displayed in Admin dropdown.
            $adminDropdownItems = [];

            if ($this->rbacManager->isGranted(null, 'user.manage')) {
                $adminDropdownItems[] = [
                            'id' => 'users',
                            'label' => $this->translator->translate('Manage Users'),
                            'link' => $url('users')
                        ];
            }

            if ($this->rbacManager->isGranted(null, 'permission.manage')) {
                $adminDropdownItems[] = [
                            'id' => 'permissions',
                            'label' => $this->translator->translate('Manage Permissions'),
                            'link' => $url('permissions')
                        ];
            }

            if ($this->rbacManager->isGranted(null, 'role.manage')) {
                $adminDropdownItems[] = [
                            'id' => 'roles',
                            'label' => $this->translator->translate('Manage Roles'),
                            'link' => $url('roles')
                        ];
            }

            if ($this->rbacManager->isGranted(null, 'settings.manage')) {
                $adminDropdownItems[] = [
                            'id' => 'email_templates',
                            'label' => $this->translator->translate('Email Templates'),
                            'link' => $url('emailtemplates', ['action'=>'index'])
                        ];
            }

            if ($this->rbacManager->isGranted(null, 'settings.manage')) {
                $adminDropdownItems[] = [
                            'id' => 'sms_templates',
                            'label' => $this->translator->translate('SMS Templates'),
                            'link' => $url('smstemplates', ['action'=>'index'])
                        ];
            }

            if ($this->rbacManager->isGranted(null, 'settings.manage')) {
                $adminDropdownItems[] = [
                            'id' => 'settings',
                            'label' => $this->translator->translate('Manage Settings'),
                            'link' => $url('settings')
                        ];
            }

            if ($this->rbacManager->isGranted(null, 'settings.manage')) {
                $adminDropdownItems[] = [
                            'id' => 'logs',
                            'label' => $this->translator->translate('System Logs'),
                            'link' => $url('logs')
                        ];
            }

            if (count($adminDropdownItems)!=0) {
                $items[] = [
                    'id' => 'settings',
                    'label' => $this->translator->translate('Settings'),
                    'dropdown' => $adminDropdownItems
                ];
            }


            if ($this->rbacManager->isGranted(null, 'reports.manage')) {
                $items[] = [
                'id' => 'reports',
                'label' => $this->translator->translate('Reports'),
                'link'  => $url('reports', ['action'=>'index'])
            ];
            }
          
            $items[] = [
                'id' => 'logout',
                'label' => $this->authService->getIdentity(),
                'float' => 'right',
                'dropdown' => [
                    [
                        'id' => 'settings',
                        'label' => $this->translator->translate('Settings'), //change Menu.php for icon
                        'link' => $url('application', ['action'=>'settings'])
                    ],
                    [
                        'id' => 'logout',
                        'label' => $this->translator->translate('Sign out'),  //change Menu.php for icon
                        'link' => $url('logout')
                    ],
                ]
            ];
        }



        return $items;
    }
}
