@extends('pages.requests.resource')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Create Purchase Request</h5>
    </div>

    <div class="card-body">
        <form action="{{ route("requests.store") }}" class="form" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row justify-content-center mb-1">
                <div class="input-group input-group-sm col-md-6">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="date">Date:</label>
                    </div>
                    <input type="date" id="date" name="date" class="form-control" value="{{ old('date') }}">
                    @if($errors->has('date'))
                        <em class="invalid-feedback">
                            {{ $errors->first('date') }}
                        </em>
                    @endif
                    {{-- <p class="helper-block">
                        {{ trans('cruds.order.fields.customer_name_helper') }}
                    </p> --}}
                </div>
                <div class="input-group input-group-sm col-md-6">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="request_number">Req #:</label>
                    </div>
                    <input type="text" id="request_number" name="request_number" class="form-control" value="{{ old('request_number') }}">
                    @if($errors->has('request_number'))
                        <em class="invalid-feedback">
                            {{ $errors->first('request_number') }}
                        </em>
                    @endif
                    {{-- <p class="helper-block">
                        {{ trans('cruds.order.fields.customer_email_helper') }}
                    </p> --}}
                </div>
            </div>

            <div class="row justify-content-center mb-1">
                <div class="input-group input-group-sm col-md-6">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="inputGroupSelect01">Department</label>
                    </div>
                    <select name="department" class="custom-select" id="inputGroupSelect01" value="{{ old('department') }}">
                      <option selected>Choose...</option>
                      <option value="IT">IT</option>
                      <option value="Legal Affairs">Legal Affairs</option>
                      <option value="HR">HR</option>
                    </select>
                </div>
                <div class="input-group input-group-sm col-md-6">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Project</label>
                      </div>
                      <select name="project" class="custom-select" id="inputGroupSelect01">
                        <option selected>Choose...</option>
                        <option value="Aswan Project">aswan_project</option>
                        <option value="New Capital Project">new_capital_cproject</option>
                        <option value="Minya">minya_project</option>
                      </select>
                </div>
            </div>

            <div class="row justify-content-center mb-1">
                <div class="input-group input-group-sm col-md-6">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Site</label>
                      </div>
                      <select name="site" class="custom-select" id="inputGroupSelect01">
                        <option selected>Choose...</option>
                        <option value="Aswan">Aswan</option>
                        <option value="New Capital">New Capital</option>
                        <option value="Minya">Minya</option>
                      </select>
                </div>
                <div class="input-group input-group-sm col-md-6">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="productOrServiceGroup">Group</label>
                      </div>
                      <select name="group" class="custom-select " id="productOrServiceGroup">
                       <option></option>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}">{{ $service->service_name }}</option>
                            @endforeach
                      </select>

                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5>
                        Items
                    </h5>
                </div>

                <div class="card-body">

                        <div id="items_table">
                            @foreach (old('items', ['']) as $index => $oldProduct)
                                    <div id="item{{ $index }}" class="tr">
                                        <div class="row mb-1">
                                            <div class="col-md-3">
                                                <select name="items[]" class="custom-select productOrServiceSelect">
                                                    {{--  <option></option>  --}}
                                                         {{--  @foreach($products as $product)
                                                             <option>{{ $product->prod_name }}</option>
                                                         @endforeach  --}}
                                                   </select>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="descriptions[]" placeholder="description..." class="form-control form-control-sm" value="{{ old('descriptions.' . $index) ?? '' }}"/>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="specifications[]" placeholder="specification..." class="form-control form-control-sm" value="{{ old('specifications.' . $index) ?? '' }}"/>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="date" name="dates[]" placeholder="Due Time..." class="form-control form-control-sm" value="{{ old('dates.' . $index) ?? '' }} "/>
                                            </div>
                                        </div>
                                        <div class="row mb-1" >
                                            <div class="col-md-3">
                                                <input type="number" name="qtreqtopurs[]" placeholder="Qt required to purchase..." class="form-control form-control-sm qrtp" value="{{ old('qtreqtopurs.' . $index) ?? '' }}"/>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="number" name="qtonstores[]" placeholder="Qt On Store..." class="form-control form-control-sm qos" value="{{ old('qtonstores.' . $index) ?? '' }}"/>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="number" name="acqtreqtopurs[]" placeholder="Actually Qt required to purchase..." class="form-control form-control-sm aqrtp" value="{{ old('acqtreqtopurs.' . $index) ?? '' }}" readonly/>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="number" name="budgets[]" placeholder="Budget..." class="form-control form-control-sm budget" value="{{ old('budgets.' . $index) ?? '' }}"/>
                                            </div>
                                        {{-- <div class="col-md-1"> --}}
                                        {{-- </div> --}}
                                        </div>
                                        <hr>
                                    </div>

                            @endforeach
                            <div id="item{{ count(old('items', [''])) }}" class="tr"></div>
                        </div>

                    <div class="row mb-3">
                        <div class="col"></div>
                        <div class="col"></div>
                        <div class="col"></div>
                        <div class="col">
                            <input type="text" class="form-control form-control-sm totalbudget" placeholder="Total budget" name="totalbudget" id="totalbudget" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button id="add_row" class="btn btn-sm btn-dark pull-left">+ Add Row</button>
                            <button name="remove" id='delete_row' class="float-right btn btn-danger btn-sm">X</button>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <input class="btn btn-success" type="submit" value="Save Request">
            </div>
        </form>


    </div>
</div>
@endsection

@section('scripts')
<script>
   $(document).ready(function(){
    let row_number = {{ count(old('items', [''])) }};
    console.log(row_number);

    if (row_number<=1) {
        $("#delete_row").hide();
    }

    $("#add_row").click(function(e){
       e.preventDefault();

      let new_row_number = row_number - 1;
      console.log(row_number);
      console.log(new_row_number);
      $('#item' + row_number).html($('#item' + new_row_number).html());

      $('#items_table').append('<div id="item' + (row_number + 1) + '" class="tr"></div>');
      row_number++;

      if (row_number>=2) {
        $("#delete_row").show();
        }
    });

    $("#delete_row").click(function(e){
      e.preventDefault();
      console.log(row_number);
      if(row_number > 1){
        $("#item" + (row_number - 1)).html('');
        row_number--;
      }
      if (row_number<=1) {
        $("#delete_row").hide();
        }
    //  const form = $(this).parents();
    //  $(this).parents('').remove();
    });

    // $(".qrtp, .qos").on("keydown keyup", function(event) {
    //     $(".aqrtp").val(Math.abs(Number($(".qrtp").val()) - Number($(".qos").val())));

    // });

    // Sbstraction 2 values to get actual quantity to purchase
    $('#items_table').on('keydown keyup','.tr', function(){
        let qrtp = $(this).find('.qrtp').val();
        let qos =  $(this).find('.qos').val();

        let subtract = Math.abs(qrtp-qos);
        $(this).find('.aqrtp').val(subtract);

        // Total budget
        if (!isNaN($(this).find('.budget').val())) {
            let totalbudget = 0;
            $('.budget').each(function(){
                let sumtotalvalue = Number($(this).val());
                totalbudget += isNaN(sumtotalvalue) ? 0 : sumtotalvalue;
            });
            $('.totalbudget').val(totalbudget);
        }
    });


  });

  $('#productOrServiceGroup').select2();
  $('#productOrServiceGroup').select2({
  placeholder: 'Choose Group Service Or Product',
   });
    {{--  $('.productOrServiceSelect').select2();
    $('.productOrServiceSelect').select2({
    placeholder: 'Choose Service Or Product',
    });  --}}

    $('#productOrServiceGroup').on('change', function (e) {
        let id = $(this).val();
        $('.productOrServiceSelect').empty();
      $.ajax({
          type: 'GET',
          url: 'getProductsOrServiceFromGroup/'+id,
          success: function (response) {
              var responses = JSON.parse(response);
              $('.productOrServiceSelect').empty();
              responses.forEach(element => {
                  $('.productOrServiceSelect').append(`<option value="${element['id']}">${element['prod_name']}</option>`);
              });
          }
      });
  });

</script>
@endsection
