# Airline Booking System

This is a simple Airline Booking System implemented using PHP and MySQL. It allows users to perform various operations such as adding airlines, airports, passengers, flights, and bookings. Users can also search for available flights based on departure and arrival airports and departure date.

## Features

- **Add Airlines**: Users can add new airlines to the system.
- **Add Airports**: Users can add new airports to the system.
- **Add Passengers**: Users can add new passengers to the system.
- **Add Flights**: Users can schedule new flights, specifying airline, departure and arrival airports, departure and arrival times, and price.
- **Make Bookings**: Users can make bookings for flights by selecting a flight and passenger.
- **Search Flights**: Users can search for available flights based on departure and arrival airports and departure date.

## Technologies Used

- **PHP**: Used for server-side scripting.
- **MySQL**: Used for the database management system.
- **Tailwind CSS**: Used for styling the user interface.

## Setup Instructions

1. Clone the repository to your local machine.
2. Import the database schema from `database_schema.sql` file to your MySQL server.
3. Update the `config.php` file with your MySQL database credentials.
4. Launch the project using a web server such as Apache or Nginx.

## File Structure

- **`index.php`**: PHP file for adding a new airline.
- **`airports.php`**: PHP file for adding a new airport.
- **`passengers.php`**: PHP file for adding a new passenger.
- **`flights.php`**: PHP file for adding a new flight.
- **`bookings.php`**: PHP file for adding a new booking.
- **`search.php`**: PHP file for searching available flights.
- **`config.php`**: PHP file containing database configuration.
- **`header.php`**: PHP file containing header section of the HTML.
- **`footer.php`**: PHP file containing footer section of the HTML.

## Contributors

- [Tarik Billa](https://github.com/tarikbilla)

## License

This project is licensed under the [GPL](LICENSE).
