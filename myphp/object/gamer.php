<?php

/**
 * Description of gamer
 *
 * @author https://roytuts.com
 */
class gamer
{

    // database connection and table nickname
    private $conn;
    private $table_name = "gamer";
    // object properties
    public $id;
    public $nickname;
    public $age;
    public $level;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // read departments
    function read()
    {
        // query to select all
        $query = "SELECT d.id, d.nickname, d.age, d.level
            FROM
                " . $this->table_name . " d
            ORDER BY
                d.dept_id";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }

    // create gamer
    function create()
    {
        // query to insert record
        $query = "INSERT INTO
                " . $this->table_name . "
            SET
                dept_name=:nickname";
        // prepare query
        $stmt = $this->conn->prepare($query);
        // sanitize
        $this->nickname = htmlspecialchars(strip_tags($this->nickname));

        // bind values
        $stmt->bindParam(":nickname", $this->nickname);

        // execute query
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // update the gamer
    function update()
    {
        // update query
        $query = "UPDATE
                " . $this->table_name . "
            SET
                dept_name = :nickname
            WHERE
                dept_id = :id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->nickname = htmlspecialchars(strip_tags($this->nickname));
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->age = htmlspecialchars(strip_tags($this->age));
        $this->level = htmlspecialchars(strip_tags($this->level));

        // bind new values
        $stmt->bindParam(':nickname', $this->nickname);
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':age', $this->age);
        $stmt->bindParam(':level', $this->level);

        // execute the query
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // delete the gamer
    function delete()
    {
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->id = htmlspecialchars(strip_tags($this->id));

        // bind id of record to delete
        $stmt->bindParam(1, $this->id);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}