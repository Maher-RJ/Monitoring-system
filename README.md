# Monitoring-system

<img width="692" alt="Screenshot 2020-02-20 at 15 31 09" src="https://user-images.githubusercontent.com/57875037/74944246-09d16700-53f6-11ea-947f-ddb00f5af8a7.png">

System Interfaces

<img width="715" alt="Screenshot 2020-02-20 at 15 38 22" src="https://user-images.githubusercontent.com/57875037/74945126-75680400-53f7-11ea-8505-ce49083625a7.png">

Hardware implementation of the system
<img width="695" alt="Screenshot 2020-02-20 at 15 38 54" src="https://user-images.githubusercontent.com/57875037/74945195-99c3e080-53f7-11ea-8fa3-8821c1f005bc.png">


* To Start Laravel Project, you need to install laravel framework in your computer and then download the folder from my repository and put it in Desktop then you need to edit .env file to make the database work, in .env file you will need to edit DB_DATABASE and put there the path of data.sqlite which you will find it also in folder Laravel->database. After this you need just to start the server in Terminal by using "php artisan serve --host=192.168.0.55 --port=8000".//Put your ip

* For the android app after you open it with android studio, you need first to change in Request.kt and put there the ip adress of laravel server in public val url: String. Becuase the mobile app has to send an email and password using post HTTP request to the web API
