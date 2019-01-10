<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 10/01/19
 * Time: 19:15
 */

namespace Mini\Controller;

use Mini\Core\Controller;
use Mini\Model\Post;
use Mini\Model\Categoria;
use Mini\Core\Session;

class PostController extends Controller
{
    public function index()
    {
        $posts = new Post();
        $posts = $posts->listado();

        foreach ($posts as $post) {
            $categoria[] = Categoria::buscar($post->categoria_id);
        }

        echo $this->view->render('posts/list',
                ['posts' => $posts,
                'categorias' => $categoria]);
    }

    public function crear()
    {
        if (!$_POST) {
            echo $this->view->render('posts/crear');
        } else {

            $fecha = date('Y-m-d');
            $slug = str_replace(" ", "_", $_POST['titulo']);

            $datos = array("titulo" => filter_var(trim(strtolower($_POST['titulo'])), FILTER_SANITIZE_STRING),
                "slug" => $slug,
                "resumen" => filter_var(trim(strtolower($_POST['resumen'])), FILTER_SANITIZE_STRING),
                "contenido" => filter_var(trim(strtolower($_POST['contenido'])), FILTER_SANITIZE_STRING),
                "categoria_id" => filter_var(trim(strtolower($_POST['categoria_id'])), FILTER_SANITIZE_STRING),
                "palabras" => filter_var(trim(strtolower($_POST['palabras'])), FILTER_SANITIZE_STRING),
                "privado" => $_POST['privado'],
                "fecha_alta" => $fecha
            );

            $post = new Post;

            $errores = [];

            if ($post->insertar($datos)) {

                echo $this->view->render('posts/postinsertado');

            } else {
                if (!is_null(Session::get('feedback_negative')) ) {
                    $errores = Session::get('feedback_negative');
                }
                echo $this->view->render('posts/crear', [
                    'errores' => $errores,
                    'datos' => $datos
                ]);
            }
        }
    }

    public function editar($id)
    {
        if (Session::userIsLoggedIn()) {

            if(!$id) {
                header('Location: /productos/listar');
            }

            $datos = Post::buscar($id);

            if ($datos) {

                $datos = $datos[0];

                $datos = ['id' => $datos->id, 'titulo' => $datos->titulo, 'slug' => $datos->slug,
                    'resumen' => $datos->resumen, 'contenido' => $datos->contenido, 'categoria_id' => $datos->categoria_id,
                    'palabras' => $datos->palabras,'privado' => $datos->privado, 'fecha' => $datos->fecha,
                ];

                if (! $_POST) {

                    $this->view->addData(['titulo' => 'Modificar Producto']);
                    echo $this->view->render('posts/crear', [
                        'datos' => $datos,
                        'title' => 'Modificar'
                    ]);

                } else {

                    $datos = ['id' => $datos['id'], 'titulo' => $_POST['titulo'], 'slug' => str_replace(" ", "_", $_POST['titulo']),
                        'resumen' => $_POST['resumen'], 'contenido' => $_POST['contenido'], 'categoria_id' => $_POST['categoria_id'],
                        'palabras' => $_POST['palabras'],'privado' => $_POST['privado']
                    ];

                    $errores = [];

                    $post = new Post;

                    if ($post->editar($datos)) {
                        echo $this->view->render('posts/postinsertado');
                    } else {
                        if (!is_null(Session::get('feedback_negative')) ) {
                            $errores = Session::get('feedback_negative');
                        }
                        $this->view->addData(['titulo' => 'Modificar Producto']);
                        echo $this->view->render('posts/crear', [
                            'datos' => $datos,
                            'errores' => $errores,
                            'title' => 'Modificar'
                        ]);
                    }

                }

            } else {
                header('Location:' . URL . ' /posts/list');
            }

        } else {
            header('Location:' . URL . ' /login');
        }
    }
}