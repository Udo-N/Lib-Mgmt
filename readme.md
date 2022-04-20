# Pre-requirements

- PHP 8.1.5
- PHPUnit 9.3.0
- Composer
- Selenium IDE Extension
- XAMPP
- VSCode live server

# How to run web application

- Save the 'Lib-Mgmt' folder to the directory 'C:\xampp\htdocs'
- Open the XAMPP control panel and start the 'Apache' and 'MySQL' modules
- From the 'MySQL' module, click the 'Admin' button. This should load php myadmin into your browser
- Import the database using the 'library-database.sql' file
- In your browser go to 'http://localhost/Lib-Mgmt/php/index.php'. This should load the web app

# How to run Selenium tests

- Open Selenium IDE via the browser extension
- Load 'Lib-Mgmt-Automated-Tests.side' into Selenium
- Click on the 'run all tests' icon near the top left

# How to run PHPUnit tests

- Open the Lib-Mgmt directory in the command line and type the command 'vendor/bin/phpunit --coverage-text'
