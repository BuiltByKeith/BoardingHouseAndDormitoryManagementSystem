@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6 mt-2">
                <h1 class="m-0"><i class="fa-solid fa-user mr-2"></i>Profile</h1>
            </div><!-- /.col -->
            <div class="col-sm-6 mt-2">
                <ol class="breadcrumb float-right">
                    <div class="form-inline ml-2">
                        <button type="button" class="btn  btn-success" onclick="showOsaEditProfile('{{$osaPersonnel->id}}')">Edit Profile</button>
                    </div>
                </ol>
            </div>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>



<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="container-fluid">


                <div class="col-md-6 mx-auto mb-4">
                    <div class="card h-100 d-flex flex-column justify-content-center align-items-center p-4">
                        <div class="card-body text-center">
                            @if ($osaPersonnel->sex == 0)
                            <img src="{{ asset('images/female_avatar.svg') }}" alt="" class="img img-fluid img-circle" style="width: 200px; height: 200px;">
                            @elseif ($osaPersonnel->sex == 1)
                            <img src="{{ asset('images/male_avatar.svg') }}" alt="" class="img img-fluid img-circle" style="width: 200px; height: 200px;">
                            @endif
                            <h1>{{$osaPersonnel->firstname . ' ' . $osaPersonnel->middlename . ' ' . $osaPersonnel->lastname}}</h1>
                            <div>
                                @if ($osaPersonnel->sex == 0)
                                <h2 style="display: flex; align-items: center;"><i class="fas fa-venus-mars mr-3"></i> Female</h2>
                                @elseif($osaPersonnel->sex == 1)
                                <h2 style="display: flex; align-items: center;"><i class="fas fa-venus-mars mr-3"></i> Male</h2>
                                @else
                                <h2 style="display: flex; align-items: center;"><i class="fas fa-venus-mars mr-3"></i> </h2>
                                @endif
                                <h2 style="display: flex; align-items: center;"><i class="fas fa-phone mr-3"></i>{{$osaPersonnel->contact_no}}</h2>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@include('osa.osa_modals.update_osa_profile_modal')
<script>
    function showOsaEditProfile(id) {
        $('#osaPersonnelUpdateProfileModal' + id).modal('show');
    }
</script>
@endsection