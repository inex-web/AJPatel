<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    public function login_user_details(){

        $User=new User();
        $user_param=array();
        $user_param['name']='';
        $user_param['id']='';
        $user_param['user_role']='';
        $user_param['user_image']=asset(Config::get('constant.DEFAULT_IMAGES_LOCATION').'default-profile-pic.jpg');
        if(Session::has('kz_user_id')){
            $user_id=Session::get('kz_user_id');
            $User->set_user_id($user_id);
            $select_by_user_id = $User->select_by_user_id();

            if(!empty($select_by_user_id[0])){
                if((isset($select_by_user_id[0]->user_image))&&(!empty($select_by_user_id[0]->user_image))&&($select_by_user_id[0]->user_image!="NULL") && file_exists(public_path().Config::get('constant.PROFILE_LOCATION').$select_by_user_id[0]->user_image)){
                    $user_param['user_image']=asset(Config::get('constant.PROFILE_LOCATION').$select_by_user_id[0]->user_image);
                }

                $user_param['name']=ucfirst($select_by_user_id[0]->user_name);
                $user_param['id']=$user_id;
                $user_param['user_role']=$select_by_user_id[0]->user_type;
            }
        
        }
        View::share("user_param",$user_param);
    }
}
