<?php
namespace r567tw\phpmvc;

use PDO;

class Database
{
    public \PDO $pdo;

    public function __construct(array $config)
    {
        $dsn = $config['dsn'] ?? '';
        $user = $config['user'] ?? '';
        $password = $config['password'] ?? '';
        $this->pdo = new \PDO($dsn,$user,$password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
    }

    public function applyMigrations()
    {
        $this->createMigrationTable();
        $applidMigrations = $this->getAppliedMigrations();
        $newMigrations = [];

        $files = scandir(Application::$rootPath.'/migrations');
        $toApplyMigrations = array_diff($files,$applidMigrations);
        foreach ($toApplyMigrations as $migration) {
            if ($migration != '.' && $migration != '..'){
                echo "Apply $migration\n";
                require_once Application::$rootPath.'/migrations/'.$migration;
                $className = pathinfo($migration,PATHINFO_FILENAME);
                $instance = new $className();
                $instance->up();
                $newMigrations[] = $migration;
                echo "Applied $migration\n";
            }
        }

        if (!empty($newMigrations)){
            $this->saveMigrations($newMigrations);
        } else {
            echo "All applied!\n";
        }
    }

    public function createMigrationTable()
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )  ENGINE=INNODB;");
    }

    public function getAppliedMigrations()
    {
        $stat = $this->pdo->prepare("select migration from migrations");
        $stat->execute();

        return $stat->fetchAll(\PDO::FETCH_COLUMN);
    }

    public function saveMigrations(array $migrations)
    {
        $migrations = implode(',',array_map(fn($m)=> "('$m')",$migrations));
        $stat = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES $migrations");
        $stat->execute();
    }

}
