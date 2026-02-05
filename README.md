
README file for migrating Home Website from Subversion to Git

Created preliminary project structure per:
https://medium.com/@thecodeliner/how-to-structure-a-modern-php-project-a-practical-guide-b53f2990890d

A Modern PHP Project Structure

Here’s a flexible folder structure for a PHP project. It’s framework-agnostic but 
can be adapted for Laravel, Symfony, or lightweight frameworks like Slim. 
I’ll explain each component and why it matters.

project-root/
├── config/                   # Configuration files
│   ├── database.php          # Database settings
│   ├── app.php              # App-wide settings
│   └── routes.php           # Route definitions
├── public/                   # Publicly accessible files
│   ├── index.php            # Application entry point
│   ├── .htaccess            # URL rewriting (Apache)
│   └── assets/              # CSS, JS, images
├── src/                      # Core application logic
│   ├── Controllers/         # HTTP request handlers
│   ├── Models/              # Data entities
│   ├── Services/            # Business logic
│   ├── Repositories/        # Data access layer
│   ├── Middleware/          # Request/response middleware
│   └── Utils/               # Helper functions
├── tests/                    # Unit and integration tests
│   ├── Unit/                # Unit tests
│   └── Integration/         # Integration tests
├── vendor/                   # Composer dependencies
├── .env                      # Environment variables
├── composer.json             # Dependency and autoload config
├── phpunit.xml               # PHPUnit test config
└── README.md                 # Project documentation

Breaking Down the Structure

config/: Stores configuration files like database credentials or app settings. 
Use a .env file with vlucas/phpdotenv to manage environment-specific settings 
securely. Example .env:

DB_HOST=localhost
DB_NAME=myapp
DB_USER=root
DB_PASS=secret

public/: The web server’s document root. Only index.php (the front controller) 
and static assets (CSS, JS, images) live here to minimize security risks. 
Configure your web server (e.g., Apache, Nginx) to point to this directory.

src/: The heart of your application. Organize your code by domain or functionality.

Controllers: Handle HTTP requests and responses (e.g., UserController.php).

Models: Represent data entities like User or Product. Use an ORM (e.g., Eloquent or Doctrine) or custom classes.

Services: Encapsulate business logic (e.g., UserService.php for user registration or updates).

Repositories: Abstract database queries to decouple models from persistence (e.g., UserRepository.php).

Middleware: Manage cross-cutting concerns like authentication or logging.

Utils: Store reusable helper classes or functions (e.g., string formatters).

tests/: Contains unit and integration tests. Mirror the src/ structure 
(e.g., tests/Unit/Controllers/). Use PHPUnit or Pest for testing.

vendor/: Managed by Composer for third-party libraries and autoloading. 
Never commit this to version control — use .gitignore.

.env, composer.json, phpunit.xml: Core configuration files for environment variables, dependencies, and testing setup.

README.md: Documents setup instructions, project overview, and deployment steps. 
Make it clear for new developers or contributors.


