<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Role;
use App\Party;
use App\Http\Controllers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
Use Illuminate\Support\Facades\Config;


class PartyController extends Controller {

    public  $param=array();

    public function __construct(){
        //$this->middleware('auth');
        //parent::login_user_details();
    }

    public function party_list(){
        $Party=new Party();
        $InexController = new InexController();

        $keyword='';
        if( (isset($_REQUEST['keyword']))&&(!empty($_REQUEST['keyword'])) ){
            $keyword=$InexController->allow_special_character_in_keyword($_REQUEST['keyword']);
        }
        $all_count=$Party->count_all($keyword);
        $all_list=$Party->select_all(0,$all_count[0]->count,$keyword);
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

    public function party_create(){
        $Party = new Party();

        $Party->set_party_name(trim(ucfirst($_POST['party_name'])));
        $Party->set_party_mobile(trim($_POST['party_mobile']));
        $Party->set_party_contact_person(trim($_POST['party_contact_person']));
        $Party->set_party_address(trim($_POST['party_address']));
        $Party->set_party_city(trim($_POST['party_city']));
        $Party->set_party_state(trim($_POST['party_state']));
        $Party->set_party_pincode(trim($_POST['party_pincode']));
        $Party->set_party_gstin(trim($_POST['party_gstin']));
        $Party->set_party_pan_no(trim($_POST['party_pan_no']));
        $Party->set_party_status('Active');
        $Party->set_party_add_by($_POST['user_id']);
        $Party->set_party_add_date(time());
        $party_id = $Party->insert_party();

        if(!empty($party_id)){
            $res['SUCCESS']='TRUE';
            $res['MESSAGE']='Party added successfully';
        }else{
            $res['SUCCESS']='FALSE';
            $res['MESSAGE']='Error while adding party';
        }
        echo json_encode($res,1);
    }

    public function party_view(){
        $Party = new Party();
        $Party->set_party_id($_POST['party_id']);
        $view_data = $Party->select_by_party_id();
        if(isset($view_data) && !empty($view_data)){
            $res['SUCCESS']='TRUE';
            $res['MESSAGE']='';
            $res['DATA']=$view_data;
        }else{
            $res['SUCCESS']='FALSE';
            $res['MESSAGE']='Invalid request';
        }
        echo json_encode($res,1);
    }

    public function party_edit(){
        $Party = new Party();

        $Party->set_party_id($_POST['party_id']);
        $Party->set_party_name(trim(ucfirst($_POST['party_name'])));
        $Party->set_party_mobile(trim($_POST['party_mobile']));
        $Party->set_party_contact_person(trim($_POST['party_contact_person']));
        $Party->set_party_address(trim($_POST['party_address']));
        $Party->set_party_city(trim($_POST['party_city']));
        $Party->set_party_state(trim($_POST['party_state']));
        $Party->set_party_pincode(trim($_POST['party_pincode']));
        $Party->set_party_gstin(trim($_POST['party_gstin']));
        $Party->set_party_pan_no(trim($_POST['party_pan_no']));
        $Party->set_party_modify_by($_POST['user_id']);
        $Party->set_party_modify_date(time());
        $update_party = $Party->update_party();

        if(!empty($update_party)){
            $res['SUCCESS']='TRUE';
            $res['MESSAGE']='Party updated successfully.';
        }else{
            $res['SUCCESS']='FALSE';
            $res['MESSAGE']='Error while updating party';
        }
        echo json_encode($res,1);
    }

}

