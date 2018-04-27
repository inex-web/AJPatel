<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class AuthenticateApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
		if(isset($_POST['login_token']) && !empty($_POST['login_token'])){
			$User = new User();
			$User->set_user_login_token($_POST['login_token']);
			$user_data = $User->select_by_user_login_token();
			if(isset($user_data) && !empty($user_data)){
				$_POST['user_id'] = $user_data[0]->user_id;
				return $next($request);
			}else{
				$res['SUCCESS']='FALSE';
				$res['MESSAGE']='Login token is mismatched.';
				echo json_encode($res,1);
				exit;
			}
		}else{
			$res['SUCCESS']='FALSE';
			$res['MESSAGE']='Login token is required.';
			echo json_encode($res,1);
			exit;
		}
    }
}
