<?php
namespace dbFile;
require_once("config.php");

class dbClass {
    public $conn;
    public function __construct(){
        //check for db connection. Create if it is not connected
        if(!$this->conn){
            // Create connection
            $this->conn = new \mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DBNAME);

            // Check connection
            if ($this->conn->connect_error) {
                die("Connection failed: " . $this->conn->connect_error);
            }
        }        
    }

    public function getUserInfo($userName,$pwd){
        if(empty($userName) || empty($pwd)){
            return false;
        }
        //fetch userinformation from database
        $sql = "SELECT * FROM tbl_users WHERE email = '".$userName."' AND password = '".$pwd."' AND status = 1";
        $result = $this->conn->query($sql);
        $userInfo = [];
        if ($result->num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {
                array_push($userInfo,$row);
            }            
        }
        return $userInfo;
    }

    public function insertUser($userInfo, $tbl){
        if(empty($userInfo)){
            return false;
        }

    }

    public function updateUserById($userId, $userInfo, $tbl){
        if(empty($userId) || empty($userInfo)){
            return false;
        }
        echo "update query";
    }

    public function deleteUserById($userId, $tbl){
        if(empty($userId)){
            return false;
        }
        $sql = "DELETE FROM ". $tbl. " WHERE id = '". $userId ."';";
        return $this->conn->query($sql);
    }

    public function getAllUsers(){
        $sql = "SELECT * FROM tbl_users ORDER BY id ASC";
        $result = $this->conn->query($sql);
        $userInfo = [];
        if ($result->num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {
                array_push($userInfo,$row);
            }            
        }
        return $userInfo;
    }

    public function getAllcountries(){
        $sql = "SELECT * FROM tbl_countries ORDER BY name ASC";
        $result = $this->conn->query($sql);
        $countryInfo = [];
        if ($result->num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {
                array_push($countryInfo,$row);
            }            
        }
        return $countryInfo;
    }

    public function getStatesByCountry($countryId){
        if(empty($countryId)){
            return false;
        }
        $sql = "SELECT * FROM tbl_states WHERE country_id = '".$countryId."' ORDER BY name ASC";
        $result = $this->conn->query($sql);
        $states = [];
        if ($result->num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {
                array_push($states,$row);
            }            
        }
        return $states;
    }
}
