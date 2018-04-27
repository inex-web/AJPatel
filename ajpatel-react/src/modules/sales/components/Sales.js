import React, { Component } from 'react';
import { login } from '../../../rest/Rest';

export default class Sales extends Component {
  
  constructor(props) {
    super(props);
    this.state = {
      
      
    }
    //console.log("sales constructor called")
  }
  
  componentDidMount() {
    var FormData = require('form-data');
    var form = new FormData();
    form.append('login_email_mob', '9898989898');
    form.append('login_password', 'Test1234');
    
    login(form)
      .then(function(response) {
        console.log(response)
        return response.text();
      }).then(function(response) {
        console.log(response)
      }).catch(function(ex) {
        console.log('parsing failed', ex)
      })
  }
  
  render() {
    
    return (
      <div>
      Sales
      </div>
    );
  }
}