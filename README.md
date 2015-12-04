# Stelin
**Shorten URLs quickly!**

Stelin is a basic URL shortener developed using HTML, CSS, PHP, MySQL and a bit of JavaScript. These are the basic features of the application:

* Shorten URLs and view them later.
* Implemented using REST APIs, so it will be easy to create an app for other mobile platforms later if required.
* It has a Twitter module built in, thanks to the Twitter API.
* It also has a mailing module. So just key in your SMTP server details in the configuration file and the user will receive the shortened URL via email too (provided the user has entered his/her email address).

Now the interesting part is that the last two modules of the web app are optional and the project is built in a `modular approach`. So you can enable or disable those optional features just by setting a particular variable in the configuration file either true or false. So you can have either of those modules or both or none but the core functions of the app will work as you would expect.

## Stack used

Apache – MySQL – PHP

EasyPHP 14.1 VC11 is used during the development / testing. Component versions are below:
* Apache 2.4.7
* MySQL 5.6.15
* PHP 5.5.8

## Database Structure

The database must contain a table. The table structure is given below:

urls (id, url, token)
* id should be an `Integer` (It can be `INT` or `BIGINT` depending upon your requirements)
* url should be `TEXT` (`VARCHAR` can be used but `TEXT` is recommended)
* token should be `VARCHAR` (Size can be selected depending upon your requirements)

Here id is the primary key and also it should `AUTO_INCREMENT`. Set the starting value to `100000`.

This is the MySQL query for the above.

```
CREATE TABLE IF NOT EXISTS `urls` (
		  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
		  `url` text NOT NULL,
		  `token` varchar(128) NOT NULL,
		  PRIMARY KEY (`id`)
		  ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=100000;
```

## Installation

Installation of the web app is easy! Just follow the given steps:

* Download the zip file
* Extract it inside your local server directory
* You need to edit four configuration files. Open the folder `variables`:
  * `database.php` contains the database configurations.
  * `email.php` contains the SMTP server configurations (The on/off toggle of the email module is in this file).
  * `server.php` contains the address of the root location of the web app (Example, `http://localhost/stelin-master`).
  * `twitter.php` contains your Twitter app credentials (The on/off toggle of the Twitter module is in this file).
* Disable `ad blockers`. Otherwise the Twitter button will `not` appear.

And that is all!

## How to start

### Application

Enter the address of the root of the web app in your browser (preferably Google Chrome) and it should start working just fine.

### REST API

It offers two APIs, one to get the token for a particular URL and the other one to get the URL back for a particular token. Use the `GET` method to call both the APIs. Data will be returned in the `JSON` format. Let's see these in detail:

##### Get the token for a particular URL

You need to call the `<address of the root>/rest/post/index.php` and pass the URL as the parameter. Encode the URL (according to RFC 3986) before passing it to this API to get the correct result. For example, if your URL is `https://www.wikipedia.org/` then you should call,

`http://localhost/stelin-master/rest/post/index.php?url=https://www.wikipedia.org/`

##### Get the URL back for a particular token

You need to call the `<address of the root>/rest/get/index.php` and pass a token as the parameter. For example, if your token is `3l4b` then you should call,

`http://localhost/stelin-master/rest/get/index.php?token=3l4b`

## Notes

No framework is used while developing this web app. The whole project is implemented based on my understandings of the concepts of the MVC Architecture and REST APIs. 
