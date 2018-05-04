import React, { Component } from 'react';
import { productList } from '../../../rest/Rest';
import { getSessionStorage } from '../../../commons/utils/Utils';
import { loginToken,
  userLoginToken,
  keyword
} from '../../../commons/constants/Constants';

export default class ProductList extends Component {
  
  constructor(props) {
    super(props);
    this.state = {
        data: '',
        keyword: '',
        isLoading: false,
        errorMessage: ''
    }
    
    this.getProductData = this.getProductData.bind(this);
  }

  componentDidMount() {
    this.getProductData();
  }

  getProductData() {
    const self = this;
    self.setState({isLoading: true});

    if(getSessionStorage(userLoginToken)) {
      var FormData = require('form-data');
      var form = new FormData();
      form.append(loginToken, getSessionStorage(userLoginToken));
      form.append(keyword, this.state.keyword);     

      let responseStatus;
      productList(form)
        .then(function(response) {
          responseStatus = response.status;
          return response.text();
        }).then(function(response) {
          self.setState({isLoading: false});

          if(responseStatus === 200) {
            let responseObj = JSON.parse(response);

            if(responseObj.SUCCESS === "TRUE") {
              self.setState({data: responseObj.DATA.sort((arg1, arg2) => arg1.product_id > arg2.product_id)});
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
            <td>{data.product_id}</td>
            <td>{data.product_name}</td>
            <td>{data.product_hsn_no}</td>
            <td>{data.product_rate}</td>
            <td><button onClick={() => this.props.changeComponent("view", data)}>View</button></td>
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
                        <th>Name</th>
                        <th>HSN No.</th>
                        <th>Rate</th>
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