<?php

namespace App\Http\Controllers;

use App\Models\AssocPersonnel;
use App\Models\BoardingHouse;
use App\Models\BoardingHouseImage;
use App\Models\Dormitory;
use App\Models\DormitoryImage;
use App\Models\Employee;
use App\Models\EmployeeBhApplication;
use App\Models\OperatorStudentTenant;
use Illuminate\Http\Request;

class AssocController extends Controller
{
    //

    public function assocDashboard()
    {
        $boardingHouses = BoardingHouse::all();
        return view("assoc.assoc_dashboard", compact('boardingHouses'));
    }

    public function assocBoardingHousesList()
    {
        return view("assoc.assoc_boarding_houses_list");
    }

    public function assocFetchBoadingHouses(Request $request)
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

    public function assocProfilePage($id)
    {
        $assocPersonnel = Employee::find($id);
        return view('assoc.assoc_profile_page', compact('assocPersonnel'));
    }



    public function assocInteractiveMap()
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

        return view("assoc.assoc_interactive_map", compact("boardingHouses"));
    }


    public function assocNewInteractiveMap()
    {
        $pendingRegistrationReqs = EmployeeBhApplication::where('status', 0)->where('isSeen', 0)->get();
        return view('assoc.assoc_new_interactive_map', compact('pendingRegistrationReqs'));
    }

    public function assocFetchBoardingHouseForInteractiveMap()
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

    public function assocFetchDormitoriesForInteractiveMap()
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

    public function assocFetchBoardingHousePhotos(Request $request)
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

    public function assocFetchDormitoryPhotos(Request $request)
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
