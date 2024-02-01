@include('includes.head')

<body>
    <script src="{{ asset('js/public_detail.js') }}" defer="defer"></script>
    @include('includes.public-navigation')
    <section class="detail-container d-flex justify-content-center">
        <div class=" d-flex justify-content-center image-detail-container">
            <img id="imageFullScreen" class="image-detail" src="{{ route('image.stock', ['filename' => $image->image_path]) }}" alt="photo-stock" />
            <div id="ImagePublicOptions" class="d-flex flex-row justify-content-between options-wrapper">
                <div class="d-flex">
                    @if($user->image)
                    <div class="container-avatar">
                        <img class="avatar" src="{{ route('user.avatar_public',['filename'=>$user->image]) }}" alt="imagen del usuario" />
                    </div>
                    @else
                    <div class="container-avatar">
                        <img class="avatar" src="{{ asset('img/user_placeholder.png') }}" />
                    </div>
                    @endif
                    <a class="align-self-center" href="{{ route('profile', ['id' => $image->user->id]) }}">
                        <span class="nickname">
                            {{ '  @'.$image->user->nick }}
                        </span>
                    </a>
                    <img class="like-image align-self-center" src="{{asset('img/heart-black.png')}}" data-id="{{$image->id}}" class="btn-like" />
                    <span class="number_likes align-self-center">{{count($image->likes)}}</span>
                    <a href="{{ route('image.detail', ['id' => $image->id]) }}" class="btn btn-sm btn-light btn-comments align-self-center">
                        Comentarios {{count($image->comments)}}
                    </a>
                </div>
                <div>
                    <a class="btn btn-primary" href="{{ route('image.download', ['filename' => $image->image_path]) }}">Descargar</a>
                </div>
            </div>
        </div>
    </section>
    @include('includes.footer')
</body>