@if (get_field('acf_event_start') && get_field('acf_event_end'))
  <section class="acf_event">
    <div class="container">
      <div class="acf_event-row">
        <div>{{get_field('acf_event_start')}}</div>
        <div>{{get_field('acf_event_end')}}</div>
      </div>
    </div>
  </section>
@endif
