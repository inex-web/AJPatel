import React, { Component } from 'react';

export default class SalesView extends Component {

  tableBody(data) {
    if(data && data.length > 0) {
        const tableBody = data.map((data, key) =>
        <tr key={key}>
            <td>{data.ii_invoice_id}</td>
            <td>{data.ii_product_name}</td>
            <td>{data.ii_hsn_no}</td>
            <td>{data.ii_rate}</td>
            <td>{data.ii_qnt}</td>
            <td>{data.ii_unit}</td>
            <td>{data.ii_cgst}</td>
            <td>{data.ii_sgst}</td>
            <td>{data.ii_igst}</td>
        </tr>
        );

        return tableBody;
    }
  }
  
  render() {
    const { data, isLoading, errorMessage } = this.props;
    const tableBody = this.tableBody(data.invoice_item_data);

    return (
      <div>
        {isLoading ? <p>Loading... Please wait.</p> : ""}
        <p>{errorMessage}</p>
        <div>{!isLoading ? <p>{data.invoice_id}</p> : '' }</div>
        <div>{!isLoading ? <p>{data.invoice_number}</p> : '' }</div>
        <div>{!isLoading ? <p>{data.invoice_owner_name}</p> : '' }</div>
        <div>{!isLoading ? <p>{data.invoice_owner_mobile}</p> : '' }</div>
        <div>{!isLoading ? <p>{data.invoice_owner_email}</p> : '' }</div>
        <div>{!isLoading ? <p>{data.invoice_owner_address}</p> : '' }</div>
        <div>{!isLoading ? <p>{data.invoice_owner_city}</p> : '' }</div>
        <div>{!isLoading ? <p>{data.invoice_owner_state}</p> : '' }</div>
        <div>{!isLoading ? <p>{data.invoice_owner_pincode}</p> : '' }</div>
        <div>{!isLoading ? <p>{data.invoice_owner_gstin}</p> : '' }</div>
        <div>{!isLoading ? <p>{data.invoice_owner_pan_no}</p> : '' }</div>
        <div>{!isLoading ? <p>{data.invoice_party_id}</p> : '' }</div>
        <div>{!isLoading ? <p>{data.invoice_party_name}</p> : '' }</div>
        <div>{!isLoading ? <p>{data.invoice_party_contact_person}</p> : '' }</div>
        <div>{!isLoading ? <p>{data.invoice_party_mobile}</p> : '' }</div>
        <div>{!isLoading ? <p>{data.invoice_party_address}</p> : '' }</div>
        <div>{!isLoading ? <p>{data.invoice_party_city}</p> : '' }</div>
        <div>{!isLoading ? <p>{data.invoice_party_state}</p> : '' }</div>
        <div>{!isLoading ? <p>{data.invoice_party_pincode}</p> : '' }</div>
        <div>{!isLoading ? <p>{data.invoice_party_gstin}</p> : '' }</div>
        <div>{!isLoading ? <p>{data.invoice_party_pan_no}</p> : '' }</div>
        <div>{!isLoading ? <p>{data.invoice_date}</p> : '' }</div>
        <div>{!isLoading ? <p>{data.invoice_truck_no}</p> : '' }</div>
        <div>{!isLoading ? <p>{data.invoice_transport}</p> : '' }</div>
        <div>{!isLoading ? <p>{data.invoice_l_r_no}</p> : '' }</div>
        <div>{!isLoading ? <p>{data.invoice_delivery_note}</p> : '' }</div>
        <div>{!isLoading ? <p>{data.invoice_round_of_on_total}</p> : '' }</div>
        <div>{!isLoading ? <p>{data.invoice_total}</p> : '' }</div>
        <div>{!isLoading ? <p>{data.invoice_bank_name}</p> : '' }</div>
        <div>{!isLoading ? <p>{data.invoice_bank_ac_no}</p> : '' }</div>
        <div>{!isLoading ? <p>{data.invoice_bank_branch}</p> : '' }</div>
        <div>{!isLoading ? <p>{data.invoice_bank_ifsc}</p> : '' }</div>
        <div>{!isLoading ? <p>{data.invoice_is_challan}</p> : '' }</div>
        <div>
          {!isLoading
          ?
          <div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>HSN Number</th>
                        <th>Rate</th>
                        <th>Quantity</th>
                        <th>Unit</th>
                        <th>CGST</th>
                        <th>SGST</th>
                        <th>IGST</th>
                    </tr>
                </thead>
                <tbody>
                    {tableBody}
                </tbody>
            </table>
          </div>
          :
          ''
          }
        </div>        
      </div>
    );
  }
}