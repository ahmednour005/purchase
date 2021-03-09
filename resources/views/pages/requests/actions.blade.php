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
                    @foreach($prrequests as  $prrequest)
                    @php
                      $userstep_ids = array();  
                      if($prrequest->approval->approval_name != 'Pending')
                        if($prrequest->approval->approval_name == 'PR Rejected')
                            {$userstep_ids[] = $prrequest->created_by_id ;}
                        else if($prrequest->approval->approval_name == 'PR Approved')
                            {$userstep_ids[] = $prrequest->created_by_id ;}
                        else {$userstep_ids = $prrequest->userstep_ids ;}  
                    @endphp
                    @if ( $user->hasRole('super_admin') || in_array($user->id, $userstep_ids) )
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
                                    @elseif($prrequest->approval_name == 'Revert')
                                        {{$prrequest->approval_name}} By {{ $approvals->find($prrequest->approval_id)->stepapprovals->find($prrequest->steprevert_id)->step_name }}
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
                                @if($user->hasRole('super_admin1')|| in_array($prrequest->approval_id, [1]))
                                <form method="POST" action="{{ route("requests.send", $prrequest) }}" enctype="multipart/form-data">
                                    @csrf
                                    <button type="submit" class="btn btn-xs btn-success m-1" data-toggle="tooltip" data-placement="top" title="Send">
                                        @if ($user->hasRole('super_admin') || in_array($prrequest->approval_id, $approval_id_to_array) || $prrequest->approval->approval_name == 'Pending')
                                        <i class="fas fa-paper-plane" ></i>
                                        {{-- {{$prrequest->mainGroup->approval->stepapprovals->first()->step_name}} --}}
                                        @else
                                        @php
                                            $nextid = $approvals->find($prrequest->approval_id)->stepapprovals->where('id','>',$prrequest->stepapproval_id)->min('id')
                                        @endphp
                                            {{$approvals->find($prrequest->approval_id)->stepapprovals->find($nextid)->step_name}}
                                        @endif
                                    </button>
                                    @method('GET')
                                </form>
                                <a class="btn btn-sm btn-warning m-1" href="{{ route('requests.edit', $prrequest->id) }}" data-toggle="tooltip" data-placement="top" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @php
                                $userstep_ids = array();  
                                if($prrequest->approval->approval_name != 'Pending')
                                    if($prrequest->approval->approval_name == 'PR Rejected')
                                        {$userstep_ids[] = $prrequest->created_by_id ;}
                                    else if($prrequest->approval->approval_name == 'PR Approved')
                                        {$userstep_ids[] = $prrequest->created_by_id ;}
                                    else {$userstep_ids = $prrequest->userstep_ids ;}  
                                @endphp
                                {{-- @elseif($user->hasRole('super_admin') || in_array($user->id, $userstep_ids))
                                    <a class="btn btn-xs btn-success" href="{{ route('requests.showAnalyze', $prrequest->id) }}">                                        
                                        Submit analysis
                                    </a> --}}
                                    
                                @endif
                                <a class="btn btn-sm btn-info m-1" href="{{ route('requests.show', $prrequest->id) }}" data-toggle="tooltip" data-placement="top" title="View">
                                    <i class="fas fa-eye"></i>
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
