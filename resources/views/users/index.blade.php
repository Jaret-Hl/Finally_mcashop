@extends('layouts.app')
@extends('setmenu')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Usuarios</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('users.create') }}"> Crear Nuevo Usuario</a>
        </div>
    </div>
</div>
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
<table class="table table-bordered mt-3">
    <tr>
        <th>No</th>
        <th>Nombre</th>
        <th>Email</th>
        <th>Roles</th>
        <th width="280px">Acciones</th>
    </tr>
@foreach ($data as $key => $user)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>
            @if(!empty($user->getRoleNames()))
                @foreach($user->getRoleNames() as $v)
                    <span class="badge rounded-pill bg-dark">{{ $v }}</span>
                @endforeach
            @endif
        </td>
        <td>
            <a class="btn btn-dark" href="{{ route('users.show',$user->id) }}">Ver</a>
            @role('Admin')
            <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Editar</a>
                {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            @endrole
        </td>
    </tr>
@endforeach
</table>
{!! $data->render() !!}
@endsection