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
            $categoria[] = Categoria::buscar('id', $post->categoria_id);
        }

        echo $this->view->render('/home/index',
                ['posts' => $posts,
                'categorias' => $categoria]);
    }
}
