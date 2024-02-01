@extends('layouts.app')
@include('includes.change_tags_modal')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header">
                <h3>Editar</h3>
            </div>
            <div class="card-body d-flex flex-wrap justify-content-center">
                <div class="image-container image-margin">
                    <img class="card-body" src="{{ route('image.file',['filename' => $image->image_path]) }}">
                </div>
                <div class="col">
                    <form method="POST" action="{{ route('edit_description')}}">
                        @csrf
                        <div class="form-group">
                            <h3>Editar descripción</h3>
                            <input id="imageIdDescription" type="hidden" name="imageIdDescription" value="{{$image->id}}" />
                            <textarea id="descriptionEdit" class="form-control" name="descriptionEdit" type="text">{{$image->description}}</textarea>
                        </div>
                        <hr>
                        <div class="form-group">
                            <div class="row justify-content-between m-0">
                                <h3>Etiquetas adjuntas a la imagen</h3>
                                <button type="button" class="ms-5 btn btn-primary" data-bs-toggle="modal" data-bs-target="#changeTagsView">Cambiar etiquetas</button>
                            </div>
                            <div class="attached-tags d-flex">
                                @if($image->tags->count() > 0)
                                <ul>
                                    @foreach($image->tags as $tag)
                                    <li>{{$tag->tags}}</li>
                                    @endforeach
                                </ul>
                                @else
                                <p>No hay etiquetas adjuntas a esta imagen</p>
                                @endif
                            </div>
                        </div>
                        <hr>
                        <input class="mt-5 ms-5 btn btn-primary" type="submit" value="guardar">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection