@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="row-md-8">
			<div class="profile-user">
				@if($user->image)
				<div class="container-avatar">
					<img src="{{ route('user.avatar',['filename'=>$user->image]) }}" />
				</div>
				@else
				<div class="container-avatar">
					<img src="{{ asset('img/user_placeholder.png') }}" />
				</div>
				@endif

				<div class="user-info">
					<h1>{{'@'.$user->nick}}</h1>
					<h2>{{ $user->name .' '.  $user->surname}}</h2>
					<p>{{'Se unió: '.\FormatTime::LongTimeFilter( $user->created_at)}}</p>
				</div>
			</div>
		</div>
	</div>
	<hr>
	<div class="d-flex flex-wrap">
		@foreach($images as $image)
			@include('includes.image',['image'=>$image])
		@endforeach
	</div>
	<div class="d-flex justify-content-center">
        {{ $images->links() }}
    </div>
	@endsection
</div>