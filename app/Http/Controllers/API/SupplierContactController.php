<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\Models\SupplierContact; 
use Illuminate\Support\Facades\Auth; 

class SupplierContactController extends Controller
{

    public function getContactsBySupplier($supplierUUID)
    {
        $list = SupplierContact::where('supplier_uuid','=',$supplierUUID)->whereNull('deleted_at')->get();
        return response()->json(['success' => 1, 'rows' => $list], 200);
    }

    static public function check($contacts)
    {
        $errors = 0;
        foreach ($contacts as $key => $contact) {

            $contact['contact_no_error'] = false;
            $contact['contact_person_error'] = false;


            if (empty($contact['contact_no'])) {
                $contact['contact_no_error'] = true;
                $errors++;
            }

            if (empty($contact['contact_person'])) {
                $contact['contact_person_error'] = true;
                $errors++;
            }


            $contacts[$key] = $contact;
        }

        return ['contacts' => $contacts, 'errors' => $errors];
    }

    static public function save($supplier_uuid,$contacts)
    {
        foreach ($contacts as $key => $contact) {

            $uuid = $contact['uuid'];
            $contact_person = $contact['contact_person'];
            $position = $contact['position'];
            $email_address = $contact['email_address'];
            $contact_no = $contact['contact_no'];
            $deleted_at = $contact['deleted_at'];
    
            
            if ($deleted_at == null){
                $data = SupplierContact::where('uuid','=',$uuid)->first();
                $data = ($data) ? $data : new  SupplierContact;
                $data->supplier_uuid = $supplier_uuid;
                $data->contact_person = $contact_person;
                $data->position = $position;
                $data->email_address = $email_address;
                $data->contact_no = $contact_no;
                $data->save();
            }
            else {
                $data = SupplierContact::find($uuid)->delete(); 
            }
            
            
        }
    }


    public function delete($supplierUUID,$contactUUID) {
        
        $contactUUID = SupplierContact::find($contactUUID)->delete();

        return response()->json(['success' => 1, 'message' => 'Deleted!'], 200);
    }
}