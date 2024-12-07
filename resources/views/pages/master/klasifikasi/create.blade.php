@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="">
                        <h4>Klasifikasi : add new</h4>
                        <p class="f-m-light mt-1">Page for create new Master Klasifikasi</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('master.klasifikasi.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label required" for="group_code">Group Code</label>
                            <select id="group_code" name="group_code"
                                class="form-select @error('group_code') is-invalid @enderror">
                                <option value="">-- Select --</option>
                                @foreach ($groups as $group)
                                    <option value="{{ $group->code }}">{{ $group->code }} - {{ $group->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('group_code')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
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
                            <label class="form-label required" for="transaction_type">Tipe Transaksi</label>
                            <select id="transaction_type" name="transaction_type"
                                class="form-select @error('transaction_type') is-invalid @enderror">
                                <option value="DEBIT" selected>DEBIT</option>
                                <option value="KREDIT">KREDIT</option>
                            </select>
                            @error('transaction_type')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-4 mt-3">
                            <label class="form-label" for="desc">Desc</label>
                            <input id="desc" type="text" name="desc"
                                class="form-control @error('desc') is-invalid @enderror" value="{{ old('desc') }}">
                            @error('desc')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <div class="">
                            <a href="{{ route('master.klasifikasi.index') }}">
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
            $('#group_code').change(function() {
                let selectedGroupCode = $(this).val();

                $('#code').val(selectedGroupCode || '0');
            });
        });
    </script>
@endsection
