<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
    @foreach ($option['view']['actions'] as $action)
        <a {!! isset($action['attrs']) ? generateAtribute($action['attrs']): '' !!}
            class="btn btn-secondary"
            href="{{ isset($action['action']) && is_callable($action['action']) ? call_user_func($action['action'], $item ) : 'javascript' }}"
            >
            {!! $action['html'] !!}
        </a>
    @endforeach
  </div>