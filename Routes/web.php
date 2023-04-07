<?php

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

Route::prefix('staff_management')->middleware(['auth', 'admin:staffmanagement'])->group(function () {

    // Home Route
    Route::get('/', 'HomeController@index')->name('staffmanagement.module');

    // Registration
    Route::get('staff/create', 'RegistrationController@create')->name('staff.create');
    Route::get('staff/create/profile', 'RegistrationController@profile')->name('staff.create.profile');
    Route::get('staff/create/employment', 'RegistrationController@employment')->name('staff.create.employment');
    Route::get('staff/create/supervisor', 'RegistrationController@supervisor')->name('staff.create.supervisor');
    Route::get('staff/create/spouse', 'RegistrationController@spouse')->name('staff.create.spouse');
    Route::get('staff/create/kinsman', 'RegistrationController@kinsman')->name('staff.create.kinsman');
    Route::get('staff/create/dependants', 'RegistrationController@dependants')->name('staff.create.dependants');
    Route::get('staff/create/experience', 'RegistrationController@experience')->name('staff.create.experience');
    Route::get('staff/create/qualifications', 'RegistrationController@qualifications')->name('staff.create.qualifications');
    Route::get('staff/create/awards', 'RegistrationController@awards')->name('staff.create.awards');
    Route::get('staff/create/referees', 'RegistrationController@referees')->name('staff.create.referees');
    Route::get('staff/create/documents', 'RegistrationController@documents')->name('staff.create.documents');
    Route::get('staff/create/cancel', 'RegistrationController@cancel')->name('staff.create.cancel');
    Route::get('staff/create/finish', 'RegistrationController@finish')->name('staff.create.finish');

    //Search Staff
    Route::get('staff/search', 'SearchController@search')->name('staff.search');

    // Staff Record
    Route::get('staff/list', 'StaffController@index')->name('staff.index');
    Route::get('staff/{staff}', 'StaffController@show')->name('staff.show');
    Route::get('staff/{staff}/delete', 'StaffController@destroy')->name('staff.destroy');
    Route::get('staff/{staff}/export', 'StaffController@export')->name('staff.export');
    Route::get('staff/{staff}/personal-info', 'StaffController@profile')->name('staff.show.profile');
    Route::get('staff/{staff}/employment', 'StaffController@employment')->name('staff.show.employment');
    Route::get('staff/{staff}/supervisor', 'StaffController@supervisor')->name('staff.show.supervisor');
    Route::get('staff/{staff}/spouse', 'StaffController@spouse')->name('staff.show.spouse');
    Route::get('staff/{staff}/kinsman', 'StaffController@kinsman')->name('staff.show.kinsman');
    Route::get('staff/{staff}/dependants', 'StaffController@dependants')->name('staff.show.dependants');
    Route::get('staff/{staff}/experience', 'StaffController@experience')->name('staff.show.experience');
    Route::get('staff/{staff}/qualifications', 'StaffController@qualifications')->name('staff.show.qualifications');
    Route::get('staff/{staff}/awards', 'StaffController@awards')->name('staff.show.awards');
    Route::get('staff/{staff}/referees', 'StaffController@referees')->name('staff.show.referees');
    Route::get('staff/{staff}/documents', 'StaffController@documents')->name('staff.show.documents');
    Route::get('staff/{staff}/progress', 'StaffController@progress')->name('staff.show.progress');


    // Identity
    Route::get('identity', 'IdentityController@index')->name('identity.index');
    Route::get('identity/{staff}', 'IdentityController@show')->name('identity.show');
    Route::get('identity/{staff}/id-card', 'IdentityController@card')->name('identity.card');

    // Employment Confirmation
    Route::get('confirmation', 'ConfirmationController@index')->name('confirmation.index');
    Route::get('confirmation/{staff}/create', 'ConfirmationController@create')->name('confirmation.create');

    // Employment Reinstatement
    Route::get('reinstatement', 'ReinstatementController@index')->name('reinstatement.index');
    Route::get('reinstatement/{staff}/create', 'ReinstatementController@create')->name('reinstatement.create');

    // Staff Attrition
    Route::get('attrition', 'AttritionController@index')->name('attrition.index');
    Route::get('attrition/search', 'AttritionController@search')->name('attrition.search');
    Route::get('attrition/{staff}/create', 'AttritionController@create')->name('attrition.create');

    // Contract Renewal
    Route::get('contract', 'ContractController@index')->name('contract.index');
    Route::get('contract/search', 'ContractController@search')->name('contract.search');
    Route::get('contract/create/{staff}', 'ContractController@create')->name('contract.create');
    Route::get('contract/retirement', 'ContractController@retirement')->name('contract.retirement');

    // Appointment
    Route::get('appointment', 'AppointmentController@index')->name('appointment.index');

    // General
    Route::get('appointment/general', 'GeneralController@index')->name('general.index');
    Route::get('appointment/general/search', 'GeneralController@search')->name('general.search');
    Route::get('appointment/general/{staff}/create', 'GeneralController@create')->name('general.create');

    // Deanship
    Route::get('appointment/deanship', 'DeanshipController@index')->name('deanship.index');
    Route::get('appointment/deanship/search', 'DeanshipController@search')->name('deanship.search');
    Route::get('appointment/deanship/{staff}/create', 'DeanshipController@create')->name('deanship.create');

    // Headship
    Route::get('appointment/headship', 'HeadshipController@index')->name('headship.index');
    Route::get('appointment/headship/search', 'HeadshipController@search')->name('headship.search');
    Route::get('appointment/headship/{staff}/create', 'HeadshipController@create')->name('headship.create');

    // Report
    Route::get('report-generator', 'ReportController@create')->name('report.create');
    Route::get('report-generator/result', 'ReportController@result')->name('report.result');

    // Settings
    Route::prefix('settings')->group(function () {
        Route::get('/', 'SettingsController@index')->name('staffmanagement.settings.index');
        Route::get('general', 'SettingsController@general')->name('staffmanagement.settings.general');
        Route::get('positions', 'SettingsController@position')->name('staffmanagement.settings.position');
        Route::get('grades', 'SettingsController@grade')->name('staffmanagement.settings.grade');
        Route::get('ranks', 'SettingsController@rank')->name('staffmanagement.settings.rank');
        Route::get('documents', 'SettingsController@document')->name('staffmanagement.settings.document');
        Route::get('qualifications', 'SettingsController@qualification')->name('staffmanagement.settings.qualification');

    });

});
