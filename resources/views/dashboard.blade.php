<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="layout-top-spacing ">

        <div class="row">
            @if (auth()->user()->role != 0)
                <div class="col-xl-3 col-lg-6 col-md-6  mb-4">
                    <div class="card bg-primary">
                        <div class="card-body pt-3">
                            <h5 class="card-title mb-3">Total Users <span class="fs-6 fst-italic">
                                    ({{ auth()->user()->department->name ?? 'In system' }})</span></h5>
                            <h2 class="text-light">
                                {{ $user }}
                            </h2>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-xl-3 col-lg-6 col-md-6  mb-4">
                    <div class="card bg-primary">
                        <div class="card-body pt-3">
                            <h5 class="card-title mb-3">Remaining Leaves </h5>
                            <h2 class="text-light">
                                {{ auth()->user()->leaves - $remaining_leaves }} / {{ auth()->user()->leaves }}
                            </h2>
                        </div>
                    </div>
                </div>
            @endif

            {{-- <div class="col-xl-3 col-lg-6 col-md-6  mb-4">
                <div class="card bg-dark">
                    <div class="card-body pt-3">
                        <h5 class="card-title mb-3">Leave Request
                            <span class="fs-6 fst-italic"> (By others)</span>
                        </h5>
                        <h2 class="text-light">
                            @if (auth()->user()->role == 0)
                                <a href="{{ route('leave.requesting') }}">
                                @else
                                    <a href="{{ route('leave.index') }}">
                            @endif
                            {{ $request }}
                            </a>
                        </h2>
                    </div>
                </div>
            </div> --}}
            <div class="col-xl-3 col-lg-6 col-md-6  mb-4">
                <div class="card bg-success">
                    <div class="card-body pt-3">
                        @if (auth()->user()->role == 0)
                            <h5 class="card-title mb-3">
                                Your Approved Leaves
                            </h5>
                        @else
                            <h5 class="card-title mb-3">Approved Leave <span class="fs-6 fst-italic"> (By you)</span>
                            </h5>
                        @endif
                        <h2 class="text-light">
                            @if (auth()->user()->role != 0)
                                <a href="{{ route('leave.approved') }}">
                                @else
                                    <a href="#">
                            @endif
                            {{ $approved }}
                            </a>
                        </h2>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6  mb-4">
                <div class="card bg-danger">
                    <div class="card-body pt-3">
                        @if (auth()->user()->role == 0)
                            <h5 class="card-title mb-3">
                                Your Rejected Leaves
                            </h5>
                        @else
                            <h5 class="card-title mb-3">Rejected Leave <span class="fs-6 fst-italic"> (By you)</span>
                            </h5>
                        @endif
                        <h2 class="text-light">
                            @if (auth()->user()->role != 0)
                                <a href="{{ route('leave.rejected') }}">
                                @else
                                    <a href="#">
                            @endif
                            {{ $rejected }}
                            </a>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @if (auth()->user()->role != 0)
                <div class="table-responsive col-md-6 col-12">
                    <h5>
                        Today on leave
                    </h5>
                    <div class="card">

                        <table class="table table-hover table-bordered mb-0">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Department</th>
                                    <th>Role</th>
                                    <th>Type</th>
                                </tr>
                            </thead>
                            <tbody class="">
                                @foreach ($onleave as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->user->email }}</td>
                                        <td>{{ $item->user->department->name }}</td>
                                        <td>{{ config('role')[$item->user->role] }}</td>
                                        <td>{{ $item->type }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
