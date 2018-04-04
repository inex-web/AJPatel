<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Role;
use App\Product;
use App\Http\Controllers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
Use Illuminate\Support\Facades\Config;


class ProductController extends Controller {

    public  $param=array();

    public function __construct(){
        //$this->middleware('auth');
        //parent::login_user_details();
    }

    public function product_list(){
        $Product=new Product();
        $InexController = new InexController();

        $keyword='';
        if( (isset($_REQUEST['keyword']))&&(!empty($_REQUEST['keyword'])) ){
            $keyword=$InexController->allow_special_character_in_keyword($_REQUEST['keyword']);
        }
        $all_count=$Product->count_all($keyword);
        $all_list=$Product->select_all(0,$all_count[0]->count,$keyword);
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

    public function product_create(){
        $Product = new Product();

        $Product->set_product_name(trim(ucfirst($_POST['product_name'])));
        $Product->set_product_hsn_no(trim($_POST['product_hsn_no']));
        $Product->set_product_rate(trim($_POST['product_rate']));
        $Product->set_product_unit(trim($_POST['product_unit']));
        $Product->set_product_cgst(trim($_POST['product_cgst']));
        $Product->set_product_sgst(trim($_POST['product_sgst']));
        $Product->set_product_igst(trim($_POST['product_igst']));
        $Product->set_product_status('Active');
        $Product->set_product_add_by($_POST['user_id']);
        $Product->set_product_add_date(time());
        $product_id = $Product->insert_product();

        if(!empty($product_id)){
            $res['SUCCESS']='TRUE';
            $res['MESSAGE']='Product added successfully';
        }else{
            $res['SUCCESS']='FALSE';
            $res['MESSAGE']='Error while adding product';
        }
        echo json_encode($res,1);
    }

    public function product_edit(){
        $Product = new Product();

        $Product->set_product_id($_POST['product_id']);
        $Product->set_product_name(trim(ucfirst($_POST['product_name'])));
        $Product->set_product_hsn_no(trim($_POST['product_hsn_no']));
        $Product->set_product_rate(trim($_POST['product_rate']));
        $Product->set_product_unit(trim($_POST['product_unit']));
        $Product->set_product_cgst(trim($_POST['product_cgst']));
        $Product->set_product_sgst(trim($_POST['product_sgst']));
        $Product->set_product_igst(trim($_POST['product_igst']));
        $Product->set_product_modify_by($_POST['user_id']);
        $Product->set_product_modify_date(time());
        $update_product = $Product->update_product();

        if(!empty($update_product)){
            $res['SUCCESS']='TRUE';
            $res['MESSAGE']='Product updated successfully.';
        }else{
            $res['SUCCESS']='FALSE';
            $res['MESSAGE']='Error while updating product';
        }
        echo json_encode($res,1);
    }

}

