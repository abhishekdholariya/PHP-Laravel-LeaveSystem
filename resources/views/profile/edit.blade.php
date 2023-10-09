<x-app-layout>
    <div class="row layout-top-spacing card">
        <div class="col-12 card-body">
            <h5>
                Profile Update
            </h5>

            @if (session()->has('success'))
                <div class="alert alert-light-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-12 col-sm-6 col-md-4 my-1">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}"
                                required>
                            @error('name')
                                <span class="text-danger mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 my-1">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" value="{{ auth()->user()->email }}"
                                class="form-control" required>
                            @error('email')
                                <span class="text-danger mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 my-1">
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="number" name="phone" value="{{ auth()->user()->phone }}" maxlength="10"
                                minlength="10" class="form-control" required>
                            @error('phone')
                                <span class="text-danger mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4 my-1">
                        <div class="form-group">
                            <label for="profile">Profile</label>
                            <input type="file" name="profile" class="form-control" accept="image/*" required>
                            @error('profile')
                                <span class="text-danger mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                </div>

                <div class="row">

                    <div class="col-12 col-sm-6 col-md-4 my-1">
                        <div class="form-group">
                            <label for="password">Password<span class="text-danger">
                                    <sub>
                                        (Leave blank if you don't want to change)
                                    </sub>
                                </span></label>
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
