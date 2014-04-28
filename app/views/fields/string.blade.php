
<label>{{ $label }}</label>
{{ Form::text($field) }}
@if(isset($help))
<p>{{{ $help }}}</p>
@endif