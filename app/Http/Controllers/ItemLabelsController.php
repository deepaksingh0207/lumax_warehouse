<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ItemLabelsController extends Controller
{
    //
    public function index(Request $request)
    {
        $session_data = session()->all();
        $search_val = $request->input('search_val' , null);
        if(!empty($search_val)) {
            $items = Item::where('sap_code' , 'like' , "%$search_val%")
            ->orWhere('item_code' , 'like' , "%$search_val%")
            ->orWhere("description" , 'like' , "%$search_val%")
            ->paginate(10);
        }
        else {
            $items = Item::paginate(10);
        }

        if ($request->ajax()) {
            return view('item_labels.table', compact('items'))->render();
        }
        
        return view('item_labels/index' , compact('items'));
    }

    public function createPdf() {
        $qr = QrCode::size(50)->generate('https://example.com');
        $item_data = Item::where('id',1)->first();
        return view('item_labels/pdf', compact('qr','item_data'));
    }

    public function generate()
    {
        // Generate QR code as SVG
        $qr = QrCode::size(50)->generate('https://example.com');

        return view('item_labels/qr_show', compact('qr'));
    }
}
