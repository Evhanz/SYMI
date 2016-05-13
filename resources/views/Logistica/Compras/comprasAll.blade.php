@extends('Layouts/logisticaLayout')

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

                        <h3 class="box-title">Lista de Todas las Compras</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body ">
                        <div class="row">
                            <form class="form-inline col-lg-12">
                                <div class="form-group">
                                    <label for="exampleInputName2">Proveedor</label>
                                    <input type="text" class="form-control" id="exampleInputName2" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail2">Fecha Inicio</label>
                                    <input type="date" class="form-control" id="exampleInputEmail2" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail2">Fecha Fin</label>
                                    <input type="date" class="form-control" id="exampleInputEmail2" placeholder="">
                                </div>

                                <div class="form-group">
                                    <label for=""></label><br>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                                <div class="form-group">
                                    <label for=""></label><br>
                                    <a type="submit" class="btn btn-success">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                            </form>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Proveedor</th>
                                        <th>Monto T.</th>
                                        <th>IGV</th>
                                        <th>Fecha</th>
                                        <th>Tipo Doc.</th>
                                        <th>N° Docuemento</th>
                                        <th>Pagada</th>
                                        <th colspan="2">Opciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>01</td>
                                        <td>Metal y Metales</td>
                                        <td>1203.00</td>
                                        <td>128</td>
                                        <td>12-12-12</td>
                                        <td>Boleta</td>
                                        <td>12930</td>
                                        <td>si</td>
                                        <td><button class="btn btn-default"> <i class="fa fa-edit"></i> </button></td>
                                        <td>
                                            <button class="btn btn-default"> <i class="fa fa-edit"></i> </button>
                                        </td>
                                    </tr>
                                    </tbody>

                                </table>
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




@stop