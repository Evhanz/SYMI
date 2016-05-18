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
            <h4>Módulo del Proformas - s</h4>
        </div>
    </div>

@stop

@section('content')




    <div class="content" ng-app="app" ng-controller="MainController">
        <div class="row">
            <div class="col-lg-12">
                <button uib-popover-template="dynamicPopover.templateUrl" popover-title="@{{dynamicPopover.title}}" type="button" class="btn btn-default">Popover With Template</button>

                <script type="text/ng-template" id="myPopoverTemplate.html">
                    <div>@{{dynamicPopover.content}}</div>
                    <div class="form-group">
                        <label>Popup Title:</label>
                        <input type="text" ng-model="dynamicPopover.title" class="form-control">
                    </div>
                </script>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-success" >
                    <div class="box-header">
                    <!-- tools box -->
                        <div class="pull-right box-tools">
                            <button class="btn btn-danger btn-sm refresh-btn" data-toggle="tooltip" title="Reload"><i class="fa fa-refresh"></i></button>
                        </div><!-- /. tools -->
                        <i class="fa fa-cloud"></i>

                        <h3 class="box-title">Lista de Todas las proformas</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
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
                                            <th colspan="2">Descripcion</th>
                                            <th>Área</th>
                                            <th>OS</th>
                                            <th colspan="2">Opciones</th>
                                            <th>Estados</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="proforma in proformas">
                                            <td>@{{proforma.id}}</td>
                                            <td>@{{proforma.numero}}</td>
                                            <td>@{{proforma.subdescripcion}}</td>
                                            <td>
                                                <button uib-popover="@{{proforma.descripcion}}" popover-trigger="mouseenter" type="button" class="btn btn-default">...</button>
                                            </td>
                                            <td>@{{proforma.area}}</td>
                                            <td>
                                                <a ng-click="addos(proforma.id)" class="btn btn-info">
                                                    OS<i class="edit icon"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a ng-click="editProforma(proforma.id)" class="btn btn-warning">
                                                    Editar<i class="edit icon"></i>
                                                </a>    
                                            </td>
                                            <td>
                                                <a ng-click="ver(proforma.id)" class="btn btn-info">
                                                    ver<i class="remove icon"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <button class="btn btn-default" ng-click="viewSeguimiento(proforma.id)">
                                                    <i class="fa fa-eye"></i>
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





        <!-- Modal estados-->

        <div class="modal fade" id='modalState' >
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Seguimiento de Estado</h4>
                    </div>

                    <div class="modal-body">

                        <input id="idProforma" type="hidden">

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th> ID </th>
                                <th> Tipo </th>
                                <th> Fecha </th>
                                <th> Observacion </th>
                                <th> Opción</th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr ng-repeat="estado in estados">

                                <td>@{{ estado.id }}    </td>
                                <td>@{{ estado.tipo }}</td>
                                <td>@{{ estado.fecha }}</td>
                                <td>@{{ estado.observacion }}</td>
                                <td ng-if=" estado.tipo !== 'creada' && estado.tipo !== 'proceso' ">

                                    <button class="btn btn-warning" ng-click="editEstado(estado.id)">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                </td>
                            </tr>

                            </tbody>

                        </table>

                        <button class="btn btn-success" ng-click="addEstado()">
                            Nuevo Estado <i class="fa fa-plus-circle"></i>
                        </button>


                        <!-- form Add New Estado-->
                        <form id="frmNewEstado" ng-submit="enviarDataNewEstado()" method="post">

                            <legend >Nuevo Estado</legend>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <label for="tipo">Tipo</label>
                            <select class="form-control" name="tipo" id="" ng-model="tipo" required>
                                <option value="">Ninguno</option>
                                <option value="standby">standby</option>
                                <option value="facturada">facturada</option>
                                <option value="finalizada">finalizada</option>
                            </select>

                            <label for="">Fecha</label>
                            <input ng-model="fecha" name="fecha" class="form-control" type="date" required>

                            <span ng-if=" tipo === 'facturada' ">
                                <label for="observacion">Monto Facturado %</label>
                                <input ng-model="$parent.observacion" class="form-control" name="observacion" type="number" required>
                            </span>
                            <span ng-if=" tipo !== 'facturada' ">
                                <label for="observacion">Observacion</label>
                                <textarea ng-model="$parent.observacion" class="form-control" name="observacion" id="" cols="5" rows="2" required>
                                </textarea>
                            </span>
                            <br>
                            <button class="btn btn-primary" > <i class="fa fa-save"></i> Guardar</button>

                        </form>

                        <!-- form Edit Estado-->
                        <form id="frmEditEstado" ng-submit="enviarUpEstado()" action="" method="post">
                            <legend >Editar Estado</legend>

                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input id="hdIdEstado" type="hidden" name="idEstado"  />

                            <label for="">Fecha</label>
                            <input ng-model="Upfecha" name="fecha" class="form-control" type="date" required>

                            <label for="tipo">Tipo</label>
                            <select class="form-control" name="tipo" id="" ng-model="Uptipo" required>
                                <option value="standby">standby</option>
                                <option value="facturada">facturada</option>
                                <option value="finalizada">finalizada</option>
                            </select>

                            <span ng-if=" Uptipo === 'facturada' ">
                                <label for="observacion">Monto Facturado %</label>
                                <input ng-model="$parent.Upobservacion" class="form-control" name="observacion" type="number" required>
                            </span>

                            <span ng-if=" Uptipo !== 'facturada' ">
                                <label for="observacion">Observacion</label>
                                <textarea ng-model="$parent.Upobservacion" class="form-control" name="observacion" id="" cols="5" rows="2" required>
                                </textarea>
                            </span>

                            <br>

                            <button class="btn btn-primary" > <i class="fa fa-save"></i> Guardar</button>



                        </form>
                        <!-- form Delete Estado-->
                        <form id="frmDeleteEstado" action="" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        </form>
                    </div>

                    <div class="modal-footer">

                    </div>





                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


        <!-- Modal Orden de Servicio -->

        <div class="modal fade" id='modalOS' >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Modal Orden De Servicio </h4>
                    </div>

                    <div class="modal-body">

                        <input id="idProformaOS" type="hidden">


                        <!-- form Add New Estado-->
                        <form id="frmNewEstado" ng-submit="enviarDataOS()" method="post">

                            <legend >Agregrar Orden De servicio</legend>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <label for="">Descripcion</label>
                            <input ng-model="os.descripcion" name="descripcion" class="form-control" type="text" required>
                            <label for="">Numero de Orden De Servicio</label>
                            <input ng-model="os.numero" name="numero" class="form-control" type="text" required>
                            <label for="">Numero Pedido</label>
                            <input ng-model="os.pedido" name="n_pedido" class="form-control" type="text" required>
                            <label for="">Monto</label>
                            <input ng-model="os.monto" name="monto" class="form-control" type="text" required>
                            <label for="">Observacion</label>
                            <input ng-model="os.observacion" name="observacion" class="form-control" type="text" required>
                            <br>
                            <button class="btn btn-primary" > <i class="fa fa-save"></i> Guardar</button>

                        </form>

                    </div>

                    <div class="modal-footer">

                    </div>





                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->




    </div><!-- /.content-->






    <script>

        var app = angular.module("app",['ui.bootstrap']);
        app.controller("MainController", function($scope,$http,$window) {


            $scope.dynamicPopover = {
                content: 'Hello, World!',
                templateUrl: 'myPopoverTemplate.html',
                title: 'Title'
            };




            /*declaracion de inicio*/
            $scope.area = 0; 
            var token = $('input[name="_token"]').attr('value');
            $scope.proformas = [];
            $scope.numero ="";

            /*---- Inicializacion de eventos-------*/

            initData();
            initFrmEstados();

            /*------------*/

            function initData () {

                $http.post('{{ URL::route('getInitAlldata') }}',
                        {_token : token})
                    .success(function(data){

                            if (data.length >= 1) {


                                //$scope.proformas = data;

                                $scope.proformas =[];
                                data.forEach(function(item){
                                    var sub = item.descripcion.substring(0, 20);

                                    var proforma = {
                                        id:item.id,
                                        numero:item.numero,
                                        subdescripcion:sub,
                                        area:item.area.descripcion,
                                        descripcion:item.descripcion
                                    };

                                    $scope.proformas.push(proforma);


                                });


                                console.log(data);

                            } else{
                                //console.log(data);
                                var sub = item.descripcion.substring(0, 20);

                                $scope.proformas =[];
                                var proforma = {
                                    id:data.id,
                                    subdescripcion:sub,
                                    area:data.area.descripcion
                                };
                                
                                $scope.proformas.push(proforma);
                            }

                            //$scope.proformas = data;
                            //console.log(data);

                        })
                    .error(function(data) {
                            console.log(data);
                        });
            }

            /*funciones de uso del mod*/
            $scope.enviarData = function () {


                if ($scope.numero == "") {
                    $scope.numero = "-";
                }

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
                                };
                                
                                $scope.proformas.push(proforma);
                            }

                            //$scope.proformas = data;
                            console.log(data);

                        })
                    .error(function(data) {
                            console.log(data);
                        });
            };


            $scope.enviarDataOS = function(){



            };


            $scope.addos = function(idProforma){



                $('#idProformaOS').val(idProforma);

                $('#modalOS').modal('show');

            };

            $scope.editProforma = function  (idProforma) {
                
                //alert('{{ URL::route('modProformas') }}/ViewUpdateProforma/'+idProforma);
                $window.location.href = '{{ URL::route('modProformas') }}/ViewUpdateProforma/'+idProforma;
            };

            $scope.ver = function (idProforma) {
                
                $window.location.href = "{{ URL::route('modProformas') }}/getReporteDetalleProformaById/"+idProforma;
            };

            $scope.viewSeguimiento = function(idProforma){

                $http.get('{{ URL::route('modProformas') }}/getEstadoOfProforma/'+idProforma)
                        .success(function(data){
                            $scope.estados = data;
                            initFrmEstados();
                            $('#idProforma').val(idProforma);
                            $('#modalState').modal('show');

                        })
                        .error(function(data) {

                        });

            };

            $scope.addEstado = function(){
                viewFrmstados('new');
            };

            $scope.editEstado = function(idEstado){
                $('#hdIdEstado').val(idEstado);

                $http.get('{{ URL::route('modProformas') }}/getEstadoByID/'+idEstado)
                        .success(function(data){


                            $scope.Uptipo = data.tipo;
                            $scope.Upfecha = data.fecha;

                            if(data.tipo == 'facturado'){
                                $scope.Upobservacion = parseInt( data.observacion);
                            }else {
                                $scope.Upobservacion = data.observacion;
                            }
                            viewFrmstados('edit');
                        })
                        .error(function(data) {

                        });
            };

            $scope.enviarDataNewEstado = function(){

                var bandera = validarNewEstado();

                if(bandera == 0){

                    $http.post('{{ URL::route('regEstadoNew') }}',
                            {_token : token,
                                tipo:$scope.tipo,
                                fecha:$scope.fecha,
                                observacion: $scope.observacion,
                                proforma:   $('#idProforma').val()
                            })
                            .success(function(data){

                                if(data.type == 1){
                                    document.getElementById("frmNewEstado").reset();
                                    $scope.viewSeguimiento($('#idProforma').val());
                                    initFrmEstados();

                                    alert('Datos Registrados Correctamente');
                                }

                            })
                            .error(function(data) {
                                console.log(data);
                            });

                }else{
                    alert('Los datos son errones');
                }

            };

            $scope.enviarUpEstado = function(){

                $http.post('{{ URL::route('updateEstado') }}',
                        {_token : token,
                            tipo:$scope.Uptipo,
                            fecha:$scope.Upfecha,
                            observacion: $scope.Upobservacion,
                            proforma:   $('#idProforma').val(),
                            idEstado: $('#hdIdEstado').val()
                        })
                        .success(function(data){

                            if(data.type == 1){
                                document.getElementById("frmEditEstado").reset();
                                $scope.viewSeguimiento($('#idProforma').val());
                                initFrmEstados();

                                alert('Datos Actualizados Correctamente');
                            }

                            console.log(data);

                        })
                        .error(function(data) {
                            console.log(data);
                        });

            };

            function initFrmEstados(){

                $("#frmNewEstado").hide();
                $("#frmEditEstado").hide();
                $("#frmDeleteEstado").hide();

            }

            function viewFrmstados(estado){

                switch (estado) {

                    case 'new':
                        $('#frmNewEstado').show();
                        $("#frmEditEstado").hide();
                        $("#frmDeleteEstado").hide();
                        break;
                    case 'edit':
                        $('#frmNewEstado').hide();
                        $("#frmEditEstado").show();
                        $("#frmDeleteEstado").hide();
                        break;
                    case 'delete':
                        $('#frmNewEstado').hide();
                        $("#frmEditEstado").hide();
                        $("#frmDeleteEstado").show();
                        break;

                }


            }


            function validarNewEstado(){

                var bandera = 0;
                var fecha = new Date($scope.fecha);

                var compare_fecha ;


                angular.forEach($scope.estados,function(item){
                    compare_fecha = new Date(item.fecha);
                    if(fecha <= compare_fecha){
                        bandera = 1;
                    }
                });

                return bandera;

            }




        });





        /*funciones que deben ser pasadas a un archivo generico*/

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