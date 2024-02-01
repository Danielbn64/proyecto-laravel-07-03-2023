@extends('layouts.app')

@section('content')
<section class="container">
    @include('includes.message')
    <div class="d-flex flex-wrap">
        @foreach($images as $image)
            @include('includes.image',['image' => $image])
        @endforeach
    </div>
    <div class="d-flex justify-content-center">
        {{ $images->links() }}
    </div>
</section>
@endsection