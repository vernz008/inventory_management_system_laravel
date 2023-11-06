<?php

namespace App\Http\Controllers;

use App\Models\Employee;
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
    try {
        $employee = Employee::all();
        
        if(!$employee){
            return response()->json(['message' => 'Record not found'], 404);
        }else{
            return response()->json([$employee], 200);
        }
    } catch (\Throwable $error) {
        throw $error;
    }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            //Validate
            $request->validate([
                "firstname" => "required",
                "lastname" => "required",
                "birthday" => "required",
                "employee_status" => "required",
                "nbi" => "required",
                "police_clearance" => "required",
                "medical_clearance" => "required",
                
            ]);

            //Query
            $employee = Employee::create([
                "firstname"=>$request->input("firstname"),
                "lastname"=>$request->input("lastname"),
                "birthday"=>$request->input("birthday"),
                "employee_status"=>$request->input("employee_status"),
                "nbi"=>$request->input("nbi"),
                "police_clearance"=>$request->input("police_clearance"),
                "medical_clearance"=>$request->input("medical_clearance"),
            ]);
            
            return response()->json(['message' => 'Employee Created', 'data'=> $employee], 201);
            
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            
            $employee = Employee::find($id);

            if(!$employee) {
                return response()->json(['message' => 'Record Not Found'], 404);
            }else{
                return response()->json([$employee], 200);
            }
        } catch (\Throwable $error) {
            throw $error;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    try {
        $employee = Employee::find($id);

         //Validate
         $request->validate([
            "firstname" => "required",
            "lastname" => "required",
            "birthday" => "required",
            "employee_status" => "required",
            "nbi" => "required",
            "police_clearance" => "required",
            "medical_clearance" => "required",
            
        ]);

        $employee->update([
            "firstname"=>$request->input("firstname"),
            "lastname"=>$request->input("lastname"),
            "birthday"=>$request->input("birthday"),
            "employee_status"=>$request->input("employee_status"),
            "nbi"=>$request->input("nbi"),
            "police_clearance"=>$request->input("police_clearance"),
            "medical_clearance"=>$request->input("medical_clearance"),
        ]);

        $employeelist = Employee::all();

        echo($employeelist);
        
        return response()->json(['message' => 'Employee Updated', 'data'=> $employee, 'List'=> $employeelist], 200);
    } catch (\Throwable $error) {
        throw $error;
        
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $employee = Employee::find($id);

            if (!$employee){
                return response()->json(['message' => "Record Not Found"], 404);  
            }else{
                $employee->delete($id);
                $employeelist = Employee::all();
                return response()->json(['message' => 'Employee Deleted', 'data'=> $employee, 'List'=> $employeelist], 200);
            }
        } catch (\Throwable $error) {
            throw $error;
        }
    }
}