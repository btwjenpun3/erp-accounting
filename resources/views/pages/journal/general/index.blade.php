@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
@endsection

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="">
                        <h4>General Journal</h4>
                        <p class="f-m-light mt-1">Page for General Journal</p>
                    </div>
                    <div class="">
                        <a href="{{ route('ledger.general-journal.create') }}">
                            <button class="btn btn-primary">
                                Add New
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="daterange" class="form-label">Filter by Date Range:</label>
                    <input type="text" id="daterange" class="form-control" placeholder="Select date range">
                </div>
                <div class="table-responsive theme-scrollbar border p-3">
                    <table class="table table-bordered table-hover" id="basic-1">
                        <thead>
                            <tr class="bg-light-primary">
                                <th>Reff</th>
                                <th>Desc</th>
                                <th>Date</th>
                                <th>Status</th>
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
    <script src="https://cdn.jsdelivr.net/npm/moment/min/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        $('#daterange').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            }
        });

        // Event saat memilih rentang tanggal
        $('#daterange').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + ' to ' + picker.endDate.format('YYYY-MM-DD'));
            table.draw(); // Refresh DataTable
        });

        // Event saat membersihkan rentang tanggal
        $('#daterange').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
            table.draw(); // Refresh DataTable
        });

        var table = $("#basic-1").DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('datatable.general-journal') }}",
                type: 'GET',
                data: function(d) {
                    d.date_range = $('#daterange').val();
                }
            },
            columns: [{
                    data: 'reff',
                    name: 'reff',
                    className: 'col-10'
                }, {
                    data: 'desc',
                    name: 'desc',
                    className: 'col-60'
                },
                {
                    data: 'formatted_date',
                    name: 'formatted_date',
                    className: 'col-10'
                },
                {
                    data: 'status',
                    name: 'status',
                    className: 'col-10',
                    render: function(data, type, row, meta) {
                        if (data === 1) {
                            return '<span class="badge bg-success">Approved</span>';
                        } else {
                            return '<span class="badge bg-secondary">Draft</span>';
                        }
                    }
                },
                {
                    data: 'id',
                    name: 'id',
                    className: 'col-10',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row, meta) {
                        let editUrl = "{{ route('ledger.general-journal.edit', ':id') }}";
                        editUrl = editUrl.replace(':id', data);

                        let showUrl = "{{ route('ledger.general-journal.show', ':id') }}";
                        showUrl = showUrl.replace(':id', data);

                        let eyeIcon = '';
                        if (row.status === 1) {
                            eyeIcon = `
                            <li class="edit">
                                <a href="${showUrl}">
                                    <button class="btn btn-icon"><i class="icon-eye text-primary"></i></button>
                                </a>
                            </li>`;
                        }

                        return `
                    <ul class="action">
                        ${eyeIcon}
                        <li class="edit">
                            <a href="${editUrl}">
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
                }
            ]
        });
    </script>
@endsection
