@if(count($tabs))
    <div class="tabs">
        <ul>
            @foreach($tabs['items'] as $tab)
                @if (bouncer()->hasPermission($tab['key']))
                    <li class="{{ $menu->getActive($tab) }}">
                        <a href="{{ $tab['url'] }}">
                            {{ $tab['name'] }}
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
@endif