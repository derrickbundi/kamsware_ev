<!DOCTYPE html>
<html lang="en">

@include('layouts.head')

<body id="body" style="overflow-x: hidden;">
    @include('layouts.header')
    <div class="row" style="margin-top:10px;">
        <div class="col-md-8 offset-md-2">
            @yield('body')
        </div>
    </div>
    @yield('scripts')
    @include('layouts.scripts')
</body>

</html>