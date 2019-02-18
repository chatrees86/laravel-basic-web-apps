@extends('layouts.app')

@section('content')

<div class="container">
    <div class="box box-warning">
        <div class="box-header with-border">
            <h3 class="box-title">Create Crypto News</h3>
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul> 
                        @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(\Session::has('success'))
                <div class="alert alert-success">
                <p>{{ \Session::get('success') }}</p>
                <img src="/images/{{ Session::get('path') }}" widht="300">
                </div>
            @endif
        </div>
        <div class="box-body">
        <form method="post" enctype="multipart/form-data" action="{{url('crypto')}}">
            {{ csrf_field() }}
            <div class="form-group">
                <label>Headline News</label>
                <input type="text" class="form-control" name="headline" placeholder="Enter ...">
            </div>
            <div class="form-group">
                <label>Content</label>
                <textarea class="form-control" rows="3" name="contents" placeholder="Enter ..."></textarea>
            </div>
            <div class="form-group">
                <label>Thumbnails</label>
                <input type="file" name="thumbnails_img">
            </div>
            <div class="form-group">
                <input type="submit" name="Create" class="btn-primary" value="Create">
            </div>
        </div>
        </form>
    </div>
</div>

@endsection