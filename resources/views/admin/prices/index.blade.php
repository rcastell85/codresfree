@extends('adminlte::page')

@section('title', 'Precios')

@section('content_header')
    <a href="{{ route('admin.prices.create') }}" class="btn btn-secondary btn-sm float-right">Nuevo precio</a>

    <h1 class="mb-4">Lista de precios</h1>
@stop

@section('content')
  
    @if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Precio</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($prices as $price)
                        
                        <tr>
                            <td>{{ $price->id }}</td>
                            <td>{{ $price->name }}</td>

                            <td width="10px">
                                <a href="{{ route('admin.prices.edit', $price) }}" class="btn btn-primary btn-sm">Editar</a>
                            </td>
                            <td width="10px">
                                <form action="{{ route('admin.prices.destroy', $price)}}" method="POST">
                                    @csrf
                                    @method('delete')

                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
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
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop