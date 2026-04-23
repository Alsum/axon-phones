# 📞 Axon Phones

**Phone number categorisation and validation tool for African telecoms.**

Axon Phones is a Laravel web application that reads customer phone numbers from an SQLite database, automatically detects the country of origin, validates each number against country-specific regex rules, and presents the results in a filterable, paginated table.

---

## ✨ Features

| Feature | Description |
|---|---|
| **Country Detection** | Automatically identifies the country from the phone number prefix (Cameroon, Ethiopia, Morocco, Mozambique, Uganda). |
| **Regex Validation** | Validates each phone number against ITU-compliant regex patterns per country. |
| **Filter by Country** | Dropdown filter to narrow results to a single country. |
| **Filter by State** | Filter phone numbers by validation state — *Valid* or *Invalid*. |
| **Pagination** | Server-side pagination (10 results per page) with full page navigation. |
| **Clean UI** | Responsive, branded interface with status badges (OK / NOK). |
| **Docker Support** | Dockerfile included for containerised deployment. |

---

## 🏗️ Architecture

```
app/
├── Http/
│   ├── Controllers/
│   │   └── PhoneNumberController.php   # Handles the index route
│   └── Requests/
│       └── PhoneFilterRequest.php      # Validates & sanitises filter inputs
├── Models/
│   ├── Customer.php                    # Eloquent model (customer table)
│   └── PhoneNumber.php                 # Value object (parsed phone result)
├── Services/
│   ├── CountryDefinition.php           # Immutable country data (name, prefix, regex)
│   ├── CountryRegistry.php             # Registry of all supported countries
│   ├── PhoneParser.php                 # Parses raw phone → PhoneNumber object
│   └── PhoneNumberService.php          # Orchestrates filtering & pagination
└── Providers/

resources/views/
├── layouts/
│   └── app.blade.php                   # Base layout with embedded CSS
└── phones/
    └── index.blade.php                 # Phone number listing page

routes/
└── web.php                             # Single route: GET /
```

### Key design decisions

- **Service Layer** — Business logic is decoupled from the controller via `PhoneNumberService`, `PhoneParser`, and `CountryRegistry`.
- **Value Object** — `PhoneNumber` is a readonly class, not an Eloquent model, keeping parsed results immutable.
- **Form Request** — Input validation is handled by `PhoneFilterRequest`, keeping the controller thin.

---

## 🌍 Supported Countries

| Country | Prefix | Regex Pattern |
|---|---|---|
| Cameroon | `+237` | `\(237\) ?[2368]\d{7,8}$` |
| Ethiopia | `+251` | `\(251\) ?[1-59]\d{8}$` |
| Morocco | `+212` | `\(212\) ?[5-9]\d{8}$` |
| Mozambique | `+258` | `\(258\) ?[28]\d{7,8}$` |
| Uganda | `+256` | `\(256\) ?\d{9}$` |

---

## 🛠️ Tech Stack

- **Backend:** PHP 8.3, Laravel 13
- **Frontend:** Blade templates, vanilla CSS
- **Database:** SQLite
- **Build Tools:** Vite 8, Tailwind CSS 4 (available but layout uses embedded CSS)
- **Testing:** PHPUnit 12
- **Containerisation:** Docker (PHP 8.3 CLI image)

---

## 🚀 Getting Started

### Prerequisites

- **PHP** ≥ 8.3
- **Composer** ≥ 2
- **Node.js** ≥ 18 & **npm**
- **SQLite** 3

### Quick Setup

```bash
# 1. Clone the repository
git clone https://github.com/Alsum/axon-phones.git
cd axon-phones

# 2. Run the automated setup script
composer setup
```

The `composer setup` script will:
1. Install PHP dependencies
2. Copy `.env.example` → `.env` (if not present)
3. Generate the application key
4. Run database migrations
5. Install Node dependencies
6. Build frontend assets

### Manual Setup

```bash
# Install PHP dependencies
composer install

# Copy environment config
cp .env.example .env

# Generate app key
php artisan key:generate

# Run migrations
php artisan migrate

# Install & build frontend assets
npm install
npm run build
```

### Running the Application

```bash
# Start all services concurrently (server + queue + logs + Vite)
composer dev
```

This launches:
- **Laravel dev server** at `http://localhost:8000`
- **Queue worker** for background jobs
- **Pail** for real-time log tailing
- **Vite** dev server for hot-reload

Alternatively, to run just the server:

```bash
php artisan serve
```

---

## 🐳 Docker

```bash
# Build the image
docker build -t axon-phones .

# Run the container
docker run -p 8000:8000 axon-phones
```

The app will be available at `http://localhost:8000`.

---

## 🧪 Testing

```bash
# Run the test suite
composer test
```

Tests run against an in-memory SQLite database (configured in `phpunit.xml`).

---

## 📁 Database

The application expects a `customer` table with the following schema:

| Column | Type | Description |
|---|---|---|
| `id` | INTEGER | Primary key |
| `name` | TEXT | Customer name |
| `phone` | TEXT | Raw phone number, e.g. `(237) 673122155` |

The pre-populated SQLite database is located at `database/database.sqlite`.

---

## 📄 License

This project is open-sourced software licensed under the [MIT License](https://opensource.org/licenses/MIT).
