<div id="dismiss">
    <i class="fas fa-arrow-left"></i>
</div>

<div class="sidebar-header">
    <h3>Reservation Manager</h3>
</div>

<ul class="list-unstyled components">
    <p class="font-weight-bold">
        <a href="{{route('admin.dashboard')}}">Dashboard</a>
    </p>


    @foreach($level0 ?? array() as $e)
        @if($e->can)
            <li>
                @if(is_null($e->route))
                    {{--                    se è una voce di menu con sottomenu--}}
                    <a href="{{'#'.$e->name }}" data-toggle="collapse"
                       aria-expanded="false">
                        @lang('Reservations::menu.' . $e->name)
                    </a>
                @else
                    {{--                    se è una voce di menu con link diretto--}}
                    <a href="{{route($e->route)}}">
                        @lang('Reservations::menu.' . $e->name)
                    </a>
                @endif

                @if($e->children->isNotEmpty())
                    <ul class="collapse list-unstyled" id="{{$e->name}}">
                        @foreach($e->children->sortBy(function ($child) {return $child->position;}) as $p)
                            <li>
                                <a href="{{route($p->route)}}">@lang('Reservations::menu.'.$p->name)</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endif
    @endforeach
</ul>

<ul class="list-unstyled CTAs">
    <li>
        <form method="post" action="{{route('logout')}}">
            @csrf
            <button class="btn btn-outline-danger btn-block btn-sm">Esci</button>
        </form>
    </li>
</ul>
