// Полифилл для метода forEach
if (window.NodeList && !NodeList.prototype.forEach) {
    NodeList.prototype.forEach = function (callback, thisArg) {
        thisArg = thisArg || window;
        for (var i = 0; i < this.length; i++) {
            callback.call(thisArg, this[i], i, this);
        }
    };
}


//-------------------------------------------------------Preloader
var pl = document.querySelector('#preloader');
if(pl && sessionStorage.getItem('preloader') == 'true') {
  pl.style.display = "none";
}


//-----------------------------------------------------------Gallery
const gal_wrap = document.querySelector('.product_gallery_wrapper');
if (gal_wrap) {
    const left = gal_wrap.querySelector('.left_arrow');
    const right = gal_wrap.querySelector('.right_arrow');
    const w = gal_wrap.offsetWidth;
    const figure = gal_wrap.querySelector('figure');
    const col = gal_wrap.querySelector('.woocommerce-product-gallery__wrapper').querySelectorAll('.woocommerce-product-gallery__image').length;
    const max = (col-1) * w;
    function removeClasses() {
        figure.querySelectorAll('.woocommerce-product-gallery__image').forEach(function (img) {
            img.classList.remove('flex-active-slide');
        });
        gal_wrap.querySelector('.flex-control-nav').querySelectorAll('li').forEach(function (li) {
            li.querySelector('img').classList.remove('flex-active');
        });
    }
    let x = 0;
    if (right) {
        right.addEventListener('click', function() {
            if (x > -max)
                x -= w;   
            removeClasses();
            let i = -(x/w);
            figure.getElementsByClassName('woocommerce-product-gallery__image')[i].classList.add('flex-active-slide');
            gal_wrap.querySelector('.flex-control-nav').getElementsByTagName('li')[i].querySelector('img').classList.add('flex-active');
            //figure.style.margin = "0 0 0 " + x + "px";
            figure.style.transform = "translateX(" + x + "px)";
        });
    }
    if (left) {
        left.addEventListener('click', function() {
            if (x < 0)
                x += w;
            removeClasses();
            let i = -(x/w);
            figure.getElementsByClassName('woocommerce-product-gallery__image')[i].classList.add('flex-active-slide');
            gal_wrap.querySelector('.flex-control-nav').getElementsByTagName('li')[i].querySelector('img').classList.add('flex-active');
            //figure.style.margin = "0 0 0 " + x + "px";
            figure.style.transform = "translateX(" + x + "px)";
        });
    }
}


if (psm_button = document.querySelector('.product_show_more')) {
    psm_button.addEventListener('click', function() {
        t = document.documentElement.clientHeight + 40;
        window.scroll({
            left: 0,
            top: t,
            behavior: 'smooth',
        });
    })
}


// Автообновление корзины
// jQuery( function( $ ) {
// 	$( 'body' ).on( 'change', '.qty', function() { // поле с количеством имеет класс .qty
// 		$( '[name="update_cart"]' ).trigger( 'click' );
// 	} );
// } );


function disableScrolling(){
    document.querySelector('body').classList.add('v-hidden');
}
function enableScrolling(){
    document.querySelector('body').classList.remove('v-hidden');
}
//Меню

if (mb = document.querySelector('.header_menu_icon')) {
    if (mw = document.querySelector('.main_menu_wrapper')) {
        const but = mw.querySelector('.close_button');
        const but2 = mw.querySelector('.inst_button');
        mb.addEventListener('click', function () {
            disableScrolling();
            mw.classList.remove('hide_menu');
            mw.classList.add('show_menu');
            setTimeout(function () {
                but.classList.remove('hide_menu');
                but2.classList.remove('hide_menu');
            }, 1000)
        });
        but.addEventListener('click', function () {
            enableScrolling();
            but.classList.add('hide_menu');
            but2.classList.add('hide_menu');
            mw.classList.remove('show_menu');
            setTimeout(function () {
                mw.classList.add('hide_menu');
            }, 1000)
        })
    }
}




//Таблица размеров
if (document.querySelector('.sizes_table_button') && document.querySelector('.sizes_table_wrapper')) {
    const stw = document.querySelector('.sizes_table_wrapper');
    document.querySelectorAll('.sizes_table_button').forEach(function (stb) {
        stb.addEventListener('click', function() {
            stw.classList.add('show');
            disableScrolling();
        })
    });
    
    stw.querySelector('.fon').addEventListener('click', function() {
        stw.classList.remove('show');
        enableScrolling();
    })
    stw.querySelector('.close').addEventListener('click', function() {
        stw.classList.remove('show');
        enableScrolling();
    })
}



//Наведение на товары в каталоге
if (window.innerWidth > 600 && document.querySelector(".shop_catalog")) {
    document.querySelector(".shop_catalog").querySelectorAll(".product").forEach(function (product) {
        product.querySelector(".woocommerce-loop-product__link").addEventListener("mouseenter", function() {
            let h = product.querySelector(".woocommerce-product-details__short-description p").clientHeight;
            product.querySelector(".woocommerce-product-details__short-description").style.height = h+"px";
        });
        product.querySelector(".woocommerce-loop-product__link").addEventListener("mouseleave", function() {
            product.querySelector(".woocommerce-product-details__short-description").style.height = "0";
        });
    });
}



//Shipping method tabs
// if (document.querySelector(".shipping_methods")) {
//     const tabNavs = document.querySelectorAll(".shipping_method_title_item");
//     const tabPanes = document.querySelectorAll(".shipping_method_desc_item");

//     for (let i = 0; i < tabNavs.length; i++) {
        
//         tabNavs[i].addEventListener("click", function(e){
//             let activeTabAttr = tabNavs[i].getAttribute("data-tab");
    
//             for (let j = 0; j < tabPanes.length; j++) {
//                 let contentAttr = tabPanes[j].getAttribute("data-tab-content");
    
//                 if (activeTabAttr === contentAttr) {
//                     tabNavs[j].classList.add("active");
//                     tabPanes[j].classList.add("active"); 
//                 } else {
//                     tabNavs[j].classList.remove("active");
//                     tabPanes[j].classList.remove("active");
//                 }
//             }
//         });
//     }
// }



//Скрытие товаров в оформлении
if (window.innerWidth <= 600) {
    if (document.querySelector('#order_review_heading')) {
        let il = document.querySelector('.checkout_review_order_table').getElementsByClassName("cart_item").length;
        let h = il*225 + (il > 1 ? 20 : 0);
        document.querySelector('#order_review_heading').addEventListener('click', function() {
            if (h == 0) {
                document.querySelector('.checkout_review_order_table').style.height = "0";
                h = il*225 +  + (il > 1 ? 20 : 0);
                document.querySelector('.checkout_wrapper .checkout_order h2 img').classList.remove('close');
            } else {
                document.querySelector('.checkout_review_order_table').style.height = h+"px";
                h = 0;
                document.querySelector('.checkout_wrapper .checkout_order h2 img').classList.add('close');
            }
        });
    }
}



//Вкладки на странице товара
if (document.querySelector('.product_additional_tabs')) {
    document.querySelector('.product_additional_tabs').querySelectorAll('.product_tab').forEach(function (tab) {
        if (tab.dataset.open=="true") {
            const h = tab.querySelector('.title').clientHeight+tab.querySelector('.description').clientHeight;
            tab.style.height=h+"px";
        }
        tab.querySelector('.title').addEventListener('click', function() {
            if (tab.dataset.open=="true") {
                if (window.innerWidth <= 600)
                    tab.style.height="64px";
                else
                    tab.style.height="66px";
                tab.dataset.open = "false";
            } else if (tab.dataset.open=="false") {
                const h = tab.querySelector('.title').clientHeight+tab.querySelector('.description').clientHeight;
                tab.style.height=h+"px";
                tab.dataset.open = "true";
            }
        });
    });
}


//Изменение цены товара при выборе вариации
if (document.querySelector('.varition_price')) {
    document.querySelector('.variations .value').querySelectorAll('.stock').forEach(function (size) {
        size.addEventListener('click', function () {
            setTimeout(function () {
                if (document.querySelector('.single_variation_wrap .single_variation .woocommerce-variation-price').innerHTML) {
                    document.querySelector('.varition_price').innerHTML = document.querySelector('.single_variation_wrap .single_variation .woocommerce-variation-price').innerHTML; 
                    document.querySelector('.product_block_header .price_wrapper > .price').style.display = "none";
                }
            }, 10);
        });
    });
}




//Change count on cart
// jQuery( function( $ ) {
// $( 'body' ).on( 'click', 'button.plus, button.minus', function() {
 
// 	var qty = $(this).parent().find( 'input' ),
// 	    val = parseInt( qty.val() ),
// 	    min = parseInt( qty.attr( 'min' ) ),
// 	    max = parseInt( qty.attr( 'max' ) ),
// 	    step = parseInt( qty.attr( 'step' ) );
 
// 	// дальше меняем значение количества в зависимости от нажатия кнопки
// 	if ( $( this ).is( '.plus' ) ) {
// 		if ( max && ( max <= val ) ) {
// 			qty.val( max );
// 		} else {
// 			qty.val( val + step );
// 		}
//         $( '[name="update_cart"]' ).trigger( 'click' );
        
// 	} else {
// 		if ( min && ( min >= val ) ) {
// 			qty.val( min );
// 		} else if ( val > 1 ) {
// 			qty.val( val - step );
// 		}
//         $( '[name="update_cart"]' ).trigger( 'click' );
        
// 	}

 
// });
// } );





//Animation
/*$(document).ready(function() {
    if (catalog = document.querySelector('.shop_catalog')) {

        $(".products .product").click(function(event){
            event.preventDefault();
            linkLocation = this.querySelector('a').href;
            this.classList.add('perehod');
            if (window.innerWidth > 600) {
                const b = catalog.querySelector('.products').scrollTop += this.getBoundingClientRect().x;
                this.style.margin = "0 0 0 -"+b+"px";
            } else {
                const b = catalog.querySelector('.products').scrollTop += this.getBoundingClientRect().y;
                this.style.margin = "-"+b+"px 0 0 0";
            }
            this.querySelector('.product_description').classList.add('hide_desc');
            catalog.querySelector('.nav_buttons').classList.add('hide_desc');
            setTimeout(() => {
                location.assign(linkLocation);
            }, 1500);
        });
    }
});*/




// Плавный скролл
// $(document).bind( 'mousewheel', function (e) { 
//     var nt = $(document.body).scrollTop()-(e.deltaY*e.deltaFactor*100); 
//     e.preventDefault(); 
//     e.stopPropagation(); 
//     $(document.body).stop().animate( { 
//          scrollTop : nt 
//      } , 500 , 'easeInOutCubic' );  
// } )





//Маски для полей
// jQuery( function( $ ) {
//     $(document).ready(function() {
//         $("input[type=tel]").mask("(999) 999-99-99");
//     });
// });





//Checkout

// jQuery( function( $ ) {
// 	$( '#billing_city' ).on( 'change input blur', function() {
//         setTimeout(function(){
//             // console.log('change');
//             // $(".shipping_methods").load("checkout .shipping_methods");
//             location.reload();
//         }, 200);
// 	} );

//     $('#shipping_method li input').on('change input blur', function() {
//         $(".woocommerce-shipping-wrapper").load("checkout .woocommerce-shipping-wrapper");
//     });

// } );



if (document.querySelector("#checkout")) {
    document.querySelector("#checkout").addEventListener("submit", function() {
        document.querySelector("#checkout").querySelector(".woocommerce-shipping-wrapper button.wc-edostavka-choose-delivery-point").classList.add("submited");
    });
}
