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
            'text' => 'Dashboard',
            'route' => 'home',
            'icon' => 'bx bxs-dashboard'
        ];

        $menus[] = [
            'text' => 'Users',
            'route' => 'users',
            'icon' => 'bx bxs-user'
        ];

        $menus[] = [
            'text' => 'Companies',
            'route' => 'company-list',
            'icon' => 'bx bxs-building'
        ];

        $menus[] = [
            'text' => 'Globals',
            'route' => '#has-submenu',
            'icon' => 'bx bxs-cog',
            'submenus' => [
                [ 'text' => 'Address List', 'route' => 'address-list'],
                [ 'text' => 'Customer Chain', 'route' => 'customer-chain'],
                [ 'text' => 'Customer Channel', 'route' => 'customer-channel'],
                [ 'text' => 'Customer Type', 'route' => 'customer-type'],
                [ 'text' => 'UOM', 'route' => 'global-uom'],
            ]
        ];

        $menus[] = [
            'text' => 'Admin Globals',
            'route' => '#has-submenu',
            'icon' => 'bx bx-globe',
            'submenus' => [
                [ 'text' => 'Admin Chart of Accounts', 'route' => 'admin-chart-of-accounts'],
                [ 'text' => 'Admin Account Group', 'route' => 'admin-coa-account-group'],
                [ 'text' => 'Admin Report Group', 'route' => 'admin-coa-report-group'],
                [ 'text' => 'Admin Cost Center', 'route' => 'admin-cost-center'],
            ]
        ];

        return $menus;
    }

    public static function administrator($user) {
        $menus[] = [
            'text' => 'Dashboard',
            'route' => 'home',
            'icon' => 'bx bxs-dashboard'
        ];

        $menus[] = [
            'text' => 'Users',
            'route' => 'users',
            'icon' => 'bx bxs-user'
        ];

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
                [ 'text' => 'Ordering', 'route' => 'main-purchase-order'],
                [ 'text' => 'Receiving', 'route' => 'supplier-main'],
                [ 'text' => 'Returns', 'route' => 'customer-main'],
                [ 'text' => 'Billing', 'route' => 'employee-main'],
                [ 'text' => 'Payment', 'route' => 'project-main']
            ]
        ];


        $menus[] = [
            'text' => 'Sell and Collect',
            'route' => '#has-submenu',
            'icon' => 'bx bx-purchase-tag',
            'submenus' => [
                [ 'text' => 'Ordering', 'route' => 'item-main'],
                [ 'text' => 'Fulfillment', 'route' => 'supplier-main'],
                [ 'text' => 'Invoicing', 'route' => 'customer-main'],
                [ 'text' => 'Reversal', 'route' => 'employee-main'],
                [ 'text' => 'Collection', 'route' => 'project-main'],
            ]
        ];

        $menus[] = [
            'text' => 'Inventory',
            'route' => '#has-submenu',
            'icon' => 'bx bx-package',
            'submenus' => [
                [ 'text' => 'Inventory Movement', 'route' => 'item-main'],
                [ 'text' => 'Price Rule', 'route' => 'supplier-main']
            ]
        ];

        $menus[] = [
            'text' => 'Accounting',
            'route' => '#has-submenu',
            'icon' => 'bx bxs-report',
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
            'icon' => 'bx bx-bar-chart-square',
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