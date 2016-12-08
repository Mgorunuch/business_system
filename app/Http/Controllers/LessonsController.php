<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LessonsController extends Controller
{
    public function index() {
        return view('dashboard.lessons.index');
    }
}
