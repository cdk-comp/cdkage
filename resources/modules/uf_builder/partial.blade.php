@if (have_groups('uf_modules'))
  <section class="builder">
    <div class="container">
      <div class="builder-row">
        @while(have_groups('uf_modules')) @php(the_group())
          @include(get_group_type().'.partial')
        @endwhile
      </div>
    </div>
  </section>
@endif
