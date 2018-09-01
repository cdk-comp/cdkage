@if (get_value('event_start') && get_value('event_end'))
  <section class="event">
    <div class="container">
      <div class="event-row">
        <div>{{get_value('event_start')}}</div>
        <div>{{get_value('event_end')}}</div>
      </div>
    </div>
  </section>
@endif
