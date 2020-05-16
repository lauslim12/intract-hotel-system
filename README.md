# Intractive Hotel System
Advanced form of [Intract Social Network](https://github.com/lauslim12/intract-social-network). The name is Intractive Hotel System, built with CodeIgniter 3.1.11. The theme is now extended - aside from a simple social network for the reviews of hotels, now users could see more hotels, even order some rooms for a time! Of course the 'ordering' system is just a mockup, but this is as close as I can get to be a business-ready website!

<p align="center">
  <a href="https://code.visualstudio.com/"><img src="https://img.shields.io/badge/Made%20with-VS%20Code-blue" alt="Made with VS Code" /></a>
  <img src="https://img.shields.io/badge/Made%20with-JavaScript-yellow"/>
  <img src="https://img.shields.io/badge/Made%20with-PHP-%232980b9"/>
  <img src="https://img.shields.io/badge/Made%20with-CodeIgniter-red"/>
</p>

## Architecture / Philosophies
* Object Oriented.
* Model, View, Controller Application Design Method.
* IBM Programming Style and Techniques.
* HTML, SCSS, JavaScript, Node.js, and React for the Front-End.
* CodeIgniter 3.1.11, MariaDB, IBM Cloud Services for the Back-End.
* Block, Element, Modifier SCSS Methodology for Styling.
* Low Cohesion, High Coupling Design Pattern
* Usage of Agile Process Model.
* Security Software Design and Development Process.
* Hosted on a Cloud Provider.
* Coded in English.

## Design Architecture
* Same like the classic Intract, this website utilizes SASS with CSS Flexbox. The design used is inspired from Jonas Schmedtmann's design, my teacher at SASS Bootcamp.

## Features
For now, the website has three features, more will be added as the project progresses.
* Sign Up System
* Login System
* See Hotels
* Hotel Booking System
* Transaction History
* Hotel Searching
* Profile System

Features that is available at the classic Intract, but not yet ported here:
* Wall System (Complete with infinite scrolling!)

TOA:
* Refine the Filter Search
* CodeIgniter Validations
* Refactor EVERY code, add comments, and apply the DRY principle.

TODO:
* Admin Panel
* REST API for Database Usage (React-friendly)
* Messaging System
* User Interface
* Add every dependency at `assets/vendors` to NPM, also the React.

Future work:
* Swap to CodeIgniter 4
* Port to Laravel (learning process)

## Production Code for SASS/SCSS
Still the same like old Intract:
* Start is used to autorun SASS compilers.
* Compiling the SASS code into CSS.
* Concat any third-party CSS with the main CSS.
* Prefix the CSS with browser-specific prefixes.
* Compress / obfuscate the CSS code to prevent scrapers.
* Run all for production code.

## Project Structure
The project structure will follow the standard CodeIgniter's Model, View, Controller principles. However, there are some small changes, which are:
* There's a `index.js` file in the root folder to use Electron.
* In the `assets/js` folder, there's a file called `react.js`.
In due time, I will place the public files two-levels below root for more security (assuming I do not have time yet to port to Laravel / CodeIgniter 4). 

## Installations and Usage
Same like the old Intract,
* Use PHP with version more than 5.6.
* Use `git pull repo` to fetch the code, or download it by using `git clone`.
* Copy the repository into the `htdocs` folder in XAMPP or any other local host web server that you have.
* Import the `.sql` file that is located in the `assets/dev` folder.
* Use `composer install` to resolve PHP dependencies.
* Register an account to be used at the website.
* Done.

For Developers,
SASS:
* You can use `npm install` in order to modify the SASS file and or production CSS code.
* Then, utilize `npm start` to start the production SASS code.
* The production SASS code is to auto compile the SASS code to CSS.
* Use `npm run build:project` to concat, auto prefix, and compress the SASS/CSS code.

Electron:
* Use `npm install` to install all of the development dependencies.
* Use `npm run electron` to try to run the website in a desktop environment (without a browser).
* It's still a webview connected to [my web server](https://nicholasdw.com/Intractive) though, not a dedicated desktop application like Visual Studio Code, Slack, Atom, WhatsApp, etcetera.

Notes:
* Without `npm install`, it is still possible to use the website application though, as the node packages are only used for development dependencies.