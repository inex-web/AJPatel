<?php namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class User extends Model{
	protected $table = 'ajpatel_user';	

	protected $user_id="";
	protected $user_login_token="";
    protected $user_name="";
    protected $user_type="";
    protected $user_mobile="";
    protected $user_email="";
    protected $user_password="";
    protected $user_company="";
    protected $user_tagline="";
    protected $user_logo="";
    protected $user_address="";
    protected $user_city="";
    protected $user_state="";
    protected $user_pincode="";
    protected $user_gstin="";
    protected $user_pan_no="";
    protected $user_status="";
    protected $user_image="";
	protected $user_add_by="";
	protected $user_add_date="";
	protected $user_modified_date="";
    protected $fields="";

    public function set_user_id($val){$this->user_id=$val; }
    public function set_user_login_token($val){$this->user_login_token=$val; }
    public function set_user_name($val){$this->user_name=$val; }
    public function set_user_type($val){$this->user_type=$val; }
    public function set_user_mobile($val){$this->user_mobile=$val; }
    public function set_user_email($val){$this->user_email=$val; }
    public function set_user_password($val){$this->user_password=$val; }
    public function set_user_company($val){$this->user_company=$val; }
    public function set_user_tagline($val){$this->user_tagline=$val; }
    public function set_user_logo($val){$this->user_logo=$val; }
    public function set_user_address($val){$this->user_address=$val; }
    public function set_user_city($val){$this->user_city=$val; }
    public function set_user_state($val){$this->user_state=$val; }
    public function set_user_pincode($val){$this->user_pincode=$val; }
    public function set_user_gstin($val){$this->user_gstin=$val; }
    public function set_user_pan_no($val){$this->user_pan_no=$val; }
    public function set_user_status($val){$this->user_status=$val; }
    public function set_user_image($val){$this->user_image=$val; }
	public function set_user_add_by($val){$this->user_add_by=$val; }
	public function set_user_add_date($val){$this->user_add_date=$val; }
	public function set_user_modified_date($val){$this->user_modified_date=$val; }
    public function set_fields($val){$this->fields=$val; }
	
	public function select_fields_by_user_id(){
		return DB::table($this->table)
			->select($this->fields)
			->where('user_id',$this->user_id)
			->get();
	}
	public function select_by_user_id(){
		return DB::table($this->table)
			->select('*')
			->where('user_id',$this->user_id)
			->get();
	}
	public function select_by_user_login_token(){
		return DB::table($this->table)
			->select('*')
			->where('user_login_token',$this->user_login_token)
			->get();
	}
	public function check_user_for_login(){
		return DB::table($this->table)
			->select('user_id','user_password')
			->where('user_type','Admin')
			->where('user_mobile',$this->fields)
			->orWhere('user_email',$this->fields)
			->get();
	}
	public function unique_email(){
		return DB::table($this->table)
			->select('*')
			->where('user_email',$this->user_email)
			->where('user_id','!=',$this->user_id)
			->get();
	}
	public function unique_mobile(){
		return DB::table($this->table)
			->select('*')
			->where('user_mobile',$this->user_mobile)
			->where('user_id','!=',$this->user_id)
			->get();
	}

	public function change_status(){
		return DB::table($this->table)
		->where('user_id',$this->user_id)
		->update(
			[
				'user_status' => $this->user_status,
				'user_modified_date' => $this->user_modified_date
			]
		);
	}
	public function update_password(){
		return DB::table($this->table)
		->where('user_id',$this->user_id)
		->update(
			[
				'user_password' => $this->user_password,
				'user_modified_date' => $this->user_modified_date
			]
		);
	}
	public function change_user_login_token(){
		return DB::table($this->table)
		->where('user_id',$this->user_id)
		->update(
			[
				'user_login_token' => $this->user_login_token
			]
		);
	}
	public function update_admin(){
		return DB::table($this->table)
		->where('user_id',$this->user_id)
		->update(
			[
				'user_name' => $this->user_name,
				'user_mobile' => $this->user_mobile,
				'user_email' => $this->user_email,
				'user_company' => $this->user_company,
				'user_tagline' => $this->user_tagline,
				'user_address' => $this->user_address,
				'user_city' => $this->user_city,
				'user_state' => $this->user_state,
				'user_pincode' => $this->user_pincode,
				'user_gstin' => $this->user_gstin,
				'user_pan_no' => $this->user_pan_no,
				'user_modified_date' => $this->user_modified_date
			]
		);
	}
	public function update_image(){
		return DB::table($this->table)
		->where('user_id',$this->user_id)
		->update(
			[
				'user_image' => $this->user_image
			]
		);
	}
	public function update_logo(){
		return DB::table($this->table)
		->where('user_id',$this->user_id)
		->update(
			[
				'user_logo' => $this->user_logo
			]
		);
	}

}
