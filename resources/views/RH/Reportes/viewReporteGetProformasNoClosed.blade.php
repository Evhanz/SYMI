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



                        <div id="bar-example"></div>



                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <div  id="paginador">

                        </div>
                    </div><!-- /.box-footer -->
                </div><!-- /.box -->
            </div>
        </div>
    </div><!-- /.content-->




    <!-- css morris style -->
    <link href="{{asset('js/morris/morris.css')}}" rel="stylesheet" type="text/css" />
    <!-- raphael JS -->
    <script src="{{ asset('js/morris/raphael-min.js')}}"></script>
    <!-- morris JS -->
    <script src="{{ asset('js/morris/morris.min.js')}}"></script>


    <script>
        /*


        */


        $.getJSON( "{{URL::route('getProformaNoClosed')}}", function( data ) {


            Morris.Bar({
                element: 'bar-example',
                data:data,
                xkey: 'numero',
                ykeys: ['avance'],
                labels: ['Avance', 'Series B']
            });


        }).error(function(error){
            console.log(error);
        });


    </script>

@stop