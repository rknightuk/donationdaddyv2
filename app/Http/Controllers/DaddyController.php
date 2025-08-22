<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DaddyController extends Controller
{
     public function home()
     {
         return view('home');
     }

     public function coin()
     {
         return view('coin');
     }

     public function deskmat()
     {
         return view('deskmat');
     }

     public function treats()
     {
         return view('treats');
     }

     public function septembed()
     {
         return view('septembed');
     }

     public function bag()
     {
         return view('bag');
     }
}
