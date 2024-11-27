@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="">
                        <h4>Group : add new</h4>
                        <p class="f-m-light mt-1">Page for create new Master Group</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('master.group.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label required" for="code">Code</label>
                            <input id="code" type="text" name="code"
                                class="form-control @error('code') is-invalid @enderror" value="{{ old('code') }}">
                            @error('code')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="name">Name</label>
                            <input id="name" type="text" name="name"
                                class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <div class="">
                            <a href="{{ route('master.group.index') }}">
                                <button class="btn btn-secondary" type="button">
                                    Back
                                </button>
                            </a>
                        </div>
                        <div class="">
                            <button class="btn btn-primary" type="submit">
                                Create
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
