<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Routing\RouteCollectorProxy;


require __DIR__.'/../controllers/insertController.php';
require __DIR__.'/../controllers/requestController.php';
require __DIR__.'/../controllers/updateController.php';


$db=new db();
$db=$db->conectDB();


try{
    $app->group('/api', function (RouteCollectorProxy $group) use ($db) {
    
    $requestController = new requestController($db);

    //RUTAS GET
    
    $group->get('/news', [$requestController, 'getNews']);
    $group->get('/news/id-{id}',[$requestController, 'getNewByID']);
    $group->get('/authors', [$requestController, 'getAuthors']);
    $group->get('/sources', [$requestController, 'getSources']);
    $group->get('/categories', [$requestController, 'getCategories']);
    $group->get('/news/aut-{author}', [$requestController, 'getAuthorNews']);
    $group->get('/news/cat-{category}', [$requestController, 'getCategoryNews']); 
    $group->get('/news/sr-{source}', [$requestController, 'getSourceNews']); 


    //RUTAS POST 
    $insertController = new insertController($db);
    
    $group->post('/newinsert', [$insertController, 'insertNews']);
    $group->post('/authorinsert', [$insertController, 'insertAuthor']);
    $group->post('/sourceinsert', [$insertController, 'insertSource']);
    $group->post('/categoryinsert', [$insertController, 'insertCategory']);


    //RUTAS UPDATE
    $updateController = new updateController($db);

    $group->post('/update/1', [$updateController, 'updateNews1']);
    $group->post('/update/news', [$updateController, 'updateNews']);

    
    


    
});


$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");
    return $response;
}); 

$app->get('/', function (Request $request, Response $response) use($db){
    return $response->getBody()->write('Esta es una pagina de prueba.. La API se encuentra funcionando correctamente.');
}); }
catch(\Throwable $th){
    echo 'Error: '.$th->getMessage();
}