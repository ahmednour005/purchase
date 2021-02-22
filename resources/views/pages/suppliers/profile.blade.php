<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>EECGROUP | @lang('site.profile_page') </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{asset('dist/css/rate.css')}}">
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
            <h1> @lang('site.profile_page')</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item active">@lang('site.profile_page') </li>
                <li class="breadcrumb-item"><a href="{{route('supplier')}}">@lang('site.suppliers')</a></li>
              <li class="breadcrumb-item"><a href="{{route('home')}}"> @lang('site.home')</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content profile-page">
        @foreach($supplier as $sup)
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                    @if($sup->profile_image)
                        <img class="profile-user-img img-fluid img-circle"
                             src="{{asset('Images/Profile/'.$sup->profile_image)}}"
                             alt="صورة شخصية">
                    @else
                        <img class="profile-user-img-not img-fluid img-circle"
                             src="{{asset('Images/user_profile.png')}}"
                             alt="صورة شخصية">
                    @endif

                </div>

                <h3 class="profile-username text-center">

                    {{$sup->company}}
                </h3>


                <ul class="list-group list-group-unbordered mb-3">

                  <li class="list-group-item">
                      @if($sup->phone)
                    <b>@lang('site.phone')</b> <a class="float-right">{{$sup->phone}}</a>
                      @else
                          <b>@lang('site.phone')</b> <a class="float-right"> -- </a>
                      @endif
                  </li>
                    <li class="list-group-item">
                        @if($sup->company_mobile)
                            <b>@lang('site.mobile')</b> <a class="float-right">{{$sup->company_mobile}}</a>
                        @else
                            <b>@lang('site.mobile')</b> <a class="float-right"> -- </a>
                        @endif
                    </li>
                  <li class="list-group-item">
                      @if($sup->fax)
                    <b>@lang('site.fax')</b> <a class="float-right">{{$sup->fax}}</a>
                      @else
                          <b>@lang('site.fax')</b> <a class="float-right"> -- </a>
                      @endif
                  </li>
                    <li class="list-group-item">

                            <b>   @lang('site.date')</b> <a class="float-right">
                            {{ \Carbon\Carbon::parse($sup->created_at)->format('d/m/Y')}}</a>
                    </li>

                </ul>
                  @foreach($archive as $ar)
                  @if ($ar->archive)
                      @if(auth()->user()->hasPermission('supplier_restore'))
                         <form action="{{route('supplier.sup_restore', ['id' => 'profile'])}}" method="POST">
                             @method('DELETE')
                             @csrf
                             <input type="hidden" name="sup_id" id="sup_id" value="{{$sup->id}}">
                             <button type="submit" style="font-size: 13px;" class="btn btn-danger btn-block" ><b>@lang('site.take_back') @lang('site.from') @lang('site.archive')</b></button>
                         </form>
                         @endif
                  @else
                          @if(auth()->user()->hasPermission('supplier_update'))
                     <a href="{{route('supplier.edit',$sup->id)}}" class="btn btn-warning btn-block"><b>@lang('site.edit')</b></a>
                     @endif
                      @endif
                 @endforeach

             </div>
             <!-- /.card-body -->
           </div>
           <!-- /.card -->


         </div>
         <!-- /.col -->
         <div class="col-md-9">
           <div class="card">
             <div class="card-header p-2">
               <ul class="nav nav-pills">
                 <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab"> @lang('site.about')</a></li>
                 <li class="nav-item"><a class="nav-link " href="#persons" data-toggle="tab">@lang('site.responsible')</a></li>
                  <li class="nav-item"><a class="nav-link" href="#services" data-toggle="tab">@lang('site.services')</a></li>
                  <li class="nav-item"><a class="nav-link" href="#accredite" data-toggle="tab">@lang('site.approval')</a></li>
               </ul>
             </div><!-- /.card-header -->
             <div class="card-body">
               <div class="tab-content">
                 <div class="active tab-pane" id="activity">
                   <!-- Post -->
                     <div class="supplier-info">
                         <div class="header-info">
                             <i class="fas fa-envelope-square"></i>  @lang('site.email')
                         </div>
                         <div class="body-info">
                             {{$sup->supplier_email}}
                         </div>
                     </div>

                     <div class="supplier-info">
                     <div class="header-info">
                       <i class="fas fa-flag"></i>  @lang('site.state')
                     </div>
                     <div class="body-info">
                         {{$sup->country}}
                     </div>
                   </div>

                     <div class="supplier-info">
                         <div class="header-info">
                             <i class="fas fa-city"></i>  @lang('site.governorate')
                         </div>
                         <div class="body-info">
                             {{$sup->city}}
                         </div>
                     </div>
                     <div class="supplier-info">
                         <div class="header-info">
                             <i class="fas fa-location-arrow"></i>  @lang('site.address')
                         </div>
                         <div class="body-info">
                             {{$sup->address}}
                         </div>
                     </div>
                     <div class="supplier-info">
                         <div class="header-info">
                             <i class="fas fa-map-marked-alt"></i>  @lang('site.google_map_link')
                         </div>
                         <div class="body-info">   @lang('site.go_address')
                              <a target="_blank" href="{{$sup->address_link}}">

                               @lang('site.here')   </a>

                         </div>
                     </div>
                     <div class="supplier-info">
                         <div class="header-info">
                             <i class="fab fa-chrome"></i> @lang('site.website')
                         </div>
                         <div class="body-info"> @lang('site.go_website')
                          <a target="_blank" href="{{$sup->website}}">

                           @lang('site.here')   </a>
                         </div>
                     </div>
                 </div>

                 <!-- /.tab-pane -->
                   <div class="tab-pane" id="persons">

                       <div class="timeline timeline-inverse person-info">

                           <div class="time-label">
                               <span class="bg-danger">
                                   <i class="fas fa-users"></i> @lang('site.responsible_person') ({{$preson_count}})
                               </span>
                           </div>

                           @foreach($persons as $preson)
                                           <div>
                                               <i class="fas fa-user bg-warning"></i>
                                               <div class="timeline-item">
                                                   <h3 class="timeline-header">  {{$preson->responsible_person}} </h3>
                                                   <div class="timeline-body body-info">

                                                           <div class="persons">

                                                               <p>   <span class="person-info">@lang('site.job') :</span> {{$preson->job_title}} </p>
                                                               <p>   <span class="person-info ">@lang('site.mobile') :</span> {{$preson->mobile}} </p>
                                                               <p>   <span class="person-info"> @lang('site.whatsapp') :</span>
                                                                   @if($preson->whatsapp)
                                                                       {{$preson->whatsapp}} <a target="_blank" href="https://api.whatsapp.com/send?phone={{$preson->whatsapp}}"><i class="fab fa-whatsapp"></i></a>
                                                                   @else
                                                                       --
                                                                   @endif
                                                               </p>
                                                               <p>   <span class="person-info">@lang('site.email') :</span>
                                                                   @if($preson->person_email)
                                                                       {{$preson->person_email}}
                                                                   @else
                                                                       --
                                                                   @endif
                                                               </p>
                                                           </div>


                                                   </div>
                                               </div>

                                           </div>
                           @endforeach

                           @if($sup->person_note)
                               <div class="time-label">
                               <span class="bg-danger">
                                   @lang('site.note')
                               </span>
                               </div>
                               <div>
                                   <i class="fas fa-clipboard bg-success"></i>
                                   <div class="timeline-item">
                                       <div class="timeline-body">
                                           <ul class="product-item">
                                               <li> <span class="profile_type_service"> {{$sup->person_note}}</span></li>
                                           </ul>
                                       </div>
                                   </div>

                               </div>
                           @endif

                       </div>


                   </div>
                   <div class="tab-pane" id="services">
                       <!-- The timeline -->
                       <div class="timeline timeline-inverse">
                           <!-- timeline time label -->
                           <div class="time-label">
                               <span class="bg-danger">

                                  @lang('site.services')  ( {{$serv_count}} )  ,
                                     @lang('site.products')  ( {{$prod_count}} )

                               </span>
                           </div>
                           @foreach($sup->services as $ser)
                               <div>
                                   <i class="fas fa-tools bg-warning"></i>
                                   <div class="timeline-item">
                                       <h3 class="timeline-header"> {{$ser->service_name}} </h3>
                                       <div class="timeline-body">
                                           @foreach($sup->products as $prod)
                                             @if($prod->service_id == $ser->id)
                                                   <ul class="product-item">
                                                       <li> <span class="profile_type_service">  {{$prod->prod_name}}</span></li>
                                                   </ul>
                                               @endif
                                           @endforeach
                                       </div>
                                   </div>
                               </div>
                          @endforeach
                           @if($sup->service_note)
                           <div class="time-label">
                               <span class="bg-danger">
                                   @lang('site.note')
                               </span>
                           </div>
                           <div>
                               <i class="fas fa-clipboard bg-success"></i>
                               <div class="timeline-item">
                                   <div class="timeline-body">
                                       <ul class="product-item">
                                           <li> <span class="profile_type_service"> {{$sup->service_note}}</span></li>
                                       </ul>
                                   </div>
                               </div>

                           </div>
                           @endif




                       </div>
                   </div>
                   <div class="tab-pane" id="accredite">
                       <!-- The timeline -->
                       <div class="timeline timeline-inverse">
                           <div class="time-label">
                       <span class="bg-danger">
                         @lang($sup->accredite)
                       </span>
                           </div>

                           <!-- timeline item -->
                           @if($sup->tax_card_image)
                           <div>
                               <i class="fas fa-image bg-warning"></i>
                               <div class="timeline-item">
                                   <h3 class="timeline-header">   صورة البطاقة الضريبية <span> png , .jpg , .jpeg.  </span></h3>
                                   <div class="timeline-body">
                                       <img class="certifie-image" src="{{asset('Images/Tax_Card/'.$sup->tax_card_image) }}" alt="بطاقة ضريبية">
                                       <a  href="{{ asset('Images/Tax_Card/'.$sup->tax_card_image) }}"><i class="fas fa-download bg-warning" ></i></a>
                                   </div>
                               </div>
                           </div>
                           @endif
                           @if($sup->commercial_register_image)
                           <div>
                               <i class="fas fa-image bg-warning"></i>
                               <div class="timeline-item">
                                   <h3 class="timeline-header"> صورة السجل التجارى <span> png , .jpg , .jpeg.  </span> </h3>
                                   <div class="timeline-body">
                                       <img class="certifie-image" src="{{asset('Images/Commercial_Register/'.$sup->commercial_register_image) }}" alt="سجل تجارى">
                                       <a  href="{{ asset('Images/Commercial_Register/'.$sup->commercial_register_image) }}"><i class="fas fa-download bg-warning" ></i></a>
                                   </div>
                               </div>
                           </div>
                               @endif
                               @if($sup->tax_card_pdf)
                           <div>
                               <i class="fas fa-file-pdf bg-gradient-danger"></i>
                               <div class="timeline-item">
                                   <h3 class="timeline-header"> ملف البطاقة الضريبية <span>  pdf , .doc , .docx.</span>  </h3>
                                   <div class="timeline-body">
                                       <img class="certifie-image" src="{{asset('Images/pdf.jpg') }}" alt="سجل تجارى">
                                       <a  href="{{ asset('uploads/Tax_card/'.$sup->tax_card_pdf) }}"><i class="fas fa-download bg-gradient-danger" ></i></a>
                                   </div>
                               </div>
                           </div>
                               @endif
                               @if($sup->commercial_register_pdf)
                           <div>
                               <i class="fas fa-file-pdf bg-gradient-danger"></i>
                               <div class="timeline-item">
                                   <h3 class="timeline-header">  ملف السجل التجارى<span>  pdf , .doc , .docx.</span>   </h3>
                                   <div class="timeline-body">
                                       <img class="certifie-image" src="{{asset('Images/pdf.jpg') }}" alt="سجل تجارى">
                                       <a  href="{{ asset('uploads/Commercial_Register/'.$sup->commercial_register_pdf) }}"><i class="fas fa-download bg-gradient-danger" ></i></a>
                                   </div>
                               </div>
                           </div>
                           @endif
                           @if($sup->accredite_note)
                               <div class="time-label">
                               <span class="bg-danger">
                                   @lang('site.note')
                               </span>
                               </div>
                               <div>
                                   <i class="fas fa-clipboard bg-success"></i>
                                   <div class="timeline-item">
                                       <div class="timeline-body">
                                           <ul class="product-item">
                                               <li> <span class="profile_type_service"> {{$sup->accredite_note}}</span></li>
                                           </ul>
                                       </div>
                                   </div>

                               </div>
                           @endif
                       </div>
                   </div>
                   <div class="tab-pane" id="timeline">
                   <!-- The timeline -->
                   <div class="timeline timeline-inverse">
                     <!-- timeline time label -->
                     <div class="time-label">
                       <span class="bg-danger">
                         10 Feb. 2014
                       </span>
                     </div>
                     <!-- /.timeline-label -->
                     <!-- timeline item -->
                     <div>
                       <i class="fas fa-envelope bg-primary"></i>

                       <div class="timeline-item">
                         <span class="time"><i class="far fa-clock"></i> 12:05</span>

                         <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                         <div class="timeline-body">
                           Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                           weebly ning heekya handango imeem plugg dopplr jibjab, movity
                           jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                           quora plaxo ideeli hulu weebly balihoo...
                         </div>
                         <div class="timeline-footer">
                           <a href="#" class="btn btn-primary btn-sm">Read more</a>
                           <a href="#" class="btn btn-danger btn-sm">Delete</a>
                         </div>
                       </div>
                     </div>
                     <!-- END timeline item -->
                     <!-- timeline item -->
                     <div>
                       <i class="fas fa-user bg-info"></i>

                       <div class="timeline-item">
                         <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                         <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your friend request
                         </h3>
                       </div>
                     </div>
                     <!-- END timeline item -->
                     <!-- timeline item -->
                     <div>
                       <i class="fas fa-comments bg-warning"></i>

                       <div class="timeline-item">
                         <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>

                         <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                         <div class="timeline-body">
                           Take me to your leader!
                           Switzerland is small and neutral!
                           We are more like Germany, ambitious and misunderstood!
                         </div>
                         <div class="timeline-footer">
                           <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                         </div>
                       </div>
                     </div>
                     <!-- END timeline item -->
                     <!-- timeline time label -->
                     <div class="time-label">
                       <span class="bg-success">
                         3 Jan. 2014
                       </span>
                     </div>
                     <!-- /.timeline-label -->
                     <!-- timeline item -->
                     <div>
                       <i class="fas fa-camera bg-purple"></i>

                       <div class="timeline-item">
                         <span class="time"><i class="far fa-clock"></i> 2 days ago</span>

                         <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                       </div>
                     </div>
                     <!-- END timeline item -->
                     <div>
                       <i class="far fa-clock bg-gray"></i>
                     </div>
                   </div>
                 </div>
                 <!-- /.tab-pane -->

                 <!-- /.tab-pane -->
               </div>
               <!-- /.tab-content -->
             </div><!-- /.card-body -->
           </div>
           <!-- /.card -->
         </div>
         <!-- /.col -->
       </div>
       <!-- /.row -->
     </div><!-- /.container-fluid -->
       @endforeach
   </section>
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
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>

</body>
</html>
