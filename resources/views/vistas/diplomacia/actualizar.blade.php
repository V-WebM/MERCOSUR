@extends('layouts/app')
@section('titulo', "diplomacia")

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

@if (session('AVISO'))
<script>
    $(function notificacion(){
    new PNotify({
        title:"AVISO",
        type:"error",
        text:"{{session('AVISO')}}",
        styling:"bootstrap3"
    });		
});
</script>
@endif


<h4 class="text-center text-secondary">ACTUALIZAR DIPLOMACIAS(acuerdos)</h4>

<div class="mb-0 col-12 bg-white p-5">
    @foreach ($sql as $item)
    <form action="{{route('diplomacias.update',$item->id_diplomacia)}}" method="POST">
        @csrf
        <div class="row">

            <input type="hidden" name="id" value="{{$item->id_diplomacia}}">

            <div class="fl-flex-label mb-4 col-12">
                <select name="pais1" class="input input__select">
                    <option value="">Selecciona un pais...</option>
                    @foreach ($pais as $ite)
                    <option {{ $item->pais1 == $ite->id_pais ? 'selected' : '' }} value="{{$ite->id_pais}}">
                        {{$ite->nombre}}</option>
                    @endforeach
                </select>
                @error('pais1')
                <small class="error error__text">{{$message}}</small>
                @enderror
            </div>

            <div class="fl-flex-label mb-4 col-12">
                <select name="pais2" class="input input__select">
                    <option value="">Selecciona un pais...</option>
                    @foreach ($pais as $ite)
                    <option {{ $item->pais2 == $ite->id_pais ? 'selected' : '' }} value="{{$ite->id_pais}}">
                        {{$ite->nombre}}</option>
                    @endforeach
                </select>
                @error('pais2')
                <small class="error error__text">{{$message}}</small>
                @enderror
            </div>


            <div class="fl-flex-label mb-4 col-12">
                <input type="date" name="fecha" class="input input__text" id="nombre"
                    value="{{$item->fecha}}">
                @error('nombre')
                <small class="error error__text">{{$message}}</small>
                @enderror
            </div>


            <div class="text-right mt-0">
                <a href="{{route('diplomacias.index')}}" class="btn btn-rounded btn-secondary m-2">Atras</a>
                <button type="submit" class="btn btn-rounded btn-primary">Guardar</button>
            </div>
        </div>

    </form>
    @endforeach
</div>




@endsection