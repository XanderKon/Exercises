@extends('layouts.master')
@section('content')

<h2>Filters & Sorting</h2>
<table>
<form action="">
    <tr>
        <td>Filter by categories</td>
        <td>
            {{ Form::select('categories', $data['categories'], $data['request']['categories'], ['placeholder' => 'Pick a category...'])}}
        </td>
    </tr>
    <tr>
        <td>Sort by</td>
        <td>
            {{ Form::select('sort', $data['sort'], $data['request']['sort'], ['placeholder' => 'Pick a sort type...'])}}
        </td>
    </tr>
    <tr>
        <td></td>
        <td><input type="submit" title="Apply"></td>
    </tr>
    <input type="hidden" name="start" value="{{$data['request']['start']}}">
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
            <td>{{$offers['site']}}</td>
            <td>{{$offers['rating']}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="paginator">
{!! $data['paginator'] !!}
</div>
@stop



