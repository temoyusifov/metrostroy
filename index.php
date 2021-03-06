<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


// Назначаем модуль и действие по умолчанию.
$class = 'home';
$method = 'main';
// Массив параметров из URI запроса.
$params = array();

// Если запрошен любой URI, отличный от корня сайта.
if ($_SERVER['REQUEST_URI'] != '/') {
    try {
        // Для того, что бы через виртуальные адреса можно было также передавать параметры
        // через QUERY_STRING (т.е. через "знак вопроса" - ?param=value),
        // необходимо получить компонент пути - path без QUERY_STRING.
        // Данные, переданные через QUERY_STRING, также как и раньше будут содержаться в
        // суперглобальных массивах $_GET и $_REQUEST.
        $url_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Разбиваем виртуальный URL по символу "/"
        $uri_parts = explode('/', trim($url_path, ' /'));


        // Если количество частей не кратно 2, значит, в URL присутствует ошибка и такой URL
        // обрабатывать не нужно - кидаем исключение, что бы назначить в блоке catch модуль и действие,
        // отвечающие за показ 404 страницы.
        if (count($uri_parts) % 2) {
            throw new Exception();
        }

        $class = array_shift($uri_parts); // Получили имя модуля
        $method = array_shift($uri_parts); // Получили имя действия

        // Получили в $params параметры запроса
        for ($i=0; $i < count($uri_parts); $i++) {
            $params[$uri_parts[$i]] = $uri_parts[++$i];
        }
    } catch (Exception $e) {
        $class = 'Page404';
        $method = 'main';
    }
}

//echo "Class: $class <br />";
//echo "Method: $method<br />";
print_r($params);


// HERE HAPPEN CALLING CLASS AND METHOD

$file_path = $_SERVER['DOCUMENT_ROOT']."/controllers/".$class."Controller.php";

if(file_exists($file_path)){
    include './controllers/'.$class.'Controller.php';
    $object = new $class;
    $object->$method();
}else{
    echo "<div style='display: block; width: 50%; border: 1px solid #f7dbdb; padding: 10px; margin: 0 auto; text-align: center; border-radius:6px;'>Page not found. </div><br />";
    exit;
}
