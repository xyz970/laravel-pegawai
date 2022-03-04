<?php

namespace App\Http\Controllers;

use App\Models\EmployeeFees;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class EmployeeFeesController extends Controller
{
    use ApiResponse;
    public function index($id)
    {
        $employeeFees = EmployeeFees::find('gaji-'.$id);
        $employeeFees->sudah_digaji = 'true';
        $employeeFees->update();

       return $this->successResponse('','Pegawai '.$employeeFees->nama.' telah digaji');
    }

    public function batchUpdate(Request $request)
    {
        $input = $request->all();
        EmployeeFees::whereIn('id',$input['id'])->update(['sudah_digaji'=>'true']);
        
        return $this->successResponse('Gaji karyawan telah dibayarkan');

    }

}
