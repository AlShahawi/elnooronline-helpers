<div class="row all-files">
	@foreach ($files as $file)
		<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 file-item" file-id="{{ $file->id }}">
			<label class="thumbnail {{ $type }}" style="height: 185px; overflow: hidden;">
			<small>( {{ $file->width }} × {{ $file->height }} )</small>
				<img src="{{ url($file->path) }}" style="max-height: 80%;width: 100%;" alt="{{ $file->name }}">
				<input type="radio" class="hidden" name="files" value="{{ $file->id }}">
				{{ $file->name }}
			</label>
		</div>
	@endforeach	
</div>
{!! $files->links() !!}

