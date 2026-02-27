<?php

namespace App\Http\Controllers;

use App\Models\AySemester;
use App\Models\Barangay;
use App\Models\City;
use App\Models\College;
use App\Models\DormBillTemplate;
use App\Models\DormBillTemplateDetail;
use App\Models\DormChargePrice;
use App\Models\DormitoryCharge;
use App\Models\DormitoryImage;
use App\Models\DormitoryRoom;
use App\Models\DormitoryRoomTenant;
use App\Models\DormManager;
use App\Models\DormRoomPrice;
use App\Models\DormTenantBill;
use App\Models\DormTenantBillPayment;
use App\Models\Province;
use App\Models\Region;
use App\Models\StudentTenant;
use App\Models\StudentTenantGuardian;
use App\Models\StudentTenantHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Number;

class DormManagerController extends Controller
{
    //

    public function dormManagerDashboard()
    {
        $loggedInDormManagerDormId = auth()->user()->employee->dormManager->dormitory->id;

        $studentTenants = DormitoryRoomTenant::where('isActive', 1)->whereHas('dormRoom', function ($query) use ($loggedInDormManagerDormId) {
            $query->where('dormitory_id', $loggedInDormManagerDormId);
        })->get();

        $dormRooms = DormitoryRoom::where('dormitory_id', $loggedInDormManagerDormId)->get();
        $dormRoomBedCount = 0;

        foreach ($dormRooms as $room) {
            $dormRoomBedCount += $room->number_of_beds;
        }

        return view('dorm_manager.dorm_manager_dashboard', compact('studentTenants', 'dormRooms', 'dormRoomBedCount'));
    }

    public function dormManagerTenantList()
    {
        $loggedInDormManagerDormId = auth()->user()->employee->dormManager->dormitory->id;
        $semesters = AySemester::orderBy("created_at", "desc")->get();
        $colleges = College::all();
        $regions = Region::all();

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


        $dormitoryRooms = DormitoryRoom::where('dormitory_id', $loggedInDormManagerDormId)->get();
        $dormitoryCharges = DormitoryCharge::where('dormitory_id', $loggedInDormManagerDormId)->get();
        $dormitoryBillTemplates = DormBillTemplate::where('dormitory_id', $loggedInDormManagerDormId)->get();

        return view('dorm_manager.dorm_manager_tenant_list', compact('semesters', 'currentSemester', 'colleges', 'regions', 'dormitoryRooms', 'dormitoryCharges', 'dormitoryBillTemplates'));
    }

    public function dormManagerFetchRoomsForTenantAssigning(Request $request)
    {
        $dormitoryRoomInfo = DormitoryRoom::find($request->room_id);
        $dormitoryRoomTenantCount = $dormitoryRoomInfo->dormRoomStudentTenants->where('isActive', 1)->count();
        $dormRoomTenants = [];

        foreach ($dormitoryRoomInfo->dormRoomStudentTenants->where('isActive', 1) as $dormTenant) {
            $dormRoomTenants[] = [
                'id' => $dormTenant->id,
                'studentId' => $dormTenant->studentTenant->student_id,
                'studentFullName' => $dormTenant->studentTenant->firstname . ' ' . $dormTenant->studentTenant->middlename . ' ' . $dormTenant->studentTenant->lastname,
                'studentCourse' => $dormTenant->studentTenant->program->program_name,
            ];
        }

        $dormRoomInfo = [];
        $dormRoomInfo[] = [
            'id' => $dormitoryRoomInfo->id,
            'dormRoomName' => $dormitoryRoomInfo->room_name,
            'dormRoomPrice' => $dormitoryRoomInfo->roomPrices->where('isActive', 1)->first()->amount,
            'dormRoomNumberOfBeds' => $dormitoryRoomInfo->number_of_beds,
            'dormName' => $dormitoryRoomInfo->dormitory->dormitory_name,
            'dormRoomTenantCount' => $dormitoryRoomTenantCount,
            'dormRoomTenants' => $dormRoomTenants
        ];

        return response()->json($dormRoomInfo);
    }



    public function dormManagerFetchTenantList(Request $request)
    {
        $loggedInDormManagerDormId = auth()->user()->employee->dormManager->dormitory->id;



        $studentTenants = DormitoryRoomTenant::where('ay_semester_id', $request->semester_id)->where('isActive', 1)->whereHas('dormRoom', function ($query) use ($loggedInDormManagerDormId) {
            $query->where('dormitory_id', $loggedInDormManagerDormId);
        })->get();

        $tenants = [];

        foreach ($studentTenants as $tenant) {
            if ($tenant->clearance_status == 0) {
                $status = 'Pending';
            } else if ($tenant->clearance_status == 1) {
                $status = 'Uncleared';
            } else if ($tenant->clearance_status == 2) {
                $status = 'Cleared';
            } else {
                $status = '';
            }
            $tenants[] = [
                'dormRoomTenantId' => $tenant->id,
                'studentId' => $tenant->studentTenant->student_id,
                'studentFullName' => $tenant->studentTenant->firstname . ' ' . $tenant->studentTenant->middlename . ' ' . $tenant->studentTenant->lastname,
                'studentProgram' => $tenant->studentTenant->program->program_name,
                'dormRoomTenantRoom' => $tenant->dormRoom->room_name,
                'clearanceStatus' => $status,
                'statusId' => $tenant->clearance_status,
            ];
        }

        return response()->json($tenants);
    }

    public function dormManagerRegisterNewTenant(Request $request)
    {

        $loggedInDormManagerDormId = auth()->user()->employee->dormManager->dormitory->id;
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

        $tenantGuardian = new StudentTenantGuardian;
        $tenantGuardian->firstname = $request->guardianFirstname;
        $tenantGuardian->middlename = $request->guardianMiddlename;
        $tenantGuardian->lastname = $request->guardianLastname;
        $tenantGuardian->extname = $request->guardianExtname;
        $tenantGuardian->sex = $request->guardianSex;
        $tenantGuardian->contact_no = $request->guardianContactNo;
        $tenantGuardian->occupation = $request->guardianOccupation;
        $tenantGuardian->save();
        $tenantGuardianId = $tenantGuardian->id;

        $studentTenant = new StudentTenant;
        $barangay = Barangay::where('brgyCode', $request->barangay)->first();
        $city = City::where('citymunCode', $request->city)->first();
        $province = Province::where('provCode', $request->province)->first();
        $region = Region::where('regCode', $request->region)->first();

        $permanentAddress = $request->street . ', ' . $barangay->brgyDesc . ', ' . $city->citymunDesc . ', ' . $province->provDesc . ', ' . $region->regDesc;

        $studentTenant->student_id = $request->studentId;
        $studentTenant->institutional_email = $request->tenantIe;
        $studentTenant->firstname = $request->tenantFirstname;
        $studentTenant->middlename = $request->tenantMiddlename;
        $studentTenant->lastname = $request->tenantLastname;
        $studentTenant->extname = $request->tenantExtname;
        $studentTenant->sex = $request->tenantSex;
        $studentTenant->guardian_id = $tenantGuardianId;
        $studentTenant->program_id = $request->program;
        $studentTenant->permanent_address = $permanentAddress;
        $studentTenant->contact_no = $request->tenantContactNo;
        $studentTenant->save();
        $studentTenantId = $studentTenant->id;

        $dormRoomTenant = new DormitoryRoomTenant;
        $dormRoomTenant->student_tenant_id = $studentTenantId;
        $dormRoomTenant->dormitory_room_id = $request->roomAssignment;
        $dormRoomTenant->ay_semester_id = $currentSemester->id;
        $dormRoomTenant->isActive = 1;
        $dormRoomTenant->clearance_status = 0;
        $dormRoomTenant->save();

        $dormRoomTenantHistory = new StudentTenantHistory;
        $dormRoomTenantHistory->student_tenant_id = $studentTenantId;
        $dormRoomTenantHistory->dormitory_id = $loggedInDormManagerDormId;
        $dormRoomTenantHistory->date_in = now();
        $dormRoomTenantHistory->clearance_status = 0;
        $dormRoomTenantHistory->save();

        return redirect()->back()->with('success', 'Tenant Successfully Registered');

    }

    public function dormManagerUpdateTenantProfile(Request $request)
    {
        $dormRoomTenant = DormitoryRoomTenant::find($request->editTenantProfileDormRoomTenantId);

        $studentTenant = StudentTenant::find($dormRoomTenant->student_tenant_id);

        $studentTenant->update([
            'firstname' => $request->editTenantProfileFirstname,
            'middlename' => $request->editTenantProfileMiddlename,
            'lastname' => $request->editTenantProfileLastname,
            'extname' => $request->editTenantProfileExtname,
            'program_id' => $request->editTenantProfileProgram,
            'permanent_address' => $request->editTenantProfilePermanentAddress,
            'contact_no' => $request->editTenantProfileContactNumber,
        ]);

        $studentTenant->guardian->update([
            'firstname' => $request->editTenantProfileGuardianFirstname,
            'middlename' => $request->editTenantProfileGuardianMiddlename,
            'lastname' => $request->editTenantProfileGuardianLastname,
            'extname' => $request->editTenantProfileGuardianExtname,
            'sex' => $request->editTenantProfileGuardianSex,
            'occupation' => $request->editTenantProfileGuardianOccupation,
            'contact_no' => $request->editTenantProfileGuardianContactNo,
        ]);

        return redirect()->back()->with('success', 'Tenant Profile Successfully Updated!');
    }

    public function dormManagerTenantProfile($id)
    {
        $dormTenant = DormitoryRoomTenant::find($id);
        $dormBillTemplates = DormBillTemplate::all();

        $colleges = College::all();

        return view('dorm_manager.dorm_manager_tenant_profile', compact('dormTenant', 'dormBillTemplates', 'colleges'));
    }

    public function dormManagerFetchStudentTenantBills(Request $request)
    {
        $dormTenantBills = DormTenantBill::where('dorm_room_tenant_id', $request->dorm_tenant_id)->orderBy('created_at', 'desc')->get();
        $dormTenantBillInfo = [];

        foreach ($dormTenantBills as $bill) {

            $totalBill = 0; // Initialize totalBill variable

            foreach ($bill->dormBillTemplate->details as $detail) {
                $charge = $detail->dormCharge;
                $closestPrice = $charge->chargePrices()->where('date_start', '<=', $bill->created_at)
                    ->orderByDesc('date_start')
                    ->first();

                // If no price is found, set chargePrice to 0 or handle it accordingly
                $chargePrice = $closestPrice ? $closestPrice->amount : 0;
                // Add charge price to totalBill
                $totalBill += $chargePrice;
            }

            // Get the closest price for the room
            $closestRoomPrice = $bill->dormRoomTenant->dormRoom->roomPrices()
                ->where('date_start', '<=', $bill->created_at)
                ->orderByDesc('date_start')
                ->first();

            // If no price is found, set roomPrice to 0 or handle it accordingly
            $roomPrice = $closestRoomPrice ? $closestRoomPrice->amount : 0;


            if ($bill->payment_status == 0) {
                $status = 'Pending';
            } else if ($bill->payment_status == 1) {
                $status = 'Partial';
            } else if ($bill->payment_status == 2) {
                $status = 'Paid';
            } else {
                $status = '';
            }
            $dormTenantBillInfo[] = [
                'id' => $bill->id,
                'month' => $bill->month ? Carbon::parse($bill->month)->format('F Y') : '',
                'status' => $status,
                'dormRoomName' => $bill->dormRoomTenant->dormRoom->room_name,
                'dormRoomPrice' => $roomPrice ? Number::currency($roomPrice, 'PHP') : '',
                'totalBill' => Number::currency($totalBill + $roomPrice, 'PHP'),
            ];
        }

        return response()->json($dormTenantBillInfo);
    }

    public function dormManagerFetchTenantBillInfo(Request $request)
    {

        $dormTenantBill = DormTenantBill::find($request->bill_id);
        $billInfo = [];
        $tenantBillTemplate = [];
        $totalBill = 0; // Initialize totalBill variable

        $tenantFullName = $dormTenantBill->dormRoomTenant->studentTenant->firstname . ' ' . $dormTenantBill->dormRoomTenant->studentTenant->middlename . ' ' . $dormTenantBill->dormRoomTenant->studentTenant->lastname;


        foreach ($dormTenantBill->dormBillTemplate->details as $detail) {
            $charge = $detail->dormCharge;
            $closestPrice = $charge->chargePrices()->where('date_start', '<=', $dormTenantBill->created_at)
                ->orderByDesc('date_start')
                ->first();

            // If no price is found, set chargePrice to 0 or handle it accordingly
            $chargePrice = $closestPrice ? $closestPrice->amount : 0;
            $tenantBillTemplate[] = [
                'id' => $detail->id,
                'chargeId' => $detail->dormCharge->id,
                'chargeName' => $detail->dormCharge->name,
                'chargePrice' => Number::currency($chargePrice, 'PHP'),
            ];

            // Add charge price to totalBill
            $totalBill += $chargePrice;
        }

        // $closestRoomPrice = $dormTenantBill->dormRoomTenant->dormRoom->roomPrices->where('created_at', '<=', $dormTenantBill->created_at)
        //     ->first();
        $closestRoomPrice = $dormTenantBill->dormRoomTenant->dormRoom->roomPrices()
            ->where('date_start', '<=', $dormTenantBill->created_at)
            ->orderByDesc('date_start')
            ->first();

        // If no price is found, set roomPrice to 0 or handle it accordingly
        $roomPrice = $closestRoomPrice ? $closestRoomPrice->amount : 0;


        if ($dormTenantBill->payment_status == 0) {
            $status = 'Pending';
        } else if ($dormTenantBill->payment_status == 1) {
            $status = 'Partial';
        } else if ($dormTenantBill->payment_status == 2) {
            $status = 'Paid';
        } else {
            $status = '';
        }

        $dormTenantBillPaymentTransactions = [];

        foreach ($dormTenantBill->dormTenantBillPayments as $billPayment) {
            $dormTenantBillPaymentTransactions[] = [
                'id' => $billPayment->id,
                'receiptNo' => $billPayment->receipt_no,
                'amount' => $billPayment->amount ? Number::currency($billPayment->amount, 'PHP') : '',
                'comment' => $billPayment->comment ? $billPayment->comment : '',
                'datePaid' => $billPayment->created_at->format('F d, Y'),
            ];
        }


        $billInfo[] = [
            'id' => $dormTenantBill->id,
            'billOfTenantFullName' => $tenantFullName,
            'bhRoomNameOfTenant' => $dormTenantBill->dormRoomTenant->dormRoom->room_name,
            'bhRoomPriceOfTenant' => Number::currency($roomPrice, 'PHP'),
            'tenantBillTemplate' => $tenantBillTemplate,
            'paymentStatus' => $status,
            'statusId' => $dormTenantBill->payment_status,
            'totalBill' => Number::currency($totalBill + $roomPrice, 'PHP'),
            'billDate' => $dormTenantBill->month ? Carbon::parse($dormTenantBill->month)->format('F Y') : null,
            'billPaymentTransactions' => $dormTenantBillPaymentTransactions,
        ];

        return response()->json($billInfo);
    }

    public function dormManagerGenerateBillForTenant(Request $request)
    {
        $dormTenant = DormitoryRoomTenant::find($request->generateBillTenantId);

        $dormTenantBill = new DormTenantBill;
        $dormTenantBill->dorm_room_tenant_id = $request->generateBillTenantId;
        $dormTenantBill->dorm_bill_template_id = $request->selectBillTemplate;
        $dormTenantBill->month = $request->generateTenantBillReportDate;
        $dormTenantBill->payment_status = 0;
        $dormTenantBill->save();

        return redirect()->back()->with('success', 'Successfully added bill for tenant ' . $dormTenant->studentTenant->firstname);
    }

    public function dormManagerRegisterExistingTenant(Request $request)
    {

        $loggedInDormManagerDormId = auth()->user()->employee->dormManager->dormitory->id;
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
        $dormRoomTenant = new DormitoryRoomTenant;

        $dormRoomTenant->student_tenant_id = $request->registerExistingTenantId;
        $dormRoomTenant->dormitory_room_id = $request->existingTenantRoomAssignment;
        $dormRoomTenant->ay_semester_id = $currentSemester->id;
        $dormRoomTenant->isActive = 1;
        $dormRoomTenant->clearance_status = 0;
        $dormRoomTenant->save();


        $bhStudentTenantHistory = new StudentTenantHistory;
        $bhStudentTenantHistory->dormitory_id = $loggedInDormManagerDormId;
        $bhStudentTenantHistory->student_tenant_id = $request->registerExistingTenantId;
        $bhStudentTenantHistory->clearance_status = 0;
        $bhStudentTenantHistory->date_in = $currentDate;
        $bhStudentTenantHistory->save();

        return redirect()->back()->with("success", "New Tenant Accepted");
    }

    public function dormManagerRoomList()
    {
        $loggedInDormManagerDormId = auth()->user()->employee->dormManager->dormitory->id;
        $dormRooms = DormitoryRoom::where('dormitory_id', $loggedInDormManagerDormId)->get();
        return view('dorm_manager.dorm_manager_rooms_list', compact('dormRooms'));
    }

    public function dormManagerFetchDormRooms(Request $request)
    {
        $loggedInDormManagerDormId = auth()->user()->employee->dormManager->dormitory->id;
        $dormRooms = DormitoryRoom::where('dormitory_id', $loggedInDormManagerDormId)->get();

        $dormRoomDetails = [];

        foreach ($dormRooms as $room) {
            $roomPriceHistory = [];
            foreach ($room->roomPrices as $roomPrice) {
                if ($roomPrice->isActive == 0) {
                    $status = 'Inactive';
                } else if ($roomPrice->isActive == 1) {
                    $status = ' Active';
                } else {
                    $status = '';
                }
                $roomPriceHistory[] = [
                    'id' => $roomPrice->id,
                    'amount' => $roomPrice->amount,
                    'status' => $status,
                    'dateStart' => $roomPrice->date_start ? Carbon::parse($roomPrice->date_start)->format('F d, Y') : '',
                    'dateEnd' => $roomPrice->date_end ? Carbon::parse($roomPrice->date_end)->format('F d, Y') : '',
                ];
            }
            $dormRoomDetails[] = [
                'id' => $room->id,
                'roomName' => $room->room_name,
                'roomPrice' => $room->roomPrices->where('isActive', 1)->first()->amount,
                'numberOfBeds' => $room->number_of_beds,
                'roomPriceHistory' => $roomPriceHistory,
            ];
        }

        return response()->json($dormRoomDetails);
    }

    public function dormManagerFetchRoomDetailsForEditing(Request $request)
    {
        $dormRoom = DormitoryRoom::find($request->room_id);

        $dormRoomDetail = [];
        $dormRoomPrices = [];

        // Fetch room prices with ordering by created_at
        $roomPrices = $dormRoom->roomPrices()->orderBy('created_at', 'desc')->get();

        foreach ($roomPrices as $price) {
            if ($price->isActive == '0') {
                $status = 'Inactive';
            } else if ($price->isActive == '1') {
                $status = 'Active';
            } else {
                $status = '';
            }
            $dormRoomPrices[] = [
                'id' => $price->id,
                'amount' => $price->amount ? Number::currency($price->amount, 'PHP') : '',
                'status' => $status,
                'dateStart' => $price->date_start ? Carbon::parse($price->date_start)->format('F d, Y') : '',
                'dateEnd' => $price->date_end ? Carbon::parse($price->date_end)->format('F d, Y') : '',
            ];
        }
        $dormRoomDetail[] = [
            'id' => $dormRoom->id,
            'roomName' => $dormRoom->room_name,
            'currentPrice' => $dormRoom->roomPrices->where('isActive', 1)->first()->amount,
            'numberOfBeds' => $dormRoom->number_of_beds,
            'roomPriceHistory' => $dormRoomPrices,
        ];

        return response()->json($dormRoomDetail);
    }

    public function dormManagerFetchDormRoomTenants(Request $request)
    {
        $dormRoomTenants = DormitoryRoomTenant::where('dormitory_room_id', $request->room_id)->where('isActive', 1)->get();
        $dormTenantInfo = [];

        foreach ($dormRoomTenants as $tenant) {
            if ($tenant->studentTenant->sex == 0) {
                $sex = 'Female';
            } else if ($tenant->studentTenant->sex == 1) {
                $sex = 'Male';
            } else {
                $sex = '';
            }
            $dormTenantInfo[] = [
                'id' => $tenant->id,
                'tenantFullname' => $tenant->studentTenant->firstname . ' ' . $tenant->studentTenant->middlename . ' ' . $tenant->studentTenant->lastname,
                'tenantCourse' => $tenant->studentTenant->program->program_name,
                'tenantStudentIdNo' => $tenant->studentTenant->student_id,
            ];
        }

        return response()->json($dormTenantInfo);
    }


    public function dormManagerAddNewRoom(Request $request)
    {
        $dormManagerDormId = auth()->user()->employee->dormManager->dormitory->id;

        $dormRoom = new DormitoryRoom;
        $dormRoom->dormitory_id = $dormManagerDormId;
        $dormRoom->room_name = $request->dormManagerDormRoomName;
        $dormRoom->number_of_beds = $request->dormManagerDormRoomNoOfBeds;
        $dormRoom->save();
        $dormRoomId = $dormRoom->id;

        $dormRoomPrice = new DormRoomPrice;
        $dormRoomPrice->dorm_room_id = $dormRoomId;
        $dormRoomPrice->amount = $request->dormManagerDormRoomPrice;
        $dormRoomPrice->isActive = 1;
        $dormRoomPrice->date_start = now();
        $dormRoomPrice->save();

        return redirect()->back()->with('success', 'Dormitory room successfully added!');
    }

    public function dormManagerUpdateRoomDetail(Request $request)
    {
        $dormRoom = DormitoryRoom::find($request->dormManagerRoomEditId);

        $dormRoom->update([
            'room_name' => $request->dormManagerEditRoomName,
            'number_of_beds' => $request->dormManagerEditRoomNoOfBeds,
        ]);

        $dormRoomPrice = DormRoomPrice::where('dorm_room_id', $request->dormManagerRoomEditId)->where('isActive', 1)->first();

        $dormRoomPrice->update([
            'isActive' => 0,
            'date_end' => now(),
        ]);

        $newDormRoomPrice = new DormRoomPrice;
        $newDormRoomPrice->dorm_room_id = $request->dormManagerRoomEditId;
        $newDormRoomPrice->amount = $request->dormManagerEditRoomPrice;
        $newDormRoomPrice->isActive = 1;
        $newDormRoomPrice->date_start = now();
        $newDormRoomPrice->save();

        return redirect()->back()->with('success', 'Room detail successfully updated.');
    }

    public function dormManagerBillings($id)
    {
        $dormCharges = DormitoryCharge::where('dormitory_id', $id)->orderBy('created_at', 'desc')->get();
        $dormBillTemplates = DormBillTemplate::where('dormitory_id', $id)->orderBy('created_at', 'desc')->get();
        return view('dorm_manager.dorm_manager_billings', compact('dormCharges', 'dormBillTemplates'));
    }

    public function dormManagerAddDormCharge(Request $request)
    {

        $dormManagerDormId = auth()->user()->employee->dormManager->dormitory->id;


        $dormCharge = new DormitoryCharge;
        $dormCharge->dormitory_id = $dormManagerDormId;
        $dormCharge->name = $request->dormManagerAddDormChargeName;
        $dormCharge->description = $request->dormManagerAddDormChargeDescription;
        $dormCharge->save();
        $dormChargeId = $dormCharge->id;

        $dormChargePrice = new DormChargePrice;
        $dormChargePrice->dorm_charge_id = $dormChargeId;
        $dormChargePrice->amount = $request->dormManagerAddDormChargeAmount;
        $dormChargePrice->isActive = 1;
        $dormChargePrice->date_start = now();
        $dormChargePrice->save();

        return redirect()->back()->with('success', 'Room detail successfully updated.');
    }

    public function dormManagerFetchBhChargeHistory(Request $request)
    {
        $dormChargePrices = DormChargePrice::where('dorm_charge_id', $request->charge_id)->orderBy('created_at', 'desc')->get();
        $prices = [];

        foreach ($dormChargePrices as $price) {
            if ($price->isActive == 0) {
                $status = 'Inactive';
            } else if ($price->isActive == 1) {
                $status = 'Active';
            } else {
                $status = '';
            }
            $prices[] = [
                'id' => $price->id,
                'amount' => Number::currency($price->amount, 'PHP'),
                'status' => $status,
                'dateStart' => $price->date_start ? Carbon::parse($price->date_start)->format('F/d/Y') : '',
                'dateEnd' => $price->date_end ? Carbon::parse($price->date_end)->format('F/d/Y') : '',
            ];
        }
        return response()->json($prices);
    }

    public function dormManagerUpdateDormChargePrice(Request $request)
    {

        $dormCharge = DormChargePrice::where('dorm_charge_id', $request->dormManagerEditChargeId)->where('isActive', 1)->first();

        $dormCharge->update([
            'isActive' => 0,
            'date_end' => now(),
        ]);

        $newDormChargePrice = new DormChargePrice;
        $newDormChargePrice->dorm_charge_id = $request->dormManagerEditChargeId;
        $newDormChargePrice->amount = $request->editAmountInput;
        $newDormChargePrice->isActive = 1;
        $newDormChargePrice->date_start = now();
        $newDormChargePrice->save();

        return redirect()->back()->with('success', 'Boarding House Charge Price Successfully updated.');

    }

    public function dormManagerAddNewDormChargeTemplate(Request $request)
    {

        $loggedInOperatorDormId = auth()->user()->employee->dormManager->dormitory->id;

        $selectedCharges = json_decode($request->selectedCharges, true);
        $charges = [];
        foreach ($selectedCharges as $charge) {
            $charges[] = [
                'id' => $charge,
            ];
        }

        $dormBillTemplate = new DormBillTemplate;
        $dormBillTemplate->dormitory_id = $loggedInOperatorDormId;
        $dormBillTemplate->name = $request->dormManagerAddNewBillTemplateName;
        $dormBillTemplate->save();
        $dormBillTemplateId = $dormBillTemplate->id;

        foreach ($charges as $charge) {
            $dormBillTemplateDetails = new DormBillTemplateDetail;
            $dormBillTemplateDetails->dorm_bill_template_id = $dormBillTemplateId;
            $dormBillTemplateDetails->dorm_charge_id = $charge['id'];
            $dormBillTemplateDetails->save();
        }

        return redirect()->back()->with('success', 'Bill Template Successfully Added');

    }

    public function dormManagerFetchStudentTenants(Request $request)
    {
        $studentTenant = StudentTenant::where('student_id', $request->student_id)->first();

        if ($studentTenant == null) {
            return response()->json(['status' => 'Not Found']);
        }

        if ($studentTenant->sex == 0) {
            $sex = 'Female';
        } else if ($studentTenant->sex == 1) {
            $sex = 'Male';
        } else {
            $sex = '';
        }

        $tenantHistory = [];
        $tenantExists = false;
        $tenantUncleared = false;

        foreach ($studentTenant->studentTenantHistory as $history) {

            if ($history->boardingHouse) {
                if ($history->clearance_status == 0) {
                    $clearanceStatus = 'Uncleared';
                } else if ($history->clearance_status == 1) {
                    $clearanceStatus = 'Cleared';
                } else {
                    $clearanceStatus = '';
                }
                $tenantHistory[] = [
                    'id' => $history->id,
                    'bhName' => $history->boardingHouse ? $history->boardingHouse->boarding_house_name : '',
                    'bhId' => $history->boardingHouse ? $history->boardingHouse->id : '',
                    'bhOperatorName' => $history->boardingHouse ? $history->boardingHouse->operator->employee->firstname . ' ' . $history->boardingHouse->operator->employee->middlename . ' ' . $history->boardingHouse->operator->employee->lastname : '',
                    'dateIn' => $history->date_in ? Carbon::parse($history->date_in)->format('F d, Y') : '', // Formatting date_in
                    'dateOut' => $history->date_out ? Carbon::parse($history->date_out)->format('F d, Y') : 'Currently residing', // Formatting date_out
                    'clearanceStatus' => $clearanceStatus,
                ];
            } else {
                if ($history->clearance_status == 0) {
                    $clearanceStatus = 'Uncleared';
                } else if ($history->clearance_status == 1) {
                    $clearanceStatus = 'Cleared';
                } else {
                    $clearanceStatus = '';
                }
                $tenantHistory[] = [
                    'id' => $history->id,
                    'bhName' => $history->dormitory ? $history->dormitory->dormitory_name : '',
                    'bhId' => $history->dormitory ? $history->dormitory->id : '',
                    'bhOperatorName' => $history->dormitory ? $history->dormitory->dormManager->employee->firstname . ' ' . $history->dormitory->dormManager->employee->middlename . ' ' . $history->dormitory->dormManager->employee->lastname : '',
                    'dateIn' => $history->date_in ? Carbon::parse($history->date_in)->format('F d, Y') : '', // Formatting date_in
                    'dateOut' => $history->date_out ? Carbon::parse($history->date_out)->format('F d, Y') : 'Currently residing', // Formatting date_out
                    'clearanceStatus' => $clearanceStatus,
                ];
            }
            if ($history->date_out === null) {
                $tenantExists = true;
            }
            if ($history->clearance_status == 0) {
                $tenantUncleared = true;
            }
        }

        $tenantInfo = [
            'tenantId' => $studentTenant->id,
            'tenantStudentId' => $studentTenant->student_id,
            'tenantFullname' => $studentTenant->firstname . ' ' . $studentTenant->middlename . ' ' . $studentTenant->lastname,
            'tenantFirstname' => $studentTenant->firstname,
            'tenantMiddlename' => $studentTenant->middlename,
            'tenantLastname' => $studentTenant->lastname,
            'tenantExtname' => $studentTenant->extname,
            'tenantSex' => $sex,
            'sexId' => $studentTenant->sex,
            'tenantContactNo' => $studentTenant->contact_no,
            'tenantProgram' => $studentTenant->program->program_name,
            'tenantCollege' => $studentTenant->program->college->college_name,
            'tenantIe' => $studentTenant->institutional_email,
            'tenantExist' => $tenantExists,
            'tenantUncleared' => $tenantUncleared,
            'tenantAddress' => $studentTenant->permanent_address,
            'tenantHistory' => $tenantHistory,
        ];

        return response()->json($tenantInfo);
    }

    public function dormManagerGenerateBill(Request $request)
    {
        dd($request->all());
    }

    public function dormManagerFetchTenantBill(Request $request)
    {
        $tenantBills = DormTenantBill::where('dorm_room_tenant_id', $request->student_id)->orderBy('created_at', 'desc')->get();

        $billInfo = [];


        foreach ($tenantBills as $bill) {

            $totalBill = 0; // Initialize totalBill variable

            foreach ($bill->dormBillTemplate->details as $detail) {
                $charge = $detail->dormCharge;
                $closestPrice = $charge->prices()->where('date_start', '<=', $bill->created_at)
                    ->orderByDesc('date_start')
                    ->first();

                // If no price is found, set chargePrice to 0 or handle it accordingly
                $chargePrice = $closestPrice ? $closestPrice->amount : 0;
                // Add charge price to totalBill
                $totalBill += $chargePrice;
            }

            // Get the closest price for the room
            $closestRoomPrice = $bill->dormRoomTenant->dormRoom->roomPrices->where('created_at', '<=', $bill->created_at)->first();

            // If no price is found, set roomPrice to 0 or handle it accordingly
            $roomPrice = $closestRoomPrice ? $closestRoomPrice->amount : 0;

            if ($bill->payment_status == 0) {
                $status = 'Pending';
            } else if ($bill->payment_status == 1) {
                $status = 'Partial';
            } else if ($bill->payment_status == 2) {
                $status = 'Paid';
            } else {
                $status = '';
            }

            $billInfo[] = [
                'id' => $bill->id,
                'dormRoomTenantId' => $bill->dorm_room_tenant_id,
                'paymentStatus' => $status,
                'billMonth' => $bill->month ? Carbon::parse($bill->month)->format('F Y') : '',
                'dormRoomName' => $bill->dormRoomTenant->dormRoom->room_name,
                'bhRoomPrice' => $roomPrice ? Number::currency($roomPrice, 'PHP') : '',
                'totalBill' => Number::currency($totalBill + $roomPrice, 'PHP'),
            ];
        }

        return response()->json($billInfo);
    }

    public function dormManagerFetchDormTemplateDuringBilling(Request $request)
    {
        $dormBillTemplate = DormBillTemplate::find($request->template_id);

        $templateInfo = [];
        $templateDetails = [];

        foreach ($dormBillTemplate->details as $detail) {
            $templateDetails[] = [
                'id' => $detail->id,
                'amount' => $detail->dormCharge->chargePrices->where('isActive', 1)->first()->amount,
                'name' => $detail->dormCharge->name,
            ];
        }

        $templateInfo[] = [
            'id' => $dormBillTemplate->id,
            'dormId' => $dormBillTemplate->dormitory_id,
            'templateName' => $dormBillTemplate->name,
            'templateDetails' => $templateDetails,
        ];

        return response()->json($templateInfo);
    }

    public function dormManagerUpdateTenantBillStatus(Request $request)
    {
        $dormTenantBill = DormTenantBill::find($request->dormTenantBillId);

        $dormTenantBill->update([
            'payment_status' => $request->dormManagerUpdateTenantBillStatusSelect,
        ]);
        return redirect()->back()->with('success', 'Tenant Bill Status successfully updated');
    }

    public function dormManagerSubmitTenantBillPayment(Request $request)
    {
        $dormTenantBillPayment = new DormTenantBillPayment;
        $dormTenantBillPayment->dorm_tenant_bill_id = $request->dormTenantBillIdForPayment;
        $dormTenantBillPayment->receipt_no = $request->dormTenantPayTenantBillReceiptNo;
        $dormTenantBillPayment->amount = $request->dormTenantPayTenantBillAmount;
        $dormTenantBillPayment->comment = $request->dormTenantPayTenantBillComment;
        $dormTenantBillPayment->save();

        return redirect()->back()->with('success', 'Tenant successfully paid');
    }

    public function dormManagerRemoveTenant(Request $request)
    {

        $dormTenant = DormitoryRoomTenant::find($request->dormManagerTenantId);
        $dormTenant->update([
            'isActive' => 0,
        ]);


        $tenantHistory = StudentTenantHistory::where('student_tenant_id', $dormTenant->studentTenant->id)->latest()->first();
        $tenantHistory->comment = $request->dormManagerCommentForRemoveTenant;
        $tenantHistory->reason = $request->dormManagerReasonForRemoveTenant;
        $tenantHistory->clearance_status = $dormTenant->clearance_status;
        $tenantHistory->date_out = now();
        $tenantHistory->save();

        return redirect()->back()->with('success', 'Tenant successfully removed.');

    }

    public function dormManagerUpdateBhRoomTenantClearanceStatus(Request $request)
    {

        $dormRoomTenant = DormitoryRoomTenant::find($request->dormRoomTenantIdInput);
        $dormRoomTenant->update([
            'clearance_status' => $request->dormRoomTenantToggleValueInput,
        ]);
        return redirect()->back()->with('success', 'Successfully Updated the tenants clearance status');
    }

    public function dormManagerTransactions($id)
    {
        $dormManagerTransactions = DormTenantBillPayment::whereHas('dormTenantBill', function ($query) use ($id) {
            $query->whereHas('dormRoomTenant', function ($query) use ($id) {
                $query->whereHas('dormRoom', function ($query) use ($id) {
                    $query->where('dormitory_id', $id);
                });
            });
        })->with('dormTenantBill.dormRoomTenant.studentTenant')->orderBy('created_at', 'desc')->get();
        return view('dorm_manager.dorm_manager_transactions', compact('dormManagerTransactions'));
    }

    public function dormManagerProfilePage($id)
    {
        $dormManager = DormManager::find($id);
        return view('dorm_manager.dorm_manager_profile_page', compact('dormManager'));
    }

    public function dormManagerHistoryOfTenantList()
    {
        $loggedInDormManagerDormId = auth()->user()->employee->dormManager->dormitory->id;
        $semesters = AySemester::orderBy("created_at", "desc")->get();
        $colleges = College::all();
        $regions = Region::all();

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
        return view('dorm_manager.dorm_manager_history_of_tenant_list', compact('currentSemester', 'semesters'));
    }

    public function dormManagerFetchHistoryOfTenantList(Request $request)
    {
        $loggedInDormManagerDormId = auth()->user()->employee->dormManager->dormitory->id;


        $historyStudentTenants = DormitoryRoomTenant::where('ay_semester_id', $request->semester_id)->where('isActive', 0)->whereHas('dormRoom', function ($query) use ($loggedInDormManagerDormId) {
            $query->where('dormitory_id', $loggedInDormManagerDormId);
        })->get();

        $tenants = [];

        foreach ($historyStudentTenants as $tenant) {
            $studentTenant = $tenant->studentTenant;

            foreach ($studentTenant->studentTenantHistory as $history) {
                if ($history->dormitory_id === $loggedInDormManagerDormId) {
                    $tenants[] = [
                        'dormHistoryTenantStudentId' => $history->studentTenant->student_id,
                        'dormHistoryTenantFullName' => $history->studentTenant->firstname . ' ' . $history->studentTenant->middlename . ' ' . $history->studentTenant->lastname,
                        'dormHistoryId' => $history->id,
                        'dormHistoryClearanceStatus' => $history->clearance_status,
                        'dormHistoryDateIn' => $history->date_in ? Carbon::parse($history->date_in)->format('F d, Y') : '',
                        'dormHistoryDateOut' => $history->date_out ? Carbon::parse($history->date_out)->format('F d, Y') : '',
                    ];
                }
            }
        }
        return response()->json($tenants);

    }

    public function dormManagerUpdateHistoryOfTenantClearanceStatus(Request $request)
    {

        $studentTenantHistory = StudentTenantHistory::find($request->dormHistoryOfTenantIdInput);

        $studentTenantHistory->update([
            'clearance_status' => $request->dormHistoryOfTenantToggleValueInput,
        ]);

        return redirect()->back()->with('success', 'Tenant Clearance Successfully updated');
    }

    public function dormManagerDeleteBhTemplate(Request $request)
    {
        $dormTemaplte = DormBillTemplate::find($request->template_id);

        if ($dormTemaplte) {
            $dormTemaplte->details()->delete();

            $dormTemaplte->delete();

            return response()->json(['feedback' => 'success']);
        } else {
            return response()->json(['feedback' => 'error']);
        }
    }

    public function dormManagerUploadBhPhoto(Request $request)
    {

        $loggedInDormManagerDormId = auth()->user()->employee->dormManager->dormitory->id;

        $request->validate([
            'uploadDormPhoto' => 'required',
            'file',
            'mimes:pdf',
        ]);
        if ($request->hasFile('uploadDormPhoto')) {
            $file = $request->file('uploadDormPhoto');

            // Get the original name of the file that was uploaded
            $origFileName = $file->getClientOriginalName();

            // Create a string that will take the current date and time so that we can make a unique name for every files that was uploaded
            $formattedDate = Carbon::now()->format('m-d-Y');
            $formattedTime = Carbon::now()->format('H-i-s');
            $formattedName = $formattedTime . '_' . $formattedDate . '_' . $origFileName;

            $dormImage = new DormitoryImage;
            $dormImage->dormitory_id = $loggedInDormManagerDormId;
            $dormImage->file_name = $formattedName;

            // Concatinate values to build up the structure of the file path of the uploaded file
            $destination_path = 'dormitory' . $loggedInDormManagerDormId . '/images' . $request->origFileName . '/';

            // Creating new directory in the storage/app/public folder
            Storage::disk('public')->makeDirectory($destination_path);

            // Insert the final value of the file in the directory and get that value and put in the file_path field in the database
            Storage::disk('public')->put($destination_path . $formattedName, file_get_contents($file->getRealPath()));
            $dormImage->file_path = $destination_path . $formattedName;

            // Save
            $dormImage->save();

            return redirect()->back()->with('success', 'Document Uploaded Successfully');
        } else {
            return redirect()->back()->with('errer', 'Photo Upload Failed');
        }
    }

    public function dormManagerDeleteBhPhoto(Request $request)
    {
        $dormPhoto = DormitoryImage::find($request->dormPhotoIdInput);

        if ($dormPhoto) {
            // Check if the file exists before deleting
            if (Storage::exists('public/' . $dormPhoto->file_path)) {
                // Delete the file from storage
                Storage::delete('public/' . $dormPhoto->file_path);
            } else {
                // Handle if the file does not exist
                return redirect()->back()->with('error', 'File not found in storage');
            }

            // Delete the record from the database
            $dormPhoto->delete();

            return redirect()->back()->with('success', 'Photo Deletion Completed');
        } else {
            return redirect()->back()->with('error', 'Photo not found');
        }
    }

}
