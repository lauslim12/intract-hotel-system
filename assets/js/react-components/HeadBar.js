import React from 'react';
import { ADMINURL } from '../react-variables/Variables';

class HeadBar extends React.Component {
  render() {
    return (
      <div className="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 className="h3 mb-0 text-gray-800">Dashboard</h1>
        <ol className="breadcrumb">
          <li className="breadcrumb-item"><a href={ADMINURL}>Home</a></li>
          <li className="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
      </div>
    )
  }
}

export default HeadBar;