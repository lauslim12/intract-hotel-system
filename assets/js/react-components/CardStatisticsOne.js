import React from 'react';
import { EARNINGSAPI } from '../react-variables/Variables';

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
      <div className="col-xl-3 col-md-6 mb-4">
        <div className="card h-100">
          <div className="card-body">
            <div className="row align-items-center">
              <div className="col mr-2">
                <div className="text-xs font-weight-bold text-uppercase mb-1">Earnings (Rp.)</div>
                <div className="h5 mb-0 font-weight-bold text-gray-800">{earnings}</div>
                <div className="mt-2 mb-0 text-muted text-xs">
                  <span className="text-success mr-2"><i className="fa fa-arrow-up"></i> 5.3%</span>
                  <span>Nice!</span>
                </div>
              </div>
              <div className="col-auto">
                <i className="fas fa-calendar fa-2x text-primary"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    )
  }
}

export default CardStatisticsOne;