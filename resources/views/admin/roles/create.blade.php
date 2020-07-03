@extends('admin.layouts.dashboard')

@section('content')

<h1>Create new Role</h1>

@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li> 
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="/roles">
    {{ csrf_field() }}
    
    <div class="form-group">
        <label for="role_name">Role name</label>
        <input type="text" name="role_name" class="form-control" id="role_name" placeholder="Role name..." value="{{ old('role_name') }}" required>
    </div>
    <div class="form-group">
        <label for="role_slug">Role Slug</label>
        <input type="text" name="role_slug" tag="role_slug" class="form-control" id="role_slug" placeholder="Role Slug..." value="{{ old('role_slug') }}" required>
    </div>
    <div class="form-group" >
        <label for="roles_permissions">Add Permissions</label>
        <input type="text" data-role="tagsinput" name="roles_permissions" class="form-control" id="roles_permissions" value="{{ old('roles_permissions') }}">   
    </div>     

    <div class="form-group pt-2">
        <input class="btn btn-primary" type="submit" value="Submit">
    </div>
</form>

@section('css_role_page')
    <link rel="stylesheet" href="/css/admin/bootstrap-tagsinput.css">
@endsection

@section('js_role_page')
    <script src="/js/admin/bootstrap-tagsinput.js"></script>

    <script>

        $(document).ready(function(){
            $('#role_name').keyup(function(e){
                var str = $('#role_name').val();
                str = str.replace(/\W+(?!$)/g, '-').toLowerCase();//rplace stapces with dash
                $('#role_slug').val(str);
                $('#role_slug').attr('placeholder', str);
            });
        });
        
    </script>

@endsection

@endsection
