@extends('layouts.master')
@section('content')

<h2>Filters & Sorting</h2>
<table>
<form action="">
    <tr>
        <td>Filter by categories</td>
        <td>
            {{ Form::select('categories', $data['categories'], @$data['request']['categories'], ['placeholder' => 'Pick a category...'])}}
        </td>
    </tr>
    <tr>
        <td>Sort by</td>
        <td>
            {{ Form::select('sort', $data['sort'], @$data['request']['sort'], ['placeholder' => 'Pick a sort...'])}}
            {{ Form::select('sort_type', array('asc' => 'asc', 'desc' => 'desc'), @$data['request']['sort_type'] ?: 'asc')}}
        </td>
    </tr>
    <tr>
        <td></td>
        <td><input type="submit" value="Apply"></td>
    </tr>
    <input type="hidden" name="start" value="{{@$data['request']['start']}}">
</form>
</table>


<h2>Offers' table</h2>
<table class="styled">
    <thead>
    <tr>
        <th>Offer</th>
        <th>Site</th>
        <th>Rating</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($data['offers'] as $offers)
        <tr>
            <td>{{$offers['name']}}</td>
            <td>{{ Html::link($offers['site'], NULL, array('target' => '_blank')) }}</td>
            <td>{{$offers['rating']}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="paginator">
{!! $data['paginator'] !!}
</div>
@stop



