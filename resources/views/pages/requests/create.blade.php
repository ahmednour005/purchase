@extends('pages.requests.resource')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header prequestHeader">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h1 > إنشاء طلب </h1>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item active">أضافة طلب </li>
          <li class="breadcrumb-item"><a href="{{route('home')}}"> @lang('site.home')</a></li>

        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<div class="card prequest ">
    <div class="card-header parent">
        <h5>Create Purchase Request</h5>
    </div>

    <div class="card-body">
        <form action="{{ route("requests.store") }}" class="form" id="form" autocomplete="on" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row justify-content-center mb-1">
                <div class="input-group input-group-sm col-md-6">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="">Date: </span>
                    </div>
                    <input type="date" id="date" name="date" class="form-control" readonly>
                    @if($errors->has('date'))
                        <em class="invalid-feedback">
                            {{ $errors->first('date') }}
                        </em>
                    @endif

                </div>
                <div class="input-group input-group-sm col-md-6">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="">User Name </span>
                    </div>
                    <h5 id="request_number" class="form-control" readonly>{{ $getuser->name }}</h5>
                    <input type="hidden" name="user_id" value="{{$getuser->id}}">
                    <input type="hidden" name="user_location" value="{{$getuser->location}}">
                    @if($errors->has('request_number'))
                        <em class="invalid-feedback">
                            {{ $errors->first('request_number') }}
                        </em>
                    @endif

                </div>
            </div>

            <div class="row justify-content-center mb-1">
                <div class="input-group input-group-sm col-md-6">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="department">Department</label>
                    </div>
                    <select name="department" class="custom-select" id="department" value="{{ old('department') }}" required>

                      <option value="">Choose...</option>
                      <option value="IT">IT</option>
                      <option value="CV">Construction-Civil</option>
                      <option value="Legal Affairs">Legal Affairs</option>
                      <option value="HR">HR</option>
                    </select>
                </div>
                <div class="input-group input-group-sm col-md-6">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="project">Project</label>
                      </div>
                      <select name="project" class="custom-select" id="project">
                        <option value="">Choose...</option>
                        <option value="Aswan Project">aswan_project</option>
                        <option value="New Capital Project">new_capital_cproject</option>
                        <option value="Minya">minya_project</option>
                      </select>
                </div>
            </div>

            <div class="row justify-content-center mb-1">
                <div class="input-group input-group-sm col-md-6">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="site">Site</label>
                      </div>
                      <select name="site" class="custom-select" id="site">
                        <option value="">Choose...</option>
                        <option value="Aswan">Aswan</option>
                        <option value="New Capital">New Capital</option>
                        <option value="Minya">Minya</option>
                      </select>
                </div>
                <div class="input-group input-group-sm col-md-6 mainGroupContainer">
                    <div class="input-group-prepend mainGroup">
                        <label class="input-group-text" for="productOrServiceGroup">Group</label>
                      </div>
                      <select name="main_group_id" class="custom-select " id="productOrServiceGroup">
                        <option value="">Choose..</option>
                        @foreach ($groups as $group)
                          <option value="{{ $group->id }}">{{ $group->group_name }}</option>
                        @endforeach

                      </select>

                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <h5>
                        Items
                    </h5>
                </div>

                <div class="card-body">

                        <div id="items_table" class="table">
                            @foreach (old('items', ['']) as $index => $oldProduct)
                            <div id="item" class="tr">
                                <div class="row">
                                    <div class="col-md-11">
                                        <div class="form-row m-1">
                                            <div class="col-md-4">
                                                <select name="service_id[]" class="form-control SelectProduct getSubGroup"  value="{{ old('department') }}" required>
                                                    <option value="">Choose...</option>
                                                    @foreach ($subGroups as $subGroup)
                                                      <option value="{{ $subGroup->id }}">{{ $subGroup->service_name }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">Please fill out this field.</div>
                                            </div>
                                            <div class="col-md-4">
                                                <select name="product_id[]" class="form-control SelectItem Getitems" value="{{ old('item') }}" required>
                                                    <option value="">Choose...</option>
                                                    @foreach ($products as $product)
                                                       <option value="{{ $product->id }}">{{ $product->prod_name }}</option>
                                                    @endforeach

                                                </select>
                                                <div class="invalid-feedback">Please fill out this field.</div>
                                            </div>
                                            <div><input type="hidden" name="items[]" value="hidden"></div>
                                            <div class="col-md-4">
                                                <input type="number" name="qtreqtopurs[]" placeholder="Qt required to purchase..." class="form-control qrtp" id="qrtp" value="{{ old('qtreqtopurs.' . $index) ?? '' }}"/>
                                                <div class="invalid-feedback">Please fill out this field.</div>
                                            </div>
                                        </div>
                                        <div class="form-row mx-0" >
                                            <div class="col-md-4 no-gutters">
                                                <div class="col-md-12">
                                                    <textarea type="text" name="specifications[]" placeholder="Specifications/Comments..." class="form-control" id="specification" value="{{ old('specifications.' . $index) ?? '' }}" rows="3" cols="10"></textarea>
                                                    <div class="invalid-feedback">Please fill out this field.</div>
                                                </div>
                                            </div>
                                            <div class="col-md-8 no-gutters">
                                                <div class="form-row mb-1 no-gutters">
                                                    <div class="col-md-6">
                                                        <input type="number" name="qtonstores[]" placeholder="Qt On Store..." class="form-control qos" value="{{ old('qtonstores.' . $index) ?? '' }}"/>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="number" name="acqtreqtopurs[]" placeholder="Actually Qt required to purchase..." class="form-control aqrtp" value="{{ old('acqtreqtopurs.' . $index) ?? '' }}" readonly/>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-6">
                                                        <select name="piroirtys[]" class="form-control piroirty" id="piroirty" placeholder="Chosse Currncy">
                                                            <option>Pirority...</option>
                                                            <option value="low">Low (more than 1 week)</option>
                                                            <option value="medium">Medium (within 7 days)</option>
                                                            <option value="high">High (within 3 days)</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select name="units[]" class="form-control unit" id="unit">
                                                            <option value="">Units...</option>
                                                            <option value="Pcs">Pcs</option>
                                                            <option value="M2">M2</option>
                                                            <option value="M3">M3</option>
                                                            <option value="Lit">Lit</option>
                                                            <option value="ML">ML</option>
                                                            <option value="KG">KG</option>
                                                            <option value="Lum">Lum</option>
                                                            <option value="Km">Km</option>
                                                            <option value="inch">inch</option>
                                                            <option value="1000">1000</option>
                                                            <option value="Ton">Ton</option>
                                                            <option value="شكارة">شكارة</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="row-form mt-2 mb-1">
                                        <button type="button" id='edit_row' class=" rounded-pill btn btn-warning btn-sm">Edit</button>
                                    </div>
                                    <div class="row-form mb-1">
                                        <button type="button" id='copy_row' class="rounded-pill btn btn-info btn-sm copy_row">Copy</button>
                                    </div>
                                    <div class="row-form ">
                                        <button type="button" id='delete_row' class="rounded-pill btn btn-danger btn-sm">Delete</button>
                                    </div>
                                </div>
                            </div>
                                <hr>
                            </div>
                            @endforeach
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
     Date.prototype.toDateInputValue = (function() {
     var local = new Date(this);
     local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
     return local.toJSON().slice(0,10);
     });
 
     
     if ($(".tr").length <=1 ){
         $('#delete_row').hide();
     }
     if ($(".tr").length <=1 ){
         $('#edit_row').hide();
     }
     var indexCount = 1;
 
     $('.productOrServiceSelect').select2();
     $('.getSubGroup').select2();
     $('.getSubGroup').select2({
         placeholder: 'Choose Sub Group',
          });
 
     $('.Getitems').select2();
     $('.Getitems').select2({
         placeholder: 'Choose Item',
          });
 
 
     $('#date').val(new Date().toDateInputValue());
     $('.budgetforpiece').prop('readonly', true);
 
     $("#add_row").click(function(e){
         e.preventDefault();
 
         $('#delete_row').show();
         $('#edit_row').show();
         $('.copy_row').hide();
         let $table = $('.table');
         
         
         $table.find('.tr').first().each(function(){
             // $(this).find('.productOrServiceSelect').select2("destroy");
             $(this).find(".SelectProduct").removeClass('productOrServiceSelect');
 
             $(this).find('.getSubGroup').select2("destroy");
             $(this).find(".SelectProduct").removeClass('getSubGroup');
             // }
             // if ($(this).find(".Getitems")[0]){
             $(this).find('.Getitems').select2("destroy");
             $(this).find(".SelectItem").removeClass('Getitems');
 
             $(this).find(".SelectProduct").removeClass('productOrServiceSelect').addClass('productOrServiceSelect');
             $(this).find(".SelectProduct").removeClass('getSubGroup').addClass('getSubGroup');
             $(this).find(".SelectItem").removeClass('Getitems').addClass('Getitems');
         });
 
         
         // indexCount++;
         // let next = indexCount;
         // let last = next-1;
 
         $table.find('input[type=number]').prop('readonly', true);
         $table.find('input[type=text]').prop('readonly', true);
         $table.find('input[type=date]').prop('readonly', true);
         $table.find('textarea').prop('readonly', true);
         $table.find('select').attr("disabled", true);
         let $top= $table.find('div.tr').first();
         let $new = $top.clone(true);
         $table.append($new);
         $new.find('input[type=text]').val('');
         $new.find('input[type=number]').val('');
         $new.find('input[type=number]').prop('readonly', false);
         $new.find('input[type=text]').prop('readonly', false);
         $new.find('input[type=date]').prop('readonly', false);
         $new.find('textarea').prop('readonly', false);
         $new.find('select').attr("disabled", false);
         $new.find('select').val('');
         $new.find('.copy_row').show();
         // $new.find('.budgetforpiece').prop('readonly', true);
 
         // let trLength= $('.tr').length;
         // if(trLength == 2){
         //     console.log("sdfsfa");
         //     {{--  if ($(".productOrServiceSelect"+last)[0]){
         //         $('.productOrServiceSelect'+last).select2("destroy");
         //     }  --}}
         //     {{--  $(".SelectProduct").removeClass (function (index, className) {
         //         return (className.match (/(^|\s)productOrServiceSelect\S+/g) || []).join(' ');
         //     });  --}}
         // }
 
 
        $new.find(".SelectProduct").removeClass('productOrServiceSelect').addClass('productOrServiceSelect');
        $new.find(".SelectProduct").removeClass('getSubGroup').addClass('getSubGroup');
        $new.find(".SelectItem").removeClass('Getitems').addClass('Getitems');
 
 
         $new.find('.productOrServiceSelect').select2();
 
         $new.find('.getSubGroup').select2();
         $new.find('.getSubGroup').select2({
             placeholder: 'Choose Sub Group',
              });
 
         $new.find('.Getitems').select2();
         $new.find('.Getitems').select2({
             placeholder: 'Choose Item',
              });
 
 
         // $('.tr').each(function(){
         //     console.log($(this).index());
         // });
         //     console.log('tr');    
 
     });
 
     $("#edit_row").click(function(e){
         e.preventDefault();
         let $table = $('.table');
         // Edit all table to destroy all other row 
         $table.find('.tr').first().each(function(){
             // $(this).find('.productOrServiceSelect').select2("destroy");
             $(this).find(".SelectProduct").removeClass('productOrServiceSelect');
 
             $(this).find('.getSubGroup').select2("destroy");
             $(this).find(".SelectProduct").removeClass('getSubGroup');
             // }
             // if ($(this).find(".Getitems")[0]){
             $(this).find('.Getitems').select2("destroy");
             $(this).find(".SelectItem").removeClass('Getitems');
 
             $(this).find(".SelectProduct").removeClass('productOrServiceSelect').addClass('productOrServiceSelect');
             $(this).find(".SelectProduct").removeClass('getSubGroup').addClass('getSubGroup');
             $(this).find(".SelectItem").removeClass('Getitems').addClass('Getitems');
         });
 
         $(".SelectProduct").removeClass('productOrServiceSelect').addClass('productOrServiceSelect');
         $(".SelectProduct").removeClass('getSubGroup').addClass('getSubGroup');
         $(".SelectItem").removeClass('Getitems').addClass('Getitems');
 
         $('.productOrServiceSelect').select2();
 
         $('.getSubGroup').select2();
         // $('.getSubGroup').select2({
         //     placeholder: 'Choose Sub Group',
         // });
 
         $('.Getitems').select2();
         // $('.Getitems').select2({
         //     placeholder: 'Choose Sub Group',
         // });
 
         $table.find('input[type=number]').prop('readonly', true);
         $table.find('input[type=text]').prop('readonly', true);
         $table.find('input[type=date]').prop('readonly', true);
         $table.find('textarea').prop('readonly', true);
         $table.find('select').attr("disabled", true);
         $('.copy_row').hide();
         $('.tr').removeClass('asd');
         $(this).parents('.tr').addClass('asd');
         $('.asd select .SelectProduct .SelectItem').select2();
         // $('.asd select').select2({
             // placeholder: 'please Select',
             //  });
         let $new = $('.asd');
         $new.find('input[type=number]').prop('readonly', false);
         $new.find('input[type=text]').prop('readonly', false);
         $new.find('input[type=date]').prop('readonly', false);
         $new.find('textarea').prop('readonly', false);
         $new.find('select').attr("disabled", false);
         $new.find('.copy_row').show();
         // $new.find('.budgetforpiece').prop('readonly', true);
         
         $(this).parents('.tr').find(".SelectProduct").removeClass('productOrServiceSelect').addClass('productOrServiceSelect');
         $(this).parents('.tr').find(".SelectProduct").removeClass('getSubGroup').addClass('getSubGroup');
         $(this).parents('.tr').find(".SelectItem").removeClass('Getitems').addClass('Getitems');
 
         $(this).parents('.tr').find('.productOrServiceSelect').select2();
 
         $(this).parents('.tr').find('.getSubGroup').select2();
         // // $('.getSubGroup').select2({
         // //     placeholder: 'Choose Sub Group',
         // // });
 
         $(this).parents('.tr').find('.Getitems').select2();
         // // $('.Getitems').select2({
         // //     placeholder: 'Choose Sub Group',
         // // });
 
     });
 
     // Copy Button
     $("#copy_row").click(function(e){
        e.preventDefault();
        $('#delete_row').show(); 
         
         /////// 
         $('#edit_row').show();
         const $table = $('.table');
 
         
         let $tr = $(this).parents('.tr');
         // indexCount++;
         console.log(indexCount);
         // let next = indexCount;
         // let last = next-1;
         $table.find('.tr').first().each(function(){
             // $(this).find('.productOrServiceSelect').select2("destroy");
             $(this).find(".SelectProduct").removeClass('productOrServiceSelect');
 
             $(this).find('.getSubGroup').select2("destroy");
             $(this).find(".SelectProduct").removeClass('getSubGroup');
             // }
             // if ($(this).find(".Getitems")[0]){
             $(this).find('.Getitems').select2("destroy");
             $(this).find(".SelectItem").removeClass('Getitems');
 
 
             $(this).find(".SelectProduct").removeClass('productOrServiceSelect').addClass('productOrServiceSelect');
             $(this).find(".SelectProduct").removeClass('getSubGroup').addClass('getSubGroup');
             $(this).find(".SelectItem").removeClass('Getitems').addClass('Getitems');
         });
 
 
         
         
 
         $tr.find('input[type=number]').prop('readonly', true);
         $tr.find('input[type=text]').prop('readonly', true);
         $tr.find('input[type=date]').prop('readonly', true);
         $tr.find('textarea').prop('readonly', true);
         $tr.find('select').attr("disabled", true);
         $('.copy_row').hide();
         $tr.find(".SelectProduct").removeClass('productOrServiceSelect').addClass('productOrServiceSelect');
         $tr.find(".SelectProduct").removeClass('getSubGroup').addClass('getSubGroup');
         $tr.find(".SelectItem").removeClass('Getitems').addClass('Getitems');
         
         // $tr.find('.SelectProduct').select2("destroy");
         // $tr.find('.SelectItem').select2("destroy");
         // let $tr = $(this);
         let $new = $tr.clone(true);
         console.log($new);
         $tr.after($new);
 
         // $('.SelectProduct').select2();
         // $('.SelectItem').select2();
         // $new.find('.SelectProduct').select2('val', '');
         // $new.find('.SelectItem').select2('val', '');
 
         // $new.find('input[type=text]').val('');
         // $new.find('input[type=number]').val('');
         $new.find('input[type=number]').prop('readonly', false);
         $new.find('input[type=text]').prop('readonly', false);
         $new.find('input[type=date]').prop('readonly', false);
         $new.find('textarea').prop('readonly', false);
         $new.find('select').attr("disabled", false);
         $new.find('select').val(function(index, value) {
             return $tr.find('select').eq(index).val();
         });
         $new.find('.copy_row').show();
 
         // $new.find('select').val('');
         // $new.find('.budgetforpiece').prop('readonly', true);
 
         // let trLength= $('.tr').length;
         // if(trLength == 2){
         //     console.log("sdfsfa");
         //     {{--  if ($(".productOrServiceSelect"+last)[0]){
         //         $('.productOrServiceSelect'+last).select2("destroy");
         //     }  --}}
         //     {{--  $(".SelectProduct").removeClass (function (index, className) {
         //         return (className.match (/(^|\s)productOrServiceSelect\S+/g) || []).join(' ');
         //     });  --}}
         // }
 
 
     //    $new.find(".SelectProduct").removeClass('productOrServiceSelect').addClass('productOrServiceSelect');
     //    $new.find(".SelectProduct").removeClass('getSubGroup').addClass('getSubGroup');
     //    $new.find(".SelectItem").removeClass('Getitems').addClass('Getitems');
 
        $(".SelectProduct").removeClass('productOrServiceSelect').addClass('productOrServiceSelect');
        $(".SelectProduct").removeClass('getSubGroup').addClass('getSubGroup');
        $(".SelectItem").removeClass('Getitems').addClass('Getitems');
 
         $new.find('.productOrServiceSelect').select2();
 
         $new.find('.getSubGroup').select2();
         $new.find('.getSubGroup').select2({
             placeholder: 'Choose Sub Group',
         });
 
         $new.find('.Getitems').select2();
         $new.find('.Getitems').select2({
             placeholder: 'Choose Sub Group',
         });
 
     });
 
     $("#delete_row").click(function(e){
         let trLength= $('.tr').length;
         if(trLength == 2){
             $(".SelectProduct").removeClass(function (index, className) {
                 return (className.match (/(^|\s)productOrServiceSelect\S+/g) || []).join(' ');
             });
             $(".SelectProduct").removeClass(function (index, className) {
                 return (className.match (/(^|\s)getSubGroup\S+/g) || []).join(' ');
             });
             $(".SelectItem").removeClass(function (index, className) {
                 return (className.match (/(^|\s)Getitems\S+/g) || []).join(' ');
             });
 
 
             if($('.tr .select2-hidden-accessible')[0]){
                 $('.tr .select2-hidden-accessible').select2("destroy");
                 $('.tr').addClass('asd');
                 $('.asd select').select2();
 
             }
         }
         $('#delete_row').show();
         $(this).parents('.tr').remove();
         if ($(".tr").length <=1 ){
             $('#delete_row').hide();
         }
     });
 
 
     $('.currency').on('change',function(){
         $(this).parents('.tr').find('.budgetforpiece').prop('readonly', false);
     });
     // Sbstraction 2 values to get actual quantity to purchase
     $('#items_table').on('keydown keyup','.tr', function(){
         let qrtp = $(this).find('.qrtp').val();
         let qos =  $(this).find('.qos').val();
         let aqrtp = $(this).find('.aqrtp');
         let subtract = Math.abs(qrtp-qos);
 
         aqrtp.val(subtract);
 
         // Total Row budget
         var totalVaules = [];
         var holderSummution = {};
         var newArraySummution = [];
 
         if (!isNaN($(this).find('.budgetforpiece').val())) {
 
             $('.budgetforpiece').each(function(){
                 let budgetforpiece = Number($(this).val());
                 let aqrtp = $(this).parents('.tr').find('.aqrtp').val();
                 let currencysymbol = $(this).parents('.tr').find('.currency').val();
                 let totalrowbudget = aqrtp * budgetforpiece ;
                 let rowbudget = $(this).parents('.tr').find('.rowbudget');
                  $(rowbudget).val(totalrowbudget);
 
                  totalVaules.push({budget:totalrowbudget , currency:currencysymbol});
 
             });
 
         }
 
 
 
         // array summution budget
           totalVaules.forEach(function(d) {
             if (holderSummution.hasOwnProperty(d.currency)) {
                 holderSummution[d.currency] = holderSummution[d.currency] + d.budget ;
             } else {
                 holderSummution[d.currency] = d.budget;
             }
             });
             for (var prop in holderSummution) {
             newArraySummution.push({ budget: holderSummution[prop], currency: prop + ' + '});
             }
 
             var sumrowbudget=' ';
             $.each(newArraySummution, function(k, v) {
                 for(var prop in v){
                         sumrowbudget += v[prop];
                         $('.sumrowbudget').val(sumrowbudget);
                 }
             });
 
     });
 
 
   });
 
   $('#productOrServiceGroup').select2();
   $('#productOrServiceGroup').select2({
   placeholder: 'Choose Main Group',
    });
 
    $('#form').submit(function() {
     $("select").prop('disabled', false);
     })
 // Make Site required if user select project
 $('select[name=project]').on('propertychange change input', function () {
     if ($(this).val() != '') {
         // $('#provinceselect').show();
         $('#site').prop('required',true);
         {{--  $('#site').addClass('invalid-feedback');  --}}
     } else {
         $('#site').prop('required',false);
         {{--  $('#site').removeClass('invalid-feedback');  --}}
         // $('#provinceselect').hide();
     }
 });
 
     $('#productOrServiceGroup').on('change', function (e) {
         let id = $(this).val();
         $('.SelectProduct').empty();
         $('.Getitems').empty();
       $.ajax({
           type: 'GET',
           url: 'getSubGroupFromGroup/'+id,
           success: function( response){
               var responses = JSON.parse(response);
               $('.SelectProduct').empty();
               responses.forEach(element => {
                   $('.SelectProduct').append(`<option></option><option value="${element['id']}">${element['service_name']}</option>`);
               });
 
           }
       });
   });
 
   $('.SelectProduct').each(function(){
     $(this).on('propertychange change keyUp keyDown', function (e) {
         let id = $(this).val();
        // let id_num = $(this).val();
         console.log(id);
 
         // $(this).children().find('.SelectItem').removeData();
         let _this = $(this);
         _this.parents('.tr').find('.SelectItem').empty();
         console.log($(this));
          $.ajax({
           type: 'GET',
           url: 'getItemFromSubGroup/'+id,
           success: function (response) {
               var responses = JSON.parse(response);
             //   _this.children().find('.SelectItem').html("");
             console.log(responses);
               responses.forEach(element => {
                 //   if ((_this).children().find('.SelectItem').val() !=''){
                 //       console.log('from if');
                     // _this.children().find('.SelectItem option').removeData();
                     // _this.children().find('.SelectItem').append(`<option></option><option value="${element['id_num']}">${element['prod_name']}</option>`);
                 //   }else{
                 console.log('before'+_this.parents('.tr').find('.SelectItem'));
                 //   _this.parents('.tr').find('.SelectItem').empty();
                   console.log('after'+_this.parents('.tr').find('.SelectItem'));
                 //   _this.parents('.tr').find('.SelectItem option').first().remove();
                 //   console.log('from con'+_this.parents('.tr').find('.SelectItem').first());
                 //   _this.children().find('.SelectItem option:nth-child(1)').remove();
                     _this.parents('.tr').find('.SelectItem').append(`<option value=""></option><option value="${element['id']}">${element['prod_name']}</option>`);
                 //   }
               });
             //   _this.children().find('.SelectItem option').removeData();
           }
 
       });
   });
 });
 
 </script>

</script>
@endsection
