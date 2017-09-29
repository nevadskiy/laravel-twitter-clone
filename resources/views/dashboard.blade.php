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
                <article class="post panel panel-default" data-post-id="{{ $post->id }}">
                    <div class="panel-body">
                        <div class="media">
                            <div class="media-left">
                                <a href="#">
                                    <img alt="64x64" class="media-object" data-src="holder.js/64x64" style="width: 64px; height: 64px;" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNWVjZWZjZmM1NCB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1ZWNlZmNmYzU0Ij48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxMi4xNzk2ODc1IiB5PSIzNi41Ij42NHg2NDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==" data-holder-rendered="true">
                                </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">{{ $post->user->name }}</h4>
                                <p class="post-body">{{ $post->body }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer clearfix">
                        <div class="actions btn-group pull-left">
                            <a href="#" class="btn btn-primary btn-sm">Like</a>
                            <a href="#" class="btn btn-info btn-sm">Dislike</a>
                            @can('update', $post)
                                <button type="button" class="btn post-edit btn-warning btn-sm">Edit</button>
                                <a href="{{ route('post.destroy', $post->id) }}" class="btn btn-danger btn-sm">Delete</a>
                            @endcan
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

    <div class="modal fade" tabindex="-1" role="dialog" id="modal-edit">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Modal title</h4>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="body">Edit the post</label>
                            <textarea class="form-control" name="body" id="post-body" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id="post-update" class="btn btn-primary">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@section('scripts')
    <script>
        var token = '{{ Session::token() }}';
        var url = '{{ route('post.update', 0) }}';
        var postId = 0;
        var postBodyElement = null;

        $('.post-edit').on('click', function(e) {
            e.preventDefault();
            postBodyElement = event.target.parentNode.parentNode.parentNode.getElementsByClassName('post-body')[0];
            var body = postBodyElement.textContent;
            postId = event.target.parentNode.parentNode.parentNode.dataset.postId;
            url = url.slice(0, -1) + postId;
            $('#post-body').val(body);
            $('#modal-edit').modal();
            console.log(url);
        })

        $('#post-update').on('click', function() {
            $.ajax({
                method: 'PUT',
                url: url,
                data: { body: $('#post-body').val(), postId: postId, _token: token }
            }).done(function(msg) {
                $(postBodyElement).text(msg.body);
                $('#modal-edit').modal('hide');
            });
        });
    </script>
@endsection