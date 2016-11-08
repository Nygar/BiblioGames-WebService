<?php

class Conector extends PDO
{
    //Propiedades
    private $connection;

    /**
     * Conector constructor.
     */
    public function __construct()
    {
    }

    public function getNewConnection(){
        try {
            $this->connection = new PDO("mysql:host=mysql.hostinger.es;dbname=u850636529_bibli", "u850636529_bibli", "alberto00");
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        return $this->connection;
    }

    /**
     * @return mixed
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * @param mixed $connection
     */
    public function setConnection($connection)
    {
        $this->connection = $connection;
    }

    //Function for close connection
    public function closeConnection()
    {
        mysqli_close($this->connection);
    }

}