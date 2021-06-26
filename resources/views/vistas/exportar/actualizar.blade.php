@extends('layouts/app')
@section('titulo', "exportar")

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
    <form action="{{route('exportar.update',$item->id_exportar)}}" method="POST">
        @csrf
        <div class="row">

            <input type="hidden" name="id" value="{{$item->id_exportar}}">

            <div class="fl-flex-label mb-4 col-12">
                <select name="pais1" class="input input__select">
                    <option value="">Pais de origen...</option>
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
                <select name="producto" class="input input__select">
                    <option value="">Seleccionar producto...</option>
                    @foreach ($producto as $i)
                    <option {{ $item->producto == $i->id_producto ? 'selected' : '' }} value="{{$i->id_producto}}">{{$i->nombre}}</option>
                    @endforeach
                </select>
                @error('producto')
                <small class="error error__text">{{$message}}</small>
                @enderror
            </div>

            <div class="fl-flex-label mb-4 col-12">
                <select name="pais2" class="input input__select">
                    <option value="">Pais de destino...</option>
                    @foreach ($pais as $ite)
                    <option {{ $item->pais2 == $ite->id_pais ? 'selected' : '' }} value="{{$ite->id_pais}}">
                        {{$ite->nombre}}</option>
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
    @endforeach
</div>




@endsection