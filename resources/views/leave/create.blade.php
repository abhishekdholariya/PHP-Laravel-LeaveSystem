<x-app-layout>

    <x-slot:page_level_style>

        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="{{ asset('plugins/src/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('plugins/src/noUiSlider/nouislider.min.css') }}" rel="stylesheet" type="text/css">
        <!-- END THEME GLOBAL STYLES -->

        <!--  BEGIN CUSTOM STYLE FILE  -->
        <link href="{{ asset('assets/css/light/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('plugins/css/light/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">

    </x-slot:page_level_style>
    <div class="row layout-top-spacing card">
        <div class="col-12 card-body">
            <div class="card-title mb-4">
                <h3>
                    Apply for leave
                </h3>
                <span>
                    Fill in the form below to apply for leave
                </span>
            </div>
            @if (session()->has('success'))
                <div class="alert alert-light-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-light-danger">
                    {{ session('error') }}
                </div>
            @endif


            <form action="{{ route('leave.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-4 my-1">
                        <label for="">Data</label>
                        <input type="text" name="date" class="form-control flatpickr flatpickr-input active"
                            id="leaveDate" placeholder="Select Date " readonly="readonly" required>

                        @error('date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 my-1">
                        <label for="">Leave Type</label>
                        <select name="type" id="" class="form-control " required>
                            <option value="" required>Select Leave Type</option>
                            <option value="casual" required>Casual</option>
                            <option value="sick" required>Sick</option>
                            <option value="on duty" required>On duty</option>
                            <option value="c off" required>C off</option>
                            <option value="half" required>Half</option>
                            <option value="other" required>Other</option>
                        </select>

                        @error('type')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- <div class="col-12 col-sm-6 col-md-4 my-1">
                        <label for="">Substitute staff</label>
                        <select name="substitute_staff" id="" class="form-control">
                            <option value="">Select Substitute Staff</option>
                            @foreach ($substitute_staff as $staff)
                                <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                            @endforeach
                        </select>
                        @error('substitute_staff')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div> --}}

                    <div class="col-sm-12 col-md-8 my-1">
                        <label for="">Description</label>
                        <textarea name="description" id="" rows="6" class="form-control" required></textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-sm-12 col-md-8 my-1">
                        <label for="">Attachment</label>
                        <input type="file" name="attachment" id="" class="form-control">
                        @error('attachment')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 my-1">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <x-slot:page_level_script>
        <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="{{ asset('assets/js/scrollspyNav.js') }}"></script>
        <script src="{{ asset('plugins/src/flatpickr/flatpickr.js') }}"></script>

        <script src="{{ asset('plugins/src/flatpickr/custom-flatpickr.js') }}"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- END PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
        <script>
            const today = new Date();
            const tomorrow = new Date(today);
            tomorrow.setDate(today.getDate() + 1);
            var f3 = flatpickr(document.getElementById('leaveDate'), {
                mode: "range",
                minDate: tomorrow,
            });
        </script>
    </x-slot:page_level_script>
</x-app-layout>
