<?php namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller {

	public $param=array();
	public $response=array();

	public function __construct()
	{
		//$this->middleware('auth');
		//parent::login_user_details();
	}

	public function login(){
		if(isset($_POST['login_email_mob']) && !empty($_POST['login_email_mob']) &&
			isset($_POST['login_password']) && !empty($_POST['login_password'])
		){
			$User = new User();
			$email_mob = trim($_POST['login_email_mob']);
			$password = trim($_POST['login_password']);

			$User->set_fields($email_mob);
			$check_user_for_login = $User->check_user_for_login();
			if(!empty($check_user_for_login)){
				if (Hash::check(trim($password), $check_user_for_login[0]->user_password)) {
					$token = time().$check_user_for_login[0]->user_id;
					$User->set_user_login_token($token);
					$User->set_user_id($check_user_for_login[0]->user_id);
					$User->change_user_login_token();
					
					$User->set_fields(['user_login_token','user_name','user_mobile','user_email']);
					$user_data = $User->select_fields_by_user_id();
					
					$res['SUCCESS']='TRUE';
					$res['MESSAGE']='Login Success';
					$res['user_data']=$user_data;
				}else{
					$res['SUCCESS']='FALSE';
					$res['MESSAGE']='Wrong Credentials.';
				}
			}else{
				$res['SUCCESS']='FALSE';
				$res['MESSAGE']='Wrong Credentials.';
			}

		}else{
			$res['SUCCESS']='FALSE';
			$res['MESSAGE']='Invalid request';
		}
		echo json_encode($res,1);
	}

	public function logout(){
		$User = new User();
		$User->set_user_id($_POST['user_id']);
		$User->set_user_login_token('');
		$User->change_user_login_token();
		
		$res['SUCCESS']='TRUE';
		$res['MESSAGE']='Logout Success';
		echo json_encode($res,1);
    }
	
	public function admin_view(){
        $User = new User();
		$id = $_POST['user_id'];

        if(isset($id) && !empty($id)){
            $User->set_user_id($id);
            $view_data = $User->select_by_user_id();
            
            $res['SUCCESS']='TRUE';
			$res['MESSAGE']='';
			$res['data']=$view_data;
        }else{
            $res['SUCCESS']='FALSE';
			$res['MESSAGE']='Invalid request';
        }
		echo json_encode($res,1);
    }
	
	public function admin_edit(){
        $User = new User();

        $User->set_user_id($_POST['user_id']);
        $User->set_user_name(ucfirst(trim($_POST['name'])));
        $User->set_user_mobile(trim($_POST['mobile']));
        $User->set_user_email(trim($_POST['email']));
        $User->set_user_company(trim($_POST['company']));
        $User->set_user_tagline(trim($_POST['tagline']));
        $User->set_user_address(trim($_POST['address']));
        $User->set_user_city(trim($_POST['city']));
        $User->set_user_state(trim($_POST['state']));
        $User->set_user_pincode(trim($_POST['pincode']));
        $User->set_user_gstin(trim($_POST['gstin']));
        $User->set_user_pan_no(trim($_POST['pan_no']));
        $User->set_user_modified_date(time());
        $update_admin = $User->update_admin();

        if(!empty($update_admin)){
            $res['SUCCESS']='TRUE';
			$res['MESSAGE']='Updated successfully';
        }else{
            $res['SUCCESS']='FALSE';
			$res['MESSAGE']='Error while updating';
        }
		echo json_encode($res,1);
    }

	public function password_change(){
		$User = new User();
		$id = $_POST['user_id'];
		
		$old_password=$_POST['old_password'];
		$new_password=Hash::make($_POST['new_password']);

		$User->set_user_id($id);
		$User->set_fields("user_password");
		$users = $User->select_fields_by_user_id();
		$password_in_db = $users[0]->user_password;

		if(Hash::check($old_password, $password_in_db)){
			$User->set_user_modified_date(time());
			$User->set_user_password($new_password);
			$update_password = $User->update_password();

			$res['SUCCESS']='TRUE';
			$res['MESSAGE']='Password is changed successfully.';
		}else{
			$res['SUCCESS']='FALSE';
			$res['MESSAGE']='Old password not match';
		}
		echo json_encode($res,1);
	}
}