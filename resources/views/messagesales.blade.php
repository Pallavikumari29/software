@extends('app')
@section('content')
    <main class="mn-inner">
        <div class="row">
            <div class="col s12">
                <div class="page-title">messagesales List</div>
            </div>
            <div class="col s12 m12 l12">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">messagesales</span>

                    </div>

                    <table id="example" class="display responsive-table datatable-example">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User Name</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Payment Mode</th>
                                <th>Transaction Id</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $count = 1;
                            @endphp

                            @foreach ($messagesales as $messagesale)
                                <tr>
                                    <td><?= $count++ ?></td>
                                    <td><?= $messagesale->name ?></td>
                                    <td><?= $messagesale->date ?></td>
                                    <td><?= $messagesale->amount ?></td>
                                    <td><?= $messagesale->mode_of_payments ?></td>
                                    <td><?= $messagesale->transaction_id ?></td>

                                    {{-- <td>
                                        <input data-id="{{ $messagesale->id }}" class="toggle-class" type="checkbox"
                                            data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                            data-on="Active" data-off="Deactive"
                                            {{ $messagesale->status == 'Active' ? 'checked' : '' }}>
                                    </td>

                                    <td>
                                        <button onclick="deletemessagesales({{ $messagesale->id }})"><i
                                                class="material-icons">delete</i></button>

                                    </td> --}}
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
{{-- @section('scripts')
    <script>
        $('.toggle-class').change(function() {
            var status = $(this).prop('checked') ? "Active" : "Deactive";
            var id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: "You really want to " + status + " this messagesales!",
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
                        url: '/updatemessagesalesstatus?id=' + id + "&status=" + status,
                        success: function(data) {
                            if (data.success != null) {
                                Swal.fire(
                                    'Done!',
                                    'Your messagesales has been ' + status + '.',
                                    'success'
                                )
                            } else {
                                Swal.fire(
                                    'Sorry!',
                                    'Your messagesales has not been ' + status + '.',
                                    'failed'
                                )
                            }
                        }
                    });
                }
            })
        })

        function deletemessagesales(id) {
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
                    window.location.href = "/delete_messagesaless?id=" + id;
                }
            })
        }
    </script>
@endsection --}}
