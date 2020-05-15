/*
*   No DOM imports because this script does not use Node for the React components!
*   Mainly using ES6 syntax.
*/

const BASEURL = "http://localhost/Intractive";

class Clock extends React.Component {
  constructor(props) {
    super(props);
    this.state = {date: new Date()};
  }

  componentDidMount() {
    this.timerID = setInterval(() => this.tick(), 1000);
  }

  componentWillUnmount() {
    clearInterval(this.timerID);
  }

  tick() {
    this.setState({
      date: new Date()
    });
  }

  render() {
    return (
      <span>This is {this.state.date.toLocaleTimeString()}!</span>
    )
  }
}

class Navigation extends React.Component {
  render() {
    return (
      <nav className="navbar navbar-expand-lg navbar-light bg-light">
        <a className="navbar-brand" href={`${BASEURL}`}>Navbar</a>
        <button className="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span className="navbar-toggler-icon"></span>
        </button>
        <div className="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div className="navbar-nav">
            <a className="nav-item nav-link active" href="#">Home <span className="sr-only">(current)</span></a>
            <a className="nav-item nav-link" href="#">Features</a>
            <a className="nav-item nav-link" href="#">Pricing</a>
            <a className="nav-item nav-link" href="#"><Clock/></a>
          </div>
        </div>
      </nav>
    )
  }
}

function App() {
  return (
    <Navigation/>
  )
}

ReactDOM.render(<App/>, document.getElementById('root'));