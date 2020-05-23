import React from 'react';

const BASEURL = "http://localhost/Intractive/";
const APIURL = `${BASEURL}api/logged_user`;
const EARNINGSAPI = `${BASEURL}api/fetch_earnings`;
const SALESAPI = `${BASEURL}api/fetch_sales`;
const USERSAPI = `${BASEURL}api/fetch_users`;
const HOTELSAPI = `${BASEURL}api/fetch_hotels`;
const LOGOIMG = `${BASEURL}assets/images/icons/logo.png`;
const ADMINURL = `${BASEURL}admin/`;
const LOGOUTURL = `${BASEURL}dashboard/logout`;
const PROFILEURL = `${BASEURL}profile/view`;
const HOTELURL = `${ADMINURL}showData`;
const ORDERURL = `${ADMINURL}showOrders`;
const USERSURL = `${ADMINURL}showUsers`;
const URLAPI = "http://localhost/Intractive/api/fetch_statistics";


const borderColor = {
  borderColor: '#3f51b5'
};

const imageMaxWidth = {
  maxWidth: '60px'
};

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
          <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                aria-labelledby="searchDropdown">
                <form class="navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-1 small" placeholder="What do you want to look for?"
                      aria-label="Search" aria-describedby="basic-addon2" style={borderColor}/>
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>
            <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="https://github.com/lauslim12/intract-hotel-system" id="searchDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fab fa-fw fa-github"></i>
              </a>
            </li>
            <div class="topbar-divider d-none d-sm-block"></div>
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <img class="img-profile rounded-circle" src={BASEURL + this.state.data.profile_pic} style={imageMaxWidth}></img>
                <span class="ml-2 d-none d-lg-inline text-white small">{this.state.data.username}</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href={PROFILEURL + '/' + this.state.data.username}>
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href={LOGOUTURL}>
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
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