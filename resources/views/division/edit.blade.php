@extends('template.main')

@section('container')
    <div class="header-wrapper pb-3 mb-4">

        <a href="/divisions" class="text-dark" id="go-back-link">

            <h2><i class="bi bi-arrow-left-circle" id="arrow-left"></i><i class="bi bi-arrow-left-circle-fill d-none" id="arrow-left-fill"></i> Edit Division</h2>
        </a>
    </div>

    <form action="/divisions/{{ $division->id }}" method="POST">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Division Name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ $division->name }}">
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="btn-wrapper">
            <button type="submit" class="btn btn-success">Update</button>
        </div>
    </form>


@endsection
