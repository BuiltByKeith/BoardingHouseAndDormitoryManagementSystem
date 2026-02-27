<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use App\Models\BoardingHouseDocument;
use App\Models\City;
use App\Models\EmployeeBhApplication;
use App\Models\EmployeeBhApplicationDocuments;
use App\Models\Province;
use App\Models\Region;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    //

    public function employeeDashboard()
    {
        $employeeId = auth()->user()->employee->id;
        $registrationForms = EmployeeBhApplication::where('employee_id', $employeeId)->orderBy('created_at', 'desc')->get();

        return view("employee.employee_dashboard", compact('registrationForms'));
    }

    public function employeeRegistrationPage()
    {
        $employeeId = auth()->user()->employee->id;
        $registrationForms = EmployeeBhApplication::where('employee_id', $employeeId)->orderBy('created_at', 'desc')->get();

        return view('employee.employee_registration_page', compact('registrationForms'));
    }

    public function employeeApplicationFormPage()
    {
        $regions = Region::all();
        return view('employee.application_form_page', compact('regions'));
    }

    public function employeeSubmittedDocumentDetail($id)
    {
        $applicationFormDetail = EmployeeBhApplication::find($id);
        return view('employee.employee_submitted_document_detail', compact('applicationFormDetail'));
    }

    public function submitEmployeeApplicationFormForBh(Request $request)
    {

        $employeeId = auth()->user()->employee->id;

        $request->validate([
            'registerHousingContract' => 'required',
            'registerPermit' => 'required',
            'file',
            'mimes:pdf',
        ]);

        if ($request->hasFile('registerHousingContract') && $request->hasFile('registerPermit')) {
            $permitFile = $request->file('registerPermit');
            $contractFile = $request->file('registerHousingContract');

            $permitOrigFileName = $permitFile->getClientOriginalName();
            $contractOrigFileName = $contractFile->getClientOriginalName();
            $permitFileExt = $permitFile->getClientOriginalExtension();
            $contractFileExt = $contractFile->getClientOriginalExtension();

            $formattedDate = Carbon::now()->format('M-d-Y');
            $formattedTime = Carbon::now()->format('H-i-s');

            $formattedPermitDocuName = $formattedTime . '_' . $formattedDate . '_' . $permitOrigFileName;
            $formattedContractDocuName = $formattedTime . '_' . $formattedDate . '_' . $contractOrigFileName;

            if ($permitFileExt == 'pdf' && $contractFileExt == 'pdf') {
                $region = Region::where('regCode', $request->registerBhRegion)->first();
                $province = Province::where('provCode', $request->registerBhProvince)->first();
                $city = City::where('citymunCode', $request->registerBhCity)->first();
                $barangay = Barangay::where('brgyCode', $request->registerBhBarangay)->first();

                $completeAddress = $request->registerBhStreet . ', ' . $barangay->brgyDesc . ', ' . $city->citymunDesc . ', ' . $province->provDesc . ', ' . $region->regDesc;

                $employeeBhAppForm = new EmployeeBhApplication;
                $employeeBhAppForm->employee_id = $employeeId;
                $employeeBhAppForm->boarding_house_name = $request->registerBhName;
                $employeeBhAppForm->sex_accepted = $request->registerBhSexAccepted;
                $employeeBhAppForm->lodging_type = $request->registerBhLodgingType;
                $employeeBhAppForm->classification = $request->registerBhClass;
                $employeeBhAppForm->complete_address = $completeAddress;
                $employeeBhAppForm->longitude = $request->registerBhLongitude;
                $employeeBhAppForm->latitude = $request->registerBhLatitude;
                $employeeBhAppForm->status = 0;
                $employeeBhAppForm->isSeen = 0;
                $employeeBhAppForm->save();
                $employeeBhAppFormId = $employeeBhAppForm->id;


                // Document Submission for the permit to accept lodgers 
                $employeeBhAppPermitDocu = new EmployeeBhApplicationDocuments;
                $employeeBhAppPermitDocu->employee_bh_app_id = $employeeBhAppFormId;
                $employeeBhAppPermitDocu->document_name = $permitOrigFileName;

                $destination_path = 'employee' . $employeeId . '/permit_document_submission' . '/' . $permitOrigFileName . '/';
                Storage::disk('public')->makeDirectory($destination_path);
                Storage::disk('public')->put($destination_path . $formattedPermitDocuName, file_get_contents($permitFile->getRealPath()));
                $employeeBhAppPermitDocu->file_path = $destination_path . $formattedPermitDocuName;
                $employeeBhAppPermitDocu->save();

                // Document Submission for the house contract
                $employeeBhAppContractDocu = new EmployeeBhApplicationDocuments;
                $employeeBhAppContractDocu->employee_bh_app_id = $employeeBhAppFormId;
                $employeeBhAppContractDocu->document_name = $contractOrigFileName;

                $destination_path = 'employee' . $employeeId . '/contract_document_submission' . '/' . $contractOrigFileName . '/';
                Storage::disk('public')->makeDirectory($destination_path);
                Storage::disk('public')->put($destination_path . $formattedContractDocuName, file_get_contents($contractFile->getRealPath()));
                $employeeBhAppContractDocu->file_path = $destination_path . $formattedContractDocuName;
                $employeeBhAppContractDocu->save();

                return redirect()->route('employeeRegistrationPage')->with('success', 'Application for successfully submitted!');
            } else {
                return redirect()->route('employeeRegistrationPage')->with('error', 'Wrong file format attached');
            }
        } else {
            return redirect()->route('employeeRegistrationPage')->with('error', 'No file Attached.');
        }
    }
}
