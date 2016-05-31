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
            <h4>Módulo del Personal - Personal</h4>
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

                        <h3 class="box-title">Lista de Ordenes de Servicio</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body ">
                        <div class="row">
                            <div class="col-lg-12">
                                <form class="form-inline">
                                    <div class="form-group">
                                        <label>Descripcion</label>
                                        <input id="txtDescripcion" value="{{ $descripcion or ''}}" type="text" class="form-control" placeholder="First Name"  onKeyUp="this.value=this.value.toUpperCase();">
                                    </div>
                                    <div class="form-group">
                                        <label>N° orden</label>
                                        <input id="txtDNI"  class="form-control" type="text" placeholder="DNI" value="{{ $numero or ''}}" pattern="[0-9]{13,16}">
                                    </div>
                                    <div class="form-group" style="float:right;">
                                        <button  class="btn btn-info" id="btnBuscar">
                                            <i class="fa fa-search"></i>
                                            Buscar
                                        </button>
                                        <button id="btnNuevo" class="btn btn-success"><i class="fa fa-user-plus"></i>Nuevo</button>
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
                                        <th>Descripcion</th>
                                        <th>N° Orden</th>
                                        <th>N° Pedido</th>
                                        <th>Monto</th>
                                        <th colspan="3">Opciones</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($os as $i)
                                        <tr>
                                            <td>{{ $i->id }}</td>
                                            <td>{{ $i->descripcion }}</td>
                                            <td>{{ $i->numero }}</td>
                                            <td>{{ $i->n_pedido }}</td>
                                            <td>{{ $i->monto }}</td>
                                            <td>
                                                <button onclick="showDataPerson()" class="btn btn-default">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </td>
                                            <td>
                                                <a href="" class="btn btn-warning">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <button class="btn btn-danger">
                                                    <i class="fa fa-times" ></i>
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



    <div class="modal fade" tabindex="-1" role="dialog" id="viewInfo">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Modal title</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            Foto
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-12">
                                    Nombres
                                    <input id="txtNombres" type="text" class="form-control" readonly>
                                </div>
                                <div class="col-lg-6">
                                    DNI
                                    <input id="txtDni" type="text" class="form-control" readonly>
                                </div>
                                <div class="col-lg-6">
                                    Telefono
                                    <input id="txtTelefono" type="text" class="form-control" readonly>
                                </div>
                                <div class="col-lg-6">
                                    Fotocheck
                                    <input id="txtFotocheck" type="text" class="form-control" readonly>
                                </div>
                                <div class="col-lg-6">

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->




    <script>

        //eventos para javascript
        function aMayusculas(obj,id){
            obj = obj.toUpperCase();
            document.getElementById(id).value = obj;
        }

        function changeStatePerson(id){

            $.get( "{{ URL::route('personalMod') }}"+"/changeState/"+id, function( data ) {

                var  estado = $("#btnEstado"+id).attr("data-estado");
                cambiar_estado(estado,id);

                alert('Se cambio el estado Correctamente');
                console.log(data);
            });

        }


        function cambiar_estado(estado,id){


            switch (estado){

                case "true" :
                    $("#btnEstado"+id).attr("data-estado","false");
                    $("#btnEstado"+id).attr('class', 'btn btn-danger');
                    $("#btnEstado"+id).children("i").attr("class","fa fa-times");

                    break;
                case "false" :
                    $("#btnEstado"+id).attr("data-estado","true");
                    $("#btnEstado"+id).attr('class', 'btn btn-success');
                    $("#btnEstado"+id).children("i").attr("class","fa fa-check-square-o");

                    break;
            }
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
                location.href='{{ URL::route('viewNewOS') }}';
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

        function showDataPerson(id){


            $.get( "{{route('personalMod')}}/get/"+id, function( data ) {

                // console.log(data);

                var persona = {
                    nombres:data.nombres+" "+data.apellidoP+" "+data.apellidoM,
                    dni:data.dni,
                    telefono:data.celular,
                    fotocheck:data.fotocheck

                };

                cargarDataModel(persona);

            });

            $('#viewInfo').modal('show');



        }

        function cargarDataModel(persona){

            $('#txtNombres').val(persona.nombres);
            $('#txtDni').val(persona.dni);
            $('#txtTelefono').val(persona.telefono);
            $('#txtFotocheck').val(persona.fotocheck);

        }




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