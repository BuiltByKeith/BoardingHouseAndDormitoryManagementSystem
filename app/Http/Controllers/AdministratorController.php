<?php
Namespace App\Http\Controllers;

use App\Models\BoardingHouse;
use App\Models\OperatorStudentTenant;
use Illuminate\Http\Request;

class AdministratorController extends Controller{
    public function adminDashboard()
    {
        return view("administrator.admin_dashboard");
    }

    public function adminEmployees()
    {
        return view("administrator.admin_employees");
    }

    public function adminAcademicYear()
    {
        return view("administrator.admin_academic_year");
    }
    public function adminAcademicSemester()
    {
        return view("administrator.admin_academic_semester");
    }

    public function adminStudents()
    {
        return view("administrator.admin_students");
    }

    public function adminUsers()
    {
        return view("administrator.admin_users");
    }



}

?>