@extends('layouts.admin')
@section('title','Thêm quyền')
@section('content')
<div id="content" class="container-fluid">
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Thêm quyền
                </div>
                <div class="card-body">
                    <form action="{{ route('permission.storeadd') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="add_name_permission">Tên quyền</label>
                            <input class="form-control" type="text" name="add_name_permission" id="add_name_permission" value="{{ old('add_name_permission') }}">
                        </div>
                        @error('add_name_permission')
                <small class="text-danger d-block">{{ $message }}</small>
                @enderror
                        <div class="form-group">
                            <label for="add_slug">Slug</label>
                            <small class="form-text text-muted pb-2">Ví dụ: posts.add</small>
                            <input class="form-control" type="text" name="add_slug" id="add_slug" value="{{ old('add_slug') }}">
                        </div>
                        @error('add_slug')
                <small class="text-danger d-block">{{ $message }}</small>
                @enderror
                        <div class="form-group">
                            <label for="description">Mô tả</label>
                            <input class="form-control" type="text" name="description" id="description" value="{{ old('description') }}">

                            {{--  <textarea class="form-control" type="text" name="description" id="description" value="{{ old('description') }}"> </textarea>  --}}
                        </div>
                        <input type="submit" class="btn btn-primary" value="Thêm mới">
                    </form>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Danh sách quyền
                </div>
                @if (session('status'))
                <div class="alert alert-success">{{ Session('status') }}</div>
                @endif
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên quyền</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Mô tả</th>
                                <th scope="col">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i=1;
                            @endphp
                            @foreach ($permissions as $moduleName => $modulePermissions)
                            <tr>
                                <td scope="row" colspan="5"><strong>Modules {{ ucfirst($moduleName) }}</strong></td>

                            </tr>
                                @foreach ($modulePermissions as $permission)
                                <tr>
                                    <td scope="row">{{ $i++ }}</td>
                                    <td>|---{{ $permission->name }}</td>
                                    <td>{{ $permission->slug }}</td>
                                    <td><i>{{ strtolower($permission->description) }}</i></td>
                                    <td>
                                        <a class="btn btn-success" href="{{ route('permission.edit',$permission->id) }}" role="button"><i class="fa fa-edit"></i></a>
                                        <a class="btn btn-danger" href="{{ route('permission.delete', $permission->id) }}" onclick="return confirm('Bạn chắc chắn muốn xóa quyền trên !')" role="button"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        {{--  <a class="btn btn-success" href="{{ route('permission.edit',$permission->id) }}" role="button"><i class="fa-solid fa-pencil" aria-hidden="true"></i></a>
                                        <a class="btn btn-danger" href="{{ route('permission.delete', $permission->id) }}" onclick="return confirm('Bạn chắc chắn muốn xóa quyền trên !')" role="button"><i class="fa fa-trash" aria-hidden="true"></i></a>  --}}
                                    </td>
                                </tr>
                                @endforeach
                            @endforeach



                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
