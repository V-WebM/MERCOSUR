@extends('layouts/app')
@section('titulo', "pais")

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

<h4 class="text-center text-secondary">LISTA DE PAISES</h4>
<div class="pb-1 pt-2">
    <a href="{{route('pais.create')}}" class="btn btn-rounded btn-primary"><i class="fas fa-plus"></i>&nbsp;
        Registrar</a>
</div>


<section class="card">
    <div class="card-block">
        <table id="example" class="display table table-striped" cellspacing="0" width="100%">
            <thead class="table-primary">
                <tr>
                    <th>id</th>                    
                    <th>Nombre del pais</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($sql as $item)
                <tr>
                    <td>{{$item->id_pais}}</td>
                    <td>{{$item->nombre}}</td>                    
                    <td>
                        @if (Auth::user()->tipo==1)
                        <a style="top: 0" href="{{route('pais.edit',$item->id_pais)}}"
                            class="btn btn-sm btn-warning m-1"><i class="fas fa-edit"></i></a>
                        <form action="{{route('pais.destroy',$item->id_pais)}}" method="get"
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