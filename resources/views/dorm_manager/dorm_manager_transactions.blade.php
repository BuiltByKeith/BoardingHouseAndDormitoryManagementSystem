@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 mt-2">
                    <h1 class="m-0"><i class="fa-solid fa-home mr-2"></i>Dashboard</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>



    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="table-responsive">
                            <div class="card">
                                <div class="card-body">
                                    <table class="table table-hover table-bordered" id="dormManagerTransactionsListTable">
                                        <thead>
                                            <th>Receipt Number</th>
                                            <th>Tenant Name</th>
                                            <th>Amount</th>
                                            <th>Month</th>
                                            <th>Date Paid</th>
                                            <th>Bill Status</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($dormManagerTransactions as $transaction)
                                                <tr>
                                                    <td>{{ $transaction->receipt_no }}</td>
                                                    <td>{{ $transaction->dormTenantBill->dormRoomTenant->studentTenant->firstname . ' ' . $transaction->dormTenantBill->dormRoomTenant->studentTenant->middlename . ' ' . $transaction->dormTenantBill->dormRoomTenant->studentTenant->lastname }}
                                                    </td>
                                                    <td>{{ $transaction->amount ? Number::currency($transaction->amount, 'PHP') : '' }}
                                                    </td>
                                                    <td>{{ $transaction->dormTenantBill->month ? Carbon\Carbon::parse($transaction->dormTenantBill->month)->format('F Y') : '' }}
                                                    </td>
                                                    <td>{{ $transaction->created_at->format('F d, Y') }}</td>
                                                    @if ($transaction->dormTenantBill->payment_status == 0)
                                                        <td style="color:#ffc600; font-weight:bold;">Pending</td>
                                                    @elseif ($transaction->dormTenantBill->payment_status == 1)
                                                        <td style="color:orange; font-weight:bold;">Partial</td>
                                                    @elseif ($transaction->dormTenantBill->payment_status == 2)
                                                        <td style="color:#02681e; font-weight:bold;">Paid</td>
                                                    @endif
                                                    <td>
                                                        <button class="btn btn-sm btn-success" data-toggle="modal"
                                                                data-target="#dormRoomTenantTransactionDetailsModal{{ $transaction->id }}">More
                                                                Info</button>
                                                            @include('dorm_manager.dorm_manager_modals.dorm_manager_tenant_transaction_details_modal')
                                                    </td>
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
    </section>
    <script>
        $(document).ready(function() {
            // Initialize the DataTable
            $('#dormManagerTransactionsListTable').DataTable({
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
            }).buttons().container().appendTo('#dormManagerTransactionsListTable_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
