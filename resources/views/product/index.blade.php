@extends('layouts.app')
@section('content')
<h1 class="text-4xl font-extrabold text-blue-900">Products</h1>
<hr class="h-1 bg-red-500">


<div class="text-right my-5">
    <a href="{{route('product.create')}}" class="bg-blue-900 text-white px-5  py-3 rounded-lg">Add product</a>
</div>
<table class="w-full mt-5">
    <tr>
        <th class="border p-2 bg-gray-200">S.No</th>
        <th class="border p-2 bg-gray-200">Product Picture</th>
        <th class="border p-2 bg-gray-200">Product Names</th>
        <th class="border p-2 bg-gray-200">Descriptions</th>
        <th class="border p-2 bg-gray-200">Prices</th>
        <th class="border p-2 bg-gray-200">Discounted Price</th>
        <th class="border p-2 bg-gray-200">Stock</th>
        <th class="border p-2 bg-gray-200">Status</th>
        <th class="border p-2 bg-gray-200">Category</th>
        <th class="border p-2 bg-gray-200">Actions</th>
    </tr>
    @foreach ($products as $product)
    <tr>
        {{-- //had to show 1...... --}}
        <td class="border p-2">{{$loop->iteration}}</td>
        <td class="border p-2">
            <img src="{{asset('images/products/' . $product->photopath) }}" alt="" class="w-16 h-16 mx-auto object-cover">
        </td>
        <td class="border p-2">{{$product ->name }}</td>
        <td class="border p-2">{{$product ->description }}</td>
        <td class="border p-2">{{$product ->price }}</td>
        <td class="border p-2">{{$product ->discounted_price}}</td>
        <td class="border p-2">{{$product ->stock }}</td>
        <td class="border p-2">{{$product ->status }}</td>
        <td class="border p-2">{{$product ->category->name}}</td>
        <td class="border p-2">
            <a href="{{route('product.edit',$product->id)}}" class="bg-blue-900 text-white px-3 py-1 rounded">Edit</a>
            <a class="bg-red-600 text-white px-3 py-1 rounded cursor-pointer" onclick="showPopup('{{$product->id}}')">Delete</a>
        </td>
    </tr>
    @endforeach
</table>
{{--popup--}}
<div class="fixed bg-gray-600 inset-0 bg-opacity-50 backdrop-blur-sm hidden items-center justify-center" id="popup">
    <form action="{{route('product.destroy')}}" method="POST" class="bg-white px-10 py-5 rounded-lg text-center">
        @csrf
        @method('DELETE')
        <h3 class="font-bold mb-5 text-lg">Are you sure to Delete?</h3>
        <input type="hidden" id="dataid" name="dataid">
        <div class="flex gap-3">
            <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded">Yes! Delete</button>
            <a class="bg-red-600 text-white px-3 py-1 rounded cursor-pointer" onclick="hidePopup()">Cancel</a>
        </div>
    </form>
</div>

<script>
    function showPopup(a) {
        document.getElementById('popup').classList.remove('hidden');
        document.getElementById('popup').classList.add('flex');
        document.getElementById('dataid').value = a;
    }
    function hidePopup() {
        document.getElementById('popup').classList.remove('flex');
        document.getElementById('popup').classList.add('hidden');
    }
</script>




@endsection
