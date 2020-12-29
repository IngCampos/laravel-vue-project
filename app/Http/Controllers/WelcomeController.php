<?php

namespace App\Http\Controllers;

use App\Advertisement;

class WelcomeController extends Controller
{
    public function index()
    {
        $adds = Advertisement::where(function ($query) {
            $query->whereDate('expiration', '>=', now())
              ->orWhere('expiration', '=', null);
          })->orderBy('order', 'asc')->get();
        return view('welcome', compact('adds'));
    }
}
