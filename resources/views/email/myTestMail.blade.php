<!DOCTYPE html>
<html>
<head>
    <style>
        .page-break {
            page-break-after: always;
        }
        .vl {
            border-left: 2px solid #434350;
            height: 520px;
            position: absolute;
            left: 50%;
            margin-left: -3px;
            top: 0;
        }
        .ptag{
            margin: 0px;
            padding: 0px;
        }
        </style>
</head>
<body>

<img src='./images/{{ $img }}' width="100%" height="530"/>
<br>
<br>
<img src="./images/logoDos.png" width="30px"  height="30px" style="float: right"/>
<div class="page-break"></div>

<div style='margin: 1%;
            font-size:22px;
            font-family: "Futura";
            color: #434350;'>
    <div style="width: 48%; text-align: left">
        <div style="padding: 1%; margin:1%;">
            {!! $msg !!}
        </div>

    </div>
    <div style="float: right;margin: 1%; width: 35%; text-align: right">
        <img src="./images/logoDos.png" width="30px"  height="30px" style="float: right"/>
        <br>
        <p class="ptag">{{$recipientName}}</p>
        <p class="ptag">{{ $address }}</p>
        <p class="ptag">{{ $city }}</p>
        <p class="ptag">{{ $country }}</p>
    </div>
</div>
<div class="vl"></div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<img src="./images/logoUno.png" style="float: left; margin-left:39%; width:22%"/>
</body>
</html>
