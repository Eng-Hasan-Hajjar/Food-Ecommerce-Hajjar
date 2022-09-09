
<div class="btn-group">
    <a class="btn btn-success ml-3 " href="tel: {{$phone}}">
        <i class="fas fa-phone"></i>
    </a>
    <form action="{{url('resturant/delete-employee/'.$id)}}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger " id="delete_employee">
            <i class="fas fa-trash-alt"></i>
        </button>
    </form>

</div>

