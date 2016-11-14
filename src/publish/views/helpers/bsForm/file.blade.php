		@php
		if (count($files) == 0) 
		{
			$files = old('files');
		}
		@endphp
	<div class="files-wrapper">
	<a class="btn btn-primary files-btn" type="once" input="{{ $input ? $input : 'image' }}"  href='javascript:;'>{{ $label ? $label : trans('lang.upload_file') }}</a>
	<input type="hidden" name="file_type" value="{{ $input ? $input : 'image' }}">
<br>
<br>
<div class="well {{ count($files) == 0 ? 'hidden' : '' }}">
	<div class="row">
		@if (count($files) > 0)
			@foreach ($files as $id)
				@php
				$path = \App\File::find($id) ? \App\File::find($id)->path : IMG.'no-image.png';
				@endphp
				<div class="col-xs-12 col-sm-6 col-md-3 col-lg-2 image-preview-item" file-id="{{ $id }}">
		{!! Form::checkbox('uploadedfiles[]',$id,$id,['class'=>'hidden']) !!}
					<p class="thumbnail text-center">
						<img src="{{ url($path) }}" alt="">
						<a href="javascript:;" class="uncheck_file"><i class="fa fa-trash"></i> {{ trans('lang.delete') }}</a>
					</p>
				</div>
			@endforeach
		@endif
	</div>
</div>
	</div>
