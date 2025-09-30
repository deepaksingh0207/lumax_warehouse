<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        @page {
            size: letter;
            margin: 0;
        }

        body {
            margin: 0;
            padding: 0;
        }

        img {
            margin: 0;
            padding: 0;
            width: <?= $label_settings[0] ?>mm;
            height: <?= $label_settings[1] ?>mm;
            display: inline-block;
            vertical-align: top;
        }
        
    </style>
</head>

<body>
    @for ($i = 0; $i < $label_settings[2]; $i++)
        <img src="{{ $image_path }}">
    @endfor
</body>

</html>