<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class APIController extends Controller
{
    // Get Company
    public function getCompany()
    {
        $company = Company::get();
        return response()->json($company, 200);
    }
    // Get Employee
    public function getEmployee()
    {
        $employee = Employee::get();
        return response()->json($employee, 200);

    }

    // Create Company
    public function createCompany(Request $request)
    {
        // dd($request->all());
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'logo' => $request->logo,
            'website' => $request->website,
        ];
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = uniqid() . '_' . $file->getClientOriginalName();
            $file->move(public_path() . '/postImage', $fileName);
            $data['logo'] = $fileName;
        }

        $response = Company::create($data);
        return response()->json($response, 200);
    }

    // Create Employee
    public function createEmployee(Request $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'company_id' => $request->company_id,
            'profile' => $request->profile,
        ];

        $companyId = Company::where('id', $request->company_id)->first();

        if (isset($companyId)) {
            if ($request->hasFile('profile')) {
                $fileName = uniqid() . '_' . $request->file('profile')->getClientOriginalName();
                $request->file('profile')->move(public_path() . '/postImage', $fileName);
                $data['profile'] = $fileName;
            };
            $res = Employee::create($data);
            return response()->json($res, 200);
        }
        return response()->json(['status' => 'There is no company for that id,Try another CompanyId'], 200);
    }

    // Delete Company
    public function deleteCompany($id)
    {
        $companyId = Company::where('id', $id)->first();

        if (isset($companyId)) {
            Company::where('id', $id)->delete();
            return response()->json(['status' => 'True', 'message' => 'Delete Success'], 200);
        }
        return response()->json(['status' => 'false', 'message' => 'There is no id for that'], 200);
    }

    // DeleteEmployee
    public function deleteEmployee($id)
    {
        $companyId = Employee::where('id', $id)->first();

        if (isset($companyId)) {
            Employee::where('id', $id)->delete();
            return response()->json(['status' => 'True', 'message' => 'Delete Success'], 200);
        }
        return response()->json(['status' => 'false', 'message' => 'There is no id for that'], 500);
    }

    // DetailData
    public function companyDetail($id)
    {
        $data = Company::where('id', $id)->first();

        if (isset($data)) {
            return response()->json(['status' => 'true', 'company' => $data], 200);
        }
        return response()->json(['status' => 'false', 'message' => "There is no company for that id"], 500);
    }

    public function companyUpdate(Request $request)
    {
        logger($request->toArray());

        $company = Company::where('id', $request->company_id)->first();
        $data = $this->getCompanyUpdate($request);

        if (isset($company)) {

            if ($request->hasFile('logo')) {

                $oldImgName = $company->logo;

                if ($oldImgName != null) {
                    Storage::delete('public/postImage' . $oldImgName);
                }

                $file = $request->file('logo');
                $fileName = uniqid() . '_' . $file->getClientOriginalName();
                $file->move(public_path() . '/postImage', $fileName);
                $data['logo'] = $fileName;
            }

            $response = Company::where('id', $company)->update($data);
            return response()->json(['status' => 'true', 'message' => 'Company updated success', 'updated' => $response], 200);
        }

        return response()->json(['status' => 'false', 'message' => "There is no company for this id"], 500);
    }

    private function getCompanyUpdate($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            // 'logo' => $request->logo,
            'website' => $request->website,
            'updated_at' => Carbon::now(),
        ];
    }
}
