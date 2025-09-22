<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    //
    public function index(Request $request)
    {
        $users = User::orderBy('id', 'desc')->paginate(10);
        if ($request->ajax()) {
            return view('dashboard.table', compact('users'))->render();
        }
        return view('dashboard/index' , compact('users'));
    }

    public function importUser(Request $request) 
    {   
        $request->validate([
            'import_file' => 'required|mimes:csv,txt|max:2048',
        ]);

        $file = $request->file('import_file');

        $handle = fopen($file, 'r');
        $header = fgetcsv($handle);

        $inserted = 0;
        $skipped = 0;

        $vendor_group_id = Group::where('name','Vendor')->value('id');

        while (($row = fgetcsv($handle)) !== false) {
            $data = array_combine($header, $row);

            if(
                !empty($data['SAP CODE']) && 
                !empty($data['Name']) && 
                !empty($data['Email'])
            ) {
                User::create([
                    'sap_code' => $data['SAP CODE'],
                    'name' => $data['Name'],
                    'email' => $data['Email'],
                    'mobile' => $data['Mobile'] ?? '',
                    'password' => Hash::make($data['password']),
                    'group_id' => $vendor_group_id,
                ]);
                $inserted++;
            }
            else {
                $skipped++;
            }
        }

        fclose($handle);

        return response()->json([
            'success' => true,
            'inserted' => $inserted,
            'skipped' => $skipped,
            'message' => "CSV import completed. Inserted: $inserted, Skipped: $skipped"
        ]);
    }
}
