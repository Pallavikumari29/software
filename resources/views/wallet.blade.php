@extends('app')
@section('content')
    <main class="mn-inner">
        <div class="row">
            <div class="col s12">
                <div class="page-title">Wallet Transaction</div>
            </div>
            <div class="col s12 m12 l12">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Wallet Transaction</span>

                    </div>

                    <table id="example" class="display responsive-table datatable-example">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User Name</th>
                                <th>Amount</th>
                                <th>Payment Mode</th>
                                <th>Regards</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $count = 1;
                            @endphp

                            @foreach ($wallets as $wallet)
                                <tr>
                                    <td><?= $count++ ?></td>
                                    <td><?= $wallet->name ?></td>
                                    <td><?= $wallet->mode_of_payment ?></td>

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
                text: "You really want to " + status + " this wallet!",
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
                        url: '/updatewalletstatus?id=' + id + "&status=" + status,
                        success: function(data) {
                            if (data.success != null) {
                                Swal.fire(
                                    'Done!',
                                    'Your wallet has been ' + status + '.',
                                    'success'
                                )
                            } else {
                                Swal.fire(
                                    'Sorry!',
                                    'Your wallet has not been ' + status + '.',
                                    'failed'
                                )
                            }
                        }
                    });
                }
            })
        })

        function deletewallet(id) {
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
                    window.location.href = "/delete_wallets?id=" + id;
                }
            })
        }
    </script>
@endsection --}}
