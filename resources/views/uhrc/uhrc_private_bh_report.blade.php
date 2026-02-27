@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-md-6 mt-2">
                    <h1 class="m-0"><i class="fa-solid fa-chart-line mr-2"></i>Report</h1>
                </div><!-- /.col -->
                <div class="col-sm-6 mt-3">
                    <ol class="breadcrumb float-sm-right">
                        <button class="btn btn-success" onclick="exportToExcel('{{ $semester->description }}')"><i
                                class="fa-solid fa-file-excel"></i></button>
                        <button class="btn btn-success ml-2" onclick="printScreen()"><i
                                class="fa-solid fa-print"></i></button>
                    </ol>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>



    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="tabledata">
                        <table class="table table-bordered" id="governmentBoardingHouseReportTable">
                            <thead>
                                <th colspan="11" class="text-center" style="background-color: #02681e; color:white;">
                                    Private Boarding House Report</th>

                            </thead>
                            <thead>
                                <th colspan="11" class="text-center">{{ $semester->description }}
                                    {{ $semester->acadYear->description }}</th>

                            </thead>

                            <thead>
                                <th style="background-color:#FFC600">No.</th>
                                <th style="background-color:#FFC600">Boarding House Name</th>
                                <th style="background-color:#FFC600">OperatorName</th>
                                <th style="background-color:#FFC600">Number of Tenants</th>
                                <th style="background-color:#FFC600">Address</th>

                            </thead>
                            <tbody>
                                @foreach ($boardingHouses as $boardingHouse)
                                    <tr>
                                        <td>
                                            {{ $boardingHouse->id }}
                                        </td>
                                        <td>
                                            {{ $boardingHouse->boarding_house_name }}
                                        </td>
                                        <td>{{ $boardingHouse->operator->employee->firstname . ' ' . $boardingHouse->operator->employee->middlename . ' ' . $boardingHouse->operator->employee->lastname }}
                                        </td>
                                        @php
                                            $totalTenantCount = 0;

                                            foreach ($boardingHouse->boardingHouseRooms as $room) {
                                                $totalTenantCount += $room->roomStudentTenants
                                                    ->where('isActive', 1)
                                                    ->where('ay_semester_id', $semester->id)
                                                    ->count();
                                            }
                                        @endphp
                                        <td>
                                            {{ $totalTenantCount }}
                                        </td>
                                        <td>{{ $boardingHouse->complete_address }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <script>
        function exportToExcel(semester) {
            /* Convert table to Excel workbook */
            var table = document.querySelector('#governmentBoardingHouseReportTable');
            var wb = XLSX.utils.table_to_book(table);


            /* Trigger download */
            XLSX.writeFile(wb, 'government_bh_report_' + semester + '.xlsx');
        }

        function printScreen() {

            window.print();
        }
    </script>
@endsection
