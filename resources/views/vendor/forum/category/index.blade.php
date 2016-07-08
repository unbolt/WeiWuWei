{{-- $category is passed as NULL to the master layout view to prevent it from showing in the breadcrumbs --}}
@extends ('forum::master', ['category' => null])

@section ('content')
    @can ('createCategories')
        @include ('forum::category.partials.form-create')
    @endcan

    @foreach ($categories as $category)
            <table class="table table-index">
                    <tr>
                        @include ('forum::category.partials.list', ['titleClass' => 'lead'])
                    </tr>
                    @if (!$category->children->isEmpty())
                    <tr>
                        <th class="hidden-sm hidden-xs">{{ trans_choice('forum::categories.category', 1) }}</th>
                        <th class="col-md-2 hidden-sm hidden-xs">{{ trans_choice('forum::threads.thread', 2) }}</th>
                        <th class="col-md-2 hidden-sm hidden-xs">{{ trans_choice('forum::posts.post', 2) }}</th>
                        <th class="col-md-2 hidden-sm hidden-xs">{{ trans('forum::posts.last') }}</th>
                    </tr>
                        @foreach ($category->children as $subcategory)
                                @include ('forum::category.partials.list', ['category' => $subcategory])
                        @endforeach
                    @endif
            </table>
    @endforeach
@stop
