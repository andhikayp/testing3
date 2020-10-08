@extends('template.base.app')
@section('title', ' Dashboard')

@section('sidebar')
    @include('template.base.sidebar')
@endsection

@section('header')
    @include('template.base.header')
@endsection

@section('content')
    <div class="demo-container">
        <div id="chart"></div>
    </div>
@endsection
@section('moreJS')
<script src="{{ asset('js/devextreme/dx.all.js') }}"></script>
<script>
    var dataSource = [{
        day: "Monday",
        oranges: 3
    }, {
        day: "Tuesday",
        oranges: 2
    }, {
        day: "Wednesday",
        oranges: 3
    }, {
        day: "Thursday",
        oranges: 4
    }, {
        day: "Friday",
        oranges: 6
    }, {
        day: "Saturday",
        oranges: 11
    }, {
        day: "Sunday",
        oranges: 4
    }];
    $(function(){
        $("#chart").dxChart({
            dataSource: dataSource, 
            series: {
                argumentField: "day",
                valueField: "oranges",
                name: "My oranges",
                type: "bar",
                color: '#ffaa66'
            }
        });
    });
</script>
@endsection
