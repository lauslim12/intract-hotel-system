import React from 'react';
import { StyleSheet, css } from 'aphrodite';
import { BASEURL, APIURL, LOGOUTURL, PROFILEURL } from '../react-variables/Variables';

const aphroditeStyle = StyleSheet.create({
  imageProfile: {
    maxWidth: '60px',
    height: '2rem',
    width: '2rem',
    border: '1px solid #fafafa'
  }
});

class Header extends React.Component {  
  constructor(props) {
    super(props);
    this.state = {
      data: [],
      fullName: ''
    };
  }

  componentDidMount() {
    fetch(APIURL)
      .then(res => res.json())
      .then(res => this.setState({data: res}));
    this.slider();
  }

  slider() {
    // Toggle the side navigation
    $("#sidebarToggle, #sidebarToggleTop").on('click', function(e) {
      $("body").toggleClass("sidebar-toggled");
      $(".sidebar").toggleClass("toggled");
      if ($(".sidebar").hasClass("toggled")) {
        $('.sidebar .collapse').collapse('hide');
      };
    });
  }

  render() {
    return (
      <nav className="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
          <button id="sidebarToggleTop" className="btn btn-link rounded-circle mr-3">
            <i className="fa fa-bars"></i>
          </button>
          <ul className="navbar-nav ml-auto">
            <li className="nav-item dropdown no-arrow">
              <a className="nav-link dropdown-toggle" href="https://github.com/lauslim12/intract-hotel-system" id="searchDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i className="fab fa-fw fa-github"></i>
              </a>
            </li>
            <div className="topbar-divider d-none d-sm-block"></div>
            <li className="nav-item dropdown no-arrow">
              <a className="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <img className={`rounded-circle ${css(aphroditeStyle.imageProfile)}`} src={BASEURL + this.state.data.profile_pic}></img>
                <span className="ml-2 d-none d-lg-inline text-white small">{this.state.data.username}</span>
              </a>
              <div className="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a className="dropdown-item" href={PROFILEURL + '/' + this.state.data.username}>
                  <i className="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <div className="dropdown-divider"></div>
                <a className="dropdown-item" href={LOGOUTURL}>
                  <i className="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
      </nav>
    )
  }
}

export default Header;