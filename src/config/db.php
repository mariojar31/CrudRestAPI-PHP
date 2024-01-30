<?php
try{

    class db{
    
      private $dbHost;
      private $dbUser;
      private $dbPass;
      private $dbName;

      public function __construct()
      {
        $this->dbHost = $_ENV['POSTGRES_HOST'];
        $this->dbUser = $_ENV['POSTGRES_USER'];
        $this->dbPass = $_ENV['POSTGRES_PASSWORD'];
        $this->dbName = $_ENV['POSTGRES_DATABASE']; 
      }

      //conection 
      public function conectDB(){
        $pgsqlConnect = "pgsql:host=$this->dbHost;port=5432;dbname=$this->dbName";
        $dbConnecion = new PDO($pgsqlConnect, $this->dbUser, $this->dbPass);
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


