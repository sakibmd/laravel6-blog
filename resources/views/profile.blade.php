@extends('layouts.frontend.app')

@section('title')
    {{ $author->username }}
@endsection
  
    
@push('css')

<link href="{{ asset('assets/frontend/css/profile/styles.css') }}" rel="stylesheet">
<link href="{{ asset('assets/frontend/css/profile/responsive.css') }}" rel="stylesheet">

<style>
    .favorite_post{
        color: blue;
    }

    
 
</style>
    
@endpush

@section('content')
    
<div class="slider display-table center-text">
    <h1 class="title display-table-cell"><b>{{ $author->name }}</b></h1>
</div><!-- slider -->

<section class="blog-area section">
    <div class="container">

        <div class="row">

            <div class="col-lg-8 col-md-12">
                <div class="row">


        @if($posts->count() > 0)
            @foreach ($posts as $post)
               <div class="col-md-6 col-lg-6">
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

            @else 

            <div class="col-lg-12 col-md-12">
                <div class="card h-100">
                    <div class="single-post post-style-1">
                        <div class="title">
                            <h4><strong>Sorry There Have No Post Found</strong></h4>
                        </div>
                    </div>
                </div>
            </div>


            @endif

                </div><!-- row -->

                

            </div><!-- col-lg-8 col-md-12 -->

            <div class="col-lg-4 col-md-12 ">

                <div class="single-post info-area ">

                    <div class="about-area">
                        <h4 class="title"><b>AUTHOR PROFILE</b></h4>
                        <h5><b>Name: {{ $author->name }}</b></h5>
                        <p style="text-align: justify">{{ $author->about }}</p><br>
                        <b>Posts: {{ $posts->count() }} </b><br>
                        <b>Author Sence: {{ $author->created_at->toDateString() }} </b>
                        
                    </div>

                    

                    

                </div><!-- info-area -->

            </div><!-- col-lg-4 col-md-12 -->

        </div><!-- row -->

    </div><!-- container -->
</section><!-- section -->














@endsection




@push('js')

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