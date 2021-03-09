
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EECGroup |  @lang('site.users')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('plugins/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <link href="https://fonts.googleapis.com/css?family=Cairo:400,700" rel="stylesheet">

    <style>
        body, h1, h2, h3, h4, h5, h6 {
            font-family: 'Cairo', sans-serif !important;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini accent-success">
<div class="wrapper">

    @include('layouts.navbar')

    @include('layouts.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="overlay"></div>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 >  @lang('site.all_users')</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active"> @lang('site.edit_user')  </li>
                            <li class="breadcrumb-item "><a href="{{route('users.index')}}">  @lang('site.users') </a> </li>
                            <li class="breadcrumb-item"><a href="{{route('home')}}">  @lang('site.home')</a></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content service-content user-edit-content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-12">
                        <div class="card ">
                            <!-- /.card-header -->
                            <div class="card-body text-right">
                                <form action="" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label> @lang('site.name')</label>
                                                <input type="email" name="name"  class="form-control " placeholder="@lang('site.name')" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>  @lang('site.email')</label>
                                                <input type="email" name="email" class="form-control " placeholder="@lang('site.email') " required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label> @lang('site.job_title')</label>
                                                <select id='job_title'  name="job_title" class="form-control" >
                                                    <option </option>
                                                     @foreach($job_titles as $job_title)
                                                           <option value='{{$job_title->job_title}}' >{{ $job_title->job_title }}</option>
                                                     @endforeach
                                                 </select>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>المدير المباشر</label>
                                                <select id='direct_manager'  name="direct_manager" class="form-control" >
                                                   <option </option>
                                                    @foreach($users as $u)
                                                          <option value='{{$u->name}}' >{{ $u->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>القسم </label>
                                                <select id='department'  name="direct_manager" class="form-control" >
                                                   <option </option>
                                                    @foreach($departments as $department)
                                                          <option value='{{$department->department_name}}' >{{ $department->department_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label> كود الموظف </label>
                                                <input type="text" name="code" class="form-control " placeholder="كود الموظف " >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label> الدرجة </label>
                                                <input type="text" name="level" class="form-control " placeholder="درجة الوظيفة" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label>  @lang('site.allow_entry')</label>
                                                <select name="vaild" class="form-control">
                                                    <option  value="1"  > @lang('site.yes')</option>
                                                    <option value="0" > @lang('site.no')</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">

                                        <div class="card card-primary card-tabs">
                                            <div class="card-header p-0 pt-1">
                                              <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                                                <li class="pt-2 px-3"><h3 class="card-title">@lang('site.permissions')</h3></li>
                                                <li class="nav-item">
                                                  <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">@lang('site.suppliers')</a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">@lang('site.users')</a>
                                                </li>

                                              </ul>
                                            </div>
                                            <div class="card-body">
                                              <div class="tab-content" id="custom-tabs-two-tabContent">
                                                <div class="tab-pane fade active show" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                                                    <div class="container ">

                                                        <div class="row">
                                                            <div class="col-5 col-sm-3">
                                                              <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                                                                <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-home" role="tab" aria-controls="vert-tabs-home" aria-selected="true">@lang('site.suppliers')</a>
                                                                <a class="nav-link " id="vert-tabs-mainGroup-tab" data-toggle="pill" href="#vert-tabs-mainGroup" role="tab" aria-controls="vert-tabs-mainGroup" aria-selected="true">@lang('site.mainGroup')</a>
                                                                <a class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill" href="#vert-tabs-profile" role="tab" aria-controls="vert-tabs-profile" aria-selected="false">@lang('site.services')</a>
                                                                <a class="nav-link " id="vert-tabs-messages-tab" data-toggle="pill" href="#vert-tabs-messages" role="tab" aria-controls="vert-tabs-messages" aria-selected="false">@lang('site.products')</a>
                                                              </div>
                                                            </div>
                                                            <div class="col-7 col-sm-9">
                                                              <div class="tab-content" id="vert-tabs-tabContent">
                                                                <div class="tab-pane  fade active show" id="vert-tabs-home" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
                                                                    <div class="roles">
                                                                      <label class="container">
                                                                            <input type="checkbox" name="permissions[]"  value="supplier_read">
                                                                            <span class="checkmark"></span>
                                                                            @lang('site.show')
                                                                        </label>
                                                                    </div>
                                                                    <div class="roles">
                                                                         <label class="container">
                                                                            <input type="checkbox" name="permissions[]"  value="supplier_create">
                                                                            <span class="checkmark"></span>
                                                                            @lang('site.add')
                                                                        </label>
                                                                    </div>
                                                                    <div class="roles">
                                                                         <label class="container">
                                                                            <input type="checkbox" name="permissions[]" value="supplier_update">
                                                                            <span class="checkmark"></span>
                                                                            @lang('site.edit')
                                                                        </label>
                                                                    </div>
                                                                    <div class="roles">
                                                                        <label class="container">
                                                                            <input type="checkbox" name="permissions[]" value="supplier_delete">
                                                                            <span class="checkmark"></span>
                                                                            @lang('site.archive_this')
                                                                        </label>
                                                                    </div>
                                                                    <div class="roles">
                                                                        <label class="container">
                                                                            <input type="checkbox" name="permissions[]"  value="supplier_restore">
                                                                            <span class="checkmark"></span>
                                                                            @lang('site.take_back')
                                                                        </label>
                                                                    </div>
                                                                </div>


                                                                <div class="tab-pane fade" id="vert-tabs-mainGroup" role="tabpanel" aria-labelledby="vert-tabs-mainGroup-tab">
                                                                    <div class="roles">
                                                                  <label class="container">
                                                                        <input type="checkbox" name="permissions[]"  value="mainGroup_read">
                                                                        <span class="checkmark"></span>
                                                                        @lang('site.show')
                                                                    </label>
                                                                </div>
                                                                <div class="roles">
                                                                     <label class="container">
                                                                        <input type="checkbox" name="permissions[]"  value="mainGroup_create">
                                                                        <span class="checkmark"></span>
                                                                        @lang('site.add')
                                                                    </label>
                                                                </div>
                                                                <div class="roles">
                                                                     <label class="container">
                                                                        <input type="checkbox" name="permissions[]" value="mainGroup_update">
                                                                        <span class="checkmark"></span>
                                                                        @lang('site.edit')
                                                                    </label>
                                                                </div>
                                                                <div class="roles">
                                                                    <label class="container">
                                                                        <input type="checkbox" name="permissions[]"  value="mainGroup_delete">
                                                                        <span class="checkmark"></span>
                                                                        @lang('site.delete')
                                                                    </label>
                                                                </div>
                                                            </div>


                                                                <div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">

                                                                        <div class="roles">
                                                                      <label class="container">
                                                                            <input type="checkbox" name="permissions[]"  value="service_read">
                                                                            <span class="checkmark"></span>
                                                                            @lang('site.show')
                                                                        </label>
                                                                    </div>
                                                                    <div class="roles">
                                                                         <label class="container">
                                                                            <input type="checkbox" name="permissions[]" value="service_create">
                                                                            <span class="checkmark"></span>
                                                                            @lang('site.add')
                                                                        </label>
                                                                    </div>
                                                                    <div class="roles">
                                                                         <label class="container">
                                                                            <input type="checkbox" name="permissions[]" value="service_update">
                                                                            <span class="checkmark"></span>
                                                                            @lang('site.edit')
                                                                        </label>
                                                                    </div>
                                                                    <div class="roles">
                                                                        <label class="container">
                                                                            <input type="checkbox" name="permissions[]"  value="service_delete">
                                                                            <span class="checkmark"></span>
                                                                            @lang('site.delete')
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane fade " id="vert-tabs-messages" role="tabpanel" aria-labelledby="vert-tabs-messages-tab">

                                                                            <div class="roles">
                                                                      <label class="container">
                                                                            <input type="checkbox" name="permissions[]"  value="product_read">
                                                                            <span class="checkmark"></span>
                                                                            @lang('site.show')
                                                                        </label>
                                                                    </div>
                                                                    <div class="roles">
                                                                         <label class="container">
                                                                            <input type="checkbox" name="permissions[]" value="product_create">
                                                                            <span class="checkmark"></span>
                                                                            @lang('site.add')
                                                                        </label>
                                                                    </div>
                                                                    <div class="roles">
                                                                         <label class="container">
                                                                            <input type="checkbox" name="permissions[]"  value="product_update">
                                                                            <span class="checkmark"></span>
                                                                            @lang('site.edit')
                                                                        </label>
                                                                    </div>
                                                                    <div class="roles">
                                                                        <label class="container">
                                                                            <input type="checkbox" name="permissions[]" value="product_delete">
                                                                            <span class="checkmark"></span>
                                                                            @lang('site.delete')
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                              </div>
                                                            </div>
                                                          </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">

                                                                    <div class="roles">
                                                                      <label class="container">
                                                                            <input type="checkbox"  name="permissions[]"  value="users_read">
                                                                            <span class="checkmark"></span>
                                                                            @lang('site.show')
                                                                        </label>
                                                                    </div>

                                                                    <div class="roles">
                                                                         <label class="container">
                                                                            <input type="checkbox" name="permissions[]"  value="users_update">
                                                                            <span class="checkmark"></span>
                                                                            @lang('site.edit')
                                                                        </label>
                                                                    </div>



                                                </div>

                                              </div>
                                            </div>
                                          </div>

                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ method_field('PUT') }}
                                                <input type="submit"  class="btn btn-success" value="@lang('site.add')">
                                            </div>
                                        </div>

                                    </div>
                                </form>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->

                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->
@include('layouts.footer')


<!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- DataTables  & Plugins -->
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<!-- AdminLTE App -->

<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<script src="{{asset('plugins/select2/dist/js/select2.min.js')}}" type="text/javascript"></script>
<!-- Page specific script -->
<script>
    $('#direct_manager').select2();
$('#direct_manager').select2({
placeholder: 'أختر المدير المباشر',
});
$('#job_title').select2();
$('#job_title').select2({
placeholder: 'أختر المسمى الوظيفى ',
});
$('#department').select2();
$('#department').select2({
placeholder: 'أختر القسم  ',
});


</script>

<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}
</body>
</html>
