@extends('Layouts/logisticaLayout')

@section('content')

    <div class="content">
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

                                    <div class="col-lg-7">
                                        <input type="text" class="form-control" id="exampleInputName2" placeholder="">
                                    </div>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control" id="exampleInputName2" placeholder="">
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
                                    <label for="exampleInputName2">Numero Doc.</label>
                                    <input type="text" class="form-control" id="exampleInputName2" placeholder="">
                                </div>

                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="exampleInputName2">Credito</label>
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
                                <div class="form-group">
                                    <label for="exampleInputName2">Criterio</label>
                                    <input type="text" class="form-control" id="exampleInputName2" placeholder="">
                                </div>

                                <div class="form-group">
                                    <label for=""></label><br>
                                    <a type="submit" class="btn btn-info">
                                        <i class="fa fa-search"></i>
                                    </a>
                                </div>

                                <div class="form-group">
                                    <label for=""></label><br>
                                    <a type="submit" class="btn btn-success">
                                        Agregar Producto <i class="fa fa-plus"></i>
                                    </a>
                                </div>


                            </form>

                        </div>

                        <br>

                        <div class="row">

                            <div class="col-lg-5">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Nombre</th>
                                        <th>marca</th>
                                        <th>o</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>@{{ codigo }}</td>
                                        <td>@{{ nombre producto }}</td>
                                        <td>@{{ marca }}</td>

                                        <td><button class="btn btn-default"> <i class="fa fa-angle-double-right"></i> </button></td>

                                    </tr>

                                    </tbody>

                                </table>
                            </div>


                            <div class="col-lg-7">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>U.M.</th>
                                        <th>Cant</th>
                                        <th>C.U.</th>
                                        <th>Opciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>@{{ nombre producto }}</td>
                                        <td>@{{ u-m }}</td>
                                        <td>@{{ cantidad }}</td>
                                        <td>@{{ precio.unitario }}</td>
                                        <td><button class="btn btn-default"> <i class="fa fa-angle-double-left"></i> </button></td>

                                    </tr>

                                    </tbody>

                                </table>
                            </div>

                        </div><!--tablas de detalle-->
                        <hr>
                        <div class="row">



                            <div class="col-lg-12">
                                <h2>Resultado</h2>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInputName2">Sub. Total</label>
                                        <input type="text" class="form-control" id="exampleInputName2" placeholder="">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInputName2">IGV</label>
                                        <input type="text" class="form-control" id="exampleInputName2" placeholder="">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInputName2"> Total</label>
                                        <input type="text" class="form-control" id="exampleInputName2" placeholder="">
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
    </div><!-- /.content-->




@stop