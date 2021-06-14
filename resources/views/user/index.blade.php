@extends('layouts.app')
@section('title', __('user.List User') )
@section('content')
    @php
        $gridData = [
            'dataProvider' => $dataProvider,
            'title' => 'List user ',
            'useFilters' => true,

            'rowsPerPage' => 10,
            'columnFields' => [
                'name',
                'email',
            ]
        ];
    @endphp
    @gridView($gridData)


@endsection

