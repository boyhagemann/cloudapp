<h1>Edit node</h1>

{{ Form::open(array('route' => 'node.update', 'method' => 'PUT')) }}

@foreach($config['fields'] as $field => $data)
	@include('fields.' . $data['type'], $data)
@endforeach

{{ Form::submit() }}
{{ Form::close() }}