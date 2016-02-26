<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>

<table id="tableReport" class="table table-bordered table-responsive">

    <thead>
    <tr>
        <th  colspan="2">Número</th>
        <th >Mes</th>
        <th  >Resultado</th>
    </tr>
    </thead>

    <tbody>

    @foreach($proformas as $item)
        <tr >
            <td>{{  $item->numero }}</td>
            <td >
                <table>
                    <tr>
                        &nbsp;
                    </tr>
                    <tr>
                        <td>%</td>
                    </tr>
                    <tr>
                        <td>H/H</td>
                    </tr>
                </table>
            </td>
            <td>
                <table class="table table-bordered">
                    <tr>
                        @foreach($item->avance_tareo as $i)
                        <td  >
                            {{ $i->avance_ref }}
                        </td>
                        @endforeach
                    </tr>
                    <tr>
                        @foreach($item->avance_tareo as $i)
                            <td  >
                                {{ $i->ht }}
                            </td>
                        @endforeach
                    </tr>
                </table>
            </td>
            <td >

            </td>
        </tr>

    @endforeach


    </tbody>


</table>

</body>
</html>