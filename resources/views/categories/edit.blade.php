@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <form action="{{ route('categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input name ="name" value = "{{ $category->name }}" type="text" class="form-control"
                            id="name">
                    </div>
                    <div class="mb-3">
                        <label for="dec" class="form-label">Descrition</label>
                        <div class="form-floating">
                            <textarea name="dec" style="height: 150px"class="form-control" id="dec">{{ $category->dec }}</textarea>
                            <label for="dec">Descrition</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
@endsection

