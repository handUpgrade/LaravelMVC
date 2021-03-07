@extends('layouts.profile')

@section('content')
    <div class='page'>
    </div>
@stop
@section('script')

    <script src="/js/intro.js"></script>
    <script>
    $(document).ready(function() {
        get_list({{$lv}});  // get_list() 실행
    });
    </script>

    <style>
        *{ margin:0; padding:0;}
        ul li {list-style:none;}
        .a_ul{float:left; width:13%; height:582px; background:#bbbbbb; color:#4F4F4F; font:bold 15px malgun gothic; position:relative;padding-left:1px;}
        .page > .a_ul:nth-child(2) > li:nth-child(2n) {background:#FFA2A2; color:#B70000;}
        .page > .a_ul:nth-child(3) > li:nth-child(2n) {background:#FFDC7E; color:#DB3A00;}
        .page > .a_ul:nth-child(4) > li:nth-child(2n) {background:#FFFF6C; color:#C98500;}
        .page > .a_ul:nth-child(5) > li:nth-child(2n) {background:#89FF82; color:#00A500;}
        .page > .a_ul:nth-child(6) > li:nth-child(2n) {background:#90E4FF; color:#001EC9;}
        .page > .a_ul:nth-child(7) > li:nth-child(2n) {background:#9190FF; color:#0000ED;}
        .page > .a_ul:nth-child(8) > li:nth-child(2n) {background:#FFB4FF; color:#8324FF;}
        .page > .a_ul > ul {background:#484848; color:white; height:40px; line-height:40px;}
        .page > .a_ul > li {display:table; position:absolute; left:0; background:#DFDFDF;}
        .page > .a_ul > li > div {display:table-cell; vertical-align:middle; width:100%;}
        .page > .a_ul li {float:left; width:100%; text-align:center;}
        .page > .b_ul{float:left; width:5.5%; margin-top:28px; font:bold 15px malgun gothic;}
        .page > .b_ul > li {float:left; height:60px;width:100%; text-align:right;}
        .page > .btnBlk{float:left; width:100%;}
    </style>
@stop