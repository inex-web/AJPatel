import React, { Component } from 'react';
import { partyCreate } from '../../../rest/Rest';
import { getSessionStorage } from '../../../commons/utils/Utils';
import { loginToken,
    userLoginToken,
    partyName,
    partyMobile,
    partyContactPerson,
    partyAddress,
    partyCity,
    partyState,
    partyPincode,
    partyGstin,
    partyPanNo
  } from '../../../commons/constants/Constants';

export default class PartyCreate extends Component {

    constructor(props) {
        super(props);
        this.state = {
            data: {
                party_name: "",
                party_mobile: "",
                party_contact_person: "",
                party_address: "",
                party_city: "",
                party_state: "",
                party_pincode: "",
                party_gstin: "",
                party_pan_no: ""
            },
            isLoading: false,
            errorMessage: '',
            isError: false
        }
        
        this.handleInputChange = this.handleInputChange.bind(this);
        this.onCancleClick = this.onCancleClick.bind(this);
        this.onSaveClick = this.onSaveClick.bind(this);
        this.createPartyData = this.createPartyData.bind(this);
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
        if(data.party_name && 
            data.party_mobile && 
            data.party_contact_person &&
            data.party_address &&
            data.party_city &&
            data.party_state &&
            data.party_pincode &&
            data.party_gstin &&
            data.party_pan_no) {
            this.createPartyData(data);
        } else {
          this.setState({isError: true});
        }
    }

    createPartyData(data) {
        const self = this;
        self.setState({isLoading: true});

        var FormData = require('form-data');
        var form = new FormData();
        form.append(loginToken, getSessionStorage(userLoginToken));
        form.append(partyName, data.party_name);
        form.append(partyMobile, data.party_mobile);
        form.append(partyContactPerson, data.party_contact_person);
        form.append(partyAddress, data.party_address);
        form.append(partyCity, data.party_city);
        form.append(partyState, data.party_state);
        form.append(partyPincode, data.party_pincode);
        form.append(partyGstin, data.party_gstin);
        form.append(partyPanNo, data.party_pan_no);

        let responseStatus;
        partyCreate(form)
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
                <input name="party_name" type="text" value={data.party_name} onChange={(event) => this.handleInputChange(event)}/>
                {isError && !data.party_name ? "This field is required." : ""}
            </div>
            <div>
                <input name="party_mobile" type="text" value={data.party_mobile} onChange={(event) => this.handleInputChange(event)}/>
                {isError && !data.party_mobile ? "This field is required." : ""}
            </div>
            <div>
                <input name="party_contact_person" type="text" value={data.party_contact_person} onChange={(event) => this.handleInputChange(event)}/>
                {isError && !data.party_contact_person ? "This field is required." : ""}
            </div>
            <div>
                <input name="party_address" type="text" value={data.party_address} onChange={(event) => this.handleInputChange(event)}/>
                {isError && !data.party_address ? "This field is required." : ""}
            </div>
            <div>
                <input name="party_city" type="text" value={data.party_city} onChange={(event) => this.handleInputChange(event)}/>
                {isError && !data.party_city ? "This field is required." : ""}
            </div>
            <div>
                <input name="party_state" type="text" value={data.party_state} onChange={(event) => this.handleInputChange(event)}/>
                {isError && !data.party_state ? "This field is required." : ""}
            </div>
            <div>
                <input name="party_pincode" type="text" value={data.party_pincode} onChange={(event) => this.handleInputChange(event)}/>
                {isError && !data.party_pincode ? "This field is required." : ""}
            </div>
            <div>
                <input name="party_gstin" type="text" value={data.party_gstin} onChange={(event) => this.handleInputChange(event)}/>
                {isError && !data.party_gstin ? "This field is required." : ""}
            </div>
            <div>
                <input name="party_pan_no" type="text" value={data.party_pan_no} onChange={(event) => this.handleInputChange(event)}/>
                {isError && !data.party_pan_no ? "This field is required." : ""}
            </div>
            <div>
                <button onClick={() => this.onCancleClick()}>Cancle</button>
                <button onClick={() => this.onSaveClick(data)}>Save</button>
            </div>
        </div>
        );
    }
}