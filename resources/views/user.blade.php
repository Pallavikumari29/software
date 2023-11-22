@extends('app')
@section('content')
    <main class="mn-inner">
        <div class="row">
            <div class="col s12">
                <div class="page-title">Users List</div>
            </div>
            <div class="col s12 m12 l12">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Users</span>
                        @if (isset($edit_data))
                            <div class="card project_list">
                                <form action="{{ url('updateusers/' . $edit_data->id) }}" method="post" class="form"
                                    enctype="multipart/form-data">
                                    <div class="modal-content">
                                        <h4>Update User</h4>
                                        @csrf
                                        <div class="col-sm-8">
                                            <div class="row clearfix">
                                                <div class="col-sm-6">
                                                    <div class="input-group">
                                                        <img height="200" width="200" id="profile_pic"
                                                            src="{{ asset('/' . $edit_data[profile_pic]) }}"
                                                            class="rounded-circle img-raised">
                                                        <input type="file" required name="Image/*" name="image"
                                                            onchange="document.getElementById('profile_pic').src = window.URL.createObjectURL(this.files[0])">

                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-sm-6 col-md-6"> <b>Mobile</b>
                                                    <div class="col-sm-6"><b>Name</b>
                                                        <div class="input-group">

                                                            <input type="text" required name="name" id="name"
                                                                value="{{ $edit_data['name'] }}" class="form-control"
                                                                required placeholder="Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-6 col-md-6"> <b>Mobile</b>
                                                        <div class="input-group">

                                                            <input type="text" required name="phone_number"
                                                                id="phone_number" value="{{ $edit_data['phone_number'] }}"
                                                                class="form-control mobile-phone-number"
                                                                placeholder="Ex: +00 (000) 000-00-00">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row clearfix">
                                                    <div class="col-sm-6"><b>Username</b>
                                                        <div class="input-group">

                                                            <input type="text" name="username" class="form-control"
                                                                id="username" value="{{ $edit_data['username'] }}" required
                                                                placeholder="username">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6"><b>Display Name</b>
                                                        <div class="input-group">
                                                            <input type="text" name="display_name" class="form-control"
                                                                id="display_name" value="{{ $edit_data['display_name'] }}"
                                                                required placeholder="display_name">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6"><b>Password<b>
                                                                <div class="input-group">

                                                                    <input type="password" name="password"
                                                                        class="form-control" id="password"
                                                                        value="{{ $edit_data['password'] }}" required
                                                                        placeholder="Password">
                                                                </div>
                                                    </div>
                                                </div>
                                                <div class="row clearfix">
                                                    <div class="col-sm-6"><b>Email</b>
                                                        <div class="input-group">

                                                            <input type="text" name="email" id="email"
                                                                class="form-control" value="{{ $edit_data['email'] }}"
                                                                required placeholder="email">
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row clearfix">
                                                    <div class="col-sm-6"><b>Status</b>
                                                        <div class="input-group">

                                                            <input type="text" name="status" id="status"
                                                                class="form-control" value="{{ $edit_data['status'] }}"
                                                                required placeholder="status">
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <a class="modal-action modal-close waves-effect waves-blue btn-flat ">Cancel</a>
                                            <button type="submit"
                                                class="modal-action waves-effect waves-blue btn-flat ">Save</button>
                                        </div>
                                </form>
                            </div>
                        @endif


                        <table id="example" class="display responsive-table datatable-example">
                            <thead>
                                <>
                                    <th>#</th>
                                    <th>Profile Image</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Username</th>
                                    <th>Display Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>About</th>
                                    <th>balance</th>
                                    <th>Transaction</th>
                                    </tr>
                            </thead>

                            <tbody>
                                @php
                                    $count = 1;
                                @endphp

                                @foreach ($users as $user)
                                    <tr>
                                        <td><?= $count++ ?></td>
                                        <td><img class="rounded avatar" style="max-height: 40px;"
                                                src="{{ asset('/images/users/' . $user['profile_pic']) }}" alt="im"></td>
                                        <td><?= $user['name'] ?></td>
                                        <td><?= $user['phone_number'] ?></td>
                                        <td><?= $user['username'] ?></td>
                                        <td><?= $user['display_name'] ?></td>
                                        <td><?= $user['email'] ?></td>
                                        <td>
                                            <input data-id="{{ $user['id'] }}" class="toggle-class" type="checkbox"
                                                data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                data-on="Active" data-off="Deactive"
                                                {{ $user['status'] == 'Active' ? 'checked' : '' }}>
                                        </td>
                                        <td><?= $user['about'] ?></td>
                                        <td>
                                            <a href={{ url('/message?user_id=' . $user['id']) }}><i
                                                    class="material-icons">message</i></a>
                                           <a class="btn btn-success" href="{{ url('/withdraw?user_id='.$user['id']) }}">Trans.</a>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection
@section('scripts')
    <script>
        $('.toggle-class').change(function() {
            var status = $(this).prop('checked') ? "Active" : "Deactive";
            var id = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You really want to " + status + " this user!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, ' + status + ' it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "GET",
                        dataType: "json",
                        url: '/updateUserStatus?id=' + id + "&status=" + status,
                        success: function(data) {
                            if (data.success != null) {
                                Swal.fire(
                                    'Done!',
                                    'Your user has been ' + status + '.',
                                    'success'
                                )
                            } else {
                                Swal.fire(
                                    'Sorry!',
                                    'Your user has not been ' + status + '.',
                                    'failed'
                                )
                            }

                        }
                    });

                }
            });
        })

        function deleteuser(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/delete_users?id=" + id;
                }
            })
        }

        function edituser(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Edit it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/edit_users?id=" + id;
                }
            })
        }
    </script>
@endsection
