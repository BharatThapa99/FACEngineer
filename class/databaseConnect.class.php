<?php
ini_set("display_errors","1");


class databaseConnect
{
    public $db;
    public $host;
    public $dbuser;
    public $dbpassword;
    public static $conn;

    public function __construct($db,$host,$dbuser,$dbpassword)
    {
        $this -> db = $db;
        $this -> host = $host;
        $this -> dbuser = $dbuser;
        $this -> dbpassword = $dbpassword;
    }
    public function connectDb()
    {
        try {
            self:: $conn = new mysqli($this->host, $this->dbuser, $this->dbpassword, $this->db);

        }
        catch (Exception $e)
        {
            echo $e -> getMessage();
        }
        catch (Error $e)
        {
            echo $e -> getMessage();
        }
    return self::$conn;
    }
}
