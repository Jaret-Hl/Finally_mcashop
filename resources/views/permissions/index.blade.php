@extends('layouts.app')

@section('css')

@endsection

@section('title', 'Permission')

@section('content')
<table class="table">
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Slug</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($permissions as $permission)
            <tr>
                <td>{{ $permission->name }}</td>
                <td>{{ $permission->guard_name }}</td>
                <td>
                    <button class="edit-permission" data-id="{{ $permission->id }}">Edit</button>
                    <button class="delete-permission" data-id="{{ $permission->id }}">Delete</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<form id="add-permission-form">
    @csrf
    <input type="text" name="name" placeholder="Name">
    <input type="text" name="guard_name" placeholder="Slug">
    <button type="submit">Add Permission</button>
</form>
@stop


@section('js')
<script>
    $(document).ready(function() {
    // Delete a permission
    $(document).on('click', '.delete-permission', function() {
        var id = $(this).data('id');
        
        $.ajax({
            url: '/permissions/' + id,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                // Remove the deleted permission from the list
                $('#permissions-list').find('li[data-id="' + id + '"]').remove();
            },
            error: function(xhr) {
                console.log(xhr.responseJSON.message);
            }
        });
    });
    
    // Create a new permission
    $('#create-permission-form').submit(function(e) {
        e.preventDefault();
        
        var name = $(this).find('input[name="name"]').val();
        
        $.ajax({
            url: '/permissions',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: { name: name },
            success: function(response) {
                // Add the new permission to the list
                $('#permissions-list').find('ul').append('<li>' + name + ' <button class="delete-permission" data-id="' + response.id + '">Delete</button></li>');
                
                // Clear the input field
                $('#create-permission-form').find('input[name="name"]').val('');
            },
            error: function(xhr) {
                console.log(xhr.responseJSON.message);
            }
        });
    });
});

</script>
@endsection
