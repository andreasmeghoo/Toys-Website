# Toys-Website

## Setup Database Server to below specifications:
Server: Localhost via UNIX socket  <br>
Server type: MySQL <br>
Server version: 5.5.58-0+deb7u1-log - (Debian) <br>
Protocol version: 10 <br>
Server charset: UTF-8 Unicode (utf8)

## Setup Web Server to below specifications:
Apache/2.2.22 (Debian) <br>
Database client version: libmysql - mysqlnd 5.0.11-dev - 20120503 - $Id: 76b08b24596e12d4553bd41fc93cccd5bac2fe7a $ <br>
PHP extension: mysqli

## Setup PHPMyAdmin to below version:
Version: 4.2.10

## Default Database Connection Info
Host: localhost <br>
DB Name: unn_w21017158 <br>
Username: username <br>
Password: password <br>

Change username and password in "database_conn.php" file.

## Populate Database
Run the SQL file NTL.sql on the database "unn_w21017158".

## Populate Web Server
FTP Transfer the directory "public_html" in this repository to the web server.

