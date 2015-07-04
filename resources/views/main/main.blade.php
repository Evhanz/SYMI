@extends('layout')

@section('content')

<div class="sixteen wide colum" id="header">

    <span class="text-titulo"> Bienvenido: </span>
			<span class="avatar"><i style="font-size:15px;"> < </i>
			<img src="{{ asset('img/128.jpg')}}" alt="">

			</span>
</div>



<h4 class="ui horizontal header divider">
    <i class="bar chart icon"></i>
    Datos De ultima
</h4>

<div class="ui grid" data-styl="block-seccion">
    <div class="eight wide column" data-styl="table">


        <h3>Aca va la tabla de Nuevos Requerimientos</h3>
        <table class="ui table" id="tableReq">
            <thead >
            <tr>
                <th>Name</th>
                <th>Registration Date</th>
                <th>E-mail address</th>
                <th>Premium Plan</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>John Lilki</td>
                <td>September 14, 2013</td>
                <td>jhlilk22@yahoo.com</td>
                <td>No</td>
            </tr>
            <tr>
                <td>Jamie Harington</td>
                <td>January 11, 2014</td>
                <td>jamieharingonton@yahoo.com</td>
                <td>Yes</td>
            </tr>
            <tr>
                <td>Jill Lewis</td>
                <td>May 11, 2014</td>
                <td>jilsewris22@yahoo.com</td>
                <td>Yes</td>
            </tr>
            </tbody>
        </table>



    </div>
    <div class="eight wide column" data-styl="table">
        <h3>Aca va la tabla de ultimos traslados de productos</h3>
        <table class="ui table" id="tabla-mov-pro">
            <thead >
            <tr>
                <th>Name</th>
                <th>Registration Date</th>
                <th>E-mail address</th>
                <th>Premium Plan</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>John Lilki</td>
                <td>September 14, 2013</td>
                <td>jhlilk22@yahoo.com</td>
                <td>No</td>
            </tr>
            <tr>
                <td>Jamie Harington</td>
                <td>January 11, 2014</td>
                <td>jamieharingonton@yahoo.com</td>
                <td>Yes</td>
            </tr>
            <tr>
                <td>Jill Lewis</td>
                <td>May 11, 2014</td>
                <td>jilsewris22@yahoo.com</td>
                <td>Yes</td>
            </tr>
            </tbody>
        </table>
    </div>

</div>

<h4 class="ui horizontal header divider">
    <i class="bar chart icon"></i>
    Form Barras
</h4><
<br>

<div class="ui grid" >
    <br>
    <h2>Codigo de barras de las ultimas compras hechas </h2>
    <div class="sixteen wide colum" data-styl="table">
        <div id="myfirstchart" style="height: 250px;"></div>
    </div>
</div>


@stop