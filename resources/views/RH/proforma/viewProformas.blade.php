@extends('layout')


@section('content-header')
    
    @if(Session::has('confirm'))
        <div style="display:none" id="alert-success" class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4>Perfecto!!</h4>
            <p><i class="fa fa-info-circle"></i>  <strong>{{ Session::get('confirm') }}</strong></p>
        </div>
    @endif
    @if(Session::has('fail'))
        <div style="display:none" id="alert-danger" class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4>Error!!</h4>
            <p><i class="fa fa-info-circle"></i>  <strong>{{ Session::get('confirm') }}</strong></p>
        </div>
    @endif


    <div style="padding-left:5px;">
        <div class="bs-callout bs-callout-info" id="callout-type-dl-truncate">
            <h4>Módulo del Proformas </h4>
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

                        <h3 class="box-title">Lista de Todas las proformas</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body no-padding">
                        <div class="row">
                            <div class="col-lg-12">
                                <form ng-submit="enviarData()" method="post" class="form-inline">
                                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                    <div class="form-group">
                                        <label>Área</label><br>
                                        <select class="form-control" ng-model="area" >
                                            <option value="0">Ninguno</option>
                                            @foreach($areas as $area)
                                                <option value="{{$area->id}}">{{$area->descripcion}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Numero</label>
                                        <input ng-trim="true" ng-model="numero" class="form-control" type="text">
                                    </div>
                                    
                                    <div class="form-group" >
                                    <label for="">Opciones</label><br>
                                        <button  class="btn btn-info" id="btnBuscar">
                                            <i class="fa fa-search"></i>
                                                Buscar
                                        </button>
                                        
                                    </div>
                                    <div class="form-group">
                                        <label for=""></label><br>
                                        <a href="{{route('viewNewProforma')}}" class="btn btn-success" style="width: 100%" id="btnNuevo">
                                            <i class="add user icon"></i>
                                            Nuevo
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="row" style="padding: 15px;">
                            <div class="table-responsive">
                                <table class="table" id="tableReq">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Número</th>
                                            <th>Descripcion</th>
                                            <th>Área</th>
                                            <th colspan="3">Opciones</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="proforma in proformas">
                                            <td>@{{proforma.id}}</td>
                                            <td>@{{proforma.numero}}</td>
                                            <td>@{{proforma.descripcion}}</td>
                                            <td>@{{proforma.area.descripcion}}</td>
                                            <td>
                                                <a ng-click="editProforma(proforma.id)" class="btn btn-warning">
                                                    Editar<i class="edit icon"></i>
                                                </a>    
                                            </td>
                                            <td>
                                                <button class="btn btn-danger">
                                                    Eliminar<i class="remove icon"></i>
                                                </button>
                                            </td>
                                            <td>
                                                <a ng-click="ver(proforma.id)" class="btn btn-info">
                                                    ver<i class="remove icon"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div><!--/.table-responsive -->

                        </div><!-- /.row - inside box -->
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <div  id="paginador">
                            
                        </div>
                    </div><!-- /.box-footer -->
                </div><!-- /.box -->
            </div>
        </div>
    </div><!-- /.content-->

    
    <script>

        

        var app = angular.module("app",[]);
        app.controller("MainController", function($scope,$http,$window) {
            /*declaracion de inicio*/
            $scope.area = 0; 
            var token = $('input[name="_token"]').attr('value');
            $scope.proformas = [];
            $scope.numero ="";




            /*funciones de uso del mod*/
            $scope.enviarData = function () {


                if ($scope.numero == "") {
                    $scope.numero = "-";
                };

              //  
                $http.post('{{ URL::route('getProformasByAreaOrNumero') }}',
                        {_token : token,
                        numero:$scope.numero,
                        area:$scope.area })
                    .success(function(data){

                            if (data.length >= 1) {
                                $scope.proformas = data;

                            } else{
                                //console.log(data);


                                $scope.proformas =[];
                                var proforma = {
                                    id:data.id,
                                    descripcion:data.descripcion,
                                    area:data.area.descripcion
                                }
                                
                                $scope.proformas.push(proforma);
                            };

                            //$scope.proformas = data;
                            console.log(data);

                        })
                    .error(function(data) {
                            console.log(data);
                        });
            }

            $scope.editProforma = function  (idProforma) {
                
                //alert('{{ URL::route('modProformas') }}/ViewUpdateProforma/'+idProforma);
                $window.location.href = '{{ URL::route('modProformas') }}/ViewUpdateProforma/'+idProforma;
            }


            $scope.ver = function (idProforma) {
                
                $window.location.href = "{{ URL::route('modProformas') }}/getReporteDetalleProformaById/"+idProforma;
            }





        });


        $("#alert-success").delay(1000).fadeIn('slow');
        $("#alert-success").delay(3000).fadeOut('slow');
        $("#alert-danger").delay(1000).fadeIn('slow');
        $("#alert-danger").delay(3000).fadeOut('slow');



        $('#btnNuevo').click(function(){
            $('#modalNew').modal('show');
        });


        /*comparacion de fechas*/


        /*
        var fech1 = document.getElementById(fechaInicial).value;
        var fech2 = document.getElementById(fechaFinal).value;

        */


        /*------------*/


    </script>


    
@stop