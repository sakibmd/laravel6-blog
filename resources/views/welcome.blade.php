@extends('layouts.frontend.app')

@section('title','Main Blog')
    
@push('css')

<link href="{{ asset('assets/frontend/css/home/styles.css') }}" rel="stylesheet">
<link href="{{ asset('assets/frontend/css/home/responsive.css') }}" rel="stylesheet">
<style>
    .favorite_post{
        color: blue;
    }
</style>
    
@endpush

@section('content')

    <div class="main-slider">
        <div class="swiper-container position-static" data-slide-effect="slide" data-autoheight="false"
            data-swiper-speed="500" data-swiper-autoplay="10000" data-swiper-margin="0" data-swiper-slides-per-view="4"
            data-swiper-breakpoints="true" data-swiper-loop="true" >
            <div class="swiper-wrapper">

               @foreach ($categories as $category)
                <div class="swiper-slide">
                    <a class="slider-category" href="{{ route('category.posts',$category->slug) }}">
                        <div class="blog-image"><img src="{{ asset('storage/category/slider/'.$category->image) }}" alt="{{ $category->name }}"></div>

                        <div class="category">
                            <div class="display-table center-text">
                                <div class="display-table-cell">
                                    <h3><b>{{ $category->name }}</b></h3>
                                </div>
                            </div>
                        </div>

                    </a>
                </div><!-- swiper-slide -->
                @endforeach

            </div><!-- swiper-wrapper -->

        </div><!-- swiper-container -->

    </div><!-- slider -->

    <section class="blog-area section">
        <div class="container">


            @if (session()->has('successFav'))
                    <div class="alert alert-success m-3" role="alert">
                        {{ session()->get('successFav') }}
                    </div>
            @endif



            {{-- Popular Post Start --}}

            @if($popularPosts->count() > 0)
            <div class="row">
                <div class="col-md-6 col-sm-4">
                    <h2 style="float:left; font-weight: 600">Popular Post</h2>
                </div>
                <div class="col-md-6 col-sm-4">
                    {{-- <a href="{{ route('post.index') }}" style="float:right" class="btn btn-info btn-md mt-2">See More</a> --}}
                </div>
            </div>
            @endif
            
            
           <div class="row mt-3" style="margin-bottom: 100px">
              
               @foreach ($popularPosts as $post)
            
               <div class="col-lg-3 col-md-4">
                <div class="card h-100">
                    <div class="single-post post-style-1">

                        <div class="blog-image"><img src="{{ asset('storage/post/'.$post->image) }}" alt="Blog Image"></div>

                        <a class="avatar" href="{{ route('author.profile', $post->user->username) }}">
                            <img src="{{ asset('storage/profile/'.$post->user->image) }}" alt="Profile Image">
                        </a>

                        <div class="blog-info">

                            <h4 class="title"><a href="{{ route('post.details', $post->slug) }}"><b>{{ $post->title }}</b></a></h4>

                            <ul class="post-footer">
                                <li>
                                 
            @guest
                <a href="#" onclick="fav()"><i class="ion-heart"></i>{{ $post->favorite_to_user->count() }}</a>
            
            @else
                <a href="javascript::void(0)"  
                onclick="document.getElementById('favorite-form-{{ $post->id }}').submit();"
                class="{{ !Auth::user()->favorite_posts->where('pivot.post_id',$post->id)->count() == 0 ? 'favorite_post' : '' }}"> 
                     <i class="ion-heart"></i>
                     {{ $post->favorite_to_user->count() }}</a>
                    
                    <form id="favorite-form-{{ $post->id }}" method="POST" action="{{ route('post.favorite',$post->id)}}" style="display: none;">
                        @csrf
                    </form>
            @endguest
                                    
                                </li>
                            <li><a href="#" onclick="comment()"><i class="ion-chatbubble"></i>{{ $post->comments->count() }}</a></li>
                            <li><a href="#"><i class="ion-eye"></i>{{ $post->view_count }}</a></li>
                            </ul>

                        </div><!-- blog-info -->
                    </div><!-- single-post -->
                </div><!-- card -->
            </div><!-- col-lg-4 col-md-6 -->

            @endforeach
           </div>





            {{-- Popular Post End --}}






            @if($posts->count() > 0)
            <div class="row">
                <div class="col-md-6 col-sm-4">
                    <h2 style="float:left; font-weight: 600">Latest Post</h2>
                </div>
                <div class="col-md-6 col-sm-4">
                    <a href="{{ route('post.index') }}" style="float:right" class="btn btn-info btn-md mt-2">See More</a>
                </div>
            </div>
            @endif
            
            
           <div class="row mt-3">
              
               @foreach ($posts as $post)
            
               <div class="col-lg-3 col-md-4">
                <div class="card h-100">
                    <div class="single-post post-style-1">

                        <div class="blog-image"><img src="{{ asset('storage/post/'.$post->image) }}" alt="Blog Image"></div>

                        <a class="avatar" href="{{ route('author.profile', $post->user->username) }}">
                            <img src="{{ asset('storage/profile/'.$post->user->image) }}" alt="Profile Image">
                        </a>

                        <div class="blog-info">

                            <h4 class="title"><a href="{{ route('post.details', $post->slug) }}"><b>{{ $post->title }}</b></a></h4>

                            <ul class="post-footer">
                                <li>
                                 
            @guest
                <a href="#" onclick="fav()"><i class="ion-heart"></i>{{ $post->favorite_to_user->count() }}</a>
            
            @else
                <a href="javascript::void(0)"  
                onclick="document.getElementById('favorite-form-{{ $post->id }}').submit();"
                class="{{ !Auth::user()->favorite_posts->where('pivot.post_id',$post->id)->count() == 0 ? 'favorite_post' : '' }}"> 
                     <i class="ion-heart"></i>
                     {{ $post->favorite_to_user->count() }}</a>
                    
                    <form id="favorite-form-{{ $post->id }}" method="POST" action="{{ route('post.favorite',$post->id)}}" style="display: none;">
                        @csrf
                    </form>
            @endguest
                                    
                                </li>
                            <li><a href="#" onclick="comment()"><i class="ion-chatbubble"></i>{{ $post->comments->count() }}</a></li>
                            <li><a href="#"><i class="ion-eye"></i>{{ $post->view_count }}</a></li>
                            </ul>

                        </div><!-- blog-info -->
                    </div><!-- single-post -->
                </div><!-- card -->
            </div><!-- col-lg-4 col-md-6 -->

            @endforeach
           </div>
        {{-- <a class="load-more-btn" href="{{ route('post.index') }}"><b>Read More</b></a> --}}

        </div><!-- container -->
    </section><!-- section -->

@endsection

@push('js')

    <script src="{{ asset('assets/frontend/js/swiper.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/scripts.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
        <script type="text/javascript">
            function fav(){
                Swal.fire({
                    title: 'To Add Your Favorite List, You Need To Login First!',
                    showClass: {
                        popup: 'animated fadeInDown faster'
                    },
                    hideClass: {
                        popup: 'animated fadeOutUp faster'
                    }
                    })
            }	

            function comment(){
                Swal.fire({
                    title: 'To type a comment, You Need To Login First!',
                    showClass: {
                        popup: 'animated fadeInDown faster'
                    },
                    hideClass: {
                        popup: 'animated fadeOutUp faster'
                    }
                    })
            }
        </script>

@endpush