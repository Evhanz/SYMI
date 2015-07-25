@extends('layout')

@section('content')


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
            <h4 class="ui dividing header"></h4>
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
                        <input type="text" name="descripcion"  value="{{{ $data['apellidoP'] or '' }}}"
                               placeholder="Descripcion" required="required">
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





        });




    </script>


@stop