<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\User;
use App\Models\CompanyList; 

use Illuminate\Support\Facades\Auth; 

class MenuController extends Controller
{
    public function index()
    {
        $user = User::with('companylist')->find(Auth::id());
        
        if (!$user) {
            return response()->json(['success' => 0, $menus => []], 200);
        }

        $menus = self::getMenus($user);

        return response()->json(['success' => 1, 'menus' => $menus], 200);
    }

    public static function getMenus($user) {
        if ($user->type === 'Super Admin') {
            return self::super();
        } else if ($user->type === 'Admin') { 
            return self::administrator($user);
        } else { 
            return self::user($user);
        }
    }

    public static function super() {
        $menus = [];

        $menus[] = [
            'text' => 'Masterdata',
            'route' => '#has-submenu',
            'icon' => 'bx bx-data',
            'submenus' => [
                [ 'text' => 'Employee', 'route' => 'employee-main'],
                [ 'text' => 'Supplier', 'route' => 'supplier-main'],
                [ 'text' => 'Customer', 'route' => 'customer-main'],
                [ 'text' => 'Item', 'route' => 'item-main'],
                [ 'text' => 'Project', 'route' => 'project-main'], 
            ]
        ];


        $menus[] = [
            'text' => 'Buy and Pay',
            'route' => '#has-submenu',
            'icon' => 'bx bx-money',
            'submenus' => [
                [ 'text' => 'Ordering', 'route' => 'buy-and-pay-orders'],
                [ 'text' => 'Receiving', 'route' => 'buy-and-pay-receipts'],
                [ 'text' => 'Billing & Return', 'route' => 'buy-and-pay-bills'],
                [ 'text' => 'Payment', 'route' => 'main']
            ]
        ];


        $menus[] = [
            'text' => 'Sell and Collect',
            'route' => '#has-submenu',
            'icon' => 'bx bx-purchase-tag',
            'submenus' => [
                [ 'text' => 'Ordering', 'route' => 'main'],
                [ 'text' => 'Fulfillment', 'route' => 'main'],
                [ 'text' => 'Invoicing & Reversal', 'route' => 'main'],
                [ 'text' => 'Collection', 'route' => 'main']
            ]
        ];

        $menus[] = [
            'text' => 'Inventory',
            'route' => '#has-submenu',
            'icon' => 'bx bx-package',
            'submenus' => [
                [ 'text' => 'Inventory Movement', 'route' => 'main'],
                [ 'text' => 'Price Rule', 'route' => 'price-rule-main']
            ]
        ];

        $menus[] = [
            'text' => 'Accounting',
            'route' => '#has-submenu',
            'icon' => 'bx bxs-report',
            'submenus' => [
                [ 'text' => 'Reconcile Bank', 'route' => 'main'],
                [ 'text' => 'Reconcile Cash Fund', 'route' => 'main'],
                [ 'text' => 'Maintain Fixed Asset', 'route' => 'main'],
                [ 'text' => 'Make Payroll', 'route' => 'main'],
                [ 'text' => 'Make Adjustment', 'route' => 'main']
            ]
        ];

        $menus[] = [
            'text' => 'Financial Report',
            'route' => '#has-submenu',
            'icon' => 'bx bx-bar-chart-square',
            'submenus' => [
                [ 'text' => 'Bank Reconciliation', 'route' => 'main'],
                [ 'text' => 'Funds Reconciliation', 'route' => 'main'],
                [ 'text' => 'Lapsing Schedule', 'route' => 'main'],
                [ 'text' => 'Payroll Summary', 'route' => 'main'],
                [ 'text' => 'Journal and Ledger', 'route' => 'main'],
                [ 'text' => 'Profit & Loss', 'route' => 'main'],
                [ 'text' => 'Balance Sheet', 'route' => 'main'],
            ]
        ];


        $menus[] = [
            'text' => 'Settings',
            'route' => '#has-submenu',
            'icon' => 'bx bx-cog',
            'submenus' => [
                [ 'text' => 'Company', 'route' => 'company-main'],
            ]
        ];

        $menus[] = [
            'text' => 'Globals',
            'route' => '#has-submenu',
            'icon' => 'bx bx-globe',
            'submenus' => [
                [ 'text' => 'Address List', 'route' => 'global-address-list'],
                [ 'text' => 'Customer Chain', 'route' => 'global-customer-chain'],
                [ 'text' => 'Customer Channel', 'route' => 'global-customer-channel'],
                [ 'text' => 'Customer Type', 'route' => 'global-customer-type'],
                [ 'text' => 'Cost Center', 'route' => 'global-cost-center'],
                [ 'text' => 'UOM', 'route' => 'global-uom'],
            ]
        ];

        $menus[] = [
            'text' => 'Super Admin',
            'route' => '#has-submenu',
            'icon' => 'bx bxs-cog',
            'submenus' => [
                [ 'text' => 'Chart of Accounts', 'route' => 'admin-chart-of-accounts'],
                [ 'text' => 'Account Group', 'route' => 'admin-coa-account-group'],
                [ 'text' => 'Report Group', 'route' => 'admin-coa-report-group'],
                [ 'text' => 'Cost Center', 'route' => 'admin-cost-center'],
                [ 'text' => 'Company List', 'route' => 'company-list'],
                [ 'text' => 'Users', 'route' => 'users'],
            ]
        ];

        return $menus;
    }


    public static function administrator($user) {
        $menus = [];

        $menus[] = [
            'text' => 'Masterdata',
            'route' => '#has-submenu',
            'icon' => 'bx bx-data',
            'submenus' => [
                [ 'text' => 'Employee', 'route' => 'employee-main'],
                [ 'text' => 'Supplier', 'route' => 'supplier-main'],
                [ 'text' => 'Customer', 'route' => 'customer-main'],
                [ 'text' => 'Item', 'route' => 'item-main'],
                [ 'text' => 'Project', 'route' => 'project-main'], 
            ]
        ];


        $menus[] = [
            'text' => 'Buy and Pay',
            'route' => '#has-submenu',
            'icon' => 'bx bx-money',
            'submenus' => [
                [ 'text' => 'Ordering', 'route' => 'buy-and-pay-orders'],
                [ 'text' => 'Receiving', 'route' => 'buy-and-pay-receipts'],
                [ 'text' => 'Billing & Return', 'route' => 'buy-and-pay-bills'],
                [ 'text' => 'Payment', 'route' => 'main']
            ]
        ];


        $menus[] = [
            'text' => 'Sell and Collect',
            'route' => '#has-submenu',
            'icon' => 'bx bx-purchase-tag',
            'submenus' => [
                [ 'text' => 'Ordering', 'route' => 'main'],
                [ 'text' => 'Fulfillment', 'route' => 'main'],
                [ 'text' => 'Invoicing & Reversal', 'route' => 'main'],
                [ 'text' => 'Collection', 'route' => 'main']
            ]
        ];

        $menus[] = [
            'text' => 'Inventory',
            'route' => '#has-submenu',
            'icon' => 'bx bx-package',
            'submenus' => [
                [ 'text' => 'Inventory Movement', 'route' => 'main'],
                [ 'text' => 'Price Rule', 'route' => 'price-rule-main']
            ]
        ];

        $menus[] = [
            'text' => 'Accounting',
            'route' => '#has-submenu',
            'icon' => 'bx bxs-report',
            'submenus' => [
                [ 'text' => 'Reconcile Bank', 'route' => 'main'],
                [ 'text' => 'Reconcile Cash Fund', 'route' => 'main'],
                [ 'text' => 'Maintain Fixed Asset', 'route' => 'main'],
                [ 'text' => 'Make Payroll', 'route' => 'main'],
                [ 'text' => 'Make Adjustment', 'route' => 'main']
            ]
        ];

        $menus[] = [
            'text' => 'Financial Report',
            'route' => '#has-submenu',
            'icon' => 'bx bx-bar-chart-square',
            'submenus' => [
                [ 'text' => 'Bank Reconciliation', 'route' => 'main'],
                [ 'text' => 'Funds Reconciliation', 'route' => 'main'],
                [ 'text' => 'Lapsing Schedule', 'route' => 'main'],
                [ 'text' => 'Payroll Summary', 'route' => 'main'],
                [ 'text' => 'Journal and Ledger', 'route' => 'main'],
                [ 'text' => 'Profit & Loss', 'route' => 'main'],
                [ 'text' => 'Balance Sheet', 'route' => 'main'],
            ]
        ];

        // $menus[] = [
        //     'text' => 'Users',
        //     'route' => 'users',
        //     'icon' => 'bx bxs-user'
        // ];

        $menus[] = [
            'text' => 'Settings',
            'route' => '#has-submenu',
            'icon' => 'bx bx-cog',
            'submenus' => [
                [ 'text' => 'Company', 'route' => 'company-main'],
            ]
        ];

        return $menus;
    }

    public static function user($user) {
        $menus = [];

        $menus[] = [
            'text' => 'Masterdata',
            'route' => '#has-submenu',
            'icon' => 'bx bx-data',
            'submenus' => [
                [ 'text' => 'Employee', 'route' => 'employee-main'],
                [ 'text' => 'Supplier', 'route' => 'supplier-main'],
                [ 'text' => 'Customer', 'route' => 'customer-main'],
                [ 'text' => 'Item', 'route' => 'item-main'],
                [ 'text' => 'Project', 'route' => 'project-main'], 
            ]
        ];


        $menus[] = [
            'text' => 'Buy and Pay',
            'route' => '#has-submenu',
            'icon' => 'bx bx-money',
            'submenus' => [
                [ 'text' => 'Ordering', 'route' => 'buy-and-pay-orders'],
                [ 'text' => 'Receiving', 'route' => 'buy-and-pay-receipts'],
                [ 'text' => 'Billing & Return', 'route' => 'buy-and-pay-bills'],
                [ 'text' => 'Payment', 'route' => 'project-main']
            ]
        ];


        $menus[] = [
            'text' => 'Sell and Collect',
            'route' => '#has-submenu',
            'icon' => 'bx bx-purchase-tag',
            'submenus' => [
                [ 'text' => 'Ordering', 'route' => 'main'],
                [ 'text' => 'Fulfillment', 'route' => 'main'],
                [ 'text' => 'Invoicing & Reversal', 'route' => 'main'],
                [ 'text' => 'Collection', 'route' => 'main']
            ]
        ];

        $menus[] = [
            'text' => 'Inventory',
            'route' => '#has-submenu',
            'icon' => 'bx bx-package',
            'submenus' => [
                [ 'text' => 'Inventory Movement', 'route' => 'item-main'],
                [ 'text' => 'Price Rule', 'route' => 'price-rule-main']
            ]
        ];

        $menus[] = [
            'text' => 'Accounting',
            'route' => '#has-submenu',
            'icon' => 'bx bxs-report',
            'submenus' => [
                [ 'text' => 'Reconcile Bank', 'route' => 'main'],
                [ 'text' => 'Reconcile Cash Fund', 'route' => 'main'],
                [ 'text' => 'Maintain Fixed Asset', 'route' => 'main'],
                [ 'text' => 'Make Payroll', 'route' => 'main'],
                [ 'text' => 'Make Adjustment', 'route' => 'main']
            ]
        ];

        $menus[] = [
            'text' => 'Financial Report',
            'route' => '#has-submenu',
            'icon' => 'bx bx-bar-chart-square',
            'submenus' => [
                [ 'text' => 'Bank Reconciliation', 'route' => 'main'],
                [ 'text' => 'Funds Reconciliation', 'route' => 'main'],
                [ 'text' => 'Lapsing Schedule', 'route' => 'main'],
                [ 'text' => 'Payroll Summary', 'route' => 'main'],
                [ 'text' => 'Journal and Ledger', 'route' => 'main'],
                [ 'text' => 'Profit & Loss', 'route' => 'main'],
                [ 'text' => 'Balance Sheet', 'route' => 'main'],
            ]
        ];

        


        return $menus;
    }

}