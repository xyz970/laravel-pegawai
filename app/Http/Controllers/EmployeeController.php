<?php

namespace App\Http\Controllers;

use App\Models\EmployeeFees;
use App\Models\Employees;
use App\Traits\ApiResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $employees = Employees::all();
        return $this->successResponse($employees,'Success');
    }

    public function insertPost(Request $request)
    {
        $input = $request->only('nama','jabatan','gaji');
        $employee = new Employees;
        $employee_fees = new EmployeeFees;

        

        $id = Str::random(5);
        $employee->id = $id;
        $employee->nama = $input['nama'];
        $employee->gaji = $input['gaji'];
        $employee->jabatan = $input['jabatan'];
        

        $employee_fees->id = 'gaji-'.$id;
        $employee_fees->employee_id = $id;
        $employee_fees->bulan = Carbon::now()->format('F');
        $employee_fees->save();
        $employee->save();

       return $this->successResponse('','Data berhasil dimasukkan');
    }

    public function insertPut(Request $request,$id)
    {
        $input = $request->only('id','nama','jabatan','gaji');
        $employee = Employees::find($id);
        $employee_fees = new EmployeeFees;


        $employee->id = $input['id'];
        $employee->gaji = $input['gaji'];
        $employee->nama = $input['nama'];
        $employee->jabatan = $input['jabatan'];
        $employee->save();

        $employee_fees->id = 'gaji-'.$input['id'];
        $employee_fees->employee_id = $input['id'];
        $employee_fees->bulan = Carbon::now()->format('F');
        $employee_fees->save();

       return $this->successResponse('','Data berhasil dimasukkan');
    }

    public function detail($id)
    {
        $employee_fees = EmployeeFees::with('employee')->where('employee_id','=',$id)->get();
      return $this->successResponse($employee_fees,'');
    }
}
