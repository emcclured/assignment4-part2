<?php

class videoDB extends mysqli {

    // single instance of self shared among all instances
    private static $instance = null;
    // db connection config vars
    private $user = "mcclured-db";
    private $pass = "qG1qjsUCfJ8XKsOO";
    private $dbName = "mcclured-db";
    private $dbHost = "oniddb.cws.oregonstate.edu";

    //This method must be static, and must return an instance of the object if the object
    //does not already exist.
    public static function getInstance() {
        if (!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    // The clone and wakeup methods prevents external instantiation of copies of the Singleton class,
    // thus eliminating the possibility of duplicate objects.
    public function __clone() {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }

    public function __wakeup() {
        trigger_error('Deserializing is not allowed.', E_USER_ERROR);
    }

    // private constructor
    private function __construct() {
        parent::__construct($this->dbHost, $this->user, $this->pass, $this->dbName);
        if (mysqli_connect_error()) {
            exit('Connect Error (' . mysqli_connect_errno() . ') '
                    . mysqli_connect_error());
        }
        parent::set_charset('utf-8');
    }

    public function get_videos() {
        return $this->query("SELECT id, name, category, length, rented FROM videos");
    }

    function insert_video($name, $category, $length, $rented) {
        $this->query("INSERT INTO videos (name, category, length, rented)" . 
                " VALUES ('" 
                . $name . 
                "', '" 
                . $category . 
                "', "
                . $length . 
                ", " 
                . $rented . 
                ")");
    }

    public function update_video($id, $name, $category, $length, $rented) {
        $this->query("UPDATE videos SET name = '" 
                . $name . 
                "', category = '" 
                . $category . 
                "', length = " 
                . $length . 
                ", rented = " 
                . $rented . 
                ", WHERE id = " 
                . $id);
    }
    
    public function toggle_checkout($id) {
    	$this->query ("UPDATE videos SET rented = NOT rented WHERE id = " . $id);
    }

    public function get_video_with_id($id) {
        return $this->query("SELECT id, name, category, length, rented FROM videos WHERE id = " . $id);
    }

    public function delete_video_with_id($id) {
        $this->query("DELETE FROM videos WHERE id = " . $id);
    }
    
    public function delete_all_videos() {
    	$this->query("DELETE * FROM videos");
    }

}

?>