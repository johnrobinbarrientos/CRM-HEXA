<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\BDCustomerDiscount; 


class BDCustomerDiscountController extends Controller
{
    static public function check($discounts)
    {
        $errors = 0;
        foreach ($discounts as $key => $discount) {

            $discount['name_error'] = false;
            $discount['rate_error'] = false;

            if (empty($discount['name'])) {
                $discount['name_error'] = true;
                $discount['edit'] = true;
                $errors++;
            }

            if (empty($discount['rate'])) {
                $discount['rate_error'] = true;
                $discount['edit'] = true;
                $errors++;
            }

            $discounts[$key] = $discount;
        }

        return ['discounts' => $discounts, 'errors' => $errors];
    }
    

    static public function save($bd_customer_uuid,$discounts)
    {
        foreach ($discounts as $key => $discount) {

            $uuid = $discount['uuid'];
            $name = $discount['name'];
            $rate = $discount['rate'];
            
            $data = BDCustomerDiscount::where('uuid','=',$uuid)->first();
            $data = ($data) ? $data : new  BDCustomerDiscount;
            $data->bd_customer_uuid = $bd_customer_uuid;
            $data->name = $name;
            $data->rate = $rate;
            $data->save();
        }
    }
}