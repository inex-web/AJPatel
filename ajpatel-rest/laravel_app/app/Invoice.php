<?php namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Invoice extends Model{
	protected $table = 'ajpatel_invoice';

	protected $invoice_id="";
	protected $invoice_number="";
	
	protected $invoice_owner_company="";
	protected $invoice_owner_name="";
	protected $invoice_owner_email="";
	protected $invoice_owner_mobile="";
	protected $invoice_owner_address="";
	protected $invoice_owner_city="";
	protected $invoice_owner_state="";
	protected $invoice_owner_pincode="";
	protected $invoice_owner_gstin="";
	protected $invoice_owner_pan_no="";

	protected $invoice_party_id="";
	protected $invoice_party_name="";
	protected $invoice_party_contact_person="";
	protected $invoice_party_mobile="";
	protected $invoice_party_address="";
	protected $invoice_party_city="";
	protected $invoice_party_state="";
	protected $invoice_party_pincode="";
	protected $invoice_party_gstin="";
	protected $invoice_party_pan_no="";
	protected $invoice_date="";
	protected $invoice_truck_no="";
	protected $invoice_transport="";
	protected $invoice_l_r_no="";
	protected $invoice_delivery_note="";
	protected $invoice_round_of_on_total="";
	protected $invoice_total="";
	protected $invoice_bank_name="";
	protected $invoice_bank_ac_no="";
	protected $invoice_bank_branch="";
	protected $invoice_bank_ifsc="";
	protected $invoice_is_challan="";
	protected $invoice_pdf="";
	protected $invoice_status="";
	protected $invoice_add_by="";
	protected $invoice_add_date="";
	protected $invoice_modify_by="";
	protected $invoice_modify_date="";

    public function set_invoice_id($val){$this->invoice_id=$val; }
    public function set_invoice_number($val){$this->invoice_number=$val; }

    public function set_invoice_owner_company($val){$this->invoice_owner_company=$val; }
    public function set_invoice_owner_name($val){$this->invoice_owner_name=$val; }
    public function set_invoice_owner_email($val){$this->invoice_owner_email=$val; }
    public function set_invoice_owner_mobile($val){$this->invoice_owner_mobile=$val; }
    public function set_invoice_owner_address($val){$this->invoice_owner_address=$val; }
    public function set_invoice_owner_city($val){$this->invoice_owner_city=$val; }
    public function set_invoice_owner_state($val){$this->invoice_owner_state=$val; }
    public function set_invoice_owner_pincode($val){$this->invoice_owner_pincode=$val; }
    public function set_invoice_owner_gstin($val){$this->invoice_owner_gstin=$val; }
    public function set_invoice_owner_pan_no($val){$this->invoice_owner_pan_no=$val; }

    public function set_invoice_party_id($val){$this->invoice_party_id=$val; }
    public function set_invoice_party_name($val){$this->invoice_party_name=$val; }
    public function set_invoice_party_contact_person($val){$this->invoice_party_contact_person=$val; }
    public function set_invoice_party_mobile($val){$this->invoice_party_mobile=$val; }
    public function set_invoice_party_address($val){$this->invoice_party_address=$val; }
    public function set_invoice_party_city($val){$this->invoice_party_city=$val; }
    public function set_invoice_party_state($val){$this->invoice_party_state=$val; }
    public function set_invoice_party_pincode($val){$this->invoice_party_pincode=$val; }
    public function set_invoice_party_gstin($val){$this->invoice_party_gstin=$val; }
    public function set_invoice_party_pan_no($val){$this->invoice_party_pan_no=$val; }
    public function set_invoice_date($val){$this->invoice_date=$val; }
    public function set_invoice_truck_no($val){$this->invoice_truck_no=$val; }
    public function set_invoice_transport($val){$this->invoice_transport=$val; }
    public function set_invoice_l_r_no($val){$this->invoice_l_r_no=$val; }
    public function set_invoice_delivery_note($val){$this->invoice_delivery_note=$val; }
    public function set_invoice_round_of_on_total($val){$this->invoice_round_of_on_total=$val; }
    public function set_invoice_total($val){$this->invoice_total=$val; }
    public function set_invoice_bank_name($val){$this->invoice_bank_name=$val; }
    public function set_invoice_bank_ac_no($val){$this->invoice_bank_ac_no=$val; }
    public function set_invoice_bank_branch($val){$this->invoice_bank_branch=$val; }
    public function set_invoice_bank_ifsc($val){$this->invoice_bank_ifsc=$val; }
    public function set_invoice_is_challan($val){$this->invoice_is_challan=$val; }
    public function set_invoice_pdf($val){$this->invoice_pdf=$val; }
    public function set_invoice_status($val){$this->invoice_status=$val; }
    public function set_invoice_add_by($val){$this->invoice_add_by=$val; }
    public function set_invoice_add_date($val){$this->invoice_add_date=$val; }
    public function set_invoice_modify_by($val){$this->invoice_modify_by=$val; }
    public function set_invoice_modify_date($val){$this->invoice_modify_date=$val; }
	
    public function insert_invoice(){
		return DB::table($this->table)->insertGetId(
			[
				'invoice_number' => $this->invoice_number,
				'invoice_party_id' => $this->invoice_party_id,

				'invoice_owner_company' => $this->invoice_owner_company,
				'invoice_owner_name' => $this->invoice_owner_name,
				'invoice_owner_email' => $this->invoice_owner_email,
				'invoice_owner_mobile' => $this->invoice_owner_mobile,
				'invoice_owner_address' => $this->invoice_owner_address,
				'invoice_owner_city' => $this->invoice_owner_city,
				'invoice_owner_state' => $this->invoice_owner_state,
				'invoice_owner_pincode' => $this->invoice_owner_pincode,
				'invoice_owner_gstin' => $this->invoice_owner_gstin,
				'invoice_owner_pan_no' => $this->invoice_owner_pan_no,

				'invoice_party_name' => $this->invoice_party_name,
				'invoice_party_contact_person' => $this->invoice_party_contact_person,
				'invoice_party_mobile' => $this->invoice_party_mobile,
				'invoice_party_address' => $this->invoice_party_address,
				'invoice_party_city' => $this->invoice_party_city,
				'invoice_party_state' => $this->invoice_party_state,
				'invoice_party_pincode' => $this->invoice_party_pincode,
				'invoice_party_gstin' => $this->invoice_party_gstin,
				'invoice_party_pan_no' => $this->invoice_party_pan_no,
				'invoice_date' => $this->invoice_date,
				'invoice_truck_no' => $this->invoice_truck_no,
				'invoice_transport' => $this->invoice_transport,
				'invoice_l_r_no' => $this->invoice_l_r_no,
				'invoice_delivery_note' => $this->invoice_delivery_note,
				'invoice_round_of_on_total' => $this->invoice_round_of_on_total,
				'invoice_total' => $this->invoice_total,
				'invoice_bank_name' => $this->invoice_bank_name,
				'invoice_bank_ac_no' => $this->invoice_bank_ac_no,
				'invoice_bank_branch' => $this->invoice_bank_branch,
				'invoice_bank_ifsc' => $this->invoice_bank_ifsc,
				'invoice_is_challan' => $this->invoice_is_challan,
				'invoice_pdf' => $this->invoice_pdf,
				'invoice_status' => $this->invoice_status,
				'invoice_add_by' => $this->invoice_add_by,
				'invoice_add_date' => $this->invoice_add_date,
				'invoice_modify_date' => $this->invoice_modify_date
			]
		);
	}

	public function update_total(){
		return DB::table($this->table)
		->where('invoice_id',$this->invoice_id)
		->update(
			[
				'invoice_total' => $this->invoice_total
			]
		);
	}
	public function update_pdf(){
		return DB::table($this->table)
		->where('invoice_id',$this->invoice_id)
		->update(
			[
				'invoice_pdf' => $this->invoice_pdf
			]
		);
	}

	public function count_all($keyword){
		$cond_keyword = '';
		if(isset($keyword) && !empty($keyword)){
			$cond_keyword = "AND (
					invoice_party_name LIKE '%$keyword%' OR
					invoice_number LIKE '%$keyword%' OR
					invoice_total LIKE '%$keyword%'
                )";
		}

		$sql="
                SELECT count(DISTINCT invoice_id) as count
                FROM $this->table
                WHERE 1
                $cond_keyword
            ";

		$results = DB::select( DB::raw($sql) );
		return $results;
	}
	public function select_all($start,$end,$keyword){
		$cond_keyword = '';
		if(isset($keyword) && !empty($keyword)){
			$cond_keyword = "AND (
					invoice_party_name LIKE '%$keyword%' OR
					invoice_number LIKE '%$keyword%' OR
					invoice_total LIKE '%$keyword%'
                )";
		}

		$sql="
                SELECT DISTINCT invoice_id, invoice_party_name, invoice_number, invoice_total, invoice_date
                FROM $this->table
                WHERE 1
                $cond_keyword
                ORDER BY invoice_id DESC
                LIMIT $start,$end
            ";

		$results = DB::select( DB::raw($sql) );
		return $results;
	}

	public function select_by_invoice_id(){
		$sql="SELECT * FROM " . $this->table . " WHERE `invoice_id`='" . $this->invoice_id . "'";

		$results = DB::select( DB::raw($sql) );
		return $results;
	}
}
