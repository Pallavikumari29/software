@extends('app')
@section('content')
    <main class="mn-inner">
        <div class="row">
            <div class="col s12">
                <div class="page-title">Software List</div>
            </div>
            <div class="col s12 m12 l12">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Software</span>
                        <!-- Modal Structure -->
                        @if (isset($edit_data))
                            <div class="card project_list">
                                <form action="{{ url('updatesoftwares/' . $edit_data->id) }}" method="post" class="form"
                                    enctype="multipart/form-data">


                                    <div class="modal-content">
                                        <h4>Edit Software</h4>
                                        @csrf
                                        <div class="col-sm-8">
                                            <div class="row clearfix">
                                                <div class="col-sm-6"><b>Name</b>
                                                    <div class="input-group">

                                                        <input type="text" id="name" required name="name"
                                                            class="form-control" value="{{ $edit_data['name'] }}" required
                                                            placeholder="Name">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <img height="200" width="200" id="image"
                                                            src="{{ asset('/images/noprofile.jpg') }}"
                                                            class="rounded-circle img-raised">
                                                        <input type="file" accept="Image/*" name="image"
                                                            value="{{ $edit_data['image'] }}"
                                                            onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-sm-6"><b>Description</b>
                                                    <div class="input-group">

                                                        <input type="text" id="" name="description"
                                                            class="form-control" required
                                                            value="{{ $edit_data['description'] }}"
                                                            placeholder="description">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6"><b>Amount</b>
                                                    <div class="input-group">
                                                        <input type="number" id="amount" name="amount"
                                                            class="form-control" value="{{ $edit_data['amount'] }}" required
                                                            placeholder="amount">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6"><b>Discounted Amount<b>
                                                            <div class="input-group">

                                                                <input type="number" id="discounted_price"
                                                                    name="discounted_price" class="form-control"
                                                                    value="{{ $edit_data['discounted_price'] }}" required
                                                                    placeholder="discounted_price">
                                                            </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-sm-6"><b>Features</b>
                                                    <div class="input-group">

                                                        {{-- <input type="text" id="features" name="features"
                                                            class="form-control" value="{{ $edit_data['features'] }}"
                                                            required placeholder="features"> --}}
                                                            
                                                    <select name="features" value="{{ $edit_data['features'] }}" id="features">
                                                        <option value="latest">Latest</option>
                                                        <option value="featured">Featured</option>

                                                    </select>
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
                        <!-- Modal Structure -->
                        <a class="waves-effect waves-grey btn primary right modal-trigger" href="#addnewsoftware">Add New
                            Software</a>
                        <div id="addnewsoftware" class="modal"
                            style="z-index: 1003; display: none; opacity: 0; transform: scaleX(0.7); top: 250.516304347826px;">
                            <form action="{{ url('/addnewsoftware') }}" method="post" class="form"
                                enctype="multipart/form-data">


                                <div class="modal-content">
                                    <h4>New Software</h4>
                                    @csrf
                                    <div class="col-sm-8">
                                        <div class="row clearfix">
                                            <div class="col-sm-6"><b>Name</b>
                                                <div class="input-group">

                                                    <input type="text" required name="name" class="form-control"
                                                        required placeholder="Name">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <img height="200" width="200" id="image"
                                                        src="{{ asset('/images/noprofile.jpg') }}"
                                                        class="rounded-circle img-raised">
                                                    <input type="file" accept="Image/*" name="image"
                                                        onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-sm-6"><b>Description</b>
                                                <div class="input-group">

                                                    <input type="text" name="description" class="form-control"
                                                        required placeholder="description">
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

                                                            <input type="number" name="discounted_price"
                                                                class="form-control" required
                                                                placeholder="discounted_price">
                                                        </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-sm-6"><b>Software Type</b>
                                                <div class="input-group">

                                                    <select name="features" id="features">
                                                        <option value="latest">Latest</option>
                                                        <option value="featured">Featured</option>

                                                    </select>
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
                                    <th>Image</th>
                                    <th>Description</th>
                                    <th>Amount</th>
                                    <th>Discounted Amount</th>
                                    <th>Software Type</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $count = 1;
                                @endphp

                                @foreach ($softwares as $software)
                                    <tr>
                                        <td><?= $count++ ?></td>
                                        <td><?= $software['name'] ?></td>
                                        <td><?= $software['image'] ?></td>
                                        <td><?= $software['description'] ?></td>
                                        <td><?= $software['amount'] ?></td>
                                        <td><?= $software['discounted_price'] ?></td>
                                        <td><?= $software['features'] ?></td>
                                        <td><?= $software['about'] ?></td>
                                        <td>

                                            <button onclick="editsoftwares({{ $software['id'] }})"><i
                                                    class="material-icons">edit</button>
                                            <button onclick="deletesoftware({{ $software['id'] }})"><i
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
        function deletesoftware(id) {
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
                    window.location.href = "/delete_Software?id=" + id;
                }
            })
        }

        function editsoftwares(id) {
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
                    window.location.href = "/edit_softwares?id=" + id;
                }
            })
        }
    </script>
@endsection
