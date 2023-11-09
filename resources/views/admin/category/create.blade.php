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

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title-desc">Category Create</h4>
                            <div class="language-section mb-3">
                                <button onclick="switchLanguage('az')" class="btn btn-danger">Azerbaijan</button>
                                <button onclick="switchLanguage('ru')" class="btn btn-info">Russian</button>
                                <button onclick="switchLanguage('en')" class="btn btn-info">English</button>
                            </div>
                            <form action="{{ route('admin.category.store') }}" method="post">
                                @csrf
                                <div class="mb-3 row">
                                    <div class="col-md-10">
                                        <label class="form-label">Parent Category</label>
                                        <select class="form-control select2" name="name">
                                            <option value="">Select</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">
                                                    {{ json_decode($category, true)['name']['az'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="language-container" lang="az" style="display: flex;">


                                        <div class="col-md-10">
                                            <label for="input-ru" class="form-label">Name az</label>
                                            <input class="form-control" type="text" name="name[az]" value=""
                                                id="input-az">

                                        </div>
                                    </div>

                                    <div class="language-container" lang="ru" style="display: none;">
                                        <div class="col-md-10">
                                            <label for="input-ru" class="form-label">Name ru</label>

                                            <input class="form-control" type="text" name="name[ru]" value=""
                                                id="input-ru">
                                        </div>
                                    </div>

                                    <div class="language-container" lang="en" style="display: none;">
                                        <div class="col-md-10">
                                            <label for="input-ru" class="form-label">Name en</label>

                                            <input class="form-control" type="text" name="name[en]" value=""
                                                id="input-ru">
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
