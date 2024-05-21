<!DOCTYPE html>
<html lang="en">

@include('fixed.head')

<body>

@include('fixed.navigation')

@section('singlePage')
    @include('fixed.singlePageHeader')
@show

@yield('content')

@include('fixed.footer')

@include('fixed.scripts')

</body>

</html>
