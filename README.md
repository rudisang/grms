## How To Install Morento

- Clone the repository or download the zip folder and extract into your xampp/wamp root folder.
- Open your terminal and CD into the extracted folder.
- Run the command "composer update".
- Once Composer update is complete, run "composer install".
- Open the project with your favorite text editor and look for a .env.example  file.
- Rename this file to just .env
- open it and change DB_DATABASE to DB_DATABASE=rental_db.
- save 
- go back to the terminal and run the command "php artisan key:generate"
- once key has been generated run "php artisan migrate" to populate your database
- and finally run php artisan serve to to view project on your browser

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
