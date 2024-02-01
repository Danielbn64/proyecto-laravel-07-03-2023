@extends('layouts.app')

@section('content')
<div class="container">	
    <div class="row justify-content-center">
        <div class="col-md-8">
		<h1>Perfiles</h1>
		<form method="GET" action="{{ route('user.index')}}" id="buscador">
			<div class="row search-user">
				<div class="form-group col btn-search">
					<input type="text" id="search" class="form-control">	
				</div>
				<div class="form-group">
					<input type="submit" value="Buscar" class="btn btn-success">	
				</div>
			</div>
			<hr>
		</form>
            @foreach($users as $user)
            <div class="profile-user">
				@if( $user->image)
					<div class="container-avatar">
						<img src="{{ route('user.avatar',['filename'=>$user->image]) }}" class="avatar" />
					</div>
				@else
				<div class="container-avatar">
					<img src="{{ asset('img/user_placeholder.png') }}" />
				</div>
				@endif
				
				<div class="user-info">
					<h2>{{'@'. $user->nick}}</h1>
					<h3>{{ $user->name .' '.  $user->surname}}</h2>
					<p>{{'Se unió: '.\FormatTime::LongTimeFilter( $user->created_at)}}</p>
                    <a href="{{ route('profile',['id'=> $user->id])}}" class="btn btn-succes ">Ver perfil</a>
				</div>
				
				<div class="clearfix"></div>
				<hr>
			</div>
            <div class="clearfix"></div>
            @endforeach
            <!--Paginación-->
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection