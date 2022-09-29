@extends('layouts.masters.backend')
@section('content')
@section('title', 'Track Application : '.$applications->application_no)
<style type="text/css">
.events li {
    display: flex;
    color: #999;
}

.events time {
    position: relative;
    padding: 0 1.5em;
}

.events time::after {
    content: "";
    position: absolute;
    z-index: 2;
    right: 0;
    top: 0;
    transform: translateX(50%);
    border-radius: 50%;
    background: #fff;
    border: 1px #ccc solid;
    width: .8em;
    height: .8em;
}


.events span {
    padding: 0 1.5em 1.5em 1.5em;
    position: relative;
}

.events span::before {
    content: "";
    position: absolute;
    z-index: 1;
    left: 0;
    height: 100%;
    border-left: 1px #ccc solid;
}

.events strong {
    display: block;
    font-weight: bolder;
}

.events {
    margin: 1em;
    width: 50%;
}

.events,
.events *::before,
.events *::after {
    box-sizing: border-box;
    font-family: arial;
}

</style>
<div class="box box-primary">
    <div class="box-body">
        <div class="row">
            <div class="col-md-3"></div>

            <div class="col-md-9">


                <ul class="events">

                    @foreach ($trackDetail as $key => $trackDetail)
                    <li>
                        <time datetime="">{{ date("d, M Y",strtotime($trackDetail->created_at)) }}</time>
                        <span><strong>{{$trackDetail->action}}</strong>{{$trackDetail->description}}</span>
                    </li>
                    @endforeach
                    <li>
                        <time datetime="">{{ date("d, M Y",strtotime($applications->created_at)) }}</time>
                        <span><strong>Application has been submitted successfully</strong></span>
                    </li>

                </ul>


            </div>
        </div>
        <a href="{{url('/login')}}" class="btn btn-warning">Back</a>
    </div>

</div>


@endsection
