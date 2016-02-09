@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>{{ $user->username }}</h3>

                @if (Auth::user()->isNot($user))
                    @if (Auth::user()->isFollowing($user))
                        <a href="{{ route('user.unfollow', $user) }}">Unfollow</a>
                    @else
                        <a href="{{ route('user.follow', $user) }}">Follow</a>
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection
