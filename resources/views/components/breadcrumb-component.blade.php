<div class="col-4 col-xl-4 page-title">
    <h4 class="f-w-700">{{ ucfirst(str_replace('-', ' ', end($segments))) }}</h4>
    <nav>
        <ol class="breadcrumb justify-content-sm-start align-items-center mb-0">
            <!-- Breadcrumb Home -->
            <li class="breadcrumb-item">
                <a href="{{ url('/') }}">
                    <i data-feather="home"></i>
                </a>
            </li>

            <!-- Breadcrumb Segments -->
            @foreach ($segments as $index => $segment)
                @if ($index + 1 === count($segments))
                    <!-- Aktif (Segmen terakhir) -->
                    <li class="breadcrumb-item f-w-400 active">
                        <a href="{{ url(implode('/', array_slice($segments, 0, $index + 1))) }}">
                            {{ ucfirst(str_replace('-', ' ', $segment)) }}
                        </a>
                    </li>
                @else
                    <!-- Segmen sebelumnya -->
                    <li class="breadcrumb-item f-w-400">
                        <a href="{{ url(implode('/', array_slice($segments, 0, $index + 1))) }}">
                            {{ ucfirst(str_replace('-', ' ', $segment)) }}
                        </a>
                    </li>
                @endif
            @endforeach
        </ol>
    </nav>
</div>
