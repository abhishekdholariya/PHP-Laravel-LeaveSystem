<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leave;
use PDF;

class Reportcontroller extends Controller
{
    public function waiting(){

        
        if (auth()->user()->role == 2) {

            $leaves = Leave::where('hod_status', 'approved')
                ->where('principal_status', 'pending')->orderBy('id', 'desc')
                ->paginate(10);
        } else if (auth()->user()->role == 1) {

            $leaves = Leave::whereHas('user', function ($query) {
                $query->where('department_id', auth()->user()->department_id);
            })
                ->where('user_id', '!=', auth()->user()->id)
                ->where('hod_status', 'pending')
                ->orderBy('id', 'desc')
                ->paginate(10);
        } else {
            $leaves = Leave::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->paginate(10);
        }


        $data=[
            'title'=>'Waiting Leave Report',
            'date'=>date('m/d/y'),
            'leaves'=>$leaves
        ];
        $pdf=PDF::loadView('leave.generatepdf',$data);
        return $pdf->download('reportdata.pdf');
    }


    public function approved(){

        
        if (auth()->user()->role == 2) {

            $leaves = Leave::where('principal_status', 'approved')->orderBy('id', 'desc')->paginate(10);
        } else if (auth()->user()->role == 1) {

            $leaves = Leave::whereHas('user', function ($query) {
                $query->where('department_id', auth()->user()->department_id);
            })
                ->where('user_id', '!=', auth()->user()->id)
                ->where('hod_status', 'approved')
                ->orderBy('id', 'desc')
                ->paginate(10);
        } else {
            $leaves = Leave::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->paginate(10);
        }

        $data=[
            'title'=>'Approved Leave Report',
            'date'=>date('m/d/y'),
            'leaves'=>$leaves
        ];
        $pdf=PDF::loadView('leave.generatepdf',$data);
        return $pdf->download('reportdata.pdf');
    }


    // report.
    
    public function rejected(){

        if (auth()->user()->role == 2) {

            $leaves = Leave::where('principal_status', 'rejected')->orderBy('id', 'desc')->paginate(10);
        } else if (auth()->user()->role == 1) {

            $leaves = Leave::whereHas('user', function ($query) {
                $query->where('department_id', auth()->user()->department_id);
            })
                ->where('user_id', '!=', auth()->user()->id)
                ->where('hod_status', 'rejected')
                ->orderBy('id', 'desc')
                ->paginate(10);
        } else {
            $leaves = Leave::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->paginate(10);
        }

        $data=[
            'title'=>'Rejected Leave Report',
            'date'=>date('m/d/y'),
            'leaves'=>$leaves
        ];
        $pdf=PDF::loadView('leave.generatepdf',$data);
        return $pdf->download('reportdata.pdf');
    }


}

