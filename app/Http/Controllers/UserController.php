<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->role == 2) {
            // $users = User::where('role', '!=', 3)->orderBy('id', 'desc')->paginate(15);
            $users = User::select('users.*', DB::raw('users.leaves - COALESCE(SUM(DATEDIFF(leaves.to, leaves.from) + 1), 0) AS remaining_leaves'))
                ->where('role', '!=', 2)
                ->leftJoin('leaves', 'users.id', '=', 'leaves.user_id')
                ->groupBy('users.id', 'users.name', 'users.email', 'users.leaves')
                ->orderBy('users.id', 'desc')
                ->paginate(15);
        } else if (auth()->user()->role == 1) {
            $users =
                User::select('users.*', DB::raw('users.leaves - COALESCE(SUM(DATEDIFF(leaves.to, leaves.from) + 1), 0) AS remaining_leaves'))
                ->where('role', '!=', 2)
                ->where('users.id', '!=', auth()->user()->id)->where('department_id', auth()->user()->department_id)
                ->leftJoin('leaves', 'users.id', '=', 'leaves.user_id')
                ->groupBy('users.id', 'users.name', 'users.email', 'users.leaves')
                ->orderBy('users.id', 'desc')
                ->paginate(15);
        } else {
            $users = User::where('id', auth()->user()->id)->orderBy('id', 'desc')->paginate(15);
        }
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        return view('user.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required | max:255',
                'email' => 'required | email|max:255|unique:users',
                'phone' => 'required | max:255|digits:10|unique:users,phone',
                'department_id' => 'required | exists:departments,id',
                'role' => 'required ',
                'leaves' => 'required | numeric',
                'password' => 'required ',
                'confirm_password' => 'required | same:password',
            ],
            [
                'name.required' => 'Name is required',
                'email.required' => 'Email is required',
                'phone.required' => 'Phone is required',
                'department_id.required' => 'Department is required',
                'role.required' => 'Role is required',
                'password.required' => 'Password is required',
                'confirm_password.required' => 'Confirm password is required',
                'confirm_password.same' => 'Confirm password must be same as password',
            ]
        );

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'department_id' => $request->department_id,
            'role' => $request->role,
            'leaves' => $request->leaves,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('user.index')->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        $departments = Department::all();
        return view('user.edit', compact('user', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate(
            $request,
            [
                'name' => 'required | max:255',
                'email' => 'required | email|max:255|unique:users,email,' . $id,
                'phone' => 'required | max:255|digits:10|unique:users,phone,' . $id,
                'department_id' => 'required | exists:departments,id',
                'leaves' => 'required',
                'role' => 'required ',
                'confirm_password' => 'same:password',
            ],
            [
                'name.required' => 'Name is required',
                'email.required' => 'Email is required',
                'phone.required' => 'Phone is required',
                'department_id.required' => 'Department is required',
                'role.required' => 'Role is required',
                'confirm_password.same' => 'Confirm password must be same as password',
            ]
        );

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->department_id = $request->department_id;
        $user->role = $request->role;
        $user->leaves = $request->leaves;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('user.index')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User deleted successfully');
    }
}
