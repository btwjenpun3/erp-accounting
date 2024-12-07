<div>
    <div class="row">
        <div class="col-md-4">
            <label for="date" class="form-label required">Date</label>
            <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date"
                wire:model='date'>
            @error('date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-4">
            <label for="reff" class="form-label required">Reff</label>
            <input type="text" class="form-control @error('reff') is-invalid @enderror" id="reff" name="reff"
                wire:model='reff'>
            @error('reff')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-4">
            <label for="desc" class="form-label required">Description</label>
            <input type="text" class="form-control @error('desc') is-invalid @enderror" id="desc" name="desc"
                wire:model='desc'>
            @error('desc')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row mt-3">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr class="bg-light-warning text-dark">
                        <th>#</th>
                        <th>Account</th>
                        <th>Currency</th>
                        <th>Debit</th>
                        <th>Credit</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cells as $key => $cell)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <select id="account_code"
                                    class="form-select @error("cells.$key.account_code") is-invalid @enderror"
                                    wire:model='cells.{{ $key }}.account_code'>
                                    <option value="">-- Select --</option>
                                    @foreach ($accounts as $account)
                                        <option value="{{ $account->code }}">{{ $account->code }} -
                                            {{ $account->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select id="currency_code"
                                    class="form-select @error("cells.$key.currency_code") is-invalid @enderror"
                                    wire:model='cells.{{ $key }}.currency_code'>
                                    <option value="">-- Select --</option>
                                    <option value="IDR">IDR</option>
                                </select>
                            </td>
                            <td>
                                <input type="text"
                                    class="form-control @error("cells.$key.debit") is-invalid @enderror"
                                    wire:model.lazy='cells.{{ $key }}.debit' onfocus="selectIfZero(this)">
                                @error("cells.$key.debit")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </td>
                            <td>
                                <input type="text"
                                    class="form-control @error("cells.$key.credit") is-invalid @enderror"
                                    id="cleave-number-format" wire:model.lazy='cells.{{ $key }}.credit'
                                    onfocus="selectIfZero(this)">
                                @error("cells.$key.credit")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </td>
                            <td style="width: 100px;">
                                @if (count($cells) > 1)
                                    <button class="btn btn-warning" type="button"
                                        wire:click="removeCell({{ $key }})"
                                        wire:loading.attr='disabled'>Remove</button>
                                @else
                                    <button class="btn btn-ligth" type="button" disabled>Remove</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="bg-light-info text-dark text-center">
                        <td colspan="6">
                            <button class="btn btn-primary" type="button" wire:click='addCell()'
                                wire:loading.attr='disabled'>
                                Add new line
                            </button>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="row mt-4">
            <div class="col-md-6 offset-md-6">
                <div class="d-flex justify-content-between mb-3">
                    <h5>Total Debit:</h5>
                    <h5>IDR {{ number_format($debitTotal, 2, ',', '.') }}</h5>
                </div>
                <div class="d-flex justify-content-between mb-3">
                    <h5>Total Credit:</h5>
                    <h5>IDR {{ number_format($creditTotal, 2, ',', '.') }}</h5>
                </div>
                <div class="d-flex justify-content-between">
                    <h5>Difference:</h5>
                    @if ($difference !== 0)
                        <h5 class="text-danger">IDR {{ number_format($difference, 2, ',', '.') }}</h5>
                    @else
                        <h5 class="text-success">IDR {{ number_format($difference, 2, ',', '.') }}</h5>
                    @endif
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end mt-4">
            <a href="{{ route('ledger.general-journal.index') }}">
                <button class="btn btn-secondary me-2" type="button">Cancel</button>
            </a>
            @if ($create)
                <div class="btn-group">
                    <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown"
                        aria-expanded="false">Save</button>
                    <ul class="dropdown-menu" style="">
                        <li><button class="dropdown-item" wire:click='save(false)'>Save as draft</button></li>
                        <li><button class="dropdown-item text-success" wire:click='save(true)'>Save and approve</button>
                        </li>
                    </ul>
                </div>
            @else
                <div class="btn-group">
                    <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown"
                        aria-expanded="false">Update</button>
                    <ul class="dropdown-menu" style="">
                        <li><button class="dropdown-item" wire:click='update(false)'>Update as draft</button></li>
                        <li><button class="dropdown-item text-success" wire:click='update(true)'>Update and
                                approve</button>
                        </li>
                    </ul>
                </div>
            @endif
        </div>
    </div>

    <script>
        function selectIfZero(element) {
            if (element.value === "0") {
                element.select();
            }
        }
    </script>
</div>
