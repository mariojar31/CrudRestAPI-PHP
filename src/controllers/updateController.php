<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;



class updateController{

    protected $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function updateNews1(Request $request, Response $response) {
        $data = $request->getParsedBody(); // Obtén los datos del cuerpo de la solicitud
        
        // Procesa y valida los datos
        $id_new= isset($data['id_new'])?$data['id_new']:'';
        $type = isset($data['type_new'])?$data['type_new']:'';
        $relevance=isset($data['relevance'])?$data['relevance']:'';
    
        // Se realiza la inserción en la base de datos
        
        $sql="UPDATE news.news SET type_new=:newType, relevance=:relevance WHERE (id_new = :id_new)";
        $stmt= $this->db->prepare($sql);

        $stmt->bindParam(':id_new', $id_new);
        $stmt->bindParam(':newType', $type);
        $stmt->bindParam(':relevance', $relevance);
        


        $stmt->execute();
    
    
        // Responde con un mensaje de éxito o error
        $respuesta = 'Noticia Actualizada';

        $response->getBody()->write(json_encode($respuesta));
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function updateNews(Request $request, Response $response) {
        $data = $request->getParsedBody(); // Obtén los datos del cuerpo de la solicitud
        
        // Procesa y valida los datos (asegúrate de que sean seguros)
        $id_new = isset($data['id_new'])?$data['id_new']:'';
        $date = isset($data['date_new'])?$data['date_new']:'';
        $headline = isset($data['headline'])?$data['headline']:'';
        $lead = isset($data['lead_new'])?$data['lead_new']:'';
        $content = isset($data['content'])?$data['content']:'';
        $image_url=isset($data['image_url'])?$data['image_url']:'';
        $photo_src=isset($data['photo_src'])?$data['photo_src']:'';
        $id_author = isset($data['id_author'])?$data['id_author']:'';
        $id_source = isset($data['id_source'])?$data['id_source']:'';
        $id_category = isset($data['id_category'])?$data['id_category']:'';
        $type = isset($data['type_new'])?$data['type_new']:'';
        $url_new=isset($data['url_new'])?$data['url_new']:'';
        $relevance=isset($data['relevance'])?$data['relevance']:'';
        $ext=isset($data['ext'])?$data['ext']:'';
        
        // Se realiza la inserción en la base de datos
        
        $sql="UPDATE news.news SET headline=:headline, lead_new=:lead_new, content=:contentnew,image_url=:image_url, photo_src=:photo_src, id_author=:id_author, id_source=:id_source, id_category=:id_category, type_new=:type_new, url_new=:url_new, relevance=:relevance, ext=:ext WHERE (id_new = :id_new)";
        $stmt= $this->db->prepare($sql);
        $stmt->bindParam(':id_new', $id_new);
        $stmt->bindParam(':headline', $headline);
        $stmt->bindParam(':lead_new', $lead);
        $stmt->bindParam(':contentnew', $content);
        $stmt->bindParam(':image_url', $image_url);
        $stmt->bindParam(':photo_src', $photo_src);
        $stmt->bindParam(':id_author', $id_author);
        $stmt->bindParam(':id_source', $id_source);
        $stmt->bindParam(':id_category', $id_category);
        $stmt->bindParam(':type_new', $type);
        $stmt->bindParam(':url_new', $url_new);
        $stmt->bindParam(':relevance', $relevance);
        $stmt->bindParam(':ext', $ext);
        


        $stmt->execute();
    
    
        // Responde con un mensaje de éxito o error
        $respuesta = 'Articulo editado con exito';

        $response->getBody()->write(json_encode($respuesta));
        return $response->withHeader('Content-Type', 'application/json');
    }


}
