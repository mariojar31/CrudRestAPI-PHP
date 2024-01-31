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
    $app->group('/news', function (RouteCollectorProxy $group) use ($db) {
    
    $requestController = new requestController($db);

    //RUTAS GET
    
    $group->get('/list-news', [$requestController, 'getNews']);
    $group->get('/getnews/id-{id}',[$requestController, 'getNewByID']);
    $group->get('/list-authors', [$requestController, 'getAuthors']);
    $group->get('/list-sources', [$requestController, 'getSources']);
    $group->get('/list-categories', [$requestController, 'getCategories']);
    $group->get('/list-news/aut-{author}', [$requestController, 'getAuthorNews']);
    $group->get('/list-news/cat-{category}', [$requestController, 'getCategoryNews']); 
    $group->get('/list-news/sr-{source}', [$requestController, 'getSourceNews']); 


    //RUTAS POST 
    $insertController = new insertController($db);
    
    $group->post('/add-news', [$insertController, 'insertNews']);
    $group->post('/add-author', [$insertController, 'insertAuthor']);
    $group->post('/add-source', [$insertController, 'insertSource']);
    $group->post('/add-category', [$insertController, 'insertCategory']);


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

$app->get('/', function (Request $request, Response $response){
    $response->getBody()->write('<div style="            margin: 50px 0 0 0;
    padding: 0;
    width: 100%;
    text-align: center;
    color: #aaa;
    font-size: 18px;">
    <h1 style=" text-align: center;           
    color: #719e40;
    letter-spacing: -3px;
    font-size: 100px;
    font-weight: 200;
    margin-bottom: 0;">RestAPI - CRUD</h1>
    <div>A Slim framework Rest API that allows us to make queries to an SQL database.</div>
    <br>
    <h2>This is an API test page.</h2>
    <br>
    <h4>Try the following urls complements to interact with the API:</h4>
    <ul>
        <li>View News List: "/news/list-news"</li>
        <li>View News for Id: "/news/getnews/id-{id} example ".../news/getnews/id-1"</li>
        <li>View Authors List: "/news/list-authors"</li>
        <li>View Categories List: "/news/list-categories"</li>
    </ul>

    <h4>For POST request you can use any ApiTester like Postman and try making the following requests: </h4>

    <img src="https://i.ibb.co/6y1wkTJ/Captura-de-pantalla-2024-01-30-201237.png" style="width: 70%" alt="Example of POST Request in Postman">

    <ul>
        <li><h3>Add News:</h3> 
            <p> Url Request :".../news/add-news"</p>
            <p> form-items : headline, lead, content, id_author, id_source, id_category</p>
        </li>
        <li><h3>Add New Author:</h3> 
            <p> Url Request :".../news/add-author"</p>
            <p> form-items : name_author</p>
        </li>
        <li><h3>Add New Category: </h3>
            <p> Url Request :".../news/add-category"</p>
            <p> form-items : name_category</p>
        </li>
        <li><h3>Add New Source: </h3>
            <p> Url Request :".../news/add-source"</p>
            <p> form-items : name_source</p>
        </li>
    </ul>   

    <br>
    <div style="background-color: #719e40; height: 100px;">
    <p style="padding: 20px; color:white;">2024 &copy; <a href="https://github.com/mariojar31">Mario Acendra</a></p>
    </div>
</div>');
    return $response->withHeader('Content-Type', 'text/html;charset=utf-8');
}); }
catch(\Throwable $th){
    echo 'Error: '.$th->getMessage();
}