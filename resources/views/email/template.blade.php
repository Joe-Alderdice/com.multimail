@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create List</div>
                <div class="card-body">
                    <form action="{{ route('templateStore') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="subject">Enter Subject</label>
                            <small>Using %first_name% for variables.</small>
                            <input name="subject" type="text" class="form-control" id="subject">
                        </div>
                        <div class="form-group">
                            <label for="body">Enter Contents</label>
                            <small>Using %first_name% for variables.</small>
                            <textarea class="form-control" id="body" name="body" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="recipients_list">Choose Recipients List</label>
                            <select class="custom-select" id="recipients_list" name="recipients_list">
                                @foreach ($lists as $list)
                                <option value="{{ $list->id }}">[{{$list->id}}] {{ $list->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-success" type="submit">Preview Email</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
