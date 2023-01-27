@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="card">
        <div class="card-body">
            <strong>Dereivados <h4>Bienvenido Administrador</h4></strong>
            <a href="{{ route('autor.create') }}" class="btn btn-outline-success float-right">
                Nueva derivacion
            </a>
        </div>
    </div>
@stop

@section('content')
<div class="card">
        <div class="card-body">
            <table class="table table-striped" id="deriva">
                <thead>
                    <tr>
                        <th scope="col">NRO</th>
                        <th scope="col">NOMBRE </th>
                        <th scope="col">APELLIDO</th>
                        <th scope="col">CORREO</th>
                        <th scope="col">OPCIONES</th>

                    </tr>
                </thead>
                <tbody>
                @foreach($autores as $item)
                    <tr>
                        <td>{{ $item->id}}</td>
                        <td>{{ $item->name}}</td>
                        <td>{{ $item->lastname}}</td>
                        <td>{{ $item->email}}</td>
                        <td>
                            <a href="{{ route('autor.edit', $item) }}"  class="btn btn-outline-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('autor.destroy', $item) }}" method="POST" class="form-eliminar">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
           
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">

    {{--Datatable css--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
@stop

@section('js')
    <script>
        function externoId( ){
            var id = document.getElementById('nro')
            console.log(id);
        }
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('eliminar')=='ok')
<script>
    Swal.fire(
            'Eliminado!',
            'la Persona ha sido eliminada.',
            'success'
            )
</script>    
@endif
<script>
    $('.form-eliminar').submit(function(e){
        e.preventDefault();
        Swal.fire({
        title: 'estas seguro?',
        text: "los datos de la persona, se eliminaran!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!',
        cancelButtonText:'Cancelar'
        }).then((result) => {
        if (result.isConfirmed) {
            
            this.submit()
        }
        })
    })
</script>
    <script> console.log('Hi!'); </script>
    {{--Datatables--}}
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>
    <script>
            $('#deriva').DataTable({
            responsive: true,
            autowidth: false,
            "language": {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "El registro no existe - disculpe",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "No records available",
                "infoFiltered": "(filtrado de _MAX_ registros totales)",
                "search": "Buscar:",
                "paginate":{
                    "next":"Siguiente",
                    "previous":"Anterior"
                }
            }
        });
    </script>
@stop