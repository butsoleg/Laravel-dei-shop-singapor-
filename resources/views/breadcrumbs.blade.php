<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="links">
                    <a href="{{ route('home') }}" class="">Home</a>
                    <i class="fas fa-chevron-right"></i>
                    @foreach ($data as $tagitem => $href)
                    @if($href)
                    <a href="{{ $href }}">{{ $tagitem }}</a>
                    <i class="fas fa-chevron-right"></i>
                    @else
                    <span>{{ $tagitem }}</span>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>