@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" id="timeline">
        <div class="col-md-4">
            <form action="#" v-on:submit="postStatus">
                <div class="form-group">
                    <textarea class="form-control" rows="5" placeholder="What are you upto?" maxlength="140" required v-model="post"></textarea>
                </div>
                <input type="submit" value="Post" class="form-control">
            </form>
        </div>
        <div class="col-md-8">
            <p v-if="!posts.length">No posts to see here yet. Follow someone and make it happen.</p>
            <div class="posts" v-if="posts.length">
                <div class="media" v-for="post in posts" track-by="id" transition="expand">
                    <div class="media-left">
                        <img class="media-object" v-bind:src="post.user.avatar">
                    </div>
                    <div class="media-body">
                        <div class="user">
                            <a href="@{{ post.user.profileUrl }}"><strong>@{{ post.user.username }}</strong></a> - @{{ post.humanCreatedAt }}
                        </div>
                        <p>@{{ post.body }}</p>
                    </div>
                </div>
            </div>

            <hr>

            <a href="#" class="btn btn-primary" v-if="total > posts.length" v-on:click="getMorePosts($event)">Show more</a>
        </div>
    </div>
</div>
@endsection
