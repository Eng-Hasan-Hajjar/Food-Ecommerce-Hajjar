<form action={{url('admin/resturant/delete/'.$id)}} method="POST">
    @csrf
    @method('DELETE')
    <button type="submit"  class="btn btn-sm btn-danger float-left delete-user">Delete</button>
</form>
