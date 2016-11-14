
{!! Form::checkbox('uploadedfiles[]',$id,$id,['class'=>'hidden']) !!}
@php
$path = \App\File::find($id) ? \App\File::find($id)->path : IMG.'no-image.png';
@endphp
<div class="col-xs-12 col-sm-6 col-md-3 col-lg-2 image-preview-item" file-id="{{ $id }}">
	<p class="thumbnail text-center">
		<img src="{{ url($path) }}" alt="">
		<a href="javascript:;" class="uncheck_file"><i class="fa fa-trash"></i> {{ trans('lang.delete') }}</a>
	</p>
</div>
