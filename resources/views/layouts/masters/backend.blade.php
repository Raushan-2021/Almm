<!DOCTYPE html>
<html>
    @include('layouts.partials.backend._head')

    <body>
        @include('layouts.partials.backend._header')
        @include('layouts.partials.backend._sidebar')
        <main id="main" class="main">

            <div class="pagetitle">
                <h1>@yield('title')</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">@yield('title')</li>
                    </ol>
                </nav>
            </div>


            <section class="section">
                @yield('content')
            </section>
        </main>
        @include('layouts.partials.backend._modals')
        @include('layouts.partials.modals.association')
        @include('layouts.partials.modals.systemApprove')
        @include('layouts.partials.backend._scripts')
    </body>

</html>
