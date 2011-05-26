# Shortnar Installation Instructions

## Requirements

You will need web hosting with: 

* PHP
* access to a mysql database
* mod_rewrite

## Instructions

* put the files from `www` in a web visible directory
 * make sure you copy the .htaccess file (which `cp shortnar/www/* /var/www/` would miss)
* copy `template.config.php` to `config.php`
* set up the mysql database
 * create a mysql user and database for the project (*this step is optional* - the config file includes provision (a table-prefix) for sharing a database.  But, for security reasons, I prefer a separate database with a user that can only access that database).
 * create a table called, for example, `4gh_urls` (the `4gh` prefix can be set in the config file. The `urls` part is fixed.):
<pre><code>
    CREATE TABLE `4gh_urls` (
    	`id` int(10) NOT NULL auto_increment,
    	`token` varchar(255) character set latin1 collate latin1_bin NOT NULL,
    	`url` text NOT NULL,
    	PRIMARY KEY  (`id`),
    	UNIQUE KEY `token` (`token`),
    	FULLTEXT KEY `url` (`url`)
    ) ENGINE=MyISAM AUTO_INCREMENT=124 DEFAULT CHARSET=latin1
</code></pre>
* edit `config.php` (there are comments in `config.php` to explain how)
