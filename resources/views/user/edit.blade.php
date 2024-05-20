@extends('layouts.admin')
@section('title','Cập nhật thông tin')

@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Cập nhật người dùng
        </div>
        <div class="card-body">
            <form action="{{ route('admin_user_update', $user->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Họ và tên</label>
                    <input type="text" name="name" value="{{ $user->name }}" class="form-control" id="name">
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="form-group">
                <label for="restaurant">Nhà hàng</label>
                <select name="restaurant" id="restaurant" class="form-control">
                    @foreach ($restaurants as $restaurant)
                        <option value="{{ $restaurant->id }}" @if ($user->restaurant_id == $restaurant->id)
                            selected
                        @endif>{{ $restaurant->name }}</option>
                    @endforeach
                </select>
                </div>

                <div class="form-group">
                <label for="area">Vị trí</label>
                <select name="area" id="area" class="form-control">
                    @foreach ($areas as $area)
                        <option value="{{ $area->id }}" @if ($user->area_id == $area->id)
                            selected
                        @endif>{{ $area->name }}</option>
                    @endforeach
                </select>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Cập nhật">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
