import React from 'react';

class Footer extends React.Component {
  render() {
    return (
      <footer className="sticky-footer bg-white">
        <div className="container my-auto">
          <div className="copyright text-center my-auto">
            <span>Copyright &copy; <script> document.write(new Date().getFullYear()); </script> - Modified by
              <b><a href="https://nicholasdw.com" target="_blank"> Nicholas Dwiarto</a></b>
            </span><br/><br/>
            <span>
              Powered by <i className="fab fa-react"></i> <b>React.js</b> and <i className="fab fa-php"></i> <b>PHP</b>
            </span>
          </div>
        </div>
      </footer>
    )
  }
}

export default Footer;