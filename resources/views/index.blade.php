<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>EECGroup | لوحة التحكم</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.min.css') }}">
  <link rel="stylesheet" href="{{asset('dist/css/loader.css') }}">

    <link href="https://fonts.googleapis.com/css?family=Cairo:400,700" rel="stylesheet">




    <style>
        body, h1, h2, h3, h4, h5, h6 {
            font-family: 'Cairo', sans-serif !important;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed accent-success" >
<div class="loader">
    <svg viewBox="0 0 1350 600">
        <text x="50%" y="50%" fill="transparent" text-anchor="middle">
            EEC  Group
        </text>

    </svg>
</div>




<div class="wrapper">

    @include('layouts.navbar')
    @include('layouts.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="overlay"></div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">@lang('site.dashboard')</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">@lang('site.dashboard')</li>
              <li class="breadcrumb-item"><a href="{{route('home')}}">@lang('site.home')</a></li>

            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">




            {{--  Supplier  --}}
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box  bg-success">
              <div class="inner">
                  @if($count)
                <h3>{{$count}}</h3>
                      <p>@lang('site.all_suppliers')</p>
                  @else
                      <h3 class="dashboard-alert"><i class="fa fa-exclamation"></i></h3>
                      <p>@lang('site.no_suppliers')</p>
                  @endif
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
              @if(auth()->user()->hasPermission("supplier_read"))
                 <a href="{{route('supplier')}}" class="small-box-footer">  @lang('site.details') <i class="fas fa-arrow-circle-right"></i></a>
            @else
            <a  class="small-box-footer" style="height: 33px"> </a>
            @endif
            </div>
          </div>

{{--  requests  --}}

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box  bg-info">
              <div class="inner">
                  @if($request_count)
                <h3>{{ $request_count }}</h3>
                      <p>@lang('site.all_requests')</p>
                  @else
                      <h3 class="dashboard-alert"><i class="fa fa-exclamation"></i></h3>
                      <p>@lang('site.no_requests')</p>
                  @endif
              </div>
              <div class="icon">
                <i class="fa fa-receipt"></i>
              </div>
              {{--  @if(auth()->user()->hasPermission("supplier_read"))  --}}
                 <a href="{{route('requests.index')}}" class="small-box-footer">  @lang('site.details') <i class="fas fa-arrow-circle-right"></i></a>
            {{--  @else  --}}
                {{--  <a  class="small-box-footer" style="height: 33px"> </a>  --}}
            {{--  @endif  --}}
            </div>
          </div>


{{--  Users  --}}
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box  bg-warning">
                    <div class="inner">
                        @if($users_count)
                            <h3>{{$users_count}}</h3>
                            <p> @lang('site.all_users')</p>
                        @else
                            <h3 class="dashboard-alert"><i class="fa fa-exclamation"></i></h3>
                            <p> @lang('site.no_users')</p>
                        @endif
                    </div>
                    <div class="icon">
                        <i class="fa fa-users-cog"></i>
                    </div>
                    @if(auth()->user()->hasPermission("users_read"))
                    <a href="{{route('users.index')}}" class="small-box-footer">   @lang('site.details') <i class="fas fa-arrow-circle-right"></i></a>
                    @else
                    <a  class="small-box-footer" style="height: 33px"> </a>
                    @endif
                </div>
            </div>


            {{--  Action required  --}}
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box  bg-danger">
                    <div class="inner">
                        @if($users_count)
                            <h3>{{$users_count}}</h3>
                            <p> Action Required</p>
                        @else
                            <h3 class="dashboard-alert"><i class="fa fa-exclamation"></i></h3>
                            <p> Action Required</p>
                        @endif
                    </div>
                    <div class="icon">
                        <i class="fa fa-users-cog"></i>
                    </div>
                    @if(auth()->user()->hasPermission("users_read"))
                    <a href="{{route('users.index')}}" class="small-box-footer">   @lang('site.details') <i class="fas fa-arrow-circle-right"></i></a>
                    @else
                    <a  class="small-box-footer" style="height: 33px"> </a>
                    @endif
                </div>
            </div>

        </div>
        <!-- /.row -->
        <!-- Info boxes -->
        <div class="row" >


          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3 boxes" dir="rtl">

            @if(auth()->user()->hasPermission("mainGroup_read"))
            <a href="{{ route('main_group.index') }}">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-layer-group"></i></span>
              @if($group_count)
              <div class="info-box-content">
                <span class="info-box-text"> @lang('site.mainGroup')</span>
                <span class="info-box-number">{{ $group_count }}</span>
              </div>
                @else
                    <div class="info-box-content">
                        <span class="info-box-text"><i class="fa fa-exclamation"></i></span>
                        <span class="info-box-number no-item"> @lang('site.no_mainGroup')</span>
                      </div>
                @endif
              <!-- /.info-box-content -->
            </div>
            </a>
            @else

            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-layer-group"></i></span>
              @if($group_count)
              <div class="info-box-content">
                <span class="info-box-text"> @lang('site.services')</span>
                <span class="info-box-number">{{ $group_count }}</span>
              </div>
                @else
                    <div class="info-box-content">
                        <span class="info-box-text"><i class="fa fa-exclamation"></i></span>
                        <span class="info-box-number no-item"> @lang('site.no_mainGroup')</span>
                      </div>
                @endif
              <!-- /.info-box-content -->
            </div>

        @endif


            <!-- /.info-box -->
          </div>


          <div class="col-12 col-sm-6 col-md-3 boxes" dir="rtl">

            @if(auth()->user()->hasPermission("service_read"))
            <a href="{{ route('service.index') }}">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-object-group"></i></span>
              @if($ser_count)
              <div class="info-box-content">
                <span class="info-box-text"> @lang('site.services')</span>
                <span class="info-box-number">{{ $ser_count }}</span>
              </div>
                @else
                    <div class="info-box-content">
                        <span class="info-box-text"><i class="fa fa-exclamation"></i></span>
                        <span class="info-box-number no-item"> @lang('site.no_services')</span>
                      </div>
                @endif
              <!-- /.info-box-content -->
            </div>
            </a>
            @else

            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-object-group"></i></span>
              @if($ser_count)
              <div class="info-box-content">
                <span class="info-box-text"> @lang('site.services')</span>
                <span class="info-box-number">{{ $ser_count }}</span>
              </div>
                @else
                    <div class="info-box-content">
                        <span class="info-box-text"><i class="fa fa-exclamation"></i></span>
                        <span class="info-box-number no-item"> @lang('site.no_services')</span>
                      </div>
                @endif
              <!-- /.info-box-content -->
            </div>

        @endif


            <!-- /.info-box -->
          </div>


          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3 boxes" dir="rtl">

            @if(auth()->user()->hasPermission("product_read"))
            <a href="{{ route('product.index') }}">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-box-open"></i></span>
              @if($pros_count)

              <div class="info-box-content">
                <span class="info-box-text"> @lang('site.products')</span>
                <span class="info-box-number">{{ $pros_count }}</span>
              </div>
                @else
                    <div class="info-box-content">
                        <span class="info-box-text"><i class="fa fa-exclamation"></i></span>
                        <span class="info-box-number no-item" >@lang('site.no_products')</span>
                      </div>
                @endif
              <!-- /.info-box-content -->
            </div>
            </a>
            @else

                <div class="info-box mb-3">
                  <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-box-open"></i></span>
                  @if($pros_count)

                  <div class="info-box-content">
                    <span class="info-box-text"> @lang('site.products')</span>
                    <span class="info-box-number">{{ $pros_count }}</span>
                  </div>
                    @else
                        <div class="info-box-content">
                            <span class="info-box-text"><i class="fa fa-exclamation"></i></span>
                            <span class="info-box-number no-item" >@lang('site.no_products')</span>
                          </div>
                    @endif
                  <!-- /.info-box-content -->
                </div>

            @endif


            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>


            <div class="row requests-canvas">
                <div class="col-sm-6 mb-3">

                    <canvas id="myChart" width="400" height="220px" ></canvas>
                </div>
                {{--  calendaer  --}}
                <div class="col-sm-6">
                    <div class="card bg-gradient-success" style="position: relative; left: 0px; top: 0px;">
                        <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">

                          <h3 class="card-title">
                            <i class="far fa-calendar-alt"></i>
                            Calendar
                          </h3>
                          <!-- tools card -->
                          <div class="card-tools">
                            {{--  <div class="btn-group">
                              <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52" aria-expanded="false">
                                <i class="fas fa-bars"></i>
                              </button>
                              <div class="dropdown-menu" role="menu" style="">
                                <a href="#" class="dropdown-item">Add new event</a>
                                <a href="#" class="dropdown-item">Clear events</a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">View calendar</a>
                              </div>
                            </div>  --}}
                            <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                              <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                              <i class="fas fa-times"></i>
                            </button>
                          </div>
                          <!-- /. tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body pt-0" style="display: block;">
                          <!--The calendar -->
                          <div id="calendar" style="width: 100%"><div class="bootstrap-datetimepicker-widget usetwentyfour"><ul class="list-unstyled"><li class="show"><div class="datepicker"><div class="datepicker-days" style=""><table class="table table-sm"><thead><tr><th class="prev" data-action="previous"><span class="fa fa-chevron-left" title="Previous Month"></span></th><th class="picker-switch" data-action="pickerSwitch" colspan="5" title="Select Month">February 2021</th><th class="next" data-action="next"><span class="fa fa-chevron-right" title="Next Month"></span></th></tr><tr><th class="dow">Su</th><th class="dow">Mo</th><th class="dow">Tu</th><th class="dow">We</th><th class="dow">Th</th><th class="dow">Fr</th><th class="dow">Sa</th></tr></thead><tbody><tr><td data-action="selectDay" data-day="01/31/2021" class="day old weekend">31</td><td data-action="selectDay" data-day="02/01/2021" class="day">1</td><td data-action="selectDay" data-day="02/02/2021" class="day">2</td><td data-action="selectDay" data-day="02/03/2021" class="day">3</td><td data-action="selectDay" data-day="02/04/2021" class="day">4</td><td data-action="selectDay" data-day="02/05/2021" class="day">5</td><td data-action="selectDay" data-day="02/06/2021" class="day weekend">6</td></tr><tr><td data-action="selectDay" data-day="02/07/2021" class="day weekend">7</td><td data-action="selectDay" data-day="02/08/2021" class="day">8</td><td data-action="selectDay" data-day="02/09/2021" class="day">9</td><td data-action="selectDay" data-day="02/10/2021" class="day">10</td><td data-action="selectDay" data-day="02/11/2021" class="day">11</td><td data-action="selectDay" data-day="02/12/2021" class="day">12</td><td data-action="selectDay" data-day="02/13/2021" class="day weekend">13</td></tr><tr><td data-action="selectDay" data-day="02/14/2021" class="day weekend">14</td><td data-action="selectDay" data-day="02/15/2021" class="day today">15</td><td data-action="selectDay" data-day="02/16/2021" class="day active">16</td><td data-action="selectDay" data-day="02/17/2021" class="day">17</td><td data-action="selectDay" data-day="02/18/2021" class="day">18</td><td data-action="selectDay" data-day="02/19/2021" class="day">19</td><td data-action="selectDay" data-day="02/20/2021" class="day weekend">20</td></tr><tr><td data-action="selectDay" data-day="02/21/2021" class="day weekend">21</td><td data-action="selectDay" data-day="02/22/2021" class="day">22</td><td data-action="selectDay" data-day="02/23/2021" class="day">23</td><td data-action="selectDay" data-day="02/24/2021" class="day">24</td><td data-action="selectDay" data-day="02/25/2021" class="day">25</td><td data-action="selectDay" data-day="02/26/2021" class="day">26</td><td data-action="selectDay" data-day="02/27/2021" class="day weekend">27</td></tr><tr><td data-action="selectDay" data-day="02/28/2021" class="day weekend">28</td><td data-action="selectDay" data-day="03/01/2021" class="day new">1</td><td data-action="selectDay" data-day="03/02/2021" class="day new">2</td><td data-action="selectDay" data-day="03/03/2021" class="day new">3</td><td data-action="selectDay" data-day="03/04/2021" class="day new">4</td><td data-action="selectDay" data-day="03/05/2021" class="day new">5</td><td data-action="selectDay" data-day="03/06/2021" class="day new weekend">6</td></tr><tr><td data-action="selectDay" data-day="03/07/2021" class="day new weekend">7</td><td data-action="selectDay" data-day="03/08/2021" class="day new">8</td><td data-action="selectDay" data-day="03/09/2021" class="day new">9</td><td data-action="selectDay" data-day="03/10/2021" class="day new">10</td><td data-action="selectDay" data-day="03/11/2021" class="day new">11</td><td data-action="selectDay" data-day="03/12/2021" class="day new">12</td><td data-action="selectDay" data-day="03/13/2021" class="day new weekend">13</td></tr></tbody></table></div><div class="datepicker-months" style="display: none;"><table class="table-condensed"><thead><tr><th class="prev" data-action="previous"><span class="fa fa-chevron-left" title="Previous Year"></span></th><th class="picker-switch" data-action="pickerSwitch" colspan="5" title="Select Year">2021</th><th class="next" data-action="next"><span class="fa fa-chevron-right" title="Next Year"></span></th></tr></thead><tbody><tr><td colspan="7"><span data-action="selectMonth" class="month">Jan</span><span data-action="selectMonth" class="month active">Feb</span><span data-action="selectMonth" class="month">Mar</span><span data-action="selectMonth" class="month">Apr</span><span data-action="selectMonth" class="month">May</span><span data-action="selectMonth" class="month">Jun</span><span data-action="selectMonth" class="month">Jul</span><span data-action="selectMonth" class="month">Aug</span><span data-action="selectMonth" class="month">Sep</span><span data-action="selectMonth" class="month">Oct</span><span data-action="selectMonth" class="month">Nov</span><span data-action="selectMonth" class="month">Dec</span></td></tr></tbody></table></div><div class="datepicker-years" style="display: none;"><table class="table-condensed"><thead><tr><th class="prev" data-action="previous"><span class="fa fa-chevron-left" title="Previous Decade"></span></th><th class="picker-switch" data-action="pickerSwitch" colspan="5" title="Select Decade">2020-2029</th><th class="next" data-action="next"><span class="fa fa-chevron-right" title="Next Decade"></span></th></tr></thead><tbody><tr><td colspan="7"><span data-action="selectYear" class="year old">2019</span><span data-action="selectYear" class="year">2020</span><span data-action="selectYear" class="year active">2021</span><span data-action="selectYear" class="year">2022</span><span data-action="selectYear" class="year">2023</span><span data-action="selectYear" class="year">2024</span><span data-action="selectYear" class="year">2025</span><span data-action="selectYear" class="year">2026</span><span data-action="selectYear" class="year">2027</span><span data-action="selectYear" class="year">2028</span><span data-action="selectYear" class="year">2029</span><span data-action="selectYear" class="year old">2030</span></td></tr></tbody></table></div><div class="datepicker-decades" style="display: none;"><table class="table-condensed"><thead><tr><th class="prev" data-action="previous"><span class="fa fa-chevron-left" title="Previous Century"></span></th><th class="picker-switch" data-action="pickerSwitch" colspan="5">2000-2090</th><th class="next" data-action="next"><span class="fa fa-chevron-right" title="Next Century"></span></th></tr></thead><tbody><tr><td colspan="7"><span data-action="selectDecade" class="decade old" data-selection="2006">1990</span><span data-action="selectDecade" class="decade" data-selection="2006">2000</span><span data-action="selectDecade" class="decade active" data-selection="2016">2010</span><span data-action="selectDecade" class="decade active" data-selection="2026">2020</span><span data-action="selectDecade" class="decade" data-selection="2036">2030</span><span data-action="selectDecade" class="decade" data-selection="2046">2040</span><span data-action="selectDecade" class="decade" data-selection="2056">2050</span><span data-action="selectDecade" class="decade" data-selection="2066">2060</span><span data-action="selectDecade" class="decade" data-selection="2076">2070</span><span data-action="selectDecade" class="decade" data-selection="2086">2080</span><span data-action="selectDecade" class="decade" data-selection="2096">2090</span><span data-action="selectDecade" class="decade old" data-selection="2106">2100</span></td></tr></tbody></table></div></div></li><li class="picker-switch accordion-toggle"></li></ul></div></div>
                        </div>
                        <!-- /.card-body -->
                      </div>
                </div>
            </div>
            {{--  </div>  --}}
        <!-- /.row -->

      </div><!-- /.container-fluid -->
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
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{ asset('plugins/sparklines/sparkline.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{ asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{--<script src="{{ asset('dist/js/pages/dashboard.js')}}"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
{{--  {!! $chart->script() !!}  --}}
<script>
    var ctx = document.getElementById('myChart');
    ctx.height = 220;
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($arr) !!},
            datasets: [{
                label: '@lang("site.request_canvas") '+{!! $dateNow !!},
                data: {!! json_encode($userArr) !!}  ,
                backgroundColor: [
                    '#28a7455c',
                ],
                borderColor: [
                    '#28a745'
                ],
                borderWidth: 2
            }]
        }
    });
    </script>
</body>
</html>
