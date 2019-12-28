<form action="{{route('postFile')}}" method="POST" enctype="multipart/form-data">
    {{csrf_field()}}
    <input type="file" name="myFile">
    <input type="submit">
</form>