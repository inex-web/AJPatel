import React, { Component } from 'react';
import { productEdit } from '../../../rest/Rest';
import { getSessionStorage } from '../../../commons/utils/Utils';
import { loginToken,
  userLoginToken,
  productId,
  productName,
  productHsnNo,
  productRate,
  productUnit,
  productCGST,
  productSGST,
  productIGST
} from '../../../commons/constants/Constants';

export default class ProductView extends Component {
  
  constructor(props) {
    super(props);
    this.state = {
      editedData: '',
      isEditable: false,
      isError: false
    }
    
    this.onEditClick = this.onEditClick.bind(this);
    this.handleInputChange = this.handleInputChange.bind(this);
    this.onCancleClick = this.onCancleClick.bind(this);
    this.onSaveClick = this.onSaveClick.bind(this);
    this.saveProductData = this.saveProductData.bind(this);
  }

  handleInputChange(event) {
    const target = event.target;
    const value = target.value;
    const name = target.name;

    this.setState({ editedData: { ...this.state.editedData, [name]: value} });
  }

  onEditClick() {
    this.setState({editedData: this.props.data});
    this.setState({isEditable: true});
  }

  onCancleClick() {
    this.setState({editedData: ''});
    this.setState({isEditable: false});
  }

  onSaveClick(editedData) {
    if(editedData.product_name && 
      editedData.product_hsn_no && 
      editedData.product_rate &&
      editedData.product_unit &&
      editedData.product_cgst &&
      editedData.product_sgst &&
      editedData.product_igst) {
        this.saveProductData(editedData);
    } else {
      this.setState({isError: true});
    }
  }

  saveProductData(editedData) {
    const self = this;
    self.props.updateState('isLoading', true);

    var FormData = require('form-data');
    var form = new FormData();
    form.append(loginToken, getSessionStorage(userLoginToken));
    form.append(productId, editedData.product_id);
    form.append(productName, editedData.product_name);
    form.append(productHsnNo, editedData.product_hsn_no);
    form.append(productRate, editedData.product_rate);
    form.append(productUnit, editedData.product_unit);
    form.append(productCGST, editedData.product_cgst);
    form.append(productSGST, editedData.product_sgst);
    form.append(productIGST, editedData.product_igst);

    let responseStatus;
    productEdit(form)
      .then(function(response) {
        responseStatus = response.status;
        return response.text();
      }).then(function(response) {
        self.props.updateState('isLoading', false);

        if(responseStatus === 200) {
          let responseObj = JSON.parse(response);

          if(responseObj.SUCCESS === "TRUE") {
            self.setState({isEditable: false});
            self.props.updateState('data', editedData);
          } else {
            self.props.updateState('errorMessage', responseObj.MESSAGE);
          }
        } else {
          self.props.updateState('errorMessage', "Something went wrong trying to get data.");
          console.log('Response Status : ', responseStatus);
        }
      }).catch(function(ex) {
        self.props.updateState('isLoading', false);
        self.props.updateState('errorMessage', "Something went wrong parsing data.");
        console.log('Parsing Failed : ', ex);
      })
  }

  render() {
    const { data, isLoading, errorMessage } = this.props;
    const { editedData, isEditable, isError } = this.state;
    
    return (
      <div>
        {isLoading ? <p>Loading... Please wait.</p> : ""}
        {!errorMessage && !isEditable && !isLoading ? <button onClick={() => this.onEditClick()}>Edit</button> : ''}
        <p>{errorMessage}</p>
        {isEditable
        ?
        <div><p>{data.product_id}</p></div>
        :
        <div>{!isLoading ? <p>{data.product_id}</p> : '' }</div>
        }
        {isEditable
        ?
        <div>
        <input name="product_name" type="text" value={editedData.product_name} onChange={(event) => this.handleInputChange(event)}/>
        {isError && !editedData.product_name ? "This field is required." : ""}
        </div>
        :
        <div>{!isLoading ? <p>{data.product_name}</p> : '' }</div>
        }
        {isEditable
        ?
        <div>
        <input name="product_hsn_no" type="text" value={editedData.product_hsn_no} onChange={(event) => this.handleInputChange(event)}/>
        {isError && !editedData.product_hsn_no ? "This field is required." : ""}
        </div>
        :
        <div>{!isLoading ? <p>{data.product_hsn_no}</p> : '' }</div>
        }
        {isEditable
        ?
        <div>
        <input name="product_rate" type="text" value={editedData.product_rate} onChange={(event) => this.handleInputChange(event)}/>
        {isError && !editedData.product_rate ? "This field is required." : ""}
        </div>
        :
        <div>{!isLoading ? <p>{data.product_rate}</p> : '' }</div>
        }
        {isEditable
        ?
        <div>
        <input name="product_unit" type="text" value={editedData.product_unit} onChange={(event) => this.handleInputChange(event)}/>
        {isError && !editedData.product_unit ? "This field is required." : ""}
        </div>
        :
        <div>{!isLoading ? <p>{data.product_unit}</p> : '' }</div>
        }
        {isEditable
        ?
        <div>
        <input name="product_cgst" type="text" value={editedData.product_cgst} onChange={(event) => this.handleInputChange(event)}/>
        {isError && !editedData.product_cgst ? "This field is required." : ""}
        </div>
        :
        <div>{!isLoading ? <p>{data.product_cgst}</p> : '' }</div>
        }
        {isEditable
        ?
        <div>
        <input name="product_sgst" type="text" value={editedData.product_sgst} onChange={(event) => this.handleInputChange(event)}/>
        {isError && !editedData.product_sgst ? "This field is required." : ""}
        </div>
        :
        <div>{!isLoading ? <p>{data.product_sgst}</p> : '' }</div>
        }
        {isEditable
        ?
        <div>
        <input name="product_igst" type="text" value={editedData.product_igst} onChange={(event) => this.handleInputChange(event)}/>
        {isError && !editedData.product_igst ? "This field is required." : ""}
        </div>
        :
        <div>{!isLoading ? <p>{data.product_igst}</p> : '' }</div>
        }
        {isEditable
        ?
        <div>
          <button onClick={() => this.onCancleClick()}>Cancle</button>
          <button onClick={() => this.onSaveClick(editedData)}>Save</button>
        </div>
        :
        ''
        }
      </div>
    );
  }
}