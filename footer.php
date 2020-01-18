<footer class="container">
        <p class="float-right"><a href="#">Back to top</a></p>
        <p>&copy; The Oven Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
</footer>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $('.size').change(function(event) {
          $(this).parent().prev('li').find('b.price').text('₹'+$(this).val());
          $(this).parent().next('li').find('button').attr('data-price', $(this).val());
        });
        $('.add_to_cart').click(function(event) {
            var customer = <?=$_SESSION['customer_id']?>;
            var pizza = $(this).data('pizza_id');
            var price = $(this).data('price');
            var btn = $(this);
            if(customer != '' && pizza !=''){
                $.ajax({
                    url: 'add_item.php',
                    type: 'POST',
                    data: {customer: customer,pizza: pizza ,price: price},
                    beforeSend:function(){
                        btn.find('div.text').slideUp('fast');
                        btn.find('div.spinner-grow').slideDown('fast');
                    },
                    success:function(data){
                        btn.find('div.spinner-grow').slideUp('fast');
                        btn.find('div.text').text('Add to Cart \u00BB');
                        btn.find('div.text').slideDown('fast');
                        // btn.removeClass('btn-primary');
                        // btn.addClass('btn-success');
                        // btn.attr('disabled', true);
                        // btn.css('cursor', 'not-allowed');
                        btn.hide();
                        btn.parent().find('button.disabled-btn').show();
                        add_cart_row(pizza,price);
                    }
                });
                setTimeout(function(){ rename_cart_rows(); }, 500);
            }
        });
        $(document).on('click', '.rem', function(event) {
            event.preventDefault();
            var customer = <?=$_SESSION['customer_id']?>;
            var pizza = $(this).data('rem_id');
            var tr = $(this);
            if(customer != '' && pizza != ''){
                $.ajax({
                    url: 'delete_item.php',
                    type: 'POST',
                    data: {customer: customer,pizza: pizza},
                    success:function(data){
                        tr.closest('tr').remove();
                        var addbtn = $(document).find('button[data-pizza_id='+pizza+']')
                        addbtn.show();
                        addbtn.parent().find('button.disabled-btn').hide();
                    }
                });
                setTimeout(function(){ rename_cart_rows(); }, 500); 
            }
        });
        $(document).on('keyup', '.pizza_qty', function(event) {
            calc();
        });
        $(document).on('change', '.pizza_qty', function(event) {
            calc();
        });
      });
      function add_cart_row(pizza,price){
        $.ajax({
            url: 'get_pizza_details.php',
            type: 'POST',
            data: {pizza: pizza},
            success:function(data){
                var detail = JSON.parse(data);
                var tr = "<tr><td align='center' style='width:30%'><input type='hidden' value="+pizza+"><img class='rounded-pill' height='50' width='50' src=Admin/"+detail.image+"><br>"+detail.name+"</td><td style='width:10%'><input type='hidden' value="+price+">₹"+price+"</td><td style='width:5%;'>X</td><td style='width:10%'><input class='form-control form-control-sm text-center pizza_qty' type='number' value='1' min='1' max='5'></td><td style='width:5%;'>=</td><td style='width:10%'><input type='number' class='form-control form-control-sm text-center' readonly value="+price+"></td><td style='width:10%;' align='center'><button data-rem_id="+pizza+" class='page-link rem'>&times;</button></td></tr>";
                $('table#cart-table tbody').append(tr);
            }
        });
      }
      function rename_cart_rows(){
            var i = 0;
            $('table#cart-table tbody tr').each(function() {
                $(this).find('td:nth-child(1) input').attr({name: "order_rows["+i+"][pizza_id]"});
                $(this).find('td:nth-child(2) input').attr({name: "order_rows["+i+"][price]"});
                $(this).find('td:nth-child(4) input').attr({name: "order_rows["+i+"][qty]"});
                $(this).find('td:nth-child(6) input').attr({name: "order_rows["+i+"][sub_total]"});
                i++;
            });
            if(i>0){
                $('#total-table').show();
                $('#empty-msg').hide();
                $('#submit-btn').show();
            }
            if(i==0){
                $('#total-table').hide();
                $('#empty-msg').show();
                $('#submit-btn').hide();
            }
            calc();
        }
        function calc(){
            var grand = 0;
            $('table#cart-table tbody tr').each(function(index, el) {
                var price = parseInt($(this).find('td:nth-child(2) input').val());
                var qty = parseInt($(this).find('td:nth-child(4) input').val());
                var sub = price*qty;
                $(this).find('td:nth-child(6) input').val(sub);
                grand += sub;
            });
            $('#cart-total').val(grand);
        }
      $("#close-menu").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });
    // Open menu
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });
    feather.replace()
    </script>