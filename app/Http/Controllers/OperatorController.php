<?php

namespace App\Http\Controllers;

use App\Models\AySemester;
use App\Models\Barangay;
use App\Models\BhChargePrice;
use App\Models\BhRoomPrice;
use App\Models\BhTenantBillPayment;
use App\Models\Bill;
use App\Models\BillTemplate;
use App\Models\BillTemplateDetail;
use App\Models\BoardingHouseCharge;
use App\Models\BoardingHouseDocument;
use App\Models\BoardingHouseImage;
use App\Models\BoardingHouseRoom;
use App\Models\BoardingHouseRoomTenants;
use App\Models\City;
use App\Models\CityMunicipality;
use App\Models\College;
use App\Models\ExtraBill;
use App\Models\Operator;
use App\Models\OperatorStudentTenant;
use App\Models\Payment;
use App\Models\PaymentTransaction;
use App\Models\Program;
use App\Models\Province;
use App\Models\Region;
use App\Models\StudentTenant;
use App\Models\StudentTenantGuardian;
use App\Models\StudentTenantHistory;
use App\Models\TenantBill;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Number;

class OperatorController extends Controller
{

    // MAO NI FUNCTION SA PAG DISPLAY LANG SA VIEW SA OPERATOR DASHBOARD
    public function operatorDashboard()
    {
        $loggedInOperatorBhId = auth()->user()->employee->operator->boardingHouse->id;
        $studentTenants = BoardingHouseRoomTenants::where('isActive', 1)->whereHas('boardingHouseRoom', function ($query) use ($loggedInOperatorBhId) {
            $query->where('boarding_house_id', $loggedInOperatorBhId);
        })->get();

        $bhRooms = BoardingHouseRoom::where('boarding_house_id', $loggedInOperatorBhId)->get();
        $bhRoomBedCount = 0;
        foreach ($bhRooms as $room) {
            $bhRoomBedCount += $room->number_of_beds;
        }
        return view('operator.operator_dashboard', compact('studentTenants', 'bhRooms', 'bhRoomBedCount'));
    }

    // MAO NI FUNCTION SA PAG DISPLAY LANG SA VIEW SA TENANT LIST
    public function operatorTenantList()
    {
        $loggedInOperatorBhId = auth()->user()->employee->operator->boardingHouse->id;
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

        $rooms = BoardingHouseRoom::where('boarding_house_id', $loggedInOperatorBhId)->get();

        $boardingHouseCharges = BoardingHouseCharge::where('boarding_house_id', $loggedInOperatorBhId)->get();
        $boardingHouseBillTemplates = BillTemplate::where('boarding_house_id', $loggedInOperatorBhId)->get();

        $boardingHouseRooms = BoardingHouseRoom::where('boarding_house_id', $loggedInOperatorBhId)->get();


        return view('operator.operator_tenant_list', compact('semesters', 'currentSemester', 'colleges', 'regions', 'boardingHouseRooms', 'boardingHouseCharges', 'boardingHouseBillTemplates', 'rooms'));
    }

    // MAO NI FUNCTION SA PAG FETCH USING AJAX SA TANAN TENANTS NGA NAKA DISPLAY SA TENANT LIST
    public function operatorFetchTenantList(Request $request)
    {
        $loggedInOperatorBhId = auth()->user()->employee->operator->boardingHouse->id;

        $studentTenants = BoardingHouseRoomTenants::where('ay_semester_id', $request->semester_id)->where('isActive', 1)->whereHas('boardingHouseRoom', function ($query) use ($loggedInOperatorBhId) {
            $query->where('boarding_house_id', $loggedInOperatorBhId);
        })->get();
        $tenants = [];


        foreach ($studentTenants as $tenant) {
            $tenantHistory = [];

            if ($tenant->studentTenant->sex == 0) {
                $sex = 'Female';
            } else if ($tenant->studentTenant->sex == 1) {
                $sex = 'Male';
            } else {
                $sex = '';
            }

            foreach ($tenant->studentTenant->studentTenantHistory as $history) {

                if ($history->boardingHouse) {
                    $tenantHistory[] = [
                        'id' => $history->id,
                        'firstname' => $history->studentTenant->firstname,
                        'middlename' => $history->studentTenant->middlename,
                        'lastname' => $history->studentTenant->lastname,
                        'extname' => $history->studentTenant->extname,
                        'bhId' => $history->boardingHouse->id,
                        'bhName' => $history->boardingHouse->boarding_house_name,
                    ];
                } else {
                    $tenantHistory[] = [
                        'id' => $history->id,
                        'firstname' => $history->studentTenant->firstname,
                        'middlename' => $history->studentTenant->middlename,
                        'lastname' => $history->studentTenant->lastname,
                        'extname' => $history->studentTenant->extname,
                        'bhId' => $history->dormitory->id,
                        'bhName' => $history->dormitory->dormitory_name,
                    ];
                }
            }


            $tenants[] = [
                'bhRoomTenantId' => $tenant->id,
                'studentIdNumber' => $tenant->studentTenant->student_id,
                'studentTenantId' => $tenant->studentTenant->id,
                'tenantRoomName' => $tenant->boardingHouseRoom->room_name,
                'tenantRoomId' => $tenant->boardingHouseRoom->id,
                'firstName' => $tenant->studentTenant->firstname,
                'middleName' => $tenant->studentTenant->middlename,
                'lastName' => $tenant->studentTenant->lastname,
                'extName' => $tenant->studentTenant->extname,
                'program' => $tenant->studentTenant->program->program_name,
                'programId' => $tenant->studentTenant->program->id,
                'college' => $tenant->studentTenant->program->college->college_name,
                'collegeId' => $tenant->studentTenant->program->college->id,
                'sex' => $sex,
                'room' => $tenant->boardingHouseRoom->room_name ? $tenant->boardingHouseRoom->room_name : 'Not Yet Assigned',
                'contactNo' => $tenant->studentTenant->contact_no,
                'address' => $tenant->studentTenant->permanent_address,
                'semester' => $tenant->semester->description,
                'roomPrice' => $tenant->boardingHouseRoom->roomPrices->where('isActive', 1)->first()->amount ? Number::currency($tenant->boardingHouseRoom->roomPrices->where('isActive', 1)->first()->amount, 'PHP') : 'Not Yet Assigned',
                'tenantGuardianFullname' => $tenant->studentTenant->guardian->firstname . ' ' . $tenant->studentTenant->guardian->middlename . ' ' . $tenant->studentTenant->guardian->lastname,
                'tenantGuardianFirstname' => $tenant->studentTenant->guardian->firstname,
                'tenantGuardianMiddlename' => $tenant->studentTenant->guardian->middlename,
                'tenantGuardianLastname' => $tenant->studentTenant->guardian->lastname,
                'tenantGuardianExtname' => $tenant->studentTenant->guardian->extname,
                'tenantGuardianContactNo' => $tenant->studentTenant->guardian->contact_no,
                'tenantGuardianOccupation' => $tenant->studentTenant->guardian->occupation,
                'tenantHistory' => $tenantHistory,
                'tenantStatus' => $tenant->clearance_status,

            ];
        }
        return response()->json($tenants);
    }

    // MAO NI FUNCTION SA PAG FETCH SA HISTORY SA ISA KA TENANT, MA TRIGGER NI SYA INIG CLICK NIMO SA BUTTON 
    // TAPAD SA TENANT PROFILE
    public function operatorFetchStudentTenantHistory(Request $request)
    {
        $tenantHistories = StudentTenantHistory::where('student_tenant_id', $request->tenant_id)->orderBy('date_in', 'desc')->get();

        $histories = [];

        foreach ($tenantHistories as $tenantHistory) {


            if ($tenantHistory->boardingHouse) {
                if ($tenantHistory->clearance_status == 0) {
                    $clearanceStatus = 'Uncleared';
                } else if ($tenantHistory->clearance_status == 1) {
                    $clearanceStatus = 'Cleared';
                } else {
                    $clearanceStatus = '';
                }
                $histories[] = [
                    'id' => $tenantHistory->id,
                    'bhName' => $tenantHistory->boardingHouse->boarding_house_name,
                    'bhOperatorName' => $tenantHistory->boardingHouse->operator->employee->firstname . ' ' . $tenantHistory->boardingHouse->operator->employee->middlename . ' ' . $tenantHistory->boardingHouse->operator->employee->lastname,
                    'dateIn' => $tenantHistory->date_in ? Carbon::parse($tenantHistory->date_in)->format('F-d-Y') : '', // Formatting date_in
                    'dateOut' => $tenantHistory->date_out ? Carbon::parse($tenantHistory->date_out)->format('F-d-Y') : 'Currently residing', // Formatting date_out
                    'clearanceStatus' => $clearanceStatus,
                    'reason' => $tenantHistory->reason ? $tenantHistory->reason : '',
                ];
            } else {
                if ($tenantHistory->clearance_status == 0) {
                    $clearanceStatus = 'Uncleared';
                } else if ($tenantHistory->clearance_status == 1) {
                    $clearanceStatus = 'Cleared';
                } else {
                    $clearanceStatus = '';
                }
                $histories[] = [
                    'id' => $tenantHistory->id,
                    'bhName' => $tenantHistory->dormitory->dormitory_name,
                    'bhOperatorName' => $tenantHistory->dormitory->dormManager->employee->firstname . ' ' . $tenantHistory->dormitory->dormManager->employee->middlename . ' ' . $tenantHistory->dormitory->dormManager->employee->lastname,
                    'dateIn' => $tenantHistory->date_in ? Carbon::parse($tenantHistory->date_in)->format('F-d-Y') : '', // Formatting date_in
                    'dateOut' => $tenantHistory->date_out ? Carbon::parse($tenantHistory->date_out)->format('F-d-Y') : 'Currently residing', // Formatting date_out
                    'clearanceStatus' => $clearanceStatus,
                    'reason' => $tenantHistory->reason ? $tenantHistory->reason : '',
                ];
            }
        }
        return response()->json($histories);
    }

    // FUNCTION TO FETCH ALL THE BILLS OF A CERTAIN TENANT
    public function operatorFetchStudentTenantBills(Request $request)
    {
        $tenantBills = TenantBill::where('bh_room_tenant_id', $request->student_id)->orderBy('created_at', 'desc')->get();

        $billInfo = [];


        foreach ($tenantBills as $bill) {

            $totalBill = 0; // Initialize totalBill variable

            foreach ($bill->template->details as $detail) {
                $charge = $detail->charge;
                $closestPrice = $charge->prices()->where('date_start', '<=', $bill->created_at)
                    ->orderByDesc('date_start')
                    ->first();

                // If no price is found, set chargePrice to 0 or handle it accordingly
                $chargePrice = $closestPrice ? $closestPrice->amount : 0;
                // Add charge price to totalBill
                $totalBill += $chargePrice;
            }

            // Get the closest price for the room
            $closestRoomPrice = $bill->bhRoomTenant->boardingHouseRoom->roomPrices->where('created_at', '<=', $bill->created_at)->first();

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
                'bhRoomTenantId' => $bill->bh_room_tenant_id,
                'paymentStatus' => $status,
                'billMonth' => $bill->month ? Carbon::parse($bill->month)->format('F Y') : '',
                'bhRoomName' => $bill->bhRoomTenant->boardingHouseRoom->room_name,
                'bhRoomPrice' => $roomPrice ? Number::currency($roomPrice, 'PHP') : '',
                'totalBill' => Number::currency($totalBill + $roomPrice, 'PHP'),
            ];
        }

        return response()->json($billInfo);
    }


    // MAO NI FUNCTION SA KANANG I DISPLAY ANG TANANG TENANTS NGA NA BELONG NI NGA ROOM DURING SA PAG REIGSTER SA USA KA TENANT
    public function operatorFetchRoomsForTenantAssigning(Request $request)
    {
        $boardingHouseRoomInfo = BoardingHouseRoom::find($request->room_id);

        $boardingHouseRoomTenantCount = $boardingHouseRoomInfo->roomStudentTenants->where('isActive', 1)->count();

        $bhRoomTenants = [];
        foreach ($boardingHouseRoomInfo->roomStudentTenants->where('isActive', 1) as $tenant) {
            $bhRoomTenants[] = [
                'id' => $tenant->id,
                'studentId' => $tenant->studentTenant->student_id,
                'studentFullname' => $tenant->studentTenant->firstname . ' ' . $tenant->studentTenant->middlename . ' ' . $tenant->studentTenant->lastname,
                'studentCourse' => $tenant->studentTenant->program->program_name,
            ];
        }
        $bhRoomInfo = [];
        $bhRoomInfo[] = [
            'id' => $boardingHouseRoomInfo->id,
            'roomName' => $boardingHouseRoomInfo->room_name,
            'roomPrice' => $boardingHouseRoomInfo->roomPrices->where('isActive', 1)->first()->amount,
            'numberOfBeds' => $boardingHouseRoomInfo->number_of_beds,
            'bhName' => $boardingHouseRoomInfo->boardingHouse->boarding_house_name,
            'bhRoomTenantCount' => $boardingHouseRoomTenantCount,
            'bhRoomTenants' => $bhRoomTenants,
        ];

        return response()->json($bhRoomInfo);
    }


    // FUNCTION SA OPERATOR PROFILE VIEW
    public function operatorProfilePage($id)
    {
        $operatorProfile = Operator::find($id);

        return view('operator.operator_profile_page', compact('operatorProfile'));
    }
    // FUNCTION SA OPERATOR PROFILE EDIT PAGE
    public function operatorEditProfilePage($id)
    {
        $operatorProfile = Operator::find($id);
        return view('operator.operator_edit_profile_page', compact('operatorProfile'));
    }

    // FUNCTION NGA POST PARA MA UPDATE ANG PROFILE SA USA KA OPERATOR
    public function operatorUpdateProfile(Request $request)
    {
        $operatorProfile = Operator::find($request->operatorId);

        $operatorProfile->employee->firstname = $request->editFirstname;
        $operatorProfile->employee->middlename = $request->editMiddlename;
        $operatorProfile->employee->lastname = $request->editLastname;
        $operatorProfile->employee->extname = $request->editExtname;
        $operatorProfile->employee->sex = $request->editSex;
        $operatorProfile->employee->contact_no = $request->editContactNo;
        $operatorProfile->employee->save();

        $operatorProfile->boardingHouse->boarding_house_name = $request->editBhName;

        $operatorProfile->boardingHouse->longitude = $request->bhLng;
        $operatorProfile->boardingHouse->latitude = $request->bhLat;
        $operatorProfile->boardingHouse->save();

        return redirect()->route('operatorProfilePage', $request->operatorId)->with('success', 'Profile Successfully Updated!');
    }

    // FUNCTION NI SYA PARA SA VIEW SA OPERATOR SETTINGS
    public function operatorBhBillings($id)
    {
        $bhCharges = BoardingHouseCharge::where('boarding_house_id', $id)->get();
        $bhBillTemplates = BillTemplate::where('boarding_house_id', $id)->get();
        return view('operator.operator_billings', compact('bhCharges', 'bhBillTemplates'));
    }

    public function operatorDeleteBhTemplate(Request $request)
    {
        $bhTemplate = BillTemplate::find($request->template_id);

        if ($bhTemplate) {
            $bhTemplate->details()->delete();

            $bhTemplate->delete();

            return response()->json(['feedback' => 'success']);
        } else {
            return response()->json(['feedback' => 'error']);
        }
    }

    public function operatorTransactions($id)
    {
        $payments = BhTenantBillPayment::whereHas('bhTenantBill', function ($query) use ($id) {
            $query->whereHas('bhRoomTenant', function ($query) use ($id) {
                $query->whereHas('boardingHouseRoom', function ($query) use ($id) {
                    $query->where('boarding_house_id', $id);
                });
            });
        })->with('bhTenantBill.bhRoomTenant.studentTenant')->orderBy('created_at', 'desc')->get();

        return view('operator.operator_transactions_page', compact('payments'));
    }

    public function operatorTenantHistoryList()
    {
        $loggedInOperatorBhId = auth()->user()->employee->operator->boardingHouse->id;
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

        return view('operator.operator_tenant_history_list', compact('currentSemester', 'semesters'));
    }

    public function operatorFetchHistoryOfTenants(Request $request)
    {
        $loggedInOperatorBhId = auth()->user()->employee->operator->boardingHouse->id;

        $historyStudentTenants = BoardingHouseRoomTenants::where('ay_semester_id', $request->semester_id)->where('isActive', 0)->whereHas('boardingHouseRoom', function ($query) use ($loggedInOperatorBhId) {
            $query->where('boarding_house_id', $loggedInOperatorBhId);
        })->get();

        $tenants = [];

        foreach ($historyStudentTenants as $tenant) {

            $studentTenant = $tenant->studentTenant;

            foreach ($studentTenant->studentTenantHistory as $history) {
                if ($history->boarding_house_id === $loggedInOperatorBhId) {
                    $tenants[] = [
                        'bhHistoryTenantStudentId' => $history->studentTenant->student_id,
                        'bhHistoryTenantFullName' => $history->studentTenant->firstname . ' ' . $history->studentTenant->middlename . ' ' . $history->studentTenant->lastname,
                        'bhHistoryId' => $history->id,
                        'bhHistoryClearanceStatus' => $history->clearance_status,
                        'bhHistoryDateIn' => $history->date_in ? Carbon::parse($history->date_in)->format('F d, Y') : '',
                        'bhHistoryDateOut' => $history->date_out ? Carbon::parse($history->date_out)->format('F d, Y') : '',
                        'bhHistoryReason' => $history->reason ? $history->reason : 'Currently Residing',
                    ];
                }
            }
        }
        return response()->json($tenants);
    }

    public function operatorDocumentSubmissions($id)
    {
        $bhId = $id;
        $documents = BoardingHouseDocument::where('boarding_house_id', $id)->get();
        return view('operator.operator_document_submission_page', compact('documents', 'bhId'));
    }

    public function operatorAddNewBhCharge(Request $request)
    {
        $loggedInOperatorBhId = auth()->user()->employee->operator->boardingHouse->id;
        $addNewBhCharge = new BoardingHouseCharge;
        $addNewBhCharge->boarding_house_id = $loggedInOperatorBhId;
        $addNewBhCharge->name = $request->addNewChargeName;
        $addNewBhCharge->description = $request->addNewChargeDescription;
        $addNewBhCharge->save();
        $newBhChargeId = $addNewBhCharge->id;

        $addBhChargePrice = new BhChargePrice;
        $addBhChargePrice->bh_charge_id = $newBhChargeId;
        $addBhChargePrice->amount = $request->addNewChargeAmount;
        $addBhChargePrice->isActive = 1;
        $addBhChargePrice->date_start = now();
        $addBhChargePrice->save();

        return redirect()->back()->with('success', 'Successfully added a new boarding house charge.');
    }

    public function operatorAddNewBillTemplate(Request $request)
    {

        $loggedInOperatorBhId = auth()->user()->employee->operator->boardingHouse->id;

        $selectedCharges = json_decode($request->selectedCharges, true);
        $charges = [];
        foreach ($selectedCharges as $charge) {
            $charges[] = [
                'id' => $charge,
            ];
        }

        $billTemplate = new BillTemplate;
        $billTemplate->boarding_house_id = $loggedInOperatorBhId;
        $billTemplate->name = $request->addNewBillTemplateName;
        $billTemplate->save();
        $billTemplateId = $billTemplate->id;

        foreach ($charges as $charge) {
            $billTemplateDetails = new BillTemplateDetail;
            $billTemplateDetails->bill_template_id = $billTemplateId;
            $billTemplateDetails->charge_id = $charge['id'];
            $billTemplateDetails->save();
        }

        return redirect()->back()->with('success', 'Bill Template Successfully Added');
    }

    public function operatorGenerateTenantBill(Request $request)
    {
        $tenant = BoardingHouseRoomTenants::find($request->generateBillTenantId);
        $tenantName = $tenant->studentTenant->firstname;
        $tenantBill = new TenantBill;
        $tenantBill->bh_room_tenant_id = $request->generateBillTenantId;
        $tenantBill->bill_template_id = $request->selectBillTemplate;
        $tenantBill->month = $request->generateTenantBillReportDate;
        $tenantBill->payment_status = 0;
        $tenantBill->save();

        return redirect()->back()->with('success', 'Successfully generated new bill for ' . $tenantName);
    }

    public function operatorSubmitPaymentForTenantBill(Request $request)
    {
        $tenantBillPayment = new BhTenantBillPayment;
        $tenantBillPayment->bh_tenant_bill_id = $request->operatorTenantBillId;
        $tenantBillPayment->amount = $request->operatorEnterAmountInputForPayment;
        $tenantBillPayment->comment = $request->operatorEnterCommentInputForPayment;
        $tenantBillPayment->save();

        return redirect()->back()->with('success', 'Successfully submitted transaction.');
    }

    public function operatorUpdateTenantBillStatus(Request $request)
    {

        $tenantBill = TenantBill::find($request->operatorTenantUpdateBillStatusId);

        $tenantBill->update([
            'payment_status' => $request->operatorSelectUpdateStatus,
        ]);

        return redirect()->back()->with('success', 'Tenant bill status successfully updated.');
    }

    public function operatorSubmitDocumentFile(Request $request)
    {
        $loggedInOperatorBhId = auth()->user()->employee->operator->boardingHouse->id;

        $request->validate([
            'documentFile' => 'required',
            'file',
            'mimes:pdf',
        ]);

        if ($request->hasFile('documentFile')) {
            $file = $request->file('documentFile');

            // Get the extension of the file that was uploaded
            $extension = $file->getClientOriginalExtension();

            // Get the original name of the file that was uploaded
            $origFileName = $file->getClientOriginalName();

            // Create a string that will take the current date and time so that we can make a unique name for every files that was uploaded
            $formattedDate = Carbon::now()->format('m-d-Y');
            $formattedTime = Carbon::now()->format('H-i-s');
            $formattedName = $formattedTime . '_' . $formattedDate . '_' . $origFileName;

            if ($extension == 'pdf') {
                $bhDocument = new BoardingHouseDocument;
                $bhDocument->boarding_house_id = $loggedInOperatorBhId;
                $bhDocument->document_name = $request->documentName;
                $bhDocument->file_name = $formattedName;


                // Concatinate values to build up the structure of the file path of the uploaded file
                $destination_path = 'boardingHouse' . $loggedInOperatorBhId . '/documents' . '/' . $request->documentName . '/';

                // Creating new directory in the storage/app/public folder
                Storage::disk('public')->makeDirectory($destination_path);

                // Insert the final value of the file in the directory and get that value and put in the file_path field in the database
                Storage::disk('public')->put($destination_path . $formattedName, file_get_contents($file->getRealPath()));
                $bhDocument->file_path = $destination_path . $formattedName;

                // Save
                $bhDocument->save();

                return redirect()->back()->with('success', 'Document Uploaded Successfully');
            } else {
                return redirect()->back()->with('error', 'Wrong file format attached');
            }
        }
    }

    public function operatorUploadBhPhoto(Request $request)
    {
        $loggedInOperatorBhId = auth()->user()->employee->operator->boardingHouse->id;

        $request->validate([
            'uploadBhPhoto' => 'required',
            'file',
            'mimes:pdf',
        ]);
        if ($request->hasFile('uploadBhPhoto')) {
            $file = $request->file('uploadBhPhoto');

            // Get the original name of the file that was uploaded
            $origFileName = $file->getClientOriginalName();

            // Create a string that will take the current date and time so that we can make a unique name for every files that was uploaded
            $formattedDate = Carbon::now()->format('m-d-Y');
            $formattedTime = Carbon::now()->format('H-i-s');
            $formattedName = $formattedTime . '_' . $formattedDate . '_' . $origFileName;

            $bhImage = new BoardingHouseImage;
            $bhImage->boarding_house_id = $loggedInOperatorBhId;
            $bhImage->file_name = $formattedName;

            // Concatinate values to build up the structure of the file path of the uploaded file
            $destination_path = 'boardingHouse' . $loggedInOperatorBhId . '/images' . $request->origFileName . '/';

            // Creating new directory in the storage/app/public folder
            Storage::disk('public')->makeDirectory($destination_path);

            // Insert the final value of the file in the directory and get that value and put in the file_path field in the database
            Storage::disk('public')->put($destination_path . $formattedName, file_get_contents($file->getRealPath()));
            $bhImage->file_path = $destination_path . $formattedName;

            // Save
            $bhImage->save();

            return redirect()->back()->with('success', 'Document Uploaded Successfully');
        } else {
            return redirect()->back()->with('errer', 'Photo Upload Failed');
        }
    }

    public function operatorDeleteBhPhoto(Request $request)
    {
        $bhPhoto = BoardingHouseImage::find($request->bhPhotoIdInput);

        if ($bhPhoto) {
            // Check if the file exists before deleting
            if (Storage::exists('public/' . $bhPhoto->file_path)) {
                // Delete the file from storage
                Storage::delete('public/' . $bhPhoto->file_path);
            } else {
                // Handle if the file does not exist
                return redirect()->back()->with('error', 'File not found in storage');
            }

            // Delete the record from the database
            $bhPhoto->delete();

            return redirect()->back()->with('success', 'Photo Deletion Completed');
        } else {
            return redirect()->back()->with('error', 'Photo not found');
        }
    }


    public function operatorUpdateBhChargePrice(Request $request)
    {
        $bhChargePrice = BhChargePrice::where('bh_charge_id', $request->bhChargeId)->where('isActive', 1)->first();
        $bhChargePrice->isActive = 0;
        $bhChargePrice->date_end = now();
        $bhChargePrice->save();

        $newBhChargePrice = new BhChargePrice;
        $newBhChargePrice->bh_charge_id = $request->bhChargeId;
        $newBhChargePrice->amount = $request->editAmountInput;
        $newBhChargePrice->isActive = 1;
        $newBhChargePrice->date_start = now();
        $newBhChargePrice->save();

        return redirect()->back()->with('success', 'Boarding House Charge Price Successfully updated.');
    }

    // FUNCTION NGA PAG FETCH SA MGA PROVINCE DEPENDE SA GI PILI NGA REGION
    // DIDTO NI SYA MAHITABO SA REGISTRATION FORM
    public function operatorApiFetchProvinces(Request $request)
    {
        $data['provinces'] = Province::where('regCode', $request->region_id)->get();

        return response()->json($data);
    }
    // FUNCTION NGA PAG FETCH SA MGA CITIES DEPENDE SA GI PILI NGA PROVINCE
    // DIDTO NI SYA MAHITABO SA REGISTRATION FORM
    public function operatorApiFetchCities(Request $request)
    {
        $data['cities'] = City::where('provCode', $request->province_id)->get();

        return response()->json($data);
    }
    // FUNCTION NGA PAG FETCH SA MGA BARARANGAYS DEPENDE SA GI PILI NGA PROVINCE
    // DIDTO NI SYA MAHITABO SA REGISTRATION FORM
    public function operatorApiFetchBarangays(Request $request)
    {
        $data['barangays'] = Barangay::where('citymunCode', $request->city_id)->get();
        return response()->json($data);
    }
    // FUNCTION NGA PAG FETCH SA MGA PROGRAMS DEPENDE SA GI PILI NGA COLLEGE
    // DIDTO NI SYA MAHITABO SA REGISTRATION FORM
    public function operatorApiFetchPrograms(Request $request)
    {
        $data['programs'] = Program::where('college_id', $request->college_id)->get();
        return response()->json($data);
    }

    // MAO NI SYA FUNCTION SA KATONG PAG REGISTER NIMO UG TENANT NAA PAY VERIFICATION NGA SEARCH TENANT
    // DIRI TO SYA FILTERON AND PANGITAON KUNG NAA NABA ANG TENANT SA DATABASE OR WALA
    // DEPENDE SA RESULT KUNG NAA, I GAWAS ANG REGISTER FORM, KUNG EXISTING, DISPLAY ANG INFO THEN PROCEED TO ROOM ASSIGNMENT
    public function operatorFetchStudentTenants(Request $request)
    {
        $studentTenant = StudentTenant::where('student_id', $request->studentId)->first();

        if ($studentTenant == null) {
            return response()->json(['status' => 'Not Found']);
        }

        // if ($studentTenant->sex != auth()->user()->employee->operator->boardingHouse->sex_accepted) {

        // }

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
            // Check if the history is from a boarding house
            if ($history->boarding_house_id) {
                // Handle clearance status
                if ($history->clearance_status == 0) {
                    $clearanceStatus = 'Uncleared';
                } else if ($history->clearance_status == 1) {
                    $clearanceStatus = 'Cleared';
                } else {
                    $clearanceStatus = 'N/A';
                }

                $tenantHistory[] = [
                    'id' => $history->id,
                    'bhName' => $history->boardingHouse->boarding_house_name,
                    'bhOperatorName' => $history->boardingHouse->operator->employee->firstname . ' ' . $history->boardingHouse->operator->employee->middlename . ' ' . $history->boardingHouse->operator->employee->lastname,
                    'dateIn' => $history->date_in ? Carbon::parse($history->date_in)->format('F d, Y') : '', // Formatting date_in
                    'dateOut' => $history->date_out ? Carbon::parse($history->date_out)->format('F d, Y') : 'Currently Residing', // Formatting date_out
                    'clearanceStatus' => $clearanceStatus,
                    'reason' => $history->reason ? $history->reason : 'Currently Residing',
                    'clearanceStatusId' => $history->clearanceStatus
                ];
            } else {
                // Handle clearance status
                if ($history->clearance_status == 0) {
                    $clearanceStatus = 'Uncleared';
                } else if ($history->clearance_status == 1) {
                    $clearanceStatus = 'Cleared';
                } else {
                    $clearanceStatus = 'N/A';
                }

                $tenantHistory[] = [
                    'id' => $history->id,
                    'bhName' => $history->dormitory->dormitory_name,
                    'bhOperatorName' => $history->dormitory->dormManager->employee->firstname . ' ' . $history->dormitory->dormManager->employee->middlename . ' ' . $history->dormitory->dormManager->employee->lastname,
                    'dateIn' => $history->date_in ? Carbon::parse($history->date_in)->format('F d, Y') : '', // Formatting date_in
                    'dateOut' => $history->date_out ? Carbon::parse($history->date_out)->format('F d, Y') : 'Currently Residing', // Formatting date_out
                    'clearanceStatus' => $clearanceStatus,
                    'reason' => $history->reason ? $history->reason : 'Currently Residing',
                    'clearanceStatusId' => $history->clearanceStatus
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
            'tenantAddress' => $studentTenant->permanent_address,
            'tenantHistory' => $tenantHistory,
            'tenantUncleared' => $tenantUncleared,
        ];

        return response()->json($tenantInfo);
    }

    // FETCH ALL BILL TEMPLATE OF THE BOARDING HOUSE AND DISPLAY ITS DETAILS DURING THE REGISTRATION
    public function operatorFetchTemplatesDuringRegistration(Request $request)
    {
        $billTemplate = BillTemplate::find($request->template_id);

        $templateInfo = [];
        $templateDetails = [];

        foreach ($billTemplate->details as $detail) {
            $templateDetails[] = [
                'id' => $detail->id,
                'amount' => $detail->charge->prices->where('isActive', 1)->first()->amount,
                'name' => $detail->charge->name,
            ];
        }

        $templateInfo[] = [
            'id' => $billTemplate->id,
            'bhId' => $billTemplate->boarding_house_id,
            'templateName' => $billTemplate->name,
            'billDetails' => $templateDetails,
        ];

        return response()->json($templateInfo);
    }

    // FUNCTION SA PAG FETCH SA MGA BILL TEMPLATE AND DISPLAY SA ILANG DETAILS KUNG MAG GENERATE NA UG BILL ANG OPERATOR
    public function operatorFetchTemplateDuringBilling(Request $request)
    {
        $loggedInOperatorBhId = auth()->user()->employee->operator->boardingHouse->id;

        $billTemplate = BillTemplate::find($request->template_id);
        $templateInfo = [];

        $templateDetails = [];
        foreach ($billTemplate->details as $detail) {
            $templateDetails[] = [
                'id' => $detail->id,
                'chargeName' => $detail->charge->name,
                'chargePrice' => $detail->charge->prices->where('isActive', 1)->first()->amount ? Number::currency($detail->charge->prices->where('isActive', 1)->first()->amount, 'PHP') : '',
            ];
        }

        $templateInfo[] = [
            'id' => $billTemplate->id,
            'templateName' => $billTemplate->name,
            'templateDetails' => $templateDetails,
        ];



        return response()->json($templateInfo);
    }

    public function operatorFetchTenantBillChargeDetail(Request $request)
    {
        $tenantBill = TenantBill::find($request->bill_id);
        $tenantFullName = $tenantBill->bhRoomTenant->studentTenant->firstname . ' ' . $tenantBill->bhRoomTenant->studentTenant->middlename . ' ' . $tenantBill->bhRoomTenant->studentTenant->lastname;
        $billInfo = [];
        $tenantBillTemplate = [];
        $totalBill = 0; // Initialize totalBill variable

        foreach ($tenantBill->template->details as $detail) {
            $charge = $detail->charge;
            $closestPrice = $charge->prices()->where('date_start', '<=', $tenantBill->created_at)
                ->orderByDesc('date_start')
                ->first();

            // If no price is found, set chargePrice to 0 or handle it accordingly
            $chargePrice = $closestPrice ? $closestPrice->amount : 0;
            $tenantBillTemplate[] = [
                'id' => $detail->id,
                'chargeId' => $detail->charge->id,
                'chargeName' => $detail->charge->name,
                'chargePrice' => Number::currency($chargePrice, 'PHP'),
            ];

            // Add charge price to totalBill
            $totalBill += $chargePrice;
        }

        $closestRoomPrice = $tenantBill->bhRoomTenant->boardingHouseRoom->roomPrices->where('created_at', '<=', $tenantBill->created_at)->first();

        // If no price is found, set roomPrice to 0 or handle it accordingly
        $roomPrice = $closestRoomPrice ? $closestRoomPrice->amount : 0;


        if ($tenantBill->payment_status == 0) {
            $status = 'Pending';
        } else if ($tenantBill->payment_status == 1) {
            $status = 'Partial';
        } else if ($tenantBill->payment_status == 2) {
            $status = 'Paid';
        } else {
            $status = '';
        }

        $tenantBillPaymentTransactions = [];

        foreach ($tenantBill->bhTenantBillPayments as $billPayment) {
            $tenantBillPaymentTransactions[] = [
                'id' => $billPayment->id,
                'amount' => $billPayment->amount ? Number::currency($billPayment->amount, 'PHP') : '',
                'comment' => $billPayment->comment ? $billPayment->comment : '',
                'datePaid' => $billPayment->created_at->format('F d, Y'),
            ];
        }


        $billInfo[] = [
            'id' => $tenantBill->id,
            'billOfTenantFullName' => $tenantFullName,
            'bhRoomNameOfTenant' => $tenantBill->bhRoomTenant->boardingHouseRoom->room_name,
            'bhRoomPriceOfTenant' => Number::currency($roomPrice, 'PHP'),
            'tenantBillTemplate' => $tenantBillTemplate,
            'paymentStatus' => $status,
            'totalBill' => Number::currency($totalBill + $roomPrice, 'PHP'),
            'billDate' => $tenantBill->month ? Carbon::parse($tenantBill->month)->format('F Y') : null,
            'billPaymentTransactions' => $tenantBillPaymentTransactions,
        ];

        return response()->json($billInfo);
    }

    // FUNCTION NI SA PAG REGISTER UG BAG O NGA TENANT KUNG WALA SYA SA DATABASE
    public function operatorRegisterNewTenant(Request $request)
    {

        $loggedInOperatorBhId = auth()->user()->employee->operator->boardingHouse->id;
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
        $tenantGuardian->contact_no = $request->guardianContactNo;
        $tenantGuardian->sex = $request->guardianSex;
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
        $studentTenant->firstname = $request->tenantFirstname;
        $studentTenant->middlename = $request->tenantMiddlename;
        $studentTenant->lastname = $request->tenantLastname;
        $studentTenant->extname = $request->tenantExtname;
        $studentTenant->institutional_email = $request->tenantIe;
        $studentTenant->sex = $request->tenantSex;
        $studentTenant->program_id = $request->program;
        $studentTenant->contact_no = $request->tenantContactNo;
        $studentTenant->permanent_address = $permanentAddress;
        $studentTenant->guardian_id = $tenantGuardianId;
        $studentTenant->save();
        $studentId = $studentTenant->id;

        $bhRoomTenant = new BoardingHouseRoomTenants;
        $bhRoomTenant->student_tenant_id = $studentId;
        $bhRoomTenant->boarding_house_room_id = $request->roomAssignment;
        $bhRoomTenant->ay_semester_id = $currentSemester->id;
        $bhRoomTenant->isActive = 1;
        $bhRoomTenant->clearance_status = 0;
        $bhRoomTenant->save();



        $bhStudentTenantHistory = new StudentTenantHistory;
        $bhStudentTenantHistory->boarding_house_id = $loggedInOperatorBhId;
        $bhStudentTenantHistory->student_tenant_id = $studentId;
        $bhStudentTenantHistory->clearance_status = 0;
        $bhStudentTenantHistory->date_in = $currentDate;
        $bhStudentTenantHistory->save();

        return redirect()->back()->with('success', 'Tenant Successfully Registered');
    }

    // FUNCTION NI SA PAG REGISTER UG EXISTING NGA TENANT KAY NAA NA SYA SA DATABASE
    // KWAON NALANG NIYA ANG STUDENT ID PARA MAO IYANG I ASSIGN AS NEW DATA SA BhRoomTenant Table
    public function operatorRegisterExistingTenant(Request $request)
    {
        $loggedInOperatorId = auth()->user()->employee->operator->id;
        $loggedInOperatorBhId = auth()->user()->employee->operator->boardingHouse->id;
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
        $bhRoomTenant = new BoardingHouseRoomTenants;

        $bhRoomTenant->student_tenant_id = $request->registerExistingTenantId;
        $bhRoomTenant->boarding_house_room_id = $request->existingTenantRoomAssignment;
        $bhRoomTenant->ay_semester_id = $currentSemester->id;
        $bhRoomTenant->isActive = 1;
        $bhRoomTenant->clearance_status = 0;
        $bhRoomTenant->save();


        $bhStudentTenantHistory = new StudentTenantHistory;
        $bhStudentTenantHistory->boarding_house_id = $loggedInOperatorBhId;
        $bhStudentTenantHistory->student_tenant_id = $request->registerExistingTenantId;
        $bhStudentTenantHistory->clearance_status = 0;
        $bhStudentTenantHistory->date_in = $currentDate;
        $bhStudentTenantHistory->save();

        return redirect()->back()->with("success", "New Tenant Accepted");
    }



    public function operatorEditTenantInformation(Request $request)
    {


        $tenant = StudentTenant::find($request->editTenantId);

        $tenant->firstname = $request->editTenantFirstName;
        $tenant->middlename = $request->editTenantMiddleName;
        $tenant->lastname = $request->editTenantLastName;
        $tenant->extname = $request->editTenantExtName;
        $tenant->contact_no = $request->editTenantContactNo;
        $tenant->program_id = $request->editTenantProgram;
        $tenant->permanent_address = $request->editTenantPermanentAddress;
        $tenant->guardian->firstname = $request->editGuardianFirstName;
        $tenant->guardian->middlename = $request->editGuardianMiddleName;
        $tenant->guardian->lastname = $request->editGuardianLastName;
        $tenant->guardian->extname = $request->editGuardianExtName;
        $tenant->guardian->contact_no = $request->editGuardianContactNo;
        $tenant->guardian->occupation = $request->editGuardianOccupation;
        $tenant->save();
        $tenant->guardian->save();

        $roomTenant = BoardingHouseRoomTenants::find($request->editRoomTenantId);
        $roomTenant->update([
            'boarding_house_room_id' => $request->editTenantRoom,
        ]);

        return redirect()->back()->with('success', 'Tenant Information Successfully Updated.');
    }



    // FUNCTION NI SYA PARA MA NAVIGATE AND ROOMS PAGE
    public function operatorRoomList()
    {


        $loggedInOperatorId = auth()->user()->employee->operator->id;
        $loggedInOperatorBhId = auth()->user()->employee->operator->boardingHouse->id;

        $rooms = BoardingHouseRoom::where('boarding_house_id', $loggedInOperatorBhId)->get();

        return view('operator.operator_room_list', compact('rooms'));
    }

    // FUNCTION NI SYA USING AJAX NGA MAG FETCH SA TANANG BH ROOMS PARA MA DISPLAY DIDTO SA operatorRoomList
    public function operatorFetchBhRooms()
    {
        $loggedInOperatorBhId = auth()->user()->employee->operator->boardingHouse->id;
        $boardingHouseRoom = BoardingHouseRoom::where('boarding_house_id', $loggedInOperatorBhId)->get();

        $roomDetails = [];

        foreach ($boardingHouseRoom as $room) {
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
            $roomDetails[] = [
                'id' => $room->id,
                'roomName' => $room->room_name,
                'roomPrice' => $room->roomPrices->where('isActive', 1)->first()->amount,
                'numberOfBeds' => $room->number_of_beds,
                'roomPriceHistory' => $roomPriceHistory,
            ];
        }

        return response()->json($roomDetails);
    }

    // FUNCTION NI SYA USING AJAX NGA MAG FETCH SA TANAN TENANTS NGA NA BELONG ANI NGA ROOM EVERY TIME MU CLICK ANG USER SA INFO SA ROOM 
    // DIDTO I POPULATE SA TABLE NGA NAA ROOM INFO ANG MGA NGA FETCH NGA TENANT NGA NA BELONG ANA NGA ROOM
    public function operatorFetchTenantsOnRoom(Request $request)
    {
        $bhRoomTenants = BoardingHouseRoomTenants::where('boarding_house_room_id', $request->room_id)->where('isActive', 1)->get();
        $tenantInfo = [];

        foreach ($bhRoomTenants as $tenant) {
            if ($tenant->studentTenant->sex == 0) {
                $sex = 'Female';
            } else if ($tenant->studentTenant->sex == 1) {
                $sex = 'Male';
            } else {
                $sex = '';
            }
            $tenantInfo[] = [
                'id' => $tenant->id,
                'tenantFullname' => $tenant->studentTenant->firstname . ' ' . $tenant->studentTenant->middlename . ' ' . $tenant->studentTenant->lastname,
                'tenantFirstname' => $tenant->studentTenant->firstname,
                'tenantMiddlename' => $tenant->studentTenant->middlename,
                'tenantLastname' => $tenant->studentTenant->lastname,
                'tenantExtname' => $tenant->studentTenant->extname,
                'tenantCourse' => $tenant->studentTenant->program->program_name,
                'tenantCollege' => $tenant->studentTenant->program->college->college_name,
                'tenantStudentIdNo' => $tenant->studentTenant->student_id,
                'tenantSex' => $sex,
                'tenantContactNo' => $tenant->studentTenant->contact_no,
                'tenantAddress' => $tenant->studentTenant->permanent_address,
            ];
        }

        return response()->json($tenantInfo);
    }

    public function operatorFetchRoomDetailsForEditing(Request $request)
    {
        $bhRoom = BoardingHouseRoom::find($request->room_id);

        $bhRoomDetail = [];
        $bhRoomPrices = [];

        // Fetch room prices with ordering by created_at
        $roomPrices = $bhRoom->roomPrices()->orderBy('created_at', 'desc')->get();

        foreach ($roomPrices as $price) {
            if ($price->isActive == '0') {
                $status = 'Inactive';
            } else if ($price->isActive == '1') {
                $status = 'Active';
            } else {
                $status = '';
            }
            $bhRoomPrices[] = [
                'id' => $price->id,
                'amount' => $price->amount ? Number::currency($price->amount, 'PHP') : '',
                'status' => $status,
                'dateStart' => $price->date_start ? Carbon::parse($price->date_start)->format('F d, Y') : '',
                'dateEnd' => $price->date_end ? Carbon::parse($price->date_end)->format('F d, Y') : '',
            ];
        }

        $bhRoomDetail[] = [
            'id' => $bhRoom->id,
            'roomName' => $bhRoom->room_name,
            'currentPrice' => $bhRoom->roomPrices->where('isActive', 1)->first()->amount,
            'numberOfBeds' => $bhRoom->number_of_beds,
            'roomPriceHistory' => $bhRoomPrices,
        ];

        return response()->json($bhRoomDetail);
    }



    // FUNCTION TO ADD A NEW ROOM 
    public function operatorAddNewRoom(Request $request)
    {
        $loggedInOperatorBhId = auth()->user()->employee->operator->boardingHouse->id;
        $room = new BoardingHouseRoom;

        $room->room_name = $request->roomName;
        // $room->room_price = $request->roomPrice;
        $room->number_of_beds = $request->numberOfBeds;
        $room->boarding_house_id = $loggedInOperatorBhId;
        $room->save();
        $roomId = $room->id;

        $roomPrice = new BhRoomPrice;
        $roomPrice->bh_room_id = $roomId;
        $roomPrice->amount = $request->roomPrice;
        $roomPrice->isActive = 1;
        $roomPrice->date_start = now();
        $roomPrice->save();

        return redirect()->back()->with('success', 'New Room Added');
    }

    public function operatorUpdateRoomDetail(Request $request)
    {

        $room = BoardingHouseRoom::find($request->operatorRoomEditId);

        $room->update([
            'room_name' => $request->operatorEditRoomName,
            'number_of_beds' => $request->operatorEditRoomNoOfBeds,
        ]);

        $roomPrice = BhRoomPrice::where('bh_room_id', $request->operatorRoomEditId)->where('isActive', 1)->first();

        $roomPrice->update([
            'isActive' => 0,
            'date_end' => now(),
        ]);

        $newRoomPrice = new BhRoomPrice;
        $newRoomPrice->bh_room_id = $request->operatorRoomEditId;
        $newRoomPrice->amount = $request->operatorEditRoomPrice;
        $newRoomPrice->isActive = 1;
        $newRoomPrice->date_start = now();
        $newRoomPrice->save();

        return redirect()->back()->with('success', 'Room detail successfully updated.');
    }

    // FUNCTION NI SYA SA PAG FETCH SA HISTORY SA PRICES SA BH CHARGES NGA MAKITA SA SETTINGS
    public function operatorFetchBhChargeHistory(Request $request)
    {
        $bhChargePrices = BhChargePrice::where('bh_charge_id', $request->charge_id)->orderBy('created_at', 'desc')->get();
        $prices = [];

        foreach ($bhChargePrices as $price) {
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


    // FUNCTION TO EXPEL A TENANT
    public function operatorRemoveTenant(Request $request)
    {

        $bhTenant = BoardingHouseRoomTenants::find($request->bhRoomTenantId);

        $bhTenant->update([
            'isActive' => 0,
        ]);

        $tenantHistory = StudentTenantHistory::where('student_tenant_id', $bhTenant->studentTenant->id)->latest()->first();
        $tenantHistory->comment = $request->comment;
        $tenantHistory->reason = $request->operatorRemoveTenantReason;
        $tenantHistory->clearance_status = $bhTenant->clearance_status;
        $tenantHistory->date_out = now();

        $tenantHistory->save();

        return redirect()->back()->with('success', 'Tenant Successfully Expelled');
    }

    public function operatorFetchDocumentSubmission(Request $request)
    {
        $bhId = $request->bh_id;

        $documents = BoardingHouseDocument::where('boarding_house_id', $bhId)->get();

        $documentDetail = [];

        foreach ($documents as $document) {
            $documentDetail[] = [
                'id' => $document->id,
                'documentName' => $document->document_name,
                'fileName' => $document->file_name,
                'filePath' => $document->file_path,
            ];
        }

        return response()->json($documentDetail);
    }

    public function operatorUpdateBhRoomTenantClearanceStatus(Request $request)
    {

        $bhRoomTenant = BoardingHouseRoomTenants::find($request->bhRoomTenantIdInput);
        $bhRoomTenant->update([
            'clearance_status' => $request->bhRoomTenantToggleValueInput,
        ]);

        return redirect()->back()->with('success', 'Successfully Updated the tenants clearance status');
    }

    public function operatorUpdateHistoryOfTenantClearanceStatus(Request $request)
    {

        $historyOfTenant = StudentTenantHistory::find($request->bhHistoryOfTenantIdInput);

        $historyOfTenant->update([
            'clearance_status' => $request->bhHistoryOfTenantToggleValueInput,
        ]);

        return redirect()->back()->with('success', 'Successfully Updated a previous tenant\'s clearance status ');
    }

    public function operatorUpdateAccountDetails(Request $request)
    {

        $user = User::find($request->operatorEditAccountOperatorId);
        $userPassword = $user->password;
        $inputOldPassword = $request->operatorEditAccountOldPassField;
        $inputNewPassword = $request->operatorEditAccountNewPassField;

        if (Hash::check($inputOldPassword, $userPassword)) {
            $user->update([
                'password' => Hash::make($inputNewPassword),
            ]);

            return redirect()->back()->with('success', 'Account successfully updated');
        } else {
            return redirect()->back()->with('error', 'Update failed, please check passwords if they match.');
        }
    }
}
