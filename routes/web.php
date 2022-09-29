<?php

use App\Models\State;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'frontend.home')->name('home');
Route::view('how-it-works','frontend.howItWorks')->name('how-it-works');
Route::view('about-the-programmes','frontend.aboutTheProgrammes')->name('about-the-programmes');// blade file m url:: to kr k url access krege
Route::view('downloads','frontend.downloads')->name('downloads');
Route::view('faqs','frontend.faqs')->name('faqs');
Route::view('privacy-policy','frontend.privacyPolicy')->name('privacy-policy');
Route::view('terms-of-use','frontend.termsOfUse')->name('terms-of-use');
Route::view('contact-us','frontend.contactUs')->name('contact-us');
Route::view('sandes','frontend.sandes')->name('sandes');
//Route::view('register','auth.register')->name('register');
Route::post('/get_distictbystate', 'HomeController@get_distictbystate');
Route::match(['post', 'get'], 'register-user', 'HomeController@registerUser');
Route::match(['post', 'get'], 'consumer-interest-form', 'HomeController@consumerInterestForm');

Auth::routes();


// Manufacturer Routes
Route::group(['prefix' => 'users', 'as' => 'users.', 'namespace' => 'Backend\Users', 'middleware' => 'auth:manufaturer_users'], function () {
    Route::get('/', 'MainController@index')->name('dashboard');
    Route::match(['get', 'post'], '/edit-profile', 'MainController@editProfile');
    Route::match(['get', 'post'], '/change-password', 'MainController@changePassword');

    Route::match(['get', 'post'], '/module-master','MainController@addModule');
    Route::get('/module-master/add', 'MainController@addNewModule');

    Route::get('user-applications', 'MainController@userApplication');
    Route::get('new-application/{id}', 'MainController@newApplication');
    Route::match(['get', 'post'], '/new-application', 'MainController@newApplication');

    Route::get('new-application-step2/{id}', 'MainController@newApplicationStep2');
    Route::match(['get', 'post'], '/new-application-step2', 'MainController@newApplicationStep2');
    
    Route::match(['get', 'post'], '/annexure-one', 'MainController@annexure1');
    Route::get('annexure-one/{id}', 'MainController@annexure1');
    Route::get('annexure-one/{id}/{edit_id}', 'MainController@annexure1');

    Route::match(['get', 'post'], '/annexure-one-b', 'MainController@annexure1_1');
    Route::get('annexure-one-b/{id}', 'MainController@annexure1_1');
    Route::get('annexure-one-b/{id}/{edit_id}', 'MainController@annexure1_1');

    Route::match(['get', 'post'], '/annexure-one-c', 'MainController@annexure1_3');
    Route::get('annexure-one-c/{id}', 'MainController@annexure1_3');
    Route::get('annexure-one-c/{id}/{edit_id}', 'MainController@annexure1_3');

    Route::match(['get', 'post'], '/annexure-two', 'MainController@annexureTwo');
    Route::get('annexure-two/{id}', 'MainController@annexureTwo');
    Route::get('annexure-two/{id}/{edit_id}', 'MainController@annexureTwo');

    Route::match(['get', 'post'], '/annexure-three', 'MainController@annexureThree');
    Route::get('annexure-three/{id}', 'MainController@annexureThree');
    Route::get('annexure-three/{id}/{edit_id}', 'MainController@annexureThree');


    Route::match(['get', 'post'], '/annexure-four', 'MainController@annexureFour');
    Route::get('annexure-four/{id}', 'MainController@annexureFour');

    Route::match(['get', 'post'], '/annexure-four-two', 'MainController@annexureFourTwo');
    Route::get('annexure-four-two/{id}', 'MainController@annexureFourTwo');
    Route::get('annexure-four-two/{id}/{edit_id}', 'MainController@annexureFourTwo');

    Route::match(['get', 'post'], '/annexure-four-three', 'MainController@annexureFourThree');
    Route::get('annexure-four-three/{id}', 'MainController@annexureFourThree');
    Route::get('annexure-four-three/{id}/{edit_id}', 'MainController@annexureFourThree');

    Route::match(['get', 'post'], '/annexure-four-four', 'MainController@annexureFourFour');
    Route::get('annexure-four-four/{id}', 'MainController@annexureFourFour');
    Route::get('annexure-four-four/{id}/{edit_id}', 'MainController@annexureFourFour');

    Route::match(['get', 'post'], '/annexure-four-five', 'MainController@annexureFourFive');
    Route::get('annexure-four-five/{id}', 'MainController@annexureFourFive');
    Route::get('annexure-four-five/{id}/{edit_id}', 'MainController@annexureFourFive');

    Route::match(['get', 'post'], '/annexure-seven', 'MainController@annexureSeven');
    Route::get('annexure-seven/{id}', 'MainController@annexureSeven');

    Route::match(['get', 'post'], '/annexure-eight', 'MainController@annexureEight');
    Route::get('annexure-eight/{id}', 'MainController@annexureEight');

    Route::match(['get', 'post'], '/annexure-attachment', 'MainController@annexureAttachment');
    Route::get('annexure-attachment/{id}', 'MainController@annexureAttachment');
    Route::get('annexure-attachment/{annexure_id}/{id}', 'MainController@deleteAttachment');

    Route::match(['get', 'post'], '/application-submission', 'MainController@applicationSubmission');
    Route::get('application-submission/{id}', 'MainController@applicationSubmission');

    Route::get('delete-annexure/{annexure_id}/{id}', 'MainController@deleteAnnexure');
    Route::get('preview-docs/{folder}/{file}', 'MainController@previewDocs');

    //Download Application Route
    Route::get('download-application/{id}', 'MainController@downloadApplication');
    
    Route::any('view-application/{id}', 'MainController@viewApplication');
    Route::any('track-detail/{id}', 'MainController@trackDetail');
    Route::post('changeScheduleDate', 'MainController@requestToChangeScheduleDate');
    //

    //vivek
    Route::match(['get', 'post'], '/annexure-five', 'MainController@annexureFive');
    Route::get('annexure-five/{id}', 'MainController@annexureFive');
    Route::get('annexure-five/{id}/{edit_id}', 'MainController@annexureFive');
    Route::get('annexure-five-delete/{annexure_id}/{id}', 'MainController@deleteAnnexure5');

    Route::match(['get', 'post'], '/annexure-six', 'MainController@annexureSix');
    Route::get('annexure-six/{id}', 'MainController@annexureSix');
    Route::get('annexure-six/{id}/{edit_id}', 'MainController@annexureSix');
    Route::get('annexure-six-delete/{annexure_id}/{id}', 'MainController@deleteAnnexure6');
    //vivek

    //Raushan
    Route::match(['get', 'post'], '/select-exising-application', 'ExistingModelController@selectExisingApplication');
    Route::get('/select-exising-application/{id}', 'ExistingModelController@selectExisingApplication');
    
    Route::match(['get', 'post'], '/existing-application', 'ExistingModelController@ExistingApplication');
    Route::get('existing-application/{id}', 'ExistingModelController@ExistingApplication');

    Route::match(['get', 'post'], '/existing-application-step2', 'ExistingModelController@ExistingApplicationStep2');
    Route::get('existing-application-step2/{id}', 'ExistingModelController@ExistingApplicationStep2');
    

    Route::match(['get', 'post'], '/existing-annexure-one', 'ExistingModelController@existingannexure1');
    Route::get('existing-annexure-one/{id}', 'ExistingModelController@existingannexure1');
    Route::get('existing-annexure-one/{id}/{edit_id}', 'ExistingModelController@existingannexure1');

    Route::match(['get', 'post'], '/existing-annexure-one-b', 'ExistingModelController@existingannexure1_1');
    Route::get('existing-annexure-one-b/{id}', 'ExistingModelController@existingannexure1_1');
    Route::get('existing-annexure-one-b/{id}/{edit_id}', 'ExistingModelController@existingannexure1_1');




    
 
    
});
// INSPECTOR Routes
Route::group(['prefix' => 'inspector', 'as' => 'inspector.', 'namespace' => 'Backend\Inspector', 'middleware' => 'auth:inspector'], function () {
    Route::get('/', 'MainController@index')->name('dashboard');
    Route::match(['get', 'post'], '/edit-profile', 'MainController@editProfile');
    Route::match(['get', 'post'], '/change-password', 'MainController@changePassword');

    Route::any('systems', 'MainController@systems');
    Route::any('add-edit-system/{id}', 'MainController@addEditSystem');
    Route::post('update-inspection/{id}', 'MainController@updateInspection');

    Route::get('preview-docs/{consumerId}/{folder}/{file}/{maintenanceCode?}', 'MainController@previewDocs');
    Route::get('download-docs/{consumerId}/{folder}/{file}/{maintenanceCode?}', 'MainController@downloadDoc');
});


// MNRE Routes
Route::group(['prefix' => 'mnre', 'as' => 'mnre.', 'namespace' => 'Backend\Mnre', 'middleware' => 'auth:mnre'], function () {
    Route::get('/', 'MainController@index')->name('dashboard');
    Route::post('forwardto', 'MainController@forwardto');
    Route::match(['get', 'post'], '/edit-profile', 'MainController@editProfile');
    Route::match(['get', 'post'], '/change-password', 'MainController@changePassword');

    Route::get('preview-docs/{folder}/{file}', 'MainController@previewDocs');

    /************* Audit Trail*******Added by Ekta**********/
    Route::match(['get', 'post'],'/audit-trail','MainController@userAuditTrail')->name('audit.trail');
    /************* Audit Trail*******************/
    Route::get('mnre-user-list', 'MainController@mnreUsers');
    Route::any('create-mnre-user', 'MainController@createMnreUser');
    Route::any('edit-mnre-user/{id}', 'MainController@editMnreUser');
    //Vivek
     Route::get('manufaturer-user-list', 'MainController@manufaturerUsers');
     Route::any('reset-password', 'MainController@resetPassword');
     Route::get('applications-list', 'MainController@UserApplications');
     Route::any('view-application/{id}', 'MainController@viewApplication');
     Route::any('track-detail/{id}', 'MainController@trackDetail');
    //Vivek
});

// MNRE Routes End

// NISE Routes Start
Route::group(['prefix' => 'nise', 'as' => 'nise.', 'namespace' => 'Backend\Nise', 'middleware' => 'auth:nise'], function () {
     Route::get('/', 'MainController@index')->name('dashboard');
     Route::match(['get', 'post'], '/edit-profile', 'MainController@editProfile');
     Route::match(['get', 'post'], '/change-password', 'MainController@changePassword');
     Route::get('manufaturer-user-list', 'MainController@manufaturerUsers');
     Route::any('reset-password', 'MainController@resetPassword');
     Route::get('applications-list', 'MainController@UserApplications');
     Route::any('view-application/{id}', 'MainController@viewApplication');
     Route::any('track-detail/{id}', 'MainController@trackDetail');
     Route::post('forwardto', 'MainController@forwardto');
     Route::post('scheduleInspection', 'MainController@scheduleInspection');
     Route::get('preview-docs/{folder}/{file}', 'MainController@previewDocs');

     Route::match(['get', 'post'], '/application-fee-master', 'MasterController@index');
});
// NISE Routes End


// STATE IMPLEMENTING AGENCY Routes
Route::group(['prefix' => 'state-implementing-agency', 'as' => 'state-implementing-agency.', 'namespace' => 'Backend\SIA', 'middleware' => 'auth:state-implementing-agency'], function () {
    Route::get('/', 'MainController@index')->name('dashboard');
    Route::match(['get', 'post'], '/edit-profile', 'MainController@editProfile');
    Route::match(['get', 'post'], '/change-password', 'MainController@changePassword');

    Route::get('localbody-list', 'MainController@localbodyList');
    Route::match(['get', 'post'], 'create-localbody', 'MainController@createLocalbody');
    Route::get('localbody/{id}/edit', 'MainController@localbodyEdit');
    Route::get('localbody-detail/{id}', 'MainController@localbodyDetail');

    Route::any('installer-list', 'MainController@installerList');
    Route::match(['get', 'post'], 'create-installer', 'MainController@createInstaller');
    Route::get('installer-detail/{id}', 'MainController@installerDetail');
    Route::get('installer/{id}/edit', 'MainController@installerEdit');
    Route::get('installer-association/{id}', 'MainController@installerAssociation');
    Route::get('installer-blacklist/{id}', 'MainController@installerBlacklist');

    Route::any('inspector-list', 'MainController@inspectorList');
    Route::match(['get', 'post'], 'create-inspector', 'MainController@createInspector');
    Route::get('inspector-detail/{id}', 'MainController@inspectorDetail');
    Route::get('inspector/{id}/edit', 'MainController@inspectorEdit');
    Route::get('inspector-association/{id}', 'MainController@inspectorAssociation');
    Route::get('inspector-blacklist/{id}', 'MainController@inspectorBlacklist');

    Route::any('consumer-list/', 'MainController@consumerList');
    Route::get('consumer-detail/{id}', 'MainController@consumerDetail');
    Route::get('consumer-request/{id}/approval', 'MainController@consumerRequestApproval');
    Route::post('consumer/{id}/installer-association', 'MainController@consumerInstallerAssociation');

    Route::any('systems', 'MainController@systems');
    Route::any('add-edit-system/{id}', 'MainController@addEditSystem');
    Route::get('system/{id}/{action}', 'MainController@systemAction');
    Route::post('system/{id}/modifications', 'MainController@systemModification');
    Route::post('system-allot-inspector/{systemId}', 'MainController@allotInspectorToSystem');
    Route::get('system/{id}/complete/{action}', 'MainController@systemFinalAction');

    Route::post('modification-feedback', 'MainController@modificationFeedback');

    Route::get('preview-docs/{consumerId}/{folder}/{file}/{maintenanceCode?}', 'MainController@previewDocs');
    Route::get('download-docs/{consumerId}/{folder}/{file}/{maintenanceCode?}', 'MainController@downloadDoc');

    Route::any('system-maintenance', 'MainController@systemMaintenance');
    Route::any('maintenance-records/{systemId}', 'MainController@maintenanceRecords');
    Route::any('maintenance-record/{maintenanceId}', 'MainController@maintenanceRecordDetail');
});


// LOCALBODY Routes
Route::group(['prefix' => 'localbody', 'as' => 'localbody.', 'namespace' => 'Backend\Localbody', 'middleware' => 'auth:localbody'], function () {
    Route::get('/', 'MainController@index')->name('dashboard');
    Route::match(['get', 'post'], '/edit-profile', 'MainController@editProfile');
    Route::match(['get', 'post'], '/change-password', 'MainController@changePassword');

    Route::any('installer-list', 'MainController@installerList');
    Route::any('inspector-list', 'MainController@inspectorList');
    Route::get('installer-detail/{id}', 'MainController@installerDetail');
    Route::get('inspector-detail/{id}', 'MainController@inspectorDetail');

    Route::any('consumer-list/', 'MainController@consumerList');
    Route::get('consumer-detail/{id}', 'MainController@consumerDetail');

    Route::any('systems', 'MainController@systems');
    Route::any('add-edit-system/{id}', 'MainController@addEditSystem');

    Route::any('system-maintenance', 'MainController@systemMaintenance');
    Route::any('maintenance-records/{systemId}', 'MainController@maintenanceRecords');
    Route::any('maintenance-record/{maintenanceId}', 'MainController@maintenanceRecordDetail');

    Route::get('preview-docs/{consumerId}/{folder}/{file}/{maintenanceCode?}', 'MainController@previewDocs');
    Route::get('download-docs/{consumerId}/{folder}/{file}/{maintenanceCode?}', 'MainController@downloadDoc');
});


// INSTALLER Routes
Route::group(['prefix' => 'installer', 'as' => 'installer.', 'namespace' => 'Backend\Installer', 'middleware' => 'auth:installer'], function () {
    Route::get('/', 'MainController@index')->name('dashboard');
    Route::match(['get', 'post'], '/edit-profile', 'MainController@editProfile');
    Route::match(['get', 'post'], '/change-password', 'MainController@changePassword');

    Route::match(['post', 'get'], 'consumer-interest-form', 'MainController@consumerInterestForm');

    Route::any('systems', 'MainController@systems');
    Route::any('add-edit-system/{id}', 'MainController@addEditSystem');

    Route::get('preview-docs/{consumerId}/{folder}/{file}/{maintenanceCode?}', 'MainController@previewDocs');
    Route::get('download-docs/{consumerId}/{folder}/{file}/{maintenanceCode?}', 'MainController@downloadDoc');

    Route::any('system-maintenance', 'MainController@systemMaintenance');
    Route::any('maintenance-records/{systemId}', 'MainController@maintenanceRecords');
    Route::any('maintenance-record/{maintenanceId}', 'MainController@maintenanceRecordDetail');
});





Route::group(['prefix' => 'ajax'], function () {
    Route::get('fetchCities/{state}', 'AjaxController@getDistrictsByState');
    Route::get('fetchSubDistricts/{district}', 'AjaxController@getSubDistrictsByDistrict');
    Route::get('fetchSubDistrictsByVillage/{village}', 'AjaxController@fetchSubDistrictsByVillage');
    Route::get('fetchDistrictBySubDiscrict/{subDistrict}', 'AjaxController@fetchDistrictBySubDiscrict');
    Route::get('fetchStateByDiscrict/{district}', 'AjaxController@fetchStateByDiscrict');
    Route::get('setOrEditPriority/{systemId}/{priority}', 'AjaxController@setOrEditPriority');
    
    Route::post('addEditSystem', 'AjaxController@addEditSystem');
    Route::get('getLatLong/{address}','AjaxController@getLocation');
});

/************************testing*******************/
Route::match(['post', 'get'], 'reset-user-password','ResetPassController@sendOtpToUser')->name('reset.password');
//Route::get("/reset-user-password",'ResetPassController@reset_password_user')->name('reset.password');
//Route::post("/send-otp-user",'ResetPassController@sendOtpToUser');

Route::match(['post' , 'get'],'verify-otp','ResetPassController@checkOtp');
// Route::get("/verify-otp",'ResetPassController@verifyOtp');
// Route::post("/check-otp",'ResetPassController@checkOtp');

Route::match(['post','get'],'change-password','ResetPassController@updatePassword');

// Route::get("/change-password",'ResetPassController@changePassword');
// Route::post("/update-password",'ResetPassController@updatePassword');
Route::get('/linkstorage',function(){
    Artisan::call('storage:link');
});