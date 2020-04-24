@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Email Preview for first recipient:</div>
                <div class="card-body">
                    <form action="{{ route('sendEmail') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <input value="{{ $emailSubject }}" name="subject" type="text" class="form-control" id="subject" disabled>
                        </div>
                        <div class="form-group">
                            <textarea value="{{ $emailBody }}" class="form-control" id="body" name="body" rows="5" disabled>{{ $emailBody }}</textarea>
                        </div>
                        <input type="hidden" id="id" name="id" value="{{ $rawEmail->id }}">
                        <button class="btn btn-danger" type="submit">Send Email</button>
                        <a href="{{ route('template') }}" class="btn btn-warning float-right">Go back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
