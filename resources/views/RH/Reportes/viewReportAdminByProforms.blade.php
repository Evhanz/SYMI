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
                <div class="box box-primary" id="box_ini">
                    <div class="box-header">
                        <!-- tools box -->
                        <div class="pull-right box-tools">
                            <button class="btn btn-danger btn-sm refresh-btn" data-toggle="tooltip" title="Reload"><i class="fa fa-refresh"></i></button>
                        </div><!-- /. tools -->
                        <i class="fa fa-cloud"></i>

                        <h3 class="box-title">Reporte de proformas </h3>
                    </div><!-- /.box-header -->
                    <div class="box-body ">

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

                        <div class="row" id="table_Detalle_expandido">

                            <div class="col-lg-12 ">
                                <div class="table-responsive" style="overflow: auto">
                                    <table id="tableReport" class="table table-bordered table-hover">

                                        <thead>
                                        <tr>
                                            <th  colspan="2">Número</th>
                                            <th >Mes</th>
                                            <th  >Resultado</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <tr ng-repeat="proforma in proformas">
                                            <td  >
                                                @{{proforma.numero}}

                                                <button class="btn btn-info" ng-click="report_detail_for_month( proforma.numero)">
                                                    <i class="fa fa-arrow-circle-down"></i>
                                                </button>

                                            </td>
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

                        </div>

                        <div class="row" id="detalle_por_mes">

                            <div class="col-lg-5">
                                <h2>Proforma Número @{{ d_proforma.n_proforma }}</h2>
                            </div>
                            <div class="col-lg-3">
                                Porcentaje Alcansado : @{{ d_proforma.mayor }}%
                            </div>
                            <div class="col-lg-2">
                                Horas Consumidas : @{{ d_proforma.suma_t }}
                            </div>
                            <div class="col-lg-2">
                                <button ng-click="regresar_detail()" class="btn btn-warning"> Volver <i class="fa fa-arrow-circle-left"></i> </button>
                            </div>

                            <div class="col-lg-12">
                                <div ng-repeat="o in ordenados" class="table-responsive" style="overflow: auto">

                                    <h3>Mes: @{{ o.nombre_mes }}</h3>

                                    <table id="tableReportDetail"  class="table table-bordered">



                                        <tr >
                                            <td ng-repeat=" m in o.mes">@{{ m.item.dia }}</td>

                                        </tr>
                                        <tr>
                                            <td ng-repeat=" m in o.mes">@{{ m.item.avance_real }}</td>

                                        </tr>
                                        <tr>
                                            <td ng-repeat=" m in o.mes">@{{ m.item.ht }}</td>

                                        </tr>


                                    </table>
                                </div>
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

        #tableReportDetail tr:first-child{
            background-color: #1f88be;

        }
        #tableReportDetail tr:first-child td{
            color: white;

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


            /*inicialmente ocultamos este div*/
            $("#detalle_por_mes").hide();

            $scope.proformas = [{}];
            $scope.cabecera_dias = [];

            $scope.ordenados = [];
            $scope.d_proforma ={};

            var token = '{{ csrf_token() }}';

            $scope.getData = function (){

                var fecha_ini = new Date($scope.f_ini);
                var fecha_fin = new Date($scope.f_fin);

                var Dif= fecha_fin.getTime() - fecha_ini.getTime();
                var dias= Math.floor(Dif/(1000*24*60*60));

                $scope.cant_dias = dias;
                var items;
                //$scope.cabecera_dias = cabeceraDayTable(dias);



                /**Primero agregaremos la visual de cargando
                 */
                modificarEstadoLoadingBox('cargando');

                $http.post('{{ URL::route('getReportAdminByProforms') }}',
                        { _token : token,
                            area: $scope.area,
                            fecha_ini:$scope.f_ini,
                            fecha_fin:$scope.f_fin })
                        .success(function(data){

                            $scope.proformas = data;

                            var bandera = 0;

                            angular.forEach($scope.proformas,function(item){

                                if(bandera==0){
                                   items = cab(item);

                                    $scope.cabecera_dias = items;
                                }

                                item.suma = suma_ht(item.avance_tareo);
                                item.mayor = mayor(item.avance_tareo);
                                bandera++;

                            });

                            //console.log( $scope.proformas);

                            modificarEstadoLoadingBox('terminado');
                        }).error(function (data) {
                    modificarEstadoLoadingBox('terminado');
                    console.log(data);
                });

            };


            $scope.report_detail_for_month = function(my){


                /*ocultamos los divs*/
                $("#table_Detalle_expandido").fadeOut(1000);
                $("#detalle_por_mes").fadeIn(1000);

                var f_ini = $scope.f_ini.split('-');
                var f_fin = $scope.f_fin.split('-');

                /*Primero obtenemos para obtener
                las proformas
                * */
                var proforma = {};

                angular.forEach($scope.proformas,function(item){
                    if(item.numero == my){

                        proforma = item.avance_tareo;
                        $scope.d_proforma.n_proforma = item.numero;
                        $scope.d_proforma.suma_t =item.suma;
                        $scope.d_proforma.mayor =item.mayor;

                    }
                });

                /*Luego lo dividimos
                * sus avances por meses*/

                var cant_meses = (13- parseFloat( f_ini[1]))+ parseFloat(f_fin[1])+(parseFloat(f_fin[0])-parseFloat(f_ini[0])-1)*12;


                var ordenados  = [];
                var x1 = parseInt(f_ini[1]);
                var x2 = parseInt(f_ini[0]);

                /*luego en este for , realizamos una busqueda de cada uno de los */
                for(var i=0;i<cant_meses;i++){
                    var mes = [];
                    if(i==0){
                        angular.forEach(proforma,function(item){
                            var f=item.fecha.split("-");
                            item.dia = f[2];
                            if(f[1]==x1 && f[0]==x2){
                                var m = { mes:i,item:item };
                                mes.push(m);
                            }
                        });

                    }
                    else{
                        var sum_mes = x1+1;
                        x1++;
                        if(sum_mes >12){
                            x2++;
                            x1=1;
                        }
                        angular.forEach(proforma,function(item){
                            var f=item.fecha.split('-');
                            if(f[1]==x1 && f[0]==x2){
                            var i = { mes:i,item:item };
                            mes.push(i)
                            }
                        });

                    }


                    /*sacamos el nombre del mes*/
                    var n = nombre_mes(x1);

                    var t = {mes:mes,nombre_mes:n};
                    ordenados.push(t);

                }

                //console.log(ordenados);
                $scope.ordenados = ordenados;
                console.log($scope.ordenados);
            };


            $scope.regresar_detail = function (){

                //$("#table_Detalle_expandido").show();
                //$("#detalle_por_mes").hide();

                $("#table_Detalle_expandido").fadeIn(1500);
                $("#detalle_por_mes").fadeOut(1500);

            };

            /*este método trae las cabeceras que tienen
            * los reportes de cada dia trabajas */
            function cab(item){

                var d = [];


                item.avance_tareo.forEach(function(i){

                    var dia = i.fecha.split("-");

                    d.push(dia[2]+"/"+dia[1]);

                });

                return d;

            }


            /*Es metodo dejo de usarse
            ver si es necesario eliminarla
            * */

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

            function modificarEstadoLoadingBox(estado){

                if(estado=='cargando'){
                    $( "#box_ini" ).append( "<div class='overlay'></div><div class='loading-img'></div>" );
                }else{
                    $('.overlay').remove();
                    $('.loading-img').remove();
                }

            }

            function nombre_mes (n){

                var nombre;

                switch (n){

                    case 1: nombre = 'enero'; break;
                    case 2: nombre = 'febrero';break;
                    case 3: nombre = 'marzo';break;
                    case 4: nombre = 'abril';break;
                    case 5: nombre = 'mayo';break;
                    case 6: nombre = 'junio';break;
                    case 7: nombre = 'julio';break;
                    case 8: nombre = 'agosto';break;
                    case 9: nombre = 'septiembre';break;
                    case 10: nombre = 'octubre';break;
                    case 11: nombre = 'noviembre';break;
                    case 12: nombre = 'diciembre';break;



                }

                return nombre;

            }



        });


    </script>

@stop