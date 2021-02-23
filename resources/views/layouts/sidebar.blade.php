
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar elevation-4 sidebar-light-success">
      <div class="overlay"></div>
    <!-- Brand Logo -->
      <a href="{{route('home')}}" class="brand-link navbar-success">
          {{--      <img src="../../dist/img/eecgroup-logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">--}}
          {{--      <span class="brand-text font-weight-light"></span>--}}
          <h3>EEC <sub> Group</sub></h3>

      </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->


      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="بحث" aria-label="بحث">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->

	     <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
              <a href="{{route('home')}}" class="nav-link {{ (request()->is('ar')) || (request()->is('en') || (request()->is('*home'))) ? 'active' : '' }}">
                <i class="fa fa-tachometer-alt nav-icon"></i>
                <p> @lang('site.dashboard')</p>
              </a>
          </li>

          <li class="nav-item">
            <a href="{{route('home')}}" class="nav-link">
              <i class="fa fa-hand-pointer nav-icon"></i>
              <p> Action Required</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('home')}}" class="nav-link">
                <i class="fab fa-wpforms nav-icon"></i>
            <p> Form Status</p>
            </a>
          </li>

            <li class="nav-item {{ ((request()->is('*supplier')) || (request()->is('*supplier/add')) ||
              (request()->is('*supplier/archive*'))  ||
               (request()->is('*supplier/profile*')) || (request()->is('*supplier/edit*')) )? ' menu-open' : '' }}">

                @if(auth()->user()->hasPermission('supplier_read') || auth()->user()->hasPermission('supplier_create') )
                   <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-shipping-fast"></i>
                    <p>
                        @lang('site.suppliers')
                        <i class="fas fa-angle-left right"></i>
                    </p>
                   </a>
                @endif
                <ul class="nav nav-treeview">
                   @if(auth()->user()->hasPermission('supplier_read'))
                    <li class="nav-item" title="كل الموردين ">
                        <a href="{{route('supplier')}}" class="nav-link {{ (request()->is('*supplier')) ||
                            (request()->is('*supplier/profile*'))  || (request()->is('*supplier/archive*')) ||
                            (request()->is('*supplier/edit*')) ? 'active' : '' }}">
                            <i class="fa fa-users nav-icon"></i>
                            <p>@lang('site.all_suppliers')</p>
                        </a>
                    </li>
                    @endif
                    @if(auth()->user()->hasPermission('supplier_create'))
                    <li class="nav-item" title="أضافة مورد جديد">
                        <a href="{{route('supplier.add')}}" class="nav-link {{ (request()->is('*supplier/add')) ? 'active' : '' }}">
                            <i class="fa fa-user-plus nav-icon"></i>
                            <p>@lang('site.add_supplier')</p>
                        </a>
                    </li>
                    @endif
                </ul>

            </li>

            <li class="nav-item {{ ( (request()->is('*service*')) || (request()->is('*product*')) ||
                 (request()->is('*main_group*')) )? ' menu-open' : '' }}">

                  @if(auth()->user()->hasPermission('service_create') || auth()->user()->hasPermission('product_create')
                  || auth()->user()->hasPermission('mainGroup_read') || auth()->user()->hasPermission('mainGroup_create') )
                     <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-layer-group"></i>
                      <p>
                          @lang('site.Groups')
                          <i class="fas fa-angle-left right"></i>
                      </p>
                  </a>
                @endif

                  <ul class="nav nav-treeview">

                      @if(auth()->user()->hasPermission('mainGroup_read'))
                      <li class="nav-item" >
                          <a href="{{route('main_group.index')}}" class="nav-link {{ (request()->is('*main_group*')) ? 'active' : '' }}">
                              <i class="fa fa-layer-group nav-icon"></i>
                              <p>@lang('site.mainGroup')</p>
                          </a>
                      </li>
                      @endif
                       @if(auth()->user()->hasPermission('service_read'))
                      <li class="nav-item" >
                          <a href="{{route('service.index')}}" class="nav-link {{ (request()->is('*service*')) ? 'active' : '' }}">
                              <i class="fa fa-object-group nav-icon"></i>
                              <p>@lang('site.services')</p>
                          </a>
                      </li>
                      @endif
                       @if(auth()->user()->hasPermission('product_read'))
                      <li class="nav-item" title="أضافه وتعديل وحذف المنتجات الخاصه بالموردين">
                          <a href="{{route('product.index')}}" class="nav-link {{ (request()->is('*product*')) ? 'active' : '' }}">
                              <i class="fa fa-box-open nav-icon"></i>
                              <p>@lang('site.products')</p>
                          </a>
                      </li>
                      @endif

                  </ul>

              </li>
{{--  requests  --}}

<li class="nav-item {{ ( (request()->is('*requests*')) )? ' menu-open' : '' }}">

     @if(auth()->user()->hasPermission('service_create') || auth()->user()->hasPermission('product_create')
     || auth()->user()->hasPermission('mainGroup_read') || auth()->user()->hasPermission('mainGroup_create') )
        <a href="#" class="nav-link">
         <i class="nav-icon fas fa-receipt"></i>
         <p>
             @lang('site.prequests')
             <i class="fas fa-angle-left right"></i>
         </p>
     </a>
   @endif

     <ul class="nav nav-treeview">

         <li class="nav-item">
            <a href="{{route('requests.create')}}" class="nav-link {{ (request()->is('*requests/create')) ? 'active' : '' }}">
                <i class="fa fa-plus-circle nav-icon"></i>
                <p>أضافة طلب</p>
            </a>
        </li>
        <li class="nav-item" >
            <a href="{{route('requests.index')}}" class="nav-link {{ (request()->is('*requests*') && !(request()->is('*requests/create')) ) ? 'active' : '' }}">
                <i class="fa fa-eye nav-icon"></i>
                <p>عرض الطلبات</p>
            </a>
        </li>

     </ul>

 </li>


 {{--  Setting  --}}

                <li class="nav-header">@lang('site.settings')</li>
            {{--  Approval  --}}
            <li class="nav-item {{ ( (request()->is('*approvals*')) )? ' menu-open' : '' }}">

                @if(auth()->user()->hasPermission('service_create') || auth()->user()->hasPermission('product_create')
                || auth()->user()->hasPermission('mainGroup_read') || auth()->user()->hasPermission('mainGroup_create') )
                   <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-project-diagram"></i>
                    <p>
                        Approval
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
              @endif

                <ul class="nav nav-treeview">

                    <li class="nav-item">
                        <a href="{{route('approvals.create')}}" class="nav-link {{ (request()->is('*approvals/create')) ? 'active' : '' }}">
                            <i class="fas fa-plus-circle nav-icon"></i>
                            <p>Add Approval </p>
                        </a>
                     </li>
                    <li class="nav-item">
                        <a href="{{route('approvals.index')}}" class="nav-link {{ (request()->is('*approvals')) ? 'active' : '' }}">
                            <i class="fas fa-eye nav-icon"></i>

                            <p>Show Approvals </p>
                        </a>
                        </li>

                </ul>

            </li>
            {{--  users  --}}

            @if(auth()->user()->hasPermission('users_read'))

              <li class="nav-item " title="جميع المسنخدمين الموجودين فى الشركه" >
                <a href="{{route('users.index')}}"  class="nav-link {{ ((request()->is('*users')) ||
                    (request()->is('*users/*/edit')) || (request()->is('*users/profile*'))) ? 'active' : '' }} ">
                  <i class="nav-icon far fa-file-alt"></i>
                  <p>
                    @lang('site.users')
                    <span class="right badge {{ ((request()->is('*users')) ||
                        (request()->is('*users/*/edit')) || (request()->is('*users/profile*'))) ? 'badge-warning' : 'badge-success' }}">{{$users_count}}</span>
                  </p>
                </a>
              </li>
            @endif


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
