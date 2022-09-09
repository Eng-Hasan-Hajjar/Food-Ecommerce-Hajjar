$(function () {

    function search(city, resturant, token,location) {
        $.ajax({
                method: 'post',
                data: {

                    city: city, resturant: resturant, _token: token
                },
                url: location,
                success: function (res) {
                    $("#resturant").html(res);
                },
                error: function (err) {
                    if (err.status == 422) { // when status code is 422, it's a validation issue
                        //$('#message').fadeIn().html(err.responseJSON.message);

                        // you can loop through the errors object and show it to the user
                        console.warn(err.responseJSON.errors);
                        // display errors on each form field
                        $.each(err.responseJSON.errors, function (i, error) {
                            var el = $(document).find('[name="' + i + '"]');
                            el.after($('<span style="color: #ff0000;">' + error[0] + '</span>'));
                        });
                    }
                }
            }
        )
    }

    //resturant_search
    $('#res_search').on('submit', function (e) {
        e.preventDefault();
        let city = $('#cityId option:selected').val(),
            resturant = $('#resturantId').val(),
            token = $('#token').val();
        search(city, resturant, token,"resturant_search");


    });
    //job_search
    $('#search-job').on('submit', function (e) {
        e.preventDefault();
        let city = $('#cityId option:selected').val(),
            resturant = $('#resturantId').val(),
            token = $('#token').val();
        search(city, resturant, token,'job-search');
    });
    // load district by choose city
    $("#city").on('change', function () {
        $.ajax({
            method: 'get',
            data: {
                city_id: this.value
            },
            url: '/load-district',
            success: function (result) {
                if (result.status == 1) {
                    var p = "<option disabled selected> الحي</option>";
                    result.data.forEach(function (item) {
                        p += "<option value=" + item.id + ">" + item.name + "</option>";
                    });
                    $("#district").removeAttr('disabled').html(p);
                } else {
                    $("#district").attr('disabled', 'disabled').html('');
                }
            }


        })
    });

    // change value when toggle checkbox
    $('#customSwitch1').change(function () {
        var status = $(this).prop('checked') == true ? 1 : 0;
        $(this).val(status);
    });
    //upload image for usere(resturant)
    // image upload


    $(document).on("change", "#product_image", function () {
        var uploadFile = $(this);
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

        if (/^image/.test(files[0].type)) { // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file

            reader.onloadend = function () { // set image data as background of div
                //alert(uploadFile.closest(".upimage").find('.imagePreview').length);
                uploadFile.closest(".img-input").find('img').attr("src", this.result);
            }
        }

    });

    $("#btn-register").on('click', function () {
        $(this).replaceWith('<div class="btn-group text-red"><button class="btn-register ml-5">' +
            '<a class="reg-link" style="    text-decoration: none;\n' +
            '    color: #fff;" href="resturant/register">مطعم  </a>' +
            '</button> <button class="btn-register"><a class="reg-link" style="    text-decoration: none;\n' +
            '    color: #fff;" href="/register">مشتري</a></button></div>');
    });

    // confirmation when i delete product
    // $('#deleteProduct').on('show.bs.modal', function (event) {
    //     var button = $(event.relatedTarget);
    //     $('#deleteProductForm').attr('action', '/resturant/product/' + button.data('product-id'));
    //
    // });
    $('.deleteProduct').on('click', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'هل  تريد حذف ذلك  المنتج',
            text: 'سيتم حذف هذا المنتج نهائيا',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'الغاء',
            confirmButtonText: 'نعم ! احذف'
        }).then((result) => {
            if (result.value) {
                $(this).find('form').submit();
            }
        })

    })
    // confirmation when i delete employee
    $(document).on('click','#delete_employee',function (e){
        e.preventDefault();
        Swal.fire({
            title: 'هل  تريد حذف ذلك  الطلب',
            text: 'سيتم حذف هذا الطلب نهائيا',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'الغاء',
            confirmButtonText: 'نعم ! احذف'
        }).then((result) => {
            if (result.value) {
                $(this).parent().submit();
            }
        })
    });

    // confirmation when i delete offer
    $('.deleteOffer').on('click', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'هل  تريد حذف ذلك  العرض',
            text: 'سيتم حذف هذا العرض نهائيا',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'الغاء',
            confirmButtonText: 'نعم ! احذف'
        }).then((result) => {
            if (result.value) {
                $(this).find('form').submit();
            }
        })

    })



    // showDetail in model

    // confirmation when i delete order
    $('#deleteOrder').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        $('#deleteOrderForm').attr('action', '/cart/delete/' + button.data('product-id'));

    });

    $('select.Quantity').on('change', function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
            }
        });
        $.ajax({
            url: '/cart/update',
            data: {
                id: $(this).data('product-id'),
                q: $(this).children("option:selected").val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            type: JSON,
            method: 'post',
            success: function (total) {
                $("#total").text(total);
            }
        })
    });
    $(document).on('show.bs.modal', '#MyModal', function (event) {
        var button = $(event.relatedTarget);
        $.ajax({
            url: '/details',
            data: {
                id: button.data('show-id'),
            },
            type: JSON,
            method: 'post',
            success: function (result) {
                $('#detailData').html(result);

            }
        })
    });

    $(document).on('change','#job',function (){
        let type = $(this).prop('checked');
        if(type)
            $(this).val('1');
        else
            $(this).val('0');
    });

});
// submit order
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
    }
});

$('#submitOrder').on('click', function () {
    $.ajax({
        url: '/cart/submit',
        type: JSON,
        method: 'post',
        success: function (result, textStatus, xhr) {
            if (result.status == 1) {
                var details = '';
                details += `
              <section class="twe-order-info footer-bottom" >
    <div class="container">
        <form  id="myformSubOrder" onsubmit="event.preventDefault();subOrder()">
            <div class="total text-right" style="background: #ececec">
                <div class="row my-4">
                    <div class="col-3">
                        <h4 > ملاحظات :</h4>
                    </div>
                    <div class="col-6">
                 <textarea rows="10" name="notes" class="form-control">
                   </textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <h4 > العنوان :</h4>
                    </div>
                    <div class="col-6">
                        <input type="text" name="address" class="form-control" placeholder="مثال : شارع الحسين">
                    </div>

                </div>
            </div>
        <div class="total text-right" style="background: #ececec">
            <p>سعر الطلب :<span class="text-center">` + result.data.cart.totalPrice + ` $</span></p>
            <p>رسم التوصيل :<span>` + result.data.delivery + ` $</span></p>
            <p> الاجمالي   :<span>` + result.data.sum + ` $</span></p>
            <p> الدفع   :<span>كاش </span></p>
        </div>
            <input type="submit" name="submit"  class="btn btn-danger btn-block my-3 py-3" value="تاكيد">
        </form>
    </div>
</section>
                     `;
                $('#section-order').html(details);
            } else if (result.status == 1) {
                alert(result.message);
            } else {
                window.location.href = '/login';
            }
        },
        error: function (err, jqxhr) {
            alert('حدث خطاء حاول  مره  اخري ');
        }
    })
});

// change value for Switch State for resturant

// show details order
function subOrder() {
    $.ajax({
        method: 'post',
        data: $('#myformSubOrder').serialize(),
        url: '/new-order',
        success: function (data) {
            if (data.status == 0) {
                alert(data.message);
            } else {
                Swal.fire({
                    title: '',
                    text: 'تم اكتمال  العمليه عليك انتظار  رد  المطعم ',
                    icon: 'success',
                })
                $('#section-order').replaceWith(data);
            }
        },
        error: function (err) {
            if (err.status == 422) { // when status code is 422, it's a validation issue
                //$('#message').fadeIn().html(err.responseJSON.message);
                // you can loop through the errors object and show it to the user
                // display errors on each form field
                $.each(err.responseJSON.errors, function (i, error) {
                    var el = $(document).find('[name="' + i + '"]');
                    el.after($('<span style="color: #ff0000;">' + error[0] + '</span>'));
                });
            }
        }
    });
}


