@extends('layouts/app')
@section('titulo', "exportar")

@section('content')

{{-- notificaciones --}}


@if (session('CORRECTO'))
<script>
    $(function notificacion(){
    new PNotify({
        title:"CORRECTO",
        type:"success",
        text:"{{session('CORRECTO')}}",
        styling:"bootstrap3"
    });		
});
</script>
@endif



@if (session('INCORRECTO'))
<script>
    $(function notificacion(){
    new PNotify({
        title:"INCORRECTO",
        type:"error",
        text:"{{session('INCORRECTO')}}",
        styling:"bootstrap3"
    });		
});
</script>
@endif

<h4 class="text-center text-secondary">LISTA DE EXPORTACIONES</h4>
<div class="pb-1 pt-2">
    <a href="{{route('exportar.create')}}" class="btn btn-rounded btn-primary"><i class="fas fa-plus"></i>&nbsp;
        Registrar</a>
</div>


<section class="card">
    <div class="card-block">
        <table id="example" class="display table table-striped" cellspacing="0" width="100%">
            <thead class="table-primary">
                <tr>
                    <th>id</th>
                    <th>Pais de origen</th>
                    <th>Producto</th>
                    <th>Pais de destino</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($sql as $item)
                <tr>
                    <td>{{$item->id_exportar}}</td>
                    <td>
                        @foreach ($pais as $ite)
                        @if ($ite->id_pais == $item->pais1)
                        {{$ite->nombre}}
                        @endif
                        @endforeach
                    </td>

                    <td>
                        @foreach ($producto as $it)
                        @if ($it->id_producto == $item->producto)
                        {{$it->nombre}}
                    </td>
                    <td>
                        @foreach ($pais as $ite)
                        @if ($ite->id_pais == $item->pais2)
                        {{$ite->nombre}}
                        @endif
                        @endforeach
                    </td>
                    @endif
                    @endforeach
                    <td>
                        @if (Auth::user()->tipo==1)
                        <a style="top: 0" href="{{route('exportar.edit',$item->id_exportar)}}"
                            class="btn btn-sm btn-warning m-1"><i class="fas fa-edit"></i></a>
                        <form action="{{route('exportar.destroy',$item->id_exportar)}}" method="get"
                            class="d-inline formulario-eliminar">
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                        @else
                        <div class="text-danger">sin accion</div>
                        @endif
                    </td>

                </tr>

                @endforeach
            </tbody>
        </table>
    </div>
</section>

@endsection