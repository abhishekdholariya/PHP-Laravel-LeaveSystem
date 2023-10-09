<x-app-layout>
    <div class="row layout-top-spacing card">
        <div class="col-12 card-body">
            <div class="card-title mb-4">
                <h3>Add a User </h3>
                <span>
                    Fill in the form below to add a new User
                </span>
            </div>
            @if (session()->has('success'))
                <div class="alert alert-light-success">
                    {{ session('success') }}
                </div>
            @endif


            <form action="{{ route('user.update', $user->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-4 my-1">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $user->name }}"
                                required>
                            @error('name')
                                <span class="text-danger mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 my-1">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" value="{{ $user->email }}" class="form-control"
                                required>
                            @error('email')
                                <span class="text-danger mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 my-1">
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="number" name="phone" value="{{ $user->phone }}" maxlength="10"
                                minlength="10" class="form-control" required>
                            @error('phone')
                                <span class="text-danger mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- departments --}}
                    @if (auth()->user()->role == '2')
                        <div class="col-12 col-sm-6 col-md-4 my-1">
                            <div class="form-group">
                                <label for="department">Department</label>

                                <select name="department_id" class="form-control">
                                    <option value="">Select Department</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}" @selected($department->id == $user->department_id)>
                                            {{ $department->name }}</option>
                                    @endforeach
                                </select>

                                @error('department_id')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    @else
                        <input type="hidden" name="department_id" value="{{ auth()->user()->department_id }}">
                    @endif
                    <div class="col-12 col-sm-6 col-md-4 my-1">
                        <div class="form-group">
                            <label for="role">Role</label>

                            <select name="role" class="form-control">
                                <option value="">Select role</option>
                                @foreach (config('role') as $key => $role)
                                    <option value="{{ $key }}" @selected($key == $user->role)>
                                       {{$role}}
                                    </option>
                                @endforeach
                            </select>

                            @error('role')
                                <span class="text-danger mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 my-1">
                        <div class="form-group">
                            <label for="password">Total Leaves</label>
                            <input type="number" name="leaves" class="form-control" value="{{$user->leaves}}" min="0" required>
                            @error('leaves')
                                <span class="text-danger mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-12 col-sm-6 col-md-4 my-1">
                        <div class="form-group">
                            <label for="password">Password
                                <span class="text-danger">
                                    <sub>
                                        (Leave blank if you don't want to change)
                                    </sub>
                                </span>
                            </label>
                            <input type="password" name="password" class="form-control">
                            @error('password')
                                <span class="text-danger mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 my-1">

                        <div class="form-group">
                            <label for="password">Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control">
                            @error('confirm_password')
                                <span class="text-danger mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 ">

                        <div class="form-group mt-3 ">
                            <button class="btn btn-primary">
                                Save
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
