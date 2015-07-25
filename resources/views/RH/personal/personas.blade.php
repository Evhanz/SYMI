@extends('layout')

@section('content')

    <div class="ui grid" data-styl="block-seccion">

        <div class="sixteen wide column" style="background-color: #FC6C6C;color: #ffffff">
            <h2>Módulo del Personal</h2>
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
                        <label>Criterio</label>
                        <input id="txtCriterio" value="{{{ $criterio or ''}}}"
                               type="text" placeholder="First Name" style=" width: 427.9979991912842px;"
                               onKeyUp="this.value=this.value.toUpperCase();">
                    </div>
                    <div class="three wide field">
                        <label>DNI</label>
                        <input id="txtDNI" type="text" placeholder="DNI" value="{{{ $dni or ''}}}"
                                pattern="[0-9]{13,16}">
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
                <thead >
                <tr>
                    <th>Id</th>
                    <th>Nombre y Apellidos</th>
                    <th>Profesion</th>
                    <th>DNI</th>
                    <th>Opciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($personas as $persona)
                    <tr>
                        <td>{{ $persona->id }}</td>
                        <td>{{ $persona->fullname }}</td>
                        <td>{{ $persona->profesion->descripcion }}</td>
                        <td>{{ $persona->dni }}</td>

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
            <div  id="paginador">
                {!! $personas->setPath('')->render() !!}
            </div>



        </div>


    </div>


    <script>

        //eventos para javascript
        function aMayusculas(obj,id){
            obj = obj.toUpperCase();
            document.getElementById(id).value = obj;
        }



        //evento de los botones

        $(document).ready(function(){
            //evento al cargar input
            if( $('#txtDNI').val()=='0'){
                $('#txtDNI').val('')
            }
            if( $('#txtCriterio').val()=='&'){
                $('#txtCriterio').val('')
            }

            $('#btnNuevo').click(function(e){
                e.preventDefault();
                location.href='{{ URL::route('viewNewPersonal') }}';
            });


            $("#btnBuscar").click(function(e){

                e.preventDefault();
                var criterio = $('#txtCriterio').val().trim();
                var dni = $('#txtDNI').val().trim();


                if(dni.length<=0){
                    dni ='0';
                }

                if(criterio.length<=0){
                    criterio='&';
                }


                if(dni=='0' && criterio.trim().length<=0){


                    location.href='{{ URL::route('personal') }}';
                }else{

                    location.href='{{ URL::route('personalMod') }}/getBy/'+criterio+'-'+dni;
                }

            });


        });




    </script>






    <style>




        .pagination {
            display: inline-block;
            padding-left: 0;
            margin: 20px 0;
            border-radius: 4px;
        }
        .pagination>li {
            display: inline;
        }

        .pagination>li:first-child>a, .pagination>li:first-child>span {
            margin-left: 0;
            border-bottom-left-radius: 4px;
            border-top-left-radius: 4px;
        }
        .pagination>.disabled>span, .pagination>.disabled>span:hover, .pagination>.disabled>span:focus, .pagination>.disabled>a, .pagination>.disabled>a:hover, .pagination>.disabled>a:focus {
            color: #999;
            cursor: not-allowed;
            background-color: #fff;
            border-color: #ddd;
        }
        .pagination>li>a, .pagination>li>span {
            position: relative;
            float: left;
            padding: 6px 12px;
            margin-left: -1px;
            line-height: 1.428571429;
            text-decoration: none;
            background-color: #fff;
            border: 1px solid #ddd;
        }

        .pagination>.active>a, .pagination>.active>span, .pagination>.active>a:hover, .pagination>.active>span:hover,
        .pagination>.active>a:focus, .pagination>.active>span:focus {
            z-index: 2;
            color: #fff;
            cursor: default;
            background-color: #428bca;
            border-color: #428bca;
        }
        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0 0 0 0);
            border: 0;
        }
    </style>









@stop