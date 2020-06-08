<?php
session_start();
class DbConfig
{
  private $_host = 'localhost';
  private $_username = 'root';
  private $_password = '';
  private $_database = 'pfa';
  protected $connection;
  public function __construct()
  {
    if (!isset($this->connection)) {
      $this->connection = new mysqli($this->_host, $this->_username, $this->_password, $this->_database);
      if (!$this->connection) {
          echo 'Cannot connect to database server';
          exit;
      }
    }
  return $this->connection;
  }
}
//Crud
class Crud extends DbConfig
{
  public function __construct()
  {
    parent::__construct();
  }
  public function delete($id, $table) 
        {
          $query = "DELETE FROM $table WHERE id = $id";
          $result = $this->connection->query($query);
          if ($result == false) {
            echo 'Error: cannot delete id ' . $id . ' from table ' . $table;
            return false;
          }
          else {
            return true;
          }
        }
  public function getData($query)
  {
    $result = $this->connection->query($query);
    if ($result == false) {
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
    if ($result == false) {
      echo 'Error: cannot execute the command';
      return false;
    } 
    else {
      return true;
    }
  }
  public function escape_string($value)
  {
    return $this->connection->real_escape_string($value);
  }
}