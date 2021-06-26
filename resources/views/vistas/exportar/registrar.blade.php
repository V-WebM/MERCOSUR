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

<h4 class="text-center text-secondary">REGISTRO DE EXPORTACION</h4>

<div class="mb-0 col-12 bg-white p-5">
    <form action="{{route('exportar.store')}}" method="POST">
        @csrf
        <div class="row">

            <div class="fl-flex-label mb-4 col-12">
                <select name="pais1" class="input input__select">
                    <option value="">Pais de origen...</option>
                    @foreach ($sql as $item)
                    <option {{old('pais1') == $item->id_pais ? 'selected' : ''}} value="{{$item->id_pais}}">{{$item->nombre}}</option>
                    @endforeach
                </select>
                @error('pais1')
                <small class="error error__text">{{$message}}</small>
                @enderror
            </div>

            

            <div class="fl-flex-label mb-4 col-12">
                <select name="producto" class="input input__select">
                    <option value="">Seleccionar producto...</option>
                    @foreach ($producto as $item)
                    <option {{old('producto') == $item->id_producto ? 'selected' : ''}} value="{{$item->id_producto}}">{{$item->nombre}}</option>
                    @endforeach
                </select>
                @error('producto')
                <small class="error error__text">{{$message}}</small>
                @enderror
            </div>


            <div class="fl-flex-label mb-4 col-12">
                <select name="pais2" class="input input__select">
                    <option value="">Pais de destino...</option>
                    @foreach ($sql as $item)
                    <option {{old('pais2') == $item->id_pais ? 'selected' : ''}} value="{{$item->id_pais}}">{{$item->nombre}}</option>
                    @endforeach
                </select>
                @error('pais2')
                <small class="error error__text">{{$message}}</small>
                @enderror
            </div>

            


            <div class="text-right mt-0">
                <a href="{{route('exportar.index')}}" class="btn btn-rounded btn-secondary m-2">Atras</a>
                <button type="submit" class="btn btn-rounded btn-primary">Guardar</button>
            </div>
        </div>

    </form>
</div>




@endsection