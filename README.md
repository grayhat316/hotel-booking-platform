# Hotel Booking Platform

A Laravel-based booking platform for hotels offering accommodation, dining, conferencing, and outdoor activities.

## Features

- Admin Dashboard with full CRUD control over:
  - Rooms
  - Food Items
  - Services (Dining, Conferencing, Outdoors, Events)
  - Gallery Images
  - Bookings
- Modern UI using Bootstrap 5
- Responsive design
- Image uploads for rooms, foods, services, and gallery
- Booking management with status tracking

## Requirements

- PHP >= 8.0.2
- Composer
- MySQL/MariaDB (or any supported database)
- OpenSSL PHP Extension (required for Composer)

## Installation

1. **Enable OpenSSL in PHP**
   - Locate your `php.ini` file
   - Uncomment or add: `extension=openssl`
   - Restart your web server

2. **Install Dependencies**
   ```bash
   composer install
   ```

3. **Environment Setup**
   - Copy `.env.example` to `.env`
   - Update database credentials in `.env`
   - Generate application key: `php artisan key:generate`

4. **Database Migration**
   ```bash
   php artisan migrate
   ```

5. **Storage Link (if needed)**
   ```bash
   php artisan storage:link
   ```

6. **Start Development Server**
   ```bash
   php artisan serve
   ```

   Access the application at `http://localhost:8000`

   Admin dashboard is available at `/admin`

## Directory Structure

- `app/Models` - Eloquent models (Room, Food, Service, Gallery, Booking)
- `database/migrations` - Database schema migrations
- `app/Http/Controllers/Admin` - Admin controllers for CRUD operations
- `resources/views/admin` - Blade templates for admin panels
- `public/uploads` - Directory for uploaded images (rooms, foods, services, gallery)

## Customization

- Modify views in `resources/views/admin` to change the admin interface
- Add more fields to models and migrations as needed
- Extend controllers for additional business logic

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Notes

- This platform is designed to be hosted on cheap Kenyan hosting platforms that support PHP and MySQL.
- Ensure the `public/uploads` directory is writable by the web server.
- For production, configure proper HTTPS, caching, and session drivers.

## Screenshots (if any)

_(Add screenshots here)_

---
Built with Laravel.Force Railway redeploy
