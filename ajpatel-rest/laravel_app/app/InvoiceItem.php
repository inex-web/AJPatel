<?php namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class InvoiceItem extends Model{
	protected $table = 'ajpatel_invoice_item';

	protected $ii_id="";
	protected $ii_invoice_id="";
	protected $ii_product_name="";
	protected $ii_hsn_no="";
	protected $ii_rate="";
	protected $ii_qnt="";
	protected $ii_unit="";
	protected $ii_cgst="";
	protected $ii_sgst="";
	protected $ii_igst="";

    public function set_ii_id($val){$this->ii_id=$val; }
    public function set_ii_invoice_id($val){$this->ii_invoice_id=$val; }
    public function set_ii_product_name($val){$this->ii_product_name=$val; }
    public function set_ii_hsn_no($val){$this->ii_hsn_no=$val; }
    public function set_ii_rate($val){$this->ii_rate=$val; }
    public function set_ii_qnt($val){$this->ii_qnt=$val; }
    public function set_ii_unit($val){$this->ii_unit=$val; }
    public function set_ii_cgst($val){$this->ii_cgst=$val; }
    public function set_ii_sgst($val){$this->ii_sgst=$val; }
    public function set_ii_igst($val){$this->ii_igst=$val; }
	
    public function insert_invoice_item(){
		return DB::table($this->table)->insertGetId(
			[
				'ii_invoice_id' => $this->ii_invoice_id,
				'ii_product_name' => $this->ii_product_name,
				'ii_hsn_no' => $this->ii_hsn_no,
				'ii_rate' => $this->ii_rate,
				'ii_qnt' => $this->ii_qnt,
				'ii_unit' => $this->ii_unit,
				'ii_cgst' => $this->ii_cgst,
				'ii_sgst' => $this->ii_sgst,
				'ii_igst' => $this->ii_igst
			]
		);
	}

	public function select_item_by_invoice_id(){
		$sql="SELECT * FROM " . $this->table . " WHERE `ii_invoice_id`='" . $this->ii_invoice_id . "'";

		$results = DB::select( DB::raw($sql) );
		return $results;
	}
	
}
