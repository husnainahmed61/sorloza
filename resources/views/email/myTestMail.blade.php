<!DOCTYPE html>
<html>
<head>
    <style>
        .page-break {
            page-break-after: always;
        }
        </style>
</head>
<body>
<img src='./images/{{ $img }}' width="100%" height="500"/>
<div class="page-break"></div>

<div style='margin: 1%;
            font-size:20px;
            font-family: "Futura";
            color: #434350;
            text-align: center'>
    <div style=" border-right: 2px solid #434350;margin: 1%; width: 60%;">
        <p>{{ $msg }}</p>
    </div>
    <div style="float: right;margin: 1%; width: 38%; ">
        <p>{{ $address }}</p>
    </div>
</div>





</body>
</html>
