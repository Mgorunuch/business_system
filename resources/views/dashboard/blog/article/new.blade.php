@extends('layouts.app')

@section('page_info')
    <div class="page_info">
        <div class="container flex-center">
            <div class="text-center">
                <div class="title text-center">
                    Create new article
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container">
        <div class="col-md-10 col-md-offset-1 article" style="background-color: #fff;">
            <form action="{{action('ArticleController@store')}}" method="post" class="modal-body" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="title1">Title:</label>
                    <input maxlength="100" type="text" class="form-control" name="title" id="title1" placeholder="Article Title">
                    @if ($errors->has('title'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="preview">Post main image:</label>
                    <input type="file" name="preview" id="preview" accept="image/*" />
                    <p class="help-block">Some preview.</p>
                    @if ($errors->has('preview'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('preview') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="short1">Short description:</label>
                    <textarea maxlength="255" class="form-control" name="short" id="short1" rows="4"></textarea>
                    @if ($errors->has('short'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('short') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="text1">Main text:</label>
                    <textarea maxlength="20000" class="form-control" name="text" id="text1" rows="10"></textarea>
                    @if ($errors->has('text'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('text') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="category1">Category:</label>
                    <select name="category" id="category1" class="form-control">
                        @foreach(\App\Category::all() as $category)
                            @if ($category->id != 1)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endif
                        @endforeach
                    </select>
                    @if ($errors->has('category'))
                        <span class="help-block text-danger">
                            <strong>{{ $errors->first('category') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('js/tinymce/tinymce.min.js')}}"></script>

    <script>
        window.onload = function() {
            tinymce.init({
                selector: "textarea",
                height: 500,
                plugins: [
                    "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "table contextmenu directionality emoticons template textcolor paste fullpage textcolor colorpicker textpattern"
                ],

                toolbar1: "newdocument fullpage | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
                toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | insertdatetime preview | forecolor backcolor",
                toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft",

                menubar: false,
                toolbar_items_size: 'small',

                style_formats: [{
                    title: 'Bold text',
                    inline: 'b'
                }, {
                    title: 'Red text',
                    inline: 'span',
                    styles: {
                        color: '#ff0000'
                    }
                }, {
                    title: 'Red header',
                    block: 'h1',
                    styles: {
                        color: '#ff0000'
                    }
                }, {
                    title: 'Example 1',
                    inline: 'span',
                    classes: 'example1'
                }, {
                    title: 'Example 2',
                    inline: 'span',
                    classes: 'example2'
                }, {
                    title: 'Table styles'
                }, {
                    title: 'Table row 1',
                    selector: 'tr',
                    classes: 'tablerow1'
                }],

                templates: [{
                    title: 'Test template 1',
                    content: 'Test 1'
                }, {
                    title: 'Test template 2',
                    content: 'Test 2'
                }],
                content_css: [
                    '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
                    '//www.tinymce.com/css/codepen.min.css'
                ]
            });
        }
    </script>
@endsection
