@extends('adminlte::page')

@section('title', 'CodersFree')

@section('content_header')

    <a href="{{ route('admin.levels.create') }}" class="btn btn-secondary btn-sm float-right">Nuevo nivel</a>

    <h1>Lista de niveles</h1>
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
                            <th>Nombre</th>
                            <th colspan="2"></th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($levels as $level)
                            <tr>
                                <td>{{ $level->id }}</td>
                                <td>{{ $level->name }}</td>

                                <td width="10px">
                                    <a href="{{ route('admin.levels.edit', $level) }}" class="btn btn-primary btn-sm">Editar</a>
                                </td>
                                <td width="10px">
                                    <form action="{{ route('admin.levels.destroy', $level) }}" method="POST">
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

