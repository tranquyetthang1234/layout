 @extends('admin.template-parts.master')
 @section('content')

    <div class="content-wrapper">
        <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h5 class="mb-0">Danh mục bài viết</h5>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">Switch</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- main body -->
    <div class="row">
      <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">

            <div class="card-body">
                    <button type="button" class="btn btn-primary pull-right mb-10" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-plus"></i> Thêm mới</button>
                <div class="table-responsive">
                    <table id="datatable"  class="table_blog table table-striped table-bordered p-0">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tiêu đề</th>
                                <th>Mô tả</th>
                                <th>Trạng thái</th>
                                <th>Ngày tạo</th>
                                <th>Tùy chọn</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($category_category_post as $key => $category)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$category->name}}</td>
                                    <td>{{$category->description}}</td>
                                    <td class="text-center">
                                        <div class="checkbox checbox-switch switch-primary">
                                            <label>
                                                <input type="checkbox"
                                                    onchange="changeActive(<?=$category->id?>)"
                                                    {{$category->status ? 'checked' : ''}}
                                                >
                                                <span></span></label>
                                        </div>
                                    </td>
                                    <td>{{$category->created_at}}</td>
                                    <td>
                                        <div class="edit-blog" onclick="showBlog(<?=$category->id?>)">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </div>
                                        <div class="delete-blog" onclick="deleteBlog(<?=$category->id?>)">
                                           <i class="fa fa-trash-o"></i>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
         </div>
      </div>
    </div>

    {{-- modal --}}

    <div class="modal fade bd-example-modal-lg show" tabindex="-1" role="dialog" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title"><div >
            <h6>Thêm mới Blog</h6>
            </div>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
             <div class="form-group">
                <label for="name" class="form-control-label">Tên danh mục *:</label>
                <input name="name" type="text" class="form-control">
                @if($errors->has('cateogry'))
                    <span class="error-text">
                        {{ $errors->first('cateogry') }}
                    </span>
                @endif
                <span></span>
            </div>
            <div class="form-group">
                <label for="message-text" class="form-control-label">Mô tả ngắn:</label>
                <textarea class="form-control" name="description" rows="10" name="description">
                </textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
             <button type="button" class="btn btn-primary btn-handel" onclick="storeBlog()">Thêm mới</button>
        </div>
        </div>
    </div>
    </div>

    @push('scripts')
        <script type="text/javascript" >
            var route_active   =  "{{ route('admin.catblog.active') }}";
            var route_create   =  "{{ route('admin.catblog.store') }}";
            var route_show     =  "{{ route('admin.catblog.show') }}";
            var route_update   =  "{{ route('admin.catblog.update') }}";
            var route_destroy  =  "{{ route('admin.catblog.destroy') }}";
        </script>
    @endpush

    @section('script')
    <script type="text/javascript" src="/admin/component/catblog/index.js"></script>
    @endsection

 @endsection
