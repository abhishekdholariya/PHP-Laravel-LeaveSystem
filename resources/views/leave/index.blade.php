<x-app-layout>
    <div class="row layout-top-spacing card">
        <div class="col-12 card-body">
            <div class="card-title mb-2">
                <h3>Leaves</h3>
            </div>
            @if (session()->has('success'))
                <div class="alert alert-light-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="">
                @if(Route::is('leave.index'))
                    <button type="button" class="btn btn-dark"><a href="{{route('report.waiting')}}" class="text-white">Report</a></button>
                @elseif (Route::is('leave.approved'))
                <button type="button" class="btn btn-dark"><a href="{{route('report.approved')}}" class="text-white">Report</a></button>
                @elseif (Route::is('leave.rejected'))
                <button type="button" class="btn btn-dark"><a href="{{route('report.rejected')}}" class="text-white">Report</a></button>
                @endif
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-sm">
                    <thead>
                        <tr class="bg-dark">
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
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
                                            Rejected by Substitute
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
                {!! pagination($leaves) !!}
            </div>
        </div>
    </div>
</x-app-layout>
