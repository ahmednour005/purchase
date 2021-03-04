@extends('pages.requests.resource')
@section('content')
<div class="card">
    <div class="card-header">
        Send to {{ $stepname ?? '' }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("requests.send", $prrequest) }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="user_id">{{ $stepname ?? '' }}</label>
                {{-- <select class="form-control select2 {{ $errors->has('user_id') ? 'is-invalid' : '' }}" name="userstep_ids" id="user_id"> --}}
                    @foreach($users as $user)
                        <h6><span class="badge badge-secondary">{{$user->name ?? ''}}</span></h6>
                        {{-- <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option> --}}
                    @endforeach
                {{-- </select> --}}
                {{-- @if($errors->has('user_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user_id') }}
                    </div>
                @endif --}}
                {{-- @foreach ($users as $user)
                    <div class="form-check">
                        <input class="form-check-input" name="userstep_ids[]" type="checkbox" value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }} id="userstep_ids" checked readonly>
                        <label class="form-check-label" for="userstep_ids">
                            {{ $user->name }}
                        </label>
                    </div>  
                @endforeach --}}
                
            </div>
                 <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    Send to {{ $stepname ?? ''}}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
