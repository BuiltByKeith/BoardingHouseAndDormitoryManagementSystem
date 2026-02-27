@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid ml-3 mr-3">
        <div class="row mb-2">
            <div class="col-sm-6 mt-2">
                <h1 class="m-0"><i class="fa-solid fa-chart-line mr-2"></i>Reporting</h1>
            </div><!-- /.col -->

        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>



<section class="content">
    <div class="container_fluid ml-3 mr-3">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover table-bordered">

                    <tr>
                        <th colspan="2">Dorm info</th>
                        <th colspan="3">Payments</th>
                    </tr>
                    <tr>
                        <th>Dorm Name</th>
                        <th>manager</th>
                        <th>tenants</th>
                        <th>august</th>
                        <th>december</th>
                    </tr>
                 
                    <tr>
                        <td>Lawaan</td>
                        <td>Jonalena</td>
                        <td>Allen</td>
                        <td>1,500</td>
                        <td></td>
                    </tr>
               
                </table>
            </div>

        </div>
    </div>
</section>
@endsection