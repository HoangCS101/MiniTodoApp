<?php
namespace Models;

class Todo
{
    private $conn;
    
    # Constructor -> Connect Database
    function __construct () {
        include_once("db/connection.php");
        $this->conn = $conn;
    }
    # Destructor -> Close connection
    function __destruct () {
        $this->conn->close();
        // echo "Connection closed.<br>";
    }
    # Retrieve full table
    function list () {
        $sql = "SELECT id, todo_name FROM todo_list";
        return $this->conn->query($sql);
    }
    # Insert new data
    function new ($todo_name, $content) {
        $sql = $this->conn->prepare("INSERT INTO todo_list (todo_name, content) VALUES (?, ?)");
        $sql->bind_param("ss", $todo_name, $content);
        if ($sql->execute()) {
            echo "New record created successfully (riel)<br>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
        }
        $sql->close();
    }
    # Edit data
    function edit ($id, $todo_name, $content) {
        if (!empty($todo_name) && !empty($content))
        {
            $sql = $this->conn->prepare("UPDATE todo_list SET todo_name=?, content=? WHERE id=?");
            $sql->bind_param("ssi", $todo_name, $content, $id);
        }
        elseif (!empty($todo_name))
        {
            $sql = $this->conn->prepare("UPDATE todo_list SET todo_name=? WHERE id=?");
            $sql->bind_param("si", $todo_name, $id);
        }
        else
        {
            $sql = $this->conn->prepare("UPDATE todo_list SET content=? WHERE id=?");
            $sql->bind_param("si", $content, $id);
        }
        if ($sql->execute()) {
            echo "Record updated successfully (riel)<br>";
        } else {
            echo "Error updating record: " . $conn->error . "<br>";
        }
        $sql->close();
    }
    # See detail
    function detail ($id) {
        $sql = $this->conn->prepare("SELECT id,todo_name,content FROM todo_list WHERE id=?");
        $sql->bind_param("i", $id);
        $sql->execute();
        $result = $sql->get_result();
        // $row = $result->fetch_assoc();
        // $sql->closed();
        return $result;
    }
}
?>