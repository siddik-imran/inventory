<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Salary;
use Illuminate\Http\Request;
use DB;

class SalaryController extends Controller
{
    public function paidSalary(Request $request, $id)
    {
        $validateData = $request->validate([
            'salary_month' => 'required',

        ]);

        $month = $request->salary_month;
        // $salary = new Salary;
        // $salary->employee_id = $id;
        // $salary->amount = $request->salary;
        // $salary->salary_month = $month;
        // $salary->salary_year = date('Y');
        // $salary->salary_date=date('d/m/y');

        //$salary->save();
        $check = Salary::where([
                                'employee_id'=> $id ,
                                'salary_month' => $month
                             ])->first();
        if($check){
            return response()->json('Salary Already Paid');
        }
        else{
            $salary = new Salary;
            $salary->employee_id = $id;
            $salary->amount = $request->salary;
            $salary->salary_month = $month;
            $salary->salary_year = date('Y');
            $salary->salary_date=date('d/m/y');

            $salary->save();
        }
    }

    public function allSalary()
    {
        $salary = Salary::groupBy('salary_month')->get('salary_month');
        //dd($salary);
        return response()->json($salary);
    }

    public function viewSalary($id)
    {
        $view = Salary::with('employee')->where('salary_month', $id)->get();
        return response()->json($view);
    }

    public function editSalary($id)
    {
        $view = DB::table('salaries')
                ->join('employees', 'salaries.employee_id', 'employees.id')
                ->select('employees.name', 'employees.email', 'salaries.*')
                ->where('salaries.id', $id)
                ->first();
            //dd($view);
        return response()->json($view);
    }

    public function updateSalary(Request $request, $id)
    {
        $salary = Salary::find($id);
        $salary->amount = $request->amount;
        $salary->salary_month = $request->salary_month;

        $salary->update();

    }
}
