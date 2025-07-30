@php
$assets = asset('new_assets');
@endphp@section('sidebarActive', $controller)
@extends('layouts.template.app')
@section('vendor_css')
<link rel="stylesheet" href="{{ $assets }}/izitoast/css/iziToast.min.css">
@endsection
@section('css_scripts')

<style type="text/css">
.btn {
    display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: normal;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
}
/*Also */
.btn-success {
    border: 1px solid #c5dbec;
    background: #D0E5F5;
    font-weight: bold;
    color: #2e6e9e;
}
/* This is copied from https://github.com/blueimp/jQuery-File-Upload/blob/master/css/jquery.fileupload.css */
.fileinput-button {
    position: relative;
    overflow: hidden;
}

    .fileinput-button input {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        opacity: 0;
        -ms-filter: 'alpha(opacity=0)';
        font-size: 200px;
        direction: ltr;
        cursor: pointer;
    }

.thumb {
    height: 80px;
    width: 100px;
    border: 1px solid #000;
}

ul.thumb-Images li {
    width: 120px;
    float: left;
    display: inline-block;
    vertical-align: top;
    height: 120px;
}

.img-wrap {
    position: relative;
    display: inline-block;
    font-size: 0;
}

    .img-wrap .close {
        position: absolute;
        top: 2px;
        right: 2px;
        z-index: 100;
        background-color: #D0E5F5;
        padding: 5px 2px 2px;
        color: #000;
        font-weight: bolder;
        cursor: pointer;
        opacity: .5;
        font-size: 23px;
        line-height: 10px;
        border-radius: 50%;
    }

    .img-wrap:hover .close {
        opacity: 1;
        background-color: #ff0000;
    }

.FileNameCaptionStyle {
    font-size: 12px;
}
</style>

@endsection
@section('vendor_js')


<script src="{{ $assets }}/js/jquery-ui/jquery-ui.min.js"></script>
<!-- quill js -->
<script src="{{ $assets }}/plugins/quill/quill.min.js"></script>
<script src="https://cdn.rawgit.com/kensnyder/quill-image-resize-module/3411c9a7/image-resize.min.js"></script>

@endsection
@section('js_scripts')
<script>

{{-- text editor --}}
var icons = Quill.import('ui/icons');
    icons['bold'] = '<i class="fa fa-bold" aria-hidden="true"><\/i>';
    icons['italic'] = '<i class="fa fa-italic" aria-hidden="true"><\/i>';
    icons['underline'] = '<i class="fa fa-underline" aria-hidden="true"><\/i>';
    icons['strike'] = '<i class="fa fa-strikethrough" aria-hidden="true"><\/i>';
    icons['list']['ordered'] = '<i class="fa fa-list-ol" aria-hidden="true"><\/i>';
    icons['list']['bullet'] = '<i class="fa fa-list-ul" aria-hidden="true"><\/i>';
    icons['link'] = '<i class="fa fa-link" aria-hidden="true"><\/i>';
    icons['image'] = '<i class="fa fa-image" aria-hidden="true"><\/i>';
    icons['video'] = '<i class="fa fa-film" aria-hidden="true"><\/i>';
    icons['code-block'] = '<i class="fa fa-code" aria-hidden="true"><\/i>';
var quill = new Quill('#description', {
    theme: 'snow',
    modules: {
        imageResize: {
          displaySize: true
        },
        toolbar: [
                [{ header: [1, 2, 3, 4, 5, 6, false] }],
                [{ font: [] }],
                ["bold", "italic"],
                ["link", "blockquote", "code-block", "image","video"],
                [{ list: "ordered" }, { list: "bullet" }],
                [{ script: "sub" }, { script: "super" }],
                [{ color: [] }, { background: [] }],
                [
                    { align: '' }, 
                    { align: 'center' }, 
                    { align: 'right' }, 
                    { align: 'justify' }
                ]
        ]
    },
    placeholder: 'Tulis sesuatu disini...'
});

quill.on('text-change', function(delta, oldDelta, source) {
    document.querySelector("input[name='description']").value = quill.root.innerHTML;
});





// upload multi images
//I added event handler for the file upload control to access the files properties.
document.addEventListener("DOMContentLoaded", init, false);

//To save an array of attachments 
var AttachmentArray = [];
//counter for attachment array
var arrCounter = 0;
//to make sure the error message for number of files will be shown only one time.
var filesCounterAlertStatus = false;
//un ordered list to keep attachments thumbnails
var ul = document.createElement('ul');
ul.className = ("thumb-Images");
ul.id = "imgList";

function init() {
    //add javascript handlers for the file upload event
    document.querySelector('#files').addEventListener('change', handleFileSelect, false);
}

//the handler for file upload event
function handleFileSelect(e) {
    //to make sure the user select file/files
    if (!e.target.files) return;
    //To obtaine a File reference
    var files = e.target.files;
    // Loop through the FileList and then to render image files as thumbnails.
    for (var i = 0, f; f = files[i]; i++) {
        //instantiate a FileReader object to read its contents into memory
        var fileReader = new FileReader();
        // Closure to capture the file information and apply validation.
        fileReader.onload = (function (readerEvt) {
            return function (e) {
                //Apply the validation rules for attachments upload
                ApplyFileValidationRules(readerEvt)
                //Render attachments thumbnails.
                RenderThumbnail(e, readerEvt);
                //Fill the array of attachment
                FillAttachmentArray(e, readerEvt)
            };
        })(f);
        // Read in the image file as a data URL.
        // readAsDataURL: The result property will contain the file/blob's data encoded as a data URL.
        // More info about Data URI scheme https://en.wikipedia.org/wiki/Data_URI_scheme
        fileReader.readAsDataURL(f);
    }
    document.getElementById('files').addEventListener('change', handleFileSelect, false);
}

//To remove attachment once user click on x button
jQuery(function ($) {
    $('div').on('click', '.img-wrap .close', function () {
        var id = $(this).closest('.img-wrap').find('img').data('id');

        //to remove the deleted item from array
        var elementPos = AttachmentArray.map(function (x) { return x.FileName; }).indexOf(id);
        if (elementPos !== -1) {
            AttachmentArray.splice(elementPos, 1);
        }

        //to remove image tag
        $(this).parent().find('img').not().remove();

        //to remove div tag that contain the image
        $(this).parent().find('div').not().remove();

        //to remove div tag that contain caption name
        $(this).parent().parent().find('div').not().remove();

        //to remove li tag
        var lis = document.querySelectorAll('#imgList li');
        for (var i = 0; li = lis[i]; i++) {
            if (li.innerHTML == "") {
                li.parentNode.removeChild(li);
            }
        }

    });
}
)

//Apply the validation rules for attachments upload
function ApplyFileValidationRules(readerEvt)
{
    //To check file type according to upload conditions
    if (CheckFileType(readerEvt.type) == false) {
        alert("The file (" + readerEvt.name + ") does not match the upload conditions, You can only upload jpg/png/gif files");
        e.preventDefault();
        return;
    }

    //To check file Size according to upload conditions
    if (CheckFileSize(readerEvt.size) == false) {
        alert("The file (" + readerEvt.name + ") does not match the upload conditions, The maximum file size for uploads should not exceed 30 MB");
        e.preventDefault();
        return;
    }

    //To check files count according to upload conditions
    if (CheckFilesCount(AttachmentArray) == false) {
        if (!filesCounterAlertStatus) {
            filesCounterAlertStatus = true;
            alert("You have added more than 10 files. According to upload conditions you can upload 10 files maximum");
        }
        e.preventDefault();
        return;
    }
}

//To check file type according to upload conditions
function CheckFileType(fileType) {
    if (fileType == "image/jpeg") {
        return true;
    }
    else if (fileType == "image/png") {
        return true;
    }
    else if (fileType == "image/gif") {
        return true;
    }
    else {
        return false;
    }
    return true;
}

//To check file Size according to upload conditions
function CheckFileSize(fileSize) {
    if (fileSize < 30000000) {
        return true;
    }
    else {
        return false;
    }
    return true;
}

//To check files count according to upload conditions
function CheckFilesCount(AttachmentArray) {
    //Since AttachmentArray.length return the next available index in the array, 
    //I have used the loop to get the real length
    var len = 0;
    for (var i = 0; i < AttachmentArray.length; i++) {
        if (AttachmentArray[i] !== undefined) {
            len++;
        }
    }
    //To check the length does not exceed 10 files maximum
    if (len > 9) {
        return false;
    }
    else
    {
        return true;
    }
}

//Render attachments thumbnails.
function RenderThumbnail(e, readerEvt)
{
    var li = document.createElement('li');
    ul.appendChild(li);
    li.innerHTML = ['<div class="img-wrap"> <span class="close">&times;</span>' +
        '<img class="thumb" src="', e.target.result, '" title="', escape(readerEvt.name), '" data-id="',
        readerEvt.name, '"/>' + '</div>'].join('');

    var div = document.createElement('div');
    div.className = "FileNameCaptionStyle";
    li.appendChild(div);
    div.innerHTML = [readerEvt.name].join('');
    document.getElementById('Filelist').insertBefore(ul, null);
}

//Fill the array of attachment
function FillAttachmentArray(e, readerEvt)
{
    AttachmentArray[arrCounter] =
    {
        AttachmentType: 1,
        ObjectType: 1,
        FileName: readerEvt.name,
        FileDescription: "Attachment",
        NoteText: "",
        MimeType: readerEvt.type,
        Content: e.target.result.split("base64,")[1],
        FileSizeInBytes: readerEvt.size,
    };
    arrCounter = arrCounter + 1;
}
</script>
@endsection
@section('content')
<div class="page-header">
    <div class="page-leftheader">
        <h4 class="page-title">{{ $title }}</h4>
    </div>
    <div class="page-rightheader ml-auto d-lg-flex d-none">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}" class="d-flex">
                    <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z" />
                        <path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3" /></svg>
                    <span class="breadcrumb-icon"> Home</span></a>
            </li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('dashboard/gallery') }}">{{ $title }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create {{ $title }}</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Create {{ $title }}</div>
            </div>
            <div class="card-body">
                

                <div class="panel panel-primary">
                    <div class="panel-body tabs-menu-body">
                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Sorry!</strong> There were more problems with your HTML input.<br><br>
                            <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                            </ul>
                        </div>
                        @endif
                        <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="tab-content">
                                    <div class="form-group">
                                        <label for="title"  class="control-label col-lg-2">Title <span class="required">*</span></label>
                                        <div class="col-lg-12">
                                            <input type="text" class="form-control" required="" name="title" placeholder="Masukan Judul Disini">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="title"  class="control-label col-lg-2">Kategori<span class="required">*</span></label>
                                        <div class="col-lg-12">
                                            <select name="category" class="form-control" required>
                                                <option value="gallery">Gallery - Kegiatan</option>
                                                <option value="portfolio">Portfolio</option>
                                                <option value="layanan">Layanan</option>
                                                <option value="karir">Karir</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="description"  class="control-label col-lg-2">{{ __('main.description') }} <span class="required">*</span></label>
                                        <input type="hidden" name="description" value="{{ old('description') }}">
                                        <div class="col-lg-12">
                                            <div style="height: 100%;" id="description" >{{ old('description') }}</div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="photo"  class="control-label col-lg-2">File Thumbnail Images <span class="required">*</span></label>
                                        <div class="col-lg-12">
                                            <input type="file" class="form-control" name="file_image">
                                            <p><i>Upload Image Rekomendasi Ukuran 1080 x 1080 px</i></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label for="fasilitas_gallery"  class="control-label col-lg-2"><span>Gallery Images</span></label>
                                        <br>
                                        <label for="fasilitas_gallery"  class="control-label col-lg-12">
                                            <span><i>Mohon Blok File Images Untuk Upload Lebih Dari 1 Images</i></span>
                                        </label>
                                        <div class="col-lg-12">
                                            <span class="btn btn-success fileinput-button">
                                                <span>Upload Images</span>
                                                <input type="file" name="fasilitas_gallery[]" id="files" multiple accept="image/jpeg, image/png, image/gif,">
                                                <br />
                                                <p><i>Upload Image Rekomendasi Ukuran 1080 x 1080 px</i></p>
                                            </span>
                                            <output id="Filelist"></output>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                      <input type="submit" class="btn btn-info" value="Add Gallery">
                                      <a href="{{ route('gallery.index') }}" class="btn btn-secondary">Back</a>
                                    </div>
                               
                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>
        <!--/div-->
    </div>
</div>
{{-- Form --}}
@endsection
