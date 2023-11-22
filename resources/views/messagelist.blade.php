@extends('app')
@section('content')
    <main class="mn-inner">
        <div class="row">
            <div class="col s12">
                <div class="page-title">messagelist List</div>
            </div>
            <div class="col s12 m12 l12">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">messagelist</span>

                    </div>

                    <table id="example" class="display responsive-table datatable-example">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User Name</th>
                                <th>Message</th>
                                <th>Amount</th>
                                <th>No. Of Sale</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $count = 1;
                            @endphp

                            @foreach ($messagelists as $messagelist)
                                <tr>
                                    <td><?= $count++ ?></td>
                                    <td><?= $messagelist->name ?></td>
                                    <td><?= $messagelist->content ?></td>
                                    <td><?= $messagelist->amount ?></td>
                                    <td><?= $messagelist->sales ?></td>

                                    <td>
                                        <input data-id="{{ $messagelist->id }}" class="toggle-class" type="checkbox"
                                            data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                            data-on="Active" data-off="Deactive"
                                            {{ $messagelist->status == 'Active' ? 'checked' : '' }}>
                                    </td>

                                    <td>
                                        <button onclick="deletemessagelist({{ $messagelist->id }})"><i
                                                class="material-icons">delete</i></button>

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
                text: "You really want to " + status + " this messagelist!",
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
                        url: '/updatemessageliststatus?id=' + id + "&status=" + status,
                        success: function(data) {
                            if (data.success != null) {
                                Swal.fire(
                                    'Done!',
                                    'Your messagelist has been ' + status + '.',
                                    'success'
                                )
                            } else {
                                Swal.fire(
                                    'Sorry!',
                                    'Your messagelist has not been ' + status + '.',
                                    'failed'
                                )
                            }
                        }
                    });
                }
            })
        })

        function deletemessagelist(id) {
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
                    window.location.href = "/delete_messagelists?id=" + id;
                }
            })
        }
    </script>
@endsection
