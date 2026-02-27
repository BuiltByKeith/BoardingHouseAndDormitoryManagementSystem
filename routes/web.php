<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AssocController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\DormManagerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\UhrcController;
use App\Http\Controllers\OsaController;
use App\Models\OsaPersonnel;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('landing-page-interactive-map', [Controller::class, 'landingPageInteractiveMap'])->name('landingPageInteractiveMap');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');

    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');

    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});
Route::get('/register-page', function () {
    return view('register_page');
});

Route::post('register-new-employee-user', [Controller::class, 'registerNewEmployeeUser'])->name('registerNewEmployeeUser');

Route::post('registration-page-fetch-employee-existence', [Controller::class, 'registrationFormFetchEmployeeIdExistense'])->name('registrationFormFetchEmployeeIdExistense');
Route::get('registration-success', function () {
    return view('success');
})->name('registrationSuccessPage');


// ADMIN NAVIGATION ROUTES
Route::get('admin-dashboard', [AdminController::class, 'adminDashboard'])->name('adminDashboard');
Route::get('admin-employees-list', [AdminController::class, 'adminEmployeesList'])->name('adminEmployeesList');
Route::get('admin-students-list', [AdminController::class, 'adminStudentsList'])->name('adminStudentsList');
Route::get('admin-users-list', [AdminController::class, 'adminUsersList'])->name('adminUsersList');
Route::get('admin-semesters-list', [AdminController::class, 'adminSemestersList'])->name('adminSemestersList');
Route::get('admin-acad-years-list', [AdminController::class, 'adminAcadYearsList'])->name('adminAcadYearsList');

// ADMIN AJAX FETCH POST ROUTES
Route::post('admin-fetch-employees-list', [AdminController::class, 'adminFetchEmployeesList'])->name('adminFetchEmployeesList');


// ADMIN POST SUBMISSION ROUTES
Route::post('admin-add-new-employee', [AdminController::class, 'adminAddNewEmployee'])->name('adminAddNewEmployee');
Route::post('admin-add-new-academic-year', [AdminController::class, 'adminAddNewAcademicYear'])->name('adminAddNewAcademicYear');
Route::post('admin-add-new-semester', [AdminController::class, 'adminAddNewSemester'])->name('adminAddNewSemester');



// EMPLOYEE NAVIGATION ROUTES
Route::get('employee-dashboard', [EmployeeController::class, 'employeeDashboard'])->name('employeeDashboard');
Route::get('employee-registration-page', [EmployeeController::class, 'employeeRegistrationPage'])->name('employeeRegistrationPage');
Route::get('employee-application-form-page', [EmployeeController::class, 'employeeApplicationFormPage'])->name('employeeApplicationFormPage');
Route::get('employee-document-submitted-details/{id}', [EmployeeController::class, 'employeeSubmittedDocumentDetail'])->name('employeeSubmittedDocumentDetail');

// EMPLOYEE POST SUBMISSION ROUTES
Route::post('employee-submit-employee-app-form-for-bh', [EmployeeController::class, 'submitEmployeeApplicationFormForBh'])->name('submitEmployeeApplicationFormForBh');


// OPERATOR NAVIGATION ROUTES
Route::get('operator-dashboard', [OperatorController::class, 'operatorDashboard'])->name('operatorDashboard');
Route::get('operator-tenant-list', [OperatorController::class, 'operatorTenantList'])->name('operatorTenantList');
Route::get('operator-room-list', [OperatorController::class, 'operatorRoomList'])->name('operatorRoomList');
Route::get('operator-transaction-list', [OperatorController::class, 'operatorTransactionList'])->name('operatorTransactionList');
Route::get('operator-profile-page/{id}', [OperatorController::class, 'operatorProfilePage'])->name('operatorProfilePage');
Route::get('operator-billings/{id}', [OperatorController::class, 'operatorBhBillings'])->name('operatorBhBillings');
Route::get('operator-transactions/{id}', [OperatorController::class, 'operatorTransactions'])->name('operatorTransactions');
Route::get('operator-document-submissions/{id}', [OperatorController::class, 'operatorDocumentSubmissions'])->name('operatorDocumentSubmissions');
Route::get('operator-tenant-history-list', [OperatorController::class, 'operatorTenantHistoryList'])->name('operatorTenantHistoryList');


// OPERATOR POST SUBMISSION FORMS
Route::post('operator-register-new-tenant', [OperatorController::class, 'operatorRegisterNewTenant'])->name('operatorRegisterNewTenant');
Route::post('operator-register-existing-tenant', [OperatorController::class, 'operatorRegisterExistingTenant'])->name('operatorRegisterExistingTenant');
Route::post('operator-edit-tenant-information', [OperatorController::class, 'operatorEditTenantInformation'])->name('operatorEditTenantInformation');
Route::post('operator-add-new-room', [OperatorController::class, 'operatorAddNewRoom'])->name('operatorAddNewRoom');
Route::post('operator-update-room-detail', [OperatorController::class, 'operatorUpdateRoomDetail'])->name('operatorUpdateRoomDetail');
Route::post('operator-assign-tenant-on-room', [OperatorController::class, 'operatorAssignTenantOnRoom'])->name('operatorAssignTenantOnRoom');
Route::post('operator-tenant-payment', [OperatorController::class, 'operatorTenantPayment'])->name('operatorTenantPayment');
Route::post('operator-remove-tenant', [OperatorController::class, 'operatorRemoveTenant'])->name('operatorRemoveTenant');
Route::post('operator-update-profile', [OperatorController::class, 'operatorUpdateProfile'])->name('operatorUpdateProfile');
Route::post('operator-update-bh-charge-price', [OperatorController::class, 'operatorUpdateBhChargePrice'])->name('operatorUpdateBhChargePrice');
Route::post('operator-add-new-bh-charge', [OperatorController::class, 'operatorAddNewBhCharge'])->name('operatorAddNewBhCharge');
Route::post('operator-add-new-new-bill-template', [OperatorController::class, 'operatorAddNewBillTemplate'])->name('operatorAddNewBillTemplate');
Route::post('operator-generate-tenant-bill', [OperatorController::class, 'operatorGenerateTenantBill'])->name('operatorGenerateTenantBill');
Route::post('operator-submit-tenant-bill-payment', [OperatorController::class, 'operatorSubmitPaymentForTenantBill'])->name('operatorSubmitPaymentForTenantBill');
Route::post('operator-update-tenant-bill-status', [OperatorController::class, 'operatorUpdateTenantBillStatus'])->name('operatorUpdateTenantBillStatus');
Route::post('operator-submit-document-file', [OperatorController::class, 'operatorSubmitDocumentFile'])->name('operatorSubmitDocumentFile');
Route::post('operator-upload-bh-photo', [OperatorController::class, 'operatorUploadBhPhoto'])->name('operatorUploadBhPhoto');
Route::post('operator-delete-bh-photo', [OperatorController::class, 'operatorDeleteBhPhoto'])->name('operatorDeleteBhPhoto');
Route::post('operator-delete-bh-template', [OperatorController::class, 'operatorDeleteBhTemplate'])->name('operatorDeleteBhTemplate');
Route::post('operator-update-bh-room-tenant-clearance-status', [OperatorController::class, 'operatorUpdateBhRoomTenantClearanceStatus'])->name('operatorUpdateBhRoomTenantClearanceStatus');
Route::post('operator-update-history-of-tenant-clearance', [OperatorController::class, 'operatorUpdateHistoryOfTenantClearanceStatus'])->name('operatorUpdateHistoryOfTenantClearanceStatus');
Route::post('operator-update-account-details', [OperatorController::class, 'operatorUpdateAccountDetails'])->name('operatorUpdateAccountDetails');

// OPERATOR API FETCH POST ROUTES
Route::post('operator-api-fetch-programs', [OperatorController::class, 'operatorApiFetchPrograms'])->name('operatorApiFetchPrograms');
Route::post('operator-api-fetch-province', [OperatorController::class, 'operatorApiFetchProvinces'])->name('operatorApiFetchProvinces');
Route::post('operator-api-fetch-cities', [OperatorController::class, 'operatorApiFetchCities'])->name('operatorApiFetchCities');
Route::post('operator-api-fetch-barangays', [OperatorController::class, 'operatorApiFetchBarangays'])->name('operatorApiFetchBarangays');
Route::post('operator-fetch-operator-tenant-list', [OperatorController::class, 'operatorFetchTenantList'])->name('operatorFetchTenantList');
Route::post('operator-fetch-tenant-transactions', [OperatorController::class, 'operatorFetchTenantTransaction'])->name('operatorFetchTenantTransaction');
Route::post('operator-fetch-student-tenants', [OperatorController::class, 'operatorFetchStudentTenants'])->name('operatorFetchStudentTenants');
Route::post('operator-fetch-rooms-for-tenant-assign', [OperatorController::class, 'operatorFetchRoomsForTenantAssigning'])->name('operatorFetchRoomsForTenantAssigning');
Route::post('operator-fetch-student-tenant-history', [OperatorController::class, 'operatorFetchStudentTenantHistory'])->name('operatorFetchStudentTenantHistory');
Route::post('operator-fetch-student-tenant-bills', [OperatorController::class, 'operatorFetchStudentTenantBills'])->name('operatorFetchStudentTenantBills');
Route::post('operator-fetch-bh-rooms', [OperatorController::class, 'operatorFetchBhRooms'])->name('operatorFetchBhRooms');
Route::post('operator-fetch-tenants-on-rooms', [OperatorController::class, 'operatorFetchTenantsOnRoom'])->name('operatorFetchTenantsOnRoom');
Route::post('operator-fetch-bh-charge-history', [OperatorController::class, 'operatorFetchBhChargeHistory'])->name('operatorFetchBhChargeHistory');
Route::post('operator-fetch-template-during-reg', [OperatorController::class, 'operatorFetchTemplatesDuringRegistration'])->name('operatorFetchTemplatesDuringRegistration');
Route::post('operator-fetch-template-during-billing', [OperatorController::class, 'operatorFetchTemplateDuringBilling'])->name('operatorFetchTemplateDuringBilling');
Route::post('operator-fetch-tenant-bill-charge-detail', [OperatorController::class, 'operatorFetchTenantBillChargeDetail'])->name('operatorFetchTenantBillChargeDetail');
Route::post('operator-fetch-room-details-for-editing', [OperatorController::class, 'operatorFetchRoomDetailsForEditing'])->name('operatorFetchRoomDetailsForEditing');
Route::post('operator-fetch-document-submissions', [OperatorController::class, 'operatorFetchDocumentSubmission'])->name('operatorFetchDocumentSubmission');
Route::post('operator-fetch-history-of-tenants', [OperatorController::class, 'operatorFetchHistoryOfTenants'])->name('operatorFetchHistoryOfTenants');


// DORM MANAGER NAVIGATION ROUTES
Route::get('dorm-manager-dashboard', [DormManagerController::class, 'dormManagerDashboard'])->name('dormManagerDashboard');
Route::get('dorm-manager-tenant-list', [DormManagerController::class, 'dormManagerTenantList'])->name('dormManagerTenantList');
Route::get('dorm-manager-dorm-rooms-list', [DormManagerController::class, 'dormManagerRoomList'])->name('dormManagerRoomList');
Route::get('dorm-manager-billings/{id}', [DormManagerController::class, 'dormManagerBillings'])->name('dormManagerBillings');
Route::get('dorm-manager-transactions/{id}', [DormManagerController::class, 'dormManagerTransactions'])->name('dormManagerTransactions');
Route::get('dorm-mananger-tenant-profile/{id}', [DormManagerController::class, 'dormManagerTenantProfile'])->name('dormManagerTenantProfile');
Route::get('dorm-manager-profile-page/{id}', [DormManagerController::class, 'dormManagerProfilePage'])->name('dormManagerProfilePage');
Route::get('dorm-manager-history-of-tenant-list', [DormManagerController::class, 'dormManagerHistoryOfTenantList'])->name('dormManagerHistoryOfTenantList');

// DORM MANAGER POST SUBMISSION ROUTES
Route::post('dorm-manager-add-new-room', [DormManagerController::class, 'dormManagerAddNewRoom'])->name('dormManagerAddNewRoom');
Route::post('dorm-manager-update-room-details', [DormManagerController::class, 'dormManagerUpdateRoomDetail'])->name('dormManagerUpdateRoomDetail');
Route::post('dorm-manager-add-dorm-charge', [DormManagerController::class, 'dormManagerAddDormCharge'])->name('dormManagerAddDormCharge');
Route::post('dorm-manager-update-dorm-charge-price', [DormManagerController::class, 'dormManagerUpdateDormChargePrice'])->name('dormManagerUpdateDormChargePrice');
Route::post('dorm-manager-add-new-dorm-charge-template', [DormManagerController::class, 'dormManagerAddNewDormChargeTemplate'])->name('dormManagerAddNewDormChargeTemplate');
Route::post('dorm-manager-register-existing-tenant', [DormManagerController::class, 'dormManagerRegisterExistingTenant'])->name('dormManagerRegisterExistingTenant');
Route::post('dorm-manager-generate-bill-for-tenant', [DormManagerController::class, 'dormManagerGenerateBillForTenant'])->name('dormManagerGenerateBillForTenant');
Route::post('dorm-manager-update-tenant-bill-status', [DormManagerController::class, 'dormManagerUpdateTenantBillStatus'])->name('dormManagerUpdateTenantBillStatus');
Route::post('dorm-manager-submit-tenant-bill-payment', [DormManagerController::class, 'dormManagerSubmitTenantBillPayment'])->name('dormManagerSubmitTenantBillPayment');
Route::post('dorm-manager-remove-tenant', [DormManagerController::class, 'dormManagerRemoveTenant'])->name('dormManagerRemoveTenant');
Route::post('dorm-manager-update-tenant-clearance-status', [DormManagerController::class, 'dormManagerUpdateBhRoomTenantClearanceStatus'])->name('dormManagerUpdateBhRoomTenantClearanceStatus');
Route::post('dorm-manager-register-new-tenant', [DormManagerController::class, 'dormManagerRegisterNewTenant'])->name('dormManagerRegisterNewTenant');
Route::post('dorm-manager-update-tenant-profile', [DormManagerController::class, 'dormManagerUpdateTenantProfile'])->name('dormManagerUpdateTenantProfile');
Route::post('dorm-manager-history-tenant-tenant-update-clearance', [DormManagerController::class, 'dormManagerUpdateHistoryOfTenantClearanceStatus'])->name('dormManagerUpdateHistoryOfTenantClearanceStatus');
Route::post('dorm-manager-delete-bill-template', [DormManagerController::class, 'dormManagerDeleteBhTemplate'])->name('dormManagerDeleteBhTemplate');
Route::post('dorm-manager-upload-photo', [DormManagerController::class, 'dormManagerUploadBhPhoto'])->name('dormManagerUploadBhPhoto');
Route::post('dorm-manager-delete-photo', [DormManagerController::class, 'dormManagerDeleteBhPhoto'])->name('dormManagerDeleteBhPhoto');


// DORM MANAGER POST FETCH ROUTES
Route::post('dorm-manager-fetch-student-tenant-list', [DormManagerController::class, 'dormManagerFetchTenantList'])->name('dormManagerFetchTenantList');
Route::post('dorm-manager-fetch-dorm-rooms', [DormManagerController::class, 'dormManagerFetchDormRooms'])->name('dormManagerFetchDormRooms');
Route::post('dorm-manager-fetch-tenants-on-room', [DormManagerController::class, 'dormManagerFetchDormRoomTenants'])->name('dormManagerFetchDormRoomTenants');
Route::post('dorm-manager-fetch-room-details-for-editing', [DormManagerController::class, 'dormManagerFetchRoomDetailsForEditing'])->name('dormManagerFetchRoomDetailsForEditing');
Route::post('dorm-manager-fetch-dorm-charge-price-history', [DormManagerController::class, 'dormManagerFetchBhChargeHistory'])->name('dormManagerFetchBhChargeHistory');
Route::post('dorm-manager-fetch-student-tenants', [DormManagerController::class, 'dormManagerFetchStudentTenants'])->name('dormManagerFetchStudentTenants');
Route::post('dorm-manager-fetch-rooms-for-tenant-assigning', [DormManagerController::class, 'dormManagerFetchRoomsForTenantAssigning'])->name('dormManagerFetchRoomsForTenantAssigning');
Route::post('dorm-manager-fetch-dorm-template-during-billing', [DormManagerController::class, 'dormManagerFetchDormTemplateDuringBilling'])->name('dormManagerFetchDormTemplateDuringBilling');
Route::post('dorm-manager-fetch-tenant-profile-bills', [DormManagerController::class, 'dormManagerFetchStudentTenantBills'])->name('dormManagerFetchStudentTenantBills');
Route::post('dorm-manager-fetch-tenant-bill-info', [DormManagerController::class, 'dormManagerFetchTenantBillInfo'])->name('dormManagerFetchTenantBillInfo');
Route::post('dorm-manager-fetch-history-of-tenant-list', [DormManagerController::class, 'dormManagerFetchHistoryOfTenantList'])->name('dormManagerFetchHistoryOfTenantList');




// UHRC
// UHRC NAVIGATION ROUTES

// UHRC NAVIGATION ROUTES
Route::get('uhrc-dashboard', [UhrcController::class, 'uhrcDashboard'])->name('uhrcDashboard');
Route::get('uhrc-boarding-houses-list', [UhrcController::class, 'uhrcBoardingHousesList'])->name('uhrcBoardingHousesList');
Route::get('uhrc-dormitories-list', [UhrcController::class, 'uhrcDormitoriesList'])->name('uhrcDormitoriesList');
Route::get('uhrc-interactive-map', [UhrcController::class, 'uhrcInteractiveMap'])->name('uhrcInteractiveMap');
Route::get('uhrc-boarding-house-details/{id}', [UhrcController::class, 'uhrcBoardingHouseDetails'])->name('uhrcBoardingHouseDetails');
Route::get('uhrc-dormitory-details/{id}', [UhrcController::class, 'uhrcDormitoryDetails'])->name('uhrcDormitoryDetails');
Route::get('uhrc-reporting', [UhrcController::class, 'uhrcReporting'])->name('uhrcReporting');
Route::get('uhrc-government-bh-report/{id}', [UhrcController::class, 'uhrcGovernmentBhReport'])->name('uhrcGovernmentBhReport');
Route::get('uhrc-private-bh-report/{id}', [UhrcController::class, 'uhrcPrivateBhReport'])->name('uhrcPrivateBhReport');
Route::get('uhrc-new-interactive-map', [UhrcController::class, 'uhrcNewInteractiveMap'])->name('uhrcNewInteractiveMap');

Route::get('uhrc-employee-registration-request-detail/{id}', [UhrcController::class, 'uhrcRegistratoionRequestDetails'])->name('uhrcRegistratoionRequestDetails');

Route::get('uhrc-pending-registration-requests', [UhrcController::class, 'uhrcPendingRegistrationRequests'])->name('uhrcPendingRegistrationRequests');
Route::get('uhrc-approved-registration-requests', [UhrcController::class, 'uhrcApprovedRegistrationRequests'])->name('uhrcApprovedRegistrationRequests');
Route::get('uhrc-rejected-registration-requests', [UhrcController::class, 'uhrcRejectedRegistrationRequests'])->name('uhrcRejectedRegistrationRequests');
Route::get('uhrc-profile-page/{id}', [UhrcController::class, 'uhrcProfilePage'])->name('uhrcProfilePage');
Route::get('/view-uploaded-bh-photo', [UhrcController::class, 'showUploadedBhPhoto'])->name('show_uploaded_bh_photo');


// UHRC FETCH POST ROUTES
Route::post('uhrc-fetch-boarding-houses', [UhrcController::class, 'uhrcFetchBoardingHouses'])->name('uhrcFetchBoardingHouses');
Route::post('uhrc-fetch-boarding-house-tenants', [UhrcController::class, 'uhrcFetchBoardingHouseTenants'])->name('uhrcFetchBoardingHouseTenants');
Route::post('uhrc-fetch-dormitories', [UhrcController::class, 'uhrcFetchDormitories'])->name('uhrcFetchDormitories');
Route::post('uhrc-fetch-dormitory-tenants', [UhrcController::class, 'uhrcFetchDormitoryTenants'])->name('uhrcFetchDormitoryTenants');
Route::post('uhrc-fetch-pending-registration-requests', [UhrcController::class, 'uhrcFetchPendingRegistrationRequests'])->name('uhrcFetchPendingRegistrationRequests');
Route::post('uhrc-fetch-approved-registration-requests', [UhrcController::class, 'uhrcFetchApprovedRegistrationRequests'])->name('uhrcFetchApprovedRegistrationRequests');
Route::post('uhrc-fetch-rejected-registration-requests', [UhrcController::class, 'uhrcFetchRejectedRegistrationRequests'])->name('uhrcFetchRejectedRegistrationRequests');
Route::post('uhrc-update-employee-registration-request', [UhrcController::class, 'uhrcUpdateEmployeeRegistrationRequest'])->name('uhrcUpdateEmployeeRegistrationRequest');
Route::post('uhrc-update-profile', [UhrcController::class, 'uhrcUpdateProfile'])->name('uhrcUpdateProfile');
Route::post('uhrc-fetch-boarding-houses-for-interactive-map', [UhrcController::class, 'uhrcFetchBoardingHouseForInteractiveMap'])->name('uhrcFetchBoardingHouseForInteractiveMap');
Route::post('uhrc-fetch-dormitories-for-interactive-map', [UhrcController::class, 'uhrcFetchDormitoriesForInteractiveMap'])->name('uhrcFetchDormitoriesForInteractiveMap');
Route::post('uhrc-fetch-boarding-house-photos', [UhrcController::class, 'uhrcFetchBoardingHousePhotos'])->name('uhrcFetchBoardingHousePhotos');
Route::post('uhrc-fetch-dormitory-photos', [UhrcController::class, 'uhrcFetchDormitoryPhotos'])->name('uhrcFetchDormitoryPhotos');

//ASSOC NAVIGATION ROUTESA
Route::get('assoc-dashboard', [AssocController::class, 'assocDashboard'])->name('assocDashboard');
Route::get('assoc-boarding-houses-list', [AssocController::class, 'assocBoardingHousesList'])->name('assocBoardingHousesList');
Route::get('assoc-interactive-map', [AssocController::class, 'assocInteractiveMap'])->name('assocInteractiveMap');
Route::get('assoc-profile-page/{id}', [AssocController::class, 'assocProfilePage'])->name('assocProfilePage');
Route::get('assoc-edit-profile-page/{id}', [AssocController::class, 'assocEditProfilePage'])->name('assocEditProfilePage');
Route::get('assoc-new-interactive-map', [AssocController::class, 'assocNewInteractiveMap'])->name('assocNewInteractiveMap');
// ASSOC FETCH POST ROUTES
Route::post('assoc-fetch-boarding-houses', [AssocController::class, 'assocFetchBoadingHouses'])->name('assocFetchBoadingHouses');
Route::post('assoc-fetch-boarding-house-tenants', [AssocController::class, 'assocFetchBoardingHouseTenants'])->name('assocFetchBoardingHouseTenants');
Route::post('assoc-update-profile', [AssocController::class, 'assocUpdateProfile'])->name('assocUpdateProfile');
Route::post('assoc-fetch-dormitories-for-interactive-map', [AssocController::class, 'assocFetchDormitoriesForInteractiveMap'])->name('assocFetchDormitoriesForInteractiveMap');
Route::post('assoc-fetch-boarding-house-photos', [AssocController::class, 'assocFetchBoardingHousePhotos'])->name('assocFetchBoardingHousePhotos');
Route::post('assoc-fetch-dormitory-photos', [AssocController::class, 'assocFetchDormitoryPhotos'])->name('assocFetchDormitoryPhotos');
//OSA NAVIGATION ROUTES
Route::get('osa-dashboard', [OsaController::class, 'osaDashboard'])->name('osaDashboard');
Route::get('osa-dormitories', [OsaController::class, 'osaDormitories'])->name('osaDormitories');
Route::get('osa-students', [OsaController::class, 'osaStudents'])->name('osaStudents');
Route::get('osa-interactive-map', [OsaController::class, 'osaInteractiveMap'])->name('osaInteractiveMap');
Route::get('osa-register-new-dormitory', [OsaController::class, 'osaRegisterNewDormitory'])->name('osaRegisterNewDormitory');
Route::get('osa-dormitory-details/{id}', [OsaController::class, 'osaDormitoryDetails'])->name('osaDormitoryDetails');
Route::get('osa-student-profile/{id}', [OsaController::class, 'osaStudentProfile'])->name('osaStudentProfile');
Route::get('osa-profile-page/{id}', [OsaController::class, 'osaProfilePage'])->name('osaProfilePage');
Route::get('osa-reporting', [OsaController::class, 'osaReporting'])->name('osaReporting');
Route::get('osa-new-interactive-map', [OsaController::class, 'osaNewInteractiveMap'])->name('osaNewInteractiveMap');

// OSA POST SUBMISSION FORMS
Route::post('osa-dormitory-registration', [OsaController::class, 'osaDormRegistrationForm'])->name('osaDormRegistrationForm');

//OSA FETCH POST ROUTES
Route::post('osa-fetch-dormitories', [OsaController::class, 'osaFetchDormitories'])->name('osaFetchDormitories');
Route::post('osa-fetch-dormitories-map', [OsaController::class, 'osaFetchDormitoriesMap'])->name('osaFetchDormitoriesMap');

Route::post('osa-fetch-boarding-houses', [OsaController::class, 'osaFetchBoadingHouses'])->name('osaFetchBoadingHouses');

Route::post('osa-fetch-employee-id-for-registration', [OsaController::class, 'osaFetchEmployeeIdForRegistration'])->name('osaFetchEmployeeIdForRegistration');
Route::post('osa-fetch-student-masterlist', [OsaController::class, 'osaFetchStudentMasterList'])->name('osaFetchStudentMasterList');
Route::post('osa-update-profile', [OsaController::class, 'osaUpdateProfile'])->name('osaUpdateProfile');
Route::post('osa-submit-update-tenant-clearance-status', [OsaController::class, 'osaSubmitUpdateTenantClearanceStatus'])->name('osaSubmitUpdateTenantClearanceStatus');
Route::post('osa-fetch-boarding-houses-for-interactive-map', [OsaController::class, 'osaFetchBoardingHouseForInteractiveMap'])->name('osaFetchBoardingHouseForInteractiveMap');
Route::post('osa-fetch-dormitories-for-interactive-map', [OsaController::class, 'osaFetchDormitoriesForInteractiveMap'])->name('osaFetchDormitoriesForInteractiveMap');
Route::post('osa-fetch-boarding-house-photos', [OsaController::class, 'osaFetchBoardingHousePhotos'])->name('osaFetchBoardingHousePhotos');
Route::post('osa-fetch-dormitory-photos', [OsaController::class, 'osaFetchDormitoryPhotos'])->name('osaFetchDormitoryPhotos');