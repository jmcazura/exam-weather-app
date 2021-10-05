## App implementation
- Web dev technologies used in this project: Laravel, VueJS, axios, bootstrap, API.

- Using Laravel is very great to use it has a lot of built-in features to help developers to lessen the time of developing a project. It solve many problem of developers like database seeding & migration, array manipulation using collection, unit testing and many more..

- The Foursquare API & Openweather API are combined in backend and just return the data needed for client application using that method it would reduce the amount of mobile data consumed by the client or end user. 

- The less data consumed by the application can be cost effective specially for the 1st time tourist.

- In the UX I think it's important to add the time sunrise / sunset for the tourist to know when best to go back at the hotel before it become dark or know when best to wake-up to see the beauty of the place in the morning. Sunrise and sunset also varies from country to country.

- In places I added a short description of the place and a link of the map for navigation. Unfortunatelly I can't add pictures because its available only for premium.

- VueJS combined with axios are great tools to use in API application. The reactivity and data manipulation in vue are very fast compared to the good old jquery. 
Other benefits that can take advantage in vue is the vue cli, it can compress javascript and css file in production environment. The smaller the js and css file the better it will help to load the page faster specially in remote area that has slow network connection.

## Installation

```
1. git clone https://github.com/jmcazura/exam-weather-app.git
2. cd exam-weather-app
3. composer install
4. cp .env.example .env
5. php artisan key:generate
6. Add the environment variable in the bottom of .env file (sent in email)
```
## Running the program
```
1. cd exam-weather-app
2. php artisan serve
3. Open the link
```