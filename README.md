# BBS-Luebeck

This is A mini BBS system based on PHP Slim and Vue, which implement basic user management, channel management, comment & reply, filter & sort information and pagenation.


- Environment: Besides basicePHP environment, apache server and mySQL server are also necessary. To make it easy, you can download [xampp](https://www.apachefriends.org/download.html) with these two services 
- Initialize the database through bbs.sql (create a database named "bbs" and run the sql)
- Configure BBS-Server/public/controller/dbConnection.php for username, password, ...
- If you install the bbs project directly at the htdocs of xampp and your Apache run on the default port, no more steps are needed
- Otherwise, please change BBS-Server/public/index.php line 13 into the path from htdocs to public folder
	ex. If you put the BBS project in htdocs/assignment3 then chang it into
	$COMMON_PATH='assignment3/BBS/BBS_Server/public/';
- Then change the RESTful API URL configured in front-end all the html document. For each html file in bbs-luebeck folder, find "domain" (e.x. index.html, line 130), and change it like what is done in back-end.
- If your Apache doesn't run on default port, you also need to specifed the port after localhost in the domian
