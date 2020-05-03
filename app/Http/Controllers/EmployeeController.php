<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Http\Requests\EmployeeRequest;
use App\Models\Company;
use App\Models\Employee;
use http\Exception;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        return view('employee.index',
            [
                'Employees' => Employee::with('company')->paginate(10),

            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employee.form', [
            'title'        => "new Employee",
            'parent_title' => "Employees",
            'activeMenu'   => "Employee",
            'active'       => "create employee",
            'model'        => new Employee(),
            'companies'    => Company::get()->pluck('name', 'id')->prepend('All', '')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        $employee = Employee::make($request->all());
        $employee->save();
        return redirect()->route('employee.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        return view('employee.form', [
            'title'        => "edit employee",
            'parent_title' => "employees",
            'activeMenu'   => "employee",
            'model'        => $employee,
            'companies'    => Company::get()->pluck('name', 'id')->prepend('All', '')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        $employee->update($request->all());
        return redirect()->route('employee.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        try {
            throw_unless($employee->delete(), Exception::class);
            return redirect()->route('company.index');
        } catch (\Throwable $e) {
            abort(403);
        }
    }
}
