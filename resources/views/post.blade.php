@extends('layouts.frontend.app')

@section('title')
    {{ $post->title }}
@endsection
    
@push('css')

<link href="{{ asset('assets/frontend/css/single-post/styles.css') }}" rel="stylesheet">
<link href="{{ asset('assets/frontend/css/single-post/responsive.css') }}" rel="stylesheet">

<style>
    .favorite_post{
        color: blue;
    }

    .header-bg{
        height: 40%;
        background-size: cover;
        weight: 100%;
        background-image: url({{ asset('/storage/post/'.$post->image) }}) ;
    }
</style>
    
@endpush

@section('content')

    
	<div class="header-bg">

	</div><!-- slider -->

	<section class="post-area section">
		<div class="container">

			<div class="row">

				<div class="col-lg-8 col-md-12 no-right-padding">

					<div class="main-post">

						<div class="blog-post-inner">

							<div class="post-info">

								<div class="left-area">
									<a class="avatar" href="{{ route('author.profile', $post->user->username) }}">
										<img src="{{ asset('storage/profile/'.$post->user->image) }}" alt="Profile Image"></a>
								</div>

								<div class="middle-area">
									<a class="name" href="{{ route('author.profile', $post->user->username) }}"><b>{{ $post->user->name }}</b></a>
                                <h6 class="date"> on {{ $post->created_at->diffforhumans() }}</h6>
								</div>

							</div><!-- post-info -->

		<h3 class="title"><a href="#"><b>{{ $post->title }}</b></a></h3>

                        <p class="para">{!! html_entity_decode($post->body) !!}</p>

							<ul class="tags">
                                @foreach ($post->tags as $tag)
                                    <li><a href="{{ route('tag.posts',$tag->slug) }}">{{ $tag->name }}</a></li>
                                @endforeach
							</ul>
						</div><!-- blog-post-inner -->

						<div class="post-icons-area">
							<ul class="post-icons">
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

							
						</div>

						


					</div><!-- main-post -->
				</div><!-- col-lg-8 col-md-12 -->

				<div class="col-lg-4 col-md-12 no-left-padding">

					<div class="single-post info-area">

						<div class="sidebar-area about-area">
							<h4 class="title"><b>ABOUT AUTHOR</b></h4>
                                <p  style="text-align: justify; font-size:15px;">{{ $post->user->about }}</p>
						</div>

						

						<div class="tag-area">

							<h4 class="title"><b>CATEGORIES</b></h4>
							<ul>
                                @foreach ($post->categories as $category)
                                    <li><a href="{{ route('category.posts',$category->slug) }}">{{ $category->name }}</a></li>
                                @endforeach
							</ul>

						</div><!-- subscribe-area -->

					</div><!-- info-area -->

				</div><!-- col-lg-4 col-md-12 -->

			</div><!-- row -->

		</div><!-- container -->
	</section><!-- post-area -->


	<section class="recomended-area section">
		<div class="container">
			<div class="row">
                @foreach ($randomposts as $random)
                <div class="col-lg-3 col-md-6">
					<div class="card h-100">
						<div class="single-post post-style-1">

							<div class="blog-image"><img src="{{ asset('storage/post/'.$random->image) }}" alt="Blog Image"></div>

							<a class="avatar" href="{{ route('author.profile', $random->user->username) }}"><img src="{{ asset('storage/profile/'.$random->user->image) }}" alt="Profile Image"></a>

							<div class="blog-info">

								<h4 class="title"><a href="{{ route('post.details', $random->slug) }}"><b>{{ $random->title }}</b></a></h4>

                                <ul class="post-footer">
                                    <li>
                                     
                @guest
                    <a href="#" onclick="fav()"><i class="ion-heart"></i>{{ $random->favorite_to_user->count() }}</a>
                
                @else
                    <a href="javascript::void(0)"  
                    onclick="document.getElementById('favorite-form-{{ $random->id }}').submit();"
                    class="{{ !Auth::user()->favorite_posts->where('pivot.post_id',$random->id)->count() == 0 ? 'favorite_post' : '' }}"> 
                         <i class="ion-heart"></i>
                         {{ $random->favorite_to_user->count() }}</a>
                        
                        <form id="favorite-form-{{ $random->id }}" method="POST" action="{{ route('post.favorite',$random->id)}}" style="display: none;">
                            @csrf
                        </form>
                @endguest
                                        
                                    </li>
                                    <li><a href="#" onclick="comment()"><i class="ion-chatbubble"></i>{{ $random->comments->count() }}</a></li>
                                <li><a href="#"><i class="ion-eye"></i>{{ $random->view_count }}</a></li>
                                </ul>

							</div><!-- blog-info -->
						</div><!-- single-post -->
					</div><!-- card -->
				</div><!-- col-md-6 col-sm-12 -->

				
                @endforeach
				

			</div><!-- row -->

		</div><!-- container -->
	</section>

	<section class="comment-section">
		<div class="container">
			@if (session()->has('success'))
				<div class="alert alert-success m-3" role="alert">
					{{ session()->get('success') }}
				</div>
			@endif
			<h4><b>POST COMMENT</b></h4>
			<div class="row">

				<div class="col-lg-8 col-md-12">
					<div class="comment-form">
						


						@guest
					<p> To post a comment. You need to Login first <a href="{{ route('login') }}" class="btn btn-info">Login</a> </p>
						@else

					<form method="post" action="{{ route('comment.store',$post->id) }}">
							
							@csrf
							<div class="row">

								

								<div class="col-sm-12">
									<textarea name="comment" rows="2" class="text-area-messge form-control"
										placeholder="Enter your comment" aria-required="true" aria-invalid="false"></textarea >
								</div><!-- col-sm-12 -->
								<div class="col-sm-12">
									<button class="submit-btn" type="submit" id="form-submit"><b>POST COMMENT</b></button>
								</div><!-- col-sm-12 -->

							</div><!-- row -->
						</form>

						@endguest



					</div><!-- comment-form -->

				<h4><b>COMMENTS({{ $post->comments->count() }})</b></h4>

				@if ($post->comments->count() > 0)
				
				@foreach ($post->comments as $comment)
					<div class="commnets-area ">

						<div class="comment">

							<div class="post-info">

								<div class="left-area">
									<a class="avatar" href="#"><img src="{{ asset('storage/profile/'.$comment->user->image) }}" alt="Profile Image"></a>
								</div>

								<div class="middle-area">
								<a class="name" href="#"><b>{{ $comment->user->name }}</b></a>
									<h6 class="date"> on {{ $comment->created_at->diffforhumans() }}</h6>
								</div>

								<div class="right-area">
									<h5 class="reply-btn" ><a href="#"><b>REPLY</b></a></h5>
								</div>

							</div><!-- post-info -->

							<p>{{ $comment->comment }}</p>

						</div>

					</div><!-- commnets-area -->

				@endforeach

				{{-- <a class="more-comment-btn" href="#"><b>VIEW MORE COMMENTS</a> --}}
				@else 
					<div class="commnets-area ">
					<p>No Comment Yet.</p>
					</div>
				@endif

				</div><!-- col-lg-8 col-md-12 -->

			</div><!-- row -->

		</div><!-- container -->
	</section>

	

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