<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Leadsopedia | Admin</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="api-token" content="{{ auth()->user()->api_token }}">

    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/puse-icons-feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}">
    @yield('plugins_css')
    <link rel="stylesheet" href="{{ asset('vendors/sweetalert2/dist/sweetalert2.min.css') }}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('vendors/morris.js/morris.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- endinject -->
    <style>
        .swal2-popup {
            font-size: 1rem !important;
        }

        @media(min-width: 576px) {
            th.control {
                display: none !important;
            }

            td.control {
                display: none !important;
            }
        }

    </style>
    @yield('stylesheets')

    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" />
</head>

<body>
    <div class="container-scroller">

        @include('includes.navbar')

        <div class="container-fluid page-body-wrapper">
            @include('includes.sidebar')
            <div class="main-panel">
                @yield('content')

                @include('includes.footer')
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel-2">Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="form-change-password" action="{{ route('profile.change.password') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Current Password</label>
                            <input type="password" class="form-control" name="current_password" id="current_password"
                                placeholder="Enter password">
                        </div>
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" class="form-control" name="new_password" id="new_password"
                                placeholder="Enter password">
                        </div>
                        <div class="form-group">
                            <label>Confirm New Password</label>
                            <input type="password" class="form-control" name="new_confirm_password"
                                id="new_confirm_password" placeholder="Enter password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save</button>
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @yield('modals')
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <!-- plugins:js -->
    <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    @yield('plugins_js')
    <script src="{{ asset('vendors/moment/moment.min.js') }}"></script>
    <script src="{{ asset('vendors/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="{{ asset('js/off-canvas.js') }}"></script>
    <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('js/misc.js') }}"></script>
    <script src="{{ asset('js/settings.js') }}"></script>
    <script src="{{ asset('js/todolist.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <!-- End custom js for this page-->
    <script>
        $('.btn-change-password').on('click', function() {
            let changePasswordModal = $('#changePasswordModal');
            changePasswordModal.modal('toggle');
        });

        $('#form-change-password').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                success: function(resp) {
                    if (resp.success) {
                        $('#changePasswordModal').modal('hide');
                        Swal.fire(
                            'Success!',
                            resp.msg,
                            'success'
                        ).then(result => {
                            if (result) {
                                location.reload();
                            }
                        });
                    }
                },
                error: function(resp) {
                    let form = $('#form-change-password')
                    $.each(resp.responseJSON.errors, function(name, error) {
                        form.find('#' + name).siblings('.invalid-feedback').remove();
                        form.find('#' + name).siblings('.valid-feedback').remove();
                        form.find('#' + name).siblings('.invalid-feedback.valid-feedback')
                            .remove();
                        form.find('#' + name).addClass('is-invalid');
                        form.find('#' + name).after(`
                    <div class="invalid-feedback">
                    ${error}
                    </div>
                `);
                    });
                }
            });
        });
        $('#form-change-password').on('change keypress', 'input', function() {
            $(this).removeClass("is-invalid is-valid");
            $(this).siblings('.invalid-feedback').remove();
            $(this).siblings('.valid-feedback').remove();
        });

    </script>
    @yield('scripts')
</body>

</html>
