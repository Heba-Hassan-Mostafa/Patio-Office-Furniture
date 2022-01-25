@extends('frontend.home')

@section('blog')
<meta name="keywords" content="باتيو,باتيو مصر,اثاث باتيو,اثاث مكتبى,مدونة باتيو,عروض باتيو">
<meta name="description" content="باتيو مصر شركة مصرية تعمل فى مجال الاثاث المكتبى لديها الخبرة الكافية لتلبية جميع متطلبات سوق العمل فى جميع انحاء ومحافظات مصر تعتبر باتيو الشركة الاولى الرائدة فى مجال الاثاث المكتبى">
<meta name="author" content="{{ setting()->siteName }}">
@endsection
@section('content')

<style> 
.blogContentText{
        direction: rtl!important;
        text-align: start!important;
}
</style>

<div class="head-product-page">
    <div class="overlay">
      <h1 class="title-sub-pages">{{ $title }}</h1>
    </div><img src="{{ asset("frontend/images/back-sub.jpg") }}" alt="{{ $title }}" title="{{ $title }}">
  </div>
  <div class="posts">
    <div class="container">
      <div class="row">
        <div class="featured-posts col-md-12" style="margin: auto">
         
          @if ($videos)
          <div class="video-frame text-center">
            @foreach ($videos as $video)
            @php
            $url = getYoutubeId($video->video_link)
            @endphp
            @if($url)


            <iframe class='video-iframe-media' src="https://www.youtube.com/embed/{{ $url }}" frameborder="0"  allowfullscreen="">
            </iframe>

            @endif
            @endforeach
          </div>
          @endif
          
          
          <div class="container media-container">
          <div class="new-post row">
              @if($posts)
              @foreach ($posts as $post )
              
            <div class="card-post old-posts col-md-4 col-sm-12 ">
                @if (!empty($post->image))
                <img class="img-fluid" style="height:250px" src="{{ asset("files/posts/".$post->image) }}" alt="{{ $post->title }}" title="{{ $post->title }}">
                @endif
                
              <div class="row">
                <span class="post-date col-md-6">{{ $post->created_at->format('d-m-Y') }}</span>
                <h5 class="col-md-6">{{ $post->title }}</h5>
              </div>
              <div class="blogContentText">
                  {!!$post->content !!}
              </div>
              <div class="more">
                <div class="readmore-link" style="float:left;">
                    <a href="{{ url('blog/post-details/'.$post->id) }}" title="Read More">Read More</a>
                </div>
                <div class="social-share" style="float:right;">
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
                    <div style="clear:both"></div>
              </div>
            </div>
            @endforeach
            @endif
           </div>
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


@endsection
