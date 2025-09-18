<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemLabelsController extends Controller
{
    //
    public function index()
    {
        return view('item_labels/index');
    }
}
