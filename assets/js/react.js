/*
*   No DOM imports because this script does not use Node for the React components!
*   Only one page because only this admin panel that uses React.
*   Mainly using ES6 syntax.
*/

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

const borderColor = {
  borderColor: '#3f51b5'
};

const imageMaxWidth = {
  maxWidth: '60px'
};

class AlertsCenter extends React.Component {
  render() {
    return (
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-bell fa-fw"></i>
          <span class="badge badge-danger badge-counter">3+</span>
        </a>
        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
          aria-labelledby="alertsDropdown">
          <h6 class="dropdown-header">
            Alerts Center
          </h6>
          <a class="dropdown-item d-flex align-items-center" href="#">
            <div class="mr-3">
              <div class="icon-circle bg-primary">
                <i class="fas fa-file-alt text-white"></i>
              </div>
            </div>
            <div>
              <div class="small text-gray-500">December 12, 2019</div>
              <span class="font-weight-bold">A new monthly report is ready to download!</span>
            </div>
          </a>
          <a class="dropdown-item d-flex align-items-center" href="#">
            <div class="mr-3">
              <div class="icon-circle bg-success">
                <i class="fas fa-donate text-white"></i>
              </div>
            </div>
            <div>
              <div class="small text-gray-500">December 7, 2019</div>
              $290.29 has been deposited into your account!
            </div>
          </a>
          <a class="dropdown-item d-flex align-items-center" href="#">
            <div class="mr-3">
              <div class="icon-circle bg-warning">
                <i class="fas fa-exclamation-triangle text-white"></i>
              </div>
            </div>
            <div>
              <div class="small text-gray-500">December 2, 2019</div>
              Spending Alert: We've noticed unusually high spending for your account.
            </div>
          </a>
          <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
        </div>
      </li>
    ) 
  }
}

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

class SidebarDropdown extends React.Component {
  render() {
    return (
      <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Hotel Management</h6>
          <a class="collapse-item" href="alerts.html">New Hotel</a>
          <a class="collapse-item" href="buttons.html">Edit Hotel</a>
          <a class="collapse-item" href="dropdowns.html">Delete Hotel</a>
        </div>
      </div>
    )
  }
}

class Sidebar extends React.Component {
  render() {
    return (
      <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href={ADMINURL}>
        <div class="sidebar-brand-icon">
          <img src={LOGOIMG} />
        </div>
        <div class="sidebar-brand-text mx-3">Admin</div>
      </a>
      <hr class="sidebar-divider my-0" />
      <li class="nav-item active">
        <a class="nav-link" href={ADMINURL}>
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Panel</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href={BASEURL}>
          <i class="fas fa-fw fa-hotel"></i>
          <span>Intractive</span></a>
      </li>
      <hr class="sidebar-divider" />
      <div class="sidebar-heading">
        Manage Hotels
      </div>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
          aria-expanded="true" aria-controls="collapseBootstrap">
          <i class="fab fa-fw fa-wpforms"></i>
          <span>Manage Hotels</span>
        </a>
        <SidebarDropdown/>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTable" aria-expanded="true"
          aria-controls="collapseTable">
          <i class="fas fa-fw fa-table"></i>
          <span>Tables</span>
        </a>
        <div id="collapseTable" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Tables</h6>
            <a class="collapse-item" href={HOTELURL}>All Hotels</a>
            <a class="collapse-item" href={ORDERURL}>All Orders</a>
            <a class="collapse-item" href={USERSURL}>All Users</a>
          </div>
        </div>
      </li>
      <hr class="sidebar-divider"/>
    </ul>
    )
  }
}

class HeadBar extends React.Component {
  render() {
    return (
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="./">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
      </div>
    )
  }
}

class CardStatisticsOne extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      earnings: 0
    };
  }
  
  componentDidMount() {
    fetch(EARNINGSAPI)
      .then(res => res.json())
      .then(res => this.setState({earnings: res}));
  }

  toCommas(value) {
    return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
  }

  render() {
    let earnings = this.state.earnings;
    earnings = this.toCommas(earnings);

    return (
      <div class="card h-100">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">Earnings (Rp.)</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{earnings}</div>
              <div class="mt-2 mb-0 text-muted text-xs">
                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 5.3%</span>
                <span>Nice!</span>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-calendar fa-2x text-primary"></i>
            </div>
          </div>
        </div>
      </div>
    )
  }
}

class CardStatisticsTwo extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      sales: 0
    };
  }
  
  componentDidMount() {
    fetch(SALESAPI)
      .then(res => res.json())
      .then(res => this.setState({sales: res}));
  }

  render() {
    return (
      <div class="card h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">Sales</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{this.state.sales}</div>
              <div class="mt-2 mb-0 text-muted text-xs">
                <span class="text-success mr-2"><i class="fas fa-arrow-up"></i>12%</span>
                <span>Since last year!</span>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-shopping-cart fa-2x text-success"></i>
            </div>
          </div>
        </div>
      </div>
    )
  }
}

class CardStatisticsThree extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      users: 0
    };
  }

  componentDidMount() {
    fetch(USERSAPI)
      .then(res => res.json())
      .then(res => this.setState({users: res}));
  }
  
  render() {
    return (
      <div class="card h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">Users</div>
              <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{this.state.users}</div>
              <div class="mt-2 mb-0 text-muted text-xs">
                <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 20.4%</span>
                <span>Since last month</span>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-users fa-2x text-info"></i>
            </div>
          </div>
        </div>
      </div>
    )
  }
}

class CardStatisticsFour extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      hotels: 0
    };
  }

  componentDidMount() {
    fetch(HOTELSAPI)
      .then(res => res.json())
      .then(res => this.setState({hotels: res}));
  }
  
  render() {
    return (
      <div class="card h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">Hotels</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{this.state.hotels}</div>
              <div class="mt-2 mb-0 text-muted text-xs">
                <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                <span>Since yesterday</span>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-comments fa-2x text-warning"></i>
            </div>
          </div>
        </div>
      </div>
    )
  }
}

class Footer extends React.Component {
  render() {
    return (
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; <script> document.write(new Date().getFullYear()); </script> - Modified by
              <b><a href="https://nicholasdw.com" target="_blank"> Nicholas Dwiarto</a></b>
            </span><br/><br/>
            <span>
              Powered by <i class="fab fa-react"></i> <b>React.js</b> and <i class="fab fa-php"></i> <b>PHP</b>
            </span>
          </div>
        </div>
      </footer>
    )
  }
}

ReactDOM.render(<Header/>, document.getElementById('header'));
ReactDOM.render(<HeadBar/>, document.getElementById('headbar'));
ReactDOM.render(<Sidebar/>, document.getElementById('sidebar'));
ReactDOM.render(<Footer/>, document.getElementById('footer'));
ReactDOM.render(<CardStatisticsOne />, document.getElementById('cardOne'));
ReactDOM.render(<CardStatisticsTwo />, document.getElementById('cardTwo'));
ReactDOM.render(<CardStatisticsThree />, document.getElementById('cardThree'));
ReactDOM.render(<CardStatisticsFour />, document.getElementById('cardFour'));