
<?php

    class BaseClass {
        public $name = "<h1 style='text-align:center; margin:2rem 0;'> Using MySql Database </h1> <br>";
        function __construct() {
            // echo $this->name;
        }
        
        // public function connectName()
        // {
    
        //     $name = 'Using MySql Database \n';
        //     echo $name;
        // }
    }
    class ConnectDb extends BaseClass {
    
        function __construct() {
            parent::__construct();
        }

        

       //Debug mode
        // private $server = 'localhost';
        // private $dbName = 'testing';
        // private $password = '1234';
        // private $username = 'root';

        //Remote or production mode
        
        private $server = 'remotemysql.com';
        private $dbName = '1Li4NKeArq';
        private $password = 'Y9KYNbMVyy';
        private $username = '1Li4NKeArq';

        public function connect(){

            try{

                $conn = new PDO('mysql:host=' .$this->server .';dbname=' . $this->dbName, $this->username, $this->password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $conn;
            } catch (\Exception $e) {
                echo "Database Error: " . $e->getMessage();
            }
        }
    }
    $check = new ConnectDb();
    $check->connectName();

?>
