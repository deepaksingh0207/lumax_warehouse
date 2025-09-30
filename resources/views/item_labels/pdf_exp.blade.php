<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Label - No Flex</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
        }

        .label-container {
            width: 350px; 
            padding: 15px;
            box-sizing: border-box; 
        }

        .label-container {
            position: relative; 
        }

        .export-box-wrapper {
            position: absolute;
            top: 0;
            right: 0;
            margin-top: 15px;
            margin-right: 15px;
        }

        .export-box {
            border: 1px solid #000;
            padding: 3px 25px;
            font-size: 14px;
            font-weight: bold;
            letter-spacing: 1px;
            line-height: 1;
        }

        
        .main-content {
            margin-top: 30px; 
            overflow: auto;
        }

        .qr-info {
            float: left;
            margin-right: 15px; 
            text-align: center;
        }

        .qr-code-placeholder {
            width: 80px;
            height: 80px;
        }
        
        .qr-code-placeholder img {
            display: block;
        }

        .product-details {
            overflow: hidden;
        }
        
        .product-details h1 {
            font-size: 20px;
            font-weight: bold;
            margin: 0 0 5px 0;
            line-height: 1.2;
        }

        .product-description {
            font-size: 14px;
            line-height: 1.2;
            margin-bottom: 0; 
        }
        
        .barcode-number {
            font-weight: bold;
            font-size: 14px;
            margin-top: 5px;
            display: block;
        }

        .bottom-row {
            clear: both;
            margin-top: 15px;
        }

        .quantity-date {
            margin-bottom: 2px;
            font-weight: bold;
            font-size: 16px;
        }

        .date-of-manufacture {
            font-weight: bold;
            font-size: 16px;
        }

        .quantity, .date-of-manufacture {
            font-family: Arial, sans-serif;
            white-space: nowrap;
        }
    </style>
</head>
<body>

<div class="label-container">
    
    <div class="export-box-wrapper">
        <div class="export-box">EXPORT ONLY</div>
    </div>
    
    <div class="main-content">
        <div class="qr-info">
            <div class="qr-code-placeholder">
                <img src="{{ $qr }}" style="width: 80px;">
            </div>
            <div class="barcode-number">
                ({{ ltrim($item_data->sap_code , '0') }})
            </div>
        </div>
        
        <div class="product-details">
            <h1>{{ $item_data->item_code }}</h1>
            <p class="product-description">
                {{ $item_data->description }}
            </p>
        </div>
    </div>
    
    <div class="bottom-row">
        <div class="quantity-date">
            <span class="quantity">Net Quantity : {{ $qty }} N</span>
        </div>
        <div class="date-of-manufacture">
            Month & Year of Manufacture : {{ date("M Y") }} 
        </div>
    </div>

</div>

</body>
</html>