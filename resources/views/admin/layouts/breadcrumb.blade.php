<!-- [ breadcrumb ] start -->
@unless ($breadcrumbs->isEmpty())
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col">
                    <div class="page-header-title">
                        <h5 class="m-b-10">{{ optional($breadcrumbs->last())->title }}</h5>
                    </div>
                </div>
                <div class="col-auto">
                    <ul class="breadcrumb">
                        @foreach ($breadcrumbs as $breadcrumb)
                            @if ($breadcrumb->url && !$loop->last)
                                <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
                            @else
                                <li class="breadcrumb-item" aria-current="page">{{ $breadcrumb->title }}</li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endunless
<!-- [ breadcrumb ] end -->
