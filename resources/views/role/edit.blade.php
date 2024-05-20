@extends('layouts.admin')
@section('title', 'Sửa quyền');
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0">Cập nhật vai trò</h5>
            <div class="form-search form-inline">
                <form action="#" method="GET">
                    <input type="text" class="form-control form-search" placeholder="Tìm kiếm">
                    <input type="submit" name="btn-search" value="Search" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('role.update', $role->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name" class="text-strong">Tên vai trò</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $role->name }}">
                    @error('name')
                        <small class="text-danger d-block">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description" class="text-strong">Mô tả</label>
                    <input type="text" name="description" id="description" class="form-control" value="{{ $role->description }}">
                    @error('description')
                        <small class="text-danger d-block">{{ $message }}</small>
                    @enderror
                </div>

                <strong>Vai trò này có quyền gì?</strong>
                <small class="form-text text-muted pb-2">Check vào module hoặc các hành động bên dưới để chọn quyền.</small>

                @foreach ($permissions as $moduleName => $modulePermissions)
                <div class="card my-4 border">
                    <div class="card-header">
                        <input type="checkbox" class="check-all" id="{{ $moduleName }}">
                        <label for="{{ $moduleName }}" class="m-0">Module {{ ucfirst($moduleName) }}</label>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($modulePermissions as $permission)
                            <div class="col-md-3">
                                <input type="checkbox" name="permission_id[]" value="{{ $permission->id }}" id="{{ $permission->slug }}" class="permission"
                                    {{ in_array($permission->id, $role->permissions->pluck('id')->toArray()) ? 'checked' : '' }}>
                                <label for="{{ $permission->slug }}">{{ $permission->name }}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach

                <input type="submit" name="btn-add" class="btn btn-primary" value="Cập nhật">
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('.check-all').click(function() {
        $(this).closest('.card').find('.permission').prop('checked', this.checked);
    });
</script>

@endsection
