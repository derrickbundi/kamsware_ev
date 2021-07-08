@extends('layouts.main')
@section('title', 'Product')
<script src="{{ asset('plugins/tinymce/tinymce.min.js') }}"></script>
@section('body')
<div class="row">
    <div class="col-md-10 offset-md-1">

        <div class="row">
            <div class="col-md-12">
                @if(session('status'))
                <div class="alert alert-success">
                    <center><strong>{{ session('status') }}</strong></center>
                </div>
                @endif
                <p style="text-transform: uppercase;">List of available products <button type="button"
                        class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProduct">ADD NEW</button>
                </p>
                <hr>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">PRODUCT NAME</th>
                            <th scope="col">QUANTITY</th>
                            <th scope="col">DESCRIPTION</th>
                            <th>CLIENT</th>
                            <th>DATE ADDED</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->description }}</td>
                            <td>{{ @$item->client->firstName }}&nbsp;{{ @$item->client->lastName }}</td>
                            <td>{{ $item->created_at->format('Y-m-d') }}</td>
                            <td>
                                <button class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#editProduct_{{ $item->id }}">EDIT</button>
                                <form action="{{ route('delete_product', $item->id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-danger" type="submit">DELETE</button>
                                </form>
                            </td>
                        </tr>
                        <div class="modal fade" id="editProduct_{{ $item->id }}" tabindex="-1"
                            aria-labelledby="addClientLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addClientLabel">EDIT PRODUCT INFORMATION</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('edit_product', base64_encode($item->id)) }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="text" name="product_name"
                                                        class="form-control @error('fname') is-invalid @enderror"
                                                        required value="{{ $item->name }}">
                                                    @error('fname')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="number" name="quantity"
                                                        class="form-control @error('quantity') is-invalid @enderror"
                                                        required value="{{ $item->quantity }}">
                                                    @error('quantity')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <select class="form-select form-select-lg mb-3" required
                                                        aria-label=".form-select-lg example" name="client">
                                                        <option selected>SELECT CLIENT</option>
                                                        @foreach ($users as $user)
                                                        <option value="{{ $user->id }}">{{ $user->firstName }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <textarea name="description" class="edit"
                                                        require>{{ $item->description }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success">EDIT PRODUCT</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
<!-- modal -->
<div class="modal fade" id="addProduct" tabindex="-1" aria-labelledby="addClientLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addClientLabel">PRODUCT INFORMATION</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('add_product') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="text" name="product_name"
                                class="form-control @error('fname') is-invalid @enderror" required
                                placeholder="PRODUCT NAME *">
                            @error('fname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="number" name="quantity"
                                class="form-control @error('quantity') is-invalid @enderror" required
                                placeholder="250 *">
                            @error('quantity')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <select class="form-select form-select-lg mb-3" required
                                aria-label=".form-select-lg example" name="client">
                                <option selected>SELECT CLIENT</option>
                                @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->firstName }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <textarea name="description" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">ADD PRODUCT</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('plugins/tinymce/tinymce.min.js') }}"></script>
<script>
    tinymce.init({
        selector: 'textarea',
        menubar: false,
        plugins: 'link code',
        setup: function (editor) {
            editor.on('change', function () {
                editor.save();
            });
        }
    });
</script>
@if (count($errors) > 0)
<script>
    $(document).ready(function () {
        $('#addProduct').modal('show');
    });
</script>
@endif
@endsection