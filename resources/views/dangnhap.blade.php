@if (!isset($error))

@else
    {{$error}}
@endif
<form action="{{route('login')}}" method="post">
    @csrf
    <input type="text" name="username">
    <input type="text" name="password">
    <input type="submit">
</form>
