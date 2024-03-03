{{--<form method="post" id="formLocale" action="{{route('set-locale')}}">--}}
{{--    {{csrf_field()}}--}}
{{--    <select id="comboLocale" class="form-control" name="combo-locale" id="">--}}
{{--        <option {{session('locale') && session('locale') == 'en' ? 'selected' : null }} value="en">EN</option>--}}
{{--        <option {{session('locale') && session('locale') == 'es' ? 'selected' : null }} value="es">ES</option>--}}
{{--        <option {{session('locale') && session('locale') == 'ca' ? 'selected' : null }} value="ca">CA</option>--}}
{{--    </select>--}}
{{--</form>--}}

<li class="nav-item dropdown no-arrow">
    <form method="post" id="formLocale" action="{{route('set-locale')}}">
        {{csrf_field()}}
        <input type="hidden" id="localeInput" name="locale" value="">
        <a class="nav-link dropdown-toggle" href="#" id="comboLocale" role="button"
           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span>{{session('locale')}}</span>
        </a>

        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
             aria-labelledby="comboLocale">
            <a class="dropdown-item locale-item" data-value="ca" href="#">ca</a>
            <a class="dropdown-item locale-item" data-value="en" href="#">en</a>
            <a class="dropdown-item locale-item" data-value="es" href="#">es</a>
        </div>
    </form>
</li>
