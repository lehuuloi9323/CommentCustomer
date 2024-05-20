@extends('layouts.admin')
@section('title','Đánh giá của khách hàng')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Đánh giá khách hàng</h5>
            <div class="form-search form-inline">
                <form method="GET">
                    <input type="text" name="keyword" value="{{ $keyword }}" class="form-control form-search" placeholder="Tìm theo ID nhà hàng">
                    <input type="submit" name="btn-search" value="Search" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="analytic">
                <a href="{{ request()->fullUrlWithQuery(['status'=>'all']) }}" class="text-primary">Tất cả<span class="text-muted">({{ $count_data_all }})</span></a>
                <a href="{{ request()->fullUrlWithQuery(['status'=>'excellent']) }}" class="text-primary">Tuyệt vời<span class="text-muted">({{ $count_data_excellent }})</span></a>
                <a href="{{ request()->fullUrlWithQuery(['status'=>'average']) }}" class="text-primary">Bình thường<span class="text-muted">({{ $count_data_average }})</span></a>
                <a href="{{ request()->fullUrlWithQuery(['status'=>'poor']) }}" class="text-primary">Tệ<span class="text-muted">({{ $count_data_poor }})</span></a>
            </div>
            {{ $status }}
            <table class="table table-striped table-checkall mt-1">
                <thead>
                    <tr>

                        <th scope="col">#</th>
                        <th scope="col">Đánh giá</th>
                        <th scope="col">Tên nhân viên</th>
                        <th scope="col">Nhà hàng</th>
                        <th scope="col">Thời gian</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($datas->count() > 0)
                    @foreach ($datas as $data)
                    <tr>
                        <td>{{$data->id }}</td>
                        <td style="text-transform:uppercase;" class="@if ($data->rate == 'excellent')
                            text-success
                        @elseif ($data->rate == 'poor')
                            text-danger
                        @else
                        text-dark
                        @endif fw-bold">{{ $data->rate }}</td>
                        <td>{{ $data->user->name }}</td>
                        <td>{{ $data->restaurant->name }}</td>
                        <td>{{ $data->created_at }}</td>

                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="5" style="text-align: center">Không tìm thấy bản ghi nào!
                        </td>
                        </tr>
                    @endif


                </tbody>
            </table>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    {{ $datas->links() }}
                </ul>
            </nav>
        </div>
    </div>
</div>
@endsection
