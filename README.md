# Intractive Hotel System

Advanced form of [Intract Social Network](https://github.com/lauslim12/intract-social-network). The name is Intractive Hotel System, built with CodeIgniter 3.1.11. The theme is now extended - aside from a simple social network for the reviews of hotels, now users could see more hotels, even order some rooms for a time! Of course the 'ordering' system is just a mockup, but this is as close as I can get to be a business-ready website!

<p align="center">
  <a href="https://code.visualstudio.com/"><img src="https://img.shields.io/badge/Made%20with-VS%20Code-blue" alt="Made with VS Code" /></a>
  <img src="https://img.shields.io/badge/Made%20with-JavaScript-yellow"/>
  <img src="https://img.shields.io/badge/Made%20with-PHP-%232980b9"/>
  <img src="https://img.shields.io/badge/Made%20with-CodeIgniter-red"/>
  <img src="https://img.shields.io/badge/Made%20with-React-%232980b9"/>
</p>

## Disclaimer

All of the hotel media, hotel names, and hotel photos that might be available here is not mine. All Rights Reserved to their owners. All of the rating and stars that are shown here are not representative of their real-world counterpart's stars and rating.

## Architecture / Philosophies

- Object Oriented.
- Model, View, Controller Application Design Method.
- IBM Programming Style and Techniques.
- HTML, SCSS, JavaScript, and React.js for the Front-End.
- CodeIgniter 3.1.11, MariaDB, IBM Cloud Services for the Back-End.
- Block, Element, Modifier SCSS Methodology for Styling.
- Low Coupling, High Cohesion Design Pattern
- Usage of Agile Process Model.
- Security Software Design and Development Process.
- Hosted on a Cloud Provider.
- Coded in English.

## Design Architecture

- Same like the classic Intract, this website utilizes SASS with CSS Flexbox. The design used is inspired from Jonas Schmedtmann's design, my teacher at SASS Bootcamp.

## Features

For now, the website has three features, more will be added as the project progresses.

- Sign Up System
- Login System
- See Hotels
- Hotel Booking System
- Transaction History
- Hotel Searching
- Profile System
- Customer's Rating System
- Admin Panel
- All Pages Validated!
- Chart for Admin
- Edit Basic Profile Information
- Filter Hotels to your Budget!
- Hotel Reviews with Image
- Like A Review

Features that is available at the classic Intract, but not yet ported here:

- Comment on the review, and reviews are complete with infinite scrolling!

TOA:

- Refactor EVERY code, add comments, and apply the DRY principle.

TODO:

- Messaging System

Future work:

- Swap to Node
- Swap to CodeIgniter 4
- Port to Laravel (learning process)

## Front-End Dependencies

- Ἀφροδίτη.js
- Bootstrap 4 (CDN)
- Babel
- Chart.js
- Electron.js
- jQuery (CDN)
- jQuery Easing (CDN)
- SASS
- React.js
- Webpack

## Back-End Dependencies

- CodeIgniter 3.1.11
- CodeIgniter's REST Services
- MariaDB

## Production Code for SASS/SCSS

Still the same like old Intract:

- Start is used to autorun SASS compilers.
- Compiling the SASS code into CSS.
- Concat any third-party CSS with the main CSS.
- Prefix the CSS with browser-specific prefixes.
- Compress / obfuscate the CSS code to prevent scrapers.
- Run all for production code.

## Production Code for React.js

- Watch the Webpack to check for any changes in the React's JavaScript main file.
- Compile, compress, and obfuscate the JavaScript code to prevent scrapers.
- Run all for production code.

## Project Structure

The project structure will follow the standard CodeIgniter's Model, View, Controller principles. However, there are some small changes, which are:

- An `.architecture` folder to store the plans regarding the project. Usually in the form of diagrams, whether it is Entity Relationship Diagram, or other diagrams that might be useful in the design process.
- There's a `index.js` file in the root folder to use Electron.
- In the `assets/js` folder, there's a file called `react.js`. It's the entry point of React.
  In due time, I will place the public files two-levels below root for more security (assuming I do not have time yet to port to Laravel / CodeIgniter 4).

## Installations and Usage

Same like the old Intract,

- Use PHP with version more than 7.2. and your CodeIgniter version equals 3.1.11 or maybe more if it exists. CodeIgniter 4 is not supported.
- Use `git pull repo` to fetch the code, or download it by using `git clone`.
- Copy the repository into the `htdocs` folder in XAMPP or any other local host web server that you have.
- Import the `.sql` file that is located in the `assets/dev` folder.
- Make sure to name the repository to be `Intractive`, as the base URL is set to that.
- Ensure that the repository is not plainly copy-pasted into the root folder. It has to be inside the `Intractive` folder, unless you want to do some settings.
- Use `composer install` to resolve PHP dependencies. If you do not install this, then you can't use the REST API.
- Use `npm install` or its yarn equivalent `yarn install` to install all Node dependencies. If you do not install this, then you can't use the Admin Panel.
- Make sure to be connected to the Internet, because I used Content Delivery Networks for jQuery, and Bootstrap.
- Register an account to be used at the website, or use `admin` as the username and `admin` as the password.
- Done.

For Developers,

SASS:

- You can use `npm install` in order to modify the SASS file and or production CSS code.
- I used [Hugo Giraudel's SASS Boilerplate](https://github.com/HugoGiraudel/sass-boilerplate) as the basic folder structure of the SASS.
- Then, utilize `npm start` to start the production SASS code.
- The production SASS code is to auto compile the SASS code to CSS.
- Use `npm run build:project` to concat, auto prefix, and compress the SASS/CSS code.

React:

- I make my own build scripts and setup my own React.js scripts manually. Check it at `package.json`.
- The page that is powered by React.js is only the dashboard of the Admin Panel. The rest is powered with PHP.
- The main React.js file can be found at `assets/react.js`. Fetch and edit it from there.
- Utilize `npm run watch:webpack` to tell Webpack to watch your changes in the `assets/react.js` file.
- Because this does not utilize the development server, you have to manually reload to see the changes.

Notes:

- Without `npm install`, it is still possible to use the website application though, as the node packages are only used for development dependencies.

## Deployment Notes

- Use `yarn install --production` or `npm install --production` to install the Node packages.
- Use `composer install --no-dev --optimize-autoloader` in the production server.
- Setup your own Web Server to be used.
- Remember to change the following:
  - `$config['base_url']` in the `application/config/config.php` file.
  - Database credentials in the `application/config/database.php` file.
  - Base URL link in the `assets/js/react-variables/Variables.js` file (don't forget to rebuild the Webpack).
