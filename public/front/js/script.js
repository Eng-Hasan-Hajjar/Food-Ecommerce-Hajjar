// $(document).ready(function(){
//   $(".button-focus").click(function(){
//     $(".textarea-focus").focus();
//   })
//  });

// $(document).ready(function(){
// $(".icon-search").on("click",function(){
//     $(this).hide(500);
//     $(".icon").css("display","block")
//     $(".icon .input-img").focus()
// })
// })

// review by  stars
$(document).ready(function () {

    $('#stars li').on('click', function () {
        var onStar = parseInt($(this).data('value'), 10); // The star currently selected
        var stars = $(this).parent().children('li.s');

        for (i = 0; i < stars.length; i++) {
            $(stars[i]).removeClass('activ-star');
        }

        for (i = 0; i < onStar; i++) {
            $(stars[i]).addClass('activ-star');
        }
        $('#review').val(onStar);
    });
})
$(document).ready(function () {

    //slick
    $('.multiple-items').slick({
        infinite: true,
        speed: 400,
        autoplay: true,
        autoplaySpeed: 3000,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });

    $(".img-div").hover(function(){
        $(this).children('.more-information').fadeTo(500,1);
    }, function(){
        $(this).children('.more-information').fadeTo(500,0);
    });
})


// document.getElementById("btnPrint").onclick = function () {
//     printElement(document.getElementById("printThis"));
// }

$(document).on('click', '#btnPrint', function () {
    printElement(document.getElementById("printThis"));
});

function printElement(elem) {
    var domClone = elem.cloneNode(true);

    var $printSection = document.getElementById("printSection");

    if (!$printSection) {
        var $printSection = document.createElement("div");
        $printSection.id = "printSection";
        document.body.appendChild($printSection);
    }

    $printSection.innerHTML = "";
    $printSection.appendChild(domClone);
    window.print();
}
