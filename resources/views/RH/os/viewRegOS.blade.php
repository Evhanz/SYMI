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
            <h4>Módulo de Orden de Servicio</h4>
        </div>
    </div>

@stop

@section('content')


    <div class="content"  ng-app="app" ng-controller="MainController">
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
                <div class="box box-success">
                    <div class="box-header">
                        <!-- tools box -->
                        <div class="pull-right box-tools">
                            <button class="btn btn-danger btn-sm refresh-btn" data-toggle="tooltip" title="Reload"><i class="fa fa-refresh"></i></button>
                        </div><!-- /. tools -->
                        <i class="fa fa-cloud"></i>

                        <h3 class="box-title">Formulario de Registro</h3>

                    </div><!-- /.box-header -->
                    <div class="box-body ">
                        <form class="ui form" id="formularioReg" enctype="multipart/form-data" action=""
                              method="post" >
                            <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}" />
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>Descripcion:</label>
                                    <input class="form-control" type="text" id="txtDescripcion" name="descripcion" placeholder="descripcion" value="{{{ $data['nombres'] or '' }}}"  required="required">
                                </div>
                                <div class="col-lg-4">
                                    <label>Numero OS:</label>
                                    <input class="form-control" type="text" name="numero" id="txtNumero" value="{{{ $data['apellidoP'] or '' }}}"  required="required">
                                </div>
                                <div class="col-lg-4">
                                    <label for="">N° de pedido:</label>
                                    <input class="form-control" type="text" name="n_pedido" id="txtN_pedido"  value="{{{ $data['apellidoM'] or '' }}}" required="required">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label for="">Monto </label>
                                    <input class="form-control" type="number" id="txtMonto" name="monto"  value="{{{ $data['doc_identidad'] or '' }}}" required="required">
                                </div>
                                <div class="col-lg-4">
                                    <label for="">Color</label>
                                    <input class="form-control" type="color" id="txtColor" name="color" placeholder="" value="{{{ $data['fecha_nacimiento'] or '' }}}" required="required">
                                </div>
                                <div class="col-lg-4">
                                    <label for="">Observacion:</label>
                                    <input class="form-control" type="text" id="txtObservacion" name="observacion" placeholder="" value="{{{ $data['correo'] or '' }}}" required="required">
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label for="">Adjunto</label>
                                    <input type="file" class="form-control" id="adjunto" name="adjunto" >
                                </div>
                                <div class="col-lg-6">
                                    <label for="">Proformas</label>
                                    <tags-input  on-tag-added="tagAdded($tag)"  ng-model="proformas" class="bootstrap"></tags-input>
                                </div>
                            </div>
                            <div class="row">



                                <div class="col-lg-4">


                                    <!-- <p>Model: @{{tags}}</p> -->



                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <br>
                                    <button   class="btn btn-success" id="btnGuardar" >
                                        <i class="save icon"></i>
                                        Guardar
                                    </button>
                                </div>
                                <div class="col-lg-4"></div>
                                <div class="col-lg-4">

                                </div>
                            </div>

                        </form>
                    </div><!-- /.box-body -->
                </div><!--/.box -->
            </div><!--col-lg-12-->
        </div><!--/row form-->
    </div>

    <script>

        var app = angular.module("app",['ngTagsInput']);
        app.controller("MainController", function($scope,$http,$window) {


            $scope.proformas=[];

           $scope.tagAdded = function (tag) {

               //console.log(tag);
                /*
               if(tag.text=='asdf'){
                   delete $scope.proformas.pop();
                   alert('Proforma no existe');

               }
                */
               //console.log(tag);

               $.post( "{{URL::route('hGetProformaById')}}", { _token:$('#_token').val(),id: tag.text})
                       .done(function( data ) {
                           if(data.id < 1 || data.id ==null){
                               delete $scope.proformas.pop();
                               console.log(data);
                               alert('Proforma no existe');
                           }
                       }).error(function(data){
                   delete $scope.proformas.pop();
                   alert('Entro al error Proforma no existe');
               });


           };

            $( "#formularioReg" ).submit(function( event ) {

                event.preventDefault();

                $scope.enviar_data();

            });


            $scope.enviar_data = function enviar_data(){


                var proformas = [];

                angular.forEach($scope.proformas,function(item){

                    var text = item.text;

                    proformas.push(text);
                });



                var formData = new FormData();

                formData.append('_token',$('#_token').val());
                formData.append('proformas',proformas);

                formData.append('descripcion', $('#txtDescripcion').val());
                formData.append('numero', $('#txtNumero').val());
                formData.append('n_pedido', $('#txtN_pedido').val());
                formData.append('tipo', 'nuevo');
                formData.append('monto', $('#txtMonto').val());
                formData.append('color', $('#txtColor').val());
                formData.append('observacion', $('#txtObservacion').val());


                formData.append('adjunto', document.getElementById("adjunto").files[0]);


                $.ajax({
                    url         :   '{{URL::route('regOS')}}',  //mention valid url
                    cache       :   false,
                    contentType :   false,
                    processData :   false,
                    data        :   formData,
                    type        :   'post',
                    success     :   function(data){
                        //console.log(data);

                        if(data == 'ok'){
                            alert('Datos Correctos');
                            location.href='{{ URL::route('viewAllOS') }}';
                        }else{
                            alert('A ingresado datos incorrectos');
                            console.log(data);
                        }

                    }

                });


            };





        });

        $(document).ready(function(){









        });




    </script>


@stop