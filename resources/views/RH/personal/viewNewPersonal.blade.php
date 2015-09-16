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
            <h4>Módulo del Personal- Formulario de Registro</h4>
        </div>
    </div>

@stop

@section('content')


    <div class="content">
        <div class="row"><!--Mesaje de errores-->
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
        </div><!--/ end error messages -->
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
                        <form class="ui form" id="formulario" action="{{ URL::route('regPersonal') }}" method="post">
                            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>Nombres:</label>
                                    <input class="form-control" type="text" id="txtName" name="nombres" placeholder="Nombre" value="{{{ $data['nombres'] or '' }}}"  required="required">
                                </div>
                                <div class="col-lg-4">
                                    <label>Apellido Paterno:</label>
                                    <input class="form-control"type="text" name="apellidoP" id="txtApelidop" value="{{{ $data['apellidoP'] or '' }}}" placeholder="Apellido Paterno" required="required">
                                    
                                </div>
                                <div class="col-lg-4">
                                    <label for="">Apellido Materno:</label>
                                    <input class="form-control" type="text" name="apellidoM" id="txtApelidom"  value="{{{ $data['apellidoM'] or '' }}}" placeholder="Apellido Materno" required="required">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label for="">DNI:</label>
                                    <input class="form-control" type="text" id="txtDni" name="dni" placeholder="DNI" value="{{{ $data['dni'] or '' }}}" required="required">
                                </div>
                                <div class="col-lg-4">
                                    <label for="">Celular:</label>
                                    <input class="form-control" type="text" id="txtCelular" name="celular" placeholder="Celular" value="{{{ $data['celular'] or '' }}}" required="required">
                                </div>
                                <div class="col-lg-4">
                                    <label for="">Costo por Hora:</label>
                                    <input class="form-control" type="number" id="txtCosto" name="costo_h" placeholder="Costo por hora" value="{{{ $data['costo_h'] or '' }}}" step="any" required="required">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label for="profesion">fotocheck</label>
                                    <input class="form-control" type="number" name="fotocheck" value="{{{ $data['fotocheck'] or '' }}}" required="required">
                                </div>
                                <div class="col-lg-4">
                                    <label for="profesion">Profesion</label>
                                    <select class="ui fluid search dropdown" name="profesion" id="sProfesion">
                                        <option value="">Ninguno</option>
                                        @foreach($profesiones as $profesion)
                                            <option value="{{$profesion->id}}">{{$profesion->descripcion}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <br>
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
        </div><!--/row form-->
    </div>

    <script>

        $(document).ready(function(){


            $('#btnGuardar').attr("disabled", true);


            $( "#sProfesion" ).change(function() {

                var valProfesion = this.value;
                if(valProfesion>="1"){
                    $('#btnGuardar').attr("disabled", false);
                }else
                    $('#btnGuardar').attr("disabled", true);
            });



        });




    </script>


@stop