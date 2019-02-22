@extends('layouts.app')
@section('content')


<div class="container" style="margin-top:5rem">
  <div class="row">

    <div class="col-lg-12">
      <div class="gallery-wrapper clearfix">
        <div class="col-lg-4 grid-sizer"></div>
        <div class="col-lg-4 grid-item">
          <div class="card">
            <img class="img-fluid" src="http://via.placeholder.com/800x900">
            <div class="card-body">
              <h5 class="card-title">Card title that wraps to a new line</h5>
              <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            </div>
          </div>
        </div>

        <div class="col-lg-4 grid-item">
            <div class="card">
            <img class="img-fluid" src="http://via.placeholder.com/800x370">
            <div class="card-body">
              <h5 class="card-title">Card title that wraps to a new line</h5>
              <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            </div>
          </div>
        </div>

        <div class="col-lg-4 grid-item">
            <div class="card">
            <img class="img-fluid" src="http://via.placeholder.com/500x370">
            <div class="card-body">
              <h5 class="card-title">Card title that wraps to a new line</h5>
              <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            </div>
          </div>
        </div>

        <div class="col-lg-4 grid-item">
            <div class="card">
            <img class="img-fluid" src="http://via.placeholder.com/500x370">
            <div class="card-body">
              <h5 class="card-title">Card title that wraps to a new line</h5>
              <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            </div>
          </div>
        </div>

        <div class="col-lg-4 grid-item">
            <div class="card">
            <img class="img-fluid" src="http://via.placeholder.com/1024x600">
            <div class="card-body">
              <h5 class="card-title">Card title that wraps to a new line</h5>
              <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            </div>
          </div>
        </div>


        <div class="col-lg-4 grid-item">
          <img class="img-fluid" src="http://via.placeholder.com/1024x300">
        </div>

        <div class="col-lg-4 grid-item">
          <img class="img-fluid" src="http://via.placeholder.com/1024x600">
        </div>

        <div class="col-lg-4 grid-item">
          <img class="img-fluid" src="http://via.placeholder.com/800x900">
        </div>

        <div class="col-lg-4 grid-item">
          <img class="img-fluid" src="http://via.placeholder.com/1024x600">
        </div>

      </div>
    </div>


  </div>
</div>

<button id="test">test</button>
                </div>
            </div>
        </div>

@verbatim
<script id="mustacheTemplate_gallery_item2" type="text/template">
<div class="card">
    <img class="card-img-top" src="{{ images.urls.small }}" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">{{ post.title }}</h5>
      <p class="card-text">{{ post.description }}</p>
    </div>
  </div>
</script>
<script id="mustacheTemplate_gallery_item" type="text/template">
<div class="col-lg-4 grid-item">
    <div class="card">
    <img class="img-fluid" src="{{ image }}">
    <div class="card-body">
      <h5 class="card-title">Card title that wraps to a new line</h5>
      <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
    </div>
  </div>
</div>
</script>
@endverbatim
@endsection
