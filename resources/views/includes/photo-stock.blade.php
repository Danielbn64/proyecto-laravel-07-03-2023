<script src="{{ asset('js/photo-stock.js') }}" defer="defer"></script>
@include('includes.message')
<section class="d-flex flex-column justify-content-center hero">
    <form class="d-flex search-wrapper" method="POST" action="{{ route('stock.search')}}" id="buscador">
        <div class="form-group col search">
            <input type="text" id="search" name="search" class="form-control">
        </div>
        <div class="form-group search">
            <input type="submit" value="Buscar" class="btn btn-success">
        </div>
    </form>
</section>
<section class="images-gallery d-flex">
    <div class="column-1">
        @foreach($images as $image)
        <figure class="image-public-container">
            <a href="{{ route('detail.public',['id' => $image->id]) }}">
                <img loading="lazy" class="image-sizes" src="{{ route('image.stock',['filename' => $image->image_path])}}">
            </a>
        </figure>
        @if($loop->index == 10)
        @break
        @endif
        @endforeach
    </div>
    <div class="column-2">
        @foreach($images as $image)
        @if($loop->index >= 11 && $loop->index < 22) <figure class="image-public-container">
            <a href="{{ route('detail.public',['id' => $image->id]) }}">
                <img loading="lazy" class="image-sizes" src="{{ route('image.stock',['filename' => $image->image_path])}}">
            </a>
            </figure>
            @endif
            @endforeach
    </div>
    <div class="column-3">
        @foreach($images as $image)
        @if($loop->index >= 22 && $loop->index < 34) <figure class="image-public-container">
            <a href="{{ route('detail.public',['id' => $image->id]) }}">
                <img loading="lazy" class="image-sizes" src="{{ route('image.stock',['filename' => $image->image_path])}}">
            </a>
            </figure>
            @endif
            @endforeach
    </div>
    <div class="column-4">
        @foreach($images as $image)
        @if($loop->index >= 34 && $loop->index < 45) <figure class="image-public-container">
            <a href="{{ route('detail.public',['id' => $image->id]) }}">
                <img loading="lazy" class="image-sizes" src="{{ route('image.stock',['filename' => $image->image_path])}}">
            </a>
            </figure>
            @endif
            @endforeach
    </div>
    </div>
</section>
<div class="d-flex justify-content-center">
    {{ $images->links() }}
</div>