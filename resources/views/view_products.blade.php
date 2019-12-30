<style>
    .pagination li{
        list-style: none;
        float: left;
        margin-left: 5px;
    }
</style>

@foreach($products as $value)
    {{$value->product_name}}<br>
@endforeach

{!! $products->links() !!}
