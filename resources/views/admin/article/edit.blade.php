{{-- Qui renvoit au formulaire ce dont il a besoin pour modifier un article --}}
@extends('base', [
    'breadcrumbs' => [['name' => 'Acceuil', 'url' => null], ['name' => 'Article', 'url' => null], ['name' => 'Editer un article', 'url' => null]],
    'page_title' => 'Editer un article',
    'head_title' => 'Editer un article',
])

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @include('admin.article._form', [
                        'edit' => 'edit',
                        'action' => route('admin.articles.update', [$article]),
                    ])
                </div>
            </div>
        </div>
    </div>
@endsection

@section('other-js')
    <script src="{{ asset('assets/js/plugins/ckeditor/classic/ckeditor.js') }}"></script>
    <script>
        (function() {
            ClassicEditor.create(document.querySelector('#classic-editor')).catch((error) => {});
        })();
    </script>
@endsection
