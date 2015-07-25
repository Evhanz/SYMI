@extends('layout')

@section('content')


    <div class="ui " data-styl="block-seccion" >

        <div class="sixteen wide column" style="background-color: #FC6C6C;color: #ffffff">
            <h2>Asignaciones de Area:</h2>
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
        <br/><br/>

        <div class="sixteen wide column" >
            <h1>Area: {{$area->descripcion}}</h1>
        </div>

        <form class="ui form" id="formulario" ng-app="app" ng-controller="appCtrl as vm"
              action="{{ URL::route('regPersonal') }}" method="post">
            <h4 class="ui dividing header"></h4>
            <input type="hidden"  name="_token" value="{{{ csrf_token() }}}"  />
            <div class="fields">
                <div class="field">
                    <label>DNI</label>
                </div>
                <div class=" field">
                    <input type="text"  id="txtDNI"  ng-model="vm.dni"
                            required="required">
                </div>
                <div class=" field">
                    <a class="ui blue button"  id="btnBuscarPersonal" ng-click="vm.buscarPersonal()">
                        <i class="search icon"></i>
                        Buscar
                    </a>
                </div>
                <div class="ten wide field">
                    <input type="text"  name="n_dias" ng-model="vm.personal"
                           disabled>
                </div>
            </div>

            <div class="field">
                <button class="ui teal button" id="btnGuardar" >
                    <i class="save icon"></i>
                    Asignar
                </button>
            </div>
        </form>


        <h1> Hola @{{nombre}} </h1>
        <form>
            ¿Cómo te llamas? <input type="text" ng-model="nombre">
        </form>


    </div>




    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.23/angular.min.js"></script>
    <script>



        angular.module('app', []).controller('appCtrl', ['$http', controladorPrincipal]);


        function controladorPrincipal($http){

            /*declaraciones de inicio*/
            var vm=this;
            var token = $('input[name="_token"]').attr('value');

            /*inicio*/
            vm.personal ="Ingrese DNI";

            /*funciones*/
            vm.buscarPersonal = function(){
                datos ={
                    '_token': token,
                    'dni':vm.dni
                };
                $http.post('{{ URL::route('hGetPersonalByDNI') }}', datos)
                        .success(function(data){
                            console.log(data);
                            vm.personal=data.nombres+data.apellidoP;
                            //por supuesto podrás volcar la respuesta al modelo con algo como vm.res = res;
                        }).error(function(data){
                            alert('error:'+data);
                        });
            }






        }



        /*


        se comenta para probar AJAX con Angular


        $('#btnBuscarPersonal').click(function(e){

            e.preventDefault();

            var _token = $('input[name=_token]').val();
            var dni = $('#txtDNI').val();


            $.post( "{{ URL::route('hGetPersonalByDNI') }}",
                    { _token:_token,
                        dni: dni
                    })
            .done(function( data ){
                alert( "Data Loaded: " + data );
            });

        });
        */

    </script>


@stop