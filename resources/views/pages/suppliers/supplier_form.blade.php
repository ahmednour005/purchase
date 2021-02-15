<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>EECGroup | @lang('site.add_supplier')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <!-- Select2 CSS -->
<link rel="stylesheet" type="text/css" href="{{asset('plugins/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('dist/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('dist/css/bootstrap-formhelpers.min.css')}}">
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
            <h1> @lang('site.suppliers')
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                @if($data)
              <li class="breadcrumb-item active"> @lang('site.edit_supplier') </li>
               <li class="breadcrumb-item"><a href="{{route('supplier')}}">@lang('site.suppliers')</a></li>
                @else
                    <li class="breadcrumb-item active"> @lang('site.add_supplier') </li>
                @endif
              <li class="breadcrumb-item"><a href="{{route('home')}}"> @lang('site.home')</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content form-i_request" dir="rtl">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-info">
              <div class="card-header">
                  @if($data)
                <h3 class="card-title">@lang('site.edit_supplier') </h3>
              @else
                      <h3 class="card-title">@lang('site.add_new_supplier')</h3>
              @endif
                <!-- <div class="file-upload-div" dir="ltr">
                  <form method="post" enctype="multipart/form-data" action="#">
                      <div class="form-group">
                        <input type="submit" name="upload" class="upload_btn btn btn-primary" value="@lang('site.confirm')">
                          <input class="select_file" type="file" name="select_file" value=".xls, .xslx"/>
                        </div>
                  </form>
                </div> -->
              </div>
                <main   class="checkout">
                        <div class="card-data login-card">
                            <div class="row no-gutters">
                                <div class="col-12 ">
                                    <div class="card-body">
                                        @if($data)
                                            @include('pages.suppliers.edit')
                                        @else
                                            @include('pages.suppliers.add')
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                </main>

            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
      <div class="modal fade text-center" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" dir="rtl" >
          <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle" > @lang('site.archive_supplier')</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">

                      <p>  @lang('site.confirm_archive')</p>
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
                      <h5 class="modal-title" id="exampleModalLongTitle">@lang('site.back_supplier')</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <p>@lang('site.take_supplier')</p>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-outline-dark" data-dismiss="modal"> @lang('site.no') , @lang('site.cancel')</button>
                      <form action="{{route('supplier.sup_restore', ['id' => 'test'])}}" method="POST">
                          @method('DELETE')
                          @csrf
                          <input type="hidden" name="sup_id" id="sup_id1" value="">
                          <button  type="submit" class="btn btn-outline-dark"> @lang('site.yes') , @lang('site.take_back') </button>
                      </form>

                  </div>
              </div>
          </div>
      </div>


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
<!-- bs-custom-file-input -->
<script src="{{asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<!-- jQuery -->
<script src="{{asset('dist/js/edit.js')}}"></script>
<script src="{{asset('dist/js/bootstrap-formhelpers.min.js')}}"></script>

<!-- Select2 JS -->
<script src="{{asset('plugins/select2/dist/js/select2.min.js')}}" type="text/javascript"></script>
<!-- Page specific script -->
<script>
$(function () {
  bsCustomFileInput.init();
});

$(document).ready(function(){

    $('#default_service').select2();
    $('#product_service').select2();
    $('#default_service').select2({
        allowClear: true,
        placeholder:"@lang('site.select_service')"
    });
    $("#product_service").select2({
        placeholder: "@lang('site.select_product') "
    });

    $('#default_service').on('change', function () {
        let id = $(this).val();
        $('#product_service').empty();
        $.ajax({
            type: 'GET',
            url: 'getProductsFromService/' + id,
            success: function (response) {
                var response = JSON.parse(response);
                $('#product_service').empty();
                response.forEach(element => {
                    $('#product_service').append(`<option value="${element['id']}">${element['prod_name']}</option>`);
                });
            }
        });
    });
    @if($data)
    //   $('select').prop('disabled',true);
    var i=0;
    for( i = 1 ; i<= {{$serv_count}} ; i++ ){
        @include('layouts.sup_script');
    }

    $('.select-service').on('click','.add-row', function() {
        i++;
        var markup = `
            <div class="row row-item">

                <div class="col-md-5">
                    <select id='service_selected${i}' name="Sup_services[]" class="form-control require" oninput="this.className = 'form-control'">
                        <option></option>
                        @foreach($services as $service)
        <option value='{{$service->id}}' >{{ucfirst($service->service_name)}}</option>
                        @endforeach
        </select>
    </div>
    <div class="col-md-5">
        <div class="input-group mb-3">
            <select id='service_selected${i}product' name="products[]" class="form-control  js-example-basic-multiple js-states require"  multiple="multiple" oninput="this.className = 'form-control'">
                            @foreach($products as $product)
        <option value='{{$product->id}}'>{{$product->prod_name}}</option>
                            @endforeach
        </select>
    </div>
</div>
<div class="col-md-2">
    <button type="button" class="btn btn-danger remove-row"> @lang('site.delete') </button>
</div>
</div>`;

        $(".select-service").append(markup);


        $('#service_selected'+i).select2();
        $('#service_selected'+i+"product").select2();
        $('#service_selected'+i).select2({
            allowClear: true,
            placeholder:"  @lang('site.select_service')"
        });
        $("#service_selected"+i+"product").select2({
            placeholder: "@lang('site.select_product')"
        });



        $('#service_selected'+i ).on('change', function (e) {
            let id = $(this).val();
            let id_select_changed = e.target.id+"product";
          $('#'+id_select_changed).empty();
          $.ajax({
              type: 'GET',
              url: 'getProductsFromService/' + id,
              success: function (response) {
                  var response = JSON.parse(response);
                  $('#'+id_select_changed).empty();
                  response.forEach(element => {
                      $('#'+id_select_changed).append(`<option value="${element['id']}">${element['prod_name']}</option>`);
                  });
              }
          });
      });




    });
    $('.select-service').on('click','.remove-row', function() {
        $(this).parents(".row-item").remove();});




    var index =  {{$person_count}};
    $('.select-preson').on('click','.add-new-row', function() {

        var new_per = `
        <div class="row person-row" style="
        background: #f4f6f9;
        border: 1px solid #DDD;
        padding: 10px 0 0 0;
        margin: 10px 0 15px 0;">

            <div class="col-md-6">
                <div class="input-group mb-3">
                    <input type="text" name=${"persons["+index+"][responsible_person]"} class="form-control require" placeholder="@lang('site.responsible_person')" oninput="this.className = 'form-control'">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <input type="text" name=${"persons["+index+"][job_title]"} class="form-control require" placeholder=" @lang('site.job') "  oninput="this.className = 'form-control'">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                    </div>
                </div>
            </div>
          <div class="col-md-6">
                <div class="input-group mb-3">
                    <input type="text" name=${"persons["+index+"][mobile]"} class="form-control require phone-require" placeholder="@lang('site.mobile')  "  oninput="this.className = 'form-control'">
                    <input type="text"  class=" bfh-phone bg-light append" data-country="countries_states1" readonly>
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-mobile"></i></span>
                    </div>

                </div>
                <p class="form-phone-invalid">@lang('site.check_mobile')</p>
            </div>

             <div class="col-md-6">
                <div class="input-group mb-3">
                    <input type="text" name=${"persons["+index+"][whatsapp]"} class="form-control whats-require" placeholder=" @lang('site.whatsapp')  "  oninput="this.className = 'form-control'">
                    <input type="text" class=" bfh-phone bg-light append" data-country="countries_states1" readonly>
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fab fa-whatsapp"></i></span>
                    </div>
                </div>
                  <p class="form-phone-invalid">@lang('site.check_mobile')</p>

            </div>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <input type="email" name=${"persons["+index+"][person_email]"} class="form-control " placeholder="@lang('site.email') " oninput="this.className = 'form-control'">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-envelope-square"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <button type="button" class="btn btn-danger remove-person"> @lang('site.delete')  </button>
                </div>
            </div>
        </div>
        `;

        $(".select-preson").append(new_per);

        var x = $('#phone_id').val();
        if(x == +20){
            console.log($('.bfh-phone.bg-light.append').val(x));
        }

// person phone
        $(".phone-require").on('keyup',function()
        {
            var phone1_id = $('#phone_id').val();

            var tel = $(this).val();
            if(phone1_id == +20 && tel !='') {

                var regex = /^[1]{1}[1]{1}[0-9]{8}$/;
                var regex1 = /^[1]{1}[2]{1}[0-9]{8}$/;
                var regex2 = /^[1]{1}[5]{1}[0-9]{8}$/;
                var regex3 = /^[1]{1}[0]{1}[0-9]{8}$/;

                if (regex.test(tel) || regex1.test(tel) || regex2.test(tel) || regex3.test(tel)) {
                    $(this).parents().children('.tab .form-phone-invalid' ).css("display","none");
                }else{
                    $(this).parents().children('.tab .form-phone-invalid' ).css("display","block");
                }
            }else{
                $(this).parents().children('.tab .form-phone-invalid' ).css("display","none");
            }
        });

// whats
        $(".whats-require").on('keyup',function()
        {
            var phone_id = $('#phone_id').val();
            var tel = $(this).val();
            if(phone_id == +20 && tel !='') {

                var regex = /^[1]{1}[1]{1}[0-9]{8}$/;
                var regex1 = /^[1]{1}[2]{1}[0-9]{8}$/;
                var regex2 = /^[1]{1}[5]{1}[0-9]{8}$/;
                var regex3 = /^[1]{1}[0]{1}[0-9]{8}$/;


                if (regex.test(tel) || regex1.test(tel) || regex2.test(tel) || regex3.test(tel)) {
                    $(this).parents().children('.tab .form-phone-invalid' ).css("display","none");
                }else{
                    $(this).parents().children('.tab .form-phone-invalid' ).css("display","block");
                }
            }else{
                $(this).parents().children('.tab .form-phone-invalid' ).css("display","none");
            }

        });

        index++;

    });
    $('.select-preson').on('click','.remove-person', function() {
        $(this).parents(".person-row").remove();});

    @else

        //   services
    var i=0;
    $('.select-service').on('click','.add-row', function() {
        i++;
        var markup = `
            <div class="row row-item">

                <div class="col-md-5">
                    <select id='service_selected${i}' name="Sup_services[]" class="form-control require" oninput="this.className = 'form-control'">
                        <option></option>
                        @foreach($services as $service)
        <option value='{{$service->id}}'>{{ucfirst($service->service_name)}}</option>
                        @endforeach
        </select>
    </div>
    <div class="col-md-5">
        <div class="input-group mb-3">
            <select id='service_selected${i}product' name="products[]" class="form-control  js-example-basic-multiple js-states require"  multiple="multiple" oninput="this.className = 'form-control'">
                            @foreach($products as $product)
        <option value='{{$product->id}}'>{{$product->prod_name}}</option>
                            @endforeach
        </select>
    </div>
</div>
<div class="col-md-2">
    <button type="button" class="btn btn-danger remove-row"> @lang('site.delete') </button>
</div>
</div>`;

        $(".select-service").append(markup);



        $('#service_selected'+i).select2();


        $('#service_selected'+i+"product").select2();
        $('#service_selected'+i).select2({
            allowClear: true,
            placeholder:"@lang('site.select_service')"
        });
        $('#service_selected'+i+"product").select2({
            placeholder: "@lang('site.select_product')"
        });

        $('#service_selected'+i ).on('change', function (e) {
              let id = $(this).val();
              let id_select_changed = e.target.id+"product";
            $('#'+id_select_changed).empty();
            $.ajax({
                type: 'GET',
                url: 'getProductsFromService/' + id,
                success: function (response) {
                    var response = JSON.parse(response);
                    $('#'+id_select_changed).empty();
                    response.forEach(element => {
                        $('#'+id_select_changed).append(`<option value="${element['id']}">${element['prod_name']}</option>`);
                    });
                }
            });
        });

    });

    $('.select-service').on('click','.remove-row', function() {
        $(this).parents(".row-item").remove();});

    // person
    // Start from index 1 becouse the first form will start from index 0.
    var index = 1;
    $('.select-preson').on('click','.add-new-row', function() {

        var new_per = `
        <div class="row person-row" style="
        background: #f4f6f9;
        border: 1px solid #DDD;
        padding: 10px 0 0 0;
        margin: 10px 0 15px 0;">

            <div class="col-md-6">
                <div class="input-group mb-3">
                    <input type="text" name=${"persons["+index+"][responsible_person]"} class="form-control require" placeholder="@lang('site.responsible_person')" oninput="this.className = 'form-control'">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <input type="text" name=${"persons["+index+"][job_title]"} class="form-control require" placeholder=" @lang('site.job') "  oninput="this.className = 'form-control'">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <input type="text" name=${"persons["+index+"][mobile]"} class="form-control require phone-require" placeholder="@lang('site.mobile')  "  oninput="this.className = 'form-control'">
                    <input type="text"  class=" bfh-phone bg-light append" data-country="countries_states1" readonly>
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-mobile"></i></span>
                    </div>

                </div>
                <p class="form-phone-invalid">@lang('site.check_mobile')</p>
            </div>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <input type="text" name=${"persons["+index+"][whatsapp]"} class="form-control whats-require" placeholder="@lang('site.whatsapp')"  oninput="this.className = 'form-control'">
                    <input type="text" class=" bfh-phone bg-light append" data-country="countries_states1" readonly>
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fab fa-whatsapp"></i></span>
                    </div>
                </div>
                  <p class="form-phone-invalid">@lang('site.check_mobile')</p>

            </div>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <input type="email" name=${"persons["+index+"][person_email]"} class="form-control " placeholder="@lang('site.email')" oninput="this.className = 'form-control'">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-envelope-square"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <button type="button" class="btn btn-danger remove-person"> @lang('site.delete')  </button>
                </div>
            </div>
        </div>
        `;


        $(".select-preson").append(new_per);

        var x = $('#phone_id').val();
        if(x == +20){
            console.log($('.bfh-phone.bg-light.append').val(x));
        }

// person phone
        $(".phone-require").on('keyup',function()
        {
            var phone1_id = $('#phone_id').val();

            var tel = $(this).val();
            if(phone1_id == +20 && tel !='') {

                var regex = /^[1]{1}[1]{1}[0-9]{8}$/;
                var regex1 = /^[1]{1}[2]{1}[0-9]{8}$/;
                var regex2 = /^[1]{1}[5]{1}[0-9]{8}$/;
                var regex3 = /^[1]{1}[0]{1}[0-9]{8}$/;

                if (regex.test(tel) || regex1.test(tel) || regex2.test(tel) || regex3.test(tel)) {
                    $(this).parents().children('.tab .form-phone-invalid' ).css("display","none");
                }else{
                    $(this).parents().children('.tab .form-phone-invalid' ).css("display","block");
                }
            }else{
                $(this).parents().children('.tab .form-phone-invalid' ).css("display","none");
            }
        });

// whats
        $(".whats-require").on('keyup',function()
        {
            var phone_id = $('#phone_id').val();
            var tel = $(this).val();
            if(phone_id == +20 && tel !='') {

                var regex = /^[1]{1}[1]{1}[0-9]{8}$/;
                var regex1 = /^[1]{1}[2]{1}[0-9]{8}$/;
                var regex2 = /^[1]{1}[5]{1}[0-9]{8}$/;
                var regex3 = /^[1]{1}[0]{1}[0-9]{8}$/;


                if (regex.test(tel) || regex1.test(tel) || regex2.test(tel) || regex3.test(tel)) {
                    $(this).parents().children('.tab .form-phone-invalid' ).css("display","none");
                }else{
                    $(this).parents().children('.tab .form-phone-invalid' ).css("display","block");
                }
            }else{
                $(this).parents().children('.tab .form-phone-invalid' ).css("display","none");
            }

        });



        index++;

    });
    $('.select-preson').on('click','.remove-person', function() {
        $(this).parents(".person-row").remove();});


    @endif



    $(document).on('keyup', '#company', function(){
        var search_content = $(this).val();
        if (this.value.length > 2) {
            $.ajax({
                url: "company_search",
                type: "GET",
                data: {search_content},
                dataType: 'json',
                success: function (data) {
                    if(data.row_result) {
                        $('.search-result').html('<div class="container">\n' +
                            '                <h4>  @lang("site.add_supplier_attention")\n' +
                            '                <div class="row">\n' +
                            '                    <div class="col-12">\n' +
                            '                        <table class="table table-bordered table-striped">\n' +
                            '                            <thead>\n' +
                            '                            <tr style="text-align:center;">\n' +
                            '                                <th > @lang("site.id")</th>\n' +
                            '                                <th>@lang("site.name") </th>\n' +
                            '                                <th>@lang("site.state") </th>\n' +
                            '                                <th >@lang("site.governorate")</th>\n' +
                            '                                <th >@lang("site.address")</th>\n' +
                            '                                <th >@lang("site.date")</th>\n' +
                            '                                <th >@lang("site.actions")</th>\n' +
                            '                            </tr>\n' +
                            '                            </thead>\n' +
                            '                            <tbody>' +
                            data.row_result +
                            ' </tbody>\n' +
                            '                        </table>\n' +
                            '                    </div>\n' +
                            '                </div>\n' +
                            '            </div>\n' +
                            '        </div>  ');
                    }else {
                        $('.search-result').html('');
                    }
                },


                error: function (data) {
                    console.log("s");
                }
            });
        }else{
            $('.search-result').html('');
        }
    });


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
        $('.modal #sup_id1').val(supid);
    })

</script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}
</body>
</html>
