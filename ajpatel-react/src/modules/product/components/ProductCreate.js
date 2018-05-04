import React, { Component } from 'react';
import { productCreate } from '../../../rest/Rest';
import { getSessionStorage } from '../../../commons/utils/Utils';
import { loginToken,
    userLoginToken,
    productName,
    productHsnNo,
    productRate,
    productUnit,
    productCGST,
    productSGST,
    productIGST
  } from '../../../commons/constants/Constants';

export default class ProductCreate extends Component {

    constructor(props) {
        super(props);
        this.state = {
            data: {
                product_name: "",
                product_hsn_no: "",
                product_rate: "",
                product_unit: "",
                product_cgst: "",
                product_sgst: "",
                product_igst: ""
            },
            isLoading: false,
            errorMessage: '',
            isError: false
        }
        
        this.handleInputChange = this.handleInputChange.bind(this);
        this.onCancleClick = this.onCancleClick.bind(this);
        this.onSaveClick = this.onSaveClick.bind(this);
        this.createProductData = this.createProductData.bind(this);
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
        if(data.product_name && 
            data.product_hsn_no && 
            data.product_rate &&
            data.product_unit &&
            data.product_cgst &&
            data.product_sgst &&
            data.product_igst) {
            this.createProductData(data);
        } else {
          this.setState({isError: true});
        }
    }

    createProductData(data) {
        const self = this;
        self.setState({isLoading: true});

        var FormData = require('form-data');
        var form = new FormData();
        form.append(loginToken, getSessionStorage(userLoginToken));
        form.append(productName, data.product_name);
        form.append(productHsnNo, data.product_hsn_no);
        form.append(productRate, data.product_rate);
        form.append(productUnit, data.product_unit);
        form.append(productCGST, data.product_cgst);
        form.append(productSGST, data.product_sgst);
        form.append(productIGST, data.product_igst);

        let responseStatus;
        productCreate(form)
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

    render() {
        const { isLoading, errorMessage, data, isError } = this.state;
        
        return (
        <div>
            {isLoading ? <p>Loading... Please wait.</p> : ""}
            <p>{errorMessage}</p>
            <div>
                <input name="product_name" type="text" value={data.product_name} onChange={(event) => this.handleInputChange(event)}/>
                {isError && !data.product_name ? "This field is required." : ""}
            </div>
            <div>
                <input name="product_hsn_no" type="text" value={data.product_hsn_no} onChange={(event) => this.handleInputChange(event)}/>
                {isError && !data.product_hsn_no ? "This field is required." : ""}
            </div>
            <div>
                <input name="product_rate" type="text" value={data.product_rate} onChange={(event) => this.handleInputChange(event)}/>
                {isError && !data.product_rate ? "This field is required." : ""}
            </div>
            <div>
                <input name="product_unit" type="text" value={data.product_unit} onChange={(event) => this.handleInputChange(event)}/>
                {isError && !data.product_unit ? "This field is required." : ""}
            </div>
            <div>
                <input name="product_cgst" type="text" value={data.product_cgst} onChange={(event) => this.handleInputChange(event)}/>
                {isError && !data.product_cgst ? "This field is required." : ""}
            </div>
            <div>
                <input name="product_sgst" type="text" value={data.product_sgst} onChange={(event) => this.handleInputChange(event)}/>
                {isError && !data.product_sgst ? "This field is required." : ""}
            </div>
            <div>
                <input name="product_igst" type="text" value={data.product_igst} onChange={(event) => this.handleInputChange(event)}/>
                {isError && !data.product_igst ? "This field is required." : ""}
            </div>
            <div>
                <button onClick={() => this.onCancleClick()}>Cancle</button>
                <button onClick={() => this.onSaveClick(data)}>Save</button>
            </div>
        </div>
        );
    }
}