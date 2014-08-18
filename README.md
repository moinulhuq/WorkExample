WorkExample
===========

Information regarding running and installing the code.

This is a generic user verification code that I've written and used it to kick start some of my previous projects.

To run the code try the following steps:

1. Copy spo folder and all its content to your htdocs (or appropritate app root) folder of your web server.
2. Create a database on your mysql installation named spo_cms
3. Try importing spo/db/spo_cms.sql after selecting the database created in step #2 (I recommend using navicat to  import this script). 
4. Open spo/dal/dataaccess.php and look at line 11-14. changed the hostname, database user and password if necessary.
5. Open your browser and type localhost/spo
6. To login then use userid: Moin and pass: 123.
