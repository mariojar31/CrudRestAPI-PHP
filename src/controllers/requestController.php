<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;



class requestController{

    protected $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function getNews(Request $request, Response $response){
        $data = obtenerDatosDesdeLaBaseDeDatos($this->db,1); // Implementa esta función

        $response->getBody()->write(json_encode($data));
        
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function getNewByID(Request $request, Response $response){
        $idNew=$request->getAttribute('id');
        $data = obtenerDatosDesdeLaBaseDeDatos($this->db,8,$idNew); 

        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type','application/json');
    }

    public function getAuthors(Request $request, Response $response){
        $data = obtenerDatosDesdeLaBaseDeDatos($this->db,2); // Implementa esta función

        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function getSources(Request $request, Response $response){
        $data = obtenerDatosDesdeLaBaseDeDatos($this->db,3); // Implementa esta función

        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function getCategories(Request $request, Response $response){
        $data = obtenerDatosDesdeLaBaseDeDatos($this->db,4); // Implementa esta función

        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function getAuthorNews(Request $request, Response $response){
        $idAuthor=$request->getAttribute('author');
        $data = obtenerDatosDesdeLaBaseDeDatos($this->db,5,$idAuthor); // Implementa esta función

        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function getCategoryNews(Request $request, Response $response){
        $idCategory=$request->getAttribute('category');
        $data = obtenerDatosDesdeLaBaseDeDatos($this->db,6,$idCategory); // Implementa esta función

        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function getSourceNews(Request $request, Response $response){
        $idSource=$request->getAttribute('source');
        $data = obtenerDatosDesdeLaBaseDeDatos($this->db,7,$idSource); // Implementa esta función

        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json');
    }

}

function obtenerDatosDesdeLaBaseDeDatos($db,$requestType,$id=null) {
    
    /**
    * Esta función realiza las consultas a la base de datos y devuelve un objeto con el resultado de la consulta.
    *
    *
    * @param database-conection $db conexión a la base de datos.
    * @param int $requestType recibe numero (entero) correspondiente al tipo de consulta que se realizará: 
    *              1 consulta lista de noticias
    *              2 consulta lista de autores
    *              3 consulta lista de fuentes
    *              4 consulta lista de categorias
    *              5 consulta noticias por id de autor
    *              6 consulta noticias por id de categoría
    *              7 consulta noticias por id de fuentes 
    *              8 consulta noticias por id 
    * @param int $id (Opcional) recibe el Id relacionado a la consulta (idAuthor, idSource, idCategory)
    * @return object resultado de la consulta.
    *
    */
   
       if($requestType===1){
   
           $stmt = $db->query('SELECT * FROM news');
   
           if($stmt->rowCount()>0){
               $datos = ['News'=>$stmt->fetchAll(PDO::FETCH_ASSOC)];
           }else{
               $datos= 'Sin noticias en la BD';
           }
   
       }elseif($requestType===2){
           $stmt = $db->query('SELECT * FROM authors');
   
           if($stmt->rowCount()>0){
               $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
           }else{
               $datos= 'Sin autores en la BD';
           }        
       }elseif($requestType===3){
           $stmt = $db->query('SELECT * FROM sources');
   
           if($stmt->rowCount()>0){
               $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
           }else{
               $datos= 'Sin fuentes en la BD';
           }        
       }elseif($requestType===4){
           $stmt = $db->query('SELECT * FROM categories');
   
           if($stmt->rowCount()>0){
               $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
           }else{
               $datos= 'Sin categorias en la BD';
           }        
       }elseif($requestType===5){
   
           $stmt = $db->query("SELECT * FROM news WHERE id_author=$id");
   
           if($stmt->rowCount()>0){
               $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
           }else{
               $datos= 'No existen noticias relacianadas a este autor';
           }
   
       }elseif($requestType===6){
           $stmt = $db->query("SELECT * FROM news WHERE id_category=$id");
   
           if($stmt->rowCount()>0){
               $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
           }else{
               $datos= 'No existen noticias relacianadas a esta categoria';
           }
       }elseif($requestType===7){
           $stmt = $db->query("SELECT * FROM news WHERE id_source=$id");
   
           if($stmt->rowCount()>0){
               $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
           }else{
               $datos= 'No existen noticias relacianadas a esta fuente';
           }
       }elseif($requestType===8){
        $stmt = $db->query("SELECT * FROM news WHERE id_new=$id");

        if($stmt->rowCount()>0){
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $datos= 'No existen noticias relacianadas a este ID';
        }
    }
       
       
       return $datos;
   }