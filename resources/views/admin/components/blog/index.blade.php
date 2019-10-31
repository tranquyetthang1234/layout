 @extends('admin.template-parts.master')
 @section('content')

    <div class="content-wrapper">
        <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h5 class="mb-0">Danh sách bài viết</h5>
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

                            @foreach ($posts as $key => $post)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$post->title}}</td>
                                    <td>{{$post->description}}</td>
                                    <td class="text-center">
                                        <div class="checkbox checbox-switch switch-primary">
                                            <label>
                                                <input type="checkbox"
                                                    onchange="changeActive(<?=$post->id?>)"
                                                    {{$post->status ? 'checked' : ''}}
                                                >
                                                <span></span></label>
                                        </div>
                                    </td>
                                    <td>{{$post->created_at}}</td>
                                    <td>
                                        <div class="edit-blog" onclick="showBlog(<?=$post->id?>)">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </div>
                                        <div class="delete-blog" onclick="deleteBlog(<?=$post->id?>)">
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
                <label for="name" class="form-control-label">Tiêu đề *:</label>
                <input name="title" type="text" class="form-control">
                <span></span>
            </div>
            <div class="form-group">
                <label for="message-text" class="form-control-label">Mô tả ngắn:</label>
                <textarea class="form-control" name="description" rows="10" name="description">
                </textarea>
            </div>
             <div class="form-group">
                <label for="message-text" class="form-control-label">Nội dung:</label>
                <textarea class="form-control " name="content" rows="10" ></textarea>
            </div>
              <div class="form-group">
                <label style="font-size: 15px;font-weight: 700;">Thuộc danh mục</label>
                <select name="" id="input" class="form-control input_catname " required="required">
                    <option value="0">---------------- ROOT ----------------</option>
                </select>
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
            var route_active   =  "{{ route('admin.blog.active') }}";
            var route_create   =  "{{ route('admin.blog.store') }}";
            var route_show     =  "{{ route('admin.blog.show') }}";
            var route_update   =  "{{ route('admin.blog.update') }}";
            var route_destroy  =  "{{ route('admin.blog.destroy') }}";
        </script>
    @endpush

    @section('script')
    <script type="text/javascript" src="/admin/component/blog/index.js"></script>
    @endsection

 @endsection
