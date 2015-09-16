@extends('layout')

@section('content-header')

    <div style="padding-left:5px;">
        <div class="bs-callout bs-callout-info" id="callout-type-dl-truncate">
            <h4>Bienvenidos</h4>
        </div>
    </div>

@stop
@section('content')


<div class="content">

    <div class="row">
        <div class="col-lg-6">
        <!-- Box (with bar chart) -->
            <div class="box box-danger" >
                <div class="box-header">
                <!-- tools box -->
                    <div class="pull-right box-tools">
                        <button class="btn btn-danger btn-sm refresh-btn" data-toggle="tooltip" title="Reload"><i class="fa fa-refresh"></i></button>
                        <button class="btn btn-danger btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-danger btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div><!-- /. tools -->
                    <i class="fa fa-cloud"></i>

                    <h3 class="box-title">Server Load</h3>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                        <div class="row" style="padding: 15px;">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tableReq">
                                    <thead >
                                    <tr>
                                        <th>Name</th>
                                        <th>Registration Date</th>
                                        <th>E-mail address</th>
                                        <th>Premium Plan</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>John Lilki</td>
                                        <td>September 14, 2013</td>
                                        <td>jhlilk22@yahoo.com</td>
                                        <td>No</td>
                                    </tr>
                                    <tr>
                                        <td>Jamie Harington</td>
                                        <td>January 11, 2014</td>
                                        <td>jamieharingonton@yahoo.com</td>
                                        <td>Yes</td>
                                    </tr>
                                    <tr>
                                        <td>Jill Lewis</td>
                                        <td>May 11, 2014</td>
                                        <td>jilsewris22@yahoo.com</td>
                                        <td>Yes</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div><!-- /.row - inside box -->
                    </div><!-- /.box-body -->
                    <div class="box-footer">

                    </div><!-- /.box-footer -->
                </div><!-- /.box -->

        </div>
        <div class="col-lg-6">
            <div class="box box-danger" >
                <div class="box-header">
                <!-- tools box -->
                    <div class="pull-right box-tools">
                        <button class="btn btn-danger btn-sm refresh-btn" data-toggle="tooltip" title="Reload"><i class="fa fa-refresh"></i></button>
                        <button class="btn btn-danger btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-danger btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div><!-- /. tools -->
                    <i class="fa fa-cloud"></i>

                    <h3 class="box-title">Server Load</h3>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                        <div class="row" style="padding: 15px;">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tableReq">
                                    <thead >
                                    <tr>
                                        <th>Name</th>
                                        <th>Registration Date</th>
                                        <th>E-mail address</th>
                                        <th>Premium Plan</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>John Lilki</td>
                                        <td>September 14, 2013</td>
                                        <td>jhlilk22@yahoo.com</td>
                                        <td>No</td>
                                    </tr>
                                    <tr>
                                        <td>Jamie Harington</td>
                                        <td>January 11, 2014</td>
                                        <td>jamieharingonton@yahoo.com</td>
                                        <td>Yes</td>
                                    </tr>
                                    <tr>
                                        <td>Jill Lewis</td>
                                        <td>May 11, 2014</td>
                                        <td>jilsewris22@yahoo.com</td>
                                        <td>Yes</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div><!-- /.row - inside box -->
                    </div><!-- /.box-body -->
                    <div class="box-footer">

                    </div><!-- /.box-footer -->
                </div><!-- /.box -->
        </div>
        
    </div>
                
</div>

<div class="ui grid" data-styl="block-seccion">
    <div class="eight wide column" data-styl="table">


        <h3>Aca va la tabla de Nuevos Requerimientos</h3>
        <table class="ui table" id="tableReq">
            <thead >
            <tr>
                <th>Name</th>
                <th>Registration Date</th>
                <th>E-mail address</th>
                <th>Premium Plan</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>John Lilki</td>
                <td>September 14, 2013</td>
                <td>jhlilk22@yahoo.com</td>
                <td>No</td>
            </tr>
            <tr>
                <td>Jamie Harington</td>
                <td>January 11, 2014</td>
                <td>jamieharingonton@yahoo.com</td>
                <td>Yes</td>
            </tr>
            <tr>
                <td>Jill Lewis</td>
                <td>May 11, 2014</td>
                <td>jilsewris22@yahoo.com</td>
                <td>Yes</td>
            </tr>
            </tbody>
        </table>



    </div>
    <div class="eight wide column" data-styl="table">
        <h3>Aca va la tabla de ultimos traslados de productos</h3>
        <table class="ui table" id="tabla-mov-pro">
            <thead >
            <tr>
                <th>Name</th>
                <th>Registration Date</th>
                <th>E-mail address</th>
                <th>Premium Plan</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>John Lilki</td>
                <td>September 14, 2013</td>
                <td>jhlilk22@yahoo.com</td>
                <td>No</td>
            </tr>
            <tr>
                <td>Jamie Harington</td>
                <td>January 11, 2014</td>
                <td>jamieharingonton@yahoo.com</td>
                <td>Yes</td>
            </tr>
            <tr>
                <td>Jill Lewis</td>
                <td>May 11, 2014</td>
                <td>jilsewris22@yahoo.com</td>
                <td>Yes</td>
            </tr>
            </tbody>
        </table>
    </div>

</div>

<h4 class="ui horizontal header divider">
    <i class="bar chart icon"></i>
    Form Barras
</h4>
<br>

<div class="ui grid" >
    <br>
    <h2>Codigo de barras de las ultimas compras hechas </h2>
    <div class="sixteen wide colum" data-styl="table">
        <div id="myfirstchart" style="height: 250px;"></div>
    </div>
</div>


@stop