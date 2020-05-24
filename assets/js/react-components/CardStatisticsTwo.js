import React from 'react';
import { SALESAPI } from '../react-variables/Variables';

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
      <div className="col-xl-3 col-md-6 mb-4">
        <div className="card h-100">
          <div className="card-body">
            <div className="row no-gutters align-items-center">
              <div className="col mr-2">
                <div className="text-xs font-weight-bold text-uppercase mb-1">Sales</div>
                <div className="h5 mb-0 font-weight-bold text-gray-800">{this.state.sales}</div>
                <div className="mt-2 mb-0 text-muted text-xs">
                  <span className="text-success mr-2"><i className="fas fa-arrow-up"></i>12%</span>
                  <span>Since last year!</span>
                </div>
              </div>
              <div className="col-auto">
                <i className="fas fa-shopping-cart fa-2x text-success"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    )
  }
}

export default CardStatisticsTwo;