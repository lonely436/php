广东知名企业包括：
@for($i = 0;$i < count($tech_enterprises);$i++)
    {{$tech_enterprises[$i]}} &nbsp;&nbsp;
    @endfor

    <hr>

    @foreach($tech_enterprises as $en)
    {{$en}}
    @endforeach
    <hr>