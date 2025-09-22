<!DOCTYPE html>
<html lang="en">
<style>
    .qr-row {
        display: flex;
        justify-content: flex-end;
        width: 30%;
    }

    /* Updated CSS for the qr-code container */
    .qr-code {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
    }

    body {
        font-family: "Arial", sans-serif;
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Label</title>
</head>

<body>
    <div class="container">
        <div class="qr-row">
            <div class="qr-code">
                {!! $qr !!}
                <br>
                <span style="font-weight: 600;font-size : 20px">{{ ltrim($item_data->sap_code , '0') }}</span>
            </div>
        </div>
        <div>
            <span style="font-weight: 600;font-size : 24px">{{ $item_data->item_code }}</span><br>
            <span style="font-weight: 600;font-size : 24px">{{ $item_data->description }}</span>
        </div>

        <div  style="margin-top: 2%;">
            <span style="font-weight: 700;font-size : 24px"><span>MRP : {{ $item_data->mrp }}</span> (₹ {{ $item_data->mrp }} each) Inc. of all Taxes</span>
        </div>
        <div>
            <span style="font-weight: 700;font-size : 24px">Net Quantity : {{ $item_data->std_qty }}</span>
            <span style="font-weight: 700;font-size : 24px;margin-left:5%">MFD : {{ date("M Y") }}</span>
        </div>
    </div>
</body>

</html>