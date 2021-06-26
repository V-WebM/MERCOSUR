@extends('layouts/app')
@section('titulo', "pais")

@section('content')


{{-- notificaciones --}}

@if (session('DUPLICADO'))
<script>
    $(function notificacion(){
    new PNotify({
        title:"DUPLICADO",
        type:"warning",
        text:"{{session('DUPLICADO')}}",
        styling:"bootstrap3"
    });		
});
</script>
@endif

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


<h4 class="text-center text-secondary">ACTUALIZAR PAIS</h4>

<div class="mb-0 col-12 bg-white p-5">
    @foreach ($sql as $item)
    <form action="{{route('pais.update',$item->id_pais)}}" method="POST">
        @csrf
        <div class="row">
            <input type="hidden" name="id" value="{{$item->id_pais}}">
            <div class="fl-flex-label mb-4 col-12">
                <input type="text" name="nombre" class="input input__text" id="nombre" placeholder="Nombres"
                    value="{{$item->nombre}}">
                    @error('nombre')
                        <small class="error error__text">{{$message}}</small>
                    @enderror
            </div>
            

            <div class="text-right mt-0">
                <a href="{{route('pais.index')}}" class="btn btn-rounded btn-secondary m-2">Atras</a>
                <button type="submit" class="btn btn-rounded btn-primary">Guardar</button>
            </div>
        </div>
        
    </form>
    @endforeach
</div>




@endsection