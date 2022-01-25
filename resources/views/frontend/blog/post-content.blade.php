@extends('frontend.home')
@section('blog')
@if($post)
<meta name="keywords" content="{{ $post->keywords }}">
<meta name="description" content="{{ $post->description }}">
<meta name="author" content="{{ setting()->siteName }}">
<meta property="og:title" content="{{ $post->title }}">
<meta property="og:image" content="{{ asset("files/posts/".$post->image) }}">
<meta property="og:url" content="https://patio-egypt.com/blog/post-details/{{ $post->id }}">
<meta id="faceDes" property="og:description" content=" ">
<meta property="og:sitename" content="{{ setting()->siteName }}">


@endif
@endsection
@section('content')

<!--  <div id="fb-root"></div>-->
<!--<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v12.0&appId=4439369002817457&autoLogAppEvents=1" nonce="9NWTKWzW"></script>-->


<div class="head-product-page">
    <div class="overlay">
      <h1 class="title-sub-pages">{{ $title }}</h1>
    </div><img src="{{ asset("frontend/images/back-sub.jpg") }}" alt="{{ $title }}" title="{{ $title }}">
  </div>
  <div class="posts">
    <div class="container">
        
        
      <div class="row">
          @if ($post)
        <div class="featured-posts col-md-8">
          <div class="new-post">
            <div class="card-post col-md-12">
                @if (!empty($post->image))
                <img class="img-fluid"  src="{{ asset("files/posts/".$post->image) }}" alt="{{ $post->title }}" title="{{ $post->title }}">
                @endif
              <div class="row">
                
                <span class="post-date col-md-6">{{ $post->created_at->format('d-m-Y') }}</span>
                <h5 class="col-md-6">{{ $post->title }}</h5>
              </div>

                <div id="contentText" >{!! $post->content !!}</div>

              <div class="more row">

                <div class="social-share col-12">
                    <a href="https://api.addthis.com/oexchange/0.8/forward/facebook/offer?url={{ url('blog/post-details/'.$post->id) }}&ct=1&title={{ $post->title }} {{ setting()->siteName }}&pco=tbxnj-1.0"
                        rel="nofollow" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://api.addthis.com/oexchange/0.8/forward/twitter/offer?url={{ url('blog/post-details/'.$post->id) }}&ct=1&title={{ $post->title }} {{ setting()->siteName }}&pco=tbxnj-1.0"
                        rel="nofollow" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a href="https://api.addthis.com/oexchange/0.8/forward/whatsapp/offer?url={{ url('blog/post-details/'.$post->id) }}&ct=1&title={{ $post->title }} {{ setting()->siteName }}&pco=tbxnj-1.0"
                        rel="nofollow" target="_blank"><i class="fab fa-whatsapp"></i></a>
                    <a href="https://api.addthis.com/oexchange/0.8/forward/messenger/offer?url={{ url('blog/post-details/'.$post->id) }}&ct=1&title={{ $post->title }} {{ setting()->siteName }}&pco=tbxnj-1.0"
                        rel="nofollow" target="_blank"><i class="fab fa-facebook-messenger"></i></a>
                    <a href="https://api.addthis.com/oexchange/0.8/forward/gmail/offer?url={{ url('blog/post-details/'.$post->id) }}&ct=1&title={{ $post->title }} {{ setting()->siteName }}&pco=tbxnj-1.0"
                        rel="nofollow" target="_blank"><i class="fas fa-envelope gmail"></i></a>
                     </div>
              </div>
                <!--<div class="fb-comments" data-href="{{ request()->url() }}" data-width="550" data-numposts="5"></div>  -->
                </div>
          </div>
        </div>
        @else
        <div class='col-md-7 text-center text-secondary font-weight-bold d-flex justify-content-center'>
            Post Not Found Or Not Available Now <span class='text-danger'>  &nbsp; !!  </span></div>
        @endif
        <div class="random-posts col-md-4">
          <h4> RANDOM POST</h4>
          <div class="row">
            @if($filters)
             @php
            if($post){
                $filters = $filters->except($post->id);
            }
            @endphp
            @foreach ($filters as $random )
            <div class="card-post old-posts col-12">

                @if (!empty($random->image))
                <img class="img-fluid" style="height:250px" src="{{ asset("files/posts/".$random->image) }}" alt="{{ $random->title }}" title="{{ $random->title }}">
                @endif
              <div class="row">
                
                <span class="post-date col-md-6">{{ $random->created_at->format('d-m-Y') }}</span>
                <h5 class="col-md-6">{{ $random->title }}</h5>
              </div>
              <div class="blogContentText">{!! $random->content !!}</div>
              <div class="more row">
                <div class="readmore-link col-5"><a href="{{ url('blog/post-details/'.$random->id) }}" title="Read More">Read More</a></div>
                <div class="social-share col-7">
                    <a href="https://api.addthis.com/oexchange/0.8/forward/facebook/offer?url={{ url('blog/post-details/'.$random->id) }}&ct=1&title={{ $random->title }} {{ setting()->siteName }}&pco=tbxnj-1.0"
                        rel="nofollow" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://api.addthis.com/oexchange/0.8/forward/twitter/offer?url={{ url('blog/post-details/'.$random->id) }}&ct=1&title={{ $random->title }} {{ setting()->siteName }}&pco=tbxnj-1.0"
                        rel="nofollow" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a href="https://api.addthis.com/oexchange/0.8/forward/whatsapp/offer?url={{ url('blog/post-details/'.$random->id) }}&ct=1&title={{ $random->title }} {{ setting()->siteName }}&pco=tbxnj-1.0"
                        rel="nofollow" target="_blank"><i class="fab fa-whatsapp"></i></a>
                    <a href="https://api.addthis.com/oexchange/0.8/forward/messenger/offer?url={{ url('blog/post-details/'.$random->id) }}&ct=1&title={{ $random->title }} {{ setting()->siteName }}&pco=tbxnj-1.0"
                        rel="nofollow" target="_blank"><i class="fab fa-facebook-messenger"></i></a>
                    <a href="https://api.addthis.com/oexchange/0.8/forward/gmail/offer?url={{ url('blog/post-details/'.$random->id) }}&ct=1&title={{ $random->title }} {{ setting()->siteName }}&pco=tbxnj-1.0"
                        rel="nofollow" target="_blank"><i class="fas fa-envelope gmail"></i></a>
                            </div>
              </div>
            </div>
            @endforeach
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
  
 <script>
let test = document.querySelectorAll(".blogContentText");


    test.forEach(element => {

        let testCon = element.innerText;

        element.innerHTML = (testCon.substring(0,130) + " ... ");

    });



</script>
<script>
      let face = document.getElementById("faceDes");
      let divContent = document.getElementById("contentText");
      let contentText = divContent.firstChild.innerText.substring(0,100) ;


      face.setAttribute("content" , contentText);


      console.log(divContent.firstChild.innerText.substring(0,100) );

  </script>

@endsection
