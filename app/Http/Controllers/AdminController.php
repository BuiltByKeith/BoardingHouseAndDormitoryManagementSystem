<?php

namespace App\Http\Controllers;

use App\Models\AcadYear;
use App\Models\AySemester;
use App\Models\Employee;
use App\Models\StudentTenant;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //

    public function adminDashboard()
    {

        $employees = Employee::all();
        $students = StudentTenant::all();
        $users = User::all();
        return view('admin.admin_dashboard', compact('employees', 'students', 'users'));
    }

    public function adminEmployeesList()
    {
        return view('admin.admin_employees_list');
    }

    public function adminAddNewEmployee(Request $request)
    {
        $newEmployee = new Employee;

        $newEmployee->employee_id = $request->adminAddEmployeeId;
        $newEmployee->firstname = $request->adminAddEmployeeFirstname;
        $newEmployee->middlename = $request->adminAddEmployeeMiddlename;
        $newEmployee->lastname = $request->adminAddEmployeeLastname;
        $newEmployee->extname = $request->adminAddEmployeeExtname;
        $newEmployee->sex = $request->adminAddEmployeeSex;
        $newEmployee->contact_no = $request->adminAddEmployeeContactNo;
        $newEmployee->save();

        return redirect()->back()->with('success', 'Successfully added a new employee!');
    }

    public function adminFetchEmployeesList(Request $request)
    {
        $employees = Employee::all();

        $employeeDetails = [];

        foreach ($employees as $employee) {
            if ($employee->sex == 0) {
                $sex = 'Female';
            } else if ($employee->sex == 1) {
                $sex = 'Male';
            } else {
                $sex = '';
            }
            $employeeDetails[] = [
                'id' => $employee->id,
                'employeeId' => $employee->employee_id,
                'employeeFullName' => $employee->firstname . ' ' . $employee->middlename . ' ' . $employee->lastname,
                'employeeSex' => $sex,
                'employeeContactNo' => $employee->contact_no,
            ];
        }
        return response()->json($employeeDetails);
    }
    public function adminStudentsList()
    {
        $studentTenants = StudentTenant::all();
        return view('admin.admin_students_list', compact('studentTenants'));
    }

    public function adminUsersList()
    {
        $users = User::all();
        return view('admin.admin_users_list', compact('users'));
    }

    public function adminSemestersList()
    {
        $semesters = AySemester::orderByDesc('created_at')->get();
        $acadYears = AcadYear::orderByDesc('created_at')->get();

        return view('admin.admin_semesters_list', compact('semesters', 'acadYears'));
    }

    public function adminAddNewSemester(Request $request)
    {

        $newSemester = new AySemester;
        $newSemester->description = $request->adminAddNewAcadYearDesciption;
        $newSemester->acad_year_id = $request->adminAddNewSemesterAcadYearId;
        $newSemester->save();

        return redirect()->back()->with('success', 'Successfully added new Semester!');
    }

    public function adminAcadYearsList()
    {
        $acadYears = AcadYear::orderByDesc('created_at')->get();

        return view('admin.admin_academic_years_list', compact('acadYears'));
    }

    public function adminAddNewAcademicYear(Request $request)
    {

        $newAcadYear = new AcadYear;

        $newAcadYear->description = $request->adminAddNewAcadYearDesciption;
        $newAcadYear->save();

        return redirect()->back()->with('success', 'Successfully added new Academic Year!');
    }

}
