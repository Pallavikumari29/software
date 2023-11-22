@extends('app')
@section('content')
    <main class="mn-inner">
        <div class="row">
            <div class="col s12">
                <div class="page-title">software_sale List</div>
            </div>
            <div class="col s12 m12 l12">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">software_sale</span>

                        <table id="example" class="display responsive-table datatable-example">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Software Name</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Custome Name</th>
                                    <th>Custome Mobile</th>
                                    <th>Custome Email</th>
                                    <th>Transaction Id</th>
                                    <th>Order Id</th>
                                    <th>Status</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $count = 1;
                                @endphp

                                @foreach ($software_sales as $software_sale)
                                    <tr>
                                        <td><?= $count++ ?></td>
                                        <td><?= $software_sale->name ?></td>
                                        <td><?= $software_sale->date ?></td>
                                        <td><?= $software_sale->amount ?></td>
                                        <td><?= $software_sale->customer_name ?></td>
                                        <td><?= $software_sale->customer_number ?></td>
                                        <td><?= $software_sale->customer_email ?></td>
                                        <td><?= $software_sale->trans_id ?></td>
                                        <td><?= $software_sale->order_id ?></td>
                                        <td>
                                            <input data-id="{{ $software_sale->id }}" class="toggle-class" type="checkbox"
                                                data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                data-on="pending" data-off="delivery"
                                                {{ $software_sale->status == 'pending' ? 'checked' : '' }}> 
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
        var status = $(this).prop('checked') ? "pending" : "delivery";
        var id = $(this).data('id');

        Swal.fire({
                title: 'Are you sure?',
                text: "You really want to " + status + " this message!",
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
                        url: '/update_software_sale_status?id=' + id + "&status=" + status,
                        success: function(data) {
                            if (data.success != null) {
                                Swal.fire(
                                    'Done!',
                                    'Your Message has been ' + status + '.',
                                    'success'
                                )
                            } else {
                                Swal.fire(
                                    'Sorry!',
                                    'Your Message has not been ' + status + '.',
                                    'failed'
                                )
                            }
                        }
                    });
                }
            })
        })
</script>
@endsection