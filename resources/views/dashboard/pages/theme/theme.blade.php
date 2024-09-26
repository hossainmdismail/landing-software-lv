@extends('dashboard.layouts.app')
@section('title')
    Profile
@endsection
@section('style')
    <link href="{{ asset('dashboard_assets/vendor/lightgallery/css/lightgallery.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard_assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <!-- Theme Upload Modal -->
    <div class="modal fade" id="exampleModalCenter">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="uploadForm" action="{{ route('zip.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Upload Theme</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-light solid alert-square"><strong>Warning!</strong>The theme file should
                            have a
                            zip file</div>
                        <div id="message"></div>

                        <div class="my-3">
                            <input class="form-control" type="file" name="theme_zip" id="theme_zip" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary d-flex align-items-center">
                            <span>Upload</span>
                            <div style="margin-left: 4px" class="d-none spinner-border spinner-border-sm" id="loading"
                                role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="page-titles">
        <h4>Themes</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">appearance</a></li>
        </ol>
    </div>
    <div class="container">
        <div class="row">
            {{-- Top Badge --}}
            <div class="card">
                <div class="d-flex justify-content-between align-items-center p-3">
                    <strong>Theme ({{ count($themes) }})</strong>

                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#exampleModalCenter">Upload Theme</button>
                </div>
            </div>

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    <strong>Broken Theme! </strong>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Card --}}
            @foreach ($themes as $theme)
                <div class="col-md-6 col-lg-4">
                    <div class="card rounded-md"
                        style="{{ session('slug') == $theme['directory'] ? 'border: 4px solid #fd8f8f' : '' }}">
                        <div class="card-body">
                            <img src="{{ asset($theme['thumbnail_url']) }}" width="100%" alt="">
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5>{{ $theme['name'] }}</h5>
                                @if ($theme['preview_mood'])
                                    <a href="{{ route('appearance.preview', $theme['directory']) }}">Preview</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            // AJAX setup to include CSRF token in request headers
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#uploadForm').on('submit', function(e) {
                e.preventDefault();

                var formData = new FormData(this);
                $('#loading').removeClass('d-none');

                $.ajax({
                    type: 'POST',
                    url: '{{ route('zip.upload') }}', // Adjust the route as needed
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('#loading').hide();

                        if (response.success) {
                            $('#message').html('<p style="color: green;">' + response.message +
                                '</p>');
                            setTimeout(function() {
                                $('#message').html('<p style="color: green;">' +
                                    'Preparing theme installation' +
                                    '</p>');
                                location.reload();
                            }, 1000);
                        } else {
                            $('#message').html('<p style="color: red;">' + response.message +
                                '</p>');
                        }
                    },
                    error: function(xhr, status, error) {
                        $('#loading').hide(); // Hide loading indicator
                        $('#message').html('<p style="color: red;">File upload failed!</p>');
                    }
                });
            });
        })
    </script>
@endsection
