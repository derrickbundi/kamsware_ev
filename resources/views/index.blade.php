@extends('layouts.main')
@section('title', 'Home')
@section('body')
<div class="row">
    <div class="col-md-10 offset-md-1">

        <div class="row">
            <div class="col-md-8">
                <p>LIST OF CLIENTS ({{ $clients->count() }})</p>
                <hr>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">FULL NAME</th>
                            <th scope="col">DOB</th>
                            <th scope="col">ID NUMBER</th>
                            <th>MOBILE</th>
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
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
                <br>
                <p>LIST OF CLIENTS WITH NUMBER OF PRODUCTS</p>
                <hr>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">FULL NAME</th>
                            <th scope="col">DOB</th>
                            <th scope="col">ID NUMBER</th>
                            <th>NUMBER OF PRODUCTS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->firstName }}&nbsp;{{ $item->lastName }}</td>
                            <td>{{ $item->dateOfBirth }}</td>
                            <td>{{ $item->idNumber }}</td>
                            <td>{{ $item->products_count }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <p>ADD NEW CENTER</p>
                <hr>
                @if(session('status'))
                <div class="alert alert-success">
                    <center><strong>{{ session('status') }}</strong></center>
                </div>
                @endif
                <form action="{{ route('add_center') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <input type="text" class="form-control @error('location_name') is-invalid @enderror"
                                required name="location_name" placeholder="LOCATION NAME *">
                            @error('location_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('latitude') is-invalid @enderror" required
                                name="latitude" placeholder="-1.2682 *">
                            @error('latitude')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('longitude') is-invalid @enderror" required
                                name="longitude" placeholder="36.1212 *">
                            @error('longitude')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success btn-block">ADD CENTER</button>
                        </div>
                    </div>
                </form>
                <hr>
                @foreach ($locations as $location)
                <p>{{ $loop->iteration }}.&nbsp;{{ $location->location_name }} ~ {{ $location->latitude }} |
                    {{ $location->longitude }}</p>
                <br>
                @endforeach
            </div>
        </div>

    </div>
</div>
@endsection
@section('scripts')
@endsection