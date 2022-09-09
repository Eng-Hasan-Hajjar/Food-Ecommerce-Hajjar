<form action="{{url('admin/city/'.$id)}}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger ">
        <i class="fas fa-trash-alt"></i>
       </button>
</form>


