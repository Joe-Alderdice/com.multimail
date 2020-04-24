@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="{{ route('emailIndex') }}" class="btn btn-primary">Create List</a>
                    <a href="{{ route('template') }}" class="btn btn-primary">Send email from already imported list.</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
