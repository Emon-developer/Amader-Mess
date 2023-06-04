@extends('mess.layouts.index')
@section('content')
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="card" style="margin-bottom: 25px;">
            <div class="card-header bg-info text-white" style="cursor: pointer;">
                My Image
            </div>
            <div class="card-body" style="padding: 30px">
                <form method="POST" action="{{ url('image') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="file" class="btn btn-block btn-info"><i class="fa fa-image"></i>&nbsp;Choose New Image</label>
                        <input type="file" name="file" id="file" style="visibility: hidden" onchange="PreviewImage();">
                        <img id="file_view" src="" class="img img-fluid" />
                    </div>
                    
                    <div class="form-group row mb-0">
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fa fa-upload"></i>&nbsp;<strong>Upload Image</strong>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
     function PreviewImage() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("file").files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById("file_view").src = oFREvent.target.result;
        };
    };
</script>
@endsection