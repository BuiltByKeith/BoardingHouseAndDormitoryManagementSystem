@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 mt-2">
                    <h1 class="m-0"><i class="fa-solid fa-peso-sign mr-2"></i>Billings</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container_fluid ">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="container-fluid">
                            <div class="card card-success collapsed-card">
                                <div class="card-header">
                                    <strong>Dormitory Charges</strong>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                class="fas fa-plus"></i>
                                        </button>
                                    </div>

                                </div>

                                <div class="card-body" style="display: none;">
                                    <div class="float-right">
                                        <button class="btn btn-sm btn-success mb-3" onclick="showAddChargesFormModal()">
                                            Add Charges
                                        </button>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Price</th>
                                                <th>Action</th>
                                            </thead>
                                            <tbody>
                                                @foreach ($dormCharges as $charge)
                                                    <tr>
                                                        <td>{{ $charge->name }}</td>
                                                        <td>{{ $charge->description ?? 'No description' }}</td>
                                                        <td>{{ Number::currency($charge->chargePrices->where('isActive', 1)->first()->amount, 'PHP') }}
                                                        </td>
                                                        <td><button class="btn btn-sm btn-success"
                                                                onclick="showChargeDetailsModal('{{ $charge->name }}', '{{ $charge->description }}', '{{ $charge->id }}', '{{ Number::currency($charge->chargePrices->where('isActive', 1)->first()->amount, 'PHP') }}')"><i
                                                                    class="fas fa-info"></i></button>

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
                    <div class="col-md-6">
                        <div class="container-fluid">
                            <div class="card card-success collapsed-card">
                                <div class="card-header">
                                    <strong>Dormitory Bill Templates</strong>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                class="fas fa-plus"></i>
                                        </button>
                                    </div>

                                </div>
                                <div class="card-body" style="display: none;">
                                    <div class="float-right">
                                        <button class="btn btn-sm btn-success mb-3" onclick="showAddChargeTemplateModal()">
                                            Add Bill Template
                                        </button>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                                <th>Name</th>
                                                <th>Inclusions</th>
                                                <th>Action</th>
                                            </thead>
                                            <tbody>
                                                @foreach ($dormBillTemplates as $template)
                                                    <tr>
                                                        <td>{{ $template->name }}</td>
                                                        <td>
                                                            @foreach ($template->details as $detail)
                                                                {{ $detail->dormCharge->name }}:
                                                                {{ Number::currency($detail->dormCharge->chargePrices->where('isActive', 1)->first()->amount, 'PHP') }}
                                                                <br>
                                                            @endforeach
                                                        </td>
                                                        <td><button class="btn btn-danger btn-sm"
                                                                onclick="deleteTemplateModal('{{ $template->id }}')"><i
                                                                    class="fas fa-trash"></i></button></td>
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
    <div class="modal fade" id="dormitoryChargeDetailsModal" tabindex="-1" role="dialog"
        aria-labelledby="dormitoryChargeDetailsModal" Label aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Dormitory Charge</h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="col-md-12">

                        <div class="row">
                            <button class="btn btn-sm btn-warning mb-3" onclick="showeEditPriceModal()"><i
                                    class="fas fa-pen-to-square"></i></button>

                            <div class="card">
                                <div class="card-body">
                                    <div class="text-center">
                                        <h2 id="dormitoryChargeName"></h2>
                                        <p id="dormitoryChargeDescription"></p>

                                    </div>
                                    <div class="table-responsive">
                                        <div class="text-center">Price History</div>
                                        <table class="table table-sm table-hover table-bordered"
                                            id="dormitoryChargePriceHistoryTable">
                                            <thead>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Date Start</th>
                                                <th>Date End</th>
                                            </thead>
                                            <tbody>

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

    <div class="modal fade" id="dormManagerAddDormChargeModal" tabindex="-1" role="dialog"
        aria-labelledby="dormManagerAddDormChargeModal" Label aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Dormitory Charge</h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="row">

                            <form action="{{ route('dormManagerAddDormCharge') }}" method="POST"
                                id="submitAddNewBhCharge">
                                @csrf
                                <div class="form-group">
                                    <label for="dormManagerAddDormChargeName">Enter Charge Name</label>
                                    <input type="text" class="form-control" id="dormManagerAddDormChargeName"
                                        name="dormManagerAddDormChargeName">
                                </div>
                                <div class="form-group">
                                    <label for="dormManagerAddDormChargeDescription">Enter Charge Description</label>
                                    <textarea class="form-control" rows="3" placeholder="Enter Description of the charge here..."
                                        id="dormManagerAddDormChargeDescription" name="dormManagerAddDormChargeDescription"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="dormManagerAddDormChargeAmount">Enter Charge Amount</label>
                                    <input type="text" class="form-control" id="dormManagerAddDormChargeAmount"
                                        name="dormManagerAddDormChargeAmount">
                                </div>
                                <button type="button" class="btn btn-block btn-success"
                                    onclick="showConfirmationModal('add')">Add</button>
                                <button type="button" class="btn btn-block btn-default"
                                    data-dismiss="modal">Cancel</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="dormManagerAddChargeTemplateModal" tabindex="-1" role="dialog"
        aria-labelledby="dormManagerAddChargeTemplateModal" Label aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Dormitory Charge Template</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="row">

                            <form action="{{ route('dormManagerAddNewDormChargeTemplate') }}" method="POST"
                                id="dormManagerAddNewDormChargeTemplate">
                                @csrf
                                <div class="form-group">
                                    <label for="dormManagerAddNewBillTemplateName">Enter Bill Template Name</label>
                                    <input type="text" class="form-control" id="dormManagerAddNewBillTemplateName"
                                        name="dormManagerAddNewBillTemplateName">
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-sm table-hover table-bordered" id="dormitoryChargesTable">
                                        <thead>
                                            <th>Charge Name</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($dormCharges as $charge)
                                                <tr>
                                                    <td>{{ $charge->name }}</td>
                                                    <td>{{ Number::currency($charge->chargePrices->where('isActive', 1)->first()->amount, 'PHP') }}
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="selectedCharges[]" value="{{ $charge->id }}">
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <button type="button" class="btn btn-block btn-success"
                                    onclick="prepareAndSubmit('addNewBillTemplate')">Add</button>
                                <button type="button" class="btn btn-block btn-default"
                                    data-dismiss="modal">Cancel</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="dormitoryEditChargePriceModal" tabindex="-1" role="dialog"
        aria-labelledby="dormitoryEditChargePriceModal" Label aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Dormitory Charge Price</h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="card">
                                <div class="card-body">

                                    <div class="text-center">
                                        <h2 id="dormManagerEditChargePriceName"></h2>
                                        <p>Current Price: <span id="dormManagerEditChargePriceCurrentPrice"></span></p>
                                    </div>

                                    <form action="{{ route('dormManagerUpdateDormChargePrice') }}" method="POST"
                                        id="dormManagerSubmitUpdateDormChargePrice">
                                        @csrf
                                        <input type="text" id="dormManagerEditChargeId" name="dormManagerEditChargeId"
                                            hidden>
                                        <div class="form-group">
                                            <label for="editAmountInput">Enter new Amount</label>
                                            <input type="text" class="form-control" id="editAmountInput"
                                                name="editAmountInput">
                                        </div>
                                        <button type="button" class="btn btn-block btn-success"
                                            onclick="showConfirmationModal('edit')">Submit</button>
                                        <button type="button" class="btn btn-block btn-default"
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
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModal"
        Label aria-hidden="true">
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
                                        id="confirmUpdate">Confirm</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function deleteTemplateModal(templateID) {
            console.log(templateID);
            $('#confirmationQuestion').text('Are you sure you want to delete this template?')
            $('#confirmationModal').modal('show');
            $('#confirmUpdate').click(function() {
                $.ajax({
                    url: "{{ route('dormManagerDeleteBhTemplate') }}",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        template_id: templateID,
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(data) {

                        if (data.feedback == 'success') {
                            location.reload();
                        } else {
                            location.reload();
                        }
                    },
                    error: function(xhr, status, error) {
                        // hideLoadingIndicator()
                        console.error(xhr.responseText);
                    }
                });
            });
        }

        function showAddChargesFormModal() {
            $('#dormManagerAddDormChargeModal').modal('show');
        }

        function showConfirmationModal(action) {
            if (action == 'edit') {
                $('#confirmationQuestion').text('Are you sure you want to edit the charge price?');
                $('#confirmationModal').modal('show');
                $('#confirmUpdate').click(function() {
                    $('#dormManagerSubmitUpdateDormChargePrice').submit();
                });
            } else if (action == 'add') {
                $('#confirmationQuestion').text('Are you sure you want to add this new dormitory charge?');
                $('#confirmationModal').modal('show');
                $('#confirmUpdate').click(function() {
                    $('#submitAddNewBhCharge').submit();
                });
            } else if (action == 'addNewBillTemplate') {
                $('#confirmationQuestion').text('Are you sure you want to add this new dormitory bill template?');
                $('#confirmationModal').modal('show');
                $('#confirmUpdate').click(function() {
                    $('#dormManagerAddNewDormChargeTemplate').submit();
                });
            } else {

            }


        }
    </script>
    <script>
        function showeEditPriceModal() {
            $('#dormitoryEditChargePriceModal').modal('show');
        }

        function showChargeDetailsModal(name, description, id, currentPrice) {
            $('#dormitoryChargeName').text(name);
            $('#dormitoryChargeDescription').text(description);

            // For the edit charge modal
            $('#dormManagerEditChargePriceName').text(name);
            $('#dormManagerEditChargePriceCurrentPrice').text(currentPrice);
            $('#dormManagerEditChargeId').val(id);

            $.ajax({
                url: "{{ route('dormManagerFetchBhChargeHistory') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    charge_id: id,
                    _token: "{{ csrf_token() }}",
                },
                success: function(data) {
                    // hideLoadingIndicator()
                    console.log(data);
                    $('#dormitoryChargePriceHistoryTable tbody').empty();
                    data.forEach(price => {
                        $('#dormitoryChargePriceHistoryTable tbody').append(
                            `<tr>
                                <td>${price.amount}</td>
                                <td>${price.status}</td>
                                <td>${price.dateStart ?? ''}</td>
                                <td>${price.dateEnd ?? ''}</td>
                            </tr>`
                        );
                    });
                },
                error: function(xhr, status, error) {
                    // hideLoadingIndicator()
                    console.error(xhr.responseText);
                }
            });
            $('#dormitoryChargeDetailsModal').modal('show');
        }
    </script>
    <script>
        function showAddChargeTemplateModal() {
            $('#dormManagerAddChargeTemplateModal').modal('show');
        }

        function prepareAndSubmit(action) {
            var selectedCharges = [];
            var checkboxes = document.querySelectorAll('#dormitoryChargesTable input[type="checkbox"]:checked');
            checkboxes.forEach(function(checkbox) {
                selectedCharges.push(checkbox.value);
            });

            // Add the selected charges to a hidden input field
            var hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'selectedCharges';
            hiddenInput.id = 'selectedCharges';
            hiddenInput.value = JSON.stringify(selectedCharges);
            document.getElementById('dormManagerAddNewDormChargeTemplate').appendChild(hiddenInput);
            showConfirmationModal(action);
        }
    </script>
@endsection
