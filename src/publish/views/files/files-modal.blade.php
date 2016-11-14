 <div class="modal fade" id="modal-files" type="{{ $type }}">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">{{ trans('lang.files') }}</h4>
			</div>
			<div class="modal-body">
			<div role="tabpanel">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active">
						<a href="#allfiles" aria-controls="allfiles" role="tab" data-toggle="tab">{{ trans('lang.images') }}</a>
					</li>
					<li role="presentation">
						<a href="#upload-new" aria-controls="upload-new" role="tab" data-toggle="tab">{{ trans('lang.upload') }}</a>
					</li>
				</ul>
			
				<!-- Tab panes -->
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active text-center" id="allfiles">
						<div class="row all-files">
							@foreach (\App\File::orderBy('id','desc')->paginate(8,['*'],'f') as $file)
								<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 file-item" file-id="{{ $file->id }}">

									<label class="thumbnail" style="height: 185px; overflow: hidden;">
									<small>( {{ $file->width }} × {{ $file->height }} )</small>
										<img src="{{ url($file->path) }}" style="max-height: 80%;width: 100%;" alt="{{ $file->name }}">
										<input type="radio" class="hidden" name="files" value="{{ $file->id }}">
										{{ $file->name }}
									</label>
								</div>
							@endforeach	
						</div>
						{!! \App\File::orderBy('id','desc')->paginate(8,['*'],'f')->links() !!}
					</div>
					<div role="tabpanel" class="tab-pane" id="upload-new">
<form action="{{ root('files/upload') }}" class="dropzone dropzone-file-area" id="my-dropzone" style="">
    {!! csrf_field() !!}
    <input name="type" type="hidden" value="{{ $type }}" />
    <div class="fallback">
    <input name="file" type="file" />
  </div>
    <p class="text-center">
        {{ trans('lang.drop_files_here') }}
    </p>
</form>

					</div>
				</div>
			</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">{{ trans('lang.continue') }}</button>
			</div>
		</div>
	</div>
</div>
