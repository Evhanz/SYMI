@extends('layout')


@section('content-header')
    

    <div style="padding-left:5px;">
        <div class="bs-callout bs-callout-info" id="callout-type-dl-truncate">
            <h4>Módulo del Reportes - Personal por hora</h4>
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

                        <h3 class="box-title">Reporte de horas trabajadas  </h3>
                    </div><!-- /.box-header -->
                    <div class="box-body no-padding">
                        
                        <div class="row">
                            <div class="col-lg-12">
                                <h3><strong>Persona:</strong> {{$personal->fullname}}</h3> 
                            </div>
                        </div>

                        <h3>Detalle de Horas</h3>
                        <hr>
                        


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