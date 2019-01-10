<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 8/01/19
 * Time: 21:30
 */

namespace Mini\Model;

use Mini\Core\Database;
use Mini\Core\Validacion;

class Post
{
    public function listado()
    {
        $conn = Database::getInstance()->getDatabase();
        $ssql = "SELECT * FROM posts";
        $query = $conn->prepare($ssql);
        $query->execute();
        return $query->fetchAll();
    }

    public static function buscar($value, $param = 'id')
    {
        $conn = Database::getInstance()->getDatabase();
        $ssql = "SELECT * FROM posts WHERE " . $param . " = '" . $value . "'";
        $query = $conn->prepare($ssql);
        $query->execute();
        return $query->fetchAll();
    }

    public function insertar($datos)
    {
        $conn = Database::getInstance()->getDatabase();

        $validacion = new Validacion;

        if($validacion->validarPost($datos)) {

            $params = [
                'titulo' => $datos['titulo'],
                'slug' => $datos['slug'],
                'resumen' => $datos['resumen'],
                'contenido' => $datos['contenido'],
                'categoria_id' => $datos['categoria_id'],
                'palabras' => $datos['palabras'],
                'privado' => $datos['privado'],
                'fecha' => $datos['fecha_alta']
            ];

            $fields = '(' . implode(',', array_keys($params)) . ')';

            $values = "(:" . implode(",:", array_keys($params)) . ")";

            $ssql = 'INSERT INTO posts ' . $fields . ' VALUES ' . $values;
            $query = $conn->prepare($ssql);
            $query->execute($params);
            $cuenta = $query->rowCount();

            if ($cuenta == 1) {
                return $conn->lastInsertId();
            }

            return false;
        }

        return false;
    }

    public static function editar($datos)
    {

        $conn = Database::getInstance()->getDatabase();

        $validacion = new Validacion;

        if($validacion->validarPost($datos)) {

            $datos['id'] = (int) $datos['id'];
            $ssql = "UPDATE posts SET titulo='" . $datos['titulo'] . "', slug='" .
                $datos['slug'] . "', resumen='" . $datos['resumen'] . "', contenido='" . $datos['contenido'] .
                "', categoria_id='" .  $datos['categoria_id'] . "', palabras='" . $datos['palabras'] .
                "', privado='" . $datos['privado'] . "' WHERE id=" . $datos['id'];
            $query = $conn->prepare($ssql);
            $params = [
                ':id'	  => $datos['id'],
                'titulo' => $datos['titulo'],
                ':slug' => str_replace(" ", "_", $datos['titulo']),
                'resumen' => $datos['resumen'],
                'contenido' => $datos['contenido'],
                'categoria_id' => $datos['categoria_id'],
                'palabras' => $datos['palabras'],
                'privado' => $datos['privado']
            ];

            $query->execute($params);
            $count = $query->rowCount();

            if ($count == 1) {
                return true;
            }
            echo 'nop';
            return false;
        }

    }
}