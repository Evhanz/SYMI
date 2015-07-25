@extends('layout')

@section('content')


    <div class="ui grid" data-styl="block-seccion">

        <div class="sixteen wide column" style="background-color: #FF9A52;color: #ffffff">
            <h2>Módulo del Proformma - MY/ Proformas</h2>
        </div>
        <div class="sixteen wide column" >
            @if(Session::has('confirm'))

                <div class="ui success message">
                    <div class="header">Perfecto!!</div>
                    <i class="fa fa-info-circle"></i>  <strong>{{ Session::get('confirm') }}</strong>
                </div>

            @endif
            @if(Session::has('fail'))
                <div class="ui success message">
                    <div class="header">Error: </div>
                    <i class="fa fa-info-circle"></i>  <strong>{{ Session::get('fail') }}</strong>
                </div>
            @endif
        </div>

        <div class="sixteen wide column">
            <div class="ui form">
                <div class="inline fields">
                    <div class="seven wide field">
                        <label>Numero</label>
                        <input id="txtNumero" value="{{{ $numero or ''}}}"
                               type="text"  style=" width: 427.9979991912842px;" class="input-form" >
                    </div>
                    <div class="two wide field">
                        <button class="ui teal button" id="btnBuscar">
                            <i class="search icon"></i>
                            Buscar
                        </button>
                    </div>

                    <div class="three wide field">
                        <button class="ui positive button" style="width: 100%" id="btnNuevo">
                            <i class="add user icon"></i>
                            Nuevo
                        </button>
                    </div>

                </div>
            </div>
        </div>


        <div class="sixteen wide column" data-styl="table">

            <table class="ui table" id="tableReq">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Numero</th>
                    <th>Descripcion</th>
                    <th>Opciones</th>

                </tr>
                </thead>
                <tbody>
                @foreach ($proformas as $proforma)
                    <tr>
                        <td>{{ $proforma->id }}</td>
                        <td>{{ $proforma->numero }}</td>
                        <td>{{ $proforma->descripcion}}</td>

                        <td>
                            <div class="ui icon buttons">
                                <button class="ui blue button">
                                    Editar<i class="edit icon"></i>
                                </button>
                                <button class="ui red button">
                                    Eliminar<i class="remove icon"></i>
                                </button>

                            </div>
                        </td>

                    </tr>
                @endforeach



                </tbody>

            </table>
        </div>
    </div>



    <!-- Modal de Registro-->
    <div class="ui modal">
        <div class="header">Registro de Profesión</div>
        <div class="content">
            <form class="ui form" action="{{ URL::route('regProfesion') }}" method="post">
                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                <div class="field">
                    <label >Descripción</label>
                    <input class="input-form" type="text" name="descripcion" placeholder="Descripcion" required>
                </div>
                <div class="field">
                    <label >Observación</label>
                    <input class="input-form" type="text" name="observacion" placeholder="Descripcion" required>
                </div>
                <button class="ui primary button" type="submit">Registrar</button>
            </form>
        </div>
    </div>




    <script>



    </script>
@stop