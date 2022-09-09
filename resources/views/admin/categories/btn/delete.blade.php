<form action={{url('admin/category/'.$id)}} method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger float-left"> <i class="fas fa-trash-alt"></i></button>
</form>


