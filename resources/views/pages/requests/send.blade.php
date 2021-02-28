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
                <select class="form-control select2 {{ $errors->has('user_id') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                    @endforeach
                </select>
                {{-- @if($errors->has('user_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user_id') }}
                    </div>
                @endif --}}
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    Send to {{ $stepname }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
