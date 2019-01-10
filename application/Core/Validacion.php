<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 1/12/18
 * Time: 22:06
 */

namespace Mini\Core;

class Validacion
{

    private $errores_validacion = false;
    private $value = 'feedback_negative';
    private $form = 'form';

    public function validator($datos, $name, $long = 3, $tabla = 'post')
    {
        if ( empty($datos[$name]) || ! isset($datos[$name])) {
            Session::addAsoc($this->value, $name,'No he recibido ' . $name . ' de ' . $tabla);
            $this->errores_validacion  = true;
        } elseif (strlen($datos[$name]) < $long ) {
            Session::addAsoc($this->value, $name,'Campo ' . $name . ' demasiado corto');
            $this->errores_validacion  = true;
        } else {
            Session::set($this->form, $key = $datos[$name]);
            Session::vaciar($this->value, $name);
        }
    }

    public function validatorSelect($datos, $name, $tabla = 'post')
    {
        if ( empty($datos[$name]) || ! isset($datos[$name])) {
            Session::addAsoc($this->value, $name, 'No he recibido el ' . $name . ' de ' . $tabla);
            $this->errores_validacion = true;
        } else {
            Session::set($this->form, $key = $datos[$name]);
            Session::vaciar($this->value, $name);
        }
    }

    public function validatorPass($datos, $pass, $pass2, $tabla = 'usuario')
    {
        if ( empty($datos[$pass]) ) {
            Session::addAsoc('feedback_negative', $pass, 'No he recibido la clave del ' . $tabla);
            $this->errores_validacion = true;
        } elseif (strlen($datos[$pass]) < 6 ) {
            Session::addAsoc('feedback_negative', $pass,'La clave debe tener al menos, 6 caracteres');
            $this->errores_validacion = true;
        } elseif (!preg_match('`[a-z]`', $datos[$pass])){
            Session::addAsoc('feedback_negative', $pass,'La clave debe tener al menos una letra minúscula');
            $this->errores_validacion = true;
        } elseif (!preg_match('`[A-Z]`', $datos[$pass])){
            Session::addAsoc('feedback_negative', $pass,'La clave debe tener al menos una letra mayúscula');
            $this->errores_validacion = true;
        } elseif (!preg_match('`[0-9]`', $datos[$pass])){
            Session::addAsoc('feedback_negative', $pass,'La clave debe tener al menos un caracter numérico');
            $this->errores_validacion = true;
        } elseif ($datos[$pass] != $datos[$pass2]) {
            Session::addAsoc('feedback_negative', $pass,'Las claves tienen que ser iguales');
            $this->errores_validacion = true;
        } else {
            Session::vaciar($this->value, $pass);
        }
    }

    public function validarPost($datos)
    {
        Validacion::validator($datos, $name = 'titulo');
        Validacion::validator($datos, $name = 'slug');
        Validacion::validator($datos, $name = 'resumen');
        Validacion::validator($datos, $name = 'contenido');
        Validacion::validatorSelect($datos, $name = 'categoria_id');
        Validacion::validator($datos, $name = 'palabras');

        if ( $this->errores_validacion ) {
            return false;
        }

        return true;
    }
}