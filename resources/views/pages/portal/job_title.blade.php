<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>EECGroup |  Job Title </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" type="text/css" href="{{asset('plugins/select2/dist/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
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

  <div class="content-wrapper">
      <div class="overlay"></div>

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-md-6">
            <h1 >Job Titles</h1>
          </div>
          <div class="col-md-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">المسمى الوظيفى  </li>
              <li class="breadcrumb-item"><a href="{{route('home')}}"> @lang('site.home')</a></li>

            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content service-content">
      <div class="container-fluid">
        <div class="row">
                    @if($data)

                    <div class="col-md-4">
                        <div class="add-service">
                    <form action="{{route('job_titles.update',$data->id )}}" method="Post">
                        @csrf
                        <div class="form-group">
                            <label for="Add Service ">تعديل المسمى الوظيفى</label>
                            <input type="text" name="job_title" value="{{$data->job_title}}" class="form-control" required="" oninvalid="this.setCustomValidity('من فضلك أدخل المسمى الوظيفى')"  oninput="setCustomValidity('')" >
                        </div>

                        <div class="form-group">
                            {{ method_field('PUT') }}
                            <input type="submit"  class="btn btn-success" value="@lang('site.edit')">
                        </div>
                    </form>
                </div>
            </div>

                    @else

                    <div class="col-md-4">
                        <div class="add-service">
                        <form action="{{route('job_titles.store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="Add Service ">أضافة مسمى وظيفى </label>
                                <input type="text" name="job_title"  class="form-control" required="" oninvalid="this.setCustomValidity('من فضلك أدخل المسمى الوظيفى')"  oninput="setCustomValidity('')" >
                            </div>

                            <div class="form-group">
                                <input type="submit"  class="btn btn-success" value="@lang('site.add')">
                            </div>
                        </form>
                    </div>
                </div>

                @endif
            <div class="col-md-8">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">

                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr style="text-align:center;">
                    <th  > @lang('site.id')</th>
                    <th  > المسمى الوظيفى</th>
                    <th width="28%">  @lang('site.actions')</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($job_titles as $job_title)
                        <tr>
                            <td>{{$job_title->id}}</td>
                            <td>{{$job_title->job_title}}</td>
                            <td>
                                <div class="service-option">
                                       <a href="{{route('job_titles.edit',$job_title->id)}}" class=" btn btn-warning"><i class="fa fa-edit"></i> @lang('site.edit') </a>
                                       <a  class=" btn btn-danger"  data-jobtitle_id="{{$job_title->id}}" data-toggle="modal" data-target="#jobtitle_delete"><i class="fa fa-trash-alt"></i>  @lang('site.delete')  </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
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

    <div class="modal fade text-center" id="jobtitle_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" dir="rtl" >
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"> حذف المسمى الوظيفى </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                       هل أنت متأكد من حذف المسمى الوظيفى ؟
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-dark" data-dismiss="modal"> @lang('site.no') ,  @lang('site.cancel')</button>
                    <form action="{{route('job_titles.destroy', ['job_title' => 'delete'])}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <input type="hidden" name="jobtitle_id" id="jobtitle_id" value="">
                        <button  type="submit" class="btn btn-outline-dark">  @lang('site.yes') ,  @lang('site.delete') </button>
                    </form>

                </div>
            </div>
        </div>
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
{{-- Select2 --}}
<script src="{{asset('plugins/select2/dist/js/select2.min.js')}}" type="text/javascript"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false,
      "ordering": false,
      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "@lang('site.all')"]],
      columnDefs: [
            {
              targets: "hiddenCols", visible: false
           }
        ],
        "language": {
            search: '<i class="fa fa-filter" aria-hidden="true"></i>',
            searchPlaceholder: ' @lang("site.search")',
            "lengthMenu": "@lang('site.show') _MENU_  @lang('site.records')",
            "paginate": {
                "previous": "@lang('site.prev')",
                "next" : "@lang('site.next')",

            },
            "info":   "@lang('site.show') _START_  @lang('site.from') _TOTAL_  @lang('site.record')",

            buttons: {
                colvis: ' @lang("site.show_data")',
                'print' : ' @lang("site.print")',
                'copy' : ' @lang("site.copy")',
                'excel' : '@lang("site.excel")'
            },
            "emptyTable":     "@lang('site.no_data')",
            "infoEmpty":      "@lang('site.show') 0 @lang('site.from') 0 @lang('site.record')",
            "infoFiltered":   "( @lang('site.search_in') _MAX_  @lang('site.records'))",
        }

    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
<script>
    $('#approval_cycle_select').select2();
    $('#approval_cycle_select').select2({
        placeholder: '@lang("site.add_approvalCycle") ',
    });

    $('#jobtitle_delete').on('show.bs.modal',function(event){
        var button = $(event.relatedTarget);
        var serviceid = button.data('jobtitle_id');
        $('.modal #jobtitle_id').val(serviceid);
    })
</script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}
</body>
</html>
