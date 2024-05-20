@extends('layouts.admin')
@section('title', 'Sửa vị trí')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Sửa nhà hàng
        </div>
        @if (session('status'))
                <div class="alert alert-success">{{ Session('status') }}</div>
                @endif
        <div class="card-body">
            <form method="POST" action="{{ route('admin_area_update', $area->id) }}">
                @csrf
                <div class="form-group">
                    <label for="name">Tên nhà hàng</label>
                    <input class="form-control" type="text" name="name" id="name" value="{{ $area->name }}">
                </div>
                @error('name')
                <small class="text-danger d-block">{{ $message }}</small>
                @enderror
                <input type="submit" class="btn btn-primary" value="Thêm mới"></input>
            </form>
        </div>
    </div>
</div>
@endsection
