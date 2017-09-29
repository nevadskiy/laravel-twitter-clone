@extends('layouts.app')

@section('title', '| Profile')

@section('content')
    <section class="profile">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name">Your name</label>
                        <input name="name" class="form-control" id="name">
                        <span class="help-block">{{ $errors->first('name') }}</span>
                    </div>
                    <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                        <label for="image">Image (only .jpg)</label>
                        <input type="file" name="image" class="form-control" id="image">
                        <span class="help-block">{{ $errors->first('image') }}</span>
                    </div>
                    {{ csrf_field() }}
                    <button class="btn btn-primary btn-block">Save</button>
                </form>
            </div>
        </div>
    </section>
    @if(Storage::disk('local')->has($user->name . '-' . $user->id . '.jpg'))
        <section>
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <img src="{{ route('profile.image', ['filename' => $user->name . '-' . $user->id . '.jpg']) }}" alt="">
                </div>
            </div>
        </section>
    @endif

@endsection