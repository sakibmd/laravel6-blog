@extends('layouts.backend.app')

@section('title', 'Post Create')

@push('css')
<link href="{{ asset('assets/backend/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
@endpush


@section('content')

{{-- @if ($errors->any())
<div class="alert alert-danger m-3">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif --}}

    <div class="container-fluid">

        <form action="{{ route('admin.post.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
    
        <!-- Vertical Layout | With Floating Label -->
        
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            ADD NEW POST
                        </h2>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger m-3">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="body">
                        
                            <div class="form-group form-float">
                                <div class="form-line">
                                <input type="text" id="title" class="form-control" name="title" value="{{ old('title') }}">
                                    <label class="form-label">Post Title</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="image">Featured Image</label>
                                <input type="file" name="image" value="{{ old('image') }}">
                            </div>

                            <div class="form-group">
                                <input class="filled-in" type="checkbox" name="status" id="publish" value="1">
                                <label for="publish">Publish</label>
                            </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            ADD CATEGORIES AND TAGS
                        </h2>
                       
                    </div> 
                    <div class="body">
                        
                    <div class="form-group form-float {{ $errors->has('categories') ? 'focused error' : '' }}">
                                
                                
    <label class="form-label" for="category">Select Categories</label>
    <select name="categories[]" id="category" class="form-control show-tick" data-live-search="true" multiple>
        @foreach ($categories as $category)
            <option class="text-center" value="{{ $category->id }}" >{{ $category->name }}</option>
        @endforeach
    </select>
                                
                            </div>



                            <div class="form-group form-float {{ $errors->has('tags') ? 'focused error' : '' }}">
                                
                                
    <label class="form-label" for="tag">Select Tags</label>
    <select name="tags[]" id="tag" class="form-control show-tick" data-live-search="true" multiple>
        @foreach ($tags as $tag)
            <option value="{{ $tag->id }}" class="text-center">{{ $tag->name }}</option>
        @endforeach
    </select>
                              
                            </div>

                            


                            <a class="btn btn-danger waves-effect m-t-15" href="{{ route('admin.post.index') }}">Back</a>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Submit</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Second Row Start -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                           POST BODY
                          
                        </h2>
               
                    </div>
                    <div class="body">
                        
                    <textarea id="tinymce" name="body">  </textarea>        
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- Second Row End -->
    
    </form>
    </div>

@endsection

@push('js')
    <!-- Select Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <!-- TinyMCE -->
    <script src="{{ asset('assets/backend/plugins/tinymce/tinymce.js') }}"></script>
   
   <script type="text/javascript">
   $(function () {
   
    //TinyMCE
    tinymce.init({
        selector: "textarea#tinymce",
        theme: "modern",
        height: 300,
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons',
        image_advtab: true
    });
    tinymce.suffix = ".min";
    tinyMCE.baseURL = "{{ asset('assets/backend/plugins/tinymce') }}";
});


 </script>


@endpush