<?php

class Redirect
{
    public static function to($route, $status = 302)
    {
        header("Location: {$route}", true, $status);
    }
}
