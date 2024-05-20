@extends('layouts.admin')
@section('title', 'List Users')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách nhân viên</h5>
            <div class="form-search form-inline">
                <form method="GET">
                    <input type="text" name="keyword" value="{{ $keyword }}" class="form-control form-search" placeholder="Theo ID hoặc tên">
                    <input type="submit" name="btn-search" value="Search" class="btn btn-primary">
                </form>
            </div>
        </div>
        {{ $status }}
        @if (!empty(session('status')))
            <div class="alert alert-success">{{ Session('status') }}</div>
        @endif
        @if (!empty(session('warning')))
            <div class="alert alert-warning">{{ Session('warning') }}</div>
        @endif
        <div class="card-body">
            <div class="analytic">
                <a href="{{ request()->fullUrlWithQuery(['status'=>'all']) }}" class="text-primary">Tất cả<span class="text-muted">({{ $user_all }})</span></a>
                <a href="{{ request()->fullUrlWithQuery(['status'=>'active']) }}" class="text-primary">Đang hoạt động<span class="text-muted">({{ $user_active }})</span></a>
                <a href="{{ request()->fullUrlWithQuery(['status'=>'trash']) }}" class="text-primary">Đang khóa<span class="text-muted">({{ $user_trash }})</span></a>
            </div>
            <div class="form-action form-inline py-3">
                <form action="{{ route('admin_user_action') }}" method="GET">
                <select class="form-control mr-1" id="" name="actions">
                    <option value="0">Tác vụ</option>
                    @if ($status == 'all' or $status == '')
                    <option value="block">Khóa</option>
                    <option value="restore">Khôi phục</option>
                    @elseif('status'== 'active')
                    <option value="block">Khóa</option>
                    @else
                    <option value="restore">Khôi phục</option>
                    @endif
                </select>
                <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
            </div>
            <table class="table table-striped table-checkall">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" name="checkall">
                        </th>
                        <th scope="col">ID</th>
                        <th scope="col">Họ tên</th>
                        <th scope="col">Nhà hàng</th>
                        <th scope="col">Vị trí</th>
                        <th scope="col">Quyền</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($users->count() > 0)
                    @foreach ($users as $user)
                    <tr>
                        <td>
                            <input type="checkbox" name="list_check[]" value="{{ $user->id }}">
                        </td>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->restaurant->name }}</td>
                        <td>{{ $user->area->name}}</td>
                        <td><span class="badge badge-warning">Đang xử lý</span></td>
                        <td>{{ $user->created_at }}</td>
                        <td>
                            <a href="{{ route('admin_user_edit', $user->id) }}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                            {{--  {{ $user->deleted_at }}  --}}
                            @if ($user->deleted_at != null)
                            @else
                            <a href="{{ route('admin_user_delete', $user->id) }}" onclick="return confirm('Bạn chắc chắn muốn khóa user này ?')" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                            @endif
                        {{--  <a href="{{ route('admin_user_delete', $user->id) }}" onclick="return confirm('Bạn chắc chắn muốn khóa user này ?')" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>  --}}

                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="8" style="text-align: center">Không tìm thấy bản ghi nào!
                        </td>
                        </tr>
                    @endif


                </tbody>
            </table>
        </form>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <ul class="pagination">
                        {{ $users->links() }}
                    </ul>
                </ul>
            </nav>
        </div>
    </div>
</div>
@endsection
