@extends('Layouts/logisticaLayout')

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

                        <h3 class="box-title">Lista de Todo el personal</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body ">

                       <div class="row">
                           <div class="col-lg-12">
                               <form method="post" action="{{route('importarDatos')}}" accept-charset="UTF-8" enctype="multipart/form-data">
                                   <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                   <div class="form-group">

                                       <div class="col-md-6">

                                           <input type="file" class="form-control" name="file" >
                                       </div>

                                       <div class="col-md-4">
                                           <button type="submit" class="btn btn-primary">Enviar</button>
                                       </div>
                                   </div>



                               </form>
                           </div>
                       </div>


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