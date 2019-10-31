@extends('admin.template-parts.master')
@section('content')
<style>
   .loading {
       position: relative;
   }

   .loading .loading-content {
       position: absolute;
       left: 0;
       top: 0;
       width: 100%;
       height: 100%;
       display: none;
       background: rgba(255, 255, 255, 0.7);
   }

   .loading .loading-content.show {
       display: block !important;
       -webkit-user-select: none;
       /* Chrome all / Safari all */
       -moz-user-select: none;
       /* Firefox all */
       -ms-user-select: none;
       /* IE 10+ */
       user-select: none;
       /* Likely future */
       overflow: visible;
       pointer-events: none;
   }

   .loader {
       border: 16px solid #f3f3f3;
       border-top: 16px solid #3498db;
       border-radius: 50%;
       width: 100px;
       height: 100px;
       animation: spin 2s linear infinite;
       display: table;
       margin: 10px auto;
       margin-top: 200px;
   }

   @keyframes spin {
       0% {
           transform: rotate(0deg);
       }

       100% {
           transform: rotate(360deg);
       }
   }

   .selected-all {
       display: flex;
       float: right;
   }

   .selected-all span {
       line-height: 25px;
   }

   .toggle {
       margin: 0px;
   }

   .toggle input[type=checkbox] {
       display: none;
   }

   .slide-toggle {
       display: block;
       position: relative;
       flex: none;
       width: 50px;
       height: 26px;
       border-radius: 25px;
       background-color: #d7d2cb;
       cursor: pointer;
       transition: all 0.1s ease-in-out;
       z-index: 1;
       margin: 0px 10px;
   }

   .slide-toggle::before,
   .slide-toggle::after {
       content: ' ';
       display: block;
       position: absolute;
       top: 1px;
       border-radius: 25px;
       height: 23px;
       background-color: #fff;
       -webkit-transform: translate3d(0, 0, 0);
       transform: translate3d(0, 0, 0);
       transition: 0.2s cubic-bezier(0, 1.1, 1, 1.1);
   }

   .slide-toggle::before {
       z-index: -1;
       width: 48px;
       right: 1px;
       -webkit-transform: scale(1);
       transform: scale(1);
   }

   .slide-toggle::after {
       z-index: 1;
       width: 24px;
       left: 3px;
       box-shadow: 0 1px 4px 0.5px rgba(0, 0, 0, 0.25);
   }

   input:checked+.slide-toggle {
       background-color: #4dde5e;
   }

   input:checked+.slide-toggle::before {
       -webkit-transform: scale(0);
       transform: scale(0);
   }

   input:checked+.slide-toggle::after {
       -webkit-transform: translate3d(20px, 0, 0);
       transform: translate3d(20px, 0, 0);
   }

   i.flaticon-more {
       color: rgb(147, 162, 221);
       font-size: 15px;
       padding-top: 2px;
       padding-right: 5px;
   }

   i.flaticon2-delete {
       font-size: 10px !important;
   }

   i.flaticon2-edit {
       font-size: 15px !important;
   }

   #accordionExample .panel-header {
       cursor: move;
   }

   .kt-portlet__head-title {
       font-size: 1rem !important
   }

   .kt-portlet__head.panel-header {
       min-height: 45px !important;
       border-left: 4px solid #3590bc;
   }

   .kt-portlet__head {
       min-height: 45px !important;
   }

   .title-custom {
       margin: 0 !important;
       padding: 0 !important;
       font-size: 15px !important;
       color: #91532c !important;
       font-weight: 600 !important;
   }

   .menu-box {

       margin: 10px;
       padding: 10px;
   }

   .menu-box ul {
       margin: 0;
       padding: 0;
       /* padding-right: 4px; */
       list-style: none;
   }

   .menu-box ul.menu-list li {
       display: block;
       margin-bottom: 5px;
       /* border: 1px solid #dbd0d0; */
       background: #fff;
   }

   .menu-box ul.menu-list>li a {
       background: #fff;
       display: block;
       border: 1px solid #dee2e6;
       font-size: 14px;
       font-weight: 500;
       color: red;
       text-decoration: none;
       padding: 7px;
   }

   .menu-box ul.menu-list>li a:hover {
       cursor: move;
   }

   .menu-box ul.menu-list ul {
       margin-left: 30px;
       margin-top: 5px;
   }

   .menu-box ul.menu-list ul li a {
       color: blue;
   }

   .menu-box li.menu-highlight {
       border: 1px dashed red !important;
       background: #f5f5f5;
   }

   .kt-portlet__head-toolbar {
       display: flex;
       display: -webkit-box;
       display: -ms-flexbox;
       display: flex;
       -webkit-box-align: center;
       -ms-flex-align: center;
       align-items: center;
       -ms-flex-line-pack: end;
       align-content: flex-end;
       float: right;
       margin-top: -5px;
   }

   @media (min-width: 992px) {
       .moda_edit_cat {
           max-width: 550px !important;
       }


       .checkbox_cat .kt-checkbox>input:checked~span:after {
           border: solid #27282b;
       }

       .ckecbox_cat .kt-checkbox>span {
           border: 1px solid #387937;
       }
   }
   .drop-area {
   border: 2px dashed #ccc;
   width: 120px;
   font-family: sans-serif;
   margin: 0 auto;
   padding: 5px;
   position: relative;
   height: 120px;
   border-radius: 50%;
   z-index: 25;
   border: 1px dashed #ccc;
}

.highlight {
   border-color: purple !important;
}

p {
   margin-top: 0;
}

.my-form {
   margin-bottom: 10px;
}

.gallery {
   margin-top: 10px;
   text-align: center;
   position: absolute;
   margin-left: 5px;
   margin-bottom: 9px;
   margin-top: 9px;
   z-index: 1;
}

.gallery img {
   width: 105px;
   margin-bottom: 10px;
   margin-right: 10px;
   vertical-align: middle;
   border-radius: 50%;
   height: 102px;
}

.button {
   display: inline-block;
   padding: 10px;
   background: #ccc;
   cursor: pointer;
   border-radius: 5px;
   border: 1px solid #ccc;
}

.button:hover {
   background: #ddd;
}

.input-img {
   display: none;
}

.lb-file {
   position: absolute;
   width: 100%;
   background: transparent;
   border: none;
   padding: 0;
   height: 100%;
   margin: 0;
   top: 0;
   left: 0;
}

.wrap-drop-img {
   display: flex;
   justify-content: space-around;
   margin-bottom: 0px;
}

input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
   -webkit-appearance: none;
   margin: 0;
}
.edit-cat{
   background-color: #f0b762;
   border-radius: 15px;
   padding-top: 5px;
   margin-right: 6px;
   box-shadow: 1px 2px 2px #787676;
   padding-left: 8px;
   padding-right: 8px;
}
.delete-cat{
   background-color: #f0b762;
   border-radius: 15px;
   padding-top: 7px;
   padding: 4px 9px;
   box-shadow: 1px 2px 2px #787676
}
.is-invalid{
   border :1px solid #d74d4d;
}
.swal2-confirm.btn.btn-success{
   margin-left:13px !important;
}
ul.list-unstyled {
        margin: 0px;
        padding: 0px;
        list-style: none;
    }

    ul.list-unstyled li.current {
        background: #ededed;
        color: #222;
    }

    .tab-content {
        display: none;
    }

    .tab-content.current {
        display: inherit;
    }

    ul.list-unstyled li.current {
        background: #ededed;
        color: #222;
    }

    @media screen and (max-width: 600px) {
        .dd-list {
            margin-left: -16px;
        }
    }
    .list-role{
        background-color: #f0b762a6;
        padding-top: 16px;
        box-shadow: 0px 0px 3px #282a3
    }
</style>
   <div class="content-wrapper">
       <div class="page-title">
       <div class="row">
           <div class="col-sm-6">
               <h4 class="mb-0">Quản lý quyền</h4>
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
   <div class="row mb-30">
    <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3 list-role">
        <div class="mail-nav " id="menu-left">

            <a href="#" data-target="#modalShowAdd" data-toggle="modal" class="btn btn-primary btn-block ripple m-t-20">
                <i class="fa fa-plus pr-2"></i> Thêm Mới Quyền
            </a>
            <br>
            <ul class="list-unstyled">
                    <li class="tab-link" data-tab="tab-1"><a style="margin-left: 6%;" href="#">
                        <i class="fa fa-genderless text-success"></i>
                        Root
                        <i class="fa fa-edit" onclick="Edit(1,'Root','Full permission on system.')" style="float:right;cursor:pointer;"></i>
                    </a>

                    </li>
                                                    <li class="tab-link" data-tab="tab-2"><a style="margin-left: 6%;" href="#">
                        <i class="fa fa-genderless text-info"></i>
                        Mod
                        <i class="fa fa-edit" onclick="Edit(5,'Mod','')" style="float:right;cursor:pointer;"></i>
                    </a>

                    </li>
                                                    <li class="tab-link" data-tab="tab-3"><a style="margin-left: 6%;" href="#">
                        <i class="fa fa-genderless text-warning"></i>
                        Admin 1
                        <i class="fa fa-edit" onclick="Edit(54,'Admin 1','')" style="float:right;cursor:pointer;"></i>
                    </a>

                    </li>
                                                    <li class="tab-link" data-tab="tab-4"><a style="margin-left: 6%;" href="#">
                        <i class="fa fa-genderless text-danger"></i>
                        Admin 2
                        <i class="fa fa-edit" onclick="Edit(55,'Admin 2','y')" style="float:right;cursor:pointer;"></i>
                    </a>

                    </li>
                                                    <li class="tab-link current" data-tab="tab-5"><a style="margin-left: 6%;" href="#">
                        <i class="fa fa-genderless text-dark"></i>
                        Quản Lí Thông Tin
                        <i class="fa fa-edit" onclick="Edit(57,'Quản Lí Thông Tin','quản lý')" style="float:right;cursor:pointer;"></i>
                    </a>

                    </li>
                                                    <li class="tab-link" data-tab="tab-6"><a style="margin-left: 6%;" href="#">
                        <i class="fa fa-genderless text-info"></i>
                        21
                        <i class="fa fa-edit" onclick="Edit(58,'21','3232')" style="float:right;cursor:pointer;"></i>
                    </a>

                    </li>

            </ul>
        </div>
    </div>
     <div class="col-sm-6 col-lg-7 col-xl-9">
         <div class=" kt-portlet kt-portlet--mobile card card-statistics h-100">
               <div class=" kt-portlet__body">
                   <div class="content-category">
                       <div class="row">
                           <div class="col-12 col-md-12 col-lg-2">
                           </div>
                           <div class="col-12 col-md-12 col-lg-12 col-xl-9">
                               <div class="menu-box">
                                   <ul class="menu-list sortable">
                                       <?php
                                           foreach ($categories as $key => $value) { ?>
                                       <?php if($value->parent_id == 0):?>
                                       <?php $id2 = $value->id?>
                                       <li data-id="<?=$value->id?>" id="menuItem_<?=$value->id?> "
                                           data-postion="<?=$value->position?>">
                                           <a href="javascript:void(0)"><?=$value->name?>
                                               <div class="kt-portlet__head-toolbar">
                                                   <div class="selected-all">
                                                       <label class="toggle"><input data-id="1" data-type="cat"
                                                               onchange="changeActive(<?=$value->id?>)"
                                                               <?=($value->status == 1 ?'checked' : '')?> type="checkbox"
                                                               id="check-show">
                                                           <div class="slide-toggle">
                                                           </div>
                                                       </label>
                                                   </div>
                                               </div>
                                           </a>
                                           <?php recursiveCategory($categories,$id2)?>
                                       </li>
                                       <?php endif?>
                                       <?php }?>
                                   </ul>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
     </div>
   </div>

   {{-- modal --}}

<div class="modal fade" id="kt_modal_edit_cat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
       aria-hidden="true">

       <div class="modal-dialog modal-lg moda_edit_cat" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel">Cập Nhật Danh Mục</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close"> </button>
               </div>
               <div class="modal-body">
                   <input type="hidden" value="UP" class="id_cat" name="package_type">
                   <div class=" form-group">
                       <label style="font-weight: 700;font-size: 15px;">Tên Danh Mục</label>
                       <input class="form-control name_cat" placeholder="Tên danh mục" name="name_update"
                           v-model="title_change" />
                       <span style="color:red;font-size:15px" class="msgcontent_add"></span>
                   </div>
                   <div class="form-group">
                       <label style="font-weight: 700;font-size: 15px;">Mô tả</label>
                       <input type="text" class="form-control description_edit" placeholder="Mô tả" name="descript_update"
                           v-model="description_change" />
                       <span style="color:red;font-size:15px" class="msgcontent_add"></span>
                   </div>
                   <div id="wp-category-update">
                           <div class="form-group wrap-drop-img">
                                   <div class="drop-area" file-name="file">
                                       <input value="347" type="file" id="img-category" class="input-img" multiple="" accept="image/*" onchange="handleFiles(this.files,this)">
                                       <label class="lb-file" for="img-category"></label>
                                   </div>
                               <div id="gallery" class="gallery" data_ids="347">  <img class="lazy" data-original="../assets/upload_lead/e0e25f24a6fcc5d060db413bbbf4a9eb.jpg" alt="avatar" onerror="this.src='/assets/uploads/default-v.png'" src="../assets/upload_lead/e0e25f24a6fcc5d060db413bbbf4a9eb.jpg" style="">
                               </div>
                           </div>
                       </div>
               </div>

               <div class="modal-footer">
                   <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="resetSnippet()">Hủy
                       bỏ</button>
                   <button class="btn btn-primary btn-save-update" onclick="saveUpdateCat()">Lưu</button>
               </div>
           </div>
       </div>
   </div>


@push('scripts')
   <script type="text/javascript" >
       var route          =  "{{ route('admin.category.postion') }}";
       var route_active   =  "{{ route('admin.category.active') }}";
       var route_create   =  "{{ route('admin.category.store') }}";
       var route_show     =  "{{ route('admin.category.show') }}";
       var route_update   =  "{{ route('admin.category.update') }}";
       var route_destroy  =  "{{ route('admin.category.destroy') }}";
   </script>
@endpush

@section('script')
<script type="text/javascript" src="/admin/component/category/drag.js"></script>
<script type="text/javascript" src="/admin/component/category/index.js"></script>

@endsection
@endsection


