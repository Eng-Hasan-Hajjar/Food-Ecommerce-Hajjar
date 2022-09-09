<form action={{url('admin/client/delete/'.$id)}} method="POST">
    @csrf
    @method('DELETE')
    <button type="submit"  class="btn btn-sm btn-danger float-left delete-user">Delete</button>
</form>
