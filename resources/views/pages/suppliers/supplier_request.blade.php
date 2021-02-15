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

                    @if($archive)
                    @if(auth()->user()->hasPermission('supplier_delete'))
                        <h1 > @lang('site.all_suppliers') (@lang('site.archive'))</h1>
                    @endif

                        @else
                        <h1 >@lang('site.all_suppliers')</h1>
                    @endif




          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">@lang('site.all_suppliers') </li>
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

                <table id="example1" class="table table-bordered table-striped">

                  <thead>
                  <tr style="text-align:center;">
                    <th >@lang('site.actions')</th>
                    <th  > @lang('site.id')</th>
                    <th >@lang('site.company')</th>
                     <th >  @lang('site.responsible_person')</th>
                    <th > @lang('site.services')</th>
                    <th > @lang('site.products')</th>
                    <th >@lang('site.mobile') </th>
                    <th > @lang('site.phone')</th>
                    <th > @lang('site.whatsapp')</th>
                    <th class="hiddenCols"> @lang('site.fax')</th>
                    <th class="hiddenCols"> @lang('site.email')</th>
                    <th class="hiddenCols" > @lang('site.date')</th>
                    <th class="hiddenCols" > @lang('site.approval')</th>
                    <th class="hiddenCols" > @lang('site.address')</th>
                  </tr>
                  </thead>
                  <tbody>

                  @foreach($suppliers as $supplier)
                      <tr>
                          <td class="options">


                              <div class="option-items">
                                  <div class="icon">
                                    <i class="fas fa-cog"></i>
                                  </div>


                              <a href="{{route('profile', ['id' => $supplier->id])}}" class="btn btn-success"><i class="fa fa-eye"></i></a>
                              @if(!$archive)
                              @if(auth()->user()->hasPermission('supplier_update'))
                                  <a href="{{route('supplier.edit',$supplier->id)}}"  class="btn btn-warning"> <i class="fa fa-edit "></i> </a>
                                  @endif
                                  @endif
                              @if($archive)
                                 @if(auth()->user()->hasPermission('supplier_restore'))
                                  <a  class="btn btn-danger" data-sup_id="{{$supplier->id}}" data-toggle="modal" data-target="#restore"> <i class="fa fa-trash-restore-alt "></i> </a>
                                @endif
                                  @else
                                  @if(auth()->user()->hasPermission('supplier_delete'))
                                  <a  class="btn btn-danger" data-sup_id="{{$supplier->id}}" data-toggle="modal" data-target="#delete"> <i class="fa fa-trash-alt "></i> </a>
                                @endif
                                  @endif
                               </div>
                          </td>
                          <td> {{$supplier->id}} </td>
                          <td> {{$supplier->company}} </td>
                          <td>
                              {{ $supplier->persons[0]->responsible_person }}
                          </td>
                          <td>

                              @foreach($supplier->services as $ser)
                                  <span class="type_service">{{ $ser->service_name }} </span>
                              @endforeach


                          </td>
                          <td>
                              @foreach($supplier->products as $prod)
                                  <span class="type_service">{{ $prod->prod_name }} </span>
                               @endforeach
                          </td>
                          <td>

                              {{ $supplier->persons[0]->mobile }}
                          </td>
                          @if($supplier->phone)
                              <td> {{$supplier->phone}} </td>
                          @else
                              <td> -- </td>
                          @endif

                          <td>
                              {{ $supplier->persons[0]->whatsapp }}
                          </td>
                          @if($supplier->fax)
                              <td> {{$supplier->fax}} </td>
                              @else
                              <td> -- </td>
                          @endif
                          <td> {{$supplier->supplier_email}} </td>
                          <td> {{ \Carbon\Carbon::parse($supplier->created_at)->format('d/m/Y')}} </td>
                          <td> @lang($supplier->accredite) </td>

                          <td> {{$supplier->address}} </td>


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

    <div class="modal fade text-center" id="restore" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" dir="rtl" >
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"> @lang('site.back_supplier')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>@lang('site.take_supplier')</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-dark" data-dismiss="modal">  @lang('site.no') ,  @lang('site.cancel')</button>
                    <form action="{{route('supplier.sup_restore', ['id' => 'test'])}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <input type="hidden" name="sup_id" id="sup_id" value="">
                        <button  type="submit" class="btn btn-outline-dark">  @lang('site.yes') ,  @lang('site.take_back') </button>
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
      "buttons": ["copy", "excel",  "print",  {
          text: '@if($archive) ' +
                        '@lang("site.all_suppliers")  <i class="fa fa-users  ">  </i>' +
                    '@else' +
                        '@if(auth()->user()->hasPermission("supplier_delete"))'+
                             '@lang("site.archive")  <i class="fa fa-trash-alt  ">  </i>' +
                        '@endif'+
                    '@endif',
                   className: '@if(auth()->user()->hasPermission("supplier_delete"))'+
                   'defult'+
                   '@else'+
                   'removeArchive'+
                   '@endif',

          action: function ( e, dt, node, config ){
              @if($archive)
              window.location.href='{{route("supplier")}}'
              @else
                  window.location.href='{{route("archive_suppliers")}}'
              @endif
          }},"colvis"],
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
