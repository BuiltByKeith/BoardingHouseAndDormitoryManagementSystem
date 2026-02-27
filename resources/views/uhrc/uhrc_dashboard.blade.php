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
                        <div class="col-md-4">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ $boardingHouse->count() }}</h3>

                                    <p>Boarding Houses</p>
                                </div>
                                <div class="icon">
                                    <i class="nav-icon fas fa-house"></i>
                                </div>
                                <a href="{{ route('uhrcBoardingHousesList') }}" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ $dormitories->count() }}</h3>

                                    <p>Dormitories</p>
                                </div>
                                <div class="icon">
                                    <i class="nav-icon fa-solid fa-house"></i>
                                </div>
                                <a href="{{ route('uhrcDormitoriesList') }}" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>3</h3>

                                    <p>Registration Request</p>
                                </div>
                                <div class="icon">
                                    <i class="nav-icon fas fa-file"></i>
                                </div>
                                <a href="{{route('uhrcPendingRegistrationRequests')}}" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
