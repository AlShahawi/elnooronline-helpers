@if (str_contains($file->type, 'image'))
<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
	<label class="thumbnail">
		<img src="{{ url($file->path) }}" alt="{{ $file->name }}">
		<input type="checkbox" class="hidden" name="files[]" value="{{ $file->id }}">
		{{ $file->name }}
	</label>
</div>
@endif