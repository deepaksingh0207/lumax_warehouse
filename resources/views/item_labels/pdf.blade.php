<!DOCTYPE html>
<html lang="en">
<style>
    .qr-row {
        width: 20%;
        text-align: right;
        margin-bottom: 10px;
    }

    .qr-code {
        display: inline-block;
        text-align: center;
    }

    body {
        font-family: "DejaVu Sans", sans-serif;
    }

    p,span,div {
        line-height: 1;
    }

    .label-container {
        white-space: nowrap;
        padding: 1rem;
    }

    .item-label {
        display: inline-block;
        box-sizing: border-box;
        vertical-align: top;
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Label</title>
</head>

<body>
    <div class="label-container">
        <div class="item-label" style="width: 50mm; height: 38mm;">
            <div class="qr-row" style="width: 60%; text-align: right; margin-bottom: -5px;">
                <span class="qr-code" style="display: inline-block; text-align: right;">
                    <img src="{{ $qr }}" style="width: 30px; height: auto; display: block; margin-left: auto;">
                    <br>
                    <span style="font-weight: 600; font-size: 5px; display: block; text-align: right; width: 100%; margin-top: 5px;">{{ ltrim($item_data->sap_code , '0') }}</span>
                </span>
            </div>

            <span>
                <span style="font-weight: 600;font-size : 5px">{{ $item_data->item_code }}</span><br>
                <span style="font-weight: 600;font-size : 5px">{{ $item_data->description }}</span>
            </span>
            <br>
            <span>
                <span style="font-weight: 700;font-size : 5px"><span style="margin-right:25px">MRP : {{ $item_data->mrp }}</span> (₹ {{ $item_data->mrp }} each) Inc. of all Taxes</span>
            </span>
            <br>
            <span>
                <span style="font-weight: 700;font-size : 5px">Net Quantity : {{ $item_data->std_qty }}</span>
                <span style="font-weight: 700;font-size : 5px;margin-left:5%">MFD : {{ date("M Y") }}</span>
            </span>
        </div>
        <div class="item-label" style="width: 50mm; height: 38mm; margin-left:50px">
            <div class="qr-row" style="width: 60%; text-align: right; margin-bottom: -5px;">
                <span class="qr-code" style="display: inline-block; text-align: right;">
                    <img src="{{ $qr }}" style="width: 30px; height: auto; display: block; margin-left: auto;">
                    <br>
                    <span style="font-weight: 600; font-size: 5px; display: block; text-align: right; width: 100%; margin-top: 5px;">{{ ltrim($item_data->sap_code , '0') }}</span>
                </span>
            </div>

            <span>
                <span style="font-weight: 600;font-size : 5px">{{ $item_data->item_code }}</span><br>
                <span style="font-weight: 600;font-size : 5px">{{ $item_data->description }}</span>
            </span>
            <br>
            <span>
                <span style="font-weight: 700;font-size : 5px"><span style="margin-right:25px">MRP : {{ $item_data->mrp }}</span> (₹ {{ $item_data->mrp }} each) Inc. of all Taxes</span>
            </span>
            <br>
            <span>
                <span style="font-weight: 700;font-size : 5px">Net Quantity : {{ $item_data->std_qty }}</span>
                <span style="font-weight: 700;font-size : 5px;margin-left:5%">MFD : {{ date("M Y") }}</span>
            </span>
        </div>
    </div>
</body>

</html>