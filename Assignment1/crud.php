<?php
require_once "database.php";
class crud extends database
{
    public function __construct(){
        parent::__construct();
    }
    public function getData($query)
    {
        $result = $this->connection->query($query);
        if (!$result) {
            return false;
        }
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }
    public function execute($query)
    {
        $result = $this->connection->query($query);
        if (!$result) {
            echo "<p>Error: Cannot execute query</p>";
            return false;
        } else {
            return true;
        }
    }
    public function escape_string($value)
    {
        return $this->connection->escape_string($value);
    }
}
?>