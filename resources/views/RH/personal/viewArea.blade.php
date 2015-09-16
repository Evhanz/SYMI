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
            <h4>Módulo del Personal - Areas</h4>
        </div>
    </div>

@stop

@section('content')

    <div ng-app="app" ng-controller="MainController" >
        
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

                        <h3 class="box-title">Mantenimeinto de Areas</h3>
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
                                            <th>Descripcion</th>
                                            <th>Observacion</th>
                                            <th>Encargado</th>
                                            <th>Opciones</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($areas as $area)
                                            <tr>
                                                <td>{{ $area->id }}</td>
                                                <td>{{ $area->descripcion }}</td>
                                                <td>{{ $area->observacion}}</td>
                                                <td>
                                                    <div class="ui icon buttons">
                                                        <a class="btn btn-primary" href="{{route('viewAreaTrabajador',$area->id)}}">
                                                            Gestionar<i class="edit icon"></i>
                                                        </a>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="ui icon buttons">
                                                        <button ng-click="edit({{$area->id}});" class="btn btn-warning">
                                                            Editar<i class="edit icon"></i>
                                                        </button>
                                                        <button class="btn btn-danger">
                                                            Eliminar<i class="remove icon"></i>
                                                        </button>

                                                    </div>
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
    </div>


    <!-- Modal de Registro-->
    <div class="modal fade" id='modalNew' >
      <div class="modal-dialog">
        <div class="modal-content">
        <form class="ui form" action="{{ URL::route('regArea') }}" method="post">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Formulario de Creación</h4>
          </div>
          <div class="modal-body">
                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                <div class="form-group">
                    <label >Descripción</label>
                    <input class="form-control" type="text" name="descripcion" autocomplete="off"
                           placeholder="Descripcion" required>
                </div>
                <div class="form-group">
                    <label >Observación</label>
                    <input class="form-control" type="textarea" name="observacion" autocomplete="off"placeholder="Observacion" required>
                </div>            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->



    <!-- Modal de Actualizar-->
    <div class="modal fade" id='modalEdit' >
      <div class="modal-dialog">
        <div class="modal-content">
        <form class="ui form" action="{{ URL::route('editArea') }}" method="post">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Formulario de Actualización</h4>
          </div>
          <div class="modal-body">
                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

                <div class="form-group">
                    <label >ID</label>
                    <input ng-model="area.id" name="id" class="form-control" type="text" readonly>
                </div>
                <div class="form-group">
                    <label >Descripción</label>
                    <input ng-model="area.descripcion" class="form-control" type="text" name="descripcion" autocomplete="off" placeholder="Descripcion" required>
                </div>
                <div class="form-group">
                    <label >Observación</label>
                    <textarea ng-model="area.observacion" class="form-control" name="observacion" autocomplete="off" required></textarea>
                </div>          
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->





    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.4/angular.min.js"></script>
    <script>

        var app = angular.module("app", []);
        app.controller("MainController", function($scope,$http,$window) {

            var token = $('input[name="_token"]').attr('value');
            /*declaraciones de inicio*/

            $scope.edit = function (id) {

                $http.post('{{ URL::route('getAreaById') }}',
                    { _token : token,
                     id:id })
                    .success(function(data){
                        console.log(data);
                        $scope.area = data;
                        $('#modalEdit').modal('show');

                    }).error(function (data) {
                        console.log(data);
                    });
            }

            /*inicio*/
            

            /*funciones*/
            
        });
    </script>

    <script>

        $("#alert-success").delay(1000).fadeIn('slow');
        $("#alert-success").delay(3000).fadeOut('slow');
        $("#alert-danger").delay(1000).fadeIn('slow');
        $("#alert-danger").delay(3000).fadeOut('slow');



        $('#btnNuevo').click(function(){
            $('#modalNew').modal('show');
        });


    </script>


    
@stop