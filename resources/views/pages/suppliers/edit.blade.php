<form action="{{route('supplier.update',$data->id)}}" method="post" enctype="multipart/form-data" id="regForm">
    @csrf
    <div class="header-step">
        <span class="step step1"> 1 </span>
        <span class="step step2"> 2 </span>
        <span class="step"> 3 </span>
        <span class="step"> 4 </span>
    </div>
    <div class="tab">
        <h1>@lang('site.supplier_data') </h1>
        <div class="row row-page">
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <input type="text" name="company" value="{{$data->company}}" class="form-control require" placeholder="@lang('site.company')" oninput="this.className = 'form-control'" >
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-building"></i></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" name="fax" class="form-control" value="{{$data->fax}}"  placeholder="@lang('site.fax')" oninput="this.className = 'form-control'">
                    <div class="input-group-append">
                        <div class="input-group-text"><i class="fas fa-fax"></i></div>
                    </div>
                </div>
            </div>


            <div class="col-md-6">
                <div class="input-group mb-3">
                    <select id="countries_states1"class="form-control bfh-countries "
                            data-flags="true"   name="country"    data-country="{{$data->country}}"></select>

                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-flag"></i></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="input-group mb-3">
                    <select class="  bfh-states form-control" name="city" data-state="{{$data->city}}" data-country="countries_states1" oninput="this.className = 'form-control'" required></select>

                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-city"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <input type="text"   name="address" value="{{$data->address}}" class="form-control require" placeholder="@lang('site.address')" oninput="this.className = 'form-control'">

                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-location-arrow"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <input type="text"   name="address_link" value="{{$data->address_link}}" class="form-control " placeholder=" @lang('site.google_map_link') " oninput="this.className = 'form-control'">

                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text"  id="company_phone" name="phone" value="{{$data->phone}}" class="form-control"  placeholder=" @lang('site.phone') " oninput="this.className = 'form-control'" >
                    <div class="input-group-append">
                        <div class="input-group-text"><i class="fas fa-phone"></i></div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="input-group mb-3">
                    <input type="text" id="company_mobile" value="{{$data->company_mobile}}" name="company_mobile" class="form-control "  placeholder=" @lang('site.mobile') " oninput="this.className = 'form-control'" >
                    <input type="text" id="phone_id" class=" bfh-phone" data-country="countries_states1" readonly>
                </div>
                <p class="phone_vaild">  @lang('site.check_mobile') </p>
            </div>

            <div class="col-md-6">
                <div class="input-group mb-3">
                    <input type="email" name="supplier_email" value="{{$data->supplier_email}}" class="form-control require" placeholder=" @lang('site.email')" oninput="this.className = 'form-control'">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-envelope-square"></i></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="input-group mb-3">
                    <input type="text" name="website" class="form-control" value="{{$data->website}}"  placeholder= "@lang('site.website_link') " oninput="this.className = 'form-control'">
                    <div class="input-group-append">
                        <div class="input-group-text"><i class="fab fa-chrome"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group mb-3 image">
                    <input type="file" name="profile_image" class="form-control image-input"  oninput="this.className = 'form-control image-input'">
                    <label for="file">@lang('site.add_image')</label>
                    <div class="input-group-append">
                        <div class="input-group-text"><i class="fas fa-images"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="tab">
        <h1>@lang('site.person_data') </h1>
        <div class="row row-page">
            <div class="col-12 select-preson">
                @foreach($persons as $person)
                    @if($person->supplier_id == $data->id)

                    @if($per_i == 0)
                    <div class="row" style="background: #f4f6f9; border: 1px solid #DDD;padding: 10px 0 0 0;margin: 10px 0 15px 0;">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input type="text" name="persons[{{$per_i}}][responsible_person]" value="{{$person->responsible_person}}" class="form-control require" placeholder="@lang('site.responsible_person')" oninput="this.className = 'form-control'">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input type="text" name="persons[{{$per_i}}][job_title]" value="{{$person->job_title}}" class="form-control require" placeholder=" @lang('site.job') "  oninput="this.className = 'form-control'">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input type="text" name="persons[{{$per_i}}][mobile]"value="{{$person->mobile}}" class="form-control require phone-require" placeholder="@lang('site.mobile')  "  oninput="this.className = 'form-control'">
                                <input type="text" id="phone1_id" class=" bfh-phone bg-light" data-country="countries_states1" readonly>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-mobile"></i></span>
                                </div>

                            </div>
                            <p class="form-phone-invalid">@lang('site.check_mobile')</p>
                        </div>

                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input type="text" name="persons[{{$per_i}}][whatsapp]"  value="{{$person->whatsapp}}"   class="form-control whats-require" placeholder=" @lang('site.whatsapp')  "  oninput="this.className = 'form-control'">
                                <input type="text" id="phone2_id" class=" bfh-phone bg-light" data-country="countries_states1" readonly>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fab fa-whatsapp"></i></span>
                                </div>
                            </div>
                            <p class="form-phone-invalid">@lang('site.check_mobile')</p>

                        </div>

                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input type="email" name="persons[{{$per_i}}][person_email]"  value="{{$person->person_email}}" class="form-control " placeholder=" @lang('site.email')" oninput="this.className = 'form-control'">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-envelope-square"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <button type="button" class="btn btn-success add-new-row "> @lang('site.add_preson') </button>
                            </div>
                        </div>
                    </div>
                        @else
                            <div class="row person-row" style="background: #f4f6f9; border: 1px solid #DDD;padding: 10px 0 0 0;margin: 10px 0 15px 0;">
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <input type="text" name="persons[{{$per_i}}][responsible_person]" value="{{$person->responsible_person}}" class="form-control require" placeholder="@lang('site.responsible_person')" oninput="this.className = 'form-control'">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <input type="text" name="persons[{{$per_i}}][job_title]" value="{{$person->job_title}}" class="form-control require" placeholder=" @lang('site.job') "  oninput="this.className = 'form-control'">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <input type="text" name="persons[{{$per_i}}][mobile]" value="{{$person->mobile}}" class="form-control require phone-require" placeholder="@lang('site.mobile')  "  oninput="this.className = 'form-control'">
                                        <input type="text" id="phone1_id" class=" bfh-phone bg-light" data-country="countries_states1" readonly>
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-mobile"></i></span>
                                        </div>

                                    </div>
                                    <p class="form-phone-invalid">@lang('site.check_mobile')</p>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <input type="text" name="persons[{{$per_i}}][whatsapp]" value="{{$person->whatsapp}}" class="form-control whats-require" placeholder="@lang('site.whatsapp')   "  oninput="this.className = 'form-control'">
                                        <input type="text" id="phone2_id" class=" bfh-phone bg-light" data-country="countries_states1" readonly>
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fab fa-whatsapp"></i></span>
                                        </div>
                                    </div>
                                    <p class="form-phone-invalid">@lang('site.check_mobile')</p>

                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <input type="email" name="persons[{{$per_i}}][person_email]" value="{{$person->person_email}}" class="form-control " placeholder="@lang('site.email') " oninput="this.className = 'form-control'">
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

                        @endif
                        <input type="number" hidden value="{{ $per_i++ }}">
                    @endif
                @endforeach



            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <textarea  class="form-control" name="person_note" placeholder=" @lang('site.note')  " oninput="this.className = 'form-control'" >{{$data->person_note}}</textarea>
                </div>
            </div>

        </div>
    </div>
    <div class="tab">
        <h1> @lang('site.supplier_service') </h1>
        <span class="form-invalid">@lang('site.check_supplier_service')</span>
        <div class="row row-page">
            <div class="col-12 select-service">
                @foreach($service_supplier as $s_sup)
                    @if($s_sup->supplier_id == $data->id)
                        @foreach($services as $ser)
                            @if($s_sup->service_id == $ser->id)
                                <div class="row row-item">
                                    <input type="number" hidden value="{{ $i++ }}">
                                    @if($i==2)
                                        <div class="col-md-5">
                                            <select id='service_selected{{ $i }}' name="Sup_services[]" class="form-control require" oninput="this.className = 'form-control'">
                                                <option></option>
                                                @foreach($services as $service)
                                                    <option value='{{$service->id}}' {{ $ser->id == $service->id ? 'selected' : '' }} >{{ucfirst($service->service_name)}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="input-group mb-3">

                                                <select id='product_selected{{ $i }}' name="products[]" class="form-control  js-example-basic-multiple js-states require"  multiple="multiple" oninput="this.className = 'form-control'">
                                                    @foreach($products as $product)

                                                        @if($ser->id == $product->service_id)
                                                            <option value='{{$product->id}}'
                                                            @foreach($prod_supplier as $p_sup)
                                                                @if($p_sup->supplier_id == $data->id)
                                                                    @if($p_sup->product_id == $product->id)
                                                                        @if($product->service_id == $ser->id)
                                                                            {{ $product->id == $product->id ? 'selected' : '' }}

                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                            >{{$product->prod_name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-success add-row " > @lang('site.add')  </button>
                                        </div>
                                    @else
                                        <div class="col-md-5">
                                            <select id='service_selected{{ $i }}' name="Sup_services[]" class="form-control require" oninput="this.className = 'form-control'">
                                                <option></option>
                                                @foreach($services as $service)
                                                    <option value='{{$service->id}}' {{ $ser->id == $service->id ? 'selected' : '' }} >{{ucfirst($service->service_name)}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="input-group mb-3">

                                                <select id='product_selected{{ $i }}' name="products[]" class="form-control  js-example-basic-multiple js-states require"  multiple="multiple" oninput="this.className = 'form-control'">
                                                    @foreach($products as $product)

                                                        @if($ser->id == $product->service_id)
                                                            <option value='{{$product->id}}'
                                                            @foreach($prod_supplier as $p_sup)
                                                                @if($p_sup->supplier_id == $data->id)
                                                                    @if($p_sup->product_id == $product->id)
                                                                        @if($product->service_id == $ser->id)
                                                                            {{ $product->id == $product->id ? 'selected' : '' }}

                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                            >{{$product->prod_name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-danger remove-row"> @lang('site.delete') </button>
                                        </div>
                                    @endif

                                </div>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <textarea  class="form-control" name="service_note" placeholder=" @lang('site.note')  " oninput="this.className = 'form-control'" >{{$data->service_note}}</textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="tab">
        <h1> @lang('site.supplier_approval') </h1>
        <div class="row row-page supplier-accepted">


            <h6> @lang('site.add_image') <span> png , .jpg , .jpeg.  </span> </h6>
            <div class="col-md-6">
                <div class="input-group mb-3 image">
                    <input type="file" value="{{$data->tax_card_image}}" name="tax_card_image" class="form-control image-input"  oninput="this.className = 'form-control image-input'">
                    <label for="file"> @lang('site.tax_card')</label>
                    <div class="input-group-append">
                        <div class="input-group-text"><i class="fas fa-images"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group mb-3 image">
                    <input type="file" value="{{$data->commercial_register_image}}" name="commercial_register_image" class="form-control image-input"  oninput="this.className = 'form-control image-input'">
                    <label for="file"> @lang('site.commercial_record') </label>
                    <div class="input-group-append">
                        <div class="input-group-text"><i class="fas fa-images"></i></div>
                    </div>
                </div>
            </div>

            

            <h6> @lang('site.add_file')  <span>  pdf , .doc , .docx.</span>  </h6>
            <div class="col-md-6">
                <div class="input-group mb-3 image">
                    <input type="file" value="{{$data->tax_card_pdf}}" name="tax_card_pdf" class="form-control image-input"  oninput="this.className = 'form-control image-input'">
                    <label for="file"> @lang('site.tax_card')</label>
                    <div class="input-group-append">
                        <div class="input-group-text"><i class="fas fa-file-pdf"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group mb-3 image">
                    <input type="file" value="{{$data->commercial_register_pdf}}" name="commercial_register_pdf" class="form-control image-input"  oninput="this.className = 'form-control image-input'">
                    <label for="file"> @lang('site.commercial_record') </label>
                    <div class="input-group-append">
                        <div class="input-group-text"><i class="fas fa-file-pdf"></i></div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <textarea  class="form-control" name="accredite_note" placeholder=" @lang('site.note')  " oninput="this.className = 'form-control'" >{{$data->accredite_note}}</textarea>
                </div>
            </div>
        </div>
    </div>
    <div style="overflow:auto;">
        <div >
            <button class="form-btn" type="button" id="prevBtn" onclick="nextPrev(-1)"> @lang('site.prev') </button>
            <button class="form-btn" type="button" id="nextBtn" onclick="nextPrev(1)">@lang('site.next') </button>
        </div>
    </div>
</form>
