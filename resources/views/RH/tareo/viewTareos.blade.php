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
            <h4>Módulo del Proformas - Tareo </h4>
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

                        <h3 class="box-title">Lista de Todo los tareos</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body no-padding">
                        <div class="row">
                            <div class="col-lg-12">
                                <form class="form-inline" ng-submit="enviarData()">
                                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                    <div class="form-group">
                                        <label>Area</label><br>
                                        <select class="form-control" ng-model="area" >
                                            <option value="0">Ninguno</option>
                                            @foreach($areas as $area)
                                                <option value="{{$area->id}}">{{$area->descripcion}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                       <label>Fecha Inicio</label>
                                        <input type="date" ng-model="fecha_inicio" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                       <label>Fecha Fin</label>
                                        <input type="date" ng-model="fecha_fin" class="form-control" >
                                    </div>
                                    <div class="form-group" >
                                        <label for=""></label><br>
                                        <button  class="btn btn-info" id="btnBuscar">
                                            <i class="fa fa-search"></i>
                                                Buscar
                                        </button>
                                        
                                    </div>
                                    <div class="form-group">
                                        <label for=""></label>
                                        <a href="{{route('newTareo')}}" class="btn btn-success" style="width: 100%" id="btnNuevo">
                                            <i class="add user icon"></i>
                                            Nuevo
                                        </a>
                                    </div>
                                   
                                </form>
                            </div>
                        </div>

                        <div class="row" style="padding: 15px;">
                            <div class="table-responsive">
                                <table class="ui table" id="tableReq">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Fecha</th>
                                            <th>Area</th>
                                            <th colspan="2">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr ng-repeat="tareo in tareos">
                                            <td>@{{tareo.id}}</td>
                                            <td>@{{tareo.fecha}}</td>
                                            <td>@{{tareo.area.descripcion}}</td>
                                            <td>
                                                <a ng-click="editTareo(tareo.id)" class="btn btn-warning">
                                                    Editar<i class="edit icon"></i>
                                                </a>    
                                            </td>
                                            <td>
                                                <button class="btn btn-danger">
                                                    Eliminar<i class="remove icon"></i>
                                                </button>
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


    <!--

    <div class="ui grid" data-styl="block-seccion">
        <div class="sixteen wide column">
            <div class="ui form">
                <div class="inline fields">
                    <div class="seven wide field">
                        <label>Numero</label>
                        <input id="txtNumero" value="{{{ $numero or ''}}}"
                               type="text"  style=" width: 427.9979991912842px;" class="input-form" >
                    </div>
                    <div class="two wide field">
                        <button class="ui teal button" id="btnBuscar">
                            <i class="search icon"></i>
                            Buscar
                        </button>
                    </div>

                    <div class="three wide field">
                        <a href="{{route('newTareo')}}" class="ui positive button" style="width: 100%" id="btnNuevo">
                            <i class="add user icon"></i>
                            Nuevo
                        </a>
                    </div>

                </div>
            </div>
        </div>


        <div class="sixteen wide column" data-styl="table">

            <table class="ui table" id="tableReq">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Fecha</th>
                    <th>Descripcion</th>
                    <th>Opciones</th>

                </tr>
                </thead>
                <tbody>
                @foreach ($tareos as $tareo)
                    <tr>
                        <td>{{ $tareo->id }}</td>
                        <td>{{ $tareo->fecha }}</td>
                        <td>{{ $tareo->area->descripcion }}</td>
                        <td>
                            <div class="ui icon buttons">
                                <a href="{{ URL::route('viewUpdateTareo',array('id'=>$tareo->id))}}" class="ui blue button">
                                    Editar<i class="edit icon"></i>
                                </a>
                                <button class="ui red button">
                                    Eliminar<i class="remove icon"></i>
                                </button>

                            </div>
                        </td>

                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
    </div>

    


    -->
    
    <script>

        var app = angular.module("app",[]);
        app.controller("MainController", function($scope,$http,$window) {
            /*declaracion de inicio*/
            var token = $('input[name="_token"]').attr('value');
            $scope.tareos = [];
            $scope.area = 0;

            InitDataAll();

            /*funciones de uso del mod*/
            $scope.enviarData = function () {

                if (Date.parse($scope.fecha_inicio)>Date.parse($scope.fecha_fin)) {
                    alert('La fecha inicial no puede ser mayor a la final');
                }else{

              //  
                    $http.post('{{ URL::route('getTareosByAreaAndFecha') }}',
                        {_token : token,
                        fecha_inicio:$scope.fecha_inicio,
                        fecha_fin:$scope.fecha_fin,
                        area:$scope.area })
                    .success(function(data){

                        console.log(data);

                        $scope.tareos = data;


                    })
                    .error(function(data) {
                        console.log(data);
                    });
                }
            }

            $scope.editTareo = function  (idTareo) {
                
                //alert('{{ URL::route('modTareos') }}/updateTareo/'+idTareo);
                $window.location.href = '{{ URL::route('modTareos') }}/updateTareo/'+idTareo;
            }


            function InitDataAll () {
                // body...

                 $http.post('{{ URL::route('getInitTareoAll') }}',
                        {_token : token })
                    .success(function(data){

                        //console.log(data);

                        $scope.tareos = data;


                    })
                    .error(function(data) {
                        console.log(data);
                    });
            }

        });




    </script>

@stop