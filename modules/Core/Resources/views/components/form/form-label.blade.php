@if($label)
    <label {!! $attributes !!}>{{ $label }} @if($required)<span class="text-danger">*</span>@endif</label>
@endif
