<?php
try{

    class db{
    
      private $dbHost;
      private $dbUser;
      private $dbPass;
      private $dbName;

      public function __construct()
      {
        $this->dbHost = $_ENV['DDBB_HOST'];
        $this->dbUser = $_ENV['DDBB_USER'];
        $this->dbPass = $_ENV['DDBB_PASSWORD'];
        $this->dbName = $_ENV['DDBB_NAME']; 
      }

      //conection 
      public function conectDB(){
        $mysqlConnect = "mysql:host=$this->dbHost;dbname=$this->dbName";
        $dbConnecion = new PDO($mysqlConnect, $this->dbUser, $this->dbPass);
        $dbConnecion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbConnecion;
      }
    }

    // $database = new db();

    // // Utilizar el método connect
    // $dbConnection = $database->conectDB();

  }catch(\Throwable $th){
    echo 'ERROR (file .env): '.$th->getMessage();
  }


