@extends('layouts.admin')
@section('title', 'Thêm nhà hàng')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm nhà hàng
        </div>
        @if (session('status'))
                <div class="alert alert-success">{{ Session('status') }}</div>
                @endif
        <div class="card-body">
            <form method="POST" action="{{ route('admin_restaurant_insert') }}">
                @csrf
                <div class="form-group">
                    <label for="name">Tên nhà hàng</label>
                    <input class="form-control" type="text" name="name" id="name">
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
