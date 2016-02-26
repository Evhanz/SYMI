@extends('layout')


@section('content-header')


    <div style="padding-left:5px;">
        <div class="bs-callout bs-callout-info" id="callout-type-dl-truncate">
            <h4>Módulo del Reportes - Reporte por persona</h4>
        </div>
    </div>

@stop

@section('content')

    <div class="content" ng-app="app" ng-controller="MainController">
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-danger" >
                    <div class="box-header">
                        <!-- tools box -->
                        <div class="pull-right box-tools">
                            <button class="btn btn-danger btn-sm refresh-btn" data-toggle="tooltip" title="Reload"><i class="fa fa-refresh"></i></button>
                        </div><!-- /. tools -->
                        <i class="fa fa-cloud"></i>

                        <h3 class="box-title">Reporte de proformas </h3>
                    </div><!-- /.box-header -->
                    <div class="box-body no-padding">

                        <div class="row">
                            <div class="col-lg-12">
                                <form class="form-inline" ng-submit="getData()">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <div class="form-group">
                                        <label for="exampleInputName2">Fecha Inicio</label>
                                        <input ng-model="f_ini" type="date" class="form-control" name="txtFecha_i" >
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName2">Fecha Fin</label>
                                        <input ng-model="f_fin" type="date" class="form-control" name="txtFecha_f" >
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail2">Area</label><br>
                                        <select class="form-control" ng-model="area" name="area" id="">
                                            <option value="">-</option>
                                            <option value="1">GOLD MILL</option>
                                            <option value="3"> YANACOCHA NORTE</option>
                                            <option value="4"> LA QUINUA </option>
                                            <option value="13">MANTENIMIENTO BOMBAS</option>
                                            <option value="14">PROYECTO</option>

                                        </select>
                                    </div>
                                    <button class="btn btn-success" >Buscar</button>
                                </form>
                            </div>
                        </div>

                        <h3>Detalle de Proformas</h3>
                        <hr>

                        <div class="row">

                            <div class="col-lg-6">

                                <table id="tableReport" class="table table-bordered table-responsive">

                                    <thead>
                                    <tr>
                                        <th  colspan="2">Número</th>
                                        <th >Mes</th>
                                        <th  >Resultado</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr ng-repeat="proforma in proformas">
                                        <td>@{{proforma.numero}}</td>
                                        <td style=" padding-top: 45px;">
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
                                                    <td ng-repeat="dias in cabecera_dias" class="tbl_detail">@{{ dias }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td  ng-repeat="avance in proforma.avance_tareo">

                                                        <span ng-show="avance.avance_real > 0">@{{ avance.avance_real }}%</span>
                                                        <span ng-hide="avance.avance_real > 0">-</span>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td  ng-repeat="avance in proforma.avance_tareo">
                                                        @{{ avance.ht }}
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td style=" padding-top: 65px;">

                                            <span ng-show="proforma.mayor == 100">Terminada 100%</span>
                                            <span ng-hide="proforma.mayor == 100">Total: @{{ proforma.mayor }}%</span>
                                            <br>
                                            @{{ proforma.suma }}
                                        </td>
                                    </tr>

                                    </tbody>


                                </table>


                            </div>

                        </div>





                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <div  id="paginador">

                        </div>
                    </div><!-- /.box-footer -->
                </div><!-- /.box -->
            </div>
        </div>
    </div><!-- /.content-->

    <style>

        #tableReport{

        }

        #tableReport thead tr{
            background-color: #1f88be;

        }
        #tableReport thead tr th {
            color: white;
        }

        .tbl_detail{
            background-color: #7B7C86;
            color: white;
        }



    </style>


    <script>
        var app = angular.module("app", []);
        app.controller("MainController", function($scope,$http,$window) {


            $scope.proformas = [{}];
            $scope.cabecera_dias = [];

            var token = '{{ csrf_token() }}';

            $scope.getData = function (){

                var fecha_ini = new Date($scope.f_ini);
                var fecha_fin = new Date($scope.f_fin);

                var Dif= fecha_fin.getTime() - fecha_ini.getTime();
                var dias= Math.floor(Dif/(1000*24*60*60));

                $scope.cant_dias = dias;

                $scope.cabecera_dias = cabeceraDayTable(dias);


                $http.post('{{ URL::route('getReportAdminByProforms') }}',
                        { _token : token,
                            area: $scope.area,
                            fecha_ini:$scope.f_ini,
                            fecha_fin:$scope.f_fin })
                        .success(function(data){

                            $scope.proformas = data;

                            angular.forEach($scope.proformas,function(item){

                                item.suma = suma_ht(item.avance_tareo);
                                item.mayor = mayor(item.avance_tareo);

                            });

                            console.log( $scope.proformas);

                        }).error(function (data) {
                    console.log(data);
                });

            };

            function cabeceraDayTable (dias){

                cabecera_dias = [];

                for (var i=0;i<=dias;i++){
                    cabecera_dias.push(i+1);
                }

                return cabecera_dias;

            }

            function suma_ht(avance){

                var suma = 0;

                avance.forEach(function (val) {
                   suma +=parseFloat(val.ht);

                });

                return suma;
            }

            function mayor(avance){
                var mayor = 0;

                avance.forEach(function (val) {

                    mayor +=parseFloat(val.avance_real);

                });

                return mayor;
            }



        });


    </script>

@stop