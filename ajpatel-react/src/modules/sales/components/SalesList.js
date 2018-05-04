import React, { Component } from 'react';
import { invoiceList } from '../../../rest/Rest';
import { getSessionStorage } from '../../../commons/utils/Utils';
import { loginToken,
  userLoginToken
} from '../../../commons/constants/Constants';

export default class SalesList extends Component {
  
  constructor(props) {
    super(props);
    this.state = {
        data: '',
        keyword: '',
        isLoading: false,
        errorMessage: ''
    }
    
    this.getSalesData = this.getSalesData.bind(this);
  }

  componentDidMount() {
    this.getSalesData();
  }

  getSalesData() {
    const self = this;
    self.setState({isLoading: true});

    if(getSessionStorage(userLoginToken)) {
      var FormData = require('form-data');
      var form = new FormData();
      form.append(loginToken, getSessionStorage(userLoginToken));    

      let responseStatus;
      invoiceList(form)
        .then(function(response) {
          responseStatus = response.status;
          return response.text();
        }).then(function(response) {
          self.setState({isLoading: false});

          if(responseStatus === 200) {
            let responseObj = JSON.parse(response);

            if(responseObj.SUCCESS === "TRUE") {
              self.setState({data: responseObj.DATA.sort((arg1, arg2) => arg1.invoice_date < arg2.invoice_date)});
            } else {
              self.setState({errorMessage: responseObj.MESSAGE});  
            }
          } else {
            self.setState({errorMessage: "Something went wrong trying to get data."});
            console.log('Response Status : ', responseStatus);
          }
        }).catch(function(ex) {
          self.setState({isLoading: false});
          self.setState({errorMessage: "Something went wrong parsing data."});
          console.log('Parsing Failed : ', ex);
        })
    } else {
      self.setState({isLoading: false});
      self.setState({errorMessage: "Login Token is missing."});
    }
  }

  tableBody(data) {
    if(data && data.length > 0) {
        const tableBody = data.map((data, key) =>
        <tr key={key}>
            <td>{data.invoice_id}</td>
            <td>{data.invoice_party_name}</td>
            <td>{data.invoice_number}</td>
            <td>{data.invoice_total}</td>
            <td>{data.invoice_date}</td>
            <td><button onClick={() => this.props.changeComponent("view", data.invoice_id)}>View</button></td>
        </tr>
        );

        return tableBody;
    }
  }
  
  render() {
      const { data, isLoading, errorMessage } = this.state;
      const tableBody = this.tableBody(data);
    
    return (
      <div>
          <button onClick={() => this.props.changeComponent("create", null)}>Add</button>
          {isLoading ? <p>Loading... Please wait.</p> : ""}
          <p>{errorMessage}</p>
          <div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Party Name</th>
                        <th>Invoice Number</th>
                        <th>Invoice Total</th>
                        <th>Invoice Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    {tableBody}
                </tbody>
            </table>
            {!data || !data.length > 0 ? <div>Nothing to display.</div> : '' }
          </div>
      </div>
    );
  }
}