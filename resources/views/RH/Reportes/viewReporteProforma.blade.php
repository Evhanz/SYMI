@extends('layout')


@section('content-header')
    

    <div style="padding-left:5px;">
        <div class="bs-callout bs-callout-info" id="callout-type-dl-truncate">
            <h4>Módulo del Reportes - Proforma</h4>
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

                        <h3 class="box-title">Reporte de Gastos de la proforma</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body no-padding">
                        @if($proforma->tipo_moneda == 'soles')
                            <?php $moneda = 'S/' ?>
                        @else
                            <?php $moneda = '$' ?>
                        @endif
                        <div class="row">

                            <div class="col-lg-3">
                                <h3><strong>Numero:</strong> {{$proforma->numero}}</h3> 
                            </div>
                            
                            <div class="col-lg-3">
                                <h4>Descripción {{$proforma->descripcion}}</h4>
                            </div>
                            
                            <div class="col-lg-3">
                                <strong>Costo Proforma Hora Hombre</strong>
                                {{$moneda}}{{$proforma->monto_MO}}
                            </div>
                            <div class="col-lg-3">
                                <strong>Dias Proyectados</strong>
                                {{$proforma->n_dias}}

                            </div>

                        </div>

                        <h3>Detalle de trabajadores</h3>
                        <hr>
                        <div class="row" style="padding: 15px;">
                            <div class="table-responsive">
                                <table class="ui table" id="tableReq">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nombres</th>
                                            <th>Costo/Hora</th>
                                            <th>Horas Trabajadas</th>
                                            <th>Fecha</th>
                                            <th>Total {{$moneda}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $suma =0;$producto=0; ?>
                                    @foreach ($personalTareos as $personalTareo)
                                        <tr>
                                            <td>{{ $personalTareo->id }}</td>
                                            <td>{{ $personalTareo->persona->fullname}}</td>
                                            <td>{{ $personalTareo->costo_h }}</td>
                                            <td>{{ $personalTareo->h_trabajadas }}</td>
                                            <td>{{ $personalTareo->tareo->fecha}}</td>
                                            <?php $producto = $personalTareo->costo_h * $personalTareo->h_trabajadas;
                                            ?>
                                            <td><strong>{{$moneda}}</strong>{{$producto}} </td>
                                        </tr>
                                        <?php $suma+=$producto ?>
                                    @endforeach
                                    
                                    </tbody>
                                </table>
                            </div><!--/.table-responsive -->

                        </div><!-- /.row -->

                        <div class="pull-right">
                            
                            
                                <h2> Total Real:{{$moneda}}{{ $suma}}</h2>
                                <h2> Total De Proforma:{{$moneda}}{{ $proforma->monto_MO}}</h2>
                                <h2> Total De Ganancia:{{$moneda}}{{ $proforma->monto_MO-$suma}}</h2>
                            
                        </div>
                        </div>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <h3>Detalle de Avance</h3>
                        <hr>
                        <div class="row" style="padding: 15px;">
                            <div class="table-responsive">
                                <table class="ui table" id="tableReq">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Avance</th>
                                            <th>Fecha de Tareo - ID</th>
                                            

                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($proformaTareos as $proformaTareo)
                                        <tr>
                                            <td>{{$proformaTareo->id}}</td>
                                            <td>{{$proformaTareo->avance_ref}}</td>
                                            <td>{{$proformaTareo->tareo->fecha}} - 
                                            {{$proformaTareo->tareo->id}}</td>


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















@stop