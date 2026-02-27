@extends('layouts.app')



@section('content')
    <style>
        .nav-link:hover,
        .nav-link.active {
            background-color: #02681e;
            color: #ffc600;
            /* Change to the desired color */
        }

        .nav-link {
            color: black;
        }
    </style>



    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 mt-2">
                    <h1 class="m-0"><i class="fa-solid fa-user mr-3"></i>Tenant Profile</h1>
                </div><!-- /.col -->
                <div class="col-sm-6 mt-2">
                    <button class="btn btn-success float-right" onclick="showEditProfileModal()">Update</button>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>



    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-body text-center">
                                        @if ($dormTenant->studentTenant->sex == 0)
                                            <img src="{{ asset('images/female_avatar.svg') }}" alt="user-avatar"
                                                class="img-circle img-fluid" style="width: 150px; height:auto;"
                                                id="imageProfileOfTenant">
                                        @elseif ($dormTenant->studentTenant->sex == 1)
                                            <img src="{{ asset('images/male_avatar.svg') }}" alt="user-avatar"
                                                class="img-circle img-fluid" style="width: 150px; height:auto;"
                                                id="imageProfileOfTenant">
                                        @endif

                                        <h5 class="mt-3">{{ $dormTenant->studentTenant->student_id }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="d-flex flex-column h-100">
                                <div class="card  mb-3 flex-grow-1">
                                    <div class="card-body">
                                        <div class="container-fluid">
                                            <p class="text-center">
                                                Tenant Information
                                            </p>
                                            <h2>{{ $dormTenant->studentTenant->firstname . ' ' . $dormTenant->studentTenant->middlename . ' ' . $dormTenant->studentTenant->lastname }}
                                            </h2>
                                            <div class="" style="font-size: 16px;">
                                                <input type="text" id="dormTenantId" name="dormTenantId"
                                                    value="{{ $dormTenant->id }}" hidden>
                                                <p class="mb-1"><i class="fas fa-envelope mr-3"></i>
                                                    {{ $dormTenant->studentTenant->institutional_email }}</p>

                                                @if ($dormTenant->studentTenant->sex == 0)
                                                    <p class="mb-1"><i class="fas fa-venus-mars mr-3"></i>Female</p>
                                                @elseif ($dormTenant->studentTenant->sex == 1)
                                                    <p class="mb-1"><i class="fas fa-venus-mars mr-3"></i>Male</p>
                                                @endif

                                                <p class="mb-1"><i class="fas fa-phone mr-3"></i>
                                                    {{ $dormTenant->studentTenant->contact_no }}</p>
                                                <p class="mb-1"><i class="fas fa-user-graduate mr-3"></i>
                                                    {{ $dormTenant->studentTenant->program->program_name }}</p>
                                                <p class="mb-1"><i class="fas fa-building-columns mr-3"></i>
                                                    {{ $dormTenant->studentTenant->program->college->college_name }}</p>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-row">
                        <div class="col-md-3">

                            <div class="card card-widget widget-user-2">
                                <div class="card-body p-0">
                                    <ul class="nav flex-column">
                                        <li class="nav-item" onclick="showGuardianInformationModal()">
                                            <a href="#" class="nav-link" data-target="guardianInformation"
                                                id="guardianInfoNavLink">
                                                Guardian Information
                                            </a>
                                        </li>
                                        <li class="nav-item" onclick="showBillsInformationCard()">
                                            <a href="#" class="nav-link" data-target="billsInformation"
                                                id="billsInfoNavLink">
                                                Bills
                                            </a>
                                        </li>
                                        <li class="nav-item" onclick="showHistoryInformationModal()">
                                            <a href="#" class="nav-link" data-target="historyInformation"
                                                id="historyInfoNavLink">
                                                Lodging History
                                            </a>
                                        </li>

                                    </ul>
                                </div>

                            </div>

                        </div>


                        <div class="col-md-9">
                            <div class="" id="guardianInformation" hidden>
                                <div class="d-flex flex-column h-100">
                                    <div class="card mb-3 flex-grow-1">
                                        <div class="card-body">


                                            <p class="text-center mb-3">Tenant's Guardian Information</p>
                                            <div class="row align-items-center">
                                                <div class="col-md-3 text-center">
                                                    <!-- Profile Image -->
                                                    @if ($dormTenant->studentTenant->guardian->sex == 0)
                                                        <img src="{{ asset('images/female_avatar.svg') }}" alt="user-avatar"
                                                            class="img-circle img-fluid"
                                                            style="max-width: 150px; height:auto;"
                                                            id="imageProfileOfTenant">
                                                    @elseif ($dormTenant->studentTenant->guardian->sex == 1)
                                                        <img src="{{ asset('images/male_avatar.svg') }}" alt="user-avatar"
                                                            class="img-circle img-fluid"
                                                            style="max-width: 150px; height:auto;"
                                                            id="imageProfileOfTenant">
                                                    @endif
                                                </div>
                                                <div class="col-md-9">
                                                    <!-- Guardian Information -->
                                                    <div class="container-fluid">

                                                        <h2>{{ $dormTenant->studentTenant->guardian->firstname . ' ' . $dormTenant->studentTenant->guardian->middlename . ' ' . $dormTenant->studentTenant->guardian->lastname }}
                                                        </h2>
                                                        <div style="font-size: 16px;">
                                                            @if ($dormTenant->studentTenant->guardian->sex == 0)
                                                                <p class="mb-2"><i
                                                                        class="fas fa-venus-mars mr-2"></i>Female
                                                                </p>
                                                            @elseif ($dormTenant->studentTenant->guardian->sex == 1)
                                                                <p class="mb-2"><i
                                                                        class="fas fa-venus-mars mr-2"></i>Male
                                                                </p>
                                                            @endif
                                                            <p class="mb-2"><i class="fas fa-phone mr-2"></i>
                                                                {{ $dormTenant->studentTenant->guardian->contact_no }}
                                                            </p>
                                                            <p class="mb-2"><i class="fas fa-user-graduate mr-2"></i>
                                                                {{ $dormTenant->studentTenant->guardian->occupation }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="" id="billsInformation" hidden>
                                <div class="d-flex flex-column h-100">
                                    <div class="card mb-3 flex-grow-1">
                                        <div class="card-body">
                                            <p class="text-center">Tenant's Bill Information</p>
                                            <div class="float-right">
                                                <button class="btn btn-success btn-sm mb-3"
                                                    onclick="showGenerateBillModal()">Generate Bill</button>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-hover table-bordered"
                                                    id="dormManagerTenantBillsTable">
                                                    <thead>
                                                        <th>Month</th>
                                                        <th>Total Amount</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </thead>

                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="" id="historyInformation" hidden>
                                <div class="d-flex flex-column h-100">
                                    <div class="card mb-3 flex-grow-1">
                                        <div class="card-body">
                                            <p class="text-center">
                                                Tenant's Lodging History
                                            </p>
                                            <div class="table-responsive">
                                                <table class="table table-hover table-bordered">
                                                    <thead>
                                                        <th>Boarding House | Dormitory</th>
                                                        <th>Operator | Dorm Manager</th>
                                                        <th>Date In</th>
                                                        <th>Date Out</th>
                                                        <th>Reason</th>
                                                        <th>Status</th>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($dormTenant->studentTenant->studentTenantHistory->sortByDesc('created_at') as $history)
                                                            <tr>
                                                                @if ($history->dormitory_id)
                                                                    <!-- If the history contains dormitory information -->
                                                                    <td>{{ $history->dormitory ? $history->dormitory->dormitory_name : '' }}
                                                                    </td>
                                                                    <td>{{ $history->dormitory ? $history->dormitory->dormManager->employee->firstname . ' ' . $history->dormitory->dormManager->employee->middlename . ' ' . $history->dormitory->dormManager->employee->lastname : '' }}
                                                                    </td>
                                                                    <td>{{ $history->date_in ? Carbon\Carbon::parse($history->date_in)->format('F/d/Y') : '' }}
                                                                    </td>
                                                                    <td>{{ $history->date_out ? Carbon\Carbon::parse($history->date_out)->format('F/d/Y') : 'Currently Residing' }}
                                                                    </td>
                                                                    <td>{{ $history->reason ? $history->reason : 'Currently Residing' }}
                                                                    </td>
                                                                    @if ($history->clearance_status == 0)
                                                                        <td style="color: orange; font-weight:bold;">
                                                                            Uncleared
                                                                        </td>
                                                                    @elseif ($history->clearance_status == 1)
                                                                        <td style="color: #02691e; font-weight:bold;">
                                                                            Cleared
                                                                        </td>
                                                                    @endif
                                                                @else
                                                                    <!-- If the history contains only boarding house information -->
                                                                    <td>{{ $history->boardingHouse ? $history->boardingHouse->boarding_house_name : '' }}
                                                                    </td>
                                                                    <td>{{ $history->boardingHouse ? $history->boardingHouse->operator->employee->firstname . ' ' . $history->boardingHouse->operator->employee->middlename . ' ' . $history->boardingHouse->operator->employee->lastname : '' }}
                                                                    </td>
                                                                    <td>{{ $history->date_in ? Carbon\Carbon::parse($history->date_in)->format('F d, Y') : '' }}
                                                                    </td>
                                                                    <td>{{ $history->date_out ? Carbon\Carbon::parse($history->date_out)->format('F d, Y') : '' }}
                                                                    </td>
                                                                    <td>{{ $history->reason ? $history->reason : 'Currently Residing' }}
                                                                    </td>
                                                                    @if ($history->clearance_status == 0)
                                                                        <td style="color: orange; font-weight:bold;">
                                                                            Uncleared
                                                                        </td>
                                                                    @elseif ($history->clearance_status == 1)
                                                                        <td style="color: #02691e; font-weight:bold;">
                                                                            Cleared
                                                                        </td>
                                                                    @endif
                                                                @endif
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
            </div>
        </div>




        <div class="modal fade" id="dormManagerGenerateBillModal" tabindex="-1" role="dialog"
            aria-labelledby="dormManagerGenerateBillModal" Label aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Generate Bill for {{ $dormTenant->studentTenant->firstname }}</span></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">

                                <form action="{{ route('dormManagerGenerateBillForTenant') }}" method="POST"
                                    id="dormManagerGenerateBillForTenant" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h2>{{ $dormTenant->dormRoom->room_name }}</h2>
                                                <h5>{{ $dormTenant->dormRoom->roomPrices ? Number::currency($dormTenant->dormRoom->roomPrices->where('isActive', 1)->first()->amount, 'PHP') : '' }}
                                                </h5>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Select Month</label>
                                            <input type="date" class="form-control" id="generateTenantBillReportDate"
                                                name="generateTenantBillReportDate">
                                        </div>

                                        <input type="text" value="{{ $dormTenant->id }}" id="generateBillTenantId"
                                            name="generateBillTenantId" hidden>

                                        <div class="form-group">
                                            <label for="selectBillTemplate">Select Bill Template</label>
                                            <select name="selectBillTemplate" id="selectBillTemplate"
                                                class="form-control">
                                                <option value="" selected>Select a template</option>
                                                @foreach ($dormBillTemplates as $template)
                                                    <option value="{{ $template->id }}">{{ $template->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div id="templateDetailCardInfo" hidden>
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="text-center">
                                                        <h3 id="templateDetailNameCard"></h3>
                                                        <p><u>Inclusions:</u></p>
                                                    </div>
                                                    <div class="table-responsive">
                                                        <table class="table table-sm table-hovered table-bordered"
                                                            id="templateDetailChargeTable">
                                                            <thead>
                                                                <th>Charge</th>
                                                                <th>Amount</th>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <button type="button" class="btn btn-block btn-success"
                                            onclick="openConfirmationModal('generateBill')">Generate</button>
                                        <button type="button" data-dismiss="modal"
                                            class="btn btn-block btn-default">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="dormTenantBillInfoModal" tabindex="-1" role="dialog"
            aria-labelledby="dormTenantBillInfoModal" Label aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tenant Bill Breakdown</span></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div class="row">
                                        <div class="col-md-9">

                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group float-right">
                                                <input type="text" name="billSummaryDetailStatus" readonly
                                                    id="billSummaryDetailStatus" class="form-control form-control-sm">
                                                <span class="input-group-append">
                                                    <button type="submit" class="btn btn-warning btn-sm"
                                                        onclick="openUpdateBillStatusModal()">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-row">
                                        <div class="col-md-5">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="text-center">
                                                        <h3 id="dormRoomTenantNameOnBillBreakDown">Tenant Name</h3>
                                                        <h5><span><i class="fas fa-bed"></i></span> <span
                                                                id="dormRoomTenantRoomNameOnBillBreakDown"></span></h5>


                                                        <div class="text-left" id="dormTenantBillInfoBreakdownPart">
                                                            <!-- Breakdown part will be populated dynamically -->
                                                        </div>
                                                        <div class="text-center">
                                                            <p>Total bill: <strong><span
                                                                        id="dormTenantBillTotal"></span></strong>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <p class="text-left">Tenant Transactions</p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <button class="btn btn-success btn-sm float-right"
                                                                onclick="showPaymentFormModal()">Add
                                                                Payment</button>
                                                        </div>
                                                    </div>
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-hover"
                                                            id="dormTenantBillPaymentsTable">
                                                            <thead>
                                                                <th>Receipt Number</th>
                                                                <th>Amount</th>
                                                                <th>Date Paid</th>
                                                                <th>Comment</th>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <button class="btn btn-block btn-default" data-dismiss="modal">Close</button>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="dormManagerUpdateTenantBillStatusModal" tabindex="-1" role="dialog"
            aria-labelledby="dormManagerUpdateTenantBillStatusModal" Label aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update Bill Status</span></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="modal-body">
                                            <form action="{{ route('dormManagerUpdateTenantBillStatus') }}"
                                                method="post" enctype="multipart/form-data"
                                                id="dormManagerUpdateTenantBillStatusFormId">
                                                @csrf
                                                <div class="form-group">
                                                    <input type="text" id="dormTenantBillId" name="dormTenantBillId"
                                                        hidden>
                                                    <label for="dormManagerUpdateTenantBillStatusSelect">Status</label>
                                                    <select name="dormManagerUpdateTenantBillStatusSelect"
                                                        id="dormManagerUpdateTenantBillStatusSelect"
                                                        class="custom-select">
                                                        <option value="" selected>Select status</option>
                                                        <option value="0">Pending</option>
                                                        <option value="1">Partial</option>
                                                        <option value="2">Paid</option>
                                                    </select>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <button type="button" class="btn btn-default btn-block btn-sm"
                                                            data-dismiss="modal">Cancel</button>
                                                    </div>
                                                    <div class="col-md-6">

                                                        <button type="button" class="btn btn-success btn-block btn-sm"
                                                            onclick="showConfirmationModal('updateStatus')">Confirm</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="dormManagerPayTenantForm" tabindex="-1" role="dialog"
            aria-labelledby="dormManagerPayTenantForm" Label aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Payment Form</span></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="modal-body">
                                        <form action="{{ route('dormManagerSubmitTenantBillPayment') }}" method="post"
                                            enctype="multipart/form-data" id="dormManagerSubmitTenantBillPaymentForm">
                                            @csrf
                                            <input type="text" id="dormTenantBillIdForPayment"
                                                name="dormTenantBillIdForPayment" hidden>
                                            <div class="form-group">
                                                <label for="dormTenantPayTenantBillReceiptNo">Receipt No</label>
                                                <input type="text" id="dormTenantPayTenantBillReceiptNo"
                                                    name="dormTenantPayTenantBillReceiptNo" class="form-control" required
                                                    placeholder="Enter Receipt Number">
                                            </div>
                                            <div class="form-group">
                                                <label for="dormTenantPayTenantBillAmount">Amount</label>
                                                <input type="number" id="dormTenantPayTenantBillAmount"
                                                    name="dormTenantPayTenantBillAmount" class="form-control" required
                                                    placeholder="Enter Amount">
                                            </div>
                                            <div class="form-group">
                                                <label for="dormTenantPayTenantBillComment">Comment</label>
                                                <textarea name="dormTenantPayTenantBillComment" id="dormTenantPayTenantBillComment" rows="3"
                                                    class="form-control" placeholder="Enter comment (Paid, Partial, etc.)"></textarea>
                                            </div>

                                            <button type="button" class="btn btn-success btn-block btn"
                                                onclick="showConfirmationModal('payBill')">Confirm</button>

                                            <button type="button" class="btn btn-default btn-block btn"
                                                data-dismiss="modal">Cancel</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="dormManagerUpdateTenantProfileModal" tabindex="-1" role="dialog"
            aria-labelledby="dormManagerUpdateTenantProfileModal" Label aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update {{ $dormTenant->studentTenant->firstname }}'s Profile</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>


                    <div class="modal-body">

                        <!-- Step 1: Basic Information -->
                        <div class="container-fluid">
                            <form method="POST" action="{{ route('dormManagerUpdateTenantProfile') }}"
                                enctype="multipart/form-data" id="dormManagerUpdateTenantProfileForm">
                                @csrf
                                <div class="row">
                                    <div class="text-center">
                                        <p>Tenant Profile</p>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="text" id="editTenantProfileDormRoomTenantId"
                                            name="editTenantProfileDormRoomTenantId" value="{{ $dormTenant->id }}"
                                            hidden>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="editTenantProfileFirstname">Firstname</label>
                                                    <input type="text" class="form-control"
                                                        id="editTenantProfileFirstname" name="editTenantProfileFirstname"
                                                        placeholder="Enter First name" required
                                                        value="{{ $dormTenant->studentTenant->firstname }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="editTenantProfileMiddlename">Middlename</label>
                                                    <input type="text" class="form-control"
                                                        id="editTenantProfileMiddlename"
                                                        name="editTenantProfileMiddlename" placeholder="Enter Middle name"
                                                        required value="{{ $dormTenant->studentTenant->middlename }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="editTenantProfileLastname">Lastname</label>
                                                    <input type="text" class="form-control"
                                                        id="editTenantProfileLastname" name="editTenantProfileLastname"
                                                        placeholder="Enter Last name" required
                                                        value="{{ $dormTenant->studentTenant->lastname }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="editTenantProfileExname">Extname</label>
                                                    <input type="text" class="form-control"
                                                        id="editTenantProfileExname" name="editTenantProfileExname"
                                                        placeholder="Enter Extension name" required
                                                        value="{{ $dormTenant->studentTenant->extname }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="editTenantProfileCollege">College</label>
                                                    <select name="editTenantProfileCollege" id="editTenantProfileCollege"
                                                        class="custom-select">
                                                        <option
                                                            value="{{ $dormTenant->studentTenant->program->college->id }}"
                                                            selected>
                                                            {{ $dormTenant->studentTenant->program->college->college_name }}
                                                        </option>
                                                        @foreach ($colleges as $college)
                                                            <option value="{{ $college->id }}">
                                                                {{ $college->college_name }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="editTenantProfileProgram">Program</label>
                                                    <select name="editTenantProfileProgram" id="editTenantProfileProgram"
                                                        class="custom-select">
                                                        <option value="{{ $dormTenant->studentTenant->program->id }}"
                                                            selected>
                                                            {{ $dormTenant->studentTenant->program->program_name }}
                                                        </option>
                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="editTenantProfilePermanentAddress">Permanent
                                                        Address</label>
                                                    <input type="text" class="form-control"
                                                        id="editTenantProfilePermanentAddress"
                                                        name="editTenantProfilePermanentAddress"
                                                        placeholder="Enter permanent address" required
                                                        value="{{ $dormTenant->studentTenant->permanent_address }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="editTenantProfileContactNumber">Contact Number</label>
                                                    <input type="text" class="form-control"
                                                        id="editTenantProfileContactNumber"
                                                        name="editTenantProfileContactNumber"
                                                        placeholder="Enter contact number" required
                                                        value="{{ $dormTenant->studentTenant->contact_no }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <p>Tenant Guardian </p>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="editTenantProfileGuardianFirstname">Firstname</label>
                                                    <input type="text" class="form-control"
                                                        id="editTenantProfileGuardianFirstname"
                                                        name="editTenantProfileGuardianFirstname"
                                                        placeholder="Enter guardian firstname" required
                                                        value="{{ $dormTenant->studentTenant->guardian->firstname }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="editTenantProfileGuardianMiddlename">Middlename</label>
                                                    <input type="text" class="form-control"
                                                        id="editTenantProfileGuardianMiddlename"
                                                        name="editTenantProfileGuardianMiddlename"
                                                        placeholder="Enter guardian middlename" required
                                                        value="{{ $dormTenant->studentTenant->guardian->middlename }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="editTenantProfileGuardianLastname">Lastname</label>
                                                    <input type="text" class="form-control"
                                                        id="editTenantProfileGuardianLastname"
                                                        name="editTenantProfileGuardianLastname"
                                                        placeholder="Enter guardian lastname" required
                                                        value="{{ $dormTenant->studentTenant->guardian->lastname }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="editTenantProfileGuardianExtname">Extname</label>
                                                    <input type="text" class="form-control"
                                                        id="editTenantProfileGuardianExtname"
                                                        name="editTenantProfileGuardianExtname"
                                                        placeholder="Enter guardian extension name" required
                                                        value="{{ $dormTenant->studentTenant->guardian->extname }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-4">
                                                <div class="form-group text-center">
                                                    <label for="editTenantProfileGuardianSex">Sex</label>
                                                    <select name="editTenantProfileGuardianSex"
                                                        id="editTenantProfileGuardianSex" class="custom-select">
                                                        @if ($dormTenant->studentTenant->guardian->sex == 0)
                                                            <option value="0" selected>Female</option>
                                                        @elseif ($dormTenant->studentTenant->guardian->sex == 1)
                                                            <option value="1" selected>Male</option>
                                                        @endif
                                                        <option value="1">Male</option>
                                                        <option value="0">Female</option>
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group text-center">
                                                    <label for="editTenantProfileGuardianOccupation">Occupation</label>
                                                    <input type="text" class="form-control"
                                                        id="editTenantProfileGuardianOccupation"
                                                        name="editTenantProfileGuardianOccupation"
                                                        placeholder="Enter guardian occupation" required
                                                        value="{{ $dormTenant->studentTenant->guardian->occupation }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group text-center">
                                                    <label for="editTenantProfileGuardianContactNo">Contact Number</label>
                                                    <input type="text" class="form-control"
                                                        id="editTenantProfileGuardianContactNo"
                                                        name="editTenantProfileGuardianContactNo"
                                                        placeholder="Enter guardian contact number" required
                                                        value="{{ $dormTenant->studentTenant->guardian->contact_no }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" onclick="showConfirmationModal('submitEditProfile')"
                                    class="btn btn-block btn-success">Submit</button>
                                <button type="button" data-dismiss="modal"
                                    class="btn btn-block btn-default">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog"
            aria-labelledby="confirmationModal" Label aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="container">
                            <div class="container-fluid">
                                <div class="form-group d-flex align-items-center justify-content-center">
                                    <h5>Confirmation</h5>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="modal-body">
                                            <span id="confirmationQuestion"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-default btn-block btn-sm"
                                            data-dismiss="modal">Cancel</button>
                                    </div>
                                    <div class="col-md-6">

                                        <button type="button" class="btn btn-success btn-block btn-sm"
                                            id="confirmButton">Confirm</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#editTenantProfileCollege').change(function(event) {
                var collegeId = this.value;

                $('#editTenantProfileProgram').html('');

                $.ajax({
                    url: "{{ route('operatorApiFetchPrograms') }}",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        college_id: collegeId,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        $('#editTenantProfileProgram').html(
                            '<option value=""> Select Program </option>');
                        $.each(response.programs, function(index, val) {
                            $('#editTenantProfileProgram').append(
                                '<option value="' + val.id +
                                '"> ' +
                                val.program_name + ' </option>');
                        });

                    }
                })
            });
        });
    </script>

    <script>
        function showEditProfileModal() {
            $('#dormManagerUpdateTenantProfileModal').modal('show');
        }
    </script>

    <script>
        function showPaymentFormModal() {
            $('#dormManagerPayTenantForm').modal('show');
        }

        function openUpdateBillStatusModal() {
            $('#dormManagerUpdateTenantBillStatusModal').modal('show');
        }

        function showConfirmationModal(action) {
            if (action == 'updateStatus') {
                $('#confirmationQuestion').text('Are you sure you want to update the bill status of this tenant?');
                $('#confirmationModal').modal('show');
                $('#confirmButton').click(function() {
                    $('#dormManagerUpdateTenantBillStatusFormId').submit();
                });
            } else if (action == 'payBill') {
                $('#confirmationQuestion').text('Confirm payment?');
                $('#confirmationModal').modal('show');
                $('#confirmButton').click(function() {
                    $('#dormManagerSubmitTenantBillPaymentForm').submit();
                });
            } else if (action == 'submitEditProfile') {
                $('#confirmationQuestion').text('Confirm profile edit?');
                $('#confirmationModal').modal('show');
                $('#confirmButton').click(function() {
                    $('#dormManagerUpdateTenantProfileForm').submit();
                });
            }


        }
    </script>
    <script>
        function refreshDormTenantProfileBills(id) {
            $.ajax({
                url: "{{ route('dormManagerFetchStudentTenantBills') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    dorm_tenant_id: id,
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {
                    // Handle the response here
                    console.log(response);
                    var tableBody = $('#dormManagerTenantBillsTable tbody').empty();
                    // Populate table with template details
                    response.forEach(bill => {
                        tableBody.append(
                            `<tr>
                                <td>${bill.month}</td>
                                <td>${bill.totalBill}</td>
                                <td>${bill.status}</td>
                                <td><button class="btn btn-success btn-sm" onclick="openBillInfoModal('${bill.id}')"><i class="fas fa-info"></i></button></td>
                            </tr>`
                        );
                    });
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error(xhr.responseText);
                }
            });
        }
        $(document).ready(function() {
            var dormTenantId = $('#dormTenantId').val();

            refreshDormTenantProfileBills(dormTenantId);

        });


        $('#selectBillTemplate').change(function() {
            var templateId = $(this).val();

            if (templateId != '') {
                $.ajax({
                    url: "{{ route('dormManagerFetchDormTemplateDuringBilling') }}",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        template_id: templateId,
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        // Handle the response here
                        console.log(response);
                        var template = response[0]; // Access the first element of the array
                        $('#templateDetailNameCard').text(template.templateName);
                        var tableBody = $('#templateDetailChargeTable tbody').empty();
                        // Populate table with template details
                        template.templateDetails.forEach(detail => {
                            tableBody.append(
                                `<tr>
                                <td>${detail.name}</td>
                                <td>${detail.amount}</td>
                            </tr>`
                            );
                        });
                        $('#templateDetailCardInfo').removeAttr('hidden');
                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    </script>

    <script>
        function openBillInfoModal(billId) {
            console.log(billId);
            $.ajax({
                url: "{{ route('dormManagerFetchTenantBillInfo') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    bill_id: billId,
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {

                    console.log(response);
                    var billInfo = response[0];

                    $('#billSummaryDetailStatus').val(billInfo.paymentStatus);

                    $('#dormRoomTenantNameOnBillBreakDown').text(billInfo.billOfTenantFullName);
                    $('#dormRoomTenantRoomNameOnBillBreakDown').val(billInfo.bhRoomNameOfTenant);
                    // Dorm Tenant Bill Id initiated for the payment form
                    $('#dormTenantBillIdForPayment').val(billInfo.id);
                    // Dorm Tenant Bill Id initiated for the update status
                    $('#dormTenantBillId').val(billInfo.id);



                    var breakdownHTML = '';
                    billInfo.tenantBillTemplate.forEach(function(item) {
                        breakdownHTML +=
                            `${item.chargeName} Rate: <strong>${item.chargePrice}</strong><br>`;
                    });
                    breakdownHTML += `<p>Room Rate: <strong>${billInfo.bhRoomPriceOfTenant}</strong></p>`;
                    $('#dormTenantBillInfoBreakdownPart').html(breakdownHTML);
                    $('#dormTenantBillTotal').text(billInfo.totalBill);

                    var tableBody = $('#dormTenantBillPaymentsTable tbody').empty();
                    if (billInfo.billPaymentTransactions.length <= 0) {
                        tableBody.append(
                            `<tr><td colspan="4" class="text-center">No Transactions Yet</td></tr>`);
                    } else {
                        // Populate table with template details
                        billInfo.billPaymentTransactions.forEach(payment => {
                            tableBody.append(
                                `<tr>
                                    <td>${payment.receiptNo}</td>
                                    <td>${payment.amount}</td>
                                    <td>${payment.datePaid}</td>
                                    <td>${payment.comment}</td>
                                </tr>`
                            );
                        });
                    }


                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error(xhr.responseText);
                }
            });
            $('#dormTenantBillInfoModal').modal('show');
        }

        function openConfirmationModal(action) {
            $('#confirmationModal').modal('show');
        }

        function showGenerateBillModal() {
            $('#dormManagerGenerateBillModal').modal('show');
            $('#confirmButton').click(function() {
                $('#dormManagerGenerateBillForTenant').submit();
            });
        }
    </script>
    <script>
        function showGuardianInformationModal() {
            $('#guardianInfoNavLink').removeClass('nav-link').addClass('nav-link active');
            $('#billsInfoNavLink').removeClass('active');
            $('#historyInfoNavLink').removeClass('active');
            $('#guardianInformation').removeAttr('hidden');
            $('#billsInformation').attr('hidden', 'hidden');
            $('#historyInformation').attr('hidden', 'hidden');
        }

        function showBillsInformationCard() {
            $('#billsInfoNavLink').removeClass('nav-link').addClass('nav-link active');
            $('#historyInfoNavLink').removeClass('active');
            $('#guardianInfoNavLink').removeClass('active');
            $('#billsInformation').removeAttr('hidden');
            $('#guardianInformation').attr('hidden', 'hidden');
            $('#historyInformation').attr('hidden', 'hidden');
        }

        function showHistoryInformationModal() {
            $('#historyInfoNavLink').removeClass('nav-link').addClass('nav-link active');
            $('#billsInfoNavLink').removeClass('active');
            $('#guardianInfoNavLink').removeClass('active');
            $('#historyInformation').removeAttr('hidden');
            $('#billsInformation').attr('hidden', 'hidden');
            $('#guardianInformation').attr('hidden', 'hidden');
        }
    </script>
@endsection
