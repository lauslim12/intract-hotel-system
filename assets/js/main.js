import React from 'react';
import ReactDOM from 'react-dom';

// Components
import Sidebar from './react-components/Sidebar';
import Header from './react-components/Header';
import HeadBar from './react-components/HeadBar';
import CardStatisticsOne from './react-components/CardStatisticsOne';
import CardStatisticsTwo from './react-components/CardStatisticsTwo';
import CardStatisticsThree from './react-components/CardStatisticsThree';
import CardStatisticsFour from './react-components/CardStatisticsFour';
import ChartStats from './react-components/ChartStats';
import Footer from './react-components/Footer';
import TopScroll from './react-components/TopScroll';

class App extends React.Component {
  render() {
    return (
      <div id="wrapper">
        <Sidebar/>
        <div id="content-wrapper" className="d-flex flex-column">
          <div id="content">
            <Header/>
            <div className="container-fluid" id="container-wrapper">
              <HeadBar/>
              <div className="row mb-3">
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