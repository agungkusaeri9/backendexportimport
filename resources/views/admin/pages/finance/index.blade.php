@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h6>Data Finance</h6>
                        @can('finance-create')
                        <a href="{{ route('admin.finances.create') }}" class="btn btn-primary btn-sm">Tambah Finance</a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <table id="table" class="table table-bordered table-hover w-100">
                        <thead>
                            <tr>
                                <th  style="width:20px">No</th>
                                <th>Job Number</th>
                                <th>Type</th>
                                <th>Warehouse</th>
                                <th>Carrier</th>
                                <th>Port Of Loading</th>
                                <th>Destination</th>
                                <th>Customer</th>
                                <th>Consigne</th>
                                <th>Invoice</th>
                                <th>Payment Status</th>
                                <th>Delivery Order</th>
                                @canany(['finance-edit', 'finance-delete'])
                                <th style="width:120px;text-align:center">Aksi</th>
                                @endcanany
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->job_number }}</td>
                                <td>{{ $item->type }}</td>
                                <td>{{ $item->warehouse->name }}</td>
                                <td>{{ $item->carrier->name }}</td>
                                <td>{{ $item->portofloading->name }}</td>
                                <td>{{ $item->dst->name ?? '-' }}</td>
                                <td>{{ $item->customer }}</td>
                                <td>{{ $item->consigne }}</td>
                                <td>
                                    @if ($item->invoice)
                                    <a href="{{ route('admin.finances.download',$item->id) }}?cat=invoice" class="btn btn-sm btn-success">Download</a>
                                    @else
                                    Tidak Ada
                                    @endif
                                </td>
                                <td>
                                    @if ($item->payment_status)
                                    <a href="{{ route('admin.finances.download',$item->id) }}?cat=payment_status" class="btn btn-sm btn-success">Download</a>
                                    @else
                                    Tidak Ada
                                    @endif
                                </td>
                                <td>
                                    @if ($item->delivery_order)
                                    <a href="{{ route('admin.finances.download',$item->id) }}?cat=delivery_order" class="btn btn-sm btn-success">Download</a>
                                    @else
                                    Tidak Ada
                                    @endif
                                </td>
                                @canany(['finance-edit', 'finance-delete'])
                                <td class="text-center">
                                    @can('finance-edit')
                                    <a href="{{ route('admin.finances.edit',$item->id) }}" class="btn btn-sm btn-info" title="Edit"><i class="fas fa-edit"></i></a>
                                    @endcan
                                    @can('finance-delete')
                                    <form method="post" class="d-inline" id="formDelete">
                                        @csrf
                                        @method('delete')
                                        <button title="Hapus" class="btn btn-sm btn-danger btnDelete" data-action="{{ route('admin.finances.destroy',$item->id) }}"><i class="fas fa-trash"></i></button>
                                    </form>
                                    @endcan
                                </td>
                                @endcanany
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}">
@endpush
@push('scripts')
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
@include('admin.layouts.partials.sweetalert')
<script>
    $(function () {
        $('#table').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "responsive": true
        });
    });
</script>
@endpush
