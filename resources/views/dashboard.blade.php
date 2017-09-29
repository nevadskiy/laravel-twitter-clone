@extends('layouts.app')

@section('title', '| Dashboard')

@section('content')
    <section class="new-post">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <form action="{{ route('post.create') }}" method="post">
                    <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                        <textarea name="body" id="" cols="5" class="form-control" placeholder="What's going on?">{{ old('body') }}</textarea>
                        <span class="help-block">{{ $errors->first('body') }}</span>
                    </div>
                    {{ csrf_field() }}
                    <button class="btn btn-primary btn-block">Post</button>
                </form>
            </div>
            </div>
        </div>
    </section>
    <section class="posts">
        <h3 class="text-center">What other people say...</h3>
        @foreach($posts as $post)
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <article class="post panel panel-default">
                    <div class="panel-body">
                        <div class="media">
                            <div class="media-left">
                                <a href="#">
                                    <img alt="64x64" class="media-object" data-src="holder.js/64x64" style="width: 64px; height: 64px;" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNWVjZWZjZmM1NCB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1ZWNlZmNmYzU0Ij48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxMi4xNzk2ODc1IiB5PSIzNi41Ij42NHg2NDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==" data-holder-rendered="true">
                                </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">{{ $post->user->name }}</h4>
                                {{ $post->body }}
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer clearfix">
                        <div class="actions btn-group pull-left">
                            <a href="#" class="btn btn-primary btn-sm">Like</a>
                            <a href="#" class="btn btn-info btn-sm">Dislike</a>
                            <a href="#" class="btn btn-warning btn-sm">Edit</a>
                            <a href="{{ route('post.destroy', $post->id) }}" class="btn btn-danger btn-sm">Delete</a>
                        </div>
                        <div class="pull-right date">
                            <p class="date">Posted {{ $post->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </article>
            </div>
        </div>
        @endforeach
    </section>
@endsection