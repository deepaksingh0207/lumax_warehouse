<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    protected $fillable = [
        'vendor_id',
        'vendor_sap_code',
        'sap_code',
        'item_code',
        'std_qty',
        'packing',
        'mrp',
        'uom',
        'description'
    ];
}
