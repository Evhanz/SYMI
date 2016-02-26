@extends('layout')


@section('content-header')
    

    <div style="padding-left:5px;">
        <div class="bs-callout bs-callout-info" id="callout-type-dl-truncate">
            <h4>Módulo del Reportes - Personal por hora</h4>
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

                        <h3 class="box-title">Reporte de horas trabajadas  </h3>
                    </div><!-- /.box-header -->
                    <div class="box-body no-padding">
                        
                        <div class="row">
                            <div class="col-lg-12">
                                <form class="form-inline" ng-submit="getHoras()">
                                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                  <div class="form-group">
                                    <label for="exampleInputName2">DNI</label>
                                    <input type="text" class="form-control" name="txtDNI" ng-model="personal.dni">
                                  </div>
                                  <div class="form-group">
                                    <label ></label><br>
                                    <a class="btn btn-success" ng-click="getPersonal()" href="">::</a>
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleInputEmail2">Persona</label>
                                    <input ng-model="personal.nombre" type="text" class="form-control"  disabled="true">
                                  </div>
                                  <div class="form-group">
                                    <label >Fecha Inicio</label>
                                    <input ng-model="fecha_ini"  type="date" class="form-control" required>
                                  </div>
                                  <div class="form-group">
                                    <label >Fecha Fin</label>
                                    <input ng-model="fecha_fin" type="date" class="form-control" required>
                                  </div>
                                  <button class="btn btn-default" >Buscar</button>
                                </form>
                            </div>
                        </div>

                        <h3>Detalle de Horas</h3>
                        <hr>

                        <div class="row">

                            <div class="col-lg-6">
                                
                                <table class="table table-bordered">
                                    
                                    <thead>
                                        <tr>
                                            <th>Dia</th>
                                            <th>Fecha (YYYY/MM/DD)</th>
                                            <th>Horas Trabajadas</th>
                                            <th>N° Proforma</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        
                                        <tr ng-repeat="detalle in detalleReporte">
                                            <td>@{{detalle.dia}}</td>
                                            <td>@{{detalle.fecha}}</td>
                                            <td>@{{detalle.horas}}</td>
                                            <td>@{{detalle.proforma}}</td>
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



    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.4/angular.min.js"></script>
    <script>

    
        var app = angular.module("app", []);
        app.controller("MainController", function($scope,$http,$window) {

            var token = $('input[name="_token"]').attr('value');
            /*declaraciones de inicio*/
            $scope.personal={id:0,nombre:"",dni:0};

            $scope.horas=[];
            $scope.detalleReporte=[];


            $scope.getPersonal = function  () {
                $http.post('{{ URL::route('ServicegetPersonalByDNI') }}',
                    { _token : token,
                     dni: $scope.personal.dni })
                    .success(function(data){
                        $scope.personal.nombre = data.nombres+", "+data.apellidoP+" "+data.apellidoM;
                        $scope.personal.id = data.id;
                        console.log($scope.personal);

                    }).error(function (data) {
                        console.log(data);
                    });
            };


            /*Trae todo el Json de las Horas que trabajo el personal*/

            $scope.getHoras = function  () {

                $scope.detalleReporte=[];


                $http.post('{{ URL::route('ServiceGetHorasByFechas') }}',
                    { _token : token,
                     id: $scope.personal.id,
                     fecha_ini:$scope.fecha_ini,
                     fecha_fin:$scope.fecha_fin })
                    .success(function(data){
                        
                        angular.forEach(data,function (item) 
                        {

                            
                            var fecha = new Date(item.fecha);

                           // item.fecha = fecha.getDate()+"/"+(fecha.getMonth()+1)+"/"+fecha.getFullYear();

                            var dia = fecha.getDay()+1;
                            var day ="";

                            switch (dia) {
                                case 0:
                                    day = "Domingo";
                                    break;
                                case 1:
                                    day = "Lunes";
                                    break;
                                case 2:
                                    day = "Martes";
                                    break;
                                case 3:
                                    day = "Miercoles";
                                    break;
                                case 4:
                                    day = "Jueves";
                                    break;
                                case 5:
                                    day = "Viernes";
                                    break;
                                case 6:
                                    day = "Sabado";
                                    break;
                            }
                           

                            var detalle = {
                                dia:day,
                                fecha:item.fecha,
                                horas:item.h_trabajadas,
                                proforma:item.numero
                            };


                            $scope.detalleReporte.push(detalle);

                            
                        });

                        //console.log(data);

                    }).error(function (data) {
                        console.log(data);
                    });
            };




            




           

            /*inicio*/
            

            /*funciones*/
            
        });




    </script>















@stop