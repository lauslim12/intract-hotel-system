import React from 'react';
import SidebarDropdown from './SidebarDropdown';
import { LOGOIMG, ADMINURL, BASEURL, HOTELURL, ORDERURL, USERSURL } from '../react-variables/Variables';

class Sidebar extends React.Component {
  render() {
    return (
      <ul className="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a className="sidebar-brand d-flex align-items-center justify-content-center" href={ADMINURL}>
        <div className="sidebar-brand-icon">
          <img src={LOGOIMG} />
        </div>
        <div className="sidebar-brand-text mx-3">Admin</div>
      </a>
      <hr className="sidebar-divider my-0" />
      <li className="nav-item active">
        <a className="nav-link" href={ADMINURL}>
          <i className="fas fa-fw fa-tachometer-alt"></i>
          <span>Panel</span></a>
      </li>
      <li className="nav-item">
        <a className="nav-link active" href={BASEURL}>
          <i className="fas fa-fw fa-hotel"></i>
          <span>Intractive</span></a>
      </li>
      <hr className="sidebar-divider" />
      <div className="sidebar-heading">
        Manage Hotels
      </div>
      <li className="nav-item">
        <a className="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
          aria-expanded="true" aria-controls="collapseBootstrap">
          <i className="fab fa-fw fa-wpforms"></i>
          <span>Manage Hotels</span>
        </a>
        <SidebarDropdown/>
      </li>
      <li className="nav-item">
        <a className="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTable" aria-expanded="true"
          aria-controls="collapseTable">
          <i className="fas fa-fw fa-table"></i>
          <span>Tables</span>
        </a>
        <div id="collapseTable" className="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
          <div className="bg-white py-2 collapse-inner rounded">
            <h6 className="collapse-header">Tables</h6>
            <a className="collapse-item" href={HOTELURL}>All Hotels</a>
            <a className="collapse-item" href={ORDERURL}>All Orders</a>
            <a className="collapse-item" href={USERSURL}>All Users</a>
          </div>
        </div>
      </li>
      <hr className="sidebar-divider"/>
    </ul>
    )
  }
}

export default Sidebar;