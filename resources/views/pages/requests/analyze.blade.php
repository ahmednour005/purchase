@extends('pages.requests.resource')
@section('content')
    <div class="card">
        <div class="card-header">
            Analysis
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("requests.analyze", $prrequest) }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="description">Comment</label>
                    <textarea class="form-control {{ $errors->has('comment_text') ? 'is-invalid' : '' }}" name="comment_text" id="comment_text">{{ old('comment_text') }}</textarea>
                    {{-- @if($errors->has('comment_text'))
                        <div class="invalid-feedback">
                            {{ $errors->first('comment_text') }}
                        </div>
                    @endif --}}
                </div>
                {{-- <div class="row"> --}}
                    <div class="form-group">
                        <button class="btn btn-success " name="approve" type="submit">
                            Approve PR
                        </button>
                        <button class="btn btn-primary" name="revert" type="submit">
                            Revert PR
                        </button>
                        <button class="btn btn-danger float-right" name="reject" type="submit">
                            Reject PR
                        </button>
                    </div>
                {{-- </div> --}}
            </form>
        </div>
    </div>
@endsection
