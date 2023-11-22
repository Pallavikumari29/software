@extends('app')
@section('content')
    <main class="mn-inner">
        <div class="row">
            <div class="col s12">
                <div class="page-title">Message List</div>
            </div>
            <div class="col s12 m12 l12">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Message</span>
                        <!-- Modal Structure -->
                        {{-- <a class="waves-effect waves-grey btn primary right modal-trigger" href="#addnewmessage"><i
                                class="material-icons">add</i></a>
                        <div id="addnewmessage" class="modal"
                            style="z-index: 1003; display: none; opacity: 0; transform: scaleX(0.7); top: 250.516304347826px;">
                            <form action="{{ url('/addnewmessage') }}" method="post" class="form"
                                enctype="multipart/form-data"> --}}

{{-- 
                                <div class="modal-content">
                                    <h4>New Message</h4>
                                    @csrf
                                    <div class="col-sm-8">
                                        <div class="row clearfix">
                                            <div class="col-sm-6"><b>Content</b>
                                                <div class="input-group">

                                                    <input type="text" required name="content" class="form-control"
                                                        required placeholder="content">
                                                </div>
                                            </div>
                                            <div class="col-sm-6"><b>Amount</b>
                                                <div class="input-group">
                                                    <input type="number" name="amount" class="form-control" required
                                                        placeholder="amount">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-sm-6"><b>Slug</b>
                                                <div class="input-group">

                                                    <input type="text" name="slug" class="form-control" required
                                                        placeholder="slug">
                                                </div>
                                            </div>

                                            <div class="col-sm-6"><b>Expiry<b>
                                                        <div class="input-group">

                                                            <input type="date" name="expiry" class="form-control"
                                                                required placeholder="expiry">
                                                        </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-sm-6"><b>Status</b>
                                                <div class="input-group">

                                                    <input type="text" name="status" class="form-control" required
                                                        placeholder="status">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-sm-6"><b>File</b>
                                                <div class="input-group">

                                                    <input type="file" name="file" class="form-control" required
                                                        placeholder="file">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-sm-6"><b>Title</b>
                                                <div class="input-group">

                                                    <input type="text" name="title" class="form-control" required
                                                        placeholder="title">
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
                            </form> --}}
                        </div>

                        <table id="example" class="display responsive-table datatable-example">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>message Name</th>
                                    <th>Content</th>
                                    <th>Amount</th>
                                    <th>Slug</th>
                                    <th>Expiry</th>
                                    <th>Status</th>
                                    <th>file</th>
                                    <th>Title</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $count = 1;
                                @endphp

                                @foreach ($messages as $message)
                                    <tr>
                                        <td><?= $count++ ?></td>
                                        <td><?= $message->name ?></td>
                                        <td><?= $message->content ?></td>
                                        <td><?= $message->amount ?></td>
                                        <td><?= $message->slug ?></td>
                                        <td><?= $message->expiry ?></td>
                                        <td>
                                            <input data-id="{{ $message->id }}" class="toggle-class" type="checkbox"
                                                data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                data-on="Active" data-off="Deactive"
                                                {{ $message->status == 'Active' ? 'checked' : '' }}> 
                                        </td>
                                        <td><?= $message->file ?></td>
                                        <td><?= $message->title ?></td>
                                        <td>
                                            <button onclick="deletemessage({{ $message->id }})"><i
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
                        url: '/updatemessagestatus?id=' + id + "&status=" + status,
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
        function deletemessage(id) {
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
                    window.location.href= "/delete_messages?id=" + id;
                }
            })
        }
    </script>
@endsection
