@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="">
                        <h4>List Material Request</h4>
                        <p class="f-m-light mt-1">Please set the Start Date and End Date to fetch related data from ERP.</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="">
                    <form wire:submit='submit'>
                        <div class="d-flex justify-content-start gap-3">
                            <div>
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                                    name="start_date" id="start_date" value="{{ request('start_date') }}">
                                @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                                    name="end_date" id="end_date" value="{{ request('end_date') }}">
                                @error('end_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-flex align-self-end">
                                <button class="btn btn-primary" type="submit">
                                    Search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <hr>
                <div class="table-responsive theme-scrollbar mt-3">
                    <table class="display" id="basic-1">
                        <thead>
                            <tr class="bg-light-primary text-dark">
                                <th></th>
                                <th>Material Request No</th>
                                <th>Material Request Date</th>
                                <th>WO No</th>
                                <th>Request From</th>
                                <th>Request To</th>
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
        let table = $("#basic-1").DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('datatable.material-request') }}",
                type: 'GET',
                data: function(d) {
                    d.start_date = $('#start_date').val();
                    d.end_date = $('#end_date').val();
                }
            },
            columns: [{
                    className: 'dt-control text-center',
                    orderable: false,
                    data: null,
                    defaultContent: '<button class="btn btn-xs btn-info text-center">Details</button>'
                },
                {
                    data: 'no',
                    name: 'no'
                },
                {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'wo.no',
                    name: 'wo.no'
                },
                {
                    data: 'wo.divisi_from',
                    name: 'wo.divisi_from'
                },
                {
                    data: 'request_to',
                    name: 'request_to'
                },
            ]
        });

        function format(d) {
            // Render child row sebagai tabel
            let detailRows = d.details.map(detail => `
            <tr>
                <td>${detail.material_code}</td>
                <td>${detail.material.material_type_code}</td>
                <td>${detail.material.uom_code}</td>
                <td>${detail.qty}</td>
                <td>${detail.qty_send}</td>
                <td>${detail.qty_received}</td>
            </tr>
            `).join('');

            return `
            <h4 class="text-center mb-3">Material Request Details</h4>
            <table class="table table-bordered">
                <thead>
                    <tr class="bg-light-warning text-dark">
                        <th>Material Code</th>
                        <th>Material Type</th>
                        <th>Material UoM</th>
                        <th>Quantity</th>
                        <th>Quantity Sent</th>
                        <th>Quantity Received</th>
                    </tr>
                </thead>
                <tbody>
                    ${detailRows}
                </tbody>
            </table>
        `;
        }

        table.on('click', 'td.dt-control', function(e) {
            let tr = $(this).closest('tr');
            let row = table.row(tr);

            if (row.child.isShown()) {
                row.child.hide();
                tr.removeClass('shown');
            } else {
                row.child(format(row.data())).show();
                tr.addClass('shown');
            }
        });
    </script>
@endsection
