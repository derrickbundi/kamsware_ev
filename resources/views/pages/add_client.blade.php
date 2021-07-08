@extends('layouts.main')
@section('title', 'Clients')
<link rel="stylesheet" type="text/css" href="{{asset('datetime/jquery.datetimepicker.css')}}" />
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
                <p style="text-transform: uppercase;">List of available clients <button type="button"
                        class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addClient">ADD NEW</button>
                </p>
                <hr>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">FULL NAME</th>
                            <th scope="col">DOB</th>
                            <th scope="col">ID NUMBER</th>
                            <th>MOBILE</th>
                            <th>LOCATIONS</th>
                            {{-- <th>ACTION</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->firstName }}&nbsp;{{ $item->lastName }}</td>
                            <td>{{ $item->dateOfBirth }}</td>
                            <td>{{ $item->idNumber }}</td>
                            <td>{{ $item->phoneNumber }}</td>
                            <td>
                                @if(is_array($item['location']))
                                @foreach($item['location'] as $loc)
                                <code>{{ $loc }}</code> |
                                @endforeach
                                @else
                                <code>{{ $item['location'] }}</code>
                                @endif
                            </td>
                            {{-- <td>
                                <button class="btn btn-default">EDIT</button>
                            </td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
<!-- modal -->
<div class="modal fade" id="addClient" tabindex="-1" aria-labelledby="addClientLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addClientLabel">CLIENT INFORMATION</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('add_client') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="fname" class="form-control @error('fname') is-invalid @enderror"
                                required placeholder="FIRST NAME *">
                            @error('fname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="lname" class="form-control @error('lname') is-invalid @enderror"
                                placeholder="LAST NAME">
                            @error('lname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="number" name="idNumber"
                                class="form-control @error('idNumber') is-invalid @enderror" required
                                placeholder="1234345 *">
                            @error('idNumber')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="phoneNumber"
                                class="form-control @error('phoneNumber') is-invalid @enderror" required
                                placeholder="0712345678 *">
                            @error('phoneNumber')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="text" name="dob" id="datetimepicker"
                                class="form-control @error('dob') is-invalid @enderror" required
                                placeholder="Date of Birth *">
                            @error('dob')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <select class="form-select form-select-lg mb-3" multiple required
                                aria-label=".form-select-lg example" name="location[]">
                                <option selected>SELECT LOCATION</option>
                                @foreach ($locations as $location)
                                <option>{{ $location->location_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">ADD CLIENT</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $('#datetimepicker').datetimepicker({
            datepicker: true,
            timepicker:false,
            format: 'Y-m-d'
        })
    })
</script>
@if (count($errors) > 0)
<script>
    $(document).ready(function () {
        $('#addClient').modal('show');
    });
</script>
@endif
@endsection