<x-app-layout>
    <div class="row layout-top-spacing card">
        <div class="col-12 card-body">
            @if (session()->has('success'))
                <div class="alert alert-light-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="row mb-2">
                @if ($leave->user_id != auth()->user()->id)
                    <div class="col-12 my-2 text-end">
                        <a href="{{ route('leave.approve', $leave->id) }}" class="btn btn-primary">
                            Approve
                        </a>

                        <a href="{{ route('leave.reject', $leave->id) }}" class="ms-2 btn btn-danger">
                            Reject
                        </a>
                    </div>
                @endif
                <div class="col-12 col-sm-6 col-md-4 my-1">
                    <strong class="fw-bold text-dark fs-6">Name</strong><br>
                    <label for="" class="text-light-dark">{{ $leave->user->name ?? '' }} </label>
                </div>
                <div class="col-12 col-sm-6 col-md-4 my-1">
                    <strong class="fw-bold text-dark fs-6">Email</strong><br>
                    <label for="" class="text-light-dark">{{ $leave->user->email }} </label>
                </div>
                <div class="col-12 col-sm-6 col-md-4 my-1">
                    <strong class="fw-bold text-dark fs-6">Phone</strong><br>
                    <label for="" class="text-light-dark">{{ $leave->user->phone }} </label>
                </div>
                <div class="col-12 col-sm-6 col-md-4 my-1">
                    <strong class="fw-bold text-dark fs-6">Leave Start Date</strong><br>
                    <label for="" class="text-light-dark">{{ date('d-m-Y', strtotime($leave->from)) }} </label>
                </div>
                <div class="col-12 col-sm-6 col-md-4 my-1">
                    <strong class="fw-bold text-dark fs-6">Leave End Date</strong><br>
                    <label for="" class="text-light-dark">{{ date('d-m-Y', strtotime($leave->to)) }} </label>
                </div>
                <div class="col-12 col-sm-6 col-md-4 my-1">
                    <strong class="fw-bold text-dark fs-6">How many days </strong><br>
                    <label for="" class="text-light-dark">{{ $leave->days }} </label>
                </div>





                {{-- @if ($leave->user_id == auth()->user()->id) --}}
                <div class="col-12 col-sm-6 col-md-4 my-1">

                    @if (
                        $leave->principal_status == 'rejected' ||
                            $leave->hod_status == 'rejected' ||
                            $leave->substitute_staff_status == 'rejected')
                        <strong class="fw-bold text-dark fs-6"> Rejected by </strong><br>
                        @if ($leave->principal_status == 'rejected')
                            <label for="" class="text-light-dark">
                                Rejected by Principal
                            </label>
                        @elseif($leave->hod_status == 'rejected')
                            <label for="" class="text-light-dark">
                                Rejected by HOD
                            </label>
                        @elseif($leave->substitute_staff_status == 'rejected')
                            <label for="" class="text-light-dark">
                                Rejected by
                                {{ $leave->substitute_staff_id == auth()->user()->id ? 'You' : 'Substitute' }}
                            </label>
                        @else
                            <label for="" class="text-light-dark">Not Approved Yet</label>
                        @endif
                    @else
                        <strong class="fw-bold text-dark fs-6"> Approved by </strong><br>
                        @if ($leave->principal_status == 'approved')
                            <label for="" class="text-light-dark">
                                Approve by Principal
                            </label>
                        @elseif($leave->hod_status == 'approved')
                            <label for="" class="text-light-dark">
                                Approve by HOD
                            </label>
                        @elseif($leave->substitute_staff_status == 'approved')
                            <label for="" class="text-light-dark">
                                Approve by
                                {{ $leave->substitute_staff_id == auth()->user()->id ? 'You' : 'Substitute' }}
                            </label>
                        @else
                            <label for="" class="text-light-dark">Not Approved Yet</label>
                        @endif
                    @endif
                </div>
                <div class="col-12 col-sm-6 col-md-4 my-1">
                    <strong class="fw-bold text-dark fs-6"> Status </strong><br>
                    @if ($leave->status == 'approved')
                        <label for="" class="text-light badge bg-success rounded">Approved</label>
                    @elseif($leave->status == 'rejected')
                        <label for="" class="text-light badge bg-danger rounded">Rejected</label>
                    @else
                        <label for="" class="text-light badge bg-warning rounded">Pending</label>
                    @endif
                </div>
                {{-- @endif --}}
                @if ($leave->attachment != '')
                    <div class="col-12 col-sm-6 col-md-4 my-1">
                        <strong class="fw-bold text-dark fs-6"> Attachment </strong><br>
                        <a href="{{ asset($leave->attachment) }}" target="_blank" download="{{ $leave->attachment }}"
                            class="link-primary">
                            Download
                        </a>
                    </div>
                @endif

                <div class="col-sm-6  my-1">
                    <strong class="fw-bold text-dark fs-6"> Reason </strong><br>
                    <label for="" class="text-light-dark">{{ $leave->description }} </label>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
