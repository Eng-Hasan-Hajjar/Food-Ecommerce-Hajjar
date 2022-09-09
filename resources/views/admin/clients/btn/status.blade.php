<form action="{{url('admin/client/status/'.$id)}}" method="POST">
    @csrf
    @method('PUT')
    <button type="submit" class= "btn btn-sm {{activeStatus($active)[0]}} ">
        @if($active !=0)
            {{ activeStatus($active)[1]}}
        @else active
        @endif
    </button>
</form>
