<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 9/01/19
 * Time: 19:52
 */

namespace Mini\Controller;

use Mini\Core\Controller;
use Mini\Core\Session;

class DashController extends Controller
{
    private $titulo;

    public function __construct()
    {
        parent::__construct();
        $this->titulo = 'Dashboard';
    }

    public function index()
    {
        $user = Session::get()[0];
        echo $this->view->render('dash/index', ['user' => $user]);
    }

}