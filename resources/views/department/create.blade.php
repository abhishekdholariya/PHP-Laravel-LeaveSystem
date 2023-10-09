<x-app-layout>
    <div class="row layout-top-spacing card">
        <div class="col-12 card-body">
            <div class="card-title mb-4">
                <h3>Add a Department </h3>
                <span>
                    Fill in the form below to add a new department
                </span>
            </div>
            @if (session()->has('success'))
                <div class="alert alert-light-success">
                    {{ session('success') }}
                </div>
            @endif


            <form action="{{ route('department.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-12 col-sm-7 col-md-4">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" required>
                            @error('name')
                                <span class="text-danger mt-1">{{ $message }}</span>
                            @enderror
                        </div>
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
