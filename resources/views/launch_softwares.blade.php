@extends('app')
@section('content')
    <main class="mn-inner">
        <div class="row">
            <div class="col s12">
                <div class="page-title">launch_software List</div>
            </div>
            <div class="col s12 m12 l12">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">launch_software</span>
                        <!-- Modal Structure -->
                        <a class="waves-effect waves-grey btn primary right modal-trigger" href="#addnewlaunchsoftware">Add
                            New
                            Software</a>
                        <div id="addnewlaunchsoftware" class="modal"
                            style="z-index: 1003; display: none; opacity: 0; transform: scaleX(0.7); top: 250.516304347826px;">
                            <form action="{{ url('/addnewlaunchsoftware') }}" method="post" class="form"
                                enctype="multipart/form-data">


                                <div class="modal-content">
                                    <h4>Launch Software</h4>
                                    @csrf
                                    <div class="col-sm-8">
                                        <div class="row clearfix">
                                            <div class="col-sm-6"><b>Name</b>
                                                <div class="input-group">

                                                    <input type="text" required name="name" class="form-control"
                                                        required placeholder="Name">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-sm-6"><b>Mobile</b>
                                                <div class="input-group">

                                                    <input type="number" name="phone_number" class="form-control" required
                                                        placeholder="phone_number">
                                                </div>
                                            </div>
                                            <div class="col-sm-6"><b>Email</b>
                                                <div class="input-group">

                                                    <input type="text" name="email" class="form-control" required
                                                        placeholder="email">
                                                </div>
                                            </div>
                                            <div class="col-sm-6"><b>Amount</b>
                                                <div class="input-group">
                                                    <input type="number" name="amount" class="form-control" required
                                                        placeholder="amount">
                                                </div>
                                            </div>
                                            <div class="col-sm-6"><b>Discounted Amount<b>
                                                        <div class="input-group">

                                                            <input type="number" name="discount" class="form-control"
                                                                required placeholder="discount">
                                                        </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-sm-6"><b>Features</b>
                                                <div class="input-group">

                                                    <input type="text" name="feature" class="form-control" required
                                                        placeholder="feature">
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

                                    </div>

                                </div>


                                <div class="modal-footer">
                                    <a class="modal-action modal-close waves-effect waves-blue btn-flat ">Cancel</a>
                                    <button type="submit"
                                        class="modal-action waves-effect waves-blue btn-flat ">Save</button>
                                </div>
                            </form>
                        </div>

                        <table id="example" class="display responsive-table datatable-example">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Amount</th>
                                    <th>Discounted_Amount</th>
                                    <th>Feature</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $count = 1;
                                @endphp

                                @foreach ($launch_softwares as $launch_software)
                                    <tr>
                                        <td><?= $count++ ?></td>
                                        <td><?= $launch_software['name'] ?></td>
                                        <td><?= $launch_software['phone_number'] ?></td>
                                        <td><?= $launch_software['email'] ?></td>
                                        <td><?= $launch_software['amount'] ?></td>
                                        <td><?= $launch_software['discount'] ?></td>
                                        <td><?= $launch_software['feature'] ?></td>

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

