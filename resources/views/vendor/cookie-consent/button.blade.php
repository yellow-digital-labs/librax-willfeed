<form action="{!! $url !!}" {!! $attributes !!}>
    @csrf
    <button type="submit" class="{!! $basename !!}__link uk-button uk-button-default" style="color: #fff;
    border-color: #000;
    background: #000;">
        <span class="{!! $basename !!}__label">{{ $label }}</span>
    </button>
</form>
