@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.page-header')
    @include('partials.content-page')
    {{--include all modules partial view--}}
    @foreach (glob(get_theme_file_path() . '/resources/modules/**/*.blade.php') as $file)
      @include(basename(str_replace('partial.blade.php', '', $file)) . '.partial')
    @endforeach
  @endwhile
@endsection
