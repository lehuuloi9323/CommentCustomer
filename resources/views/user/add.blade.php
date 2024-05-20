@extends('layouts.admin')
@section('title','Add Users')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm người dùng
        </div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success">{{ Session('status') }}</div>
                @endif
            <form method="POST" action="{{ route('admin_user_create') }}">
                @csrf
                <div class="form-group">
                    <label for="name">Họ và tên</label>
                    <input class="form-control" type="text" name="name" id="name">
                </div>
                @error('name')
                <small class="text-danger d-block">{{ $message }}</small>
                @enderror

                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <input class="form-control" type="password" name="password" id="password">
                </div>
                @error('password')
                <small class="text-danger d-block">{{ $message }}</small>
                @enderror
                <div class="form-group">
                    <label for="password_confirmation">Nhập lại mật khẩu</label>
                    <input class="form-control" type="password" name="password_confirmation" id="password_confirmation">
                </div>

                <div class="form-group">
                    <label for="">Nhà hàng</label>
                    <select class="form-control" id="restaurant" name="restaurant">
                        <option value="">Chọn nhà hàng</option>
                        @foreach ($restaurants as $restaurant)
                        <option value="{{ $restaurant->id }}">{{ $restaurant->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('restaurant')
                <small class="text-danger d-block">{{ $message }}</small>
                @enderror
                <div class="form-group">
                    <label for="">Vị trí</label>
                    <select class="form-control" id="area" name="area">
                        <option value="">Chọn vị trí</option>
                        @foreach ($areas as $area)
                        <option value="{{ $area->id }}">{{ $area->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('area')
                <small class="text-danger d-block">{{ $message }}</small>
                @enderror
                <div class=
                <div class="form-group">
                    <label for="">Nhóm quyền</label>
                    <select class="form-control" id="">
                        <option>Chọn quyền</option>
                        <option>Danh mục 1</option>
                        <option>Danh mục 2</option>
                        <option>Danh mục 3</option>
                        <option>Danh mục 4</option>
                    </select>
                </div>

                <input type="submit" class="btn btn-primary mt-1" value="Thêm mới"></input>
            </form>
        </div>
    </div>
</div>
@endsection
