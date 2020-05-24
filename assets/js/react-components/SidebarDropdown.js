import React from 'react';
import { HOTELURL, NEWHOTELURL } from '../react-variables/Variables';

class SidebarDropdown extends React.Component {
  render() {
    return (
      <div id="collapseBootstrap" className="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
        <div className="bg-white py-2 collapse-inner rounded">
          <h6 className="collapse-header">Hotel Management</h6>
          <a className="collapse-item" href={NEWHOTELURL}>New Hotel</a>
          <a className="collapse-item" href={HOTELURL}>Edit Hotel</a>
          <a className="collapse-item" href={HOTELURL}>Delete Hotel</a>
        </div>
      </div>
    )
  }
}

export default SidebarDropdown;