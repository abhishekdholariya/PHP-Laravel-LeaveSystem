<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $today = date('Y-m-d');
        $remaining_leaves = 0;
        if (auth()->user()->role == 2) {

            $user = User::where('role', '!=', 2)->count();
            $request = Leave::where('hod_status', 'approved')
                ->where('principal_status', 'pending')
                ->orWhere(function ($query) {
                    $query->where('substitute_staff_status', 'approved')
                        ->where('hod_status', 'pending')
                        ->whereHas('user', function ($query) {
                            $query->where('role', 1);
                        });
                })
                ->whereNull('principal_status')
                ->whereDate('from', '>=', $today)
                ->count();

            $approved = Leave::where('principal_status', 'approved')
                ->whereDate('from', '>=', $today)->count();

            $rejected = Leave::where('principal_status', 'rejected')
                ->whereDate('from', '>=', $today)->count();


            $onleave = Leave::where('status', 'approved')

                ->where(function ($q) use ($today) {
                    return $q->whereBetween('from', [$today, $today])
                        ->orWhereBetween('to', [$today, $today]);
                })->get();
        } else if (auth()->user()->role == 1) {

            $user = User::where('role', '!=', 2)->where('id', '!=', auth()->id())->whereHas('department', function ($q) {
                return $q->where('department_id', auth()->user()->department_id);
            })->count();

            $request = Leave::whereHas('user', function ($query) {
                $query->where('department_id', auth()->user()->department_id);
            })
                ->where('user_id', '!=', auth()->user()->id)
                ->where('substitute_staff_status', 'approved')
                ->where('hod_status', 'pending')
                ->orderBy('id', 'desc')
                ->whereDate('from', '>=', $today)
                ->whereHas('user', function ($q) {
                    return $q->where('department_id', auth()->user()->department_id);
                })
                ->count();

            $approved = Leave::where('hod_status', 'approved')
                ->whereHas('user', function ($q) {
                    return $q->where('department_id', auth()->user()->department_id);
                })
                ->whereDate('from', '>=', $today)->count();

            $rejected = Leave::where('hod_status', 'rejected')
                ->whereHas('user', function ($q) {
                    return $q->where('department_id', auth()->user()->department_id);
                })
                ->whereDate('from', '>=', $today)->count();



            $onleave = Leave::where('status', 'approved')
                ->whereHas('user', function ($q) {
                    return $q->where('department_id', auth()->user()->department_id);
                })
                ->where(function ($q) use ($today) {
                    return $q->whereBetween('from', [$today, $today])
                        ->orWhereBetween('to', [$today, $today]);
                })->get();
        } else {
            $user = 0;
            $request =  Leave::where('substitute_staff_status', 'pending')
                ->where('substitute_staff_id', auth()->user()->id)
                ->whereDate('from', '>=', $today)->count();
            $approved = Leave::where('status', 'approved')
                ->where('user_id', auth()->user()->id)
                ->whereDate('from', '>=', $today)->count();
            $rejected = Leave::where('status', 'rejected')
                ->where('user_id', auth()->user()->id)
                ->whereDate('from', '>=', $today)->count();
            $onleave = [];
            $remaining_leaves  = Leave::select(DB::raw('SUM(DATEDIFF(leaves.to, leaves.from) + 1) AS remaining_leaves'))
                ->where('user_id', auth()->user()->id)
                ->where('status', '!=', 'rejected')
                ->first()->remaining_leaves;
        }
        $data  = [
            'user' => $user,
            'request' => $request,
            'approved' => $approved,
            'rejected' => $rejected,
            'onleave' => $onleave,
            'remaining_leaves' => $remaining_leaves

        ];
        return view('dashboard', $data);
    }
}
