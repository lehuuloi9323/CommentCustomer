@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<div class="container-fluid py-5">
    <div class="row">
        <div class="col">
            <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                <div class="card-header">TỔNG SỐ LƯỢT ĐÁNH GIÁ</div>
                <div class="card-body">
                    <h5 class="card-title">{{ number_format($count, 0, '', '.') }}</h5>
                    <p class="card-text">Tất cả lượt đánh giá</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                <div class="card-header">POOR</div>
                <div class="card-body">
                    <h5 class="card-title">{{ number_format($count_poor, 0, '', '.') }}</h5>
                    <p class="card-text">Số lượt đánh giá kém</p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                <div class="card-header">EXCELLENT</div>
                <div class="card-body">
                    <h5 class="card-title">{{ number_format($count_excellent, 0, '', '.') }}</h5>
                    <p class="card-text">Số lượt đánh giá tốt</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                <div class="card-header">AVERAGE</div>
                <div class="card-body">
                    <h5 class="card-title">{{ number_format($count_average, 0, '', '.') }}</h5>
                    <p class="card-text">Số lượt đánh giá bình thường</p>
                </div>
            </div>
        </div>
    </div>
    <!-- end analytic  -->
    <div class="card">
        <div class="card-header font-weight-bold">
            LƯỢT ĐÁNH GIÁ MỚI
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Chi tiết đánh giá</th>
                        <th scope="col">Nhà hàng</th>
                        <th scope="col">Vị trí</th>
                        <th scope="col">Tên nhân viên</th>
                        <th scope="col">Thời gian đánh giá</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $data)
                    <tr>
                        <th scope="row">{{ $data->id }}</th>
                        <td style="text-transform:uppercase;" class="@if ($data->rate == 'excellent')
                            text-success
                        @elseif ($data->rate == 'poor')
                            text-danger
                        @else
                        text-dark
                        @endif fw-bold">{{ $data->rate }}</td>
                        <td>
                            {{ $data->restaurant->name }}

                        </td>
                        <td>{{ $data->area->name }}</td>
                        <td>{{ $data->user->name }}</td>
                        <td>{{ $data->created_at }}</td>

                    </tr>
                    @endforeach



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

