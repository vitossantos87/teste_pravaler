<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Session;
/*
 * função que coloca numa string todas as mensagens do validator
 */
Class Message{

    public static function show($errors){
        $retorno = "<ul>";
        foreach ($errors->all() as $error) {
            $retorno .= "<li> $error </li>";
        }
        $retorno .= "<ul>";
        return $retorno;
    }

    public static function setMessage($message, $type){
        switch ($type){
            case 'danger':
                $class = 'modal-danger';
                $titulo = "Error";
                break;
            case 'warning':
                $class = 'modal-warning';
                $titulo = "Attention";
                break;
            case 'success':
                $class = 'modal-success';
                $titulo = "Success";
                break;
            default :
                $class = 'modal-info';
                $titulo = "Information";
        }

        Session::flash('message', ['msg' => $message,
                                   'class' => $class,
                                   'title' => $titulo]);

    }

    public static function setAlert($message, $type){
        switch ($type){
            case 'danger':
                $class = 'alert-danger';
                $titulo = "Error";
                break;
            case 'warning':
                $class = 'alert-warning';
                $titulo = "Attention";
                break;
            case 'success':
                $class = 'alert-success';
                $titulo = "Success";
                break;
            default :
                $class = 'alert-info';
                $titulo = "Information";
        }

        Session::flash('alert', ['msg' => $message,
                                   'class' => $class,
                                   'title' => $titulo]);

    }
}
