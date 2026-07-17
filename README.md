# CampusStay ZW 🏠

CampusStay ZW is a web platform designed to help students in Zimbabwe find affordable accommodation near their campuses. It connects landlords directly with students, offering a transparent, user‑friendly experience for listing, browsing, and securing rooms.

---

## ✨ Features
- **[Property Listings](ca://s?q=CampusStay_property_listings)**: Students can browse available rooms with images, descriptions, and prices.
- **[Landlord Dashboard](ca://s?q=CampusStay_landlord_dashboard)**: Landlords can add, edit, and manage their listings.
- **[Admin Panel](ca://s?q=CampusStay_admin_dashboard)**: Admins can approve or reject listings, ensuring quality and authenticity.
- **[WhatsApp Integration](ca://s?q=CampusStay_WhatsApp_contact)**: Students can contact landlords directly via WhatsApp.
- **[Authentication](ca://s?q=CampusStay_authentication)**: Role‑based access for students, landlords, and admins.
- **[Responsive UI](ca://s?q=CampusStay_responsive_UI)**: Built with TailwindCSS for a clean, mobile‑friendly interface.

---

## 🛠 Tech Stack
- **Backend**: Laravel 12 (PHP 8.2)
- **Frontend**: Blade templates + TailwindCSS
- **Database**: MySQL
- **Admin Dashboard**: Filament
- **Authentication**: Laravel Breeze
- **Storage**: Local/public disk for property images

---

## 🚀 Getting Started

### Prerequisites
- PHP 8.2+
- Composer
- MySQL
- Node.js & npm

### Installation
```bash
# Clone the repository
git clone git@github.com:sgii-lab/campusstay.git
cd campusstay

# Install dependencies
composer install
npm install && npm run build

# Configure environment
cp .env.example .env
php artisan key:generate

# Run migrations
php artisan migrate

# Start local server
php artisan serve
