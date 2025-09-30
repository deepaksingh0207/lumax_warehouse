<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Barryvdh\Snappy\Facades\SnappyImage;

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

    public function createPdfOld(Request $request)
    {
        $item_id = $request->input('item_id',null);
        $print_qty = $request->input('print_qty',null);
        $label_type = $request->input('label_type',null);
        $label_profile = $request->input('label_profile',null);

        // dump([$item_id,$print_qty,$label_type,$label_profile]);

        if(!empty($item_id) && !empty($print_qty) && !empty($label_type) && !empty($label_profile)) {
            $label_settings = explode('_',$label_profile);

            $item_data = Item::where('id', $item_id)->first();
            
            $folderPath = public_path('assets/images/qr_code');
            
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0755, true);
            }
    
            $file_name = '/qr_code_'.$item_data->item_code.'_'.$item_data->vendor_sap_code.'.png';
    
            $filePath = $folderPath . '/'.$file_name;
    
            $qr = $filePath;

            $rupee_icon = public_path('assets/images/rupee.png');

            $qrCodeText = "Part No. ".$item_data->item_code.", MRP. Rs ".$item_data->mrp."/- ".$item_data->std_qty." Date - ".date('M Y');
    
            Builder::create()
            ->writer(new PngWriter())  // PNG output, no Imagick needed
            ->data($qrCodeText)
            ->size(200)
            ->margin(5)
            ->build()
            ->saveToFile($filePath);
    
            $data = [
                'qr' => $qr,
                'item_data' => $item_data,
                'label_settings' => $label_settings,
                'rupee_icon' => $rupee_icon,
            ];
    
            $numberOfPages = $print_qty; 
    
            $htmlContent = '';
            for ($i = 0; $i < $numberOfPages; $i++) {
                // Render the Blade view for a single page
                $htmlContent .= view('item_labels.pdf', $data)->render();
            }

            // dump($htmlContent);
            
            // Load the combined HTML content into the PDF
            // $pdf = Pdf::loadHtml($htmlContent);
    
            // // $pdf = Pdf::loadView('item_labels.pdf', $data);
            // // $paperSizeSetting = [0,0,100,75]; //Width , Height in mm
            // // $pdf->setPaper($paperSizeSetting);
    
            // $pdf->setPaper('letter', 'portrait');
            // // $pdf->set_option('dpi', 200);
            // $pdf->set_option('margin-top', 0);
            // $pdf->set_option('margin-bottom', 0);
            // $pdf->set_option('margin-left', 0);
            // $pdf->set_option('margin-right', 0);

            // // Build file path (example: storage/app/public/labels/label_123456789.pdf)
            // $fileName = "label_".$label_profile."_" . strtotime('now') . ".pdf";
            // $path = public_path("labels/" . $fileName);

            // // Save PDF to the path
            // $resp = $pdf->save($path);

            // // dump($resp);
            
            // return response()->json([
            //     'status' => 1,
            //     'label_url' => asset('labels/'.$fileName),
            //     'file_name' => $fileName,
            // ]);
            return view('item_labels/pdf', compact('qr','item_data','label_settings','rupee_icon'));
        }

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

    public function createPdf(Request $request) {
        $item_id = $request->input('item_id',null);
        $print_qty = $request->input('print_qty',null);
        $label_type = $request->input('label_type',null);
        $label_profile = $request->input('label_profile',null);

        // dump([$item_id,$print_qty,$label_type,$label_profile]);

        if(!empty($item_id) && !empty($print_qty) && !empty($label_type) && !empty($label_profile)) {

            $label_settings = explode('_',$label_profile);

            $item_data = Item::where('id', $item_id)->first();
            
            $folderPath = public_path('assets/images/qr_code');
            
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0755, true);
            }
    
            $file_name = '/qr_code_'.$item_data->item_code.'_'.$item_data->vendor_sap_code.'.png';
    
            $filePath = $folderPath . '/'.$file_name;

            $rupee_icon = asset('assets/images/rupee.png');

            $qrCodeText = "Part No. ".$item_data->item_code.", MRP. Rs ".$item_data->mrp."/- ".$item_data->std_qty." Date - ".date('M Y');
    
            Builder::create()
            ->writer(new PngWriter())  
            ->data($qrCodeText)
            ->size(200)
            ->margin(5)
            ->build()
            ->saveToFile($filePath);

            $qrBase64 = 'data:image/png;base64,' . base64_encode(file_get_contents($filePath));

            $qr = $qrBase64;
            
            unlink($filePath);

            $data = [
                'qr' => $qr,
                'item_data' => $item_data,
                'label_settings' => $label_settings,
                'rupee_icon' => $rupee_icon,
            ];

            $image = SnappyImage::loadView('item_labels.pdf', $data)
            ->setOption('width', 100)
            ->setOption('quality', 100);    
            
            $filename = 'generated-image-' . time() . '.jpg';
            $path = public_path('images/' . $filename);
            $image->save($path);
            unlink($path);

            $numberOfPages = $print_qty; 
    
            $htmlContent = '';
            for ($i = 0; $i < $numberOfPages; $i++) {
                $htmlContent .= view('item_labels.label', $data)->render();
            }

            $pdf = Pdf::loadHtml($htmlContent);
            $pdf->setPaper('letter', 'portrait');
            $fileName = "label_".$label_profile."_" . strtotime('now') . ".pdf";
            
            $pdfContent = $pdf->output();
            $encodedPdf = base64_encode($pdfContent);
    
            return response()->json([
                'message' => 'Image generated and saved successfully!',
                'encoded_pdf_data' => $encodedPdf,
                'status' => 1,
                'pdf_file_name' => $fileName,
            ]);

            // return view('item_labels.label', $data);
        }
    }
}
