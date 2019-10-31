<div class="form-group">
    <label for="">Mật khẩu cũ</label>
    <input type="text" name="" id="" class="form-control" placeholder="" aria-describedby="helpId">
    <a href="javascript::void(0)"><i class="fa fa-eye"></i></a>
</div>
<script>

    $(document).ready(function(){
        $(".js_order_item").click(function(){
            event.preventDefault();
            let $this = $(this);
            let url = $this.attr('href');
            $.ajax({
                type: "method",
                url: url,
                dataType: "html",
                success: function (response) {
                    $(".content").html('').append(reponse);
                }
            });
        });
        $('.orrderby').change(function(){
            $('#form-order').submit();
        });

        let idProduct  = $("#content_product").attr('data-id');

        let products = localStorage.getItem('products');
        if(!products) {
            arrProduct = new Array();
            arrProduct.push(idProduct);
            localStorage.setItem('products', JSON.stringify(arrProduct));
        }else {
            products = $.parseJSON(idProduct);
            if(products.indexOf(idProduct) == - 1) {
                products.push(idProduct);
                localStorage.setItem('products', JSON.stringify(products));
            }
        }
        // lay ra
        let productsAjax = localStorage.getItem('products');
        let arrIdProduct = $.parseJSON(productsAjax);
        if(arrIdProduct.length > 0 ) {
            $.ajax({
                type: "method",
                url: "url",
                data: "data",
                dataType: "dataType",
                success: function (response) {

                }
            });
        }

        // hide password
        $('.form-group a').click(function(){
            let $this = $(this);
            if($this.hasClass('active')) {
                $this.parents('.form-group').find('input').attr('type','password');
            }else {
                $this.parents('.form-group').find('input').attr('type','text');
                $this.removeClass('active');
            }
        });
    })



</script>
