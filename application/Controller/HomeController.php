<?php

namespace Mini\Controller;

use Mini\Core\Controller;
use Mini\Model\Categoria;
use Mini\Model\Post;

class HomeController extends Controller
{

    public function index()
    {

        $posts = new Post();
        $posts = $posts->listado();

        foreach ($posts as $post) {
            $categoria[] = Categoria::buscar($post->categoria_id);
        }

        echo $this->view->render('home/index',
                ['posts' => $posts,
                'categorias' => $categoria]);

    }

    public function ver($id)
    {
        $post = new Post();
        $post = $post->buscar($id);

        $categoria[] = Categoria::buscar($post[0]->categoria_id);

        if($post[0]->privado) {

            echo $this->view->render('home/producto');

        } else {
            echo $this->view->render('home/producto',
                ['post' => $post[0],
                    'categoria' => $categoria[0]
                ]);
        }

    }
}
