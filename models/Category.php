<?php


class Category
{
    // DB stuff
    private $conn;
    private $table = 'categories';

    // Properties
    public $id;
    public $name;
    public $created_at;

    // constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = 'SELECT 
                    id,
                    name,
                    created_at
                  FROM ' . $this->table . '
                  ORDER BY 
                    created_at DESC';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

}