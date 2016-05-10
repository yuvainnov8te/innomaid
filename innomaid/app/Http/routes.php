<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('admin' , 'Auth\AuthController@getLogin' ) ;

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('/', 'WelcomeController@index');

Route::get('/welcome/maidlisting', 'WelcomeController@maidlisting');
Route::get('/Maid-Details/{id}/show', 'WelcomeController@show');
Route::get('/maid-agency', 'WelcomeController@maidagency');
Route::post('/maid-agency-detail', 'WelcomeController@maidagencydetail');
Route::get('/home', ['as' => 'home', 'uses' => 'FdwController@index']);
Route::post('/addshortlist', 'WelcomeController@addshortlist');
Route::get('/myshortlist', 'WelcomeController@myshortlist');
Route::get('/welcome/{id}/deleteshortlist', 'WelcomeController@deleteshortlist');
Route::get('/clearshortlist', 'WelcomeController@clearshortlist');
Route::get('/usefullinks', 'WelcomeController@usefullinks');
Route::get('/FAQ', 'WelcomeController@FAQ');
Route::get('/aboutus', 'WelcomeController@aboutus');
Route::get('/requestmaid', 'WelcomeController@requestmaid');
Route::post('/storerequestmaid', ['as' => 'welcome.storerequestmaid', 'uses' => 'WelcomeController@storerequestmaid']);
Route::get('/welcome/{id}/search', 'WelcomeController@search');
Route::get('/maidprofilelist', 'WelcomeController@maidprofilelist');
Route::get('/search', 'WelcomeController@search');
Route::get('/joininnomaid', 'WelcomeController@joininnomaid');
Route::post('/addjoininnomaid', ['as' => 'welcome.addjoininnomaid', 'uses' => 'WelcomeController@addjoininnomaid']);
Route::get('/search/All', 'WelcomeController@search');
Route::get('/search/Philippines', 'WelcomeController@search');
Route::get('/search/Indonesian', 'WelcomeController@search');
Route::get('/search/Myanmarese', 'WelcomeController@search');
Route::get('/search/Indian', 'WelcomeController@search');
Route::get('/search/Bangladeshi', 'WelcomeController@search');
Route::get('/search/Sri-Lankan', 'WelcomeController@search');
Route::get('/search/Transfer', 'WelcomeController@search');
Route::get('/search/Experienced', 'WelcomeController@search');
Route::get('/demo', 'WelcomeController@demo');


// Routes for Web service
Route::group(['prefix' => 'api'], function()
{
    Route::resource('authenticate', 'AuthenticateController', ['only' => ['index','logout']]);
    Route::post('authenticate', 'AuthenticateController@authenticate');

    Route::get('getallmaids', 'AuthenticateController@getallmaids'); //To get all the maids details
    Route::get('maiddetails', 'AuthenticateController@maiddetails'); //To get a maid details
    Route::get('getmaidpdf', 'AuthenticateController@getmaidpdf'); //To get a maid details
//    Route::get('getallmaidsbeelee', 'AuthenticateController@getallmaidsbeelee'); //To get all the maids details
//    Route::get('maiddetailsbeelee', 'AuthenticateController@maiddetailsbeelee'); //To get a maid details
//    Route::post('maidbasicdetails', 'AuthenticateController@maidbasicdetails'); //To get a maid details

    Route::post('logout', 'AuthenticateController@logout');
});
Route::group(['middleware' => 'auth.admin'], function () {
 //   Route::get('/', function ()    {
        // Uses Auth Middleware
		Route::resource('fdws','FdwController');
		Route::get('fdws/create', ['as' => 'fdws.create', 'uses' => 'FdwController@create']);
		Route::get('fdws/{id}/Delete', ['as' => 'sentinel.fdws.delete', 'uses' =>'FdwController@delete']);
		Route::get('fdws/{id}/edit', ['as' => 'fdws.edit', 'uses' => 'FdwController@edit']);
		Route::get('fdws/{id}/show/{pdf}', ['as' => 'sentinel.fdws.show', 'uses' =>'FdwController@show']);
		
		Route::resource('users', 'UserController');
		Route::get('users/create', ['as' => 'sentinel.users.create', 'uses' => 'UserController@create']);
		Route::get('users/{id}/edit', ['as' => 'sentinel.users.edit', 'uses' => 'UserController@edit']);
		Route::get('users/{id}/delete', ['as' => 'users.delete', 'uses' =>'UserController@delete']);
		
		Route::post('users/{id}/password', ['as' => 'sentinel.password.change', 'uses' => 'UserController@changePassword']);
		Route::put('profile', ['as' => 'sentinel.profile.update', 'uses' => 'UserController@edit']);
		
		Route::resource('employer','EmployerController');
		Route::get('employer/create', ['as' => 'employer.create', 'uses' => 'EmployerController@create']);
		Route::get('employer/{id}/delete',['as' => 'employer.delete', 'uses' =>'EmployerController@delete'] );
		Route::get('employer/{id}/show/{pdf}', ['as' => 'employer.show', 'uses' =>'EmployerController@show'] );
		Route::get('employer/{id}/edit', ['as' => 'employer.edit', 'uses' => 'EmployerController@edit']);
		
		Route::resource('servicefees','ServicefeesController');
		Route::get('servicefees/create', ['as' => 'servicefees.create', 'uses' => 'ServicefeesController@create']);
		Route::get('servicefees/{id}/delete',['as' => 'Servicefees.delete', 'uses' =>'ServicefeesController@delete'] );
		Route::get('servicefees/{id}/edit', ['as' => 'servicefees.edit', 'uses' => 'ServicefeesController@edit']);
		Route::get('servicefees/{id}/show/{pdf}', ['as' => 'Servicefees.show', 'uses' =>'ServicefeesController@show']);
		
		Route::resource('service', 'ServiceController');
		Route::get('service/create', ['as' => 'service.create', 'uses' => 'ServiceController@create']);
		Route::post('service/index', 'ServiceController@index');
		Route::get('service/{id}/delete', 'ServiceController@delete');
		Route::get('service/{id}/edit', ['as' => 'service.edit', 'uses' => 'ServiceController@edit']);
		
		
		Route::resource('role', 'RoleController');
		Route::get('role/create', ['as' => 'role.create', 'uses' => 'RoleController@create']);
		Route::get('role/{id}/permissions',['as'=>'sentinel.role.permissions','uses'=>'RoleController@getPerms']);
		Route::post('role/{id}/permissions',['as'=>'sentinel.role.permissions','uses'=>'RoleController@postPerms']);
		Route::get('role/{id}/edit', ['as' => 'role.edit', 'uses' => 'RoleController@edit']);
		Route::get('role/{id}/delete',['as'=>'role.delete','uses'=>'RoleController@delete'] );
		
		Route::resource('page', 'PageController');
		Route::get('page/create', ['as' => 'page.create', 'uses' => 'PageController@create']);
		Route::get('page/{id}/delete',  ['as'=>'sentinel.page.delete','uses'=>'PageController@delete']);
		Route::get('page/{id}/edit', ['as' => 'page.edit', 'uses' => 'PageController@edit']);
		
		
 });
 Route::post('users/search',['as' => 'sentinel.users.search', 'uses' => 'UserController@search']);
// Routes for fdw module start
Route::post('fdws/create',['as' => 'fdws.create', 'uses' => 'FdwController@store']);
Route::post('fdws/search',['as' => 'sentinel.fdws.search', 'uses' => 'FdwController@search']);
Route::post('fdws/{id}/edit', ['as' => 'sentinel.fdws.update', 'uses' => 'FdwController@update']);
Route::post('fdws/{id}/updateskill', ['as' => 'sentinel.fdws.updateskill', 'uses' => 'FdwController@updateskill']);
Route::post('fdws/{id}/updateemploymenthistory', ['as' => 'sentinel.fdws.updateemploymenthistory', 'uses' => 'FdwController@updateemploymenthistory']);
Route::post('fdws/{id}/updateemploymenthistoryupdate', ['as' => 'sentinel.fdws.updateemploymenthistoryupdate', 'uses' => 'FdwController@updateemploymenthistoryupdate']);
Route::post('fdws/{id}/updateother', ['as' => 'sentinel.fdws.updateother', 'uses' => 'FdwController@updateother']);
Route::post('fdws/{id}/updatedocument', ['as' => 'sentinel.fdws.updatedocument', 'uses' => 'FdwController@updatedocument']);
Route::post('fdws/{id}/updateintro', ['as' => 'sentinel.fdws.updateintro', 'uses' => 'FdwController@updateintro']);
Route::post('fdws/{id}/updatenotes', ['as' => 'sentinel.fdws.updatenotes', 'uses' => 'FdwController@updatenotes']);
Route::get('fdws/{maid_id}/maidskilldelete/{work_area_id}', 'FdwController@maidskilldelete');
Route::get('fdws/{maid_id}/maidemploymentdelete/{id}', ['as' => 'sentinel.fdws.maidemploymentdelete', 'uses' => 'FdwController@maidemploymentdelete']);
Route::post('fdws/fdwinfo', 'FdwController@fdwinfo');
Route::get('fdws/{id}/tumbnailimagedelete/{name}', ['as' => 'sentinel.fdws.tumbnailimagedelete', 'uses' => 'FdwController@tumbnailimagedelete']);
Route::get('fdws/{id}/profileimagedelete/{name}', ['as' => 'sentinel.fdws.profileimagedelete', 'uses' => 'FdwController@profileimagedelete']);
//Route::post('fdws/uploadFiles', 'FdwController@uploadFiles');
Route::get('fdws/{maid_id}/documentdelete/{id}', 'FdwController@documentdelete');
Route::get('fdws/view/{docname}', 'FdwController@documentview');
Route::get('fdws/{id}/download_document', 'FdwController@download_document');
// Routes for fdw module Complete

Route::post('users/create',['as' => 'sentinel.users.create', 'uses' => 'UserController@store']);
Route::post('users/{id}/edit', ['as' => 'sentinel.users.update', 'uses' => 'UserController@update']);
Route::post('users/{id}/updateagencycontact', ['as' => 'sentinel.users.updateagencycontact', 'uses' => 'UserController@updateagencycontact']);
Route::get('users/{agency_id}/agencycontactsdelete/{agency_contact_id}', 'UserController@agencycontactsdelete');
Route::post('users/{id}/updateothersetting', ['as' => 'sentinel.users.updateothersetting', 'uses' => 'UserController@updateothersetting']);

// Routes for Employer module start
Route::post('employer/create',['as' => 'employer.create', 'uses' => 'EmployerController@store']);
Route::post('employer/search',['as' => 'sentinel.employer.search', 'uses' => 'EmployerController@search']);
Route::post('employer/{id}/edit', ['as' => 'sentinel.employer.update', 'uses' => 'EmployerController@update']);
Route::get('employer/{employer_id}/familydetaildelete/{employer_family_member_id}', 'EmployerController@familydetaildelete');
Route::post('employer/{id}/updatedocument', ['as' => 'sentinel.employer.updatedocument', 'uses' => 'EmployerController@updatedocument']);
Route::get('employer/{employer_id}/documentdelete/{id}', 'EmployerController@documentdelete');
Route::get('employer/view/{docname}', 'EmployerController@documentview');
Route::post('employer/employerinfo', 'EmployerController@employerinfo');
// Routes for Employer module Complete
Route::get('profile', ['as' => 'sentinel.profile.show', 'uses' => 'ProfileController@show']);



// Routes for servicefees module start
Route::post('servicefees/create',['as' => 'servicefees.create', 'uses' => 'ServicefeesController@store']);
Route::post('servicefees/{id}/edit', ['as' => 'sentinel.servicefees.update', 'uses' => 'ServicefeesController@update']);
Route::get('servicefees/{service_schedule_id}/replacementcostdelete/{id}', 'ServicefeesController@replacementcostdelete');
Route::get('servicefees/{service_schedule_id}/otherservicedelete/{id}', 'ServicefeesController@otherservicedelete');
Route::post('servicefees/serviceprice', 'ServicefeesController@serviceprice');
Route::get('servicefees/{service_schedule_id}/placementdelete/{id}', 'ServicefeesController@placementdelete');

// Routes for servicefees module Complete

// Routes for servicefees module start
Route::post('service/create',['as' => 'service.create', 'uses' => 'ServiceController@store']);
Route::post('service/{id}/edit', ['as' => 'sentinel.service.update', 'uses' => 'ServiceController@update']);
Route::post('service/serviceinfo', 'ServiceController@serviceinfo');
Route::get('service/{id}/delete',['as' => 'service.delete', 'uses' =>'ServiceController@delete'] );
Route::post('service/package-detail',[ 'as' => 'sentinel.service.package_detail', 'uses' =>'ServiceController@packagedetail']);
// Routes for servicefees module Complete

// Routes for servicefees module start

// Routes for servicefees module Complete
Route::post('page/create',['as' => 'page.create', 'uses' => 'PageController@store']);
Route::post('page/{id}/edit', ['as' => 'sentinel.page.update', 'uses' => 'PageController@update']);


// Routes for permission module start
Route::resource('permission', 'PermissionController');
Route::get('permission/create', ['as' => 'permission.create', 'uses' => 'PermissionController@create']);
Route::post('permission/create', ['as' => 'permission.create', 'uses' => 'PermissionController@create']);
Route::post('permission/{id}/edit', ['as' => 'sentinel.permission.update', 'uses' => 'PermissionController@update']);
Route::get('permission/{id}/edit', ['as' => 'permission.edit', 'uses' => 'PermissionController@edit']);
Route::get('permission/{id}/delete', ['as'=>'sentinel.permission.delete','uses'=>'PermissionController@delete']);
Route::post('role/create',['as' => 'role.create', 'uses' => 'RoleController@store']);
Route::post('role/{id}/edit', ['as' => 'sentinel.role.update', 'uses' => 'RoleController@update']);
// Routes for  permission module Complete

// Routes for Maid Application module start

Route::resource('application', 'ApplicationController');
Route::post('application/create',['as' => 'application.create', 'uses' => 'ApplicationController@store']);
Route::get('application/{id}/edit', ['as' => 'application.edit', 'uses' => 'ApplicationController@edit']);
Route::get('application/{id}/delete', ['as' => 'sentinel.application.delete', 'uses' =>'ApplicationController@delete']);	
Route::post('application/{id}/edit', ['as' => 'sentinel.application.update', 'uses' => 'ApplicationController@update']);
Route::post('application/search',['as' => 'sentinel.application.search', 'uses' => 'ApplicationController@search']);
Route::post('application/{id}/servicefeesupdate', ['as' => 'sentinel.application.servicefeesupdate', 'uses' => 'ApplicationController@servicefeesupdate']);
Route::get('application/{service_schedule_id}/replacementcostdelete/{id}/{maid_application}', 'ApplicationController@replacementcostdelete');
Route::get('application/{service_schedule_id}/otherservicedelete/{id}/{maid_application}', 'ApplicationController@otherservicedelete');
Route::get('application/{service_schedule_id}/placementdelete/{id}/{maid_application}', 'ApplicationController@placementdelete');
Route::post('application/{id}/jobscopeupdate', ['as' => 'sentinel.application.jobscopeupdate', 'uses' => 'ApplicationController@jobscopeupdate']);
Route::post('application/{id}/loanPayment', ['as' => 'sentinel.application.loanPayment', 'uses' => 'ApplicationController@loanPayment']);
Route::post('application/{id}/paymentinvoice', ['as' => 'sentinel.application.paymentinvoice', 'uses' => 'ApplicationController@paymentinvoice']);
Route::post('application/{id}/dayofrest', ['as' => 'sentinel.application.dayofrest', 'uses' => 'ApplicationController@dayofrest']);
Route::post('application/{id}/handlingtakeover', ['as' => 'sentinel.application.handlingtakeover', 'uses' => 'ApplicationController@handlingtakeover']);
Route::get('application/{id}/securitybond', ['as' => 'sentinel.application.securitybond', 'uses' => 'ApplicationController@securitybond']);
Route::get('application/{id}/authorisationworkpass', ['as' => 'sentinel.application.authorisationworkpass', 'uses' => 'ApplicationController@authorisationworkpass']);
Route::get('application/{id}/safetyagreement', ['as' => 'sentinel.application.safetyagreement', 'uses' => 'ApplicationController@safetyagreement']);
Route::get('application/{id}/incometaxdeclaration', ['as' => 'sentinel.application.incometaxdeclaration', 'uses' => 'ApplicationController@incometaxdeclaration']);
Route::get('application/{id}/giro', ['as' => 'sentinel.application.giro', 'uses' => 'ApplicationController@giro']);
Route::get('application/{id}/workpermit', ['as' => 'sentinel.application.workpermit', 'uses' => 'ApplicationController@workpermit']);
Route::get('application/{id}/insurance', ['as' => 'sentinel.application.insurance', 'uses' => 'ApplicationController@insurance']);
Route::get('application/{id}/wp_renewal', ['as' => 'sentinel.application.insurance', 'uses' => 'ApplicationController@wp_renewal']);
Route::get('application/{id}/fdwdeclaration', ['as' => 'sentinel.application.fdwdeclaration', 'uses' => 'ApplicationController@fdwdeclaration']);
Route::get('application/{id}/employerchangedeclaration', ['as' => 'sentinel.application.employerchangedeclaration', 'uses' => 'ApplicationController@employerchangedeclaration']);
Route::get('application/{id}/employmentcontract', ['as' => 'sentinel.application.employmentcontract', 'uses' => 'ApplicationController@employmentcontract']);
Route::get('application/{id}/passportrenewal', ['as' => 'sentinel.application.passportrenewal', 'uses' => 'ApplicationController@passportrenewal']);
Route::get('application/{id}/fdwvacation', ['as' => 'sentinel.application.fdwvacation', 'uses' => 'ApplicationController@fdwvacation']);
Route::get('application/{id}/dischargedform', ['as' => 'sentinel.application.dischargedform', 'uses' => 'ApplicationController@dischargedform']);
Route::post('application/{id}/securitybondupdate', ['as' => 'sentinel.application.securitybondupdate', 'uses' => 'ApplicationController@securitybondupdate']);
Route::post('application/{id}/authorisationworkpassupdate', ['as' => 'sentinel.application.authorisationworkpassupdate', 'uses' => 'ApplicationController@authorisationworkpassupdate']);
Route::post('application/{id}/safetyagreementupdate', ['as' => 'sentinel.application.safetyagreementupdate', 'uses' => 'ApplicationController@safetyagreementupdate']);
Route::post('application/{id}/incometaxdeclarationupdate', ['as' => 'sentinel.application.incometaxdeclarationupdate', 'uses' => 'ApplicationController@incometaxdeclarationupdate']);
Route::post('application/{id}/workpermitupdate', ['as' => 'sentinel.application.workpermitupdate', 'uses' => 'ApplicationController@workpermitupdate']);
Route::post('application/{id}/giroupdate', ['as' => 'sentinel.application.giroupdate', 'uses' => 'ApplicationController@giroupdate']);
Route::post('application/{id}/insuranceupdate', ['as' => 'sentinel.application.insuranceupdate', 'uses' => 'ApplicationController@insuranceupdate']);
Route::post('application/{id}/fdwdeclarationupdate', ['as' => 'sentinel.application.fdwdeclarationupdate', 'uses' => 'ApplicationController@fdwdeclarationupdate']);
Route::post('application/{id}/wp_renewalupdate', ['as' => 'sentinel.application.wp_renewalupdate', 'uses' => 'ApplicationController@wp_renewalupdate']);
Route::get('application/{maid_application}/fdwdeclarationitemdelete/{id}', 'ApplicationController@fdwdeclarationitemdelete');
Route::post('search',['as'=>'search','uses'=>'WelcomeController@search'] );
Route::get('application/{id}/loan_payment/{pdf}', ['as' => 'sentinel.application.loan_payment', 'uses' =>'ApplicationController@loan_payment']);
//Route::post('application/{id}/loan_payment', ['as' => 'sentinel.application.loan_payment', 'uses' =>'ApplicationController@loan_payment']);
Route::get('application/{id}/show_job_scope/{pdf}', ['as' => 'sentinel.application.show_job_scope', 'uses' =>'ApplicationController@show_job_scope']);
Route::get('application/{id}/show_servicefees/{pdf}', ['as' => 'sentinel.application.show_servicefees', 'uses' =>'ApplicationController@show_servicefees']);
Route::get('application/{id}/show_restday_agreement/{pdf}', ['as' => 'sentinel.application.show_restday_agreement', 'uses' =>'ApplicationController@show_restday_agreement']);
Route::get('application/{id}/show_security_bond/{pdf}', ['as' => 'sentinel.application.show_security_bond', 'uses' =>'ApplicationController@show_security_bond']);
Route::get('application/{id}/show_handlingtakeover/{pdf}', ['as' => 'sentinel.application.show_handlingtakeover', 'uses' =>'ApplicationController@show_handlingtakeover']);
Route::get('application/{id}/show_workpermit/{pdf}', ['as' => 'sentinel.application.show_workpermit', 'uses' =>'ApplicationController@show_workpermit']);
Route::get('application/{id}/show_wp_renewal/{pdf}', ['as' => 'sentinel.application.show_wp_renewal', 'uses' =>'ApplicationController@show_wp_renewal']);
Route::get('application/{id}/show_authorisationworkpass/{pdf}', ['as' => 'sentinel.application.show_authorisationworkpass', 'uses' =>'ApplicationController@show_authorisationworkpass']);
Route::get('application/{id}/show_giro_form/{pdf}', ['as' => 'sentinel.application.show_giro_form', 'uses' =>'ApplicationController@show_giro_form']);
Route::get('application/{id}/show_safetyagreement/{pdf}', ['as' => 'sentinel.application.show_safetyagreement', 'uses' =>'ApplicationController@show_safetyagreement']);
Route::get('application/{id}/show_incometaxdeclaration/{pdf}', ['as' => 'sentinel.application.show_incometaxdeclaration', 'uses' =>'ApplicationController@show_incometaxdeclaration']);
Route::get('application/{id}/show_Insurancedata/{pdf}', ['as' => 'sentinel.application.show_Insurancedata', 'uses' =>'ApplicationController@show_Insurancedata']);
Route::get('application/{id}/show_employer_change/{pdf}', ['as' => 'sentinel.application.show_employer_change', 'uses' =>'ApplicationController@show_employer_change']);
Route::get('application/{id}/show_fdw_declaration/{pdf}', ['as' => 'sentinel.application.show_fdw_declaration', 'uses' =>'ApplicationController@show_fdw_declaration']);
Route::get('application/{id}/show_employment_contract/{pdf}', ['as' => 'sentinel.application.show_employment_contract', 'uses' =>'ApplicationController@show_employment_contract']);
Route::get('application/{id}/show_fdw_vacation/{pdf}', ['as' => 'sentinel.application.show_fdw_vacation', 'uses' =>'ApplicationController@show_fdw_vacation']);
Route::get('application/{id}/show_pprenewal/{pdf}', ['as' => 'sentinel.application.show_pprenewal', 'uses' =>'ApplicationController@show_pprenewal']);
Route::get('application/{id}/show_discharge_form/{pdf}', ['as' => 'sentinel.application.show_discharge_form', 'uses' =>'ApplicationController@show_discharge_form']);
Route::post('/application/{id}/agencyagreementdata', ['as' => 'sentinel.application.agencyagreementdata', 'uses' => 'ApplicationController@agencyagreementdata']);
//Route::get('/application/{id}/agencyemployeragreement', ['as' => 'sentinel.application.agencyemployeragreement', 'uses' => 'ApplicationController@agencyemployeragreement']);
Route::get('application/{id}/agencyemployeragreement/{pdf}', ['as' => 'sentinel.application.agencyemployeragreement', 'uses' =>'ApplicationController@agencyemployeragreement']);

Route::post('application/applicationinfo', 'ApplicationController@applicationinfo');
Route::post('/application/{id}/agencyfdwagreementdata', ['as' => 'sentinel.application.agencyfdwagreementdata', 'uses' => 'ApplicationController@agencyfdwagreementdata']);
Route::post('/application/{id}/agencyfdwcontractdata', ['as' => 'sentinel.application.agencyfdwcontractdata', 'uses' => 'ApplicationController@agencyfdwcontractdata']);
//Route::get('/application/{id}/agencyfdwagreement', ['as' => 'sentinel.application.agencyfdwagreement', 'uses' => 'ApplicationController@agencyfdwagreement']);
Route::get('application/{id}/agencyfdwagreement/{pdf}', ['as' => 'sentinel.application.agencyfdwagreement', 'uses' =>'ApplicationController@agencyfdwagreement']);
Route::get('application/{id}/agencyfdwcontract/{pdf}', ['as' => 'sentinel.application.agencyfdwcontract', 'uses' =>'ApplicationController@agencyfdwcontract']);
//ajax call
Route::post('/application/agencyemployeragreement', ['as' => 'sentinel.application.agencyemployeragreement', 'uses' => 'ApplicationController@agencyemployeragreement']);
Route::post('/application/agencyfdwagreement', ['as' => 'sentinel.application.agencyfdwagreement', 'uses' => 'ApplicationController@agencyfdwagreement']);
Route::post('/application/agencyfdwcontract', ['as' => 'sentinel.application.agencyfdwcontract', 'uses' => 'ApplicationController@agencyfdwcontract']);
Route::get('/application/{id}/empinvoice', ['as' => 'sentinel.application.empinvoice', 'uses' => 'ApplicationController@empinvoice']);
Route::post('/application/{id}/empinvoice', ['as' => 'sentinel.application.empinvoiceupdate', 'uses' => 'ApplicationController@empinvoiceupdate']);
Route::get('/application/{id}/empinvoicepdf/{pdf}', ['as' => 'sentinel.application.empinvoicepdf', 'uses' =>'ApplicationController@empinvoice']);
Route::post('/application/{id}/recordpaymentadd', ['as' => 'sentinel.application.recordpaymentadd', 'uses' => 'ApplicationController@recordpaymentadd']);
Route::get('/application/{id}/fdwinvoice', ['as' => 'sentinel.application.fdwinvoice', 'uses' => 'ApplicationController@fdwinvoice']);
Route::post('/application/{id}/fdwinvoice', ['as' => 'sentinel.application.fdwinvoiceupdate', 'uses' => 'ApplicationController@fdwinvoiceupdate']);
Route::get('/application/{id}/fdwinvoicepdf/{pdf}', ['as' => 'sentinel.application.fdwinvoicepdf', 'uses' =>'ApplicationController@fdwinvoice']);
Route::post('application/autocompleteemployer', 'ApplicationController@autocompleteemployer');
Route::post('application/autocompletemaid', 'ApplicationController@autocompletemaid');

Route::get('employer/create/{app}', ['as' => 'employer.create', 'uses' => 'EmployerController@create']);
Route::post('employer/create/{app}', ['as' => 'employer.store', 'uses' => 'EmployerController@store']);
Route::get('fdws/create/{app}', ['as' => 'fdws.create', 'uses' => 'FdwController@create']);
Route::post('fdws/create/{app}', ['as' => 'fdws.store', 'uses' => 'FdwController@store']);
// Routes for Maid Application module Complete

Route::get('invoiceList/{type}', 'InvoicelistController@show');
Route::post('invoiceList/payment-detail',[ 'as' => 'sentinel.invoicelist.payment_detail', 'uses' =>'InvoicelistController@paymentdetail']);
Route::get('/Invoicelist/{id}/paymentrecordpdf/{pdf}', ['as' => 'sentinel.invoicelist.paymentrecordpdf', 'uses' =>'InvoicelistController@show_paymentrecord']);

// Routes for template module start		
Route::resource('template', 'TemplateController');
Route::get('template/create', ['as' => 'template.create', 'uses' => 'TemplateController@create']);
Route::post('template/create', ['as' => 'template.create', 'uses' => 'TemplateController@create']);
Route::get('template/{id}/delete',  ['as'=>'sentinel.template.delete','uses'=>'TemplateController@delete']);
Route::get('template/{id}/edit', ['as' => 'template.edit', 'uses' => 'TemplateController@edit']);
Route::post('template/{id}/update', ['as' => 'sentinel.template.update', 'uses' => 'TemplateController@update']);
Route::get('template/{id}/preview', ['as' => 'sentinel.template.preview', 'uses' => 'TemplateController@preview']);
// Routes for template module start

// Routes for template module start
	Route::resource('agreementform', 'AgreementformController');	
	Route::get('agreementform/{id}/edit', ['as' => 'sentinel.agreementform.edit', 'uses' => 'AgreementformController@edit']);
Route::post('agreementform/{id}/update', ['as' => 'sentinel.agreementform.update', 'uses' => 'AgreementformController@update']);

// Routes for Countries module start
	Route::resource('countries', 'CountriesController');
// Routes for Countries module Complete	
// Routes for template module start		
Route::resource('package', 'PackageController');
Route::get('package/create', ['as' => 'package.create', 'uses' => 'PackageController@create']);
Route::post('package/create', ['as' => 'package.create', 'uses' => 'PackageController@store']);
Route::get('package/{id}/delete',  ['as'=>'sentinel.package.delete','uses'=>'PackageController@delete']);
Route::get('package/{id}/edit', ['as' => 'package.edit', 'uses' => 'PackageController@edit']);
Route::post('package/{id}/update', ['as' => 'sentinel.package.update', 'uses' => 'PackageController@update']);
