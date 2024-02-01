@extends('layouts.app')

@section('content')
<section class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Mis imagenes favoritas</h1>
            <hr />
        </div>
    </div>
    <div class="d-flex flex-wrap">
        @foreach($likes as $like)
        @include('includes.image',['image' => $like->image])
        @endforeach
    </div>
    <!--Paginación-->
    <div class="d-flex justify-content-center">
        {{ $likes->links() }}
    </div>
</section>
@endsection