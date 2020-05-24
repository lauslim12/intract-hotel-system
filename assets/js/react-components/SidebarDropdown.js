import React from 'react';

class SidebarDropdown extends React.Component {
  render() {
    return (
      <div id="collapseBootstrap" className="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
        <div className="bg-white py-2 collapse-inner rounded">
          <h6 className="collapse-header">Hotel Management</h6>
          <a className="collapse-item" href="alerts.html">New Hotel</a>
          <a className="collapse-item" href="buttons.html">Edit Hotel</a>
          <a className="collapse-item" href="dropdowns.html">Delete Hotel</a>
        </div>
      </div>
    )
  }
}

export default SidebarDropdown;