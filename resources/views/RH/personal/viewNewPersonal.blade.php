@extends('layout')

@section('content')


    <div class="ui " data-styl="block-seccion">

        <div class="sixteen wide column" style="background-color: #FC6C6C;color: #ffffff">
            <h2>Módulo de Personal</h2>
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
        <form class="ui form" id="formulario" action="{{ URL::route('regPersonal') }}" method="post">
            <h4 class="ui dividing header"></h4>
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
            <div class="field">
                <label>Name</label>
                <div class="three fields">
                    <div class="field">
                        <input type="text" id="txtName" name="nombres" placeholder="Nombre"
                              value="{{{ $data['nombres'] or '' }}}"  required="required">
                    </div>
                    <div class="field">
                        <input type="text" name="apellidoP" id="txtApelidop" value="{{{ $data['apellidoP'] or '' }}}"
                               placeholder="Apellido Paterno" required="required">
                    </div>
                    <div class="field">
                        <input type="text" name="apellidoM" id="txtApelidom"  value="{{{ $data['apellidoM'] or '' }}}"
                               placeholder="Apellido Materno" required="required">
                    </div>
                </div>
            </div>


            <div class="field">
                <label>Datos de Ubicacion</label>
                <div class="three fields">
                    <div class=" field">
                        <input type="text" id="txtDni" name="dni" placeholder="DNI"
                               value="{{{ $data['dni'] or '' }}}" required="required">
                    </div>
                    <div class=" field">
                        <input type="text" id="txtCelular" name="celular" placeholder="Celular"
                               value="{{{ $data['celular'] or '' }}}" required="required">
                    </div>
                    <div class=" field">
                        <input type="number" id="txtCosto" name="costo_h" placeholder="Costo"
                               value="{{{ $data['costo_h'] or '' }}}" step="any" required="required">
                    </div>
                </div>
            </div>

            <div class="field">

                <div class="two fields">

                    <div class="field">
                        <label for="profesion">Profesion</label>
                        <select class="ui fluid search dropdown" name="profesion" id="sProfesion">
                            <option value="">Ninguno</option>
                            @foreach($profesiones as $profesion)
                                <option value="{{$profesion->id}}">{{$profesion->descripcion}}</option>
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