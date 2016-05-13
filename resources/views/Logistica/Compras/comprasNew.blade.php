@extends('Layouts/logisticaLayout')

@section('content')

    <div class="content" ng-app="app" ng-controller="PruebaController">
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-info" >
                    <div class="box-header">
                        <!-- tools box -->
                        <div class="pull-right box-tools">
                            <button class="btn btn-danger btn-sm refresh-btn" data-toggle="tooltip" title="Reload"><i class="fa fa-refresh"></i></button>
                        </div><!-- /. tools -->
                        <i class="fa fa-cloud"></i>

                        <h3 class="box-title">Nueva compra</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body ">

                        <div class="row">


                            <div class="col-lg-4">

                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <label for="exampleInputName2">Proveedor</label>
                                    </div>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="exampleInputName2" placeholder="">
                                    </div>
                                    <div class="col-lg-2">
                                        <button ng-click="buscarProveedor()" class="btn btn-warning">...</button>
                                    </div>
                                </div>

                                <div class="form-group" style="margin-top: 74px;">
                                    <label for="exampleInputName2">Fecha</label>
                                    <input type="date" class="form-control" id="exampleInputName2" placeholder="">
                                </div>

                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="exampleInputName2">Tipo.Doc</label>
                                    <input type="text" class="form-control" id="exampleInputName2" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName2">Número Doc.</label>
                                    <input type="text" class="form-control" id="exampleInputName2" placeholder="">
                                </div>

                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="exampleInputName2">Crédito</label>
                                    <input type="text" class="form-control" id="exampleInputName2" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName2">Observaciones</label><br>
                                    <textarea name="" id="" cols="54" rows="3"></textarea>
                                </div>

                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12">
                                <h2>Detalle</h2>
                            </div>
                        </div>

                        <div class="row">

                            <form class="form-inline col-lg-12">

                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <div class="form-group">
                                    <label for="exampleInputName2">Criterio</label>
                                    <input type="text" class="form-control" ng-model="criterio"  ng-keydown="getProductos()" >
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputName2">Categoria</label><br>
                                    <select class="form-control"  ng-model="categoria">
                                        <option value="" >------</option>
                                        <option ng-repeat="option in categorias" value="@{{option.id}}">@{{option.descripcion}}</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for=""></label><br>
                                    <a type="submit" class="btn btn-info">
                                        <i class="fa fa-search"></i>
                                    </a>
                                </div>

                                <div class="form-group">
                                    <label for=""></label><br>
                                    <a type="submit" class="btn btn-success" ng-click="addNewProducto()">
                                        Agregar Producto <i class="fa fa-plus"></i>
                                    </a>
                                </div>


                            </form>

                        </div>

                        <br>

                        <div class="row">

                            <div class="col-lg-12">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Nombre</th>
                                        <th>marca</th>
                                        <th>Categoria</th>
                                        <th>o</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr ng-repeat="producto in productosFiltrados">
                                        <td>@{{ producto.idproducto }}</td>
                                        <td>@{{ producto.descripcion }}</td>
                                        <td>@{{ producto.marca }}</td>
                                        <td>@{{ producto.categoria.descripcion }}</td>

                                        <td><button class="btn btn-info" ng-click="addProducto(producto)"> <i class="fa fa-angle-double-down"></i> </button></td>

                                    </tr>

                                    </tbody>

                                </table>

                                <!-- data-num-pages="numPages1()"-->
                                <div id="pagination" data-pagination="" data-num-pages="numPages1()"
                                     data-current-page="currentPage1" data-max-size="maxSize" data-boundary-links="true">
                                </div>
                            </div>
                        </div>

                        <br><br>

                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>U.M.</th>
                                        <th>Cant</th>
                                        <th>C.U.</th>
                                        <th>Opciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr ng-repeat="producto in detalleProductos">
                                        <td>@{{ producto.id }}</td>
                                        <td>@{{ producto.descripcion }}</td>
                                        <td>
                                            <select ng-model="producto.unidad_medida" class="form-control">
                                                <option value="">---</option>
                                                <option value="unidad">UNIDAD</option>
                                                <option value="m">METROS</option>
                                                <option value="m3">M3</option>
                                                <option value="cm">CENTÍMETROS</option>
                                                <option value="l">Litros</option>
                                                <option value="kg">KG</option>
                                                <option value="valde">Valde</option>
                                                <option value="pulgadas">Pulgadas</option>
                                                <option value="viaje">Viaje</option>
                                            </select>

                                        </td>
                                        <td><input ng-change="calcularResultados()" class="form-control" min="0"  ng-model="producto.cantidad" type="number" ></td>
                                        <td><input ng-change="calcularResultados()" class="form-control" min="0"  step="any" ng-model="producto.costo_unitario" type="number" ></td>
                                        <td><button class="btn btn-danger"> <i class="fa fa-angle-double-up"></i> </button></td>

                                    </tr>

                                    </tbody>

                                </table>


                            </div>
                        </div>

                        <!--tablas de detalle-->
                        <hr>
                        <div class="row">



                            <div class="col-lg-12">
                                <h2>Resultado</h2>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInputName2">Sub. Total</label>
                                        <input ng-model="sub_total" type="text" class="form-control" id="exampleInputName2"  placeholder="" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInputName2">IGV</label>
                                        <input ng-model="igv" type="text" class="form-control" id="exampleInputName2" placeholder="" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInputName2"> Total</label>
                                        <input ng-model="total" type="text" class="form-control" id="exampleInputName2" placeholder="" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <button class="btn btn-success" >Guardar</button>
                            </div>

                        </div><!--Resultado-->


                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <div  id="paginador">

                        </div>
                    </div><!-- /.box-footer -->
                </div><!-- /.box -->
            </div>
        </div>




        <!-- Modal para crear prodcto -->
        <div class="modal fade" id="newProducto"  role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Crear nuevo producto</h4>
                    </div>
                    <div class="modal-body">
                        <form action="">

                            <div class="form-group">
                                <label for="exampleInputName2">Tipo</label>
                                <select class="form-control"  ng-model="categoria">
                                    <option value="" >------</option>
                                    <option ng-repeat="option in categorias" value="@{{option.id}}">@{{option.descripcion}}</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputName2">Descripcion</label>
                                <input type="text" class="form-control" ng-model="criterio"  ng-keydown="getProductos()" >
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInputName2">Alias</label>
                                        <input type="text" class="form-control" ng-model="criterio"  ng-keydown="getProductos()" >
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInputName2">Modelo</label>
                                        <input type="text" class="form-control" ng-model="criterio"  ng-keydown="getProductos()" >
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInputName2">Serie</label>
                                        <input type="text" class="form-control" ng-model="criterio"  ng-keydown="getProductos()" >
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputName2">Marca</label>
                                        <input type="text" class="form-control" ng-model="criterio"  ng-keydown="getProductos()" >
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputName2">Energia Necesaria</label>
                                        <input type="text" class="form-control" ng-model="criterio"  ng-keydown="getProductos()" >
                                    </div>
                                </div>

                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para Buscar Proveedor -->
        <div class="modal fade" id="modbuscarProveedor"  role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Crear nuevo producto</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-inline col-lg-12">

                            <div class="form-group">
                                <label for="exampleInputName2">Descripcion</label>
                                <input type="text" class="form-control" ng-model="descripcion_proveedor"  ng-keydown="getProveedores" >
                            </div>

                            <div class="form-group">
                                <label for=""></label><br>
                                <a type="submit" class="btn btn-info">
                                    <i class="fa fa-search"></i>
                                </a>
                            </div>
                        </form>

                        <div class="col-lg-12">

                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Descripcion</th>
                                    <th>RUC</th>
                                    <th>TLF</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>

                            </table>


                        </div>

                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>


    </div><!-- /.content-->



    <script src="{{ asset('js/plugins/angular/angular-ui-bootstrap-0.3.0.min.js') }}"></script>
    <script >
        var app = angular.module('app', ['ui.bootstrap']);
        app.controller("PruebaController", function($scope,$http) {


            /*declaraciones*/

            $scope.currentPage1 =1
                    ,$scope.numPerPage = 5/*cuantos items se muestra por página*/
                    ,$scope.maxSize = 5;

            var token = $('input[name="_token"]').attr('value');

            $scope.productos =[];
            $scope.productosFiltrados=[];

            $scope.categorias =[];

            $scope.detalleProductos=[] ;



            /*funciones de inicio*/

            getCategorias();



            /*funciones que inician*/



            /**/


            /*=====================Pagination======================>*/
            $scope.numPages1 = function () {
                return Math.ceil($scope.productos.length / $scope.numPerPage);
            };
            $scope.$watch('currentPage1 + numPerPage', function() {
                var begin = (($scope.currentPage1 - 1) * $scope.numPerPage)
                        , end = begin + $scope.numPerPage;

                $scope.productosFiltrados = $scope.productos.slice(begin, end);
            });

            /*-----------------/end Pagination-----------------------*/

            $scope.getProductos =function () {


                if($scope.categoria == null || $scope.criterio == null){
                    $scope.categoria =0;
                    $scope.criterio ='';
                }
                $http.post('{{ URL::route('getByCategoriaAndCriterio') }}',
                        {_token : token,
                            categoria:$scope.categoria,
                            criterio:$scope.criterio})
                        .success(function(data){

                            $scope.productos =data;
                            $scope.productosFiltrados = $scope.productos.slice(0,5);
                        });
            };


            $scope.addProducto = function (producto){

               // console.log(producto.idproducto);

                var item = {
                    'id':producto.idproducto,
                    'descripcion':producto.descripcion,
                    'cantidad':0,
                    'costo_unitario':0

                };

                var bandera = buscarProductosRepetidos(item.id);

                if(bandera>=0){


                    alert('ya as agregado ese producto');

                    /*
                    var cant_actual= $scope.detalleProductos[bandera].cantidad;

                    console.log(cant_actual);*/



                }else {
                    $scope.detalleProductos.push(item);
                }




            };


            $scope.calcularResultados = function(){




                var total = 0;

                angular.forEach($scope.detalleProductos,function(item){

                    var r = item.cantidad * item.costo_unitario;
                    total+= r ;

                });

                var sub_total = parseFloat(total/1.18).toFixed(2);

                var igv = parseFloat(total-sub_total).toFixed(2);



                $scope.total = total;
                $scope.sub_total = sub_total;
                $scope.igv = igv;


                console.log('Entro aqui'+total);



            };


            $scope.addNewProducto = function(){

                $('#newProducto').modal('show');

            };


            $scope.buscarProveedor = function () {

                $('#modbuscarProveedor').modal('show');
            };






            function getCategorias() {

                $http.get('{{ URL::route('categoriaAll') }}')
                        .success(function (data) {
                            $scope.categorias = data;
                        });
            }


            /*funciones helpers*/
            function buscarProductosRepetidos(id){

                var bandera =-1;
                var i =0;

                angular.forEach($scope.detalleProductos,function(item){

                    if(item.id == id){
                        bandera = i;
                    }
                    i++;
                });

                return bandera;


            }







        });
    </script>





@stop