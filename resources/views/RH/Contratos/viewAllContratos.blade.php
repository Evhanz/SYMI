@extends('layout')

@section('content-header')
    
    @if(Session::has('confirm'))
        <div id="alert-success" class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4>Perfecto!!</h4>
            <p><i class="fa fa-info-circle"></i>  <strong>{{ Session::get('confirm') }}</strong></p>
        </div>
    @endif
    @if(Session::has('error'))
        <div  id="alert-danger" class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4>Error!!</h4>
            <p><i class="fa fa-info-circle"></i>  <strong>{{ Session::get('confirm') }}</strong></p>
        </div>
    @endif


    <div style="padding-left:5px;">
        <div class="bs-callout bs-callout-info" id="callout-type-dl-truncate">
            <h4>Módulo del Contratos </h4>
        </div>
    </div>

@stop

@section('content')


    <!---->



    <!---->

    <div ng-app="app" ng-controller="MainController">

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

                        <h3 class="box-title">Mantenimeinto de Contratos</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body no-padding">
                        <div class="row">
                            <div class="col-lg-12">
                                <form class="form-inline">
                                    <div class="form-group">
                                        <label>Criterio</label>
                                        <input class="form-control" id="txtCriterio" value="{{{ $criterio or ''}}}" type="text"  style=" width: 427.9979991912842px;" class="input-form" >
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-info" id="btnBuscar">
                                            <i class="fa fa-search"></i>
                                                Buscar
                                        </button>
                                    </div>
                                    <button id="btnNuevo" class="btn btn-success"><i class="fa fa-user-plus"></i>Nuevo</button>
                                </form>
                            </div>
                        </div>

                        <div class="row" style="padding: 15px;">
                            <div class="table-responsive">
                                <table class="ui table" id="tableReq">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Personal</th>
                                            <th>Fecha Inicio</th>
                                            <th>Fecha Fin</th>
                                            <th>Estado</th>
                                            <th colspan="3">Opciones</th>
                                            <th>Reporte</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($contratos as $contrato)
                                    	<tr>
                                    		<td>{{$contrato->id}}</td>
                                    		<td>{{$contrato->personal->fullname}}</td>
                                    		<td>{{$contrato->f_inicio}}</td>
                                    		<td>{{$contrato->f_fin}}</td>
                                    		<td>{{$contrato->estado}}</td>
                                            <td>
                                                @if( $contrato->estado == 'creado')
                                                    <a class="btn btn-warning" ng-click="editContrato('{{$contrato->id}}')">Editar</a>
                                                @else
                                                    -
                                                @endif

                                            </td>
                                            <td>
                                                @if($contrato->estado == 'caducado'  || $contrato->estado == 'creado')
                                                    <a class="btn btn-danger" ng-click="darBajaContrato('{{$contrato->id}}')">Dar Baja</a>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if($contrato->estado == 'caducado' )
                                                    <a class="btn btn-primary" ng-click="renovContrato('{{$contrato->id}}')">Renovar</a>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td><a class="btn btn-default">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </td>
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
    </div><!--/.content-->
    



    <!-- Modal de Registro-->
    <div class="modal fade" id='modalNew' >
      <div class="modal-dialog">
        <div class="modal-content">
        <form class="ui form"   method="post" id="frmReg">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Formulario de Creación de contratos</h4>
          </div>
          <div class="modal-body">
              <input type="hidden" name="_token" value="{{ csrf_token() }}" />
              <input type="hidden" name="idContrato" id="idContrato">
              <input type="hidden" id="idPersonal" name="idPersonal" >
              <div class="form-group" id="field_dni">
                  <div class="row">
                      <div class="col-lg-1">
                          DNI
                      </div>
                      <div class="col-lg-4">
                          <input ng-model="dni" class="form-control" name="dni" type="number" min="0" max="99999999" required>
                      </div>
                      <div class="col-lg-1">
                          <a class="btn btn-success" href="" ng-click="getPersona(dni)">:::</a>
                      </div>
                  </div>
              </div>
              <div class="form-group">
                <input ng-model="nombre" class="form-control" type="text" readonly  required>
              </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group" id="field_fecha_i">
                            <label >Fecha Inicio</label>
                            <input ng-model="f_inicio" class="form-control" id="f_inicio" type="date" name="f_inicio"  required>
                        </div>

                    </div>
                    <div class="col-lg-6">
                        <div class="form-group" id="field_fecha_f">
                            <label >Fecha Fin</label>
                            <input ng-model="f_fin" class="form-control" id="f_fin" type="date" name="f_fin"  required>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group" >
                            <label >Monto de pago mensual </label>
                            <div class="input-group">
                                <div class="input-group-addon">S/.</div>
                                <input ng-model="pago" class="form-control" type="number" min="0" step="any" name="pago"  required>
                            </div>
                        </div>
                    </div>
                </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <a class="btn btn-primary" ng-click="sendData()" >Guardar</a>
          </div>
        </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <!-- Modal dar de baja -->

    <div class="modal fade" id='modalEdit' >
      <div class="modal-dialog">
        <div class="modal-content">
        <form class="ui form" action="{{ URL::route('updateProfesion') }}" method="post">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Formulario de Actualización de contrato</h4>
          </div>
          <div class="modal-body">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div>

        <!-- /.modal -->

    </div><!--/ng-app-->

    <script type="text/javascript" src="https://rawgit.com/betsol/angular-input-date/master/src/angular-input-date.js"></script>
    <script>

        var app = angular.module("app", ['ngInputDate']);
        app.controller("MainController", function($scope,$http,$window) {

            var token = $('input[name="_token"]').attr('value');
            /*declaraciones de inicio*/

            $scope.edit = function (id) {

                $http.post('{{ URL::route('getProfesionById') }}',
                    { _token : token,
                     id:id })
                    .success(function(data){
                        console.log(data);
                        $scope.profesion = data;
                        $('#modalEdit').modal('show');

                    }).error(function (data) {
                        console.log(data);
                    });
            };

            /*inicio*/
            

            /*funciones*/

            $scope.getPersona = function(dni){

                $http.post('{{ URL::route('hGetPersonalByDNI') }}',
                        {_token:token,
                            dni:dni})
                        .success(function(data){

                            $scope.nombre = data.nombres+" "+data.apellidoP+" "+data.apellidoM;
                            $('#idPersonal').val(data.id);

                        })
                        .error(function(data){
                            console.log('Error'+data);
                        });
            };

            $scope.sendData = function(){


                var bandera = validForm();

                if(bandera == 0){
                    $("#frmReg").submit();
                }else {
                    alert('Complete todos los registros')
                }



            };


            $scope.editContrato = function(id){

                $http.get('{{ URL::route('modContratos') }}/getById/'+id)
                        .success(function(data){

                            $scope.dni = parseInt( data.personal.dni);
                            $scope.nombre = data.personal.nombres+" "+data.personal.apellidoP+" "+data.personal.apellidoM;
                            $scope.f_inicio =  contStringToDate(data.f_inicio);
                            $scope.f_fin = contStringToDate(data.f_fin);


                            $('#idPersonal').val(data.id_persona);
                            $('#idContrato').val(data.id);
                            $scope.pago = parseFloat(data.pago);

                            $('#frmReg').get(0).setAttribute('action', '{{ URL::route('editContrato') }}');

                            $('#modalNew').modal('show');


                        })
                        .error(function(data){
                            console.log('Error'+data);
                        });

            };


            $scope.renovContrato = function(id){

                $http.get('{{ URL::route('modContratos') }}/getById/'+id)
                        .success(function(data){

                            $scope.dni = parseInt( data.personal.dni);
                            $scope.nombre = data.personal.nombres+" "+data.personal.apellidoP+" "+data.personal.apellidoM;


                            $('#idPersonal').val(data.id_persona);
                            $('#idContrato').val(data.id);
                            $scope.pago = parseFloat(data.pago);

                            $('#frmReg').get(0).setAttribute('action', '{{ URL::route('renovContrato') }}');

                            $('#modalNew').modal('show');


                        })
                        .error(function(data){
                            console.log('Error'+data);
                        });

            };

            /*funcion para valdiar el formulario*/

            function validForm( ){

                var bandera = 0;
                var f_ini = new Date($('#f_inicio').val());
                var f_fin = new Date($('#f_fin').val());

                if(f_ini > f_fin || ($('#f_inicio').val().length == 0 || $('#f_fin').val().length==0)){
                    bandera =1;

                    $('#field_fecha_i').addClass('has-error');
                    $('#field_fecha_f').addClass('has-error');
                }


                return bandera;

            }

            
        });


        /*funcion por si */

        function contStringToDate(fecha){

            var t = fecha.split("-");
            var format_fecha = new Date(t[0],t[1]-1,t[2]);

            return format_fecha;

        }
    </script>



    <script>

        $('#btnNuevo').click(function(){

            document.getElementById("frmReg").reset();
            $('#frmReg').get(0).setAttribute('action', '{{ URL::route('regContrato') }}');

            $('#modalNew').modal('show');
        });


    </script>
@stop