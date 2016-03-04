@extends('layout')

@section('content-header')

    <div style="padding-left:5px;">
        <div class="bs-callout bs-callout-info" id="callout-type-dl-truncate">
            <h4>Bienvenidos</h4>
        </div>
    </div>

@stop
@section('content')

<div ng-app="app" ng-controller="MainController">
    <div class="content">

        <div class="row">
            <div class="col-lg-6">
                <!-- Box (with bar chart) -->
                <div class="box box-primary" >
                    <div class="box-header">
                        <!-- tools box -->
                        <div class="pull-right box-tools">
                            <button class="btn btn-danger btn-sm refresh-btn" ng-click="recargar_chart_ganancia()" data-toggle="tooltip" title="Reload"><i class="fa fa-refresh"></i></button>
                            <button class="btn btn-danger btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-danger btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                        </div><!-- /. tools -->
                        <i class="fa fa-cloud"></i>

                        <h3 class="box-title">Reporte de mayor ganancia </h3>
                    </div><!-- /.box-header -->
                    <div class="box-body ">

                        <div class="row" >
                            <div class="col-lg-2">
                                <h5>Fechas</h5>
                            </div>
                            <div class="col-lg-4">
                                <input class="form-control" type="date" id="f_ini_mayor_ganancia">
                            </div>
                            <div class="col-lg-4">
                                <input class="form-control" type="date" id="f_fin_mayor_ganancia">
                            </div>
                            <div class="col-lg-2">
                                <button class="btn btn-info" ng-click="getDataProformChartArea()"><i class="fa fa-search-minus"></i></button>
                            </div>
                        </div>

                        <div class="row" style="padding: 15px;">
                            <div id="canvas-holder" class="col-lg-12">
                                <canvas id="chart-area" width="300" height="300"/>
                            </div>

                            <div id="canvas-bar" class="col-lg-12">
                                <canvas id="chart-bar-ganancia" width="300" height="300"/>
                            </div>

                        </div><!-- /.row - inside box -->
                    </div><!-- /.box-body -->
                    <div class="box-footer">

                    </div><!-- /.box-footer -->
                </div><!-- /.box -->

            </div>
            <div class="col-lg-6">
                <div class="box box-danger" >
                    <div class="box-header">
                        <!-- tools box -->
                        <div class="pull-right box-tools">
                            <button ng-click="recargar_chart_consumo()" class="btn btn-danger btn-sm refresh-btn" data-toggle="tooltip" title="Reload"><i class="fa fa-refresh"></i></button>
                            <button class="btn btn-danger btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-danger btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                        </div><!-- /. tools -->
                        <i class="fa fa-cloud"></i>

                        <h3 class="box-title">Costo generado RRHH</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body ">

                        <div class="row" >
                            <div class="col-lg-2">
                                <h5>Fechas</h5>
                            </div>
                            <div class="col-lg-4">
                                <input class="form-control" type="date" id="f_ini_mayor_consumo">
                            </div>
                            <div class="col-lg-4">
                                <input class="form-control" type="date" id="f_fin_mayor_consumo">
                            </div>
                            <div class="col-lg-2">
                                <button class="btn btn-info" ng-click="getDataConsumoChartArea()"><i class="fa fa-search-minus"></i></button>
                            </div>
                        </div>

                        <div class="row" style="padding: 15px;">
                            <div id="canvas-area-consumo" class="col-lg-12">
                                <canvas id="chart-area-consumo" width="300" height="300"/>
                            </div>

                            <div id="canvas-bar-consumo" class="col-lg-12">
                                <canvas id="chart-bar-consumo" width="300" height="300"/>
                            </div>

                        </div><!-- /.row - inside box -->
                    </div><!-- /.box-body -->
                    <div class="box-footer">

                    </div><!-- /.box-footer -->
                </div><!-- /.box -->
            </div>

        </div>

    </div>

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
    </h4>
    <br>

    <div class="ui grid" >
        <br>
        <h2>Codigo de barras de las ultimas compras hechas </h2>
        <div class="sixteen wide colum" data-styl="table">
            <div id="myfirstchart" style="height: 250px;"></div>
        </div>
    </div>

</div>






<script src="{{ asset('componentes/chartjs/Chart.js')}}"></script>

<script>




    var app = angular.module("app", []);
    app.controller("MainController", function($scope,$http,$window) {

        /*traemos toda la data de las proformas*/

        $scope.data_proform_chat=[];
        $scope.data_proform_for_fechas =[];

        $scope.data_proform_consumo=[];
        $scope.data_proform_for_fechas_consumo =[];

        var chartProformGanancia;

        $("#chart-bar-ganancia").hide();
        $("#chart-bar-consumo").hide();



        //getDataProformChartArea();



        $scope.recargar_chart_ganancia = function(){


            $scope.getDataProformChartArea();
            $("#chart-bar-ganancia").hide();
            $("#canvas-holder").show();

        };

        $scope.recargar_chart_consumo = function () {
            $scope.getDataConsumoChartArea();
            $("#chart-bar-consumo").hide();
            $("#canvas-area-consumo").show();

        };

        $scope.getDataConsumoChartArea = function(){




            /*limpiamos el canvas*/

            resetCanvas('chart-area-consumo','canvas-area-consumo');


            /*traemos los datos de los inputs*/

            var f_ini = $('#f_ini_mayor_consumo').val();
            //f_ini = f_ini.split('-');
            var f_fin = $('#f_fin_mayor_consumo').val();
            //f_fin = f_fin.split('-')




            $scope.data_proform_consumo=[];
            $scope.data_proform_for_fechas_consumo =[];

            $.get('http://localhost:200/SYMI/public/proformas/getCostoOfAreaByFechas/'+f_ini+'/'+f_fin, function (data) {
                $scope.data_proform_for_fechas_consumo = data;


                console.log(data);

                var bandera = 0;
                data.forEach(function(item){

                    var color =0;
                    switch (bandera){

                        case 0: color = '#F7464A';
                            break;
                        case 1: color = '#46BFBD';
                            break;
                        case 2: color = '#FDB45C';
                            break;
                        case 3: color = '#949FB1';
                            break;
                        case 4: color = '#4D5360';
                            break;
                        case 5: color = '#F7462A';
                            break;
                    }

                    var suma = 0;

                    /*sumamos la cantiad consumida de toda el area*/
                    item.proformas.forEach(function (i) {
                       suma+= i.producto;
                    });


                    var obj = {value: suma,
                        color:color,
                        highlight: "#FF5A5E",
                        label: item.descripcion};


                    $scope.data_proform_consumo.push(obj);

                    bandera ++;

                });

                var ctx = document.getElementById("chart-area-consumo").getContext("2d");
                chartProformGanancia= new Chart(ctx).PolarArea($scope.data_proform_consumo, {
                    responsive:true
                });

                document.getElementById("chart-area-consumo").onclick = function(evt){
                    var activePoints = chartProformGanancia.getSegmentsAtEvent(evt);

                    getDetailConsumo(activePoints[0].label);

                    // => activePoints is an array of segments on the canvas that are at the same position as the click event.
                };





            });

        };


        $scope.getDataProformChartArea = function (){

            /*limpiamos el canvas*/

            resetCanvas('chart-area','canvas-holder');

            /*traemos los datos de los inputs*/

            var f_ini = $('#f_ini_mayor_ganancia').val();
            //f_ini = f_ini.split('-');
            var f_fin = $('#f_fin_mayor_ganancia').val();
            //f_fin = f_fin.split('-')




            $scope.data_proforma_for_fechas=[];
            $scope.data_proform_chat=[];

            $.get('http://localhost:200/SYMI/public/proformas/getCostoOfAreaByFechas/'+f_ini+'/'+f_fin, function (data) {
                $scope.data_proforma_for_fechas = data;


                console.log(data);

                var bandera = 0;
                data.forEach(function(item){

                    var color =0;
                    switch (bandera){

                        case 0: color = '#F7464A';
                            break;
                        case 1: color = '#46BFBD';
                            break;
                        case 2: color = '#FDB45C';
                            break;
                        case 3: color = '#949FB1';
                            break;
                        case 4: color = '#4D5360';
                            break;
                        case 5: color = '#F7464A';
                            break;
                    }


                    var obj = {value: item.total,
                        color:color,
                        highlight: "#FF5A5E",
                        label: item.descripcion};

                    $scope.data_proform_chat.push(obj);

                    bandera ++;

                });

                var ctx = document.getElementById("chart-area").getContext("2d");
                chartProformGanancia= new Chart(ctx).PolarArea($scope.data_proform_chat, {
                    responsive:true
                });

                document.getElementById("chart-area").onclick = function(evt){
                    var activePoints = chartProformGanancia.getSegmentsAtEvent(evt);

                    console.log(activePoints[0].label);

                    getProformByDeTailGananciaReal(activePoints[0].label);
                    // => activePoints is an array of segments on the canvas that are at the same position as the click event.
                };





            });


        };


        function getProformByDeTailGananciaReal(descripcion){
            /*primero limpiamos el camvas*/

            resetCanvas('chart-bar-ganancia','canvas-bar');




            var area = [];

            var labels_proformas = [];
            var resultado = [];

            $scope.data_proforma_for_fechas.forEach(function(item){

                if(item.descripcion == descripcion)
                        area = item;

            });



            area.proformas.forEach(function(item){

                labels_proformas.push( item.numero);
            });

            area.proformas.forEach(function(item){

                resultado.push( item.res_real);
            });


            var data = {
                labels: labels_proformas,
                datasets: [
                    {
                        label: "My First dataset",
                        fillColor: "rgba(31,167,181,0.5)",
                        strokeColor: "rgba(31,167,181,0.8)",
                        highlightFill: "rgba(31,167,181,0.75)",
                        highlightStroke: "rgba(31,167,181,1)",
                        data: resultado
                    }
                ]
            };


            var ctx = document.getElementById("chart-bar-ganancia").getContext("2d");
            chartProformGanancia= new Chart(ctx).Bar(data, {
                responsive:true
            });


            $("#chart-bar-ganancia").show();
            $("#canvas-holder").hide();


        }


        function getDetailConsumo(descripcion){
            /*primero limpiamos el camvas*/

            resetCanvas('chart-bar-consumo','canvas-bar-consumo');




            var area = [];

            var labels_proformas = [];
            var resultado = [];

            $scope.data_proform_for_fechas_consumo.forEach(function(item){

                if(item.descripcion == descripcion)
                    area = item;

            });

            area.proformas.forEach(function(item){

                labels_proformas.push( item.numero);
            });

            area.proformas.forEach(function(item){

                resultado.push( item.producto);
            });


            var data = {
                labels: labels_proformas,
                datasets: [
                    {
                        label: "My First dataset",
                        fillColor: "rgba(31,167,181,0.5)",
                        strokeColor: "rgba(31,167,181,0.8)",
                        highlightFill: "rgba(31,167,181,0.75)",
                        highlightStroke: "rgba(31,167,181,1)",
                        data: resultado
                    }
                ]
            };


            var ctx = document.getElementById("chart-bar-consumo").getContext("2d");
            chartProformGanancia= new Chart(ctx).Bar(data, {
                responsive:true
            });


            $("#chart-bar-ganancia").show();
            $("#canvas-area-consumo").hide();


        }


        var resetCanvas = function(canvas,origin){
            $('#'+canvas).remove(); // this is my <canvas> element
            $('#'+origin).append('<canvas width="300" height="300" id="'+canvas+'"><canvas>');

        };










    });

    /*

    $(document).ready(
            function () {

                var ctx = document.getElementById("myChart").getContext("2d");
                var myNewChart = new Chart(ctx).Pie(data);


                $("#canvas-holder").click(
                        function(evt){
                            var activePoints = myNewChart.getSegmentsAtEvent(evt);
                            var url = "http://example.com/?label=" + activePoints[0].label + "&value=" + activePoints[0].value;
                            alert(url);
                        }
                );
            }
    );*/
</script>

@stop