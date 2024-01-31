<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;



class insertController{

    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function insertNews(Request $request, Response $response) {
        $data = $request->getParsedBody(); // Obtén los datos del cuerpo de la solicitud
        
        // Procesa y valida los datos (asegúrate de que sean seguros)
        $headline = isset($data['headline'])?$data['headline']:'';
        $lead = isset($data['lead'])?$data['lead']:'';
        $content = isset($data['content'])?$data['content']:'';
        $image_url=isset($data['image_url'])?$data['image_url']:'';
        $photo_src=isset($data['photo_src'])?$data['photo_src']:'';
        $id_author = isset($data['id_author'])?$data['id_author']:'';
        $id_source = isset($data['id_source'])?$data['id_source']:'';
        $id_category = isset($data['id_category'])?$data['id_category']:'';
        $type = isset($data['type'])?$data['type']:'';
        $url_new=isset($data['url_new'])?$data['url_new']:'';
        $relevance=isset($data['relevance'])?$data['relevance']:'';
        $ext=isset($data['ext'])?$data['ext']:'';
    
        // Se realiza la inserción en la base de datos
        
        $sql="INSERT INTO news (id_new, headline, lead_new,content,image_url, id_author, id_source, id_category, type_new, url_new) VALUES (NULL, :headline, :lead, :contentnew, :image_url, :id_author, :id_source, :id_category, :newType, :url_new)";
        $stmt= $this->db->prepare($sql);
        $stmt->bindParam(':headline', $headline);
        $stmt->bindParam(':lead', $lead);
        $stmt->bindParam(':contentnew', $content);
        $stmt->bindParam(':image_url', $image_url);
        $stmt->bindParam(':id_author', $id_author);
        $stmt->bindParam(':id_source', $id_source);
        $stmt->bindParam(':id_category', $id_category);
        $stmt->bindParam(':newType', $type);
        $stmt->bindParam(':url_new', $url_new);
        


        $stmt->execute();
    
    
        // Responde con un mensaje de éxito o error
        $respuesta = 'Nuevo Articulo insertado con exito';

        $response->getBody()->write(json_encode($respuesta));
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function insertAuthor(Request $request, Response $response){
        $data = $request->getParsedBody(); // Obtén los datos del cuerpo de la solicitud
        
        $authorName=$data['name_author'];

        $sql='INSERT INTO authors (id_author, name_author) VALUES (NULL,:name_author)';

        $stmt= $this->db->prepare($sql);
        $stmt->bindParam(':name_author', $authorName);

        $stmt->execute();

        // Responde con un mensaje de éxito o error
        $respuesta = 'Nuevo autor insertado con exito';

        $response->getBody()->write(json_encode($respuesta));
        return $response->withHeader('Content-Type', 'application/json');        

    }

    public function insertCategory(Request $request, Response $response){
        $data = $request->getParsedBody(); // Obtén los datos del cuerpo de la solicitud
        
        $categoryName=$data['name_category'];

        $sql='INSERT INTO categories (id_category, name_category) VALUES (NULL,:name_category)';

        $stmt= $this->db->prepare($sql);
        $stmt->bindParam(':name_category', $categoryName);

        $stmt->execute();

        // Responde con un mensaje de éxito o error
        $respuesta = 'Nueva categoria insertada con exito';

        $response->getBody()->write(json_encode($respuesta));
        return $response->withHeader('Content-Type', 'application/json');        

    }

    public function insertSource(Request $request, Response $response){
        $data = $request->getParsedBody(); // Obtén los datos del cuerpo de la solicitud
        
        $sourceName=$data['name_source'];

        $sql='INSERT INTO sources (id_source, name_source, linkurl) VALUES (NULL,:name_source,:url_source)';

        $stmt= $this->db->prepare($sql);
        $stmt->bindParam(':name_source', $sourceName);


        $stmt->execute();

        // Responde con un mensaje de éxito o error
        $respuesta = 'Nueva fuente insertada con exito';

        $response->getBody()->write(json_encode($respuesta));
        return $response->withHeader('Content-Type', 'application/json');        

    }

}



