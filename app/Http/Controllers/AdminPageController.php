<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminPageController extends Controller
{

    // Toutes led fonctions sont protégées pas is_admin
    // Il faut donc être conneté avec un admin pour y accéder
    public function __construct()
    {
        $this->middleware('is_admin');
    }
}
