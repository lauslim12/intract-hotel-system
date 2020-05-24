import React from 'react';
import { USERSAPI } from '../react-variables/Variables';

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
      <div className="col-xl-3 col-md-6 mb-4">
        <div className="card h-100">
          <div className="card-body">
            <div className="row no-gutters align-items-center">
              <div className="col mr-2">
                <div className="text-xs font-weight-bold text-uppercase mb-1">Users</div>
                <div className="h5 mb-0 mr-3 font-weight-bold text-gray-800">{this.state.users}</div>
                <div className="mt-2 mb-0 text-muted text-xs">
                  <span className="text-success mr-2"><i className="fas fa-arrow-up"></i> 20.4%</span>
                  <span>Since last month</span>
                </div>
              </div>
              <div className="col-auto">
                <i className="fas fa-users fa-2x text-info"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    )
  }
}

export default CardStatisticsThree;