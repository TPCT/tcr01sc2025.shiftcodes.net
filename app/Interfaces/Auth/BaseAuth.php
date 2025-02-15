<?php 

namespace App\Interfaces\Auth;

interface BaseAuth
{
    public function check();
    public function login();
}