<!DOCTYPE html>
<html lang="en">
    @include('admin.pages.head')
<body>
	<div class="wrapper">

        {{-- header --}}
        @include('admin.pages.header')
        {{-- end header --}}

		<!-- Sidebar -->
        @include('admin.pages.sidebar')
		<!-- End Sidebar -->

		<div class="main-panel">
            <div class="content">
                <div class="page-inner">
                    <div class="page-header">
                        <h4 class="page-title">@yield('title')</h4>
                        <ul class="breadcrumbs">
                            <li class="nav-home">
                                <a href="#">
                                    <i class="flaticon-home"></i>
                                </a>
                            </li>
                            <li class="separator">
                                <i class="flaticon-right-arrow"></i>
                            </li>
                            <li class="nav-item">
                                <a href="#">@yield('menu1')</a>
                            </li>
                            <li class="separator">
                                <i class="flaticon-right-arrow"></i>
                            </li>
                            <li class="nav-item">
                                <a href="#">@yield('title')</a>
                            </li>
                        </ul>
                    </div>

                {{-- content --}}
                @yield('content')
                {{-- endcontent --}}

            </div>
        </div>
			{{-- footer --}}
            @include('admin.pages.footer')
            {{-- endfooter --}}
		</div>
	</div>


    @include('admin.pages.footables')
</body>
</html>
