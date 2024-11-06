<?php

use App\Http\Controllers\APIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// GetData
Route::get('company/list',[APIController::class,'getCompany']);
Route::get('employee/list',[APIController::class,'getEmployee']);

// CreateData
Route::post('create/company',[APIController::class,'createCompany']);
Route::post('create/employee',[APIController::class,'createEmployee']);

// DeleteData
Route::get('delete/company/{id}',[APIController::class,'deleteCompany']);
Route::get('delete/employee/{id}',[APIController::class,'deleteEmployee']);

// UpdateData
Route::get('detail/company/{id}',[APIController::class,'companyDetail']);
Route::post('company/update',[APIController::class,'companyUpdate']);

// GetData
/**
 * localhost:8000/api/company/list (Get method)
 * localhost:8000/api/employee/list (Get method)
 */

//  Create Data
/**
 * localhost:8000/api/create/company
 * localhost:8000/api/create/employee
 */

 //  Delete Data
/**
 * localhost:8000/api/delete/company
 * localhost:8000/api/delete/employee
 */

  //  Delete Data
/**
 *localhost:8000/api/company/update
 * localhost:8000/api/detail/company
 */
