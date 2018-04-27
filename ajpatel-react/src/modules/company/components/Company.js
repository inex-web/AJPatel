import React, { Component } from 'react';
import { adminView,
  adminEdit
} from '../../../rest/Rest';
import { getSessionStorage } from '../../../commons/utils/Utils';
import { loginToken,
  userLoginToken,
  name,
  mobile,
  email,
  company,
  tagline,
  address,
  city,
  state,
  pincode,
  gstin,
  panNo
} from '../../../commons/constants/Constants';

export default class Company extends Component {
  
  constructor(props) {
    super(props);
    this.state = {
      data: '',
      editedData: '',
      isError: false,
      errorMessage: '',
      isEditable: false,
      isLoading: false
    }
    
    this.getCompanydata = this.getCompanydata.bind(this);
    this.onEditClick = this.onEditClick.bind(this);
    this.handleInputChange = this.handleInputChange.bind(this);
    this.onCancleClick = this.onCancleClick.bind(this);
    this.onSaveClick = this.onSaveClick.bind(this);
    this.saveCompanyData = this.saveCompanyData.bind(this);
  }

  componentDidMount() {
    this.setState({isLoading: true});
    this.getCompanydata();
  }

  getCompanydata() {
    const self = this;

    if(getSessionStorage(userLoginToken)) {
      var FormData = require('form-data');
      var form = new FormData();
      form.append(loginToken, getSessionStorage(userLoginToken));     

      let responseStatus;
      adminView(form)
        .then(function(response) {
          responseStatus = response.status;
          return response.text();
        }).then(function(response) {
          self.setState({isLoading: false});

          if(responseStatus === 200) {
            let responseObj = JSON.parse(response);

            if(responseObj.SUCCESS === "TRUE") {
              let data = responseObj.data[0];
              
              self.setState({data: data});
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

  onEditClick() {
    this.setState({editedData: this.state.data});
    this.setState({isEditable: true});
  }

  handleInputChange(event) {
    const target = event.target;
    const value = target.value;
    const name = target.name;

    this.setState({ editedData: { ...this.state.editedData, [name]: value} });
  }

  onCancleClick() {
    this.setState({editedData: ''});
    this.setState({isEditable: false});
  }

  saveCompanyData(editedData) {
    const self = this;

    var FormData = require('form-data');
      var form = new FormData();
      form.append(loginToken, getSessionStorage(userLoginToken));
      form.append(name, editedData.user_name);
      form.append(mobile, editedData.user_mobile);
      form.append(email, editedData.user_email);
      form.append(company, editedData.user_company);
      form.append(tagline, editedData.user_tagline);
      form.append(address, editedData.user_address);
      form.append(city, editedData.user_city);
      form.append(state, editedData.user_state);
      form.append(pincode, editedData.user_pincode);
      form.append(gstin, editedData.user_gstin);
      form.append(panNo, editedData.user_pan_no);

      let responseStatus;
      adminEdit(form)
        .then(function(response) {
          responseStatus = response.status;
          return response.text();
        }).then(function(response) {
          self.setState({isLoading: false});

          if(responseStatus === 200) {
            let responseObj = JSON.parse(response);

            if(responseObj.SUCCESS === "TRUE") {
              self.setState({isEditable: false});
              self.getCompanydata();
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

  onSaveClick(editedData) {
    if(editedData.user_company && 
      editedData.user_tagline && 
      editedData.user_address &&
      editedData.user_city &&
      editedData.user_state &&
      editedData.user_pincode &&
      editedData.user_gstin &&
      editedData.user_pan_no) {
        this.setState({isLoading: true});
        this.saveCompanyData(editedData);
    } else {
      this.setState({isError: true});
    }
  }
  
  render() {
    const { data, editedData, errorMessage, isEditable, isError, isLoading } = this.state;
    
    return (
      <div>
      {isLoading ? <p>Loading... Please wait.</p> : ""}
      {!errorMessage && !isEditable && !isLoading ? <button onClick={() => this.onEditClick()}>Edit</button> : ''}
      <p>{errorMessage}</p>
      {isEditable
      ?
      <div>
      <input name="user_company" type="text" value={editedData.user_company} onChange={(event) => this.handleInputChange(event)}/>
      {isError && !editedData.user_company ? "This field is required." : ""}
      </div>
      :
      <div>{!isLoading ? <p>{data.user_company}</p> : '' }</div>
      }
      {isEditable
      ?
      <div>
      <input name="user_tagline" type="text" value={editedData.user_tagline} onChange={(event) => this.handleInputChange(event)}/>
      {isError && !editedData.user_tagline ? "This field is required." : ""}
      </div>
      :
      <div>{!isLoading ? <p>{data.user_tagline}</p> : '' }</div>
      }
      {isEditable
      ?
      <div>
      <input name="user_address" type="text" value={editedData.user_address} onChange={(event) => this.handleInputChange(event)}/>
      {isError && !editedData.user_address ? "This field is required." : ""}
      </div>
      :
      <div>{!isLoading ? <p>{data.user_address}</p> : '' }</div>
      }
      {isEditable
      ?
      <div>
      <input name="user_city" type="text" value={editedData.user_city} onChange={(event) => this.handleInputChange(event)}/>
      {isError && !editedData.user_city ? "This field is required." : ""}
      </div>
      :
      <div>{!isLoading ? <p>{data.user_city}</p> : '' }</div>
      }
      {isEditable
      ?
      <div>
      <input name="user_state" type="text" value={editedData.user_state} onChange={(event) => this.handleInputChange(event)}/>
      {isError && !editedData.user_state ? "This field is required." : ""}
      </div>
      :
      <div>{!isLoading ? <p>{data.user_state}</p> : '' }</div>
      }
      {isEditable
      ?
      <div>
      <input name="user_pincode" type="text" value={editedData.user_pincode} onChange={(event) => this.handleInputChange(event)}/>
      {isError && !editedData.user_pincode ? "This field is required." : ""}
      </div>
      :
      <div>{!isLoading ? <p>{data.user_pincode}</p> : '' }</div>
      }
      {isEditable
      ?
      <div>
      <input name="user_gstin" type="text" value={editedData.user_gstin} onChange={(event) => this.handleInputChange(event)}/>
      {isError && !editedData.user_gstin ? "This field is required." : ""}
      </div>
      :
      <div>{!isLoading ? <p>{data.user_gstin}</p> : '' }</div>
      }
      {isEditable
      ?
      <div>
      <input name="user_pan_no" type="text" value={editedData.user_pan_no} onChange={(event) => this.handleInputChange(event)}/>
      {isError && !editedData.user_pan_no ? "This field is required." : ""}
      </div>
      :
      <div>{!isLoading ? <p>{data.user_pan_no}</p> : '' }</div>
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