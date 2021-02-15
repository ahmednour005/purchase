<form action="{{route('supplier.store')}}" method="post" enctype="multipart/form-data" id="regForm">
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
                    <input type="text" name="company" id="company" class="form-control require" placeholder="@lang('site.company') " oninput="this.className = 'form-control'" >
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-building"></i></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" name="fax" class="form-control"  placeholder="@lang('site.fax') " oninput="this.className = 'form-control'">
                    <div class="input-group-append">
                        <div class="input-group-text"><i class="fas fa-fax"></i></div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="input-group mb-3">
                            <select id="countries_states1"class="form-control bfh-countries"
                                    data-flags="true"  name="country"  data-country="مصر"></select>

                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-flag"></i></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="input-group mb-3">
                    <select class="  bfh-states form-control" name="city" data-state="القاهرة" data-country="countries_states1" oninput="this.className = 'form-control'" required></select>

                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-city"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <input type="text"   name="address" class="form-control require" placeholder="@lang('site.address') " oninput="this.className = 'form-control'">

                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-location-arrow"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <input type="text"   name="address_link" class="form-control " placeholder="@lang('site.google_map_link')  " oninput="this.className = 'form-control'">

                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <input type="text" id="company_phone" name="phone" class="form-control "  placeholder="@lang('site.phone')" oninput="this.className = 'form-control'" >
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                </div>

            </div>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <input type="text" id="company_mobile" name="company_mobile" class="form-control "  placeholder="@lang('site.mobile')" oninput="this.className = 'form-control'" >
                    <input type="text" id="phone_id" class=" bfh-phone" data-country="countries_states1" readonly>
                </div>
                <p class="phone_vaild">@lang('site.check_mobile')</p>
            </div>

            <div class="col-md-6">
                <div class="input-group mb-3">
                    <input type="email" name="supplier_email" class="form-control " placeholder="@lang('site.email')" oninput="this.className = 'form-control'">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-envelope-square"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <input type="text" name="website" class="form-control"  placeholder= "@lang('site.website_link') " oninput="this.className = 'form-control'">
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
        <div class="search-result">
        </div>

    </div>
    <div class="tab">
        <h1>@lang('site.person_data') </h1>

        <div class="row row-page">


<div class="col-12 select-preson">
    <div class="row" style="
    background: #f4f6f9;
    border: 1px solid #DDD;
    padding: 10px 0 0 0;
    margin: 10px 0 15px 0;">

                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <input type="text" name="persons[0][responsible_person]" class="form-control require" placeholder="@lang('site.responsible_person')" oninput="this.className = 'form-control'">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <input type="text" name="persons[0][job_title]" class="form-control require" placeholder=" @lang('site.job') "  oninput="this.className = 'form-control'">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <input type="text" name="persons[0][mobile]" class="form-control require phone-require" placeholder="@lang('site.mobile')  "  oninput="this.className = 'form-control'">
                                        <input type="text" id="phone1_id" class=" bfh-phone bg-light" data-country="countries_states1" readonly>
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-mobile"></i></span>
                                        </div>

                                    </div>
                                    <p class="form-phone-invalid">@lang('site.check_mobile')</p>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <input type="text" name="persons[0][whatsapp]" class="form-control whats-require" placeholder=" @lang('site.whatsapp')  "  oninput="this.className = 'form-control'">
                                        <input type="text" id="phone2_id" class=" bfh-phone bg-light" data-country="countries_states1" readonly>
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fab fa-whatsapp"></i></span>
                                        </div>
                                    </div>
                                      <p class="form-phone-invalid">@lang('site.check_mobile')   </p>

                                </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <input type="email" name="persons[0][person_email]" class="form-control " placeholder="@lang('site.email')" oninput="this.className = 'form-control'">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-envelope-square"></i></span>
                                    </div>
                                </div>
                            </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                    <button type="button" class="btn btn-success add-new-row ">@lang('site.add_preson')</button>
                                    </div>
                                </div>
        </div>


</div>
            <div class="col-md-12">
                <div class="form-group">
                    <textarea  class="form-control" name="person_note" placeholder=" @lang('site.note')  " oninput="this.className = 'form-control'" ></textarea>
                </div>
            </div>

        </div>
    </div>

    <div class="tab">
        <h1>@lang('site.supplier_service') </h1>
        <span class="form-service-invalid">@lang('site.check_supplier_service')</span>

        <div class="row row-page">
            <div class="col-12 select-service">

                <div class="row ">

                    <div class="col-md-5">
                        <div class="input-group  mb-3">
                            <select id='default_service' name="Sup_services[]" class="form-control require" oninput="this.className = 'form-control'">
                                <option></option>
                                @foreach($services as $service)
                                    <option value='{{$service->id}}'>{{ucfirst($service->service_name)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="input-group mb-3">
                            <select id='product_service' name="products[]" class="form-control  js-example-basic-multiple js-states require"  multiple="multiple" oninput="this.className = 'form-control'">
                                @foreach($products as $product)
                                    <option value='{{$product->id}}'>{{$product->prod_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-success add-row "> @lang('site.add') </button>
                    </div>

                </div>
                <script></script>

            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <textarea  class="form-control" name="service_note" placeholder="  @lang('site.note')  " oninput="this.className = 'form-control'" ></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="tab">
        <h1> @lang('site.supplier_approval') </h1>
        <div class="row row-page supplier-accepted">

            {{--                                                    image --}}
            <h6> @lang('site.add_image') <span> png , .jpg , .jpeg.  </span> </h6>
            <div class="col-md-6">
                <div class="input-group mb-3 image">
                    <input type="file" name="tax_card_image" class="form-control image-input"  oninput="this.className = 'form-control image-input'">
                    <label for="file">@lang('site.tax_card')</label>
                    <div class="input-group-append">
                        <div class="input-group-text"><i class="fas fa-images"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group mb-3 image">
                    <input type="file" name="commercial_register_image" class="form-control image-input"  oninput="this.className = 'form-control image-input'">
                    <label for="file">@lang('site.commercial_record')</label>
                    <div class="input-group-append">
                        <div class="input-group-text"><i class="fas fa-images"></i></div>
                    </div>
                </div>
            </div>

            {{--                                                    file--}}

            <h6> @lang('site.add_file')  <span>  pdf , .doc , .docx.</span>  </h6>
            <div class="col-md-6">
                <div class="input-group mb-3 image">
                    <input type="file" name="tax_card_pdf" class="form-control image-input"  oninput="this.className = 'form-control image-input'">
                    <label for="file">@lang('site.tax_card') </label>
                    <div class="input-group-append">
                        <div class="input-group-text"><i class="fas fa-file-pdf"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group mb-3 image">
                    <input type="file" name="commercial_register_pdf" class="form-control image-input"  oninput="this.className = 'form-control image-input'">
                    <label for="file">@lang('site.commercial_record')</label>
                    <div class="input-group-append">
                        <div class="input-group-text"><i class="fas fa-file-pdf"></i></div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <textarea  class="form-control" name="accredite_note" placeholder=" @lang('site.note')  " oninput="this.className = 'form-control'" ></textarea>
                </div>
            </div>
        </div>
    </div>
    <div style="overflow:auto;">
        <div >
            <button class="form-btn" type="button" id="prevBtn" onclick="nextPrev(-1)"> @lang('site.prev') </button>

                <button class="form-btn" type="button" id="nextBtn" onclick="nextPrev(1)"> Next </button>


        </div>
    </div>
</form>
