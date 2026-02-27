<?php

namespace App\Http\Controllers;

use App\Models\AySemester;
use App\Models\BoardingHouse;
use App\Models\Dormitory;
use App\Models\DormitoryImage;
use App\Models\DormitoryRoomTenant;
use App\Models\BoardingHouseImage;
use App\Models\DormManager;
use App\Models\Employee;
use App\Models\EmployeeBhApplication;
use App\Models\StudentClearance;
use App\Models\StudentTenant;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OsaController extends Controller
{


    public function osaDashboard()
    {
        $students = StudentTenant::all();
        $dormitories = Dormitory::all();
        return view('osa.osa_dashboard', compact('students', 'dormitories'));
    }

    public function osaDormitories(Request $request)
    {
        return view("osa.osa_dormitories");
    }

    public function osaFetchDormitories(Request $request)
    {
        $dormitories = Dormitory::all();

        $dormitoryInfo = [];


        foreach ($dormitories as $dormitory) {
            $dormSex = "";
            if ($dormitory->sex_accepted == 1) {
                $dormSex = "Male";
            } else if ($dormitory->sex_accepted == 0) {
                $dormSex = "Female";
            } else {
                $dormSex = "Co-ed";
            }

            $totalNumberOfBedsCount = 0; // Initialize total beds count for this boarding house
            $totalTenantsCount = 0; // Initialize total beds count for this boarding house

            foreach ($dormitory->dormitoryRooms as $room) {
                $totalNumberOfBedsCount += $room->number_of_beds; // Accumulate the number of beds in each room
                $totalTenantsCount += $room->dormRoomStudentTenants->where('isActive', 1)->count();
            }

            $dormitoryInfo[] = [
                'id' => $dormitory->id,
                'dormitoryName' => $dormitory->dormitory_name,
                'dormSexAccepted' => $dormSex,
                'dormManagerFullName' => $dormitory->dormManager->employee->firstname . ' ' . $dormitory->dormManager->employee->middlename . ' ' . $dormitory->dormManager->employee->lastname,
                'vacancy' => $totalTenantsCount . ' / ' . $totalNumberOfBedsCount,
            ];
        }
        return response()->json($dormitoryInfo);
    }

    public function osaFetchBoadingHouses(Request $request)
    {
        $searchQuery = $request->input('search_query');
        $sexFilter = $request->input('sex_filter');
        $housingTypeFilter = $request->input('housing_type_filter');


        $boardingHousesQuery = BoardingHouse::query();

        if ($searchQuery) {
            $boardingHousesQuery->where('boarding_house_name', 'like', '%' . $searchQuery . '%');
        }

        if ($sexFilter) {
            $boardingHousesQuery->where('sex_accepted', $sexFilter === 'Male' ? 1 : 0);
        }

        if ($housingTypeFilter) {
            $boardingHousesQuery->where('lodging_type', $housingTypeFilter);
        }


        $boardingHouses = $boardingHousesQuery->get();

        $boardingHouseInfo = [];

        foreach ($boardingHouses as $boardingHouse) {
            if ($boardingHouse->sex_accepted == 1) {
                $bhSex = 'Male';
            } else if ($boardingHouse->sex_accepted == 0) {
                $bhSex = 'Female';
            } else {
                $bhSex = '';
            }


            if ($boardingHouse->operator->employee->sex == 1) {
                $opSex = 'Male';
            } else if ($boardingHouse->operator->employee->sex == 0) {
                $opSex = 'Female';
            } else {
                $opSex = '';
            }

            $lodgingType = '';
            if ($boardingHouse->lodging_type == 1) {
                $lodgingType = 'Bed Spacer';
            } else if ($boardingHouse->lodging_type == 2) {
                $lodgingType = 'Pad';
            } else {
                $lodgingType = '';
            }



            $totalNumberOfBedsCount = 0; // Initialize total beds count for this boarding house
            $totalTenantsCount = 0; // Initialize total beds count for this boarding house

            foreach ($boardingHouse->boardingHouseRooms as $room) {
                $totalNumberOfBedsCount += $room->number_of_beds; // Accumulate the number of beds in each room
                $totalTenantsCount += $room->roomStudentTenants->count(); // Accumulate the number of beds in each room
            }

            $boardingHouseInfo[] = [
                'bhId' => $boardingHouse->id,
                'bhName' => $boardingHouse->boarding_house_name,
                'bhType' => $lodgingType,
                'bhSexAccepted' => $bhSex,
                'bhLat' => $boardingHouse->latitude,
                'bhLng' => $boardingHouse->longitude,
                'bhBedCount' => $totalNumberOfBedsCount,
                'bhTenantCount' => $totalTenantsCount,


                'operatorId' => $boardingHouse->operator->id,
                'operatorFname' => $boardingHouse->operator->employee->firstname,
                'operatorMname' => $boardingHouse->operator->employee->middlename,
                'operatorLname' => $boardingHouse->operator->employee->lastname,
                'operatorXname' => $boardingHouse->operator->employee->extname,
                'operatorSex' => $opSex,
                'operatorContact' => $boardingHouse->operator->employee->contact_no,
                'operatorFullname' => $boardingHouse->operator->employee->firstname . ' ' . $boardingHouse->operator->employee->middlename . ' ' . $boardingHouse->operator->employee->lastname,
            ];
        }

        return response()->json($boardingHouseInfo);
    }

    public function osaFetchDormitoriesMap(Request $request)
    {
        $searchQuery = $request->input('search_query');
        $sexFilter = $request->input('sex_filter');

        $dormitoryQuery = Dormitory::query();

        if ($searchQuery) {
            $dormitoryQuery->where('dormitory_name', 'like', '%' . $searchQuery . '%');
        }

        if ($sexFilter) {
            $dormitoryQuery->where('sex_accepted', $sexFilter === 'Male' ? 1 : 0);
        }


        $dormitories = $dormitoryQuery->get();

        $dormitoryInfo = [];


        foreach ($dormitories as $dormitory) {
            if ($dormitory->sex_accepted == 1) {
                $dormSex = 'Male';
            } else if ($dormitory->sex_accepted == 0) {
                $dormSex = 'Female';
            } else if ($dormitory->sex_accepted == 2) {
                $dormSex = 'CoEd';
            } else {
                $dormSex = '';
            }


            if ($dormitory->dormManager->employee->sex == 1) {
                $dmSex = 'Male';
            } else if ($dormitory->dormManager->employee->sex == 0) {
                $dmSex = 'Female';
            } else {
                $dmSex = '';
            }



            $totalNumberOfBedsCount = 0; // Initialize total beds count for this boarding house
            $totalTenantsCount = 0; // Initialize total beds count for this boarding house

            foreach ($dormitory->dormitoryRooms as $room) {
                $totalNumberOfBedsCount += $room->number_of_beds; // Accumulate the number of beds in each room
                $totalTenantsCount += $room->dormRoomStudentTenants->count(); // Accumulate the number of beds in each room
            }

            $dormitoryInfo[] = [
                'dormId' => $dormitory->id,
                'dormName' => $dormitory->dormitory_name,
                'dormSexAccepted' => $dormSex,
                'dormLat' => $dormitory->latitude,
                'dormLng' => $dormitory->longitude,
                'dormBedCount' => $totalNumberOfBedsCount,
                'dormTenantCount' => $totalTenantsCount,


                'dmId' => $dormitory->dormManager->id,
                'dmFname' => $dormitory->dormManager->employee->firstname,
                'dmMname' => $dormitory->dormManager->employee->middlename,
                'dmLname' => $dormitory->dormManager->employee->lastname,
                'dmXname' => $dormitory->dormManager->employee->extname,
                'dmSex' => $dmSex,
                'dmContact' => $dormitory->dormManager->employee->contact_no,
                'dmFullname' => $dormitory->dormManager->employee->firstname . ' ' . $dormitory->dormManager->employee->middlename . ' ' . $dormitory->dormManager->employee->lastname,
            ];
        }

        return response()->json($dormitoryInfo);
    }

    public function osaDormitoryDetails($id)
    {
        $dormitory = Dormitory::find($id);

        $tenants = DormitoryRoomTenant::whereHas('dormRoom', function ($query) use ($id) {
            $query->where('dormitory_id', $id);
        })->with('studentTenant')->where('isActive', 1)->get();

        return view('osa.osa_dormitory_details', compact('dormitory', 'tenants'));
    }



    public function osaStudents()
    {

        $semesters = AySemester::orderBy("created_at", "desc")->get();
        $currentSemester = null;
        $closestDateDiff = PHP_INT_MAX;
        $currentDate = now();

        foreach ($semesters as $semester) {
            $updatedAt = $semester->updated_at;

            // Calculate the difference in days between current date and updated_at of the semester
            $dateDiff = $currentDate->diffInDays($updatedAt);

            // Check if this semester's updated_at is closer to the current date
            if ($dateDiff < $closestDateDiff) {
                $closestDateDiff = $dateDiff;
                $currentSemester = $semester;
            }
        }
        return view("osa.osa_students", compact('currentSemester', 'semesters'));
    }
    public function osaFetchStudentMasterList(Request $request)
    {
        $students = StudentTenant::all();
        $studentInfo = [];

        $semester = $request->semester_id;

        foreach ($students as $student) {
            $studentInfoClearances = [];
            foreach ($student->clearances->where('ay_semester_id', $semester) as $clearance) {
                if ($clearance->clearance_status == 0) {
                    $status = 'Uncleared';
                } else if ($clearance->clearance_status == 1) {
                    $status = 'Cleared';
                } else if ($clearance->clearance_status == null) {
                    $status = 'Pending';
                }
                $studentInfoClearances[] = [
                    'id' => $clearance->id,
                    'semester' => $clearance->semester->description,
                    'clearanceStatus' => $status
                ];
            }
            $studentInfo[] = [
                'id' => $student->id,
                'studentId' => $student->student_id,
                'studentFullName' => $student->firstname . ' ' . $student->middlename . ' ' . $student->lastname,
                'studentCollege' => $student->program->college->college_name,
                'studentCourse' => $student->program->program_name,
                'clearanceStatus' => $studentInfoClearances,
            ];

        }

        return response()->json($studentInfo);
    }

    public function osaStudentProfile($id)
    {
        $semesters = AySemester::all();
        $student = StudentTenant::find($id);

        return view('osa.osa_student_profile', compact('student', 'semesters'));
    }

    public function osaInteractiveMap()
    {

        $boardingHouseInfo = BoardingHouse::all();

        $boardingHouses = [];

        foreach ($boardingHouseInfo as $bh) {
            $sexAccepted = '';
            if ($bh->sex_accepted == '0') {
                $sexAccepted = 'Female';
            } else if ($bh->sex_accepted == '1') {
                $sexAccepted = 'Male';
            } else {
                $sexAccepted = '';
            }

            $opSex = '';
            if ($bh->operator->employee->sex == '0') {
                $opSex = 'Female';
            } else if ($bh->operator->employee->sex == '1') {
                $opSex = 'Male';
            } else {
                $opSex = '';
            }

            

            $totalNumberOfBedsCount = 0; // Initialize total beds count for this boarding house
            $totalTenantsCount = 0; // Initialize total beds count for this boarding house

            foreach ($bh->boardingHouseRooms as $room) {
                $totalNumberOfBedsCount += $room->number_of_beds; // Accumulate the number of beds in each room
                $totalTenantsCount += $room->roomStudentTenants->count(); // Accumulate the number of beds in each room
            }

            $boardingHouses[] = [
                'bhId' => $bh->id,
                'bhName' => $bh->boarding_house_name,
                'bhType' => $bh->lodging_type,
                'bhSexAccepted' => $sexAccepted,
                'bhLat' => $bh->latitude,
                'bhLng' => $bh->longitude,
                'bhBedCount' => $totalNumberOfBedsCount,
                'bhTenantCount' => $totalTenantsCount,

                'opId' => $bh->operator->id,
                'opFullname' => $bh->operator->employee->firstname . ' ' . $bh->operator->employee->middlename . ' ' . $bh->operator->employee->lastname,
                'opFirstname' => $bh->operator->employee->firstname,
                'opMiddlename' => $bh->operator->employee->middlename,
                'opLastname' => $bh->operator->employee->lastname,
                'opExtname' => $bh->operator->employee->extname,
                'opSex' => $opSex,
                'opContactNo' => $bh->operator->employee->contact_no,
            ];
        }
        $dormitoryInfo = Dormitory::all();

        $dormitories = [];

        foreach ($dormitories as $dormitory) {
            if ($dormitory->sex_accepted == 1) {
                $dormSex = 'Male';
            } else if ($dormitory->sex_accepted == 0) {
                $dormSex = 'Female';
            } else if ($dormitory->sex_accepted == 2) {
                $dormSex = 'CoEd';
            } else {
                $dormSex = '';
            }


            if ($dormitory->dormManager->employee->sex == 1) {
                $dmSex = 'Male';
            } else if ($dormitory->dormManager->employee->sex == 0) {
                $dmSex = 'Female';
            } else {
                $dmSex = '';
            }



            $totalNumberOfBedsCount = 0; // Initialize total beds count for this boarding house
            $totalTenantsCount = 0; // Initialize total beds count for this boarding house

            foreach ($dormitory->dormitoryRooms as $room) {
                $totalNumberOfBedsCount += $room->number_of_beds; // Accumulate the number of beds in each room
                $totalTenantsCount += $room->dormRoomStudentTenants->count(); // Accumulate the number of beds in each room
            }

            $dormitoryInfo[] = [
                'dormId' => $dormitory->id,
                'dormName' => $dormitory->dormitory_name,
                'dormSexAccepted' => $dormSex,
                'dormLat' => $dormitory->latitude,
                'dormLng' => $dormitory->longitude,
                'dormBedCount' => $totalNumberOfBedsCount,
                'dormTenantCount' => $totalTenantsCount,


                'dmId' => $dormitory->dormManager->id,
                'dmFname' => $dormitory->dormManager->employee->firstname,
                'dmMname' => $dormitory->dormManager->employee->middlename,
                'dmLname' => $dormitory->dormManager->employee->lastname,
                'dmXname' => $dormitory->dormManager->employee->extname,
                'dmSex' => $dmSex,
                'dmContact' => $dormitory->dormManager->employee->contact_no,
                'dmFullname' => $dormitory->dormManager->employee->firstname . ' ' . $dormitory->dormManager->employee->middlename . ' ' . $dormitory->dormManager->employee->lastname,
            ];
        }
        return view('osa.osa_interactive_map', compact("dormitories", "boardingHouses"));
    }


    public function osaRegisterNewDormitory()
    {
        return view('osa.osa_register_new_dormitory_page');
    }

    public function osaFetchEmployeeIdForRegistration(Request $request)
    {
        $employeeId = $request->employee_id;

        $employee = Employee::where('employee_id', $employeeId)->first();

        if ($employee == null) {
            return response()->json(['status' => 'Not Found']);
        } else {
            $employeeInfo = [];

            if ($employee->sex == 0) {
                $sex = 'Female';
            } else if ($employee->sex == 1) {
                $sex = 'Male';
            } else {
                $sex = '';
            }
            $employeeInfo[] = [

                'id' => $employee->id,
                'empId' => $employee->employee_id,
                'employeeFullName' => $employee->firstname . ' ' . $employee->middlename . ' ' . $employee->lastname,
                'sex' => $sex,
                'contactNo' => $employee->contact_no,
            ];

            return response()->json($employeeInfo);
        }

    }

    public function osaDormRegistrationForm(Request $request)
    {

        $employee = Employee::where('employee_id', $request->registerEmployeeIdVerification)->first();

        if ($employee->dormManager != null) {
            return redirect()->route("osaDormitories")->with('error', 'Employee ' . $employee->employee_id . ' already assigned to another dormitory.');
        }

        if ($request->osaRegisterNewDormPass != $request->osaRegisterNewDormRePass) {
            return redirect()->back()->with('error', 'Passwords do not match.');
        }

        $user = new User;
        $user->employee_id = $request->assignEmployeeId;
        $user->email = $request->osaRegisterNewDormEmail;
        $user->password = Hash::make($request->osaRegisterNewDormPass);
        $user->save();
        $userId = $user->id;

        $userRole = new UserRole;
        $userRole->user_id = $userId;
        $userRole->role_id = 3;
        $userRole->save();

        $dormitory = new Dormitory;
        $dormitory->dormitory_name = $request->osaRegisterNewDormName;
        $dormitory->sex_accepted = $request->osaRegisterNewDormGender;
        $dormitory->longitude = $request->registerDormLng;
        $dormitory->latitude = $request->registerDormLat;
        $dormitory->save();

        $dormitoryId = $dormitory->id;

        $dormManager = new DormManager;
        $dormManager->employee_id = $request->assignEmployeeId;
        $dormManager->dormitory_id = $dormitoryId;
        $dormManager->save();

        return redirect()->route("osaDormitories")->with('success', 'Dormitory and Dormitory Manager successfully registered');


    }

    public function osaSubmitUpdateTenantClearanceStatus(Request $request)
    {

        $studentClearance = new StudentClearance;
        $studentClearance->student_tenant_id = $request->osaUpdateStudentClearanceStatusId;
        $studentClearance->ay_semester_id = $request->osaUpdateStudentClearanceStatusSemester;
        $studentClearance->clearance_status = $request->osaUpdateStudentClearanceStatus;
        $studentClearance->save();

        return redirect()->back()->with('success', 'Student clearance successfully updated!');
    }

    public function osaReporting()
    {
        // $actAttachmentsPending = ActAttachment::where('status', 0)->get();
        // $actAttachmentsInProgress = ActAttachment::where('status', 1)->where('isSeen', 0)->get();
        // $inProgress = ActAttachment::where('status', 1)->get();

        // $acadYears = AcadYear::all();

        // $semesters = AySemester::orderBy("created_at", "desc")->get();

        // $currentSemester = null;
        // $closestDateDiff = PHP_INT_MAX;
        // $currentDate = now();

        // foreach ($semesters as $semester) {
        //     $updatedAt = $semester->updated_at;

        //     // Calculate the difference in days between current date and updated_at of the semester
        //     $dateDiff = $currentDate->diffInDays($updatedAt);

        //     // Check if this semester's updated_at is closer to the current date
        //     if ($dateDiff < $closestDateDiff) {
        //         $closestDateDiff = $dateDiff;
        //         $currentSemester = $semester;
        //     }
        // }

        // $currentAcadYear = null;

        // foreach ($acadYears as $acadYear) {
        //     if ($currentDate->between($acadYear->date_start, $acadYear->date_end)) {
        //         $currentAcadYear = $acadYear;
        //         break; // No need to continue looping once found
        //     }
        // }

        // $studentOrganizations = StudentOrganization::all();
        // $activities = Activity::all();
        return view('osa.osa_reporting');
        // compact('actAttachmentsPending', 'actAttachmentsInProgress', 'inProgress', 'studentOrganizations', 'activities', 'currentSemester', 'semesters', 'currentAcadYear', 'acadYears')
    }

    public function osaProfilePage($id)
    {
        $osaPersonnel = Employee::find($id);
        return view('osa.osa_profile_page', compact('osaPersonnel'));
    }

    public function osaNewInteractiveMap()
    {
        $pendingRegistrationReqs = EmployeeBhApplication::where('status', 0)->where('isSeen', 0)->get();
        return view('osa.osa_new_interactive_map', compact('pendingRegistrationReqs'));
    }

    public function osaFetchBoardingHouseForInteractiveMap()
    {
        $boardingHouses = BoardingHouse::all();

        $boardingHouseCoordinates = [];

        foreach ($boardingHouses as $boardingHouse) {

            $tenantCount = 0;
            $bedCount = 0;

            foreach ($boardingHouse->boardingHouseRooms as $room) {
                $tenantCount += $room->roomStudentTenants->where('isActive', 1)->count();
                $bedCount += $room->number_of_beds;
            }

            $bhPhotos = [];

            foreach ($boardingHouse->bhPhotos as $photo) {
                $bhPhotos[] = [
                    'id' => $photo->id,
                    'filePath' => $photo->file_path,
                ];
            }

            $boardingHouseCoordinates[] = [
                'id' => $boardingHouse->id,

                'bhOperatorFullName' => $boardingHouse->operator->employee->firstname . ' ' . $boardingHouse->operator->employee->middlename . ' ' . $boardingHouse->operator->employee->lastname,
                'bhOperatorSex' => $boardingHouse->operator->employee->sex,
                'bhOperatorContact' => $boardingHouse->operator->employee->contact_no,
                'boardingHouseName' => $boardingHouse->boarding_house_name,
                'boardingHouseSex' => $boardingHouse->sex_accepted,
                'boardingHouseClass' => $boardingHouse->classification,
                'boardingHouseType' => $boardingHouse->lodging_type,
                'bhTenantCount' => $tenantCount,
                'bhBedCount' => $bedCount,
                'bhPhotos' => $bhPhotos,
                'latitude' => $boardingHouse->latitude,
                'longitude' => $boardingHouse->longitude,
            ];
        }

        return response()->json($boardingHouseCoordinates);
    }

    public function osaFetchDormitoriesForInteractiveMap()
    {
        $dormitories = Dormitory::all();

        $dormitoryCoordinates = [];

        foreach ($dormitories as $dormitory) {

            $tenantCount = 0;
            $bedCount = 0;

            foreach ($dormitory->dormitoryRooms as $room) {
                $tenantCount += $room->dormRoomStudentTenants->where('isActive', 1)->count();
                $bedCount += $room->number_of_beds;
            }

            $dormPhotos = [];

            foreach ($dormitory->dormPhotos as $photo) {
                $dormPhotos[] = [
                    'id' => $photo->id,
                    'filePath' => $photo->file_path,
                ];
            }
            $dormitoryCoordinates[] = [
                'id' => $dormitory->id,
                'dormManagerFullName' => $dormitory->dormManager->employee->firstname . ' ' . $dormitory->dormManager->employee->middlename . ' ' . $dormitory->dormManager->employee->lastname,
                'dormManagerSex' => $dormitory->dormManager->employee->sex,
                'dormManagerContact' => $dormitory->dormManager->employee->contact_no,
                'dormitoryName' => $dormitory->dormitory_name,
                'dormitorySex' => $dormitory->sex_accepted,
                'dormTenantCount' => $tenantCount,
                'dormBedCount' => $bedCount,
                'dormPhotos' => $dormPhotos,
                'latitude' => $dormitory->latitude,
                'longitude' => $dormitory->longitude,
            ];
        }

        return response()->json($dormitoryCoordinates);
    }

    public function osaFetchBoardingHousePhotos(Request $request)
    {
        $bhPhotos = BoardingHouseImage::where('boarding_house_id', $request->bh_id)->get();

        $photos = [];

        foreach ($bhPhotos as $photo) {
            $photos[] = [
                'id' => $photo->id,
                'filePath' => $photo->file_path,
            ];
        }

        return response()->json($photos);
    }

    public function osaFetchDormitoryPhotos(Request $request)
    {
        $dormPhotos = DormitoryImage::where('dormitory_id', $request->dorm_id)->get();

        $photos = [];

        foreach ($dormPhotos as $photo) {
            $photos[] = [
                'id' => $photo->id,
                'filePath' => $photo->file_path,
            ];
        }
        return response()->json($photos);
    }
}
