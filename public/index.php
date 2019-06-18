<?php
if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}


require __DIR__ . '/../vendor/autoload.php';

session_start();

// Instantiate the app
$settings = require __DIR__ . '/../src/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
$dependencies = require __DIR__ . '/../src/dependencies.php';
$dependencies($app);

// Register middleware
$middleware = require __DIR__ . '/../src/middleware.php';
$middleware($app);

// Register routes
$routes = require __DIR__ . '/../src/routes.php';
$routes($app);

$data_member= json_decode(file_get_contents('data/profile_member.json'), true);

$app->post("/", function ($storeUrl) use ($router) {
       if($_POST['username'] == $data_member['username'] && $_POST['password'] ==  $data_member['password'] ){
            $data = array('username' => $_POST['username'], 'password' => $_POST['password'] ,'status' => 'correct' ,'data_member' => $data_member['username'] ,'status' => $data_member['username']);
            echo json_encode($data);   
            $_SESSION['username'] = $_POST['username'];
       }else{
            $data = array('username' => $_POST['username'], 'password' => $_POST['password'] ,'status' => 'not correct');
            echo json_encode($data);
       }
});

$app->get('/profile/{id}', function ($request, $response, $id) {
    return $response->write($id);
});
// Run app
$app->run();
