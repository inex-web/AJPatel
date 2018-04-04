<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use mPDF;
use App\Party;
use App\User;
use App\Invoice;
use App\InvoiceItem;
use App\Http\Controllers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
Use Illuminate\Support\Facades\Config;


class InvoiceController extends Controller {

    public  $param=array();

    public function __construct(){
        //$this->middleware('auth');
        parent::login_user_details();
    }

    public function invoice_list(){
        $Invoice=new Invoice();

        $keyword = '';
        $InexController = new InexController();
        if( (isset($_REQUEST['keyword']))&&(!empty($_REQUEST['keyword'])) ){
            $keyword=$InexController->allow_special_character_in_keyword($_REQUEST['keyword']);
        }
        $all_count=$Invoice->count_all($keyword);
        $all_list=$Invoice->select_all(0,$all_count[0]->count,$keyword);

        if(isset($all_list) && !empty($all_list)){
            $res['SUCCESS']='TRUE';
            $res['MESSAGE']='';
            $res['DATA']=$all_list;
        }else{
            $res['SUCCESS']='FALSE';
            $res['MESSAGE']='Invalid request';
        }
        echo json_encode($res,1);
    }

    public function invoice_create(){
        $Invoice = new Invoice();
        $InvoiceItem = new InvoiceItem();
        $Party = new Party();
        $User = new User();

        $party_id = null;
        $party_name = $party_contact_person = $party_mobile = $party_address = $party_city = $party_state = $party_pincode = $party_gstin = $party_pan_no = '';
        if(isset($_POST['party_id']) && !empty($_POST['party_id'])){
            $party_id = $_POST['party_id'];
            $Party->set_party_id($party_id);
            $select_by_party_id = $Party->select_by_party_id();
            if(!empty($select_by_party_id)){
                $party_name = $select_by_party_id[0]->party_name;
                $party_contact_person = $select_by_party_id[0]->party_contact_person;
                $party_mobile = $select_by_party_id[0]->party_mobile;
                $party_address = $select_by_party_id[0]->party_address;
                $party_city = $select_by_party_id[0]->party_city;
                $party_state = $select_by_party_id[0]->party_state;
                $party_pincode = $select_by_party_id[0]->party_pincode;
                $party_gstin = $select_by_party_id[0]->party_gstin;
                $party_pan_no = $select_by_party_id[0]->party_pan_no;
            }
        }

        $owner_company = $owner_name = $owner_email = $owner_mobile = $owner_address = $owner_city = $owner_state = $owner_pincode = $owner_gstin = $owner_pan_no = '';
        $User->set_user_id($_POST['user_id']);
        $select_by_owner_id = $User->select_by_user_id();
        if(!empty($select_by_owner_id)){
            $owner_company = $select_by_owner_id[0]->user_company;
            $owner_name = $select_by_owner_id[0]->user_name;
            $owner_email = $select_by_owner_id[0]->user_email;
            $owner_mobile = $select_by_owner_id[0]->user_mobile;
            $owner_address = $select_by_owner_id[0]->user_address;
            $owner_city = $select_by_owner_id[0]->user_city;
            $owner_state = $select_by_owner_id[0]->user_state;
            $owner_pincode = $select_by_owner_id[0]->user_pincode;
            $owner_gstin = $select_by_owner_id[0]->user_gstin;
            $owner_pan_no = $select_by_owner_id[0]->user_pan_no;
        }

        if(isset($_POST['invoice_date']) && !empty($_POST['invoice_date'])){
            $invoice_date = strtotime($_POST['invoice_date']);
        }else{
            $invoice_date = '';
        }

        if(isset($_POST['is_challan']) && !empty($_POST['is_challan'])){
            $is_challan = $_POST['is_challan'];
        }else{
            $is_challan = 'No';
        }

        if(isset($_POST['round_of']) && !empty($_POST['round_of'])){
            $round_of = $_POST['round_of'];
        }else{
            $round_of = 0;
        }

        $Invoice->set_invoice_owner_company($owner_company);
        $Invoice->set_invoice_owner_name($owner_name);
        $Invoice->set_invoice_owner_email($owner_email);
        $Invoice->set_invoice_owner_mobile($owner_mobile);
        $Invoice->set_invoice_owner_address($owner_address);
        $Invoice->set_invoice_owner_city($owner_city);
        $Invoice->set_invoice_owner_state($owner_state);
        $Invoice->set_invoice_owner_pincode($owner_pincode);
        $Invoice->set_invoice_owner_gstin($owner_gstin);
        $Invoice->set_invoice_owner_pan_no($owner_pan_no);

        $Invoice->set_invoice_number(trim($_POST['invoice_number']));
        $Invoice->set_invoice_party_id($party_id);
        $Invoice->set_invoice_party_name($party_name);
        $Invoice->set_invoice_party_contact_person($party_contact_person);
        $Invoice->set_invoice_party_mobile($party_mobile);
        $Invoice->set_invoice_party_address($party_address);
        $Invoice->set_invoice_party_city($party_city);
        $Invoice->set_invoice_party_state($party_state);
        $Invoice->set_invoice_party_pincode($party_pincode);
        $Invoice->set_invoice_party_gstin($party_gstin);
        $Invoice->set_invoice_party_pan_no($party_pan_no);
        $Invoice->set_invoice_date($invoice_date);

        $Invoice->set_invoice_truck_no(trim($_POST['truck_no']));
        $Invoice->set_invoice_transport(trim($_POST['transport']));
        $Invoice->set_invoice_l_r_no(trim($_POST['l_r_no']));
        $Invoice->set_invoice_delivery_note('');
        $Invoice->set_invoice_round_of_on_total($round_of);
        $Invoice->set_invoice_total(0);

        $Invoice->set_invoice_bank_name('');
        $Invoice->set_invoice_bank_ac_no('');
        $Invoice->set_invoice_bank_branch('');
        $Invoice->set_invoice_bank_ifsc('');
        $Invoice->set_invoice_is_challan($is_challan);
        $Invoice->set_invoice_pdf('');

        $Invoice->set_invoice_status('Active');
        $Invoice->set_invoice_add_by($_POST['user_id']);
        $Invoice->set_invoice_add_date(time());
        $invoice_id = $Invoice->insert_invoice();
        if(!empty($invoice_id)){
            $grand_total=0;
            if(isset($_POST['ii_json_data']) && !empty($_POST['ii_json_data']) && $_POST['ii_json_data']!='[]'){
                $ii_json_data_arr = json_decode($_POST['ii_json_data'],1);
                foreach ($ii_json_data_arr as $single) {
                    $InvoiceItem->set_ii_invoice_id($invoice_id);
                    $InvoiceItem->set_ii_product_name($single['ii_product_name']);
                    $InvoiceItem->set_ii_hsn_no($single['ii_hsn_no']);
                    $InvoiceItem->set_ii_rate($single['ii_rate']);
                    $InvoiceItem->set_ii_qnt($single['ii_qnt']);
                    $InvoiceItem->set_ii_unit($single['ii_unit']);
                    $InvoiceItem->set_ii_cgst($single['ii_cgst']);
                    $InvoiceItem->set_ii_sgst($single['ii_sgst']);
                    $InvoiceItem->set_ii_igst($single['ii_igst']);
                    $InvoiceItem->insert_invoice_item();

                    $sub_total = floatval($single['ii_rate']) * floatval($single['ii_qnt']);
                    $igst_amt = $sub_total * floatval($single['ii_igst'])/100;
                    $cgst_amt = $sub_total * floatval($single['ii_cgst'])/100;
                    $sgst_amt = $sub_total * floatval($single['ii_sgst'])/100;
                    $single_product_total = $sub_total + $igst_amt + $cgst_amt + $sgst_amt;

                    $grand_total = $grand_total+$single_product_total;
                }
            }
            $grand_total = $grand_total+$round_of;

            $Invoice->set_invoice_id($invoice_id);
            $Invoice->set_invoice_total($grand_total);
            $Invoice->update_total();

            $pdf_file_name = $this->invoice_pdf_create($invoice_id);
            if(!empty($pdf_file_name)){
                $Invoice->set_invoice_id($invoice_id);
                $Invoice->set_invoice_pdf($pdf_file_name);
                $Invoice->update_pdf();                
            }

            $res['SUCCESS']='TRUE';
            $res['MESSAGE']='Invoice added successfully';
        }else{
            $res['SUCCESS']='FALSE';
            $res['MESSAGE']='Error while adding invoice';
        }

        echo json_encode($res,1);
    }

    public function invoice_view(){
        $Invoice = new Invoice();
        $InvoiceItem = new InvoiceItem();

        $Invoice->set_invoice_id($_POST['invoice_id']);
        $view_data = $Invoice->select_by_invoice_id();
        if(!empty($view_data)){
            $InvoiceItem->set_ii_invoice_id($_POST['invoice_id']);
            $invoice_item_data = $InvoiceItem->select_item_by_invoice_id();

            if(!empty($view_data[0]->invoice_pdf) && file_exists(public_path().Config::get('constant.DOWNLOAD_PDF_LOCATION').$view_data[0]->invoice_pdf)){
                $view_data[0]->invoice_pdf = asset(Config::get('constant.DOWNLOAD_PDF_LOCATION').$view_data[0]->invoice_pdf);
            }else{
                $view_data[0]->invoice_pdf='';
            }
            $view_data[0]->invoice_item_data=$invoice_item_data;

            $res['SUCCESS']='TRUE';
            $res['MESSAGE']='';
            $res['DATA']=$view_data;
        }else{
            $res['SUCCESS']='FALSE';
            $res['MESSAGE']='Invalid request';
        }

        echo json_encode($res,1);
    }

    public function invoice_pdf_create($invoice_id){
        $Invoice = new Invoice();
        $InvoiceItem = new InvoiceItem();

        $Invoice->set_invoice_id($invoice_id);
        $view_data = $Invoice->select_by_invoice_id();
        if(!empty($view_data)){
            $InvoiceItem->set_ii_invoice_id($invoice_id);
            $invoice_item_data = $InvoiceItem->select_item_by_invoice_id();
            
            $this->param['invoice_data']=$view_data;
            $this->param['invoice_item_data']=$invoice_item_data;
            $this->param['date_formate']=Config::get('constant.DATE_FORMATE');
            $this->param['assets']=asset('');

            $html = view('invoice/print_pdf', $this->param)->render();

            $mpdf = new mPDF('win-1252','A4','','',5,5,10,5,5,5);
            $pdf_file = 'invc_'.time().'.pdf';
            $pdf_file_path = public_path().Config::get('constant.DOWNLOAD_PDF_LOCATION').$pdf_file;
            $pdf_file_url = asset(Config::get('constant.DOWNLOAD_PDF_LOCATION').$pdf_file);
            $mpdf->SetProtection(array('print'));
            $mpdf->SetDisplayMode('fullpage');
            $mpdf->WriteHTML($html);
            $mpdf->Output($pdf_file_path,'F'); // F-download, I-print

            return $pdf_file;
        }else{
            return '';
        }
    }

}

