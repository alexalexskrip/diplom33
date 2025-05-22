@props(['items'])

<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
        @foreach ($items as $item)
            @if ($loop->last)
                <li class="breadcrumb-item active" aria-current="page">{{ $item['title'] }}</li>
            @else
                <li class="breadcrumb-item">
                    <a href="{{ $item['url'] }}">{{ $item['title'] }}</a>
                </li>
            @endif
        @endforeach
    </ol>
</nav>
