<?php

trait Jeyroik_Role
{
    public static function getRole()
    {
        if(!isset($_SESSION['role']))
            $_SESSION['role'] = 'Guest';

        self::$role = $_SESSION['role'];// get from the session or something else
    }
}
