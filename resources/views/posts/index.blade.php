@extends('layouts.app')
@section('content')


    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-1">


      <div class="gallery-wrapper clearfix">
        <div class="col-lg-4 grid-sizer"></div>
    </div>

    <!-- status elements -->
<div class="page-load-status">
  <div class="loader-ellips infinite-scroll-request">
    <span class="loader-ellips__dot"></span>
    <span class="loader-ellips__dot"></span>
    <span class="loader-ellips__dot"></span>
    <span class="loader-ellips__dot"></span>
  </div>
  <p class="infinite-scroll-last h5 font-weight-light">End of content</p>
  <p class="infinite-scroll-error h5 font-weight-light">No more pages to load</p>
</div>

<!-- pagination has path -->
<!--<p class="pagination">
  <a class="pagination__next" href="page2.html">Next page</a>
</p>-->

<div class="pagination">
  <a class="pagination__next" href="/ajax/posts?page=1">Next</a>
</div>


            </div>
        </div>

    </div>


@verbatim
<script id="mustacheTemplate_gallery_item" type="text/template">
<div class="col-lg-4 grid-item">
    <div class="card">
        <a href="{{ images.urls.large }}" data-toggle="lightbox" data-title="{{ post.title }}" data-footer="{{ post.description }}">
    <img class="img-fluid" src="{{ images.urls.small }}">
    </a>
    <div class="card-body">
      <h3 class="card-title font-weight-bold">{{ post.title }}</h3>
      <p class="card-text h5 font-weight-light">by {{ post.user.name }}</p>
    </div>
  </div>
</div>
</script>
@endverbatim
@endsection
