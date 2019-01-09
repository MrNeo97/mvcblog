<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 8/01/19
 * Time: 21:27
 */

namespace Mini\Controller;

use Mini\Core\Controller;
use Mini\Model\Usuario;
use Mini\Core\Session;

class LoginController extends Controller
{
    private $titulo;

    public function __construct()
    {
        parent::__construct();
        $this->titulo = 'Productos';
    }

    public function index()
    {
        if (! $_POST) {

            echo $this->view->render('login/formulariologin');
        }
    }


}