@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="">
                        <h4>Subklasifikasi : add new</h4>
                        <p class="f-m-light mt-1">Page for create new Master Subklasifikasi</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('master.sub-klasifikasi.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label required" for="klasifikasi_code">Klasifikasi Code</label>
                            <select id="klasifikasi_code" name="klasifikasi_code"
                                class="form-select @error('klasifikasi_code') is-invalid @enderror">
                                <option value="">-- Select --</option>
                                @foreach ($klasifikasis as $klasifikasi)
                                    <option value="{{ $klasifikasi->code }}">
                                        {{ $klasifikasi->code }} - {{ $klasifikasi->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label required" for="code">Code</label>
                            <div class="input-group">
                                <input type="text" name="code" id="code"
                                    class="form-control @error('code') is-invalid @enderror" value="{{ old('code') }}">
                                @error('code')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label required" for="name">Name</label>
                            <input id="name" type="text" name="name"
                                class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-4 mt-3">
                            <label class="form-label" for="desc">Desc</label>
                            <input id="desc" type="text" name="desc"
                                class="form-control @error('desc') is-invalid @enderror" value="{{ $klasifikasi->desc }}">
                            @error('desc')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <div class="">
                            <a href="{{ route('master.sub-klasifikasi.index') }}">
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

@section('js')
    <script>
        $(document).ready(function() {
            $('#klasifikasi_code').change(function() {
                let selectedGroupCode = $(this).val();

                $('#code').val(selectedGroupCode || '0');
            });
        });
    </script>
@endsection