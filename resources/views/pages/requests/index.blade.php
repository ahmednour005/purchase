@extends('pages.requests.resource')

@section('content')
<section class="content-header prequestHeader">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-md-6">
          <h1 > جميع الطلبات </h1>
        </div>
        <div class="col-md-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"> جميع الطلبات  </li>
            <li class="breadcrumb-item"><a href="{{route('home')}}"> @lang('site.home')</a></li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
<div class="card">
        <div class="card-body">
        <div class="table-responsive" >
            <table id="example1" class="table table-bordered table-striped" >
                <thead>
                    <tr>

                        <th>
                            Request Date
                        </th>
                        <th >
                            Piroirty
                        </th>

                        <th>
                            Items
                        </th>
                        <th>

                            Sub Group
                        </th>
                        <th>
                            Request Number
                        </th>
                        <th>
                            Status
                        </th>
                        <th width="150px">

                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($prrequests as $key => $prrequest)
                    @php
                      $userstep_ids = array();
                      if($prrequest->approval->approval_name != 'Pending')
                        if($prrequest->approval->approval_name == 'PR Rejected')
                            {$userstep_ids[] = $prrequest->created_by_id ;}
                        else if($prrequest->approval->approval_name == 'PR Approved')
                            {$userstep_ids[] = $prrequest->created_by_id ;}
                        else {$userstep_ids = $prrequest->userstep_ids ;}
                    @endphp
                    @if ( $user->hasRole('super_admin') || in_array($user->id, $userstep_ids) || $user->id == $prrequest->created_by_id)
                        <tr class="justify-content-center" data-entry-id="{{ $prrequest->id }}">
                            <td>
                                {{ $prrequest->date}}
                            </td>
                            <td>
                                @foreach($prrequest->requestitems as $key => $item)
                                    {{$item->piroirty}}
                                    <br>
                                @endforeach
                            </td>
                            <td>

                                @foreach($prrequest->requestitems as $key => $item)
                                    {{$item->product->prod_name}}<br>
                                @endforeach
                            </td>
                            <td>
                                <ul>
                                @foreach($prrequest->requestitems as $key => $item)
                                    {{ $item->service->service_name }}<br>
                                @endforeach
                                </ul>
                            </td>
                            <td>
                                {{ $prrequest->request_number ?? '' }}
                            </td>
                            <td>
                                @if ($prrequest->approval->approval_name == 'Pending')
                                    {{$prrequest->approval->approval_name}} To Start Cycle
                                @elseif($prrequest->approval->approval_name != 'Pending')
                                    @if($prrequest->approval->approval_name == 'PR Rejected')
                                        {{$prrequest->approval_name}}
                                    @elseif($prrequest->approval->approval_name == 'PR Approved')
                                        {{$prrequest->approval_name}}
                                    @elseif($prrequest->approval->approval_name == 'Revert')
                                        {{$prrequest->approval_name}}
                                    @elseif ($approvals->find($prrequest->approval_id)->stepapprovals->find($prrequest->stepapproval_id)->step_number ==1)
                                        Pending {{$approvals->find($prrequest->approval_id)->stepapprovals->find($prrequest->stepapproval_id)->step_name}}
                                    @elseif($approvals->find($prrequest->approval_id)->stepapprovals->find($prrequest->stepapproval_id)->step_number !=1)
                                        @php
                                            $prev_id = $approvals->find($prrequest->approval_id)->stepapprovals->where('id','<',$prrequest->stepapproval_id)->max('id');
                                        @endphp
                                        {{$approvals->find($prrequest->approval_id)->stepapprovals->find($prev_id)->step_name}} {{$prrequest->approval_name}}

                                    @endif

                                @endif
                            </td>
                            <td class="requests-btn">
                                @php
                                    $approval_id_to_array = array();
                                    if ($prrequest->approval_id == $approvals->where('approval_name','Pending')->first()->id) {
                                        $approval_id = $approvals->where('approval_name','Pending')->first()->id;
                                        $approval_id_to_array[] = $approval_id;
                                    }else if ($prrequest->approval_id == $approvals->where('approval_name','Revert')->first()->id){
                                        $approval_id = $approvals->where('approval_name','Revert')->first()->id;
                                        $approval_id_to_array[] = $approval_id;
                                    }
                                @endphp
                                @if( in_array($prrequest->approval_id, $approval_id_to_array) || $approvals->where('approval_name','Revert')->first()->approval_name == $prrequest->approval_name)
                                <a class="btn btn-xs btn-success" href="{{ route('requests.showSend', $prrequest->id) }}">
                                    Send to
                                    @if ($user->hasRole('super_admin') || $prrequest->approval->approval_name == 'Pending')
                                        {{$prrequest->mainGroup->approval->approval_name}}
                                    @else
                                    @php
                                        $nextid = $approvals->find($prrequest->approval_id)->stepapprovals->where('id','>',$prrequest->stepapproval_id)->min('id')
                                    @endphp
                                        {{$approvals->find($prrequest->approval_id)->stepapprovals->find($nextid)->step_name}}
                                    @endif
                                </a>

                                {{-- @elseif($user->hasRole('super_admin'))   --}}
                                <a class="btn btn-sm btn-warning" href="{{ route('requests.edit', $prrequest->id) }}">
                                    edit
                                </a>


                                @elseif($user->hasRole('super_admin') || in_array($user->id, $prrequest->userstep_ids))
                                    <a class="btn btn-xs btn-success" href="{{ route('requests.showAnalyze', $prrequest->id) }}">
                                        Submit analysis
                                    </a>
                                @endif
                                <a class="btn btn-sm btn-info" href="{{ route('requests.show', $prrequest->id) }}">
                                    view
                                </a>
                                <form action="{{ route('requests.destroy', $prrequest->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    {{-- <button type="submit" class="btn btn-sm btn-danger">Delete</button> --}}
                                </form>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>

            {{--  <table id="example1" class="table table-bordered table-striped">

                <thead>
                <tr style="text-align:center;">
                  <th >@lang('site.actions')</th>
                  <th  > @lang('site.id')</th>
                  <th >@lang('site.company')</th>
                   <th >  @lang('site.responsible_person')</th>
                  <th > @lang('site.services')</th>
                  <th > @lang('site.products')</th>
                  <th >@lang('site.mobile') </th>
                  <th > @lang('site.phone')</th>
                  <th > @lang('site.whatsapp')</th>
                  <th class="hiddenCols"> @lang('site.fax')</th>
                  <th class="hiddenCols"> @lang('site.email')</th>
                  <th class="hiddenCols" > @lang('site.date')</th>
                  <th class="hiddenCols" > @lang('site.approval')</th>
                  <th class="hiddenCols" > @lang('site.address')</th>
                </tr>
                </thead>
                <tbody>

                @foreach($suppliers as $supplier)
                    <tr>
                        <td class="options">


                            <div class="option-items">
                                <div class="icon">
                                  <i class="fas fa-cog"></i>
                                </div>


                            <a href="{{route('profile', ['id' => $supplier->id])}}" class="btn btn-success"><i class="fa fa-eye"></i></a>
                            @if(!$archive)
                            @if(auth()->user()->hasPermission('supplier_update'))
                                <a href="{{route('supplier.edit',$supplier->id)}}"  class="btn btn-warning"> <i class="fa fa-edit "></i> </a>
                                @endif
                                @endif
                            @if($archive)
                               @if(auth()->user()->hasPermission('supplier_restore'))
                                <a  class="btn btn-danger" data-sup_id="{{$supplier->id}}" data-toggle="modal" data-target="#restore"> <i class="fa fa-trash-restore-alt "></i> </a>
                              @endif
                                @else
                                @if(auth()->user()->hasPermission('supplier_delete'))
                                <a  class="btn btn-danger" data-sup_id="{{$supplier->id}}" data-toggle="modal" data-target="#delete"> <i class="fa fa-trash-alt "></i> </a>
                              @endif
                                @endif
                             </div>
                        </td>
                        <td> {{$supplier->id}} </td>
                        <td> {{$supplier->company}} </td>
                        <td>
                            {{ $supplier->persons[0]->responsible_person }}
                        </td>
                        <td>

                            @foreach($supplier->services as $ser)
                                <span class="type_service">{{ $ser->service_name }} </span>
                            @endforeach


                        </td>
                        <td>
                            @foreach($supplier->products as $prod)
                                <span class="type_service">{{ $prod->prod_name }} </span>
                             @endforeach
                        </td>
                        <td>

                            {{ $supplier->persons[0]->mobile }}
                        </td>
                        @if($supplier->phone)
                            <td> {{$supplier->phone}} </td>
                        @else
                            <td> -- </td>
                        @endif

                        <td>
                            {{ $supplier->persons[0]->whatsapp }}
                        </td>
                        @if($supplier->fax)
                            <td> {{$supplier->fax}} </td>
                            @else
                            <td> -- </td>
                        @endif
                        <td> {{$supplier->supplier_email}} </td>
                        <td> {{ \Carbon\Carbon::parse($supplier->created_at)->format('d/m/Y')}} </td>
                        <td> @lang($supplier->accredite) </td>

                        <td> {{$supplier->address}} </td>


                    </tr>
                @endforeach



                  </tbody>
              </table>
  --}}



            </div>


    </div>
</div>
@endsection
@section('scripts')
@parent
{{--  <script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('order_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.orders.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-Order:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>  --}}

<script>
    $( function () {
      $("#example1").DataTable({
       "responsive": true, "lengthChange": true, "autoWidth": false,
       "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "@lang('site.all')"]],
       columnDefs: [
             {
               targets: "hiddenCols", visible: false
            }

         ],
       "buttons": ["copy", "excel",  "print","colvis"],
          "language": {
              search: '<i class="fa fa-filter" aria-hidden="true"></i>',
              searchPlaceholder: '@lang("site.search") ',
              "lengthMenu": "@lang('site.show')  _MENU_ @lang('site.records') ",
              "paginate": {
                  "previous": "@lang('site.prev')",
                  "next" : "@lang('site.next')",

              },
              "emptyTable":     "@lang('site.no_data')",
              "info":   "@lang('site.show')  _END_ @lang('site.from') _TOTAL_ @lang('site.record')",
              "infoEmpty":      "@lang('site.show') 0 @lang('site.from') 0 @lang('site.record')",
              "infoFiltered":   "(@lang('site.search_in')  _MAX_  @lang('site.record'))",

              buttons: {
                  colvis: '@lang("site.show_data") <i class="fa fa-eye-slash "> </i> ',
                  'print' : '@lang("site.print") <i class="fa fa-print "> </i> ',
                  'copy' : '@lang("site.copy") <i class="fa fa-copy "> </i>',
                  'excel' : '@lang("site.excel") <i class="fa fa-file-excel "> </i>',

                  buttons: [
                      { extend: 'copy', className: 'btn btn-primary' },
                      { extend: 'excel', className: 'excelButton' }
                  ]
              },

          }
     }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

   });
 </script>
@endsection
