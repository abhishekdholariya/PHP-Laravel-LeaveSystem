<x-app-layout>
    <div class="row layout-top-spacing card">
        <div class="col-12 card-body">
            <div class="card-title mb-2">
                <h3>   Leave Request by others <span class="fs-6 text-dark">
                   ( You are being requested for leave by others - subtitute)
                </span>
            </div>
            @if (session()->has('success'))
                <div class="alert alert-light-success">
                    {{ session('success') }}
                </div>
            @endif


            <div class="table-responsive">
                <table class="table table-hover table-bordered table-sm">
                    <thead>
                        <tr class="bg-dark">
                            <th scope="col">Id</th>
                            <th scope="col">Request by</th>
                            <th scope="col">From </th>
                            <th scope="col">To</th>
                            <th scope="col">Reason</th>
                            <th scope="col" width='15%' class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($leaves as $leave)
                            <tr onclick="window.location='{{ route('leave.show', $leave->id) }}'">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $leave->user->name ?? '' }}</td>
                                <td>{{ $leave->from }}</td>
                                <td>{{ $leave->to }}</td>
                                <td>{{ Str::limit($leave->description, 60, '...') }}</td>

                                <td class="text-center">
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
                                            Rejected by {{ $leave->substitute_staff_id == auth()->user()->id ? 'You' : 'Substitute' }}
                                        </label>
                                    @elseif ($leave->principal_status == 'approved')
                                        <label for="" class="text-light-dark">
                                            Approve by Principal
                                        </label>
                                    @elseif($leave->hod_status == 'approved')
                                        <label for="" class="text-light-dark">
                                            Approve by HOD
                                        </label>
                                    @elseif($leave->substitute_staff_status == 'approved')
                                        <label for="" class="text-light-dark">
                                            Approve by Substitute
                                        </label>
                                    @else
                                        <label for="" class="text-light-dark">Not Approved Yet</label>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>
            <div class="pb-3 ">
                {{-- {!! pagination($leaves) !!} --}}
            </div>
        </div>
    </div>
</x-app-layout>
