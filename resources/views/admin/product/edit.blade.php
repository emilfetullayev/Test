@extends('admin.layouts.app')

@section('admin.css')
@endsection
@section('admin.content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Form Elements</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                                <li class="breadcrumb-item active">Form Elements</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            @if (Session::get('errors'))
                <div class="col-12 mt-1">
                    <div class="alert alert-danger" role="alert">
                        <div class="alert-body">{{ Session::get('errors') }}</div>
                    </div>
                </div>
            @endif
            @if (Session::get('success'))
                <div class="col-12 mt-1">
                    <div class="alert alert-success" role="alert">
                        <div class="alert-body">{{ Session::get('success') }}</div>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title-desc">Product Edit</h4>
                            <div class="language-section mb-3">
                                <button onclick="switchLanguage('az')" class="btn btn-danger">Azerbaijan</button>
                                <button onclick="switchLanguage('ru')" class="btn btn-info">Russian</button>
                                <button onclick="switchLanguage('en')" class="btn btn-info">English</button>
                            </div>
                            <form action="{{ route('admin.product.update', $product->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3 row">
                                    <div class="col-md-10">
                                        <label class="form-label">Categories</label>
                                        <select class="form-control select2" name="category_id">
                                            <option value="">Select</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    @if ($product->categories->contains($category->id)) selected @endif>
                                                    {{ json_decode($category, true)['name']['az'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="language-container" lang="az">
                                    <div class="col-md-10">
                                        <label for="input-ru" class="form-label">Title az</label>
                                        <input class="form-control" type="text" name="title[az]"
                                            value="{{ json_decode($product, true)['title']['az'] }}" id="input-az" />
                                    </div>

                                    <div class="mt-3 row">
                                        <div class="col-md-10">
                                            <label for="input-az" class="form-label">Description az</label>
                                            <textarea class="form-control" type="text" name="description[az]" id="input-az">{{ json_decode($product, true)['description']['az'] }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="language-container" lang="ru" style="display: none;">
                                    <div class="col-md-10">
                                        <label for="input-ru" class="form-label">Title ru</label>
                                        <input class="form-control" type="text" name="title[ru]"
                                            value="{{ json_decode($product, true)['title']['ru'] }}" id="input-ru">
                                    </div>

                                    <div class="col-md-10">
                                        <label for="input-ru" class="form-label">Description ru</label>
                                        <textarea class="form-control" type="text" name="description[ru]" id="input-ru">{{ json_decode($product, true)['description']['ru'] }}</textarea>
                                    </div>
                                </div>

                                <div class="language-container" lang="en" style="display: none;">
                                    <div class="mb-3 row">
                                        <div class="col-md-10">
                                            <label for="input-en" class="form-label">Title en</label>
                                            <input class="form-control" type="text" name="title[en]"
                                                value="{{ json_decode($product, true)['title']['en'] ?? null }}"
                                                id="input-en">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <div class="col-md-10">
                                            <label for="input-en" class="form-label">Description en</label>
                                            <textarea class="form-control" type="text" name="description[en]" id="input-em">{{ json_decode($product, true)['description']['en'] ?? null }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 row  mt-4">
                                    <div class="col-md-10">
                                        <input class="form-control" type="file" name="images" id="input-ru">
                                    </div>
                                </div>

                                <div class="mb-3 row  mt-4">
                                    <div class="col-md-" dir="ltr">
                                        <button class="btn btn-success" type="submit">Submit</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
@endsection

@section('admin.js')
    <script>
        var selectedLanguage = 'az';

        function switchLanguage(lang) {
            selectedLanguage = lang;
            updateElementVisibility();
        }

        function updateElementVisibility() {
            $('.language-container').each(function() {
                if ($(this).attr("lang") === selectedLanguage) {
                    $(this).css("display", "block");
                } else {
                    $(this).css("display", "none");
                }
            });
        }

        function getInputAndLabelValue() {
            var inputId = "input-" + selectedLanguage;
            var inputValue = $("#" + inputId).val();

            var labelFor = $("label[for='" + inputId + "']");
            var labelValue = labelFor.text();

            alert("Input Value: " + inputValue + "\nLabel Value: " + labelValue);
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                var errorDiv = document.getElementById('error-message');
                if (errorDiv) {
                    errorDiv.style.display = 'none';
                }
            }, 2000);
        });
    </script>
@endsection
