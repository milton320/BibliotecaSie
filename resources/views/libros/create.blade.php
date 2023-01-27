@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="card">
        <div class="card-body">
            <strong>REGISTRAR AUTOR</strong>
        </div>
    </div>

@stop

@section('content')
<div class="card">
    <div class="card-body">
               
        <form method="POST" action="{{ route('libros.store')}}">
        @csrf
            
            
            <div class="mb-3">
                <label for="title" class="form-label">titulo</label>
                <input type="text" class="form-control" id="title" name="title" aria-descr>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Categoria</label>
                <input type="text" class="form-control" id="category" name="category" aria-descr>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Direccion</label>
                <input type="text" class="form-control" id="address" name="address" aria-descr>
            </div>
            <div class="mb-3">
                <label for="autor_id" class="form-label">Autor</label>
                <select class="form-control" name="autor_id">
                    @foreach ($autor as $item)
                        <option value="{{ $item->id }}"  >{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
                   
            <br>
            
            <button type="submit" class="btn btn-success">REGISTRAR</button>
            <button type="submit" class="btn btn-primary">CANCELAR</button>
            
        </form>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop