import React from 'react';
import { HOTELSAPI } from '../react-variables/Variables';

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
      <div className="col-xl-3 col-md-6 mb-4">
        <div className="card h-100">
          <div className="card-body">
            <div className="row no-gutters align-items-center">
              <div className="col mr-2">
                <div className="text-xs font-weight-bold text-uppercase mb-1">Hotels</div>
                <div className="h5 mb-0 font-weight-bold text-gray-800">{this.state.hotels}</div>
                <div className="mt-2 mb-0 text-muted text-xs">
                  <span className="text-danger mr-2"><i className="fas fa-arrow-down"></i> 1.10%</span>
                  <span>Since yesterday</span>
                </div>
              </div>
              <div className="col-auto">
                <i className="fas fa-comments fa-2x text-warning"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    )
  }
}

export default CardStatisticsFour;