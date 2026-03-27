1.路由传参<br>
我在{!!$city!!}，现在{{date('h:i:s',time())}}点了，我饿了，快下课了<br>

2.isset函数<br>
{{isset($en)?$en:'en变量不存在'}}<br>

3.如果当前时间在8-18点之前就说 要上课，在18-23 就是 快乐时光，其余就说睡觉<br>
{{ $time >= 8 && $time < 18 ? '上课' : ($time >= 18 && $time < 23 ? '快乐时光' : '睡觉') }}<br>
{{ date('H') >= 8 && date('H') < 18 ? '上课' : (date('H') >= 18 && date('H') < 23 ? '快乐时光' : '睡觉')}}<br>

@if($time >= 8 && $time < 18)
    上课
    @elseif($time>= 18 && $time < 23)
        快乐时光
        @else
        睡觉
        @endif