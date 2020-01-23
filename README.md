# SnowTricks

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/33105aae22c5429f8709a2a79be30dd3)](https://www.codacy.com/manual/michaelgtfr/SnowTricks?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=michaelgtfr/SnowTricks&amp;utm_campaign=Badge_Grade)

SnowTricks for my project six of my study on OpenClassrooms.

## Context

Jimmy Sweat is an ambitious entrepreneur passionate about snowboarding. Its objective is the creation of a collaborative site to make this sport known to the general public and help in the learning of tricks.
He wants to capitalize on content brought by Internet users in order to develop rich content and arouse the interest of site users. Subsequently, Jimmy wants to develop a business of connecting with the snowboard brands thanks to the traffic that the content will have generated.
For this project, we will focus on the technical creation of the site for Jimmy.

You are responsible for developing the site that meets Jimmy's needs. You must therefore implement the following functionalities:

    -a directory of snowboard figures. You can take inspiration from the list of figures on Wikipedia. Just integrate 10 figures, the rest will be entered by Internet users;
    -figure management (creation, modification, consultation);
    -a discussion space common to all the figures.

To implement these features, you must create the following pages:

    -the home page where the list of figures will appear;
    -the page for creating a new figure;
    -the figure modification page;
    -the presentation page of a figure (containing the common discussion space around a figure).

All the detailed specifications for the pages to be developed are available here: Detailed specifications....
 
## Download libraries via composer

Go to the root folder of the site. In the root folder right click the mouse and then press git bash (or equivalent software). The Open software write  " composer install ". The libraries will be installed automatically in a vendor folder.

## Installation

### Prerequisite

-Offer accommodation on a hosting      
-Have a domain name that will be the address on which your site will be accessible     
-Have its ID on its hosting (host, password, Identifying)      
-Have installed an FTP on his computer       
  
### Site installation
(Example with FileZilla but all FTP works on the same principle)  

  Open your FTP software. Click on the logo "site manager". A window opens. Click on "New Site" and give it the name you want (example: "My Site"). To the right, you will have to indicate (the IP address, password and its username). Click Connect.  
  !Warning a message warns you after you click Connect you tell yourself if you are connecting or not.  
  After connecting, double-click in the left window on the files or click-Drop the folders in the right window that you want to send to the server. As soon as it appears in the right window, it was sent to your server.  
  !Please note that your home page should be call index.php This is the page that will be loaded when a new visitor arrives on your site.  
  
## Database installation

### Required

-The IP address of the MySQL server      
-Your MySQL Login      
-Your MySQL password     
-The name of the database, if it has already been created      
-The PhpMyAdmin address that allows you to manage your online database     
  
### Access

   Changed the parameter file of the database (.env.local.php). Now that it's done, your scripts have access to the host database.
   !If your table is still empty, you have to use the phpMyAdmin that the hosting puts at your disposal to recreate the tables. On your machine, go to your local phpMyAdmin. Use it to export all your tables. This will create a. sql file on your hard disk that will contain your tables. Then go to the phpMyAdmin address of your host. Once there, use the Import feature to import the. sql file that is on your hard disk. Your tables are now loaded on the host's MySQL server.  
 
 ### website configuration
 
   The website configurations can be found in the .env file, there is no other page to modify.
    
   __Site installation Complete__
