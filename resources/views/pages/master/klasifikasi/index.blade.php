@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="">
                        <h4>Klasifikasi</h4>
                        <p class="f-m-light mt-1">Page for create Master Klasifikasi</p>
                    </div>
                    <div class="">
                        <a href="{{ route('master.klasifikasi.create') }}">
                            <button class="btn btn-primary">
                                Add New
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive theme-scrollbar">
                    <table class="table table-striped table-bordered" id="basic-1">
                        <thead>
                            <tr class="bg-light-info">
                                <th>Code</th>
                                <th>Name</th>
                                <th>Tipe Transaksi</th>
                                <th>Desc</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $("#basic-1").DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('datatable.master.klasifikasi') }}",
                type: 'GET',
            },
            columns: [{
                data: 'code',
                name: 'code',
                className: 'col-10'
            }, {
                data: 'name',
                name: 'name',
                className: 'col-60'
            }, {
                data: 'transaction_type',
                name: 'transaction_type',
                className: 'col-10'
            }, {
                data: 'desc',
                name: 'desc',
                className: 'col-60'
            }, {
                data: 'id',
                name: 'id',
                className: 'col-10',
                orderable: false,
                searchable: false,
                render: function(data, type, row, meta) {
                    let url = "{{ route('master.klasifikasi.edit', ':id') }}";
                    url = url.replace(':id', data);

                    return `
                    <ul class="action">
                        <li class="edit">
                            <a href="${url}">
                                <button class="btn btn-icon"><i class="icon-pencil-alt"></i></button>
                            </a>
                        </li>
                        <li class="delete">
                            <button class="btn btn-icon" data-bs-toggle="collapse" data-bs-target="#delete-${data}">
                                <i class="icon-trash"></i>
                            </button>
                            <div class="collapse multi-collapse dark-accordion" id="delete-${data}">
                                <div class="card card-body mt-3 mb-0 collapse-wrapper accordion-light-primary">
                                    <p>Are you sure want to delete this?</p>
                                    <div class="d-flex justify-content-between gap-3">
                                        <form action="#" method="POST">
                                            <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button class="btn btn-danger" type="submit">Yes, delete!</button>
                                        </form>
                                        <button class="btn btn-secondary" data-bs-toggle="collapse" data-bs-target="#delete-${data}">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>`;
                }
            }]
        });
    </script>
@endsection
