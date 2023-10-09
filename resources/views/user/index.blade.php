<x-app-layout>
    <div class="row layout-top-spacing card">
        <div class="col-12 card-body">
            <div class="card-title mb-2">
                <h3>User</h3>
            </div>
            @if (session()->has('success'))
                <div class="alert alert-light-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="row mb-2">
                <div class="col-7 col-md-5">
                    {{-- <div class="form-inline my-2 my-lg-0 justify-content-center">
                        <div class="w-100 position-relative">
                            <input type="text" class="w-100 form-control product-search form-control-sm br-30 h-100 ps-5 "
                                id="input-search" style="height: 37px!important;" wire:model="search"
                                placeholder="Search users...">


                            <div class=" bg-transparent position-absolute px-2  rounded-5 " style="left: 0;top:5px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-search">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                </svg>
                            </div>
                        </div>
                    </div> --}}
                </div>
                <div class="col-5 col-md-7 text-end">
                    <a href="{{ route('user.create') }}" class="btn btn-primary btn-rounded bs-tooltip" data-toggle="tooltip"
                    data-placement="top" title="" data-bs-original-title="Add new ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 30 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-plus">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        <span class="btn-text-inner">Add a User</span>
                    </a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-bordered table-sm">
                    <thead>
                        <tr class="bg-dark">
                            <th scope="col" width='7%'>Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Department</th>
                            <th scope="col">Remaining leaves</th>
                            <th scope="col">Role</th>
                            <th scope="col" width='15%' class="text-center">Action</th>

                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->department->name ?? '' }}</td>
                                <td>{{$user->remaining_leaves}}</td>
                                <td>{{  config('role')[$user->role] }}</td>

                                <td class="text-center">
                                    <div class="action-btns">

                                        <a href="{{ route('user.edit', $user->id) }}"
                                            class="action-btn btn-edit bs-tooltip me-2" data-toggle="tooltip"
                                            data-placement="top" title="" data-bs-original-title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-edit-2">
                                                <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                            </svg>
                                        </a>

                                        <a onclick="javascript:if(confirm('Are you sure you want to delete this record: {{ $user->name }}?')){document.form{{ $user->id }}.submit()}"
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
                                        <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                            name="form{{ $user->id }}"
                                            onSubmit="return confirm('Are you want to Delete this User sure?')">
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
                {!! pagination($users) !!}
            </div>
        </div>
    </div>
    </x-app-layout>
