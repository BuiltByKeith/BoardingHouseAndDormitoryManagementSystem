@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fa-solid fa-folder-open mr-2"></i>Document Submissions</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-right">
                        <div class="form-inline">
                            <button data-toggle="modal" type="button" data-toggle="modal" data-target="#addNewDocumentModal"
                                class="btn btn-block btn-success">Add Document</button>
                        </div>
                    </ol>
                    @include('operator.operator_modals.add_new_document_modal')
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>



    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered" id="documentSubmissionTable">
                                            <thead>
                                                <th>Document Name</th>
                                                <th>Action</th>

                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="" id="documentDetailsCard" hidden>

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
    <script>
        function showLoadingIndicator() {
            $('#loadingIndicator').show();
        }

        // Function to hide loading indicator
        function hideLoadingIndicator() {
            setTimeout(function() {
                $('#loadingIndicator').hide();
            }, 1000);
        }

        function refreshDocumentTemplatesTable(bhIh) {
            console.log(bhIh);
            showLoadingIndicator();
            $.ajax({
                url: "{{ route('operatorFetchDocumentSubmission') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    bh_id: bhIh,
                    _token: "{{ csrf_token() }}",
                },
                success: function(data) {
                    console.log(data);
                    hideLoadingIndicator();
                    var table = $('#documentSubmissionTable').DataTable();
                    table.clear(); // Clear existing rows
                    data.forEach(function(document) {
                        table.row.add([
                            document.documentName,

                            '<button type="button" onclick="openDocumentInfoCard(' + document
                            .id + ", '" + document.filePath + "', '" + document.documentName +
                            "')" +
                            '" class="btn btn-sm btn-success" title="More Info"><i class="fa-solid fa-user"></i></button>' +
                            ' ' +
                            '<button type="button" onclick="deleteDocumentTemplate(' +
                            document.id + ")" +
                            '" class="btn btn-sm btn-danger" title="Delete"><i class="fa-solid fa-trash"></i></button>'
                        ]);
                    });

                    table.draw(); // Redraw table
                },
                error: function(xhr, status, error) {
                    hideLoadingIndicator();
                    console.error(xhr.responseText);
                }
            });
        }

        function openDocumentInfoCard(id, filePath, documentName) {
            showLoadingIndicator();
            var storagePath = 'storage/' + filePath;
            var assetPath = "{{ asset('') }}" + storagePath;
            var iframe = '<iframe id="pdfViewer" src="' + assetPath + '" width="100%" height="100%"></iframe>';
            var body = `
                <div class="card">
                    <div class="card-body text-center">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="float-left">${documentName}</h4>
                            </div>
                            <div class="col-md-6">
                                <button id="fullscreenButton" class="btn btn-sm btn-success float-right"><i class="fas fa-expand"></i></button>
                            </div>
                        </div>
                        <div style="width:100%; height:100vh;">
                            ${iframe}
                        </div>
                    </div>
                </div>`;

            $('#documentDetailsCard').html(body);
            $('#documentDetailsCard').removeAttr('hidden');
            hideLoadingIndicator();
            // Get the PDF viewer iframe
            var pdfViewer = document.getElementById('pdfViewer');

            // Get the fullscreen button
            var fullscreenButton = document.getElementById('fullscreenButton');

            // Function to toggle fullscreen
            function toggleFullscreen() {
                if (!document.fullscreenElement) {
                    pdfViewer.requestFullscreen();
                } else {
                    if (document.exitFullscreen) {
                        document.exitFullscreen();
                    }
                }
            }

            // Add click event listener to fullscreen button
            fullscreenButton.addEventListener('click', toggleFullscreen);
        }

        function deleteDocumentTemplate(id) {
            var templateId = id;

            showConfirmationModal('confirmDelete');
            // Assuming you want to delete the document template with the given ID and filePath
            $('#confirmDelete').off('click').on('click', function() {
                // Perform AJAX request to delete the document template
                $.ajax({
                    url: "",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        _token: "{{ csrf_token() }}",
                        template_id: templateId, // Pass the template ID
                    },
                    success: function(response) {
                        if (response.success) {
                            // Reload the document templates table or perform any other actions
                            $('#confirmationModal').modal('hide');
                            $('#documentPreview').prop('hidden', true);

                            toastr.success('Documet template deleted successfully.');
                            refreshDocumentTemplatesTable();
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert("An error occurred while deleting the document template.");
                    }
                });
            });
        }


        $(document).ready(function() {

            refreshDocumentTemplatesTable({{ $bhId }});

            $('#documentSubmissionTable').DataTable({
                "paging": true,
                "pageLength": 5,
                "searching": true,
                "lengthChange": false,
                "ordering": true,
                "responsive": true,
                "autoWidth": false,
                "scrollCollapse": false,
                "scrollX": false,
            });
        });
    </script>
    <script>
        function showConfirmationModal(action) {
            if (action == 'submitConfirm') {
                $('#confirmationQuestion').text('Confirm Submission?');
                $('#confirmationModal').modal('show');
                $('#confirmButton').click(function() {
                    $('#operatorSubmitDocumentFile').submit();
                });
            } else if (action == 'confirmDelete') {
                $('#confirmationQuestion').text('Confirm Delete Document?');
                $('#confirmationModal').modal('show');
            }
        }
    </script>
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
@endsection
