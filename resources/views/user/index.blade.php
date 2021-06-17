@extends('layouts.app')
@section('title', __('user.List User') )
@section('content')
    <link rel="stylesheet" href="{{ asset('css/user/main.css') }}">
    {!! grid_view([
            'dataProvider' => $dataProvider,
            'title' => 'List user ',
            'useFilters' => true,
            'strictFilters' => true,

            'rowsPerPage' => 10,
            'columnFields' => [
                'name',
                [
                    'attribute' => 'email',
                    'value' => function ($data) {

                        return $data->email;
                    }
                ],
                [
                    'label' => __('common.Create'),
                    'filter' => false,
                    'value' => function ($data) {
                        if(auth()->id() !== $data->id) {
                            return '<button type="button" name="delete" data-id="' . $data->id . '" class="delete btn btn-danger btn-sm">'.__('common.Delete').'</button>'.
                               '<a href="' . route('user.getEdit', $data->id) . '" class="btn btn-primary btn-sm ml-2 mr-2">'.__('common.Edit').'</a>';
                        }
                    },
                    'format' => 'html',
                    'htmlAttributes' => [
                        'width' => '20%', // Width of table column.
                    ],

                ],

            ]
    ]) !!}

    <script src="{{ asset('js/user/index.js') }}"></script>
@endsection

