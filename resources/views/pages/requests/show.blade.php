@extends('pages.requests.resource')
@section('content')
<section class="content-header prequestHeader">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-md-6">
          <h1 > عرض طلب  </h1>
        </div>
        <div class="col-md-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active">  ( {{$prrequest->request_number}} ) عرض طلب</li>
            <li class="breadcrumb-item active"><a href="{{route('requests.index')}}"> @lang('site.requests')</a> </li>
            <li class="breadcrumb-item"><a href="{{route('home')}}"> @lang('site.home')</a></li>

          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
<div class="card show-one-request">
    <div class="card-header parent">
        <h3>Show Purchase Request </h3>
    </div>

    <div class="card-body show-request-id">
        <div class="mb-2">
           <div class="row">
            <div class="col-md-6">
                <table style="width: 85%" class="table table-bordered table-striped table-sm p-3">
                    <tbody>
                        <tr>
                            <th scope="col">
                                Request Number
                            </th>
                            <th scope="col">
                                {{ $prrequest->request_number }}
                            </th>
                        </tr>
                        <tr>
                            <th>
                                Date
                            </th>
                            <th>
                                {{ $prrequest->date }}
                            </th>
                        </tr>
                        <tr>
                            <th>
                                Department
                            </th>
                            <th>
                                {{ $prrequest->department }}
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <table style="width:90%" class="table table-bordered float-right table-striped table-sm p-3">
                    <tbody>
                        <tr>
                            <th>
                                Project
                            </th>
                            <th>
                                {{ $prrequest->project }}
                            </th>
                        </tr>
                        <tr>
                            <th>
                                Site
                            </th>
                            <th>
                                {{ $prrequest->site }}
                            </th>
                        </tr>
                        <tr>
                            <th>
                                Group
                            </th>
                            <th>
                                {{ $prrequest->mainGroup->group_name }}
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
           </div>

           {{--  <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" class="form-control">
            <br>
            <button type="submit" class="btn btn-success">Import User Data</button>
            <a class="btn btn-warning" href="{{ route('export') }}">Export User Data</a>
        </form>  --}}

            <div class="card">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover justify-content-center text-center">
                        <thead>
                            <tr>
                                <th scope="col" width="30px">
                                    S NO.
                                </th>
                                <th scope="col">
                                    Sub Group
                                </th>
                                <th scope="col">
                                    Item Name
                                </th>
                                <th scope="col" width="350px">
                                    Item <br> Specification
                                </th>
                                <th scope="col" width="50px">
                                    Unit
                                </th>
                                <th scope="col" width="50px">
                                    Q-R
                                </th>
                                <th scope="col" width="50px">
                                   Q-S
                                </th>
                                <th scope="col" width="50px">
                                   A-Q
                                </th>
                                <th scope="col" width="60px">
                                    Priority
                                </th>
                                <th scope="col" width="60px">
                                    Budget
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($requestitems as $requestitem)
                            <tr>
                                <th>

                                    {{ $indexCount++}}
                                </th>
                                <td>
                                    {{$requestitem->service->service_name}}
                                </td>
                                <td>
                                    {{$requestitem->product->prod_name}}
                                </td>
                                <td>
                                    {{$requestitem->specification}}

                                </td>
                                <td>
                                    {{$requestitem->unit}}
                                </td>
                                <td>
                                    {{$requestitem->qtreqtopur}}
                                </td>
                                <td>
                                    {{$requestitem->qtonstore}}
                                </td>
                                <td>
                                    {{$requestitem->acqtreqtopur}}
                                </td>
                                <td>
                                    {{$requestitem->piroirty}}
                                </td>
                                <td>
                                    {{$requestitem->rowbudget}}
                                </td>
                            </tr>
                        @endforeach
                            <tr>
                                <th>Total Budget: </th>
                                <td colspan="8"></td>
                                <th>
                                    @foreach ($requestitems as $item)
                                        {{$item->rowbudget}}
                                    @endforeach
                                    {{-- {{$totalrowbudget}} --}}
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                {{--  </div>  --}}
            </div>

        </div>


    </div>
</div>

@endsection
