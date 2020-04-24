@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Import File</div>
                <div class="card-body">
                    <form enctype="multipart/form-data" action="{{ route('importFile') }}" method="post">
                        @csrf
                        <div class="form-group">
                                <div class="custom-file">
                                    <input name="file" type="file" accept=".csv" class="custom-file-input" id="file">
                                    <label class="custom-file-label" for="file">Upload CSV File</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="list_id">Please select the list you would like to add these contacts to:</label>
                                <select class="custom-select" id="list_id" name="list_id">
                                    @foreach ($lists as $list)
                                        <option value="{{ $list->id }}">[{{$list->id}}] {{ $list->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        <button class="btn btn-primary" type="submit">Import File</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
