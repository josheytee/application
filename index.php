<?php
require_once './vendor/autoload.php';

//$kernel = new app\core\Kernel();
//
//$request = new app\core\Request();
//
//$response = $kernel->handle($request->create("/hello"));
//
//$response->send();
//
//$c = new app\core\Component();
//$c->render();

header("HTTP/1.1 404 Not Found");
header("refresh:5;url=test.php;");
//header("REQUEST_METHOD" . ":" . "POST");
//$_SERVER['REQUEST_METHOD'] = 'POST';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    header('HTTP_USER_AGENT : Symfony/2.X');
    header('Content-Type : text/x-json');
}
echo json_encode(headers_list());
echo json_encode($_SERVER);
?>
<form method="POST" action="">
    <input type="text">
    <input type="submit" value="he">
</form>
<?php


