<x-app-layout>
    <div class="row layout-top-spacing card">
        <div class="col-12 card-body">
            <div class="card-title mb-4">
                <h3>Update Department </h3>
                <span>
                    Fill in the form below to update  department
                </span>
            </div>
            @if (session()->has('success'))
                <div class="alert alert-light-success">
                    {{ session('success') }}
                </div>
            @endif


            <form action="{{ route('department.update',$department->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12 col-sm-7 col-md-4">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" value="{{$department->name}}" required>
                            @error('name')
                                <span class="text-danger mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-3 ">
                            <button class="btn btn-primary">
                                Update
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
