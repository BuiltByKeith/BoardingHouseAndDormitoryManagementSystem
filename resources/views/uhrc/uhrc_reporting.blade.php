@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid ml-3 mr-3">
            <div class="row mb-2">
                <div class="col-sm-6 mt-2">
                    <h1 class="m-0"><i class="fa-solid fa-chart-line mr-3"></i>Reporting</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>



    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <th>Semester</th>
                                <th>View Reports</th>
                            </thead>
                            <tbody>
                                @foreach ($semesters as $semester)
                                    <tr>
                                        <td>
                                            {{ $semester->description }}
                                        </td>
                                        <td>
                                            <a href="uhrc-government-bh-report/{{ $semester->id }}"><button
                                                    class="btn btn-success btn-sm" title="Activities Report">Government
                                                    Boarding Houses</button></a>
                                            <a href="uhrc-private-bh-report/{{ $semester->id }}"><button class="btn btn-success btn-sm"
                                                    title="Officers Report">Private Boarding Houses</button></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
