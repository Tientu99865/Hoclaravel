@extends('layouts.master')

@section('Noidung')
    <h2>PHP</h2>
    {{$bien}}<br>

    {!! $bien !!}<br>

    @if($bien != "")
        {!! $bien !!}
    @else
        {{"nothing"}}
    @endif
    <br>
{{--    {{isset($bien) ? $bien:"Khong co bien "}}--}}
    @for($i = 1;$i<= 10;$i++)
        {!! $i."<br>" !!}
    @endfor

    <?php
            $mang = array('PHP','JS','CSS','HTML');
    ?>
    @foreach($mang as $value)
{{--        @continue($value == 'JS')--}}{{-- bo qua JS nhung van chay vong foreach--}}
        @break($value == 'CSS') {{--tim thay css se thoat vong foreach--}}
        {{$value}}<br>
    @endforeach

{{--Ket hop giua if va foreach--}}

    @forelse($mang as $value)
        {{$value}}
    @empty
        {{"mang trong"}}
    @endforelse

@endsection
