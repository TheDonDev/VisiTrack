<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="Leonardo_Phoenix.jpg" width="400" alt="VisiTrack">
  </a>
</p>

# VisiTrack 🌍

VisiTrack is a web application designed to manage visitor check-ins and bookings at various locations. It provides a seamless experience for both hosts and visitors, ensuring efficient tracking and management of visits.

## Features ✨
- User-friendly interface for booking visits.
- Email notifications for visitors and hosts.
- Real-time tracking of visitor status.
- Comprehensive feedback system.

## Installation Instructions 🚀

To set up the VisiTrack application locally, follow these steps:

1. **Clone the repository**:
   ```bash
   git clone https://github.com/thedondev/visitrack.git
   cd visitrack
   ```

2. **Install dependencies**:
   ```bash
   composer install
   npm install
   ```

3. **Set up the environment**:
   - Copy the `.env.example` file to `.env`:
     ```bash
     cp .env.example .env
     ```
   - Update the `.env` file with your database credentials and other configurations.

4. **Run migrations**:
   ```bash
   php artisan migrate
   ```

5. **Start the application**:
   ```bash
   php artisan serve
   ```

## Usage 📖

Once the application is running, you can access it at `http://localhost:8000`. Here are some key functionalities:

- **Book a Visit**: Navigate to the booking page to schedule a visit.
- **Check-in**: Visitors can check in upon arrival.
- **Feedback**: Provide feedback after your visit.

## File Structure 📁

Here's a brief overview of the project's directory structure:

```
visitrack/
├── app/                  # Application logic
│   ├── Http/             # Controllers
│   ├── Mail/             # Email templates
│   └── Models/           # Database models
├── database/             # Database migrations and seeders
├── resources/            # Views and assets
│   ├── views/            # Blade templates
│   └── css/              # Stylesheets
├── routes/               # Application routes
└── tests/                # Automated tests
```

## Contributing 🤝

We welcome contributions! Please read our [contribution guidelines](https://laravel.com/docs/contributions) for more information on how to get involved.

## License 📜

VisiTrack is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Contact Information 📫

For any inquiries or issues, please reach out to the maintainers at [donaldmwanga33@gmail.com.com](mailto:donaldmwanga33@gmail.com).
