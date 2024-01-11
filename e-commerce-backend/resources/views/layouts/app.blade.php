<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>E-commerce App Admin</title>

    {{-- font family roboto --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">

    {{-- bootstrap css1 js1 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    {{-- fontawesome css1 --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- datatables css1 --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.4.1/css/rowReorder.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">

    {{-- sweetalert css1 js1 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.2/dist/sweetalert2.min.css">

    <!-- summernote css1 js1 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.css"
        integrity="sha512-ngQ4IGzHQ3s/Hh8kMyG4FC74wzitukRMIcTOoKT3EyzFZCILOPF0twiXOQn75eDINUfKBYmzYn2AA8DkAk8veQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- select2 css1 js1 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}

    {{-- custom css --}}
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
</head>

<body>
    <div class="page-wrapper chiller-theme">
        <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
            <i class="fas fa-bars"></i>
        </a>
        <nav id="sidebar" class="sidebar-wrapper" style="z-index: 100">
            <div class="sidebar-content">
                <div class="sidebar-brand">
                    <a href="#">E-commmerce Admin</a>
                    <div id="close-sidebar">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                <div class="sidebar-header">
                    <div class="user-pic">
                        @if (Auth::user()->image)
                            <img src="{{ Auth::user()->image_url }}" alt="user" class="img-responsive img-rounded">
                        @else
                            @if (Auth::user()->gender == 'male')
                                <img src="{{ asset('storage/admins/default_male.png') }}" alt="user"
                                    class="img-responsive img-rounded" />
                            @else
                                <img src="{{ asset('storage/admins/default_female.png') }}" alt="user"
                                    class="img-responsive img-rounded" />
                            @endif
                        @endif
                    </div>
                    <div class="user-info">
                        <span class="user-name">
                            {{ Auth::user()->name }}
                        </span>
                        <span class="user-role"></span>
                        <span class="user-status">
                            <i class="fa fa-circle"></i>
                            <span>Online</span>
                        </span>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul>
                        <li class="header-menu">
                            <span>Menu</span>
                        </li>
                        <li class="">
                            <a href="/">
                                <i class="fa fa-home"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        @can('view')
                            <li class="">
                                <a href="{{ route('product.index') }}">
                                    <i class="fa fa-briefcase" aria-hidden="true"></i>
                                    <span>Product</span>
                                </a>
                            </li>
                        @endcan

                        @can('view')
                            <li class="">
                                <a href="{{ route('category.index') }}">
                                    <i class="fa-solid fa-list"></i>
                                    <span>Categories</span>
                                </a>
                            </li>
                        @endcan

                        @can('view')
                            <li class="">
                                <a href="{{ route('color.index') }}">
                                    <i class="fa fa-list" aria-hidden="true"></i>
                                    <span>Colors</span>
                                </a>
                            </li>
                        @endcan

                        @can('view')
                            <li class="">
                                <a href="{{ route('brand.index') }}">
                                    <i class="fa fa-list"></i>
                                    <span>Brands</span>
                                </a>
                            </li>
                        @endcan

                        @can('view_employee')
                            <li class="">
                                <a href="{{ route('employee.index') }}">
                                    <i class="fa-solid fa-people-carry-box"></i>
                                    <span>Employees</span>
                                </a>
                            </li>
                        @endcan

                        @can('view_role')
                            <li class="">
                                <a href="{{ route('role.index') }}">
                                    <i class="fa fa-user-shield"></i>
                                    <span>Roles</span>
                                </a>
                            </li>
                        @endcan

                        @can('view_permission')
                            <li class="">
                                <a href="{{ route('permission.index') }}">
                                    <i class="fa fa-shield-alt"></i>
                                    <span>Permissions</span>
                                </a>
                            </li>
                        @endcan

                        <li class="">
                            <a href="{{ route('product-transations') }}?status=add">
                                <i class="fa fa-exchange"></i>
                                <span>Product Transactions</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- sidebar-menu  -->
            </div>
            <!-- sidebar-content  -->
        </nav>
        <header class="container-fluid bg-second shadow-lg">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center py-2">
                    <p class="fs-4 mb-0">@yield('title')</p>
                    <div class="dropdown">
                        <div class="" data-bs-toggle="dropdown" data-bs-target="#dropdownMenuButton">
                            <div class="d-flex flex-column align-items-center">
                                @if (Auth::user()->image)
                                    <img src="{{ Auth::user()->image_url }}" alt="user"
                                        class="navbar-profile-img">
                                @else
                                    @if (Auth::user()->gender == 'male')
                                        <img src="{{ asset('storage/admins/default_male.png') }}" alt="user"
                                            class="navbar-profile-img" />
                                    @else
                                        <img src="{{ asset('storage/admins/default_female.png') }}" alt="user"
                                            class="navbar-profile-img" />
                                    @endif
                                @endif
                                <span>{{ Auth::user()->name }}</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                        </div>
                        <div id="dropdownMenuButton" class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{ route('profile.index') }}">Profile Detail</a>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">Edit Profile</a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                data-bs-target="#logoutBtn">Log
                                Out</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="py-4 content overflow-scroll">
            <div class="col-md-8 mx-auto">
                @if (request()->is('*/create') || request()->is('*/*/edit') || request()->is('*/*/show') || request()->is('*/edit'))
                    <a href="@yield('back_button')" class="btn btn-dark mb-4">
                        <i class="fas fa-arrow-left"></i>
                        Back
                    </a>
                @endif
                @yield('content')
            </div>
        </div>
    </div>
    {{-- <div class="">
        @yield('content')
    </div> --}}

    {{-- modal for logout --}}
    <!-- Modal -->
    <div class="modal fade" id="logoutBtn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Log Out</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to log out ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Log Out</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- bootstrap css1 js1 --}}
    {{-- jquery js1 --}}
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>

    {{-- bootstrap css1 js1 --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    {{-- datatables js1 --}}
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.4.1/js/dataTables.rowReorder.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.jsdelivr.net/g/mark.js(jquery.mark.min.js),datatables.mark.js"></script>

    <!-- Laravel Javascript Validation -->
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>

    {{-- sweetalert css1 js1 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.2/dist/sweetalert2.all.min.js"></script>

    <!-- summernote css1 js1 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.js"
        integrity="sha512-6F1RVfnxCprKJmfulcxxym1Dar5FsT/V2jiEUvABiaEiFWoQ8yHvqRM/Slf0qJKiwin6IDQucjXuolCfCKnaJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- select2 css1 js1 --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}

    <script>
        @if (session('success'))
            Swal.fire({
                title: 'Success!',
                text: "{{ session('success') }}",
                icon: "success",
                confirmButtonText: 'Continue',
            });
        @endif

        // helpers
        const formatCurrency = (value) => new Intl.NumberFormat("en-us", {
            style: "currency",
            currency: "MMK",
        }).format(value);

        // sidebar outside click
        const sidebar = document.getElementById("sidebar");

        document.addEventListener("click", (e) => {
            if (sidebar && !sidebar.contains(e.target)) sidebar.closest(".page-wrapper").classList.remove(
                "toggled");
        }, true)

        $(document).ready(function() {
            // csrf_token setup
            $csrfToken = document.querySelector("meta[name='csrf-token']").content;
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $csrfToken,
                },
            })

            // sidebar
            $("#close-sidebar").click(function(e) {
                e.preventDefault();
                $(".page-wrapper").removeClass("toggled");
            });
            $("#show-sidebar").click(function(e) {
                e.preventDefault();
                $(".page-wrapper").addClass("toggled");
            });

            // datatable default config
            $.extend(true, $.fn.dataTable.defaults, {
                mark: true,
                processing: true,
                serverSide: true,
                responsive: true,
                columnDefs: [{
                        target: 0,
                        class: "control",
                    },
                    {
                        target: "priority",
                        responsivePriority: 1,
                    },
                    {
                        target: "priority2",
                        responsivePriority: 2,
                    },
                    {
                        target: "no-sort",
                        sortable: false,
                    },
                    {
                        target: "no-search",
                        searchable: false,
                    },
                    {
                        target: "no-order",
                        orderable: false,
                    },
                    {
                        target: "hidden",
                        visible: false,
                    }
                ],
            });

            // sweetalert2 for delete (for reusable purpose)
            $(document).on("click", ".delete-btn", function(e) {
                e.preventDefault();
                $url = $(this).data("url");
                Swal.fire({
                    title: `Are you sure you want to delete ?`,
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            method: "DELETE",
                            url: $url,
                            success: () => {
                                Swal.fire({
                                    title: "Deleted Succesfully!",
                                    icon: "success",
                                });
                                $table.ajax.reload();
                            },
                            error: () => {
                                Swal.fire({
                                    title: "Error",
                                    text: "Something's wrong! Please Try Again",
                                    icon: "Error",
                                });
                            }
                        })
                    }
                });
            })

            // preview img
            $(".close-btn").click(function() {
                $(".image").val("");
                $previewImg.find("img").not(".data-image").remove();
                $previewImg.find("img.data-image").show();
                $(this).addClass("d-none");
                $(this).removeClass("d-flex");
            })

            $('.image').change(function() {
                $file = this.files;
                $fileLength = this.files.length;
                $previewImg = $(".preview-img");
                $previewImg.find("img").not(".data-image").remove();
                $previewImg.find("img.data-image").hide();
                $(".close-btn").addClass("d-flex");
                $(".close-btn").removeClass("d-none");
                for (let i = 0; i < $fileLength; i++) {
                    if ($file[i].type.includes("image") && $file[i].size <= 2000000) {
                        $previewImg.append(`<img src="${URL.createObjectURL($file[i])}" />`);
                    } else {
                        $errorMessage = "";
                        if (!$file[i].type.includes("image")) {
                            $errorMessage =
                                "<span class='mt-1 d-inline-block text-danger'>File must be a type of jpg, jpeg, png, webp</span>";
                        } else if ($file[i].size > 2000000) {
                            $errorMessage =
                                "<span class='mt-1 d-inline-block text-danger'>File must be less than 2mb</span>";
                        }
                        $previewImg.html($errorMessage);
                        this.value = "";
                        break;
                    }
                }
            })

            // summernote for description
            $('#summernote').summernote({
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                ]
            });

            // select2
            $(".select2")?.select2();
        });
    </script>

    @yield('script')
</body>

</html>
