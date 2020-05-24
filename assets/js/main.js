import React from 'react';
import ReactDOM from 'react-dom';
import Chart from 'chart.js'; 

import Header from './react-components/Header';
import HeadBar from './react-components/HeadBar';

Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

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
      <div class="col-xl-3 col-md-6 mb-4">
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
      <div class="col-xl-3 col-md-6 mb-4">
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
      <div class="col-xl-3 col-md-6 mb-4">
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
      <div class="col-xl-3 col-md-6 mb-4">
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

class ChartStats extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      globalData: null,
      labels: new Set(),
      values: []
    }
  }

  componentDidMount() {
    this.fetchAsync();
    this.parseData();
    this.createChart();
  }

  async fetchAsync() {
    let response = await fetch(URLAPI);
    let data = await response.json();
    this.setState({globalData: data});
  }
  
  async parseData() {
    await this.fetchAsync();
    let globalData = this.state.globalData;
    let labels = new Set();
    let values = [];
    globalData.forEach((el) => {
      labels.add(el.username);
      values.push(el.average);
    });

    this.setState({labels: labels, values: values});
  }
  
  async createChart() {
    await this.parseData();
    let labels = Array.from(this.state.labels);
    let ctx = document.getElementById("myAreaChart");
  
    function number_format(number, decimals, dec_point, thousands_sep) {
      // *     example: number_format(1234.56, 2, ',', ' ');
      // *     return: '1 234,56'
      number = (number + '').replace(',', '').replace(' ', '');
      var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function(n, prec) {
          var k = Math.pow(10, prec);
          return '' + Math.round(n * k) / k;
        };
      // Fix for IE parseFloat(0.55).toFixed(0) = 0;
      s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
      if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
      }
      if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
      }
      return s.join(dec);
    }
    
    // Area Chart Example
    let chart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          label: "Average rating",
          lineTension: 0.3,
          backgroundColor: "rgba(78, 115, 223, 0.5)",
          borderColor: "rgba(78, 115, 223, 1)",
          pointRadius: 3,
          pointBackgroundColor: "rgba(78, 115, 223, 1)",
          pointBorderColor: "rgba(78, 115, 223, 1)",
          pointHoverRadius: 3,
          pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
          pointHoverBorderColor: "rgba(78, 115, 223, 1)",
          pointHitRadius: 10,
          pointBorderWidth: 2,
          data: this.state.values
        }],
      },
      options: {
        maintainAspectRatio: false,
        layout: {
          padding: {
            left: 10,
            right: 25,
            top: 25,
            bottom: 0
          }
        },
        scales: {
          xAxes: [{
            time: {
              unit: 'date'
            },
            gridLines: {
              display: false,
              drawBorder: false
            },
            ticks: {
              maxTicksLimit: 7
            }
          }],
          yAxes: [{
            ticks: {
              maxTicksLimit: 5,
              padding: 10,
              callback: function(value, index, values) {
                return number_format(value);
              }
            },
            gridLines: {
              color: "rgb(234, 236, 244)",
              zeroLineColor: "rgb(234, 236, 244)",
              drawBorder: false,
              borderDash: [2],
              zeroLineBorderDash: [2]
            }
          }],
        },
        legend: {
          display: false
        },
        tooltips: {
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          titleMarginBottom: 10,
          titleFontColor: '#6e707e',
          titleFontSize: 14,
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          intersect: false,
          mode: 'index',
          caretPadding: 10,
          callbacks: {
            label: function(tooltipItem, chart) {
              var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
              return datasetLabel + ': ' + number_format(tooltipItem.yLabel) + '/10';
            }
          }
        }
      }
    });
  }

  render() {
    return (
      <div class="col-xl-12 col-lg-12">
        <div class="card mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Rating Statistics (All Hotels)</h6>
          </div>
          <div class="card-body">
            <div class="chart-area">
              <canvas id="myAreaChart"></canvas>
            </div>
          </div>
        </div>
      </div>
    )
  }
}

class TopScroll extends React.Component {
  render() {
    return (
      <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
      </a>
    )
  }
}

class App extends React.Component {
  render() {
    return (
      <div id="wrapper">
        <Sidebar/>
        <div id="content-wrapper" class="d-flex flex-column">
          <div id="content">
            <Header/>
            <div class="container-fluid" id="container-wrapper">
              <HeadBar/>
              <div class="row mb-3">
                <CardStatisticsOne/>
                <CardStatisticsTwo/>
                <CardStatisticsThree/>
                <CardStatisticsFour/>
              </div>
              <ChartStats/>
            </div>
          </div>
          <Footer/>
        </div>
        <TopScroll/>
      </div>
    )
  }
}

ReactDOM.render(<App/>, document.getElementById("root"));