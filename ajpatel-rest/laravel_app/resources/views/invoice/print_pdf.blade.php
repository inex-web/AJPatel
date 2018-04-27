<style type="text/css">
.clearfix{
    clear: both;
}
.main{
    width: 100%;
    min-width: 720px
    height: auto;
    border: 1px solid #000; 
}    
.header, .customer_section, .item_section, .footer{
    width: 100%;
    padding: 5px;
}
.header_upper{
    width: 100%;
}
.header_upper_left{
    width: 33%;
    text-align: left;
    float: left;
    font-size: 15px;
}
.header_upper_center{
    width: 33%;
    text-align: center;
    float: left;
    font-size: 10px;
}
.header_upper_right{
    width: 33%;
    text-align: right;
    float: left;
}

.header_lower{
    width: 100%;
    text-align: center;
}
.header_lower_name{
    font-size: 20px;
}
.header_lower_address{
    font-size: 12px;
}

.customer_tbl{
    width: 100%;
    font-size: 12px;
    border: 0.5px solid; 
}
.customer_tbl td{
    border: 0.5px solid;
}
.item_tbl{
    width: 100%;
    font-size: 11px;
    border: 0.5px solid; 
}
.item_tbl th,.item_tbl td{
    border: 0.5px solid;
}
.footer_tbl{
    width: 100%;
    font-size: 11px;
    border: 1px solid; 
}
</style>

<?php
$owner_addr_arr = [];
if($invoice_data[0]->invoice_owner_city){
    array_push($owner_addr_arr, $invoice_data[0]->invoice_owner_city);
}
if($invoice_data[0]->invoice_owner_state){
    array_push($owner_addr_arr, $invoice_data[0]->invoice_owner_state);
}
if($invoice_data[0]->invoice_owner_pincode){
    array_push($owner_addr_arr, $invoice_data[0]->invoice_owner_pincode);
}

$owner_address = implode(', ', $owner_addr_arr);

$party_addr_arr = [];
if($invoice_data[0]->invoice_party_city){
    array_push($party_addr_arr, $invoice_data[0]->invoice_party_city);
}
if($invoice_data[0]->invoice_party_state){
    array_push($party_addr_arr, $invoice_data[0]->invoice_party_state);
}
if($invoice_data[0]->invoice_party_pincode){
    array_push($party_addr_arr, $invoice_data[0]->invoice_party_pincode);
}

$party_address = implode(', ', $party_addr_arr);
?>

<div class="main">
    <div class="header">
        <div class="header_upper">
            <div class="header_upper_left">
                <span>ORIGINAL / DUPLICATE</span>
            </div>
            <div class="header_upper_center">
                <span>TAX INVOICE</span>
            </div>
            <div class="header_upper_right">
                <span>Mo. {{ $invoice_data[0]->invoice_owner_mobile }}</span>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="header_lower">
            <span class="header_lower_name">{{ $invoice_data[0]->invoice_owner_company }}</span><br>
            <span class="header_lower_address">{{ $invoice_data[0]->invoice_owner_address }}<br>{{ $owner_address }}</span>
        </div>
    </div>

    <div class="customer_section">
        <table class="customer_tbl" cellpadding="5px" cellspacing="0">
            <tr>
                <td>Company GST No. : {{ $invoice_data[0]->invoice_owner_gstin }}</td>
            </tr>
            <tr>
                <td rowspan="3" width="65%" valign="top">
                M/s. {{ $invoice_data[0]->invoice_party_name }}<br>
                {{ $invoice_data[0]->invoice_party_address }}<br>
                {{ $party_address }}
                </td>
                <td>Invoice No. : {{ $invoice_data[0]->invoice_number }}</td>
            </tr>
            <tr>
                <td>Invoice Date : <?php if($invoice_data[0]->invoice_date!=''){ echo date($date_formate, $invoice_data[0]->invoice_date);}?></td>
            </tr>
            <tr>
                <td>Truck No. : {{ $invoice_data[0]->invoice_truck_no }}</td>
            </tr>
            <tr>
                <td>Party GST No. : {{$invoice_data[0]->invoice_party_gstin }}</td>
                <td>Transport : {{ $invoice_data[0]->invoice_transport }}</td>
            </tr>
            <!--<tr>
                <td>PAN No. : {{ $invoice_data[0]->invoice_party_pan_no }}</td>
                <td>L.R.No. : {{ $invoice_data[0]->invoice_l_r_no }}</td>
            </tr>-->
        </table>
    </div>

    <div class="item_section">
        <?php
        if(isset($invoice_item_data) && !empty($invoice_item_data)){
            ?>
            <table class="item_tbl" cellpadding="5px" cellspacing="0">
            <tr>
                <th>Sr No.</th>
                <th>Product</th>
                <th>HSN No.</th>
                <th>Qnt</th>
                <th>Rate</th>
                <th>Amount</th>
            </tr>

            <?php
            $sr = 1;
            $grand_total = 0;
            foreach($invoice_item_data as $single){
                $sub_amt = floatval($single->ii_qnt)*floatval($single->ii_rate);
                $igst_amt = $sub_amt*floatval($single->ii_igst)/100;
                $cgst_amt = $sub_amt*floatval($single->ii_cgst)/100;
                $sgst_amt = $sub_amt*floatval($single->ii_sgst)/100;

                $single_product_total = $sub_amt + $igst_amt + $cgst_amt + $sgst_amt;
                $grand_total = $grand_total + $single_product_total;
                ?>
                <tr>
                <td rowspan="5">{{$sr}}</td>
                <td>{{$single->ii_product_name}}</td>
                <td>{{$single->ii_hsn_no}}</td>
                <td>{{$single->ii_qnt}} {{$single->ii_unit}}</td>
                <td>{{$single->ii_rate}}</td>
                <td>{{$sub_amt}}</td>
                </tr>

                <tr>
                <td colspan="4">IGST {{$single->ii_igst}} %</td>
                <td>{{$igst_amt}}</td>
                </tr>

                <tr>
                <td colspan="4">CGST {{$single->ii_cgst}} %</td>
                <td>{{$cgst_amt}}</td>
                </tr>

                <tr>
                <td colspan="4">SGST {{$single->ii_sgst}} %</td>
                <td>{{$sgst_amt}}</td>
                </tr>

                <tr>
                <td colspan="4">Total</td>
                <th>{{$single_product_total}}</th>
                </tr>

                <tr>
                <td colspan="6"></td>
                </tr>
                <?php
                $sr++;
            }//end of foreach

            $grand_total = $grand_total+$invoice_data[0]->invoice_round_of_on_total;
            ?>

            <tr>
            <th colspan="5" align="right">Round of</th>
            <th>{{ $invoice_data[0]->invoice_round_of_on_total }}</th>
            </tr>

            <tr>
            <th style="font-size: 15px" colspan="5" align="right">Grand Total</th>
            <th style="font-size: 15px">{{ $grand_total }}/-</th>
            </tr>

            </table>
            <?php
        }
        ?>
    </div>
    
    <div class="footer">
        <table class="footer_tbl" border="0" cellpadding="5px" cellspacing="0">
            <tr>
                <th align="left">Notes:</th>
                <th align="center">E.& O.E.</th>
            </tr>
            <tr>
                <td style="font-size: 8px;" colspan="2">
                    <span>(1) Good once sold will not be taken back.</span><br>
                    <span>(2) If payment within 15 days is not Received, then interest @ 18% will be charged.</span><br>
                    <span>(3) Subject to Sojitra Juridiction.</span>
                    <span>(4) Amy problem/mistake in the bill have to be informed within 5 days in written.</span>
                    <span>(3) To take signature in the billis depended on us.</span>
                </td>
            </tr>
            <tr>
                <th align="center">Receiver's Signature</th>
                <th align="center">
                    For, <strong>{{ $invoice_data[0]->invoice_owner_company }}</strong><br><br>
                    Authorised Signatory
                </th>
            </tr>
        </table>
    </div>
</div>