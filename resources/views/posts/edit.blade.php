@extends('layouts.app')

@section('title', '| Edit Post')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-8 col-md-offset-2">

            <h1>Edit Post</h1>
            <hr>
                {{ Form::model($post, array('route' => array('posts.update', $post->id), 'method' => 'PUT')) }}
                <div class="form-group">

                {{ Form::label('title', 'Title') }}
                {{ Form::text('title', null, array('class' => 'form-control')) }}<br>
                </div>

                <div class="form-group">
                {{ Form::label('description', 'Post Description') }}
                {{ Form::textarea('description', null, array('class' => 'form-control')) }}<br>
                </div>

                <div class="form-group">
                    <label for="media">Documents</label>
                    <div class="needsclick dropzone" id="media-dropzone">
                    </div>
                </div>

                {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}

                {{ Form::close() }}
        </div>
        </div>
    </div>
</div>
@endsection
