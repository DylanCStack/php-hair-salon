#Hair Salon
###Authored by Dylan Stackhouse, 2/24/17
##Description
A website for a hair salon which allows new stylists to sign up and be keep track of all their clients, which also allows the clients to keep track of the stylists.

###Requirements
This site requires some programs and frameworks to be installed on your computer in order to run it.
* PHP 5
* Composer
* MAMP/mySQL/Apache
* A terminal shell (apple computers will have this by default)
* A web browser

##Setup
Download or clone the repository from [here](https://github.com/DylanCStack/php-hair-salon). Then in a terminal shell navigate into the folder and run '$composer install'. Next navigate to the web folder and run '$php -S localhost:8000'. Next launch MAMP and start a mySQL server.  Finally, navigate to localhost:8000 in your web browser of choice.

##Specifications
1. The program will be able to save a new Stylist into the hair_salon database.
    * Input:
        * "Claire"
    * Output:
        *   hair_salon.stylist[0] 1, "Claire"

2. The program will be able to retrieve a specific Stylist by their id.
    * Input:
        * 1
    * Output:
        * "Claire", id: 1
3. The program will be able to retrieve a specific Stylist by their name.
    * Input:
        * "Claire"
    * Output:
        * "Claire", id: 1

4. The program will be able to edit the information of existing stylists.
    * Input:
        * "Claire", id:1 : "Johnny"
    * Output:
        * "Johnny", id:1

5. The program will be able to delete  an existing stylist.
    * Input:
        * {"Claire", id:1}->delete();
    * Output:
        * null;

6. The program will be able to save a new Client into the hair_salon database.
    * Input:
        * "Franklin"
    * Output:
        *   hair_salon.client[0] 1, "Franklin"

7. The program will be able to retrieve a specific Client by their id.
    * Input:
        * 1
    * Output:
        * "Franklin", id: 1
8. The program will be able to retrieve a specific Client by their name.
    * Input:
        * "Franklin"
    * Output:
        * "Franklin", id: 1

4. The program will be able to edit the information of existing clients.
    * Input:
        * "Franklin", id:1 : "Jessica"
    * Output:
        * "Jessica", id:1

5. The program will be able to delete  an existing client.
    * Input:
        * {"Franklin", id:1}->delete();
    * Output:
        * null;
5. The program will be find all clients of a specific stylist.
    * Input:
        * {"Franklin",stylist_id:1 id:1}->delete();
        * {"Johnny",stylist_id:2 id:1}->delete();
        * {"Jessica",stylist_id:2 id:1}->delete();
        * {"Stacey",stylist_id:1 id:1}->delete();
    * Output:
        * {"Johnny",stylist_id:2 id:1}->delete();
        * {"Jessica",stylist_id:2 id:1}->delete();


##Copyright (c) 2017 Dylan Stackhouse, licensed under the MIT license.

####mySQL commands
* CREATE DATABASE hair_salon;
* USE hair_salon:
* CREATE TABLE stylist (id serial PRIMARY KEY, name VARCHAR (255));
* CREATE TABLE client (id SERIAL PRIMARY KEY, name VARCHAR (255), stylist_id INT);
