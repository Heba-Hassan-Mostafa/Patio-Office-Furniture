@extends('frontend.home')
@section('header')
<meta name="keywords" content="{{ setting()->keywords }}">
<meta name="description" content="{{ setting()->description }}">
<meta name="author" content="{{ setting()->siteName }}">
@endsection
@section('content')

<div class="head-product-page">
    <div class="overlay">
      <h1 class="title-sub-pages">{{ $title }}</h1>
    </div><img src="{{ asset("frontend/images/back-sub.jpg") }}" alt="{{ $title }}">
  </div>
  <div class="catalogue">
    <div class="container">
      <div class="download-pdf">
        @if(!empty(pdf()->pdf))
        <button class="btn btn-success">

            <a href="{{ asset('/files/pdf/'.pdf()->pdf) }}" title="Downlaod Catalogues" download>Downlaod Catalogues</a><i class="fas fa-download"></i>
        </button>

        @endif


      </div>
      <h2>Catalogues Gallary </h2>
      <div class="row cat-stylepad">
          @if ($cats)
          @foreach ($cats as $cat)


        <div class="col-md-4 catalogue-card">
          <div class="overlay">
            <button type="button" data-toggle="modal" data-target="#basicExampleModal-{{ $cat->id }}" title="{{ $cat->name }}">{{ $cat->name }}</button>
          </div>
          @if (!empty($cat->image))
          <img class="img-fluid" src="{{ asset("files/imgCats/".$cat->image) }}" style="height:240px; width: 360px;" alt="{{ $cat->name }}" title="{{ $cat->name }}">
          @endif

          @php
          $category = App\Models\ImageCategory::Where('id',$cat->id)->whereStatus(1)->orderBy('id', 'desc')->first();
          if($category){
            $image= App\Models\Catalogue::with(['imageCategory','imageMedia'])
            ->whereImageCategoryId($category->id)
           ->whereStatus(1)
           ->orderBy('id', 'desc')
           ->first();

          }

        @endphp
          <!-- Modal-->
          <div class="modal fade" id="basicExampleModal-{{ $cat->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-slide" role="document">
              <div class="container">
                <div class="modal-content">
                  <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                  </div>
                  <div class="modal-body">
                    <div class="card__copy">
                      <div class="gallery">
                        <div class="container style-container">
                          <div class="box-images">
                            <div class="row">
                                @if ($image->imageMedia->count() > 0)
                              @foreach ($image->imageMedia as $img)
                              <div class="col-md-4"><a href="{{ asset("/files/images/". $img->file_name) }}" data-lightbox="mygallery">
                                <img class="img-gallery img-fluid" src="{{ asset("/files/images/". $img->file_name) }}" style='height: 240px;
                                width: 360px; margin-top:10px' alt="image" title="image"></a></div>

                              @endforeach
                              @endif
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        @endforeach

        @endif
      </div>
    </div>
  </div>
@endsection
