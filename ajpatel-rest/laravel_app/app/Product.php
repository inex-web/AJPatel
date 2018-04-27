<?php namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model{
	protected $table = 'ajpatel_product';

	protected $product_id="";
	protected $product_name="";
	protected $product_hsn_no="";
	protected $product_rate="";
	protected $product_unit="";
	protected $product_cgst="";
	protected $product_sgst="";
	protected $product_igst="";
	protected $product_status="";
	protected $product_add_by="";
	protected $product_add_date="";
	protected $product_modify_by="";
	protected $product_modify_date="";

    public function set_product_id($val){$this->product_id=$val; }
    public function set_product_name($val){$this->product_name=$val; }
    public function set_product_hsn_no($val){$this->product_hsn_no=$val; }
    public function set_product_rate($val){$this->product_rate=$val; }
    public function set_product_unit($val){$this->product_unit=$val; }
    public function set_product_cgst($val){$this->product_cgst=$val; }
    public function set_product_sgst($val){$this->product_sgst=$val; }
    public function set_product_igst($val){$this->product_igst=$val; }
	public function set_product_status($val){$this->product_status=$val; }
	public function set_product_add_by($val){$this->product_add_by=$val; }
	public function set_product_add_date($val){$this->product_add_date=$val; }
	public function set_product_modify_by($val){$this->product_modify_by=$val; }
	public function set_product_modify_date($val){$this->product_modify_date=$val; }
	
    public function insert_product(){
		return DB::table($this->table)->insertGetId(
			[
				'product_name' => $this->product_name,
				'product_hsn_no' => $this->product_hsn_no,
				'product_rate' => $this->product_rate,
				'product_unit' => $this->product_unit,
				'product_cgst' => $this->product_cgst,
				'product_sgst' => $this->product_sgst,
				'product_igst' => $this->product_igst,
				'product_status' => $this->product_status,
				'product_add_by' => $this->product_add_by,
				'product_add_date' => $this->product_add_date
			]
		);
	}
	public function update_product(){
		return DB::table($this->table)
		->where('product_id',$this->product_id)
		->update(
			[
				'product_name' => $this->product_name,
				'product_hsn_no' => $this->product_hsn_no,
				'product_rate' => $this->product_rate,
				'product_unit' => $this->product_unit,
				'product_cgst' => $this->product_cgst,
				'product_sgst' => $this->product_sgst,
				'product_igst' => $this->product_igst,
				'product_modify_by' => $this->product_modify_by,
				'product_modify_date' => $this->product_modify_date
			]
		);
	}
	
	public function count_all($keyword){
		$cond_keyword = '';
		if(isset($keyword) && !empty($keyword)){
			$cond_keyword = "AND (
					product_name LIKE '%$keyword%' OR
					product_hsn_no LIKE '%$keyword%'
                )";
		}

		$sql="
                SELECT count(DISTINCT product_id) as count
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
					product_name LIKE '%$keyword%' OR
					product_hsn_no LIKE '%$keyword%'
                )";
		}

		$sql="
                SELECT DISTINCT product_id, product_name, product_hsn_no, product_rate, product_unit, product_cgst, product_sgst, product_igst, product_add_date
                FROM $this->table
                WHERE 1
                $cond_keyword
                ORDER BY product_id DESC
                LIMIT $start,$end
            ";

		$results = DB::select( DB::raw($sql) );
		return $results;
	}

	public function select_all_product_for_dropdown(){
		return DB::table($this->table)
			->select('product_id','product_name','product_hsn_no','product_rate','product_unit','product_cgst','product_sgst','product_igst')
			->where('product_status','Active')
			->get();
	}
	
}
