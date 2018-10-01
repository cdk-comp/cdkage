@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.page-header')
    @include('partials.content-page')
    {{--include all modules partial view--}}
    @foreach (App\ModuleLoader::getInstance()->getModules() as $file)
      @include($file)
    @endforeach
  @endwhile
@endsection
