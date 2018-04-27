import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import basePath from '../../utils/basePath';
import { getSessionStorage,
  clearSessionStorage
} from '../../../commons/utils/Utils';
import { userLoginToken,
  userName
} from '../../../commons/constants/Constants';
import { Redirect } from 'react-router';

export class Header extends Component {

  constructor(props) {
    super(props);
    this.state = {
      userName: '',
      redirect: false
    }
  }
  
  componentDidMount() {
    if(getSessionStorage(userLoginToken) && getSessionStorage(userName)) {
      this.setState({userName: getSessionStorage(userName)});
    } else {
      this.setState({redirect: true});
    }
  }

  onLogoutClick() {
    clearSessionStorage();
    this.setState({redirect: true});
  }

  render() {
    const { userName, redirect } = this.state;

    if(redirect) {
      return <Redirect to={basePath`login`}/>;
    }
    
    return (
      <div className="header_wrapper">
        <nav className="navbar navbar-expand-sm bg-light">
          <h1>A. J. Patel & Co.</h1>
          <ul className="navbar-nav">
            <li className="nav-item">
              <Link to={basePath``} className="nav-link">Home</Link>
            </li>
            <li className="nav-item">
              <Link to={basePath`sales`} className="nav-link">Sales</Link>
            </li>
            <li className="nav-item">
              <Link to={basePath`party`} className="nav-link">Party</Link>
            </li>
            <li className="nav-item">
              <Link to={basePath`product`} className="nav-link">Product</Link>
            </li>
            <li className="nav-item">
              <Link to={basePath`company`} className="nav-link">Company</Link>
            </li>
          </ul>
          <h6>Welcome <b>{userName}</b></h6>
          <span onClick={() => this.onLogoutClick()}>Logout</span>
        </nav>
      </div>
    );
  }
}
