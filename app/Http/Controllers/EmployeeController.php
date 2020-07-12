<?php

namespace App\Http\Controllers;

use App\Company;
use App\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::with('company')->paginate(10);
        return view('employees.index', compact(['employees']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all();
        return view('employees/create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate(
            [
                'first_name' => ['required', 'max:255'],
                'last_name' => ['required', 'max:255'],
                'phone' => ['required', 'max:255'],
                // 'company_id' => ['required', 'exists:companies'],
                'email' => ['required', 'email', 'unique:employees'],
            ]
        );

        if (!$validatedData) {
            return redirect()->back()->withInput($validatedData);
        }

        $employee = new Employee();
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->phone = $request->phone;
        $employee->email = $request->email;
        $employee->company_id = $request->company_id;
        $employee->save();
        $to = "malimali01120354080@gmail.com";
        $subject = "company created";
        $message = "company created successfully.";
        $header = "From:support@domain.in \r\n";
        mail($to, $subject, $message, $header);

        return redirect('/employees')->with('success', 'well Done!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::find($id);
        $companies = Company::all();
        return view('employees/create', compact('companies', 'employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate(
            [
                'first_name' => ['required', 'max:255'],
                'last_name' => ['required', 'max:255'],
                'phone' => ['required', 'max:255'],
                // 'company_id' => ['required', 'exists:companies'],
                'email' => ['required', 'email', 'unique:employees,email,' . $id],
            ]
        );

        if (!$validatedData) {
            return redirect()->back()->withInput($validatedData);
        }

        $employee = Employee::find($id);
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->phone = $request->phone;
        $employee->email = $request->email;
        $employee->company_id = $request->company_id;
        $employee->save();
        return redirect('/employees')->with('success', 'well Done!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        $employee->delete();
        return redirect('/employees')->with('success', 'well Done!');
    }
}
