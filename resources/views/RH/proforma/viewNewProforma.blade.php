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
            <h4>Módulo del Proforma</h4>
        </div>
    </div>

@stop

@section('content')

    <div class="content">
        <div class="row"><!--Mesaje de errores-->
            @if(isset($errors))
                @if (count($errors) > 0)
                    <div  id="alert-danger" class="alert alert-danger alert-dismissible" role="alert">
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
                <div class="box box-info">
                    <div class="box-header">
                        <!-- tools box -->
                        <div class="pull-right box-tools">
                            <button class="btn btn-danger btn-sm refresh-btn" data-toggle="tooltip" title="Reload"><i class="fa fa-refresh"></i></button>
                        </div><!-- /. tools -->
                        <i class="fa fa-cloud"></i>

                        <h3 class="box-title">Formulario de Registro</h3>

                    </div><!-- /.box-header -->
                    <div class="box-body ">
                        <form class="ui form" enctype="multipart/form-data" id="formulario" action="{{ URL::route('regProforma') }}"method="post">
                            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>Número de MY</label>
                                    <input class="form-control" type="text"  name="numero" placeholder="Número" required="required">
                                </div>
                                <div class="col-lg-4">
                                    <label>Descripción</label>
                                    <input type="text" name="descripcion" class="form-control" placeholder="Descripcion" required="required">
                                    
                                </div>
                                <div class="col-lg-4">
                                    <label>Fecha de Aprobación</label>
                                    <input type="date" name="f_inicio" class="form-control" required="required">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>Monto Horas Hombre</label>
                                    <input class="form-control" type="number" name="monto_MO" step="any" required="required">
                                </div>
                                <div class="col-lg-4">
                                    <label>Monto de Maquinarias y Equipos</label>
                                    <input class="form-control" type="number" name="maquinaria_equipo" step="any" required="required">

                                </div>
                                <div class="col-lg-4">
                                    <label>Monto de Materiales(Consumibles)</label>
                                    <input class="form-control" type="number"  name="materiales" step="any" required="required">

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>Utilidad</label>
                                    <input class="form-control" type="number" name="utilidad" step="any" required="required">


                                </div>
                                <div class="col-lg-4">
                                    <label>Área</label>
                                    <select class="form-control" name="area" id="sArea">
                                        <option value="">Ninguno</option>
                                        @foreach($areas as $area)
                                            <option value="{{$area->id}}">{{$area->descripcion}}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="col-lg-4">
                                    <label>Tipo de Moneda</label>
                                    <select class="form-control" name="tipo_moneda" id="tipo_moneda" required="required">
                                        <option value="">-----</option>
                                        <option value="dolares">$.- Dolares </option>
                                        <option value="soles">S/ .- Soles</option>
                                    </select>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <label for="">Horas Proformadas</label>
                                    <input name="h_proformadas" id="h_proformadas" type="number" class="form-control" step="any">
                                </div>

                                <div class="col-lg-4">
                                    <label>Dias Proyectados</label>
                                    <input class="form-control" type="number"  name="n_dias" step="any" required="required">
                                </div>

                                <div class="col-lg-4">
                                    <label for="">Subir Adjunto</label>
                                    <input type="file" class="form-control" name="adjunto" >
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



    <!--
    <div class="ui " data-styl="block-seccion">

        <div class="sixteen wide column" style="background-color: #FC6C6C;color: #ffffff">
            <h2>Formulario de Registro</h2>
        </div>
        @if(isset($errors))
            @if (count($errors) > 0)
                <div class="ui error message">
                    <div class="header">Error</div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        @endif
        <form class="ui form" id="formulario" action="{{ URL::route('regProforma') }}" method="post">
            <h4 class="ui <di></di>viding header"></h4>
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
            <div class="field">
                <div class="fields">
                    <div class="four wide field">
                        <label>Número</label>
                        <input type="text"  name="numero" placeholder="Número"
                               value="{{{ $data['nombres'] or '' }}}"  required="required">
                    </div>
                    <div class="twelve wide field">
                        <label>Descripcion</label>
                        <input type="text" name="descripcion"  value="{{{ $data['apellidoP'] or '' }}}" placeholder="Descripcion" required="required">
                    </div>

                </div>
            </div>
            <div class="field">
                <div class="fields">
                    <div class="four wide field">
                        <label>Fecha de Aprobación</label>
                        <input type="date" name="f_inicio" value="{{{ $data['dni'] or '' }}}" required="required">
                    </div>
                    <div class=" field">
                        <label>Monto Horas Hombre</label>
                        <div class="ui labeled input">
                            <div class="ui label">
                                $.
                            </div>
                            <input type="number" name="monto_MO" step="any"
                                   value="{{{ $data['celular'] or '' }}}" required="required">
                        </div>

                    </div>
                    <div class=" field">
                        <label>Dias Proyectados</label>
                        <input type="number"  name="n_dias" value="{{{ $data['costo_h'] or '' }}}"
                               step="any" required="required">
                    </div>
                    <div class=" field">
                        <label>Área</label>
                        <select class="ui fluid search dropdown" name="area" id="sArea">
                            <option value="">Ninguno</option>
                            @foreach($areas as $area)
                                <option value="{{$area->id}}">{{$area->descripcion}}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
            </div>



            <br/>
            <div class="field">
                <button class="ui teal button" id="btnGuardar" >
                    <i class="save icon"></i>
                    Guardar
                </button>
            </div>
        </form>
    </div>
    -->




    <script>

        $(document).ready(function(){


            $('#btnGuardar').attr("disabled", true);


            $( "#sArea" ).change(function() {

                var valProfesion = this.value;
                if(valProfesion>="1"){
                    $('#btnGuardar').attr("disabled", false);
                }else
                    $('#btnGuardar').attr("disabled", true);
            });



        });


    </script>



@stop