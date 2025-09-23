<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;

class ItemLabelsController extends Controller
{
    //
    public function index(Request $request)
    {
        $session_data = session()->all();
        $search_val = $request->input('search_val', null);
        if (!empty($search_val)) {
            $items = Item::where('sap_code', 'like', "%$search_val%")
                ->orWhere('item_code', 'like', "%$search_val%")
                ->orWhere("description", 'like', "%$search_val%")
                ->paginate(10);
        } else {
            $items = Item::paginate(10);
        }

        if ($request->ajax()) {
            return view('item_labels.table', compact('items'))->render();
        }

        return view('item_labels/index', compact('items'));
    }

    public function createPdf()
    {
        $item_data = Item::where('id', 1)->first();
        $folderPath = public_path('assets/images/qr_code');
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0755, true);
        }

        $file_name = '/qr_code_'.$item_data->item_code.'_'.$item_data->vendor_sap_code.'.png';

        $filePath = $folderPath . '/'.$file_name;

        $qr = $filePath;

        Builder::create()
        ->writer(new PngWriter())  // PNG output, no Imagick needed
        ->data('https://example.com')
        ->size(200)
        ->margin(5)
        ->build()
        ->saveToFile($filePath);

        $data = [
            'qr' => $qr,
            'item_data' => $item_data,
        ];

        $numberOfPages = 3; 

        $htmlContent = '';
        for ($i = 0; $i < $numberOfPages; $i++) {
            // Render the Blade view for a single page
            $htmlContent .= view('item_labels.pdf', $data)->render();
        }
        
        // Load the combined HTML content into the PDF
        $pdf = Pdf::loadHtml($htmlContent);

        // $pdf = Pdf::loadView('item_labels.pdf', $data);
        // $paperSizeSetting = [0,0,100,75]; //Width , Height in mm
        // $pdf->setPaper($paperSizeSetting);

        $pdf->setPaper('letter', 'portrait');
        // $pdf->set_option('dpi', 200);
        $pdf->set_option('margin-top', 0);
        $pdf->set_option('margin-bottom', 0);
        $pdf->set_option('margin-left', 0);
        $pdf->set_option('margin-right', 0);
        return $pdf->download("label_" . strtotime('now') . ".pdf");
        // return view('item_labels/pdf', compact('qr','item_data'));
    }

    public function generate()
    {
        $folderPath = public_path('assets/images/qr_code');
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0755, true);
        }

        $filePath = $folderPath . '/my_qrcode.png';

        Builder::create()
            ->writer(new PngWriter())  // PNG output, no Imagick needed
            ->data('https://example.com')
            ->size(300)
            ->margin(10)
            ->build()
            ->saveToFile($filePath);

        return 'QR code saved successfully!';
    }
}
