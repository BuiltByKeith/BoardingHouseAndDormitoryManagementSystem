<div class="modal fade" id="transactionDetailsModal{{ $payment->id }}" tabindex="-1" role="dialog"
    aria-labelledby="transactionDetailsModal{{ $payment->id }}" Label aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Transaction Information</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        @if ($payment->bhTenantBill->bhRoomTenant->studentTenant->sex == 0)
                                            <img src="{{ asset('images/female_avatar.svg') }}" alt="user-avatar"
                                                class="img-circle img-fluid" style="width: 150px; height:auto;">
                                        @elseif($payment->bhTenantBill->bhRoomTenant->studentTenant->sex == 1)
                                            <img src="{{ asset('images/male_avatar.svg') }}" alt="user-avatar"
                                                class="img-circle img-fluid" style="width: 150px; height:auto;">
                                        @endif

                                        <h5 class="mt-3">
                                            <strong>{{ $payment->bhTenantBill->bhRoomTenant->studentTenant->firstname . ' ' . $payment->bhTenantBill->bhRoomTenant->studentTenant->middlename . ' ' . $payment->bhTenantBill->bhRoomTenant->studentTenant->lastname }}</strong>
                                        </h5>
                                        <p style="font-size: 16px;" class="">
                                            {{ $payment->bhTenantBill->bhRoomTenant->studentTenant->student_id }}
                                        </p>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="text-center">
                                            Bill Details
                                        </div>
                                    </div>
                                    <div class="card-body p-0">

                                        <table class="table table-hover">
                                            <thead>
                                                <th>Charge</th>
                                                <th>Amount</th>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $totalBill = 0; // Initialize total bill variable
                                                @endphp
                                                @foreach ($payment->bhTenantBill->template->details as $charge)
                                                    <tr>
                                                        <td>{{ $charge->charge->name }}</td>
                                                        <td>{{ $charge->charge->prices->where('date_start', '<=', $payment->bhTenantBill->created_at)->first()->amount ? Number::currency($charge->charge->prices->where('date_start', '<=', $payment->bhTenantBill->created_at)->first()->amount, 'PHP') : '' }}
                                                        </td>
                                                        @php
                                                            $totalBill += $charge->charge->prices
                                                                ->where(
                                                                    'date_start',
                                                                    '<=',
                                                                    $payment->bhTenantBill->created_at,
                                                                )
                                                                ->first()->amount;
                                                        @endphp
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td>{{ $payment->bhTenantBill->bhRoomTenant->boardingHouseRoom->room_name }}
                                                        Rate</td>
                                                    <td>{{ $payment->bhTenantBill->bhRoomTenant->boardingHouseRoom->roomPrices->where('date_start', '<=', $payment->bhTenantBill->created_at)->first()->amount ? Number::currency($payment->bhTenantBill->bhRoomTenant->boardingHouseRoom->roomPrices->where('date_start', '<=', $payment->bhTenantBill->created_at)->first()->amount, 'PHP') : '' }}
                                                    </td>
                                                    @php
                                                        $totalBill += $payment->bhTenantBill->bhRoomTenant->boardingHouseRoom->roomPrices
                                                            ->where(
                                                                'date_start',
                                                                '<=',
                                                                $payment->bhTenantBill->created_at,
                                                            )
                                                            ->first()->amount;
                                                    @endphp
                                                </tr>
                                                <tr class="text-center">
                                                    <td colspan="2">
                                                        Total Bill:
                                                        <strong>{{ Number::currency($totalBill, 'PHP') }}</strong>
                                                    </td>
                                                </tr>
                                            </tbody>

                                        </table>

                                    </div>
                                </div>
                                <div class="card">

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 text-center">
                                                Paid:
                                                <strong>{{ $payment->amount ? Number::currency($payment->amount, 'PHP') : '' }}</strong>
                                            </div>
                                            <div class="col-md-4 text-center">
                                                Comment: <strong>{{ $payment->comment }}</strong>
                                            </div>
                                            <div class="col-md-4">
                                                Date Paid: <strong>{{ $payment->created_at->format('F d, Y') }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-default float-right" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
