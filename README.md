# FootprintAnalytics
CS585 Final Project Footprint. Analytics backend and web application dashboard. 

# Setup
1. Setup Apache, MySQL, PHP and phpMyAdmin on your computer

# Setup MySQL database
Connect to mysql and add new database named footprint (for more info on database setup, look in Additional Files folder)
		create 2 tables named fp_app and fp_tracking
		in fp_app add 2 columns named id and app_name
		in fp_tracking add 6 columns named id, fp_app_id, name, type, view, and time
Go to AdditionalFiles folder for more information on setup for the database

# Update files and connect to your server. 
1. in Fooprint_Backend -> index.php
		line 9: connect to your mysql database by putting in your credentials for mysql 
		$this->db = new mysqli('localhost', 'YOURUSERNAME', 'YOURPASSWORD', 'footprint')
		Place the index.php file in your server   
2.in Footprint_Website -> FootprintDashboard.php
	line 7: connect to your mysql database
	line 136: Update href to point to FootprintDashboard.php 
	line 142: Update href to point to FootprintTable.php
	line 261: Update url to myData.php in $.getJSON function
	line 294: Update url to TypeData.php in $.getJSON function
3. in Footprint_Website -> FootprintTable.php
	line 7:  connect to your mysql database
	line 129: Update href to point to FootprintDashboard.php 
	line 135: Update href to point to FootprintTable.php
4. in Footprint_Website -> myData.php
	line 7:  connect to your mysql database
5. in Footprint_Website -> TypeData.php
	line 7:  connect to your mysql database
  
  
# References
1. Apache, MySQL, PHP, phpMyAdmin setup (https://coolestguidesontheplanet.com/get-apache-mysql-php-and-phpmyadmin-working-on-osx-10-11-el-capitan/#phpmyadmin)
2. Highcharts document references (http://www.highcharts.com/docs)
3. Bootstrap Dashboard template (https://github.com/creativetimofficial/light-bootstrap-dashboard)
