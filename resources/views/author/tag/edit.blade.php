@extends('layouts.backend.app')

@section('title', 'Tag Edit')

@push('css')

@endpush


@section('content')

    <div class="container-fluid">
    
        <!-- Vertical Layout | With Floating Label -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Edit TAG
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
                        <form action="{{ route('author.tag.update',$tag->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group form-float">
                                <div class="form-line">
                                <input type="text" id="name" class="form-control" name="name" value="{{ old('name', $tag->name) }}">
                                    <label class="form-label">Tag</label>
                                </div>
                            </div>


                            <a class="btn btn-danger waves-effect m-t-15" href="{{ route('author.tag.index') }}">Back</a>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Vertical Layout | With Floating Label -->

    </div>

@endsection

@push('js')

@endpush