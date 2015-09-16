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
            <h4>Módulo del Proformas </h4>
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

                        <h3 class="box-title">Lista de Todo el personal</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body no-padding">
                        <div class="row">
                            <div class="col-lg-12">
                                <form class="form-inline">
                                    <div class="form-group">
                                       <label>Numero</label>
                                        <input id="txtNumero" value="{{{ $numero or ''}}}" type="text"  style=" width: 427.9979991912842px;" class="form-control" >
                                    </div>
                                    <div class="form-group" >
                                        <button  class="btn btn-info" id="btnBuscar">
                                            <i class="fa fa-search"></i>
                                                Buscar
                                        </button>
                                        
                                    </div>
                                    <div class="form-group">
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
                                <table class="ui table" id="tableReq">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Numero</th>
                                            <th>Descripcion</th>
                                            <th>Area</th>
                                            <th colspan="2">Opciones</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($proformas as $proforma)
                                        <tr>
                                            <td>{{ $proforma->id }}</td>
                                            <td>{{ $proforma->numero }}</td>
                                            <td>{{ $proforma->descripcion}}</td>
                                            <td>{{ $proforma->area->descripcion}}</td>
                                            <td>
                                                <a href="{{ URL::route('ViewUpdateProforma',array('id'=>$proforma->id))}}" class="btn btn-warning">
                                                        Editar<i class="edit icon"></i>
                                                </a>    
                                            </td>
                                            <td>
                                                <button class="btn btn-danger">
                                                        Eliminar<i class="remove icon"></i>
                                                    </button>
                                            </td>

                                        </tr>
                                    @endforeach
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
    </div><!-- /.content-->


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