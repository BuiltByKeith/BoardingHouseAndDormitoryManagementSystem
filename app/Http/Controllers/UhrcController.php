<?php

namespace App\Http\Controllers;

use App\Models\AySemester;
use App\Models\BoardingHouse;
use App\Models\BoardingHouseRoomTenants;
use App\Models\BoardingHouseImage;
use App\Models\Dormitory;
use App\Models\DormitoryImage;
use App\Models\Employee;
use App\Models\EmployeeBhApplication;
use App\Models\Operator;
use App\Models\OperatorStudentTenant;
use App\Models\UserRole;
use Illuminate\Http\Request;

class UhrcController extends Controller
{
    //

    public function uhrcDashboard()
    {
        $pendingRegistrationReqs = EmployeeBhApplication::where('status', 0)->where('isSeen', 0)->get();

        $boardingHouse = BoardingHouse::all();
        $dormitories = Dormitory::all();
        $dormitoryQuery = Dormitory::query();
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

        return view("uhrc.uhrc_dashboard", compact("boardingHouse", 'dormitories', 'pendingRegistrationReqs'));
    }

    public function uhrcBoardingHousesList()
    {
        $pendingRegistrationReqs = EmployeeBhApplication::where('status', 0)->where('isSeen', 0)->get();

        return view("uhrc.uhrc_boarding_houses_list", compact('pendingRegistrationReqs'));
    }


    public function uhrcFetchBoardingHouses(Request $request)
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

            $bhPhotos = [];

            foreach ($boardingHouse->bhPhotos as $photo) {
                $bhPhotos[] = [
                    'id' => $photo->id,
                    'filePath' => $photo->file_path,
                ];

            }
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
                $totalTenantsCount += $room->roomStudentTenants->where('isActive', 1)->count(); // Accumulate the number of beds in each room
            }

            $boardingHouseInfo[] = [
                'bhId' => $boardingHouse->id,
                'bhName' => $boardingHouse->boarding_house_name,
                'bhType' => $lodgingType,
                'bhSexAccepted' => $bhSex,
                'bhClass' => $boardingHouse->classification,
                'bhLat' => $boardingHouse->latitude,
                'bhLng' => $boardingHouse->longitude,
                'bhBedCount' => $totalNumberOfBedsCount,
                'bhTenantCount' => $totalTenantsCount,

                'bhPhotos' => $bhPhotos,


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

    public function uhrcFetchBoardingHouseTenants(Request $request)
    {
        $boardingHouseId = $request->input('bh_id');

        // Retrieve all rooms of the boarding house with their tenants
        $tenants = BoardingHouseRoomTenants::whereHas('boardingHouseRoom', function ($query) use ($boardingHouseId) {
            $query->where('boarding_house_id', $boardingHouseId);
        })->with('studentTenant')->where('isActive', 1)->get();

        $tenantInfo = [];

        foreach ($tenants as $tenant) {
            $tenantInfo[] = [
                'id' => $tenant->id,
                'fullName' => $tenant->studentTenant->firstname . ' ' . $tenant->studentTenant->middlename . ' ' . $tenant->studentTenant->lastname,
                'studentId' => $tenant->studentTenant->student_id,
                'program' => $tenant->studentTenant->program->program_name,
                'college' => $tenant->studentTenant->program->college->college_name,
            ];
        }

        return response()->json($tenantInfo);
    }

    public function uhrcBoardingHouseDetails($id)
    {

        $pendingRegistrationReqs = EmployeeBhApplication::where('status', 0)->where('isSeen', 0)->get();
        $boardingHouseInfo = BoardingHouse::find($id);

        $tenants = BoardingHouseRoomTenants::whereHas('boardingHouseRoom', function ($query) use ($id) {
            $query->where('boarding_house_id', $id);
        })->with('studentTenant')->where('isActive', 1)->get();

        return view('uhrc.uhrc_boarding_house_details', compact('boardingHouseInfo', 'tenants', 'pendingRegistrationReqs'));
    }

    public function uhrcDormitoriesList()
    {
        $pendingRegistrationReqs = EmployeeBhApplication::where('status', 0)->where('isSeen', 0)->get();
        return view("uhrc.uhrc_dormitories_list", compact('pendingRegistrationReqs'));
    }

    public function uhrcInteractiveMap()
    {
        $pendingRegistrationReqs = EmployeeBhApplication::where('status', 0)->where('isSeen', 0)->get();
        $boardingHouseInfo = BoardingHouse::all();
        $dormitoryInfo = Dormitory::all();

        $boardingHouses = [];
        $dormitories = [];

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
        // Process dormitory data
        foreach ($dormitoryInfo as $dormitory) {
            $dormSex = '';
            if ($dormitory->sex_accepted == 1) {
                $dormSex = 'Male';
            } else if ($dormitory->sex_accepted == 0) {
                $dormSex = 'Female';
            } else if ($dormitory->sex_accepted == 2) {
                $dormSex = 'CoEd';
            } else {
                $dormSex = '';
            }

            $dmSex = '';
            if ($dormitory->dormManager->employee->sex == 1) {
                $dmSex = 'Male';
            } else if ($dormitory->dormManager->employee->sex == 0) {
                $dmSex = 'Female';
            } else {
                $dmSex = '';
            }

            $totalNumberOfBedsCount = 0;
            $totalTenantsCount = 0;

            foreach ($dormitory->dormitoryRooms as $room) {
                $totalNumberOfBedsCount += $room->number_of_beds; // Accumulate the number of beds in each room
                $totalTenantsCount += $room->dormRoomStudentTenants->count(); // Accumulate the number of beds in each room
            }


            $dormitories[] = [
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
        return view("uhrc.uhrc_interactive_map", compact("boardingHouses", 'dormitories', 'pendingRegistrationReqs'));
    }

    public function uhrcNewInteractiveMap()
    {
        $pendingRegistrationReqs = EmployeeBhApplication::where('status', 0)->where('isSeen', 0)->get();
        return view('uhrc.uhrc_new_interactive_map', compact('pendingRegistrationReqs'));
    }

    public function uhrcFetchDormitories(Request $request)
    {
        $searchQuery = $request->input('search_query');
        $sexFilter = $request->input('sex_filter');
        $housingTypeFilter = $request->input('housing_type_filter');

        $dormitoryQuery = Dormitory::query();

        if ($searchQuery) {
            $dormitoryQuery->where('dormitory_name', 'like', '%' . $searchQuery . '%');
        }

        if ($sexFilter) {
            $dormitoryQuery->where('sex_accepted', $sexFilter === 'Male' ? 1 : 0);
        }

        if ($housingTypeFilter) {
            $dormitoryQuery->where('lodging_type', $housingTypeFilter);
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
                $totalTenantsCount += $room->dormRoomStudentTenants->where('isActive', 1)->count(); // Accumulate the number of beds in each room
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

    public function uhrcDormitoryDetails($id)
    {
        $pendingRegistrationReqs = EmployeeBhApplication::where('status', 0)->where('isSeen', 0)->get();
        $dormitory = Dormitory::find($id);
        return view('uhrc.uhrc_dormitory_details', compact('pendingRegistrationReqs', 'dormitory'));
    }


    public function uhrcPendingRegistrationRequests()
    {
        $pendingRegistrationReqs = EmployeeBhApplication::where('status', 0)->where('isSeen', 0)->get();

        return view('uhrc.uhrc_pending_registration_requests', compact('pendingRegistrationReqs'));
    }
    public function uhrcFetchPendingRegistrationRequests(Request $request)
    {
        $registrationRequests = EmployeeBhApplication::where('status', 0)->orderBy('created_at', 'desc')->get();

        $regReqDesc = [];

        foreach ($registrationRequests as $request) {
            $regReqDesc[] = [
                'id' => $request->id,
                'employeeId' => $request->employee->employee_id,
                'employeeFullName' => $request->employee->firstname . ' ' . $request->employee->middlename . ' ' . $request->employee->lastname,
                'request' => 'Boarding House Registration',
                'dateRequested' => $request->created_at->format('F d, Y'),
            ];
        }

        return response()->json($regReqDesc);
    }

    public function uhrcApprovedRegistrationRequests()
    {
        $pendingRegistrationReqs = EmployeeBhApplication::where('status', 0)->where('isSeen', 0)->get();

        return view('uhrc.uhrc_approved_registration_requests', compact('pendingRegistrationReqs'));
    }
    public function uhrcFetchApprovedRegistrationRequests(Request $request)
    {
        $registrationRequests = EmployeeBhApplication::where('status', 1)->orderBy('created_at', 'desc')->get();

        $regReqDesc = [];

        foreach ($registrationRequests as $request) {
            $regReqDesc[] = [
                'id' => $request->id,
                'employeeId' => $request->employee->employee_id,
                'employeeFullName' => $request->employee->firstname . ' ' . $request->employee->middlename . ' ' . $request->employee->lastname,
                'request' => 'Boarding House Registration',
                'dateRequested' => $request->created_at->format('F d, Y'),
            ];
        }

        return response()->json($regReqDesc);
    }


    public function uhrcRejectedRegistrationRequests()
    {
        $pendingRegistrationReqs = EmployeeBhApplication::where('status', 0)->where('isSeen', 0)->get();

        return view('uhrc.uhrc_rejected_registration_requests', compact('pendingRegistrationReqs'));
    }
    public function uhrcFetchRejectedRegistrationRequests(Request $request)
    {
        $registrationRequests = EmployeeBhApplication::where('status', 2)->orderBy('created_at', 'desc')->get();

        $regReqDesc = [];

        foreach ($registrationRequests as $request) {
            $regReqDesc[] = [
                'id' => $request->id,
                'employeeId' => $request->employee->employee_id,
                'employeeFullName' => $request->employee->firstname . ' ' . $request->employee->middlename . ' ' . $request->employee->lastname,
                'request' => 'Boarding House Registration',
                'dateRequested' => $request->created_at->format('F d, Y'),
            ];
        }

        return response()->json($regReqDesc);
    }


    public function uhrcRegistratoionRequestDetails($id)
    {
        $pendingRegistrationReqs = EmployeeBhApplication::where('status', 0)->where('isSeen', 0)->get();

        $registrationReqDetails = EmployeeBhApplication::find($id);

        return view('uhrc.uhrc_registration_request_details', compact('registrationReqDetails', 'pendingRegistrationReqs'));
    }

    public function uhrcUpdateEmployeeRegistrationRequest(Request $request)
    {

        $regReqStatus = EmployeeBhApplication::find($request->approveRegistrationAppId);
        $employee = Employee::find($request->approveRegistrationEmpId);
        $userId = $employee->user->id;

        if ($request->updateRegistrationRequestStatusSelect == 0) {

            $regReqStatus->update([
                'status' => 0,
                'isSeen' => 1,
            ]);

            return redirect()->back()->with('success', 'Registration successfully updated to pending.');
        } else if ($request->updateRegistrationRequestStatusSelect == 1) {
            $regReqStatus->update([
                'status' => 1,
                'isSeen' => 1,
            ]);

            $boardingHouse = new BoardingHouse;
            $boardingHouse->boarding_house_name = $request->approveRegistrationBhName;
            $boardingHouse->lodging_type = $request->approveRegistrationBhType;
            $boardingHouse->sex_accepted = $request->approveRegistrationBhSex;
            $boardingHouse->classification = $request->approveRegistrationBhClass;
            $boardingHouse->complete_address = $request->approveRegistrationBhAddress;
            $boardingHouse->latitude = $request->approveRegistrationBhLat;
            $boardingHouse->longitude = $request->approveRegistrationBhLng;
            $boardingHouse->save();
            $boardingHouseId = $boardingHouse->id;

            $operator = new Operator;
            $operator->employee_id = $request->approveRegistrationEmpId;
            $operator->boarding_house_id = $boardingHouseId;
            $operator->save();

            $userRole = new UserRole;
            $userRole->user_id = $userId;
            $userRole->role_id = 2;
            $userRole->save();


            return redirect()->back()->with('success', 'Registration successfully updated to approved.');
        } else if ($request->updateRegistrationRequestStatusSelect == 2) {
            $regReqStatus->update([
                'status' => 2,
                'comment' => $request->rejectRegistrationRequestComment,
                'isSeen' => 1,
            ]);
            return redirect()->back()->with('success', 'Registration successfully updated to rejected.');
        } else {
            return redirect()->back()->with('error', 'Oops, there\'s a problem in processing the document');
        }
    }

    public function uhrcProfilePage($id)
    {
        $pendingRegistrationReqs = EmployeeBhApplication::where('status', 0)->where('isSeen', 0)->get();
        $uhrcPersonnel = Employee::find($id);
        return view('uhrc.uhrc_profile_page', compact('uhrcPersonnel', 'pendingRegistrationReqs'));
    }

    public function uhrcReporting()
    {
        $pendingRegistrationReqs = EmployeeBhApplication::where('status', 0)->where('isSeen', 0)->get();
        $semesters = AySemester::orderBy('created_at', 'desc')->get();
        return view('uhrc.uhrc_reporting', compact('semesters', 'pendingRegistrationReqs'));
    }

    public function uhrcGovernmentBhReport($id)
    {

        $pendingRegistrationReqs = EmployeeBhApplication::where('status', 0)->where('isSeen', 0)->get();
        $semester = AySemester::find($id);
        $boardingHouses = BoardingHouse::where('classification', 'Government')->get();
        return view('uhrc.uhrc_government_bh_report', compact('boardingHouses', 'semester', 'pendingRegistrationReqs'));
    }

    public function uhrcPrivateBhReport($id)
    {
        $pendingRegistrationReqs = EmployeeBhApplication::where('status', 0)->where('isSeen', 0)->get();
        $semester = AySemester::find($id);
        $boardingHouses = BoardingHouse::where('classification', 'Private')->get();
        return view('uhrc.uhrc_private_bh_report', compact('boardingHouses', 'semester', 'pendingRegistrationReqs'));
    }

    public function uhrcFetchBoardingHouseForInteractiveMap()
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

    public function uhrcFetchDormitoriesForInteractiveMap()
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

    public function uhrcFetchBoardingHousePhotos(Request $request)
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

    public function uhrcFetchDormitoryPhotos(Request $request)
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
