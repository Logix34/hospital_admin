<!DOCTYPE html>
<html lang="en">

<!--began::Header-->
@include("admin.includes.header")
@yield('style')
<!--end::Header-->
<!--began::navbar-->
@include("admin.includes.top_bar")
<!--end::navbar-->
<!--began::side_bar-->
@include("admin.includes.side_bar")
@yield('content')
<!--end::side_bar-->
<!--began::footer-->
@include("admin.includes.footer")
@yield('script')
<!--end::footer-->

</html>
