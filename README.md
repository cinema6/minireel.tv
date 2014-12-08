# MiniReel.tv

## Requirements
1. [PHP <= 5.4.0](http://php.net/manual/en/install.php)
2. [MySQL Server](http://dev.mysql.com/downloads/mysql/)
3. Properly Setup [PHP CLI](http://php.net/manual/en/features.commandline.introduction.php)– Test this by running ```php -v``` from the command line

##Setup
1. Create a MySQL database called ```minireel-tv--dev```
2. Create a MySQL user called ```minireel-tv--dev``` with the password ```password```
3. Grant the user ```minireel-tv--dev``` all privileges on db ```minireel-tv--dev```
4. Import the contents of ```db.mysql``` into the ```minireel-tv--dev``` database
5. Start the development server by running the included ```server``` bash script
6. Login to wordpress with the username ```admin``` and password ```password```.