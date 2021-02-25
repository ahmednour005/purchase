<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>EECGroup |  @lang('site.suppliers')</title>

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
    <link rel="stylesheet" href="{{asset('dist/css/rate.css')}}">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="{{asset('dist/css/loader.css') }}">
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
                All Cycle Approval
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Approvals</li>
              <li class="breadcrumb-item"><a href="{{route('home')}}">@lang('site.home')</a></li>

            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content" style="position: relative">
        <div class="table_loader">
            <svg viewBox="0 0 1350 600">
                <text x="50%" y="50%" fill="transparent" text-anchor="middle">
                    EEC  Group
                </text>

            </svg>
        </div>

      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">

                <table id="example1" class="table table-bordered table-striped text-center">
                  <thead>
                    <tr>
                        <th >@lang('site.actions')</th>
                        <th width="5%" > @lang('site.id')</th>
                        <th >Cycle Name</th>
                        <th > Number Of Steps</th>
                        <th > Number Of Users </th>
                        <th > Number Of Groups </th>
                    </tr>
                  </thead>
                  <tbody >
                      @foreach ($approvals as $approval)
                        <tr>
                            <td class="options">
                                <div class="option-items">
                                    <div class="icon">
                                        <i class="fas fa-cog"></i>
                                    </div>
                                    <a href="{{ route('approvals.show',$approval->id) }}" class="btn btn-success"><i class="fa fa-eye"></i></a>
                                    <a href="{{ route('approvals.edit',$approval->id) }}"  class="btn btn-warning"> <i class="fa fa-edit "></i> </a>
                                    <a  class="btn btn-danger" data-sup_id="lk" data-toggle="modal" data-target="#delete"> <i class="fa fa-trash-alt "></i> </a>
                                </div>
                            </td>
                            <td> {{ $approval->id }} </td>
                            <td>{{ $approval->approval_name }}</td>
                            <td>
                                 {{$approval->stepapprovals->count() }}
                            </td>

                            <td>
                                @foreach ($approval->stepapprovals as $steps)
                                 <input type="hidden" value="{{ $i += $steps->users->count() }}">
                                @endforeach
                                {{ $i }}
                            </td>
                            <input type="hidden" value="{{ $i=0 }}">
                            <td>
                                num
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

    </section>

  </div>
    <div class="modal fade text-center" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" dir="rtl" >
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"> @lang('site.archive_supplier')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>@lang('site.confirm_archive')</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-dark" data-dismiss="modal"> @lang('site.no') , @lang('site.cancel')</button>
                    <form action="{{route('supplier.sup_archive', ['id' => 'test'])}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <input type="hidden" name="sup_id" id="sup_id" value="">
                        <button  type="submit" class="btn btn-outline-dark"> @lang('site.yes') , @lang('site.archive') </button>
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
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<!-- Page specific script -->
<script>
   $( function () {
     $("#example1").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false,
      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "@lang('site.all')"]],
      columnDefs: [
            {
              targets: "hiddenCols", visible: false
           }

        ],
      "buttons": ["copy", "excel",  "print","colvis"],
         "language": {
             search: '<i class="fa fa-filter" aria-hidden="true"></i>',
             searchPlaceholder: '@lang("site.search") ',
             "lengthMenu": "@lang('site.show')  _MENU_ @lang('site.records') ",
             "paginate": {
                 "previous": "@lang('site.prev')",
                 "next" : "@lang('site.next')",

             },
             "emptyTable":     "@lang('site.no_data')",
             "info":   "@lang('site.show')  _END_ @lang('site.from') _TOTAL_ @lang('site.record')",
             "infoEmpty":      "@lang('site.show') 0 @lang('site.from') 0 @lang('site.record')",
             "infoFiltered":   "(@lang('site.search_in')  _MAX_  @lang('site.record'))",

             buttons: {
                 colvis: '@lang("site.show_data") <i class="fa fa-eye-slash "> </i> ',
                 'print' : '@lang("site.print") <i class="fa fa-print "> </i> ',
                 'copy' : '@lang("site.copy") <i class="fa fa-copy "> </i>',
                 'excel' : '@lang("site.excel") <i class="fa fa-file-excel "> </i>',

                 buttons: [
                     { extend: 'copy', className: 'btn btn-primary' },
                     { extend: 'excel', className: 'excelButton' }
                 ]
             },

         }
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

  });
</script>
<script>
    $('#delete').on('show.bs.modal',function(event){
         var button = $(event.relatedTarget);
         var supid = button.data('sup_id');
         $('.modal #sup_id').val(supid);
    })
    $('#restore').on('show.bs.modal',function(event){
        var button = $(event.relatedTarget);
        var supid = button.data('sup_id');
        $('.modal #sup_id').val(supid);
    })

</script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}
</body>
</html>
