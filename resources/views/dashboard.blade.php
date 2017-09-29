@extends('layouts.app')

@section('title', '| Dashboard')

@section('content')
    <section class="new-post">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <form action="">
                    <div class="form-group">
                        <textarea name="" id="" cols="5" class="form-control" placeholder="What's going on?"></textarea>
                    </div>
                    <button class="btn btn-primary btn-block">Отправить</button>
                </form>
            </div>
        </div>
    </section>
    <section class="posts">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h3>What other people say...</h3>
                <article class="post panel panel-default">
                    <div class="panel-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid culpa ea esse laborum maiores natus nemo odio. Et nesciunt quidem tenetur. Dolor eligendi excepturi ipsam minima, nihil nostrum qui tenetur.</p>
                        <div class="info">
                            Posted by Max on 12 Feb 2016
                        </div>
                        <div class="action btn-group">
                            <a href="#" class="btn btn-default btn-sm">Like</a>
                            <a href="#" class="btn btn-default btn-sm">Dislike</a>
                            <a href="#" class="btn btn-default btn-sm">Edit</a>
                            <a href="#" class="btn btn-default btn-sm">Delete</a>
                        </div>
                    </div>
                </article>
                <article class="post panel panel-default">
                    <div class="panel-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid culpa ea esse laborum maiores natus nemo odio. Et nesciunt quidem tenetur. Dolor eligendi excepturi ipsam minima, nihil nostrum qui tenetur.</p>
                        <div class="info">
                            Posted by Max on 12 Feb 2016
                        </div>
                        <div class="action btn-group">
                            <a href="#" class="btn btn-default btn-sm">Like</a>
                            <a href="#" class="btn btn-default btn-sm">Dislike</a>
                            <a href="#" class="btn btn-default btn-sm">Edit</a>
                            <a href="#" class="btn btn-default btn-sm">Delete</a>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>
@endsection