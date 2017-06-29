{{ csrf_field() }}
<div class="form-group">
    <label for="description">Note description:</label>
    <textarea name="description" id="summernote" cols="30" rows="10" class="form-control">{{isset($item) ? $item->description : ''}}</textarea>
</div>

<div class="form-group">
    <label class="btn btn-primary" for="my-file-selector">
        <input id="my-file-selector" type="file" style="display:none;" name="pictures[]" multiple>
        Upload: <span class="label label-danger">JPEG</span>
        <span class="label label-danger">BMP</span>
        <span class="label label-danger">PNG</span>
    </label>
</div>

@if (isset($item) && !empty($item->pictures))
    @foreach($item->pictures as $picture)
        <div class="picture-wrapper">
            <img src="{{ asset('uploads/' . $picture->name) }}" alt="{{ $picture->name }}">
        </div>
    @endforeach
@endif

<div class="form-group">
    <button class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="{{$button_name}}">
        <span class="glyphicon glyphicon-floppy-disk"></span>
    </button>
</div>