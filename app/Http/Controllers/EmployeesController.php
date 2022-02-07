<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Log;
use Exception;


class EmployeesController extends Controller
{
    // Get Employee List from Database
    public function getEmployeeList(){
        try{
            $employees = Employee::orderBy('id', 'DESC')->get();
            return response()->json($employees);
        }
        catch(Exception $e){
            Log::error($e);
        }
    }

    //Get individual employee details
    public function getEmployeeDetails(Request $request){
        try{
            $employeeData = Employee::findOrFail($request->get('employeeId'));
            return response()->json($employeeData);
        }
        catch(Exception $e){
            Log::error($e);
        }
    }

    //Update individual employee details
    public function updateEmployeeData(Request $request){
        dd($request);
        try{
            $employeeId = $request->get('employeeId');
            $employeeName = $request->get('employeeName');
            $employeeSalary = $request->get('employeeSalary');

            Employee::where('id',$employeeId)->update([
                'employee_name' => $employeeName,
                'salary'        => $employeeSalary
            ]);

            return response()-> json([
                'employee_name' => $employeeName,
                'salary'        => $employeeSalary
            ]);

        }
        catch(Exception $e){
            Log::error($e);
        }
    }

}
