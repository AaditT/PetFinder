# PetFinder 🐶
Tired of missing pet posters on tree trunks? Introducing PetFinder, a full-stack website where you can find/report missing pets.

Find the code and `README.md` at https://github.com/AaditT/PetFinder

## Instructions

1. Download the GitHub repository `$ git clone https://github.com/AaditT/PetFind` and move folder to XAMPP directory
2. Run the SQL code in `sql/petFinder_AT.sql` in phpMyAdmin within a new `petFinder_AT` database
3. Create a user `petfinder_user` with password `B1yzGnrtqYUJnL8j` in phpMyAdmin for the `petFinder_AT` database
4. Create an API Key at [Mapbox](https://www.mapbox.com/)
5. Add API Key to line 304:
```
'enter your API key here';
```
6. Use admin page with username `admin` and password `root` to delete entries. You can change these values in `admin/adminConfig.php`
7. Have fun!

## Self-Evaluation
I like the Mapbox feature which was really interesting to develop
because I had to build a customized JavaScript query for the API using PHP data.
In the future, I plan on working on a method to automate the connection process.
It would be nice to have the petowner and pet"finder" connect on the website
instead on relying on contact phone numbers.

## New Updates
I added user authentication. Now users have to be logged in to report found or missing pets. Additionally, when a user finds a missing pet, the user can go to their profile and remove their previous entry to avoid future confusion.

## Images

1. View all pet entries <br>
![All entries](https://i.imgur.com/Ks0SQgr.jpg)

2. Report a found/missing pet <br>
![Report a found/missing pet](https://i.imgur.com/GUu05lZ.jpg)

3. View pet details <br>
![View pet details](https://i.imgur.com/d6MlomB.jpg)

4. Admin Page <br>
![Admin Page](https://i.imgur.com/zHFyQDz.jpg)
