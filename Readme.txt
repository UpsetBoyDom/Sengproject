Seng 300 Project Group 4 Readme
Members: Mila Hoogstraat, Yushea Raza, Dominic Nguyen, Nielson Trung, Nandakumar Panneerselvam 

To see the code live in action go to http://yushae.com/Seng300/ 
Source code is also avaiable here: https://github.com/yushaer/Sengproject

Alternatively all source code may be viewed using winSCP with the following credentials provided:
host: 68.147.14.57
user: pi
password: yus123
directory is /var/www/html/Seng300

To access the site as a admin or a user the credentials below may be used respectively
Admin Access:
	username: darksavage
	password: yus123
User Access:
	username: username
	password: password

For a visual representation of the system and file structure please view the UML file provided labeled UML.
The legend below may be used to help you understand our UML.
	Directories are represented by the block diagrams.
	Files are represented as text inside a directory.
	Directional arrows represent a has or use relation between directories and files. 

Specification details that cannot be captured by the UML are described below:
	Description of index.php files:
	Each directory cotains a index.php file
	Admins have full access to every page of our website.
	Certain pages are accessible as doctor, nurse, or patient user. 
	Inside each page directory is a index.php file which contains frontend source code.
	Each index.php includes Styles/style.css used for the styling of the website.
	Each index.php includes nav.js which appends the navigation bar to the web pages.
	Each index.php includes the Styles/style.css file.

	Description of Backend Files:
	Each index.php has the loggout.php or loggout(admin).php file included in php tags.
	This ensures that only registered members are allowed to access the site.
	All backend source code for each frontend element is found in the Scripts folder.
	The backend source code files are named respectively to the directory they are used by.
		The File paths of the files in the example appear when accessing source code through FTP winSCP
		Example: frontend: var/www/html/Seng300/Admin/index.php  
			  backend: var/www/html/Seng300/Scripts/admin.js

