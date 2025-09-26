<!DOCTYPE html>
<html lang="en">

<style>
    @page {
        size: letter;
        margin: 0;
    }

    body {
        font-family: "Arial", sans-serif;
        margin: 0; /* also remove body margin */
        padding: 0; /* also remove body padding */
        width: '{{ $label_settings[0] }}mm'; 
        height: '{{ $label_settings[1] }}mm';
    }

    p, span, div {
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
        <div class="item-label">
            <div class="qr-row" style="width: 100%; text-align: right; margin-bottom: -5px;">
                <span class="qr-code" style="display: inline-block; text-align: right;">
                    <img src="{{ $qr }}" style="width: 20px; height: auto; display: block; margin-left: auto;">
                    <br>
                    <span style="font-size: 15px; display: block; text-align: right; width: 100%; margin-top: 5px;"><strong>{{ ltrim($item_data->sap_code , '0') }}</strong></span>
                </span>
            </div>

            <span>
                <span style="font-size : 25px"><strong>{{ $item_data->item_code }}</strong></span><br>
                <span style="font-size : 18px"><strong>{{ $item_data->description }}<strong></span>
            </span>
            <br>
            <br>
            <span>
                <span style="font-size : 22px"><strong><span style="margin-right:25px">MRP : <img src="{{ $rupee_icon }}" alt="" style="width:15px" >{{ $item_data->mrp }}</span> (<img src="{{ $rupee_icon }}" alt="" style="width:15px"> {{ $item_data->mrp }} each) Inc. of all Taxes</strong></span>
            </span>
            <br>
            <span>
                <span style="font-size : 21px"><strong>Net Quantity : {{ $item_data->std_qty }}</strong></span>
                <span style="font-size : 21px;margin-left:5%"><strong>MFD : {{ date("M Y") }}</strong></span>
            </span>
        </div>
    </div>
</body>

</html>