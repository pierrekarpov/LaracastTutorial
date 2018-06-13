@extends('layouts.master')

@section('content')
<div class="col-md-8">
  <h1>{{ $post->title }}</h1>
  <p class="blog-post-meta">{{ $post->created_at->toFormattedDateString() }}</p>
  @if (count($post->tags))
    <ul>
      @foreach ($post->tags as $tag)
        <li>
          <a href="/posts/tags/{{$tag->name}}">
            {{$tag->name}}
          </a>
        </li>
      @endforeach
    </ul>
  @endif
  <p>
    {{ $post->body }}
  </p>

  <hr />

  <div class="comments">
    <ul class="list-group">
      @foreach ($post->comments as $comment)
        <li class="list-group-item">
          <strong>
            {{ $comment->user->name }}&nbsp;({{ $comment->created_at->diffForHumans() }}):&nbsp;
          </strong>
          {{ $comment->body }}
        </li>
      @endforeach
    </ul>
  </div>

  <div class="card" style="padding:15px; margin: 15px 0px 15px 0px;">
    <div class="card-block">
      <form method="POST" action="/posts/{{ $post->id }}/comments">
        {{ csrf_field() }}
        <div class="form-group">
          <textarea name="body" placeholder="Your comment here." class="form-control" required></textarea>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary">Add Comment</button>
        </div>
      </form>
    </div>
  </div>

  @include('layouts.errors')

  <a href="/posts">Back</a>
</div>
@endsection
