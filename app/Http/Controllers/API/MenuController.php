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
        } else { 
            return self::user($user);
        }
    }

    public static function super() {
        $menus = [];

        $menus[] = [
            'text' => 'DASHBOARD',
            'route' => 'home',
            'icon' => 'icon ni ni-dashboard'
        ];

        $menus[] = [
            'text' => 'USERS',
            'route' => 'users',
            'icon' => 'icon ni ni-user-c'
        ];

        $menus[] = [
            'text' => 'COMPANIES',
            'route' => 'company-list',
            'icon' => 'icon ni ni-building'
        ];

        $menus[] = [
            'text' => 'GLOBALS',
            'route' => '#has-submenu',
            'icon' => 'icon ni ni-db-fill',
            'submenus' => [
                [ 'text' => 'Address List', 'route' => 'address-list'],
                [ 'text' => 'Customer Chain', 'route' => 'customer-chain'],
                [ 'text' => 'Customer Channel', 'route' => 'customer-channel'],
                [ 'text' => 'Customer Type', 'route' => 'customer-type'],
            ]
        ];

        $menus[] = [
            'text' => 'ADMIN GLOBALS',
            'route' => '#has-submenu',
            'icon' => 'icon ni ni-db-fill',
            'submenus' => [
                [ 'text' => 'Admin Chart of Accounts', 'route' => 'admin-chart-of-accounts'],
                [ 'text' => 'Admin Account Group', 'route' => 'admin-coa-account-group'],
                [ 'text' => 'Admin Report Group', 'route' => 'admin-coa-report-group'],
                [ 'text' => 'Admin Cost Center', 'route' => 'admin-cost-center'],
            ]
        ];

        return $menus;
    }

    public static function user($user) {
        $menus = [];

        if ($user->type == 'Administrator') {

            $menus[] = [
                'text' => 'DASHBOARD',
                'route' => 'home',
                'icon' => 'icon ni ni-dashboard'
            ];

            $menus[] = [
                'text' => 'USERS',
                'route' => 'users',
                'icon' => 'icon ni ni-user-c'
            ];

        
            $menus[] = [
                'text' => $user->company->name,
                'route' => 'companies',
                'icon' => 'icon ni ni-building'
            ];

        }
        

        $menus[] = [
            'text' => 'Masterdata',
            'route' => '#has-submenu',
            'icon' => 'icon ni ni-db-fill',
            'submenus' => [
                [ 'text' => 'Item', 'route' => 'item-main'],
                [ 'text' => 'Supplier', 'route' => 'supplier-main'],
                [ 'text' => 'Customer', 'route' => 'customer-main'],
                [ 'text' => 'Employee', 'route' => 'employee-main'],
                [ 'text' => 'Project', 'route' => 'project-main'],
                [ 'text' => 'Company', 'route' => 'company-main'],
                [ 'text' => 'Address List', 'route' => 'address-list'],
            ]
        ];


        $menus[] = [
            'text' => 'Buy and Pay',
            'route' => '#has-submenu',
            'icon' => 'icon ni ni-money',
            'submenus' => [
                [ 'text' => 'Ordering', 'route' => 'item-main'],
                [ 'text' => 'Receiving', 'route' => 'supplier-main'],
                [ 'text' => 'Returns', 'route' => 'customer-main'],
                [ 'text' => 'Billing', 'route' => 'employee-main'],
                [ 'text' => 'Payment', 'route' => 'project-main']
            ]
        ];


        $menus[] = [
            'text' => 'Sell and Collect',
            'route' => '#has-submenu',
            'icon' => 'icon ni ni-coins',
            'submenus' => [
                [ 'text' => 'Ordering', 'route' => 'item-main'],
                [ 'text' => 'Fulfillment', 'route' => 'supplier-main'],
                [ 'text' => 'Invoicing', 'route' => 'customer-main'],
                [ 'text' => 'Reversal', 'route' => 'employee-main'],
                [ 'text' => 'Collection', 'route' => 'project-main'],
            ]
        ];

        $menus[] = [
            'text' => 'Stock',
            'route' => '#has-submenu',
            'icon' => 'icon ni ni-package',
            'submenus' => [
                [ 'text' => 'Stock Entry', 'route' => 'item-main'],
                [ 'text' => 'Price Rule', 'route' => 'supplier-main']
            ]
        ];

        $menus[] = [
            'text' => 'Accounting',
            'route' => '#has-submenu',
            'icon' => 'icon ni ni-report-profit',
            'submenus' => [
                [ 'text' => 'Reconcile Bank', 'route' => 'item-main'],
                [ 'text' => 'Reconcile Cash Fund', 'route' => 'supplier-main'],
                [ 'text' => 'Maintain Fixed Asset', 'route' => 'customer-main'],
                [ 'text' => 'Make Payroll', 'route' => 'employee-main'],
                [ 'text' => 'Make Adjustment', 'route' => 'project-main']
            ]
        ];

        $menus[] = [
            'text' => 'Financial Report',
            'route' => '#has-submenu',
            'icon' => 'icon ni ni-reports',
            'submenus' => [
                [ 'text' => 'Bank Reconciliation', 'route' => 'item-main'],
                [ 'text' => 'Funds Reconciliation', 'route' => 'supplier-main'],
                [ 'text' => 'Lapsing Schedule', 'route' => 'customer-main'],
                [ 'text' => 'Payroll Summary', 'route' => 'employee-main'],
                [ 'text' => 'Journal and Ledger', 'route' => 'project-main'],
                [ 'text' => 'Profit & Loss', 'route' => 'company-main'],
                [ 'text' => 'Balance Sheet', 'route' => 'address-list'],
            ]
        ];

        return $menus;
    }

}