<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Employee;
use App\Http\Requests\EmployeeFormRequest;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::when(request('key'), function ($query) {
                                $query->orwhere('name', 'like', '%' . request('key') . '%')
                                ->orWhere('email', 'like', '%' . request('key') . '%')
                                ->orWhere('phone', 'like', '%' . request('key') . '%');
                                })
                           ->orderBy('created_at', 'desc')
                           ->paginate(4);
        return view('employees.index',['employees' => $employees] );
    }

    public function create()
    {
        $companies = Company::all();
        return view('employees.create',['companies'=>$companies]);
    }

    public function store(EmployeeFormRequest $request)
    {
        $request->validated();
        $employee = new Employee();
        $employee->name  = $request->input('name');
        $employee->email  = $request->input('email');
        $employee->phone  = $request->input('phone');
        $employee->profile  = $request->input('profile');
        $employee->company_id = $request->input('company_id');

        if ($request->hasFile('profile')) {
            $file = $request->file('profile');
            $fileName = uniqid() . '_' . $file->getClientOriginalName();
            $file->move(public_path() . '/postImage', $fileName);
            $employee['profile'] = $fileName;
        }

        $employee->save();
        return redirect()->route('employees.index')->with('success','Successfully Insert!!');
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit',['employee'=>$employee, 'companies'=>Company::all()]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate(
            [
            'name'=>'required',
            'email' => 'required',
            'phone' => 'required',
            'company_id' => 'required',
            'profile' => 'required|image|mimes:jpeg,jpg,png,svg,gif|max:2048'
            ]
        );
        $employee = Employee::findOrFail($id);
        $employee->name  = $request->input('name');
        $employee->email  = $request->input('email');
        $employee->phone  = $request->input('phone');
        $employee->company_id = $request->input('company_id');
        $img_name = time(). '.' .$request->image->extension();
        $request->image->move(public_path('images'), $img_name);
        $employee->image = $img_name;
        $employee->save();

        return redirect()->route('employees.index')->with('success', 'Successfully Update!!');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Successfully Delete!!');
    }
}
