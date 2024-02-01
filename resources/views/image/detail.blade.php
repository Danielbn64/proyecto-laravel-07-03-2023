@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @include('includes.message')
            <div class="card pub_image_detail">
                <div class="card-header">
                    @if($image)
                    @if($user->image)
                    <div class="data-user">
                        <div class="container-avatar">
                            <img src="{{ route('user.avatar',['filename'=>$image->user->image]) }}" class="avatar">
                        </div>
                        @else
                        <div class="container-avatar">
                            <img src="{{ asset('img/user_placeholder.png') }}" />
                        </div>
                        @endif
                        <div>{{ $image->user->name.' '.$image->user->surname }}</div>
                        <span class="nickname">
                            {{ '  @'.$image->user->nick }}
                        </span>
                    </div>

                </div>
                <div class="card-body d-flex justify-content-center">
                    <div class="image-container">
                        <img src="{{ route('image.file',['filename' => $image->image_path]) }}">
                    </div>
                </div>

                <div class="description">
                    <span class="nickname">{{'@'.$image->user->nick }}</span>
                    <p>{{ $image->description }}</p>
                </div>
                <div class="likes">
                    <?php $user_like = false; ?>
                    @foreach($image->likes as $like)
                    @if($like->user->id == Auth::user()->id)
                    <?php $user_like = true; ?>
                    @endif
                    @endforeach

                    @if($user_like)
                    <img src="{{asset('img/heart-red.png')}}" data-id="{{$image->id}}" class="btn-dislike" />
                    @else
                    <img src="{{asset('img/heart-black.png')}}" data-id="{{$image->id}}" class="btn-like" />
                    @endif
                    <span class="number_likes">{{count($image->likes)}}</span>
                </div>
                @if(Auth::user()->role == 'admin' || Auth::user()->id == $image->user->id)
                <div class="action">
                    <a href="{{ route('image.edit_image',['id' => $image->id]) }}" class="btn btn-sm btn-primary">Editar</a>
                    <a href="{{ route('image.delete',['id' => $image->id]) }}" class="btn btn-sm btn-danger">Borrar</a>
                </div>
                @endif

                <div class="clearfix"></div>
                <div class="comments">
                    <h2>Comentarios {{count($image->comments)}}</h2>

                    <hr>
                    <form method="POST" action="{{ route('comment.save') }}">
                        @csrf
                        <input type="hidden" name="image_id" value="{{$image->id}}" />
                        <p>
                            <textarea class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}" name="content"></textarea>
                            @if($errors->has('content'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('content') }}</strong>
                            </span>
                            @endif
                        </p>
                        <button type="submit" class="btn btn-success">
                            Enviar
                        </button>
                    </form>
                    <hr>
                    @foreach($image->comments as $comment)
                    <div>
                        <span class="nickname">{{ '@'.$comment->user->nick }}</span>
                        <span class="nickname date">{{ ' | '.\FormatTime::LongTimeFilter($comment->created_at)}}</span>
                        <p> {{ $comment->content }}<br />
                            @if(Auth::check() && ($comment->user_id == Auth::user()->id || Auth::user()->role == 'admin'))
                            <a href="{{ route('comment.delete', ['id' => $comment->id]) }}" class="btn btn-sm btn-danger">
                                Eliminar
                            </a>
                            @endif
                        </p>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection