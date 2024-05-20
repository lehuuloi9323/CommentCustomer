@extends('layouts.admin')
@section('title', 'Danh sách vị trí')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách nhà hàng</h5>
            <div class="form-search form-inline">
                <form method="GET">
                    <input type="" class="form-control form-search" name="keyword" value="{{ $keyword }}" placeholder="Tìm kiếm">
                    <input type="submit" name="btn-search" value="Search" class="btn btn-primary">
                </form>
            </div>
        </div>
        @if (!empty(session('status')))
            <div class="alert alert-success">{{ Session('status') }}</div>
        @endif
        <div class="card-body">
            {{--  <div class="analytic">
                <a href="" class="text-primary">Trạng thái 1<span class="text-muted">(10)</span></a>
                <a href="" class="text-primary">Trạng thái 2<span class="text-muted">(5)</span></a>
                <a href="" class="text-primary">Trạng thái 3<span class="text-muted">(20)</span></a>
            </div>  --}}
            {{--  <div class="form-action form-inline py-3">
                <select class="form-control mr-1" id="">
                    <option>Chọn</option>
                    <option>Tác vụ 1</option>
                    <option>Tác vụ 2</option>
                </select>
                <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
            </div>  --}}
            <table class="table table-striped table-checkall">
                <thead>
                    <tr>
                        {{--  <th>
                            <input type="checkbox" name="checkall">
                        </th>  --}}
                        <th scope="col">#</th>
                        <th scope="col">Tên nhà hàng</th>

                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    @if($areas->total() > 0)

                    @foreach ($areas as $area)
                    <tr>
                        <td>{{ $area->id }}</td>
                        <td>{{ $area->name }}</td>
                        <td>{{ $area->created_at }}</td>
                        <td>
                            <a href="{{ route('admin_area_edit', $area->id) }}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                            <a href="{{ route('admin_area_delete', $area->id) }}" onclick="return confirm('Bạn chắc chắn muốn xóa nhà hàng này ?')" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>

                    @endforeach
                    @else
                    <tr>
                        <td colspan="4" style="text-align: center">Không tìm thấy bản ghi nào!
                        </td>
                        </tr>
                    @endif

                </tbody>
            </table>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    {{ $areas->links() }}
                </ul>
            </nav>
        </div>
    </div>
</div>
@endsection
