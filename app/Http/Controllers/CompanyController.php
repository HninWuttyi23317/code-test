<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{

    public function index()
    {
        $companies = Company::when(request('key'), function ($query) {
            $query->orwhere('name', 'like', '%' . request('key') . '%')
                ->orWhere('email', 'like', '%' . request('key') . '%');
        })
            ->orderBy('created_at', 'desc')
            ->paginate(4);
        return view('companies.index', ['companies' => $companies]);
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(CompanyRequest $request)
    {
        $request->validated();
        $company = new Company();
        $company->name = $request->input('name');
        $company->email = $request->input('email');
        $company->logo = $request->input('logo');
        $company->website = $request->input('website');

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = uniqid() . '_' . $file->getClientOriginalName();
            $file->move(public_path() . '/postImage', $fileName);
            $company['logo'] = $fileName;
        }

        $company->save();
        return redirect()->route('companies.index')
            ->with('success', 'Successfully Insert!!');
    }

    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    public function update(CompanyRequest $request, $id)
    {
        $request->validated();
        $company = Company::findOrFail($id);
        $company->name = $request->input('name');
        $company->email = $request->input('email');
        $company->logo = $request->input('logo');
        $company->website = $request->input('website');

        if ($request->hasFile('logo')) {
            $oldImgName = Company::where('id', $id)->first();
            $oldImgName = $oldImgName->logo;

            if ($oldImgName != null) {
                Storage::delete('public/postImage' . $oldImgName);
            }

            $file = $request->file('logo');
            $fileName = uniqid() . '_' . $file->getClientOriginalName();
            $file->move(public_path() . '/postImage', $fileName);
            $company['logo'] = $fileName;
        }
        $company->save();
        return redirect()->route('companies.index')
            ->with('success', 'Successfully Insert!!');
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies.index')
            ->with('success', 'Successfully Delete!!');
    }
}
