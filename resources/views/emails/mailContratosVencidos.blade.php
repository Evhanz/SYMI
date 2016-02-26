<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Email- Contrato Vencido</title>
</head>
<body>

    <h1>Correo desde el sistema</h1>
    <hr>
    <span>Estos son los contratos por vencer en 5 dias</span>
    <table style="border:1px solid #ffffff;">
        <thead>
            <tr>
                <th style=" ilter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#0f9b9b', endColorstr='#0f9b9b');
                background: -o-linear-gradient(top,#0f9b9b,0f9b9b);background-color:#0f9b9b;border:0px solid #ffffff;
                text-align:center; border-width:0px 0px 1px 1px; font-size:14px; font-family:Verdana; font-weight:bold;
                color:#ffffff; ">Persona</th>
                <th style=" ilter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#0f9b9b', endColorstr='#0f9b9b');
                background: -o-linear-gradient(top,#0f9b9b,0f9b9b);background-color:#0f9b9b;border:0px solid #ffffff;
                text-align:center; border-width:0px 0px 1px 1px; font-size:14px; font-family:Verdana; font-weight:bold;
                color:#ffffff; ">DNI</th>
                <th style=" ilter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#0f9b9b', endColorstr='#0f9b9b');
                background: -o-linear-gradient(top,#0f9b9b,0f9b9b);background-color:#0f9b9b;border:0px solid #ffffff;
                text-align:center; border-width:0px 0px 1px 1px; font-size:14px; font-family:Verdana; font-weight:bold;
                color:#ffffff; ">Fechas de Contrato</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contratos as $contrato)
                <tr>
                    <td style="padding-left: 20px; padding-right: 20px;">{{$contrato->personal->fullname}}</td>
                    <td style="padding-left: 20px; padding-right: 20px;">{{$contrato->personal->dni}}</td>
                    <td style="padding-left: 20px; padding-right: 20px;">{{$contrato->f_inicio }} && {{$contrato->f_fin}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>
    <span style="font-style: italic">*Este correo es generado por el servidor, no responder por este medio  </span>

    <style>

        table{

            border:1px solid #ffffff;
            -moz-border-radius-bottomleft:9px;
            -webkit-border-bottom-left-radius:9px;
            border-bottom-left-radius:9px;
        }

        table tbody tr td{
            padding-left: 20px;
            padding-right: 20px;

        }

        table > thead > tr> th{


            filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#0f9b9b", endColorstr="#0f9b9b");
            background: -o-linear-gradient(top,#0f9b9b,0f9b9b);

            background-color:#0f9b9b;
            border:0px solid #ffffff;
            text-align:center;
            border-width:0px 0px 1px 1px;
            font-size:14px;
            font-family:Verdana;
            font-weight:bold;
            color:#ffffff;

        }

    </style>
</body>
</html>