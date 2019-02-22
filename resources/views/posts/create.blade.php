@extends('layouts.app')

@section('title', '| Create New Post')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

        <h1>Upload an Image</h1>
        <hr>
        {{ Form::open(array('route' => 'posts.store', 'enctype' => 'multipart/form-data')) }}
        <div class="form-group">
            <div class="form-group">
            {{ Form::label('title', 'Title') }}
            {{ Form::text('title', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
            {{ Form::label('description', 'Description') }}
            {{ Form::textarea('description', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                <label for="media">Image</label>
                <div class="needsclick dropzone" id="media-dropzone">
                </div>
            </div>
            <br>

            {{ Form::submit('Upload Image', array('class' => 'btn btn-success btn-lg btn-block')) }}
            {{ Form::close() }}
        </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>




</script>
@stop
