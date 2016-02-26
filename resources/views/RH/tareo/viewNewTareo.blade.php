@extends('layout')


@section('content-header')

    @if(isset($errors))
        @if (count($errors) > 0)
        <div style="display:none" id="alert-danger" class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4>Error!!</h4>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
           
        </div>
        @endif
    @endif

    <div style="padding-left:5px;">
        <div class="bs-callout bs-callout-info" id="callout-type-dl-truncate">
            <h4>Módulo de Tareo - Registro </h4>
        </div>
    </div>

@stop

@section('content')

<div ng-app="app" ng-controller="PruebaController">
 
 <!-- aca es para probar
      <select ng-model="miProvinciaSeleccionada" ng-options="provincia as provincia.nombre for provincia in provincias track by provincia.idProvincia" >
        <option value="">--Elige opcion--</option>
      </select>
      <br>
      El nombre de la provincia seleccionada es:@{{miProvinciaSeleccionada.nombre}}


      <a ng-click='go()' >Agregar</a>


-->
      <!-- haber-->


    <div class="content" ng-app="app">
        
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-danger">
                    <div class="box-header">
                        <!-- tools box -->
                        <div class="pull-right box-tools">
                            <button class="btn btn-danger btn-sm refresh-btn" data-toggle="tooltip" title="Reload"><i class="fa fa-refresh"></i></button>
                        </div><!-- /. tools -->
                        <i class="fa fa-cloud"></i>

                        <h3 class="box-title">Formulario de Registro</h3>

                    </div><!-- /.box-header -->
                    <div class="box-body no-padding">
                        <form ng-submit="enviarData()">
                            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>Fecha</label>
                                    <input  type="date" class="form-control" ng-model="fecha"  name="fecha" required="required">
                                </div>
                                <div class="col-lg-4">
                                    <label>Área@{{area}}</label><br>
                                    <select class="form-control" ng-model="area" ng-change="update()">
                                        <option value="">Ninguno</option>
                                        @foreach($areas as $area)
                                            <option value="{{$area->id}}">{{$area->descripcion}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <label>Observacion</label>
                                    <input class="form-control" ng-model="observacion" type="text"  name="observacion" required="required">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <h4>Detalle de Personal</h4>
                                    <hr>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">

                                    <table class="table table-hover table-striped" id="tableReq">
                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nombres y apellidos</th>
                                            <th>Opciones</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr ng-repeat="personal in personalesFilterd">
                                            <td>@{{$index}}</td>
                                            <td>@{{personal.nombres}},@{{personal.apellidoP}} @{{personal.apellidoM}}</td>
                                            <td><a class="btn btn-success" ng-click="agregar(personal)">Agregar</a></td>
                                            
                                        </tr>
                                            
                                        </tbody>
                                    </table>

                                    <div id="pagination" data-pagination="" data-num-pages="numPages1()"data-current-page="currentPage1" data-max-size="maxSize" data-boundary-links="true">
                                    </div>
                                    
                                </div>
                                <div class="col-lg-12">
                                    <table class="table table-striped" id="tableReq">
                                        <thead>
                                            <tr>
                                                <th>Item</th>
                                                <th>Nombres y apellidos</th>
                                                <th>Horas</th>
                                                <th colspan="2">Proforma</th>
                                                <th>Opciones</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="detalle in detallePersonal">
                                                <td>@{{$index}}</td>
                                                <td>@{{detalle.nombres}},@{{detalle.apellidoP}} @{{detalle.apellidoM}}</td>
                                                <td><input ng-model="detalle.hora" type="number"  step="any" required></td>
                                                <td><input ng-keyup="buscarProforma(detalle)" ng-model="detalle.proforma" type="text" autocomplete="off" required></td>
                                                <td ng-init="detalle.habilProforma = false">
                                                    <a href="" ng-show="detalle.habilProforma">
                                                    <i class="fa fa-eye"></i> ver @{{detalle.idProforma}}</a>
                                                </td>
                                                <td><a class="btn btn-danger" ng-click="quitar($index)">quitar</a></td>        
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4>Detalle Avance Proforma </h4>
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table table-hover" >
                                        <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Descripcion</th>
                                            <th>Numero</th>
                                            <th>Avance</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr ng-repeat="detalle in detalleAvanceProforma">
                                            <td>@{{$index}}</td>
                                            <td>@{{detalle.descripcion}}</td>
                                            <td>@{{detalle.numero}}</td>
                                            <td><input ng-model="detalle.avance" min="0" max="100" type="number" required></td>
                                        </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4>Opciones</h4>
                                    <hr>
                                </div>
                                <div class="col-lg-12">
                                    <button class="btn btn-success" id="btnGuardar" >
                                        <i class="save icon"></i>
                                        Guardar
                                    </button>

                                </div>
                                
                            </div>


                        </form>
                    </div><!-- /.box-body -->
                </div><!--/.box -->
            </div><!--col-lg-12-->
            

        </div>
    </div>
    

   

<!-- se a comentado por nueva version
    <div class="ui " data-styl="block-seccion" ng-app="app">
        
        <form class="ui form" ng-submit="enviarData()">
            <h4 class="ui dividing header"></h4>
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
            <div class="field">
                <div class="fields">
                    <div class="field">
                        <label>Fecha</label>
                        <input  type="date" ng-model="fecha"  name="fecha" placeholder="dd/mm/yyyy" required="required">
                    </div>

                    <div class=" field">
                        <label>Área@{{area}}</label>
                        <select class="ui fluid search dropdown" ng-model="area" ng-change="update()">
                            <option value="">Ninguno</option>
                            @foreach($areas as $area)
                                <option value="{{$area->id}}">{{$area->descripcion}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="field">
                        <label>Observacion</label>
                        <input ng-model="observacion" type="text"  name="observacion" required="required">
                    </div>

                </div>
            </div>
            
            <h3>Detalle Personal </h3>
            <h4 class="ui dividing header"></h4>

            <div class="field">
                <div class="fields">
                    <div class="field">
                        <label>Criterio</label>
                    </div>
                    <div class="seven wide field">
                        <input type="text"  id="txtCriterio" >
                    </div>

                </div>
            </div>
            <div class="sixteen wide column" data-styl="table">

                <table class="ui table" id="tableReq">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombres y apellidos</th>
                        <th>Opciones</th>

                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="personal in personalesFilterd">
                        <td>@{{$index}}</td>
                        <td>@{{personal.nombres}},@{{personal.apellidoP}} @{{personal.apellidoM}}</td>
                        <td><a ng-click="agregar(personal)">Agregar</a></td>
                        
                    </tr>
                        
                    </tbody>
                </table>

                <div data-pagination="" data-num-pages="numPages1()" 
                          data-current-page="currentPage1" data-max-size="maxSize"  
                          data-boundary-links="true">
                </div>
            </div>
            <br/>
            <div class="sixteen wide column" data-styl="table">

                <table class="ui table" >
                    <thead>
                    <tr>
                        <th>Item</th>
                        <th>Nombres y apellidos</th>
                        <th>Horas</th>
                        <th colspan="2">Proforma</th>
                        <th>Opciones</th>

                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="detalle in detallePersonal">
                        <td>@{{$index}}</td>
                        <td>@{{detalle.nombres}},@{{detalle.apellidoP}} @{{detalle.apellidoM}}</td>
                        <td><input ng-model="detalle.hora" type="number" step="any" required></td>
                        <td><input ng-keyup="buscarProforma(detalle)" ng-model="detalle.proforma" type="text" required></td>
                        <td ng-init="detalle.habilProforma = false">
                            <a href="" ng-show="detalle.habilProforma">
                            <i class="fa fa-eye"></i> ver @{{detalle.idProforma}}</a>
                        </td>
                        <td><a ng-click="quitar($index)">quitar</a></td>

                        
                    </tr>
                        
                    </tbody>
                </table>
            </div>

            <h3>Detalle Avance Proforma </h3>
            <h4 class="ui dividing header"></h4>

            <div class="sixteen wide column" data-styl="table">

                <table class="ui table" >
                    <thead>
                    <tr>
                        <th>Item</th>
                        <th>Descripcion</th>
                        <th>Numero</th>
                        <th>Avance</th>

                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="detalle in detalleAvanceProforma">
                        <td>@{{$index}}</td>
                        <td>@{{detalle.descripcion}}</td>
                        <td>@{{detalle.numero}}</td>
                        <td><input ng-model="detalle.avance" type="text" required></td>                     
                    </tr>
                    </tbody>
                </table>
            </div>




            <div class="field">
                <button class="ui teal button" id="btnGuardar" >
                    <i class="save icon"></i>
                    Guardar
                </button>
            </div>
        </form>
    </div>
    -->



    <div class="modal fade" id="modLoading">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Enviando Datos....</h4>
          </div>
          <div class="modal-body">
            <p>
                <div class="circle"></div>
                <div class="circle1"></div>
            </p>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

</div>

<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.19/angular.js"></script>
<script src="{{ asset('js/plugins/angular/angular-ui-bootstrap-0.3.0.min.js') }}"></script>
<script>

    function loading (estado) {
        // body...

        if (estado == "mostrar") {
            $('#modLoading').modal('show');
        }
        else{
            $('#modLoading').modal('hide'); 
        }
        
    }

    var app = angular.module("app", ['ui.bootstrap']);
    app.controller("PruebaController", function($scope,$http,$window) {


        /*declaraciones*/

        $scope.currentPage1 =1
        ,$scope.numPerPage = 5/*cuantos items se muestra por página*/
        ,$scope.maxSize = 5;

        var token = $('input[name="_token"]').attr('value');

        $scope.personales =[];
        $scope.personalesFilterd=[];
        $scope.detallePersonal=[];
        $scope.detalleAvanceProforma=[];



        /*funciones que inician*/



        /**/


        /*=====================Pagination======================>*/
        $scope.numPages1 = function () {
            return Math.ceil($scope.personales.length / $scope.numPerPage);
        };
        $scope.$watch('currentPage1 + numPerPage', function() {
            var begin = (($scope.currentPage1 - 1) * $scope.numPerPage)
            , end = begin + $scope.numPerPage;
            
            $scope.personalesFilterd = $scope.personales.slice(begin, end);
        });


        /*-----------------/end Pagination-----------------------*/

        $scope.update =function () {
           $http.post('{{ URL::route('getPersonalByAreaId') }}',
                {_token : token,
                  area:$scope.area })
                .success(function(data){

                    $scope.personales =data;
                    $scope.personalesFilterd = $scope.personales.slice(0,5);
                            
                });
        };

        $scope.buscarProforma =function (detalle) {
           $http.post('{{ URL::route('hGetProformaById') }}',
                {_token : token,
                  id:detalle.proforma })
                .success(function(data){

                   

                   if (data=="0") {
                        detalle.habilProforma = false;
                   }else{
                        detalle.habilProforma = true;
                        detalle.idProforma = data.id;
                        helperDetalleAvance(data);
                   };

                   //console.log(data);
                            
                });
        };



        $scope.agregar = function (personal) {

            var detalle = { id:personal.id,
                            nombres:personal.nombres,
                            apellidoP:personal.apellidoP,
                            apellidoM:personal.apellidoM };

            /*
            var bandera = validar(detalle);

            if (bandera == 0) {
                 $scope.detallePersonal.push(detalle);

            }else{
                alert('El Empleado ya a sido agregado');
            }*/
             $scope.detallePersonal.push(detalle);
        };

        $scope.quitar = function (index) {
            //console.log(index);
            $scope.detallePersonal.splice(index,1);

            filtrar();    
        }

        $scope.enviarData = function () {

            /*Desactivo primero el boton*/

            document.getElementById("btnGuardar").disabled = true;
            loading("mostrar");

            /**/

            $http.post('{{ URL::route('regTareo') }}',
                {_token : token,
                 fecha:$scope.fecha,
                 idArea:$scope.area,
                 observacion:$scope.observacion,
                 detallePersonal:$scope.detallePersonal,
                 detalleAvanceProforma: $scope.detalleAvanceProforma })
                .success(function(data){
                    
                    loading("ocultar");
                    alert('Registro correcto');
                    $window.location.href = '{{ URL::route('viewTareo') }}'
                    
                    console.log(data);

                }).error(function(data) {
                    console.log(data);
                });
        } 




        /*funciones de apoyo*/
        /*esta funcion es para validar si exist una persona en el detalle*/
        function validar (detalle) {

            var val =0;

            if ($scope.detallePersonal.length > 0) {
                
                angular.forEach($scope.detallePersonal,function (item) {
                    
                    if (item.id == detalle.id) {
                        val = 1;
                    };
                });

            }
            
            return val;

        }

        function helperDetalleAvance(proforma) {

            if ($scope.detalleAvanceProforma.length == 0) {
                $scope.detalleAvanceProforma.push(proforma); 
            }else{

                /*Indicador si es que no existe conincidencia*/
                var i = 0;

                angular.forEach($scope.detalleAvanceProforma,function (item) {
                    
                    if (item.id == proforma.id) {i=1;}
                });

                if (i==0) {
                    $scope.detalleAvanceProforma.push(proforma); 
                };

            }
            /*se la llama para limpiar detalles no existentes*/
            filtrar();
        };


        /*funcion para limpiar proforma que no se encuentren ne los detaller personal*/
        function filtrar () {
             // body...

             if ($scope.detallePersonal.length==0) {
                $scope.detalleAvanceProforma=[];
            }else{

                /*variable para saber la posicion*/
                var bandera = 0;

                angular.forEach($scope.detalleAvanceProforma,function (avanceP) {
                    
                    /*Indicador para ver si hay proformas que no estan en el detalle personal*/
                    var i = 0;     

                    angular.forEach($scope.detallePersonal,function (detalleP) {

                        if (avanceP.id == detalleP.idProforma ) {
                            i=1;
                        } 
                    });

                    if(i==0){
                        $scope.detalleAvanceProforma.splice(bandera,1);
                    }
                    bandera++;
                });
            }
        }

        /*asignar una clase par ala paginacion*/


        

 
});
</script>

    


@stop