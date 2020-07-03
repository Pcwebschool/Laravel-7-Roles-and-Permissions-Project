@extends('admin.layouts.dashboard')

@section('content')

<h2>Edit User</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="/users/{{ $user->id }}" enctype="multipart/form-data">
    @method('PATCH')
    @csrf()
    
    <div class="form-group">
        <label for="name">User name</label>
        <input type="text" name="name" class="form-control" id="name" placeholder="Name..." value="{{ $user->name }}" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" id="email" placeholder="Email..." value="{{ $user->email }}">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" id="password" placeholder="Password..." minlength="8">
    </div>
    <div class="form-group">
        <label for="password_confirmation">Password Confirm</label>
        <input type="password" name="password_confirmation" class="form-control" placeholder="Password..." id="password_confirmation">
    </div>
    
    <div class="form-group">
        <label for="role">Select Role</label>
        <select class="role form-control" name="role" id="role">
            <option value="">Select Role...</option>
            @foreach ($roles as $role)
                <option data-role-id="{{$role->id}}" data-role-slug="{{$role->slug}}" value="{{$role->id}}" {{ $user->roles->isEmpty() || $role->name != $userRole->name ? "" : "selected"}}>{{$role->name}}</option>                
            @endforeach
        </select>          
    </div>

    <div id="permissions_box" >
        <label for="roles">Select Permissions</label>        
        <div id="permissions_ckeckbox_list">                    
        </div>
    </div>   

    @if($user->permissions->isNotEmpty())
        @if($rolePermissions != null)
            <div id="user_permissions_box" >
                <label for="roles">User Permissions</label>
                <div id="user_permissions_ckeckbox_list">                    
                    @foreach ($rolePermissions as $permission)
                    <div class="custom-control custom-checkbox">                         
                        <input class="custom-control-input" type="checkbox" name="permissions[]" id="{{$permission->slug}}" value="{{$permission->id}}" {{ in_array($permission->id, $userPermissions->pluck('id')->toArray() ) ? 'checked="checked"' : '' }}>
                        <label class="custom-control-label" for="{{$permission->slug}}">{{$permission->name}}</label>
                    </div>
                    @endforeach
                </div>
            </div>
        @endif
    @endif


    <div class="form-group pt-2">
        <input class="btn btn-primary" type="submit" value="Submit">
    </div>
</form>

@section('js_user_page')

    <script>

        $(document).ready(function(){
            var permissions_box = $('#permissions_box');
            var permissions_ckeckbox_list = $('#permissions_ckeckbox_list');
            var user_permissions_box = $('#user_permissions_box');
            var user_permissions_ckeckbox_list = $('#user_permissions_ckeckbox_list');

            permissions_box.hide(); // hide all boxes


            $('#role').on('change', function() {
                var role = $(this).find(':selected');    
                var role_id = role.data('role-id');
                var role_slug = role.data('role-slug');

                permissions_ckeckbox_list.empty();
                user_permissions_box.empty();

                $.ajax({
                    url: "/users/create",
                    method: 'get',
                    dataType: 'json',
                    data: {
                        role_id: role_id,
                        role_slug: role_slug,
                    }
                }).done(function(data) {
                    
                    console.log(data);
                    
                    permissions_box.show();                        
                    // permissions_ckeckbox_list.empty();

                    $.each(data, function(index, element){
                        $(permissions_ckeckbox_list).append(       
                            '<div class="custom-control custom-checkbox">'+                         
                                '<input class="custom-control-input" type="checkbox" name="permissions[]" id="'+ element.slug +'" value="'+ element.id +'">' +
                                '<label class="custom-control-label" for="'+ element.slug +'">'+ element.name +'</label>'+
                            '</div>'
                        );

                    });
                });
            });
        });

    </script>

@endsection

@endsection
