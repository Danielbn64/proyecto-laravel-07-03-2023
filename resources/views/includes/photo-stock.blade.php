@include('includes.message')
<script type="text/javascript" src="{{ asset('js/photo-stock-preloader.js')}}" defer="defer"></script>
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
<section class="images-gallery">
    @foreach($images as $image)
    <a href="{{ route('detail.public',['id' => $image->id]) }}">
        <div class="skeleton-loader">
            <img loading="lazy" class="image-sizes" src="{{ route('image.stock',['filename' => $image->image_path])}}">
        </div>
    </a>
    @endforeach
</section>
<div class="d-flex justify-content-center">
    {{ $images->links() }}
</div>