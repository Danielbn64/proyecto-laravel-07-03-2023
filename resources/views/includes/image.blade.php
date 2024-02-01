<div class="card pub_image">
    <div class="card-header">
        <div class="data-user">
            @if($image->user->image)
            <div class="container-avatar">
                <img class="cover" src="{{ route('user.avatar',['filename'=>$image->user->image]) }}" class="avatar">
            </div>
            @else
            <div class="container-avatar">
                <img src="{{ asset('img/user_placeholder.png') }}" />
            </div>
            @endif
            <a href="{{ route('profile', ['id' => $image->user->id]) }}">
                <div>
                    <span class="nickname">
                        {{ '  @'.$image->user->nick }}
                    </span>
                </div>
            </a>
        </div>
    </div>
    <div class="card-body">
        <a href="{{ route('image.detail', ['id' => $image->id]) }}">
            <img src="{{ route('image.file',['filename' => $image->image_path]) }}" alt="image">
        </a>
    </div>
    <div class="description">
        <span class="nickname">{{ '@'.$image->user->nick }}</span>
        <span class="nickname date">{{ ' | '.\FormatTime::LongTimeFilter($image->created_at) }}</span>
        <p> {{ $image->description }}</p>
    </div>
    <div class="likes">
        <!--Comprobar si el usuario le dio like a la imagen-->
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
    <div class="comments">
        <a href="{{ route('image.detail', ['id' => $image->id]) }}" class="btn btn-sm btn-light btn-comments">
            Comentarios {{count($image->comments)}}
        </a>
    </div>
</div>