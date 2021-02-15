@extends('pages.requests.resource')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Create Purchase Request</h5>
    </div>

    <div class="card-body">
        <form action="{{ route("requests.store") }}" class="form" autocomplete="on" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row justify-content-center mb-1">
                <div class="input-group input-group-sm col-md-6">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="">Date: </span>
                    </div>


                    <input type="text" id="date1" name="date" value="{{ $mytime }}" class="form-control" readonly>
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
                        <span class="input-group-text" id="">PR #: </span>
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
                      <label class="input-group-text" >Department</label>
                    </div>
                    <select name="department" class="custom-select" value="{{ old('department') }}">
                      <option selected>Choose...</option>
                      <option value="IT">IT</option>
                      <option value="Legal Affairs">Legal Affairs</option>
                      <option value="HR">HR</option>
                    </select>
                </div>
                <div class="input-group input-group-sm col-md-6">
                    <div class="input-group-prepend">
                        <label class="input-group-text" >Project</label>
                      </div>
                      <select name="project" class="custom-select">
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
                        <label class="input-group-text" >Site</label>
                      </div>
                      <select name="site" class="custom-select">
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


                        <div id="items_table" class="table">
                            @foreach (old('items', ['']) as $index => $oldProduct)
                                    <div id="item" class="tr">
                                        <div class="row mb-1">
                                            <div class="col-md-3">
                                                <select name="items[]" class="custom-select SelectProduct  productOrServiceSelect">
                                                    {{--  <option></option>  --}}
                                                         {{--  @foreach($products as $product)
                                                             <option>{{ $product->prod_name }}</option>
                                                         @endforeach  --}}
                                                </select>


                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="descriptions[]" placeholder="description..." class="form-control" value="{{ old('descriptions.' . $index) ?? '' }}"/>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="specifications[]" placeholder="specification..." class="form-control" value="{{ old('specifications.' . $index) ?? '' }}"/>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="date" name="dates[]" placeholder="Due Time..." class="form-control" value="{{ old('dates.' . $index) ?? '' }} "/>
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" id='edit_row' class="pull-right btn btn-warning btn-sm">Edit</button>
                                            </div>
                                        </div>
                                        <div class="row mb-1" >
                                            <div class="col-md-3">
                                                <input type="number" name="qtreqtopurs[]" placeholder="Qt required to purchase..." class="form-control qrtp" value="{{ old('qtreqtopurs.' . $index) ?? '' }}"/>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="number" name="qtonstores[]" placeholder="Qt On Store..." class="form-control qos" value="{{ old('qtonstores.' . $index) ?? '' }}"/>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="number" name="acqtreqtopurs[]" placeholder="Actually Qt required to purchase..." class="form-control aqrtp" value="{{ old('acqtreqtopurs.' . $index) ?? '' }}" readonly/>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="number" name="budgets[]" placeholder="Budget..." class="form-control budget" value="{{ old('budgets.' . $index) ?? '' }}"/>
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" id='delete_row' class="pull-right btn btn-danger btn-sm">Delete</button>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>

                            @endforeach
                            {{-- <div id="item{{ count(old('items', [''])) }}" class="tr"></div> --}}
                        </div>

                    <div class="row mb-3">
                        <div class="col"></div>
                        <div class="col"></div>
                        <div class="col"></div>
                        <div class="col">
                            <input type="text" class="form-control totalbudget" placeholder="Total budget" name="totalbudget" id="totalbudget" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" id="add_row" class="btn btn-sm btn-dark pull-left">+ Add Row</button>
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
    // let row_number = {{ count(old('items', [''])) }};
    // console.log(row_number);

    // if (row_number<=1) {
    //     $("#delete_row").hide();
    // }

 /*         Date.prototype.toDateInputValue = (function() {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0,10);
    });

*/

    if ($(".tr").length <=1 ){
            $('#delete_row').hide();
    }
    if ($(".tr").length <=1 ){
        $('#edit_row').hide();
}
    var indexCount = 1;

   // $(".SelectProduct").removeClass('productOrServiceSelect').addClass('productOrServiceSelect'+indexCount);
    $('.productOrServiceSelect').select2();
   // $('#date').val(new Date().toDateInputValue());

    $("#add_row").click(function(e){
        e.preventDefault();
        if ($(".productOrServiceSelect")[0]){
            $('.productOrServiceSelect').select2("destroy");
            $(".SelectProduct").removeClass('productOrServiceSelect');
        }

        $('#delete_row').show();
        $('#edit_row').show();
        let $table = $('.table');
        $table.find('input[type=number]').prop('readonly', true);
        $table.find('input[type=text]').prop('readonly', true);
        $table.find('input[type=date]').prop('readonly', true);
        $table.find('select').attr("disabled", true);
        let $top= $table.find('div.tr').first();

       // $('.productOrServiceSelect').select2("destroy");
     //   $(".productOrServiceSelect").attr('class', 'newClass');
        let $new = $top.clone(true);

        $table.append($new);
      //  $('.productOrServiceSelect').select2();
        $new.find('input[type=text]').val('');
        $new.find('input[type=number]').val('');
        $new.find('input[type=number]').prop('readonly', false);
        $new.find('input[type=text]').prop('readonly', false);
        $new.find('input[type=date]').prop('readonly', false);
        $new.find('select').attr("disabled", false);

        indexCount++;
        next = indexCount;
        last = next-1;
       $(".SelectProduct").removeClass('productOrServiceSelect'+last).addClass('productOrServiceSelect'+next);
        $('.productOrServiceSelect'+next).select2();
        if ($(".productOrServiceSelect"+last)[0]){
            $('.productOrServiceSelect'+last).select2("destroy");
        }

    });



    $("#delete_row").click(function(e){
        e.preventDefault();
    //   console.log(row_number);
        $('#delete_row').show();
        $(this).parents('.tr').remove();
        // let count = $(".tr").length;
        // console.log(count);
        if ($(".tr").length <=1 ){
            $('#delete_row').hide();
            $('#edit_row').hide()
        }

            if (!isNaN($(this).find('.budget').val())) {
            let totalbudget = 0;
            // $('.budget').each(function(){
                let sumtotalvalue = Number($(this).val());
                totalbudget -= isNaN(sumtotalvalue) ? 0 : sumtotalvalue;
            // });
            $('.totalbudget').text(totalbudget);
        }
        // });
    });
    $("#edit_row").click(function(e){
        e.preventDefault();
        let $table = $('.table');
        $table.find('input[type=number]').prop('readonly', true);
        $table.find('input[type=text]').prop('readonly', true);
        $table.find('input[type=date]').prop('readonly', true);
        $table.find('select').attr("disabled", true);
        $('.tr').removeClass('asd');
        $(this).parents('.tr').addClass('asd');
        $('.asd select').select2();
        let $new = $('.asd');
        $new.find('input[type=number]').prop('readonly', false);
        $new.find('input[type=text]').prop('readonly', false);
        $new.find('input[type=date]').prop('readonly', false);
        $new.find('select').attr("disabled", false);

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



    $('#productOrServiceGroup').on('change', function (e) {
        let id = $(this).val();
        $('.SelectProduct').empty();
      $.ajax({
          type: 'GET',
          url: 'getProductsOrServiceFromGroup/'+id,
          success: function (response) {
              var responses = JSON.parse(response);
              $('.SelectProduct').empty();
              responses.forEach(element => {
                  $('.SelectProduct').append(`<option value="${element['id']}">${element['prod_name']}</option>`);
              });
          }
      });
  });

</script>
@endsection
