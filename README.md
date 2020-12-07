# PetFinder 🐶
Tired of missing pet posters on tree trunks? Introducing PetFinder, a full-stack website where you can find/report missing pets.

Find the code and `README.md` at https://github.com/AaditT/PetFinder

## Instructions

1. Download the GitHub repository `$ git clone https://github.com/AaditT/PetFind` and move folder to XAMPP directory
2. Run the SQL code in `sql/petFindSQL.sql` in phpMyAdmin to create the pet_find database
3. Create a user `Pet_Us3r` with password `i89oUYsl0X8sgo3c` in phpMyAdmin for the pet_find database
4. Create an API Key at [Mapbox](https://www.mapbox.com/)
5. Create a file `config.js` and enter the following code:
```
var config = {
  MAPBOX_API_KEY: 'enter your API key here';
}
```
6. Use admin page with username `admin` and password `root` to delete entries. You can change these values in `admin/adminConfig.php`
7. Have fun!

## Self-Evaluation
I like the Mapbox feature which was really interesting to develop
because I had to build a customized JavaScript query for the API using PHP data.
In the future, I plan on working on a method to automate the connection process.
It would be nice to have the petowner and pet"finder" connect on the website
instead on relying on contact phone numbers.

## Images

1. View all pet entries <br>
![All entries](https://i.imgur.com/Ks0SQgr.jpg)

2. Report a found/missing pet <br>
![Report a found/missing pet](https://i.imgur.com/GUu05lZ.jpg)

3. View pet details <br>
![View pet details](https://i.imgur.com/d6MlomB.jpg)

4. Admin Page <br>
![Admin Page](https://i.imgur.com/zHFyQDz.jpg)
