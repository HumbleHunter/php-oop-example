<?php

/**
 * Description of Controller
 *
 * @author ubuntu
 */
class Controller
{

    private $controller;
    private static $helperslist = [
        'Media'
    ];
    public $variables = [];
    public $helpers;

    public function __construct($controller)
    {
        $this->controller = $controller;
        $this->loadHelpers();
    }

    public function render($filename)
    {
        $filename = strtolower($filename);
        require_once "view/$this->controller/$filename.php";
    }

    public function loadHelpers()
    {
        foreach (self::$helperslist as $helper) {
            require_once "helpers/$helper.php";
            $this->helpers[$helper] = new $helper;
        }
    }

    public function sendToView($variable, $name)
    {        
        $this->variables[$name] = $variable;
    }
    
    public function getPost($var){
        return htmlspecialchars($_POST[$var]);
    }
}
