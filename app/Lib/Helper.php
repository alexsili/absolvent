<?php

namespace App\Lib;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class Helper
{
    public static function getUserAction(): string
    {
        $currentAction = Route::currentRouteAction();

        if (!$currentAction) {
            return request()->ip().' '.'running phpArtisanImport';
        }

        list($controller, $methode) = explode('@', $currentAction);

        $controller = preg_replace('/.*\\\/', '', $controller);

        if (Auth::user() && Auth::user()->id !== '') {
            return Auth::user()->id.' '.request()->ip().' '.$controller.'@'.$methode;
        } else {
            return request()->ip().' '.$controller.'@'.$methode;
        }
    }
}