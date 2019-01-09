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
        $this->titulo = 'Login';
    }

    public function index()
    {
        if (! $_POST) {

            echo $this->view->render('login/formulariologin',
                ['titulo' => $this->titulo]);

        } else {

            $user = strtolower($_POST['email']);
            $clave = $_POST['clave'];

            $clave = md5($clave);

            $usuario = new Usuario;

            $usuario->comprueba($user, $clave, 'email');

            if (Session::userIsLoggedIn()) {

                header('Location: /dash');

            } else {
                 if(Session::get('errorUser')) {

                    $error = Session::get('errorUser');
                    echo $this->view->render('login/formulariologin',
                            ['errorEmail' => $error,
                            'titulo' => $this->titulo]);
                    Session::destroy();

                } else if(Session::get('errorPass')) {

                    $error = Session::get('errorPass');
                    echo $this->view->render('login/formulariologin',
                            ['errorPass' => $error,
                            'titulo' => $this->titulo]);
                    Session::destroy();
                } else {
                     header('Location: /login');
                }
            }
        }
    }

    public function cerrarSesion()
    {
        Session::destroy();
        header('Location: /');
    }

}