<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    public function registrationFormFetchEmployeeIdExistense(Request $request)
    {
        $employee = Employee::where('employee_id', $request->employee_id)->first();

        if ($employee == null) {
            return response()->json(['status' => 'Not Found']);

        }


        $employeeInfo = [];

        $employeeInfo[] = [
            'employeeFullName' => $employee->firstname . ' ' . $employee->middlename . ' ' . $employee->lastname,
            'employeeId' => $employee->employee_id,
            'employeeSex' => $employee->sex,
        ];

        return response()->json($employeeInfo);



    }

    public function registerNewEmployeeUser(Request $request)
    {
        $employee = Employee::where('employee_id', $request->registerEmployeeId)->first();
        if ($employee->user) {
            return redirect()->back()->with('error', 'Employee User Account Already Exists');
        }
        if ($request->registerEmployeePassword == $request->registerEmployeeRePass) {

            $user = new User;
            $user->employee_id = $employee->id;
            $user->email = $request->registerEmployeeEmail;
            $user->password = $request->registerEmployeePassword;
            $user->save();
            $userId = $user->id;

            $userRole = new UserRole;
            $userRole->user_id = $userId;
            $userRole->role_id = 7;
            $userRole->save();

            return redirect()->route('registrationSuccessPage');
        } else {
            return redirect()->back()->with('error', 'Password does not match');
        }


    }

    public function landingPageInteractiveMap()
    {
        return view('landing_page_interactive_map');
    }
}
