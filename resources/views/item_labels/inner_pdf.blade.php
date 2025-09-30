<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Label</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
        }

        .label-container {
            width: 320px; 
            padding: 10px;
            box-sizing: border-box; 
            position: relative; 
            font-size: 14px;
        }
       
        .top-right-number {
            position: absolute;
            top: 10px;
            right: 10px;
            font-weight: bold;
            font-size: 14px;
        }
       
        .main-content {
            margin-top: 25px; 
            overflow: auto;
        }

        .qr-info {
            float: left;
            margin-right: 10px;
        }

        .qr-code-placeholder {
            width: 70px;
            height: 70px;
        }

        .qr-code-placeholder img {
            width: 70px;
            height: 70px;
            display: block;
        }

        .product-details {
            overflow: hidden; 
        }

        .product-details h1 {
            font-size: 20px;
            font-weight: bold;
            margin: 0 0 2px 0;
            line-height: 1.2;
        }

        .product-description {
            font-size: 15px;
            font-weight: bold;
            line-height: 1.2;
            margin: 0;
        }

        .product-description .mpfi {
            font-size: 14px;
            font-weight: bold;
        }
        
        .mrp-row {
            clear: both;
            margin-top: 15px;
            line-height: 1.2;
        }

        .mrp-left {
            font-size: 16px;
            font-weight: bold;
            float: left; 
        }

        .mrp-right {
            font-size: 13px;
            font-weight: bold;
            float: right; 
            white-space: nowrap; 
        }
        
        .quantity-row {
            clear: both;
            padding-top: 5px;
            text-align: right; 
            font-size: 16px;
            font-weight: bold;
        }

        .net-quantity {
            float: left;
        }

        .mfd-date {
            display: inline-block; 
        }
    </style>
</head>
<body>

<div class="label-container">
    
    <div class="top-right-number">{{ ltrim($item_data->sap_code , '0') }}</div>
    
    <div class="main-content">
        <div class="qr-info">
            <div class="qr-code-placeholder">
                <img src="{{ $qr }}" alt="QR Code"> 
            </div>
        </div>
        
        <div class="product-details">
            <h1>{{ $item_data->item_code }}</h1>
            <p class="product-description">
                {{ $item_data->description }}
            </p>
        </div>
    </div>
    
    <div class="mrp-row">
        <span class="mrp-left">MRP : ₹{{ $item_data->mrp *  $qty}}</span>
        <span class="mrp-right">(₹{{ $item_data->mrp }} each ) Inc. of all Taxes</span>
    </div>
    
    <div class="quantity-row">
        <span class="net-quantity">Net Quantity : {{ $qty }} N</span>
        <span class="mfd-date">MFD : {{ date("M Y") }}</span>
    </div>

</div>

</body>
</html>