@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fa-solid fa-chart-line mr-2"></i>Transactions</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>



    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table  table-hover table-bordered" id="transactionMasterListTable">
                                            <thead>
                                                <th>Tenant Name</th>
                                                <th>Bill Month</th>
                                                <th>Amount Paid</th>
                                                <th>Date Paid</th>
                                                <th>Action</th>
                                            </thead>
                                            <tbody>
                                                @php
                                                    use Carbon\Carbon;
                                                @endphp
                                                @foreach ($payments as $payment)
                                                    <tr>
                                                        <td>{{ $payment->bhTenantBill->bhRoomTenant->studentTenant->firstname . ' ' . $payment->bhTenantBill->bhRoomTenant->studentTenant->middlename . ' ' . $payment->bhTenantBill->bhRoomTenant->studentTenant->lastname }}
                                                        </td>
                                                        <td>{{ $payment->bhTenantBill->month ? Carbon::parse($payment->bhTenantBill->month)->format('F Y') : '' }}
                                                        </td>
                                                        <td>{{ $payment->amount ? Number::currency($payment->amount, 'PHP') : '' }}
                                                        </td>
                                                        <td>{{ $payment->created_at->format('F d, Y') }}</td>
                                                        <td><button class="btn btn-sm btn-success" data-toggle="modal"
                                                                data-target="#transactionDetailsModal{{ $payment->id }}">More
                                                                Info</button>
                                                            @include('operator.operator_modals.bill_transaction_detail_modal')</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            // Initialize the DataTable
            $('#transactionMasterListTable').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "scrollCollapse": false,
                "pageLength": 8,
                buttons: ['copy', 'print', 'pdf', 'colvis'],
            }).buttons().container().appendTo('#studentTenantList_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
