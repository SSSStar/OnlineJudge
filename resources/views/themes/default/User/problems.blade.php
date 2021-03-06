@extends('layouts.app')

@section('title')
    问题列表
@endsection

@section('style')
    <link href="{{ asset('themes/default/css/collection.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('themes/default/css/problems.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <div class="container main">
        <div class="row">
            <div class="col-md-9 col-lg-9">
                <div class="row">
                    <div class="right">
                        <form class="form-inline" method="get">
                            <div class="form-group-sm">
                                <input name="keyword" class="form-control" value="" placeholder="请输入关键词">
                                <input type="submit" value="搜索" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
                <div>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>题目</th>
                            <th>难度</th>
                            <th>通过率</th>
                            <th>是否通过</th>
                        </tr>
                        </thead>
                        <tbody>
                        @for($i = 0; $i < count($problemList); $i++)
                            <tr>
                                <th>
                                    <span class="">{{$i+1}}</span>
                                </th>
                                <th scope="row"><a
                                            href="{{ URL::action('User\ProblemsController@problemDetail',array('id'=>$problemList[$i]->id)) }}">{{ $problemList[$i]->title }}</a>
                                </th>
                                <td>{{ $problemList[$i]->difficulty }}</td>
                                <td>
                                    @if($problemList[$i]->total_submit_number == 0 || $problemList[$i]->total_accepted_number == 0)
                                        0 %
                                    @else
                                        {{ floor($problemList[$i]->total_accepted_number/$problemList[$i]->total_submit_number*100) }}
                                        %
                                        ({{$problemList[$i]->total_accepted_number}}
                                        /{{$problemList[$i]->total_submit_number}})
                                    @endif
                                </td>
                                @if($problemList[$i]->accepted == 1)
                                    <td class="alert-success"><span class="glyphicon glyphicon-ok"></span></td>
                                @else
                                    <td><span class="glyphicon glyphicon-minus"></span></td>
                                @endif
                            </tr>
                        @endfor
                        </tbody>
                    </table>
                </div>
                {!! $problemList->links() !!}
            </div>

            <div class="col-md-3 col-lg-3">
                @include('themes.default.User.announcements')
                {{--@include('themes.default.User.classification')--}}
            </div>
        </div>
    </div>
@endsection
