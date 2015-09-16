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
            <p><i class="fa fa-info-circle"></i>  <strong>Mensaje:{{ Session::get('confirm') }}</strong></p>
        </div>
    @endif


    <div style="padding-left:5px;">
        <div class="bs-callout bs-callout-info" id="callout-type-dl-truncate">
            <h4>Asignaciones de Area:</h4>
        </div>
    </div>

@stop

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-danger" >
                    <div class="box-header">
                    <!-- tools box -->
                        <div class="pull-right box-tools">
                            <button class="btn btn-danger btn-sm refresh-btn" data-toggle="tooltip" title="Reload"><i class="fa fa-refresh"></i></button>
                        </div><!-- /. tools -->
                        <i class="fa fa-cloud"></i>

                        <h1 class="box-tittle">Area: {{$area->descripcion}}</h1>
                    </div><!-- /.box-header -->
                    <div class="box-body no-padding">
                        <div class="row">

                        <!--la condicional solo es para el cambio de ruta-->
                        @if($encargado == 0)
                            <h3>Asignar Encargado</h3>

                            <form class="ui form" id="formulario" ng-app="app" ng-controller="appCtrl as vm" action="{{ URL::route('regEncargadoArea') }}" method="post">
                        @else
                            <h3>Asignar Empleado:</h3>
                            <form class="ui form" id="formulario" ng-app="app" ng-controller="appCtrl as vm"action="{{ URL::route('regEmpleadoArea') }}" method="post">
                         @endif
                         <!--/ end if's-->
                                <input type="hidden"  name="idArea" value="{{ $area->id }}">
                                <input type="hidden"  name="_token" value="{{{ csrf_token() }}}"  />

                                <div class="col-lg-3">
                                    <label>DNI</label>
                                    <input class="form-control" type="text"  name="dni"  ng-model="vm.dni" required="required">
                                </div>
                                <div class="col-lg-1">
                                    <label for=""> </label>
                                    <a class="btn btn-info"  id="btnBuscarPersonal" ng-click="vm.buscarPersonal()">
                                        <i class="fa fa-search"></i>
                                        Buscar
                                    </a>
                                </div>
                                <div class="col-lg-6">
                                    <br>
                                    <input class="form-control" type="text"  name="n_dias" ng-model="vm.personal" required="required"  disabled>
                                </div>
                                <div class="col-lg-1">
                                <br>
                                    <button class="btn btn-success" id="btnGuardar" >
                                        <i class="save icon"></i>
                                        Asignar
                                    </button>
                                </div>

                            </form>       
                        </div>
                        <hr>
                        <div class="row" style="padding: 15px;">
                            <div class="table-responsive">
                                <h3>Empleados del area Activos</h3>
                                <table class="ui table" >
                                    <thead >
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Tipo</th>
                                        <th>Fecha Inicio</th>
                                        <th>Fecha Fin</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    
                                        @foreach ($empleados as $empleado)
                                        <tr>
                                            <td>{{$empleado->id}}</td>
                                            <td>{{$empleado->fullname}}</td>
                                            <td>{{$empleado->pivot->tipo}}</td>
                                            <td>{{$empleado->pivot->f_fin}}</td>
                                            <td>{{$empleado->pivot->f_inicio}}</td>
                                        </tr>

                                        @endforeach
                                        
                                    
                                    </tbody>
                                </table>
                            </div><!--/.table-responsive -->

                        </div><!-- /.row - inside box -->
                    </div><!-- /.box-body -->
                    <div class="box-footer">

                    </div><!-- /.box-footer -->
                </div><!-- /.box -->
            </div>
        </div>
    </div>


    <div class="ui " data-styl="block-seccion" >

        


        <div class="sixteen wide column" data-styl="table">


       
        </div>


        

        <!--
        <h1> Hola @{{nombre}} </h1>
        <form>
            ¿Cómo te llamas? <input type="text" ng-model="nombre">
        </form>

        -->
    </div>




    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.23/angular.min.js"></script>
    <script>

    
        angular.module('app', []).controller('appCtrl', ['$http', controladorPrincipal]);


        function controladorPrincipal($http){

            /*declaraciones de inicio*/
            var vm=this;
            var token = $('input[name="_token"]').attr('value');
            var idArea = $('#spId').text();

            /*inicio*/
            vm.personal ="Ingrese DNI";

            /*funciones*/
            vm.buscarPersonal = function(){
                $http.post('{{ URL::route('hGetPersonalByDNI') }}',
                    {_token : token,
                      dni: vm.dni }).
                      success(function(data){

                        /*console.log(data);*/

                        vm.personal = data.nombres+','+data.apellidoP+' '+data.apellidoM;

                        if (data.nombres.indexOf('Error')!=-1) {
                            $('#btnGuardar').attr("disabled", true);
                        }else{
                            $('#btnGuardar').attr("disabled", false);
                        }
                      }).error(function(data){
                        console.log(data);
                      });   
            }
        }




        /*Iniciacion de jquery*/


        $(document).ready(function() {

             $('#btnGuardar').attr("disabled", true);

        });
        $("#alert-success").delay(1000).fadeIn('slow');
        $("#alert-success").delay(3000).fadeOut('slow');
        $("#alert-danger").delay(1000).fadeIn('slow');
        $("#alert-danger").delay(3000).fadeOut('slow');

       

    </script>


@stop