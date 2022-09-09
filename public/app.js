
$(function () {
    //old table html
    let old_body = $("#table-body").html()

    // confirmation when i delete-user
    $(document).on('click','.delete-user', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'do you want delete this user',
            text: 'it will be remove',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'cancel',
            confirmButtonText: 'yes ! Delete'
        }).then((result) => {
            if (result.value) {
                $(this).parent().submit();
            }
        })

    })


    // resturant search
    $("#resturantSearch").on('keyup',function ()
    {
        searchAjax("#resturantSearch",'resturant/search',"#table-body",old_body);
});
    // client search
    $("#clientSearch").on('keyup',function ()
    {
        searchAjax("#clientSearch",'client/search',"#table-body",old_body);
    });

      // contact search
    $("#contactSearch").on('keyup',function ()
    {
        searchAjax("#contactSearch",'contact/search',"#table-body",old_body);

    });
    // offer search
    $("#offerSearch").on('keyup',function ()
    {
        searchAjax("#offerSearch",'offer/search',"#table-body",old_body);

    });
    // product search
    $("#productSearch").on('keyup',function ()
    {
            searchAjax("#productSearch",'product/search',"#table-body",old_body);

    });
    // order search
    $("#orderSearch").on('keyup',function ()
    {
        searchAjax("#orderSearch",'order/search',"#table-body",old_body);

    });
    // check  all role
    $("#checkall").click(function (){
        if ($("#checkall").is(':checked')){
            $(".checkboxes").each(function (){
                $(this).prop("checked", true);
            });
        }else{
            $(".checkboxes").each(function (){
                $(this).prop("checked", false);
            });
        }
    });
    // front search
    $("frontSearch").on('click',function () {});





    //   search ajax function
   function searchAjax(element,url,parentDiv,oldBody) {
       let mySearch =  $(element).val();
       if (mySearch !='') {
           $.ajax({
                   method: 'get',
                   data: {
                       'mySearch': mySearch
                   },
                   url: url,
                   success: function (data) {
                       $(parentDiv).html(data);
                   }
               }
           )
       }

       else{
           $(parentDiv).html(oldBody);
       }
   }




   })

