<?php namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Party extends Model{
	protected $table = 'ajpatel_party';

	protected $party_id="";
    protected $party_name="";
    protected $party_contact_person="";
    protected $party_mobile="";
    protected $party_address="";
    protected $party_city="";
    protected $party_state="";
    protected $party_pincode="";
    protected $party_gstin="";
    protected $party_pan_no="";
    protected $party_status="";
	protected $party_add_by="";
	protected $party_add_date="";
	protected $party_modify_by="";
	protected $party_modify_date="";
    protected $fields="";

    public function set_party_id($val){$this->party_id=$val; }
    public function set_party_name($val){$this->party_name=$val; }
    public function set_party_contact_person($val){$this->party_contact_person=$val; }
    public function set_party_mobile($val){$this->party_mobile=$val; }
    public function set_party_address($val){$this->party_address=$val; }
    public function set_party_city($val){$this->party_city=$val; }
    public function set_party_state($val){$this->party_state=$val; }
    public function set_party_pincode($val){$this->party_pincode=$val; }
    public function set_party_gstin($val){$this->party_gstin=$val; }
    public function set_party_pan_no($val){$this->party_pan_no=$val; }
    public function set_party_status($val){$this->party_status=$val; }
	public function set_party_add_by($val){$this->party_add_by=$val; }
	public function set_party_add_date($val){$this->party_add_date=$val; }
	public function set_party_modify_by($val){$this->party_modify_by=$val; }
	public function set_party_modify_date($val){$this->party_modify_date=$val; }
    public function set_fields($val){$this->fields=$val; }
	
	public function insert_party(){
		return DB::table($this->table)->insertGetId(
			[
				'party_name' => $this->party_name,
				'party_contact_person' => $this->party_contact_person,
				'party_mobile' => $this->party_mobile,
				'party_address' => $this->party_address,
				'party_city' => $this->party_city,
				'party_state' => $this->party_state,
				'party_pincode' => $this->party_pincode,
				'party_gstin' => $this->party_gstin,
				'party_pan_no' => $this->party_pan_no,
				'party_status' => $this->party_status,
				'party_add_by' => $this->party_add_by,
				'party_add_date' => $this->party_add_date,
				'party_modify_date' => $this->party_modify_date
			]
		);
	}
	public function count_all($keyword){
		$cond_keyword = '';
		if(isset($keyword) && !empty($keyword)){
			$cond_keyword = "AND (
					party_name LIKE '%$keyword%' OR
					party_contact_person LIKE '%$keyword%' OR
					party_mobile LIKE '%$keyword%'
                )";
		}

		$sql="
                SELECT count(DISTINCT party_id) as count
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
					party_name LIKE '%$keyword%' OR
					party_contact_person LIKE '%$keyword%' OR
					party_mobile LIKE '%$keyword%'
                )";
		}

		$sql="
                SELECT DISTINCT party_id, party_name, party_contact_person, party_mobile
                FROM $this->table
                WHERE 1
                $cond_keyword
                ORDER BY party_id DESC
                LIMIT $start,$end
            ";

		$results = DB::select( DB::raw($sql) );
		return $results;
	}
	public function select_fields_by_party_id(){
		return DB::table($this->table)
			->select($this->fields)
			->where('party_id',$this->party_id)
			->get();
	}
	public function select_by_party_id(){
		return DB::table($this->table)
			->select('*')
			->where('party_id',$this->party_id)
			->get();
	}
	
	public function select_name_active(){
		return DB::table($this->table)
			->select('party_id','party_name')
			->where('party_status','Active')
			->orderBy('party_id','DESC')
			->get();
	}
	public function change_status(){
		return DB::table($this->table)
		->where('party_id',$this->party_id)
		->update(
			[
				'party_status' => $this->party_status,
				'party_modify_date' => $this->party_modify_date
			]
		);
	}
	
	public function update_party(){
		return DB::table($this->table)
		->where('party_id',$this->party_id)
		->update(
			[
				'party_name' => $this->party_name,
				'party_contact_person' => $this->party_contact_person,
				'party_mobile' => $this->party_mobile,
				'party_address' => $this->party_address,
				'party_city' => $this->party_city,
				'party_state' => $this->party_state,
				'party_pincode' => $this->party_pincode,
				'party_gstin' => $this->party_gstin,
				'party_pan_no' => $this->party_pan_no,
				'party_modify_by' => $this->party_modify_by,
				'party_modify_date' => $this->party_modify_date
			]
		);
	}


}
