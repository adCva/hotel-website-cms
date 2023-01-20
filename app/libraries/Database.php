<?php

// Core database file
class Database
{
    private $dbHost = DB_HOST;
    private $dbUser = DB_USER;
    private $dbPass = DB_PASS;
    private $dbName = DB_NAME;

    private $statement;
    private $connection;
    private $error;


    public function __construct()
    {
        $conn = 'mysql:host=' . $this->dbHost . ';dbname=' . $this->dbName;
        $options = [
            PDO::ATTR_PERSISTENT => TRUE,
            PDO::ERR_NONE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->connection = new PDO($conn, $this->dbUser, $this->dbPass, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }


    // Write queryes.
    public function query($sql)
    {
        $this->statement = $this->connection->prepare($sql);
    }


    // Bind parameters.
    public function bind($parameter, $value, $type = null)
    {
        switch (is_null($type)) {
            case is_int($value):
                $type = PDO::PARAM_INT;
                break;
            case is_bool($value):
                $type = PDO::PARAM_BOOL;
                break;
            case is_null($value):
                $type = PDO::PARAM_NULL;
                break;
            default:
                $type = PDO::PARAM_STR;
        }
        $this->statement->bindValue($parameter, $value, $type);
    }


    // Execute prepared statement.
    public function execute()
    {
        return $this->statement->execute();
    }


    // Return single resault row.
    public function getSingleResult()
    {
        $this->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }


    // Return multiple results rows.
    public function getMultipleResults()
    {
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }


    // Return row count.
    public function getRowCount()
    {
        $this->execute();
        return $this->statement->rowCount();
    }
}
