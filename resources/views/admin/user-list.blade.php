@extends('layouts.dashboard')
@section('title', 'List of users')
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Users List</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Contacts</a></li>
                                <li class="breadcrumb-item active">Users List</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    @if (session('disableNotify'))
                                        <div class="alert alert-success" role="alert">
                                            Disable successfully
                                        </div>
                                    @endif
                                    @if (session('disableFail'))
                                        <div class="alert alert-danger" role="alert">
                                            Disable failed
                                        </div>
                                    @endif
                                    @if (session('updateUser'))
                                        <div class="alert alert-success" role="alert">
                                            Update user successfully
                                        </div>
                                    @endif
                                    @if (session('updateUserFail'))
                                        <div class="alert alert-danger" role="alert">
                                            Update user failed
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <!-- App Search-->
                            <form action="{{ route('search-user') }}" method="GET" class="app-search d-none d-lg-block">
                                <div class="position-relative">
                                    <input value="{{ old('search') }}" name="search" type="text" class="form-control"
                                        placeholder="Search by name or phone number...">
                                    <span class="bx bx-search-alt"></span>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-centered table-nowrap table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col" style="width: 70px;">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Phone number</th>
                                            <th scope="col">Address</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $index = isset($users) ? $users->firstItem() : [];
                                        @endphp
                                        @foreach ($users as $key => $value)
                                            <tr>
                                                <td>
                                                    <div class="avatar-xs">
                                                        <span class="avatar-title rounded-circle">
                                                            {{ $index++ }}
                                                        </span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <h5 class="font-size-14 mb-1"><a href="#" class="text-dark">
                                                            {{ $value->name }}
                                                        </a></h5>
                                                </td>
                                                <td>{{ $value->email }}</td>
                                                <td>
                                                    {{ $value->phone_number }}
                                                </td>
                                                <td>
                                                    {{ $value->address }}
                                                </td>
                                                <td>
                                                    {{-- {{ $value->isdisable ? 'Disable' : 'Active' }} --}}
                                                    <p
                                                        class="badge badge-soft-{{ $value->is_disable ? 'danger' : 'success' }} font-size-11 m-1">
                                                        {{ $value->is_disable ? 'Disable' : 'Active' }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <a onclick="updateUser('{{ $value }}')" data-toggle="modal"
                                                        data-target="#myModal" href="javascript:void(0);"
                                                        class="mr-3 text-primary" data-toggle="tooltip" data-placement="top"
                                                        title="" data-original-title="Edit"><i
                                                            class="mdi mdi-pencil font-size-18"></i></a>
                                                    <a onclick="disableClick('{{ $value->id }}', '{{ $value->name }}')"
                                                        href="javascript:void(0);" class="text-danger" data-toggle="tooltip"
                                                        data-placement="top" title="" data-original-title="Disable"><i
                                                            class="mdi mdi-close font-size-18"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="custom-control custom-switch mb-2" dir="ltr">
                                    <input onclick="tougleDisableUser()" type="checkbox" class="custom-control-input"
                                        id="customSwitch1" {{ session('toggle') === 'true' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="customSwitch1">Show users disabled</label>
                                </div>
                                <form id="user-disable" action="{{ route('user-disable') }}" method="POST">
                                    @csrf
                                    <input name="userId" id="user_id" type="hidden">
                                </form>
                                <form id="toggle-disable" action="{{ route('toggle-disable') }}" method="POST">
                                    @csrf
                                    <input name="toggle" id="toggle-id" type="hidden">
                                </form>
                            </div>
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    <!-- sample modal content -->

    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Update User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="update-user" method="POST" action="{{ route('update-user') }}">
                        @csrf
                        <input type="hidden" name="id_update" id="id_user_update">
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="phoneNumber" class="col-md-4 col-form-label text-md-end">Phone number</label>

                            <div class="col-md-6">
                                <input id="phoneNumber" type="number"
                                    class="form-control @error('phoneNumber') is-invalid @enderror" name="phoneNumber"
                                    value="{{ old('phoneNumber') }}" required autocomplete="phoneNumber">

                                @error('phoneNumber')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-end">Address</label>

                            <div class="col-md-6">
                                <input id="address" type="text"
                                    class="form-control @error('address') is-invalid @enderror" name="address"
                                    value="{{ old('address') }}" required autocomplete="address">

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">New password</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm"
                                class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <h5 class="font-size-14 mb-3">User disable</h5>
                                <div>
                                    <input name="is_disable" id="switch-modal" type="checkbox" id="switch3"
                                        switch="bool" />
                                    <label onclick="switchModal()" for="switch3" data-on-label="Yes"
                                        data-off-label="No"></label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    <button onclick="submitUpdateForm()" type="button"
                        class="btn btn-primary waves-effect waves-light">Save
                        changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <!-- /.modal -->
    <script>
        function disableClick(id, name) {
            let text = "Do you want to disable " + name + " ?";
            if (confirm(text) == true) {
                $("#user_id").val(id);
                document.getElementById("user-disable").submit();
            }
        }

        function tougleDisableUser() {
            if ($("#customSwitch1").is(':checked')) {
                $("#toggle-id").val(true);
            } else {
                $("#toggle-id").val(false);
            }
            document.getElementById("toggle-disable").submit();
        }

        function updateUser(data) {
            var users = JSON.parse(data);
            $("#name").val(users.name);
            $("#phoneNumber").val(users.phone_number);
            $("#address").val(users.address);
            $("#switch-modal").attr("checked", users.is_disable ? true : false);
            $("#id_user_update").val(users.id);
        }

        function switchModal() {
            if ($("#switch-modal").is(':checked')) {
                $("#switch-modal").val(false);
                $("#switch-modal").prop('checked', false);
            } else {
                $("#switch-modal").val(true);
                $("#switch-modal").prop('checked', true);
            }
        }

        function submitUpdateForm() {
            document.getElementById("update-user").submit();
        }
    </script>
@endsection
