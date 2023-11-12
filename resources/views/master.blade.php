@include('partes.cabecera')
@include('partes.sidebar')
<div id="content" class="p-4 p-md-5 pt-5 d-flex justify-content-center align-items-center" style="background-color: darkgreen">
    @yield('content')
</div>
@include('partes.pie')
