<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Role;
use App\User;
use App\Http\Controllers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
Use Illuminate\Support\Facades\Config;


class AdminController extends Controller {

    public  $param=array();

    public function __construct(){
        //$this->middleware('auth');
        parent::login_user_details();
    }

    public function admin_list(){
        $this->param['page_title']='Admin List';
        //$this->param['login_user_id']=Auth::user()->id;
        $this->param['date_formate']=Config::get('constant.DATE_FORMATE');
        return view('admin/list', $this->param);
    }

    public function admin_list_post(){
        $User=new User();
        $InexController = new InexController();
        $login_user_id = Session::get('kz_user_id');

        $user_count=0;
        $page=0;
        $current_page=1;
        $adjacents=5;
        $rows='10';
        $keyword='';

        if( (isset($_REQUEST['rows']))&&(!empty($_REQUEST['rows'])) ){
            $rows=$_REQUEST['rows'];
        }
        if( (isset($_REQUEST['keyword']))&&(!empty($_REQUEST['keyword'])) ){
            $keyword=$InexController->allow_special_character_in_keyword($_REQUEST['keyword']);
        }
        if( (isset($_REQUEST['current_page']))&&(!empty($_REQUEST['current_page'])) ){
            $current_page=$_REQUEST['current_page'];
        }
        $start=($current_page-1)*$rows;
        $end=$rows;

        $User->set_user_type('Admin');
        $all_count=$User->count_all($keyword);
        $all_list=$User->select_all($start,$end,$keyword);

        if( (isset($all_count[0]->count))&&(!empty($all_count[0]->count)) ){
            $user_count=$all_count[0]->count;
            $page=$user_count/$rows;
            $page=ceil($page);
        }
        $keyword=$InexController->remove_special_character_in_keyword($keyword);
        $sr_start=0;
        if($user_count>=1){
            $sr_start=(($current_page-1)*$rows)+1;
        }
        $sr_end=($current_page)*$rows;
        if($user_count<=$sr_end){
            $sr_end=$user_count;
        }

        $this->param['user_count']=$user_count;
        $this->param['page']=$page;
        $this->param['current_page']=$current_page;
        $this->param['adjacents']=$adjacents;
        $this->param['rows']=$rows;
        $this->param['keyword']=$keyword;
        $this->param['sr_start']=$sr_start;
        $this->param['sr_end']=$sr_end;
        $this->param['InexController']=$InexController;

        $this->param['login_user_id']=$login_user_id;
        $this->param['all_list']=$all_list;
        $this->param['date_formate']=Config::get('constant.DATE_FORMATE');
        return view('admin.partial.list_post', $this->param);
    }

    public function admin_create(){
        $this->param['page_title']='Add Admin';
        return view('admin/create', $this->param);
    }

    public function admin_create_post(){
        $User = new User();

        $User->set_user_name(trim(ucfirst($_POST['first_name'])));
        $User->set_user_mobile(trim($_POST['mobile']));
        $User->set_user_email(trim($_POST['email']));
        $User->set_user_password(Hash::make($_POST['password']));

        $User->set_user_address(trim($_POST['address']));
        $User->set_user_city(trim($_POST['city']));
        $User->set_user_state(trim($_POST['state']));
        $User->set_user_pincode(trim($_POST['pincode']));
        $User->set_user_gstin(trim($_POST['gstin']));
        $User->set_user_pan_no(trim($_POST['pan_no']));

        $User->set_user_type('Admin');
        $User->set_user_status('Active');
        $User->set_user_add_by(Session::get('kz_user_id'));
        $User->set_user_add_date(time());
        $user_id = $User->insert_user();

        if(!empty($user_id)){
            Session::put('SUCCESS','TRUE');
            Session::put('MESSAGE', 'Admin added successfully.');
            return Redirect::route('admin_view',[$user_id]);
        }else{
            Session::put('SUCCESS','FALSE');
            Session::put('MESSAGE', 'Error while adding admin.');
            return Redirect::route('admin_list');
        }
    }

    public function unique_email(){
        $User = new User();

        if(isset($_POST['email']) && !empty($_POST['email'])){
            $User->set_user_id($_POST['user_id']);
            $User->set_user_email($_POST['email']);
            $unique_email = $User->unique_email();

            if( (isset($unique_email) && !empty($unique_email) && $unique_email[0]->user_id>0) ){
                echo '0';
            }else{
                echo '1';
            }
        }
    }

    public function unique_mobile(){
        $User = new User();

        if(isset($_POST['mobile']) && !empty($_POST['mobile'])){
            $User->set_user_id($_POST['user_id']);
            $User->set_user_mobile($_POST['mobile']);
            $unique_mobile = $User->unique_mobile();

            if( (isset($unique_mobile) && !empty($unique_mobile) && $unique_mobile[0]->user_id>0) ){
                echo '0';
            }else{
                echo '1';
            }
        }
    }

    public function admin_view($id){
        $User = new User();

        if(isset($id) && !empty($id)){
            $User->set_user_id($id);
            $view_data = $User->select_by_user_id();

            $this->param['page_title']='Admin Details';
            $this->param['admin_view_data']=$view_data;
            $this->param['date_formate']=Config::get('constant.DATE_FORMATE');

            if((isset($view_data[0]->user_image))&&(!empty($view_data[0]->user_image))&&($view_data[0]->user_image!="NULL") && file_exists(public_path().Config::get('constant.PROFILE_LOCATION').$view_data[0]->user_image)){
                $this->param['profile_picture_url']=asset(Config::get('constant.PROFILE_LOCATION').$view_data[0]->user_image);
            }else{
                $this->param['profile_picture_url']=asset(Config::get('constant.DEFAULT_IMAGES_LOCATION').'default-profile-pic.jpg');
            }

            return view('admin/view', $this->param);
        }else{
            Session::put('SUCCESS','FALSE');
            Session::put('MESSAGE','Invalid request');
            return Redirect::route('admin_list');
        }
    }

    public function admin_edit($id){
        $User = new User();

        $User->set_user_id($id);
        $select_for_edit = $User->select_by_user_id();

        $this->param['page_title'] = 'Edit Admin';
        $this->param['select_for_edit'] = $select_for_edit;
        return view('admin.edit',$this->param);
    }

    public function admin_edit_post(){
        $User = new User();

        $User->set_user_id($_POST['id']);
        $User->set_user_name(ucfirst(trim($_POST['first_name'])));
        $User->set_user_mobile(trim($_POST['mobile']));
        $User->set_user_email(trim($_POST['email']));
        $User->set_user_address(trim($_POST['address']));
        $User->set_user_city(trim($_POST['city']));
        $User->set_user_state(trim($_POST['state']));
        $User->set_user_pincode(trim($_POST['pincode']));
        $User->set_user_gstin(trim($_POST['gstin']));
        $User->set_user_pan_no(trim($_POST['pan_no']));
        $User->set_user_modified_date(time());
        $update_admin = $User->update_admin();

        if(!empty($update_admin)){
            Session::put('SUCCESS','TRUE');
            Session::put('MESSAGE', 'Admin updated successfully.');
            return Redirect::route('admin_view',[$_POST['id']]);
        }else{
            Session::put('SUCCESS','FALSE');
            Session::put('MESSAGE', 'Error while updating admin.');
            return Redirect::route('admin_list');
        }
    }

}

