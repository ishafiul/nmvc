<?php

namespace app\core;

use Exception;
use PDO;
use PDOException;

use Dotenv\Dotenv;
use RuntimeException;

$dotenv=Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->load();

class Database
{
    private $dbh;
    private $stmt;
    private $error;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $dsn = 'mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'];
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        // Create PDO instance
        try {
            $this->dbh = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS'], $options);
        } catch (PDOException $e) {
            throw new Exception(' Bad Gateway
            <div>
            <h4>Unable to Connect With Database!</h4>
            <p>Host: '.$_ENV['DB_HOST'].'</p>
            <p>DBname: '.$_ENV['DB_NAME'].'</p>
            <p>UserName: '.$_ENV['DB_USER'].'</p>
            </div>
            ','502');
        }
    }

    // Prepare statement with query
    public function query($sql):void
    {
        $this->stmt = $this->dbh->prepare($sql);
    }

    // Bind values
    public function bind($param, $value)
    {
        $type = match ($value) {
            is_int($value) => PDO::PARAM_INT,
            is_bool($value) => PDO::PARAM_BOOL,
            is_null($value) => PDO::PARAM_NULL,
            default => PDO::PARAM_STR,
        };


        $this->stmt->bindValue($param, $value, $type);
    }

    // Execute the prepared statement
    public function execute()
    {
        return $this->stmt->execute();
    }

    // Get result set as array of objects
    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Get single record as object
    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    // Get row count
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }
    public function lastInsertId()
    {
        return $this->dbh->lastInsertId();
    }
}