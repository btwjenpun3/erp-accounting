@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="">
                        <h4>General Journal : edit</h4>
                        <p class="f-m-light mt-1">Page for edit General Journal</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @livewire('journal.general.create-form', ['generalJournal' => $generalJournal])
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
