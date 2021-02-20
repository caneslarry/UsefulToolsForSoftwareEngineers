<?php
/**
 * Class FooController
 */
class FooController {
    /**
     * FooController constructor.
     */
    public function __construct() {}

    /**
     * barAction - Sample controller action.
     * Called from browser like this
     * ~/Foo/bar
     */
    public function barAction() {
        echo 'Foo bard';
    }
}

$defaultController = "home";
$defaultAction = "index";

// Split the URI to get parts for Controller and Action
$parts = parse_url($_SERVER['REQUEST_URI']);
$routeParts = explode("/", $parts['path']);

if (!empty($routeParts)) {

    $controller = (count($routeParts) > 1) ? $routeParts[1] : $defaultController; // 2nd element will be the controller name
    $action = (count($routeParts) > 2) ? $routeParts[2] : $defaultAction; // 3rd element will be the action name

    $controllerClass = empty($controller) ? $defaultController : ucfirst($controller) . "Controller";
    $actionFunction = empty($action) ? $defaultAction : strtolower($action) . "Action";
    try {
        if (class_exists($controllerClass)) {
            $object = new $controllerClass;
        } else {
            throw new Exception("Class " . $controllerClass . " does not exist.");
        }
        if (method_exists($object, $actionFunction)) {
            echo $object->$actionFunction();
        } else {
            throw new Exception("Function $controllerClass->" . $actionFunction . "() does not exist.");
        }
    }catch(Exception $e){
        echo "<<<<<<<<<<<<<<<<<<<<<<< Error >>>>>>>>>>>>>>>>>>>>>>><br>";
        echo print_r($e, true);
    }
}