<?php

use database\Database;
use database\migrations\create_subjects_table;
use database\migrations\create_users_subjects_table;
use database\migrations\create_users_table;

class App
{
    public array $databaseConnection = [
      'host' => 'localhost',
      'port' => 3306,
      'username' => 'root',
      'password' => 'root'
    ];

    public string $databaseName = 'refaq_php';

    public Database $database;

    public Container $container;

    public function __construct()
    {
        session_start();

        $this->database = $this->connectToDatabase();

        $this->container = $this->createServiceContainer();

        $this->runMigrations();
    }

    public function routes(): array
    {
        return [
          'subjects' => __DIR__ . '\views\SubjectsView.php',
          'auth'     =>  __DIR__ . '\views\AuthView.php',
        ];
    }

    public function routeCheck()
    {
        $routes = $this->routes();
        $queryString = $_SERVER['QUERY_STRING'];

        foreach ($routes as $route => $file) {
            if (str_contains($queryString, $route)) {
               return require_once $file;
            }
        }

        static::redirectTo('subjects');
    }

    public function connectToDatabase(): Database
    {
        $database = new Database(
            $this->databaseConnection['host'],
            $this->databaseConnection['port'],
            $this->databaseConnection['username'],
            $this->databaseConnection['password']
        );

        return $database->createDatabase($this->databaseName)
            ->use($this->databaseName);
    }

    public function createServiceContainer(): Container
    {
        return new Container($this->database);
    }

    public function runMigrations(): void
    {
        $subjectsMigration      = new create_subjects_table($this->database);
        $usersMigration         = new create_users_table($this->database);
        $usersSubjectsMigration = new create_users_subjects_table($this->database);
    }

    public static function redirectTo($route): void
    {
        // Reset the query string
        $urlParts = parse_url($_SERVER['REQUEST_URI']);
        $path = $urlParts['path'];

        // Redirect to the updated URL with the query string
        header('Location: ' . $path . "?$route");
    }
}