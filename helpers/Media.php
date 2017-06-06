<?php

/**
 * Description of Media
 *
 * @author Radek
 */
class Media
{

    private $js = 'webroot/js';
    private $css = 'webroot/css';

    public function __construct()
    {
        ;
    }

    public function css($filename)
    {
        return "<link rel=\"stylesheet\" href=\"$this->css/$filename.css\"/>";
    }

    public function js($filename)
    {
        return "<script src=\"$this->js/$filename.js\"></script>";
    }
}
