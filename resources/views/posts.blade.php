@extends('layouts.frontend.app')

@section('title', 'Posts')
  
    
@push('css')

<link href="{{ asset('assets/frontend/css/category/styles.css') }}" rel="stylesheet">
<link href="{{ asset('assets/frontend/css/category/responsive.css') }}" rel="stylesheet">

<style>
    .favorite_post{
        color: blue;
    }
 
</style>
    
@endpush

@section('content')
    
	<div class="slider display-table center-text">
		<h1 class="title display-table-cell"><b>ALL POSTS</b></h1>
	</div><!-- slider -->

	<section class="blog-area section">
		<div class="container">

			<div class="row">

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

            </div><!-- row -->
            


			{{ $posts->links() }}

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