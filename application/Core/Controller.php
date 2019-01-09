<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 22/11/18
 * Time: 17:08
 */

namespace Mini\Core;

class Controller
{
    protected $view;

    public function __construct()
    {
        $this->view = TemplatesFactory::templates();
        Session::init();
    }
}