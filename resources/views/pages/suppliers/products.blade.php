
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>EECGroup |  @lang('site.products')</title>

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
          <div class="col-md-6">
            <h1 title="جدول يوضح جميع المنتجات التى يقدمها الموردين"> @lang('site.all_products')</h1>
          </div>
          <div class="col-md-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">@lang('site.products') </li>
              <li class="breadcrumb-item"><a href="{{route('home')}}">@lang('site.home')</a></li>

            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content service-content">
      <div class="container-fluid">
        <div class="row">

                    @if($data)
                    @if(auth()->user()->hasPermission("product_update"))
                    <div class="col-md-4">
                        <div class="add-service">
                    <form action="{{route('product.update',$data->id)}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label >@lang('site.add_mainGroupOnly')</label>
                            <select id='edit_main_group_select' name="main_group_id" class="form-control" required=""
                                    oninvalid="this.setCustomValidity('@lang('site.confrim_select_mainGroup')')"  onchange="setCustomValidity('')">
                                <option></option>
                                @foreach($mainGroups as $mainGroup)
                                    <option   value='{{$mainGroup->id}}' {{ $data->main_group_id == $mainGroup->id ? 'selected' : '' }} >{{$mainGroup->group_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Add Service "> @lang('site.edit_product') </label>
                            <select id='edit_user_selected1' name="service_id" class="form-control" required=""
                                    oninvalid="this.setCustomValidity('@lang('site.confrim_select_service')')"  onchange="setCustomValidity('')">
                                <option></option>
                                @foreach($services as $service)
                                    <option value='{{$service->id}}' {{ $data->service_id == $service->id ? 'selected' : '' }} >{{$service->service_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Add Service ">@lang('site.edit_product') </label>
                            <input type="text" name="prod_name" class="form-control"  required="" value="{{$data->prod_name}}"
                                   oninvalid="this.setCustomValidity('@lang('site.confirm_product')')"  oninput="setCustomValidity('')">
                        </div>
                        <div class="form-group">
                             {{ method_field('PUT') }}
                            <input type="submit"  class="btn btn-success" value="@lang('site.edit')">
                        </div>
                    </form>
                </div>
            </div>
            @endif
                    @else
                    @if(auth()->user()->hasPermission("product_create") )
                    <div class="col-md-4">
                        <div class="add-service">
                        <form action="{{route('product.store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label >@lang('site.add_mainGroupOnly')</label>
                                <select id='main_group_select' name="main_group_id" class="form-control" required=""
                                        oninvalid="this.setCustomValidity('@lang('site.confrim_select_mainGroup')')"  onchange="setCustomValidity('')">
                                    <option></option>
                                    @foreach($mainGroups as $mainGroup)
                                        <option value='{{$mainGroup->id}}'>{{$mainGroup->group_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="Add Service ">@lang('site.add_service')</label>
                                <select id='user_selected1' name="service_id" class="form-control" required=""
                                        oninvalid="this.setCustomValidity('@lang('site.confrim_select_service')')"  onchange="setCustomValidity('')">
                                    <option></option>
                                    @foreach($services as $service)
                                        <option value='{{$service->id}}'>{{$service->service_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="Add Service ">@lang('site.add_product')</label>
                                <input type="text" name="prod_name" class="form-control"  required=""
                                       oninvalid="this.setCustomValidity('@lang('site.confirm_product')')"  oninput="setCustomValidity('')">
                            </div>
                            <div class="form-group">
                                <input type="submit"  class="btn btn-success" value="@lang('site.add')">
                            </div>
                        </form>
                    </div>
                </div>
                        @endif
                    @endif

            @if(auth()->user()->hasPermission("product_create") ||
            auth()->user()->hasPermission("product_update") )
                @if($data)
                <div class="col-md-8">
                @else
                    @if(auth()->user()->hasPermission("product_create"))
                        <div class="col-md-8">
                    @else
                    <div class="col-12">
                    @endif
                @endif
            @else
             <div class="col-12">
          @endif


            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">

                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr style="text-align:center;">
                    <th >@lang('site.id')</th>
                    <th > @lang('site.mainGroup') </th>
                    <th > @lang('site.services') </th>
                    <th  > @lang('site.products')</th>
                    <th  > @lang('site.suppliers')</th>
                    @if(auth()->user()->hasPermission("product_update") ||
                    auth()->user()->hasPermission("product_delete"))
                      <th width="28%">  @lang('site.actions')</th>
                      @endif
                  </tr>
                  </thead>
                  <tbody>

                    @foreach($products as $product)
                        <input type="hidden" value="{{$i = 0}}" >
                        <tr>
                            <td>{{$product->id}}</td>
                             <td>
                                {{ $product->mainGroup->group_name}}
                            </td>
                            <td>
                                {{ $product->service->service_name}}
                            </td>
                            <td>{{$product->prod_name}}</td>
                            <td>
                                @foreach($prod_supplier as $prod_sup)
                                    @if($prod_sup->product_id == $product->id)
                                        <input type="hidden" value="{{$i++}}" >
                                    @endif
                                @endforeach
                                {{$i}}
                            </td>
                            @if(auth()->user()->hasPermission("product_update") ||
                            auth()->user()->hasPermission("product_delete"))
                            <td>
                                <div class="service-option">
                                    @if(auth()->user()->hasPermission("product_update"))
                                    <a href="{{route('product.edit',$product->id)}}" class="btn btn-warning"><i class="fa fa-edit "></i> @lang('site.edit') </a>
                                    @endif
                                    @if(auth()->user()->hasPermission("product_delete"))
                                    <a  class=" btn btn-danger"  data-prod_id="{{$product->id}}" data-toggle="modal" data-target="#produst_delete"><i class="fa fa-trash-alt"></i> @lang('site.delete') </a>
                                    @endif
                                </div>
                            </td>
                            @endif
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
    <div class="modal fade text-center" id="produst_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" dir="rtl" >
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"> @lang('site.delete_product')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>@lang('site.confrim_delete_products')</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-dark" data-dismiss="modal"> @lang('site.no') , @lang('site.cancel')</button>
                    <form action="{{route('product.destroy', ['product' => 'delete'])}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <input type="hidden" name="prod_id" id="prod_id" value="">
                        <button  type="submit" class="btn btn-outline-dark"> @lang('site.yes') , @lang('site.delete') </button>
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
<script src="{{asset('plugins/select2/dist/js/select2.min.js')}}" type="text/javascript"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false,
        order:false,
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

    $(document).ready(function(){



     $('#user_selected1').select2();
      $('#user_selected1').select2({
      placeholder: '@lang("site.add_service") ',
    });
    $('#main_group_select').select2();
    $('#main_group_select').select2({
    placeholder: '@lang("site.add_mainGroupOnly") ',
  });



  $('#edit_user_selected1').select2();
  $('#edit_user_selected1').select2({
  placeholder: '@lang("site.add_service") ',
});
$('#edit_main_group_select').select2();
$('#edit_main_group_select').select2({
placeholder: '@lang("site.add_mainGroupOnly") ',
});


    });
    </script>
<script>


    $('#main_group_select').on('change', function (e) {
        let id = $(this).val();
        $('#user_selected1').empty();
      $.ajax({
          type: 'GET',
          url: 'getSubGroupFromMainGroup/'+id,
          success: function (response) {
              var responses = JSON.parse(response);
              $('#user_selected1').empty();
              responses.forEach(element => {
                  $('#user_selected1').append(`<option value="${element['id']}">${element['service_name']}</option>`);
              });
          }
      });
  });

  $('#edit_main_group_select').on('change', function (e) {
    let id = $(this).val();
    $('#edit_user_selected1').empty();
  $.ajax({
      type: 'GET',
      url: 'editgetSubGroupFromMainGroup/'+id,
      success: function (response) {
          var responses = JSON.parse(response);
          $('#edit_user_selected1').empty();
          responses.forEach(element => {
              $('#edit_user_selected1').append(`<option value="${element['id']}">${element['service_name']}</option>`);
          });
      }
  });
});


    $('#produst_delete').on('show.bs.modal',function(event){
        var button = $(event.relatedTarget);
        var prodid = button.data('prod_id');
        $('.modal #prod_id').val(prodid);
    })
</script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}
</body>
</html>
