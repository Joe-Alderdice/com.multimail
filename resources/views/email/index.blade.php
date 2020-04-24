@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create List</div>
                <div class="card-body">
                    <form action="{{ route('listCreate') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">List Name</label>
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                        <button class="btn btn-primary" type="submit">Create List</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
