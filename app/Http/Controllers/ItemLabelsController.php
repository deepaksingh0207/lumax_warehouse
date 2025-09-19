<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemLabelsController extends Controller
{
    //
    public function index()
    {
        $session_data = session()->all();
        
        $items = Item::paginate(10);
        
        return view('item_labels/index' , compact('items'));
    }
}
