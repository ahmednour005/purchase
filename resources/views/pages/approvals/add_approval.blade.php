<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>EECGroup |  @lang('site.mainGroup')</title>

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

  <div class="content-wrapper">
      <div class="overlay"></div>

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-md-6">
            <h1 >Add Cycle Approval</h1>
          </div>
          <div class="col-md-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Add Cycle Approval</li>
              <li class="breadcrumb-item"><a href="{{route('home')}}"> @lang('site.home')</a></li>

            </ol>
          </div>
        </div>
      </div>
    </section>


    <section class="content service-content" >
      <div class="container-fluid">
        <div class="row">
                    @if($data)
                    <div class="col-md-12">
                        <div class="add-service">
                            <form action="{{route('main_group.update',$data->id )}}" method="Post">
                                @csrf
                                <div class="form-group">
                                    <label for="Add Service ">@lang('site.edit_mainGroup') </label>
                                    <input type="text" name="group_name" value="{{$data->group_name}}" class="form-control" required="" oninvalid="this.setCustomValidity('@lang('site.check_service')')"  oninput="setCustomValidity('')" >
                                </div>
                                <div class="form-group">
                                    {{ method_field('PUT') }}
                                    <input type="submit"  class="btn btn-success" value="@lang('site.edit')">
                                </div>
                            </form>
                        </div>
                    </div>

                    @else

                    <div class="col-md-12">
                        <div class="card prequest ">
                            <div class="card-header parent">
                                <h5>Create New Cycle Approval</h5>
                            </div>
                        <div class="add-service">
                            <form action="{{route('approvals.store')}}" method="POST" >
                                @csrf
                                <div class="form-group">
                                    <label for="Add Service"> الأسم  </label>
                                    <input type="text" name="approval_name" value="" class="form-control" required="" oninvalid="this.setCustomValidity('@lang('site.check_service')')"  oninput="setCustomValidity('')" >
                                </div>
                                <div class="card" >
                                    <div class="card-header">
                                        أضافة مراحل الموافقات
                                    </div>
                                    <div class="card-body approval-steps">
                                        <div class="row steps ">
                                            <div class="col-sm-12 items">
                                                <div class="row">
                                                   <div class="col-5">
                                                        <div class="form-group">
                                                            <input type="text" name="steps[0][step_name]" value="" placeholder="أسم المرحلة" class="form-control" required="" oninvalid="this.setCustomValidity('@lang('site.check_service')')"  oninput="setCustomValidity('')" >
                                                        </div>
                                                   </div>
                                                   <div class="col-5">
                                                    <select  name="steps[0][][step_users]" class="form-control multi-users  js-example-basic-multiple js-states require"  multiple="multiple" oninput="this.className = 'form-control'">
                                                        @foreach($users as $user)
                                                            <option value='{{$user->id}}'>{{$user->name}}</option>
                                                        @endforeach
                                                    </select>
                                                   </div>
                                                    <div class="col-2 ">
                                                        <button type="button" class="btn btn-danger remove-item">حذف</button>
                                                    </div>
                                                </div>
                                                <hr  >
                                          </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="button" class="btn btn-success add-new-row" >أضافة</button>
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="submit"  class="btn btn-success" value="Add">
                                </div>
                            </form>
                         </div>
                    </div>


                    @endif
          </div>


        </div>

    </section>

  </div>

    <div class="modal fade text-center" id="mainGroup_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" dir="rtl" >
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"> @lang('site.delete_mainGroup') </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        @lang('site.confrim_mainGroup')
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-dark" data-dismiss="modal"> @lang('site.no') ,  @lang('site.cancel')</button>
                    <form action="{{route('main_group.destroy', ['main_group' => 'delete'])}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <input type="hidden" name="mainGroup_id" id="mainGroup_id" value="">
                        <button  type="submit" class="btn btn-outline-dark">  @lang('site.yes') ,  @lang('site.delete') </button>
                    </form>

                </div>
            </div>
        </div>
    </div>

@include('layouts.footer')


  <aside class="control-sidebar control-sidebar-dark">

  </aside>

</div>


<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('plugins/select2/dist/js/select2.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dist/js/demo.js')}}"></script>

<script>

    $('.multi-users').select2();
    $(".multi-users").select2({
        placeholder: "اختر المسئول عن الموافقة"
    });

var index = 0;
var key=1;
   $('.approval-steps .remove-item').hide();
    $('.approval-steps').on('click','.add-new-row', function() {

        index++;
        var count =$('.approval-steps .items').length+1;

        if(count>1){
            $('.approval-steps .remove-item').show();
        }
       var new_item = `

                <div class="col-sm-12 items">

                        <div class="row">
                        <div class="col-5">
                                <div class="form-group">
                                    <input type="text" name=${"steps["+key+"][step_name]"} value=""  placeholder="أسم المرحلة"class="form-control" required="" oninvalid="this.setCustomValidity('@lang('site.check_service')')"  oninput="setCustomValidity('')" >
                                </div>
                        </div>
                        <div class="col-5">
                            <select  name="${"steps["+key+"][][step_users]"}" class="form-control multi-users${index}  js-example-basic-multiple js-states require"  multiple="multiple" oninput="this.className = 'form-control'">
                                @foreach($users as $user)
                                    <option value='{{$user->id}}'>{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                            <div class="col-2 ">
                                <button type="button" class="btn btn-danger remove-item">حذف</button>
                            </div>
                        </div>
                        <hr>
                </div>

               `;



       $(".approval-steps .steps").append(new_item);
       $('.multi-users'+index).select2();
       $(".multi-users"+index).select2({
           placeholder: "اختر المسئول عن الموافقة"
       });
       key++;
    });

    $('.approval-steps').on('click','.remove-item', function() {
        var count =$('.approval-steps .items').length;
        console.log(count);
        if(count <= 2){
            $('.approval-steps .remove-item').hide();
        }
        $(this).parents('.items').remove();
    });


</script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}
</body>
</html>
