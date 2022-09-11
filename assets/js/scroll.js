window.onload=function(){
    //Заставка
    let preloader = document.getElementById('preloader');
    if (preloader && sessionStorage.getItem('preloader') != 'true') {
        document.body.classList.add('v-hidden');
        setTimeout(function () {
            preloader.classList.add('hide_preloader');
            document.body.classList.remove('v-hidden');
            sessionStorage.setItem('preloader', 'true');
        }, 1000);
    }

    //---------------------------------------------------------Catalog

    if (window.innerWidth > 600) {
        const catalog = document.getElementsByClassName('shop_catalog');
        if (catalog[0]) {
            const products = document.getElementsByClassName('products');
            let  x = 0;
            let l1 = products[0].getElementsByTagName('li')[0].offsetWidth;
            let l = (products[0].getElementsByTagName('li').length * l1) - products[0].offsetWidth;
            if (l > 0) {
                catalog[0].getElementsByClassName('right_button')[0].classList.remove('hide');
            }
            catalog[0].getElementsByClassName('right_button')[0].addEventListener('click', function() {
                if (x < l) {
                    if (x % l1 != 0)
                        x += l1 - (x % l1);
                    else
                        x += l1;
                }
                products[0].scroll({
                    left: x,
                    top: 0,
                    behavior: 'smooth'
                });
                hide_button();
            });

            catalog[0].getElementsByClassName('left_button')[0].addEventListener('click', function() {
                if (x > 0) {
                    if (x % l1 != 0)
                        x -= x % l1;
                    else
                        x -= l1;
                }
                products[0].scroll({
                    left: x,
                    top: 0,
                    behavior: 'smooth'
                });
                hide_button();
            });
            
            products[0].addEventListener("wheel", function(event) {
                if (x >= 0 && x <= l) {
                    if (event.deltaY > 0 || event.deltaY < 0) {
                        x += event.deltaY;
                    } else if (event.deltaX > 0 || event.deltaX < 0) {
                        x += event.deltaX;
                    }
                }
                if (x < 0)
                    x = 0;
                if (x > l)
                    x = l;
                this.scroll(x, 0);
                hide_button();
            });

            function hide_button() {
                if (x <= 0)
                    catalog[0].getElementsByClassName('left_button')[0].classList.add('hide');
                else
                    catalog[0].getElementsByClassName('left_button')[0].classList.remove('hide'); 
                
                if (x >= l)
                    catalog[0].getElementsByClassName('right_button')[0].classList.add('hide');
                else
                    catalog[0].getElementsByClassName('right_button')[0].classList.remove('hide'); 
            }
        } else {
            if (window.innerWidth > 800) {
                const products = document.getElementsByClassName('products');
                if (products[0]) {
                    let  x = 0;
                    let l1 = products[0].getElementsByClassName('product')[0].offsetWidth + 35;
                    let l = (products[0].getElementsByClassName('product').length * l1) - products[0].offsetWidth;
                    products[0].addEventListener("wheel", function(event) {
                        if (x >= 0 && x <= l) {
                            if (event.deltaY > 0 || event.deltaY < 0) {
                                x += event.deltaY;
                            } else if (event.deltaX > 0 || event.deltaX < 0) {
                                x += event.deltaX;
                            }
                        }
                        if (x < 0)
                            x = 0;
                        if (x > l)
                            x = l;
                        this.scroll(x, 0);
                    });
                }
            }
        }
    }


}