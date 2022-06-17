@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="text-center">Edit Finance</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.finances.update',$item->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="form-group row">
                            <label for="job_number" class="col-md-2 col-form-label">Job Number</label>
                            <div class="col-md-10">
                                <input type="text" name="job_number" class="form-control @error('job_number') is-invalid @enderror" id="job_number" value="{{ $item->job_number ?? old('job_number') }}">
                                @error('job_number')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-md-2 col-form-label">Type</label>
                            <div class="col-md-10">
                                <select name="type" id="type" class="form-control @error('type') is-invalid @enderror">
                                    <option value="" selected disabled>- Pilih -</option>
                                    <option @if($item->type === 'export') selected @endif value="export">Export</option>
                                    <option @if($item->type === 'import') selected @endif value="import">Import</option>
                                </select>
                                @error('type')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="warehouse_id" class="col-md-2 col-form-label">Warehouse</label>
                            <div class="col-md-10">
                                <select name="warehouse_id" id="warehouse_id" class="form-control @error('warehouse_id') is-invalid @enderror">
                                    <option value="" selected disabled>- Pilih -</option>
                                    @foreach ($warehouses as $warehouse)
                                        <option @if($warehouse->id == $item->warehouse_id) selected @endif value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                    @endforeach
                                </select>
                                @error('warehouse_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="carrier_id" class="col-md-2 col-form-label">Carrier</label>
                            <div class="col-md-10">
                                <select name="carrier_id" id="carrier_id" class="form-control @error('carrier_id') is-invalid @enderror">
                                    <option value="" selected disabled>- Pilih -</option>
                                    @foreach ($carriers as $carrier)
                                        <option @if($carrier->id == $item->carrier_id) selected @endif value="{{ $carrier->id }}">{{ $carrier->name }}</option>
                                    @endforeach
                                </select>
                                @error('carrier_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="port_of_loading" class="col-md-2 col-form-label">Port Of Loading</label>
                            <div class="col-md-10">
                                <select name="port_of_loading" id="port_of_loading" class="form-control @error('port_of_loading') is-invalid @enderror">
                                    <option value="" selected disabled>- Pilih -</option>
                                    @foreach ($countries as $country)
                                        <option @if($country->id == $item->port_of_loading) selected @endif value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                @error('port_of_loading')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="destination" class="col-md-2 col-form-label">Destination</label>
                            <div class="col-md-10">
                                <select name="destination" id="destination" class="form-control @error('destination') is-invalid @enderror">
                                    <option value="" selected disabled>- Pilih -</option>
                                    @foreach ($countries as $country)
                                        <option @if($country->id == $item->destination) selected @endif value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                @error('destination')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customer" class="col-md-2 col-form-label">Customer</label>
                            <div class="col-md-10">
                                <input type="text" name="customer" class="form-control @error('customer') is-invalid @enderror" id="customer" value="{{ $item->customer ?? old('customer') }}">
                                @error('customer')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="consigne" class="col-md-2 col-form-label">Consigne</label>
                            <div class="col-md-10">
                                <input type="text" name="consigne" class="form-control @error('consigne') is-invalid @enderror" id="consigne" value="{{ $item->consigne ?? old('consigne') }}">
                                @error('consigne')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="invoice" class="col-md-2 col-form-label">Invoice</label>
                            <div class="col-md-10">
                                <input type="text" name="invoice" class="form-control @error('invoice') is-invalid @enderror" id="invoice" value="{{ $item->invoice ?? old('invoice') }}">
                                @error('invoice')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="payment_status" class="col-md-2 col-form-label">Payment Status</label>
                            <div class="col-md-10">
                                <input type="text" name="payment_status" class="form-control @error('payment_status') is-invalid @enderror" id="payment_status" value="{{ $item->payment_status ?? old('payment_status') }}">
                                @error('payment_status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="delivery_order" class="col-md-2 col-form-label">Delivery Order</label>
                            <div class="col-md-10">
                                <input type="text" name="delivery_order" class="form-control @error('delivery_order') is-invalid @enderror" id="delivery_order" value="{{$item->delivery_order ?? old('delivery_order') }}">
                                @error('delivery_order')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group d-flex justify-content-between">
                            <a href="{{ route('admin.finances.index') }}" class="btn btn-warning">Batal</a>
                            <button class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
