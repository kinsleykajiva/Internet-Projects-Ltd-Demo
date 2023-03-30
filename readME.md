

# Fruits Test Task Project 

- Clone the repository

## Project solution 


### Requirements

- Write a console script for getting all fruits from https://fruityvice.com/ and saving them into local DB (MySQL or PostgreSQL).
- Create a command for `php bin/console fruits:fetch`
- When all fruits are saved into the DB send an email about it to a dummy admin email (e.g. test@gmail.com or your gmail address).
- Create a page with all fruits (paginated). Add a form to filter fruits by name and family. Each fruit can be added to favorites (up to 10 fruits).
- Create a page with favorite fruits. Display all nutrition facts for all fruits.



Project folders 
- **database-sample** - this is a sample of the[ Mysql database](https://www.mysql.com/) produced
- **front-end** - The front end   made by vue JS
- **fruit-test-api** - The backend powered by  [Symfony](https://symfony.com/) 
- **routes-doc** - The documented [Insomnia](https://insomnia.rest/) routes . This is similar to [PostMan](https://www.postman.com/).
- **screenshots** -  Has the screenshots of the work to prove that this works as much


### Prerequisites

Before running this project, you will need to have the following software installed:

1. Node.js v12 or higher
2. MySql 8 or higher , make sure to import the dump if need be
3. php 8 , install via [Xampp Apache](https://www.apachefriends.org/index.html) . Make php or php.exe Globally available as well .
4. Install composer from [Website](https://getcomposer.org/download/)  

### To install
1.  **front-end** - Cd into the folder .  Install dependencies: `npm install` , To run the front end ,still the same folder run   ` npm run dev `  the application will be available at http://localhost:3000
2. **fruit-test-api** :
   * CD into the folder and run .
   * To install dependancies or libs run `php composer.phar install` or `composer install` and
   * [Install Symfony CLI](https://symfony.com/download)   .
   * To run the the app , if all is well `symfony server:start`  the backend app will be available at :  http://127.0.0.1:8000



If you face some issues please make an issue or get hold of me I am glad and i am free to help as much


Here are some screenshots :


<img src="screenshots/Screenshot%202023-03-30%20141436.png">
<img src="screenshots/Screenshot%202023-03-30%20141608.png">
<img src="screenshots/Screenshot%202023-03-30%20141652.png">
<img src="screenshots/Screenshot%202023-03-30%20141737.png">
<img src="screenshots/Screenshot%202023-03-30%20141834.png">
<img src="screenshots/Screenshot%202023-03-30%20153245.png">
<img src="screenshots/Screenshot%202023-03-30%20154317.png">






