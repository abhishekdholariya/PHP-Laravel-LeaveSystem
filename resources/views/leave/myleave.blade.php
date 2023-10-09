<x-app-layout>
    <div class="row layout-top-spacing card">
        <div class="col-12 card-body">
            <div class="card-title mb-2">
                <h3>Leave</h3>
            </div>
            @if (session()->has('success'))
                <div class="alert alert-light-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="row mb-2">
                <div class="col-7 col-md-5">

                </div>
                <div class="col-5 col-md-7 text-end">
                    <a href="{{ route('leave.create') }}" class="btn btn-primary btn-rounded bs-tooltip"
                        data-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Add new ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 30 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-plus">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        <span class="btn-text-inner">
                            Apply for Leave
                        </span>
                    </a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-bordered table-sm">
                    <thead>
                        <tr class="bg-dark">
                            <th scope="col">Id</th>
                            <th scope="col">From </th>
                            <th scope="col">To</th>
                            <th scope="col">Reason</th>
                            <th scope="col">Status</th>
                            <th scope="col" width='15%' class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($leaves as $leave)
                            <tr onclick="window.location='{{ route('leave.show', $leave->id) }}'">
                                <td>{{ $loop->iteration }}</td>

                                <td>{{ $leave->from }}</td>
                                <td>{{ $leave->to }}</td>
                                <td>{{ Str::limit($leave->description, 60, '...') }}</td>

                                <td>
                                    @if ($leave->status == 'approved')
                                        <span class="badge badge-success">Approved</span>
                                    @elseif($leave->status == 'rejected')
                                        <span class="badge badge-danger">Rejected</span>
                                    @else
                                        <span class="badge badge-warning">Pending</span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    <div class="action-btns">



                                        {{-- <a href="{{ route('leave.edit', $leave->id) }}"
                                            class="action-btn btn-edit bs-tooltip me-2" data-toggle="tooltip"
                                            data-placement="top" title="" data-bs-original-title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-edit-2">
                                                <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                            </svg>
                                        </a> --}}
                                        <a onclick="javascript:if(confirm('Are you sure you want to delete this record: Leave  {{ $leave->from }}  to {{ $leave->to }} ?')){document.form{{ $leave->id }}.submit()}"
                                            class="action-btn btn-delete bs-tooltip" data-toggle="tooltip"
                                            data-placement="top" title="" data-bs-original-title="Delete">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-trash-2">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path
                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                </path>
                                                <line x1="10" y1="11" x2="10" y2="17">
                                                </line>
                                                <line x1="14" y1="11" x2="14" y2="17">
                                                </line>
                                            </svg>
                                        </a>
                                        <form action="{{ route('leave.destroy', $leave->id) }}" method="POST"
                                            name="form{{ $leave->id }}"
                                            onSubmit="return confirm('Are you want to Delete this leave sure?')">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>
            <div class="pb-3 ">
                {!! pagination($leaves) !!}
            </div>
        </div>
    </div>
</x-app-layout>
