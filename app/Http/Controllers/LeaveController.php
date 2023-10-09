<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Termwind\Components\Dd;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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



        return view('leave.index', compact('leaves'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $substitute_staff = User::where('role', 0)
        //     ->where('id', '!=', auth()->user()->id)
        //     ->where('department_id', auth()->user()->department_id)
        //     ->get();
        // return view('leave.create', compact('substitute_staff'));
        return view('leave.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd( $request->all());

        $request->validate([
            'description' => 'required',
            'date' => 'required',
            'type' => 'required',
            // 'substitute_staff' => 'required',
        ]);

        $date = explode(' to ', $request->date);
        $from = $date[0];

        if (isset($date[1])) {
            $to = $date[1];
        } else {
            $to = $date[0];
        }
        $days = date_diff(date_create($from), date_create($to));

        $days = $days->format('%a') + 1;
        if ($days > auth()->user()->leaves) {
            $remaining_leaves  = Leave::select(DB::raw('SUM(DATEDIFF(leaves.to, leaves.from) + 1) AS remaining_leaves'))
                ->where('user_id', auth()->user()->id)
                ->where('status', '!=', 'rejected')
                ->first()->remaining_leaves;
            return redirect()->back()->with('error', 'You have only ' . (auth()->user()->leaves - $remaining_leaves) . ' leaves left');
        }

        $leave = new Leave();
        $leave->user_id = auth()->user()->id;
        $leave->description = $request->description;
        $leave->from = $from;
        $leave->to = $to;
        // $leave->substitute_staff_id = $request->substitute_staff;
        $leave->type = $request->type;
        if ($request->has('attachment')) {
            $leave->attachment = fileupload($request->attachment, 'public/attachment');
        }
        $leave->save();

        $send_to = User::where('role', 1)->where('department_id', auth()->user()->department_id)->first();

        // sedn mail
        $data = array(
            'staff' => auth()->user()->name,
            'hod_name' => $send_to->name,
            'subject' => 'Request for Leave',
            'from' => date_format(date_create($from), 'd-m-Y'),
            'to' => date_format(date_create($to), 'd-m-Y'),
            'type' => $request->type,
            'description' => $request->description,
            'url' => route('leave.show', $leave->id),
        );

        $send = [
            'to' => $send_to->email,
            'subject' => 'Request for Leave',
            'from' => auth()->user()->email,
            'toname' => auth()->user()->name,
            'fromname' => $send_to->name,
        ];
        // Mail::send('mail.leave-application', $data, function ($message) use ($send) {
        //     $message->to($send['to'], $send['toname'])->subject($send['subject']);
        //     $message->from($send['from'], $send['fromname']);
        // });


        return redirect()->route('leave.index')->with('success', 'Leave applied successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if ($id == 'myleave') {
            $leaves = Leave::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->paginate(10);
            return view('leave.myleave', compact('leaves'));
        }

        // find leave with day defirence between from and to
        $leave = Leave::select('*', DB::raw('DATEDIFF(DATE_ADD(`to`, INTERVAL 1 DAY), `from`) AS days'))->whereId($id)->first();


        return view('leave.show', compact('leave'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $leave = Leave::find($id);
        $leave->delete();
        return redirect()->route('leave.index')->with('success', 'Leave deleted successfully');
    }

    // approve
    public function approve(string $id)
    {

        $leave = Leave::find($id);
        if (auth()->user()->role == 0) {
            $leave->substitute_staff_status = 'approved';
            $role  = 1;
        } else if (auth()->user()->role == 1) {
            $leave->hod_status = 'approved';
            $role  = 2;
        } else if (auth()->user()->role == 2) {
            $leave->principal_status = 'approved';
            $leave->status = 'approved';
        }
        $leave->save();

        $user = User::find($leave->user_id);
        $data = array(
            'name' => $user->name,
            'subject' => 'Leave Approved',
            'description' => $leave->description,
            'approved_by' => auth()->user()->name,
            'role' => config('role')[auth()->user()->role],
            'from' => date_format(date_create($leave->from), 'd-m-Y'),
            'to' => date_format(date_create($leave->to), 'd-m-Y'),
            'url' => route('leave.show', $leave->id),
        );

        $send = [
            'to' => $user->email,
            'subject' => 'Leave Approved by ' . config('role')[auth()->user()->role] . '',
            'from' => auth()->user()->email,
            'toname' => $user->name,
            'fromname' => auth()->user()->name,
        ];
        // Mail::send('mail.leave-approved', $data, function ($message) use ($send) {
        //     $message->to($send['to'], $send['toname'])->subject($send['subject']);
        //     $message->from($send['from'], $send['fromname']);
        // });


        if (auth()->user()->role == 2) {
            return redirect()->route('leave.index')->with('success', 'Leave approved successfully');
        }
        $superior = User::where('role', $role)->where('department_id', auth()->user()->department_id)->first();
        if (auth()->user()->role == 1) {
            $superior = User::where('role', 2)->first();
        }
        $data = array(
            'name' => $superior->name,
            'subject' => 'Leave Approved',
            'approved_by' => auth()->user()->name,
            'description' => $leave->description,
            'role' => config('role')[auth()->user()->role],
            'from' => date_format(date_create($leave->from), 'd-m-Y'),
            'to' => date_format(date_create($leave->to), 'd-m-Y'),
            'url' => route('leave.show', $leave->id),
        );

        $send = [
            'to' => $superior->email,
            'subject' => 'Leave Approved by ' . config('role')[auth()->user()->role] . '',
            'from' => auth()->user()->email,
            'toname' => $superior->name,
            'fromname' => auth()->user()->name,
        ];

        //  send mail to uper level
        // Mail::send('mail.leave-request-to-next', $data, function ($message) use ($send) {
        //     $message->to($send['to'], $send['toname'])->subject($send['subject']);
        //     $message->from($send['from'], $send['fromname']);
        // });

        if (auth()->user()->role == 0) {
            return redirect()->route('leave.requesting')->with('success', 'Leave approved successfully');
        }
        return redirect()->route('leave.index')->with('success', 'Leave approved successfully');
    }

    // reject
    public function reject(string $id)
    {
        $leave = Leave::find($id);
        if (auth()->user()->role == 0) {
            $leave->substitute_staff_status = 'rejected';
            $leave->hod_status = 'pending';
            $leave->principal_status = 'pending';
        } else if (auth()->user()->role == 1) {
            $leave->hod_status = 'rejected';
            $leave->principal_status = 'pending';
        } else if (auth()->user()->role == 2) {
            $leave->principal_status = 'rejected';
        }
        $leave->status = 'rejected';
        $leave->save();

        if (auth()->user()->role == 0) {
            return redirect()->route('leave.requesting')->with('success', 'Leave rejected successfully');
        }

        return redirect()->route('leave.index')->with('success', 'Leave rejected successfully');
    }

    // approved
    public function approved()
    {

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



        return view('leave.index', compact('leaves'));
    }

    // rejected
    public function rejected()
    {

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

        return view('leave.index', compact('leaves'));
    }
    // requesting
    public function requesting()
    {
        $leaves = Leave::where('substitute_staff_id', auth()->user()->id)->orderBy('id', 'desc')->paginate(10);
        return view('leave.requesting', compact('leaves'));
    }
}
