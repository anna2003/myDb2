<?php
use DI\Container;

//$url=$_SERVER['REQUEST_URI'];
//$route = [];
//switch($url){
//    case "/":
//        $route = ['App\controllers\PostController', 'index'];
//        break;
//    case "/about":
//        $route = ['PostController', 'about'];
//        break;
//}
//if(empty($route)){
//    echo "404 error";
//    exit;
//} else {
//    call_user_func($route);
//}

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', ["App\controllers\PostController", 'index']);
    // {id} must be a number (\d+)
//    $r->addRoute('GET', '/user/{id:\d+}', 'get_user_handler');
//    // The /{title} suffix is optional
//    $r->addRoute('GET', '/articles/{id:\d+}[/{title}]', 'get_article_handler');
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo "404 Not Found";
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        echo "405 Method Not Allowed";
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        (new Container())->call($handler, $vars);

//        $container = new Container();
//        $container->call($handler, $vars);

//        $conn = $container->make('App\QueryHelper', [
//            'config' => $config,
//        ]);
//        $container->call([new $handler[0]($conn), $handler[1]], $vars);
//        $container->call([new $handler[0](['config'=>$config]), $handler[1]], $vars);
//        call_user_func($handler);
        break;
}