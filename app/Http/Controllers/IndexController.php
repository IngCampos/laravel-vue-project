<?php

namespace App\Http\Controllers;

use App\Advertisement;

class IndexController extends Controller
{
    public function index()
    {
        $adds = Advertisement::where(function ($query) {
            $query->whereDate('expiration', '>=', now())
              ->orWhere('expiration', '=', null);
          })->orderBy('order', 'asc')->get();
        return view('public.index', compact('adds'));
    }
}
