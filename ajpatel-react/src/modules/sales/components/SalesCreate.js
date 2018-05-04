import React, { Component } from 'react';
import { invoiceCreate, partyList, partyView, productList } from '../../../rest/Rest';
import { getSessionStorage } from '../../../commons/utils/Utils';
import { loginToken,
    userLoginToken,
    partyId,
    invoiceDate,
    roundOf,
    invoiceNumber,
    truckNo,
    transport,
    lRNo,
    iiJsonData
  } from '../../../commons/constants/Constants';

export default class SalesCreate extends Component {

    constructor(props) {
        super(props);
        this.state = {
            data: {
                party_id: "",
                invoice_date: "",
                round_of: "",
                invoice_number: "",
                truck_no: "",
                transport: "",
                l_r_no: "",
                ii_json_data: []
            },
            itemData: {
                max_ii_id: "",
                ii_id: "",
                ii_product_name: "",
                ii_hsn_no: "",
                ii_rate: "",
                ii_qnt: "",
                ii_unit: "",
                ii_igst: "",
                ii_cgst: "",
                ii_sgst: ""
            },
            isLoading: false,
            errorMessage: '',
            isError: false,
            isPartyLoading: false,
            partyList: '',
            partyData: '',
            partyErrorMessage: '',
            isProductLoading: false,
            productList: '',
            productErrorMessage: ''
        }
        
        this.handleInputChange = this.handleInputChange.bind(this);
        this.onCancleClick = this.onCancleClick.bind(this);
        this.onSaveClick = this.onSaveClick.bind(this);
        this.createInvoiceData = this.createInvoiceData.bind(this);
        this.getPartyData = this.getPartyData.bind(this);
        this.handleProductInputChange = this.handleProductInputChange.bind(this);
        this.onAddProductClick = this.onAddProductClick.bind(this);
    }

    componentDidMount() {
        this.getPartyData();
        this.getProductData();
        this.onAddProductClick();
    }

    getPartyData() {
        const self = this;
        self.setState({isPartyLoading: true});
    
        if(getSessionStorage(userLoginToken)) {
          var FormData = require('form-data');
          var form = new FormData();
          form.append(loginToken, getSessionStorage(userLoginToken));   
    
          let responseStatus;
          partyList(form)
            .then(function(response) {
              responseStatus = response.status;
              return response.text();
            }).then(function(response) {
              self.setState({isPartyLoading: false});
    
              if(responseStatus === 200) {
                let responseObj = JSON.parse(response);
    
                if(responseObj.SUCCESS === "TRUE") {
                  self.setState({partyList: responseObj.DATA.sort((arg1, arg2) => arg1.party_id > arg2.party_id)});
                } else {
                  self.setState({partyErrorMessage: responseObj.MESSAGE});  
                }
              } else {
                self.setState({partyErrorMessage: "Something went wrong trying to get data."});
                console.log('Response Status : ', responseStatus);
              }
            }).catch(function(ex) {
              self.setState({isPartyLoading: false});
              self.setState({partyErrorMessage: "Something went wrong parsing data."});
              console.log('Parsing Failed : ', ex);
            })
        } else {
          self.setState({isPartyLoading: false});
          self.setState({partyErrorMessage: "Login Token is missing."});
        }
    }

    getProductData() {
        const self = this;
        self.setState({isProductLoading: true});
    
        if(getSessionStorage(userLoginToken)) {
          var FormData = require('form-data');
          var form = new FormData();
          form.append(loginToken, getSessionStorage(userLoginToken));    
    
          let responseStatus;
          productList(form)
            .then(function(response) {
              responseStatus = response.status;
              return response.text();
            }).then(function(response) {
              self.setState({isProductLoading: false});
    
              if(responseStatus === 200) {
                let responseObj = JSON.parse(response);
    
                if(responseObj.SUCCESS === "TRUE") {
                  self.setState({productList: responseObj.DATA.sort((arg1, arg2) => arg1.product_id > arg2.product_id)});
                } else {
                  self.setState({productErrorMessage: responseObj.MESSAGE});  
                }
              } else {
                self.setState({productErrorMessage: "Something went wrong trying to get data."});
                console.log('Response Status : ', responseStatus);
              }
            }).catch(function(ex) {
              self.setState({isProductLoading: false});
              self.setState({productErrorMessage: "Something went wrong parsing data."});
              console.log('Parsing Failed : ', ex);
            })
        } else {
          self.setState({isProductLoading: false});
          self.setState({productErrorMessage: "Login Token is missing."});
        }
    }

    handleInputChange(event) {
        const target = event.target;
        const value = target.value;
        const name = target.name;
    
        this.setState({ data: { ...this.state.data, [name]: value} });
    }

    onCancleClick() {
        this.props.changeComponent("list", null);
    }
    
    onSaveClick(data) {
        console.log(data)
        if(data.party_id && 
            data.invoice_date && 
            data.invoice_number &&
            data.truck_no &&
            data.transport &&
            data.l_r_no &&
            data.ii_json_data) {
            this.createInvoiceData(data);
        } else {
            console.log("in else")
          this.setState({isError: true});
        }
    }

    createInvoiceData(data) {
        const self = this;
        self.setState({isLoading: true});

        var FormData = require('form-data');
        var form = new FormData();
        form.append(loginToken, getSessionStorage(userLoginToken));
        form.append(partyId, data.party_id);
        form.append(invoiceDate, data.invoice_date);
        form.append(roundOf, data.round_of);
        form.append(invoiceNumber, data.invoice_number);
        form.append(truckNo, data.truck_no);
        form.append(transport, data.transport);
        form.append(lRNo, data.l_r_no);
        form.append(iiJsonData, data.ii_json_data);

        let responseStatus;
        invoiceCreate(form)
        .then(function(response) {
            responseStatus = response.status;
            return response.text();
        }).then(function(response) {
            self.setState({isLoading: false});

            if(responseStatus === 200) {
            let responseObj = JSON.parse(response);

            if(responseObj.SUCCESS === "TRUE") {
                self.props.changeComponent("list", null);
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
    }

    partyOptionData(partyList) {
        let partyOptionData = (partyList.map((party) =>
            <option key={party.party_id} value={party.party_id}> {party.party_name} </option>
        ))
        partyOptionData.splice(0, 0, <option key='' value=''></option>)

        return partyOptionData;
    }

    onPartyChange(partyId) {
        this.setState({partyData: ''});
        if(partyId) {
            this.getPartyView(partyId);
        }
    }

    getPartyView(id) {
        const self = this;
        self.setState({isPartyLoading: true} );  
    
        if(getSessionStorage(userLoginToken)) {
          var FormData = require('form-data');
          var form = new FormData();
          form.append(loginToken, getSessionStorage(userLoginToken));
          form.append(partyId, id);  
    
          let responseStatus;
          partyView(form)
            .then(function(response) {
              responseStatus = response.status;
              return response.text();
            }).then(function(response) {
              self.setState({isPartyLoading: false});
    
              if(responseStatus === 200) {
                let responseObj = JSON.parse(response);
    
                if(responseObj.SUCCESS === "TRUE") {
                  self.setState(prevState => ({data: {...prevState.data, party_id: responseObj.DATA[0].party_id}}));
                  self.setState({ partyData: responseObj.DATA[0]});
                } else {
                  self.setState({ partyErrorMessage: responseObj.MESSAGE});
                }
              } else {
                self.setState({ partyErrorMessage: "Something went wrong trying to get data."});
                console.log('Response Status : ', responseStatus);
              }
            }).catch(function(ex) {
              self.setState({ isPartyLoading: false});
              self.setState({ partyErrorMessage: "Something went wrong parsing data."});
              console.log('Parsing Failed : ', ex);
            })
        } else {
          self.setState({ isPartyLoading: false});
          self.setState({ partyErrorMessage: "Login Token is missing."});
        }
    }

    productOptionData(productList) {
        let productOptionData = (productList.map((product) =>
            <option key={product.product_id} value={product.product_id}> {product.product_name} </option>
        ))
        productOptionData.splice(0, 0, <option key='' value=''></option>)

        return productOptionData;
    }

    onProductChange(key, productData) {
        let data = Object.assign({}, this.state.data);    //creating copy of object
        let ii_json_data = data.ii_json_data;
        ii_json_data[key].max_ii_id = key+1;
        if(productData) {
            ii_json_data[key].ii_id = productData.product_id;
            ii_json_data[key].ii_product_name = productData.product_name;
            ii_json_data[key].ii_hsn_no = productData.product_hsn_no;
            ii_json_data[key].ii_rate = productData.product_rate;
            ii_json_data[key].ii_cgst = productData.product_cgst;
            ii_json_data[key].ii_sgst = productData.product_sgst;
            ii_json_data[key].ii_igst = productData.product_igst;
        } else {
            ii_json_data[key].ii_id = '';
            ii_json_data[key].ii_product_name = '';
            ii_json_data[key].ii_hsn_no = '';
            ii_json_data[key].ii_rate = '';
            ii_json_data[key].ii_cgst = '';
            ii_json_data[key].ii_sgst = '';
            ii_json_data[key].ii_igst = '';
        }
        this.setState({data});
        this.setState({itemData: {}});
    }

    handleProductInputChange(key, event) {
        const target = event.target;
        const value = target.value;
        const name = target.name;

        let data = Object.assign({}, this.state.data);    //creating copy of object
        let ii_json_data = data.ii_json_data;
        ii_json_data[key][name] = value;                        //updating value
        this.setState({data});
    }

    tableBody(data, productList) {
        let productOptionData = productList ? this.productOptionData(productList) : '';
        if(data && data.ii_json_data && data.ii_json_data.length > 0) {
            const tableBody = data.ii_json_data.map((productData, key) =>
            <tr key={key}>
                <td>{key+1}</td>
                <td>
                    <select onChange={(event) => this.onProductChange(key, productList[event.target.value])}>
                        {productOptionData}
                    </select>
                </td>
                <td>
                    <input name="ii_hsn_no" type="text" value={productData.ii_hsn_no ? productData.ii_hsn_no : ''} onChange={(event) => this.handleProductInputChange(key, event)}/>
                </td>
                <td>
                    <input name="ii_qnt" type="text" value={productData.ii_qnt ? productData.ii_qnt : ''} onChange={(event) => this.handleProductInputChange(key, event)}/>
                </td>
                <td>
                    <input name="ii_rate" type="text" value={productData.ii_rate ? productData.ii_rate : ''} onChange={(event) => this.handleProductInputChange(key, event)}/>
                </td>
                <td>
                    <input name="ii_cgst" type="text" value={productData.ii_cgst ? productData.ii_cgst : ''} onChange={(event) => this.handleProductInputChange(key, event)}/>
                </td>
                <td>
                    <input name="ii_sgst" type="text" value={productData.ii_sgst ? productData.ii_sgst : ''} onChange={(event) => this.handleProductInputChange(key, event)}/>
                </td>
                <td>
                    <input name="ii_igst" type="text" value={productData.ii_igst ? productData.ii_igst : ''} onChange={(event) => this.handleProductInputChange(key, event)}/>
                </td>
                <td>
                    <input type="text" value={productData.ii_qnt && productData.ii_rate ? productData.ii_qnt * productData.ii_rate : ''}/>
                </td>
            </tr>
            );
    
            return tableBody;
        }
    }

    onAddProductClick() {
        let data = Object.assign({}, this.state.data);    //creating copy of object
        let ii_json_data = data.ii_json_data;
        const itemData = this.state.itemData;
        ii_json_data.push(itemData)
        this.setState({data});
        this.setState({itemData: {}});
    }
  
    render() {
        const { isLoading, errorMessage, data, isError, partyList, partyData, 
            isPartyLoading, partyErrorMessage, isProductLoading, productList, 
            productErrorMessage } = this.state;
        let partyOptionData = partyList ? this.partyOptionData(partyList) : '';
        const tableBody = this.tableBody(data, productList);
        
        return (
        <div>
            {isLoading ? <p>Loading... Please wait.</p> : ""}
            <p>{errorMessage}</p>
            <div>
                {isPartyLoading ? <p>Loading... Please wait.</p> : ""}
                <p>{partyErrorMessage}</p>
                <select onChange={(event) => this.onPartyChange(event.target.value)}>
                    {partyOptionData}
                </select>
                {isError && !isPartyLoading && !partyData ? "This field is required." : ""}
            </div>
            {
                partyData
                ?
                <div>
                    <div>
                        <p>{partyData.party_id}</p>
                    </div>
                    <div>
                        <p>{partyData.party_name}</p>
                    </div>
                    <div>
                        <p>{partyData.party_contact_person}</p>
                    </div>
                    <div>
                        <p>{partyData.party_gstin}</p>
                    </div>
                    <div>
                        <p>{partyData.party_pan_no}</p>
                    </div>
                    <div>
                        <p>{partyData.party_mobile}</p>
                    </div>
                    <div>
                        <p>{partyData.party_address}</p>
                    </div>
                    <div>
                        <p>{partyData.party_city}</p>
                    </div>
                    <div>
                        <p>{partyData.party_state}</p>
                    </div>
                    <div>
                        <p>{partyData.party_pincode}</p>
                    </div>
                </div>
                :
                ''
            }
            <div>
                <input name="invoice_date" type="text" value={data.invoice_date} onChange={(event) => this.handleInputChange(event)}/>
                {isError && !data.invoice_date ? "This field is required." : ""}
            </div>
            <div>
                <input name="invoice_number" type="text" value={data.invoice_number} onChange={(event) => this.handleInputChange(event)}/>
                {isError && !data.invoice_number ? "This field is required." : ""}
            </div>
            <div>
                <input name="truck_no" type="text" value={data.truck_no} onChange={(event) => this.handleInputChange(event)}/>
                {isError && !data.truck_no ? "This field is required." : ""}
            </div>
            <div>
                <input name="transport" type="text" value={data.transport} onChange={(event) => this.handleInputChange(event)}/>
                {isError && !data.transport ? "This field is required." : ""}
            </div>
            <div>
                <input name="l_r_no" type="text" value={data.l_r_no} onChange={(event) => this.handleInputChange(event)}/>
                {isError && !data.l_r_no ? "This field is required." : ""}
            </div>
            <div>
                {isProductLoading ? <p>Loading... Please wait.</p> : ""}
                <p>{productErrorMessage}</p>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>HSN No.</th>
                            <th>Quantity</th>
                            <th>Rate</th>
                            <th>CGST</th>
                            <th>SGST</th>
                            <th>IGST</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        {tableBody}
                    </tbody>
                </table>
                <button onClick={() => this.onAddProductClick()}>+</button>
            </div>
            <div>
                <button onClick={() => this.onCancleClick()}>Cancle</button>
                <button onClick={() => this.onSaveClick(data)}>Save</button>
            </div>
        </div>
        );
    }
}