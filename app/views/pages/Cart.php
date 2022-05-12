<?php 
class Cart extends View{
    public function output(){
        $title = $this->model->title;
    //     $id=$_GET['id'];
    //     $name=$this->model->getName($id);
    //     $Image=$this->model->getimage($id);
    //  $cost=$this->model->getCost($id);
    // $offer =$this->model->getOffer($id);
    // $material= $this->model->getMaterial($id);
    // $size=$this->model->getSize();
        require_once APPROOT . "/views/inc/header.php";
        //         $text = <<<EOT
                
        // EOT;
        //         echo $text . "<a href = '".URLROOT."pages/test'>Click me</a>";
        ?>
        <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="<?php echo URLROOT . 'css/CartStyle.css'; ?>">
                <script src="https://kit.fontawesome.com/1d1d7fdffa.js" crossorigin="anonymous"></script>
                
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
                <title>Tim's Raw Honey</title>
            </head>
            <div class="wrap cf">

  <div class="heading cf" >
    <h1>My Cart</h1>
    <a href="<?php echo URLROOT.'pages/Shop' ?>" class="continue">Continue Shopping</a>
    
  </div>
  
  <div class="cart" role="document" id="cartdata">
    <a href="" class="clear" id="clear" value="clear">Clear cart</a>
<!--    <ul class="tableHead">
      <li class="prodHeader">Product</li>
      <li>Quantity</li>
      <li>Total</li>
       <li>Remove</li>
    </ul>-->
    <ul class="cartWrap" >
    <?php
    if(isset($_COOKIE["cart".$_SESSION["ID"]]))
    {
     
     $total = 0;
     $cookie_data = stripslashes($_COOKIE["cart".$_SESSION["ID"]]);
     $cart_data = json_decode($cookie_data, true);
     $str="";
     foreach($cart_data as $keys => $values)
     {
      $total = $total + ($values["quantity"] * $values["productPrice"]);
       ?>
 
      <li class="items odd"  id="productsection<?php echo $values["productID"];?>">
  
    <div class="infoWrap" > 
        <div class="cartSection">

        <img src="<?php echo $values["productImage"]; ?>" alt="" class="itemImg" />
        <input type="hidden" id="productimage<?php echo $values["productID"];?>" name="productimage<?php echo $values["productID"];?>" value="<?php echo $values["productImage"]; ?>"></input>
          <p class="itemNumber">#QUE-007544-002</p>
          <h3><?php echo $values["productName"]; ?></h3>
          <input type="hidden" id="productname<?php echo $values["productID"];?>"name="productname<?php echo $values["productID"];?>" value="<?php echo $values["productName"]; ?>"></input>
        
           <p> <input type="text" name="quantity<?php echo $values["productID"];?>" id="quantity<?php echo $values["productID"];?>" class="qty" value="<?php echo $values["quantity"];?>" onchange="updatecart(<?php echo $values['productID'];?>)"> x <?php echo $values["productPrice"];?></p>
           <input type="hidden" id="productprice<?php echo $values["productID"];?>"name="productprice<?php echo $values["productID"];?>" value="<?php echo $values["productPrice"];?>"></input>
          <p class="stockStatus"> In Stock</p>
        </div>  
    
        
        <div class="prodTotal cartSection">
          <p>$ <?php echo number_format($values["quantity"] * $values["productPrice"], 2);?></p>
        </div>
              <div class="cartSection removeWrap">
              <a  class="remove" id="remove<?php echo $values["productID"];?>" value="remove" >x</a>
           <input  type="hidden" id="productid<?php echo $values["productID"];?>" type="submit" name="productid" value="<?php echo $values["productID"];?>" ></input>
        </div>
      </div>
 
      </li>
      <script>// Remove Items From Cart

$(document).ready(function(){
$('#remove'+<?php echo $values["productID"];?>).click(()=>{

  productid=$('#productid'+<?php echo $values["productID"];?>).val();
  remove=$('#remove'+<?php echo $values["productID"];?>).val();


  $.ajax({
        type: 'POST',
        url: 'Cart',
        data:{"productid":productid,"remove":remove},
        success: (result)=>{
          $('#cartdata').html(result);
       
          
        }
    })
  event.preventDefault();
  $( this ).parent().parent().parent().hide( 400 );
 
});

$('#clear').click(()=>{

clear=$('#clear').val();


$.ajax({
      type: 'POST',
      url: 'Cart',
      data:{"clear":clear},
      success: (result)=>{
        $('#cartdata').html(result);
     
        
      }
  })
  event.preventDefault();
  $( this ).parent().parent().parent().hide( 400 );

});


});
function updatecart(id){
  productid=$('#productid'+id).val();
  quantity=$('#quantity'+id).val();
  $.ajax({
    type: 'POST',
      url: 'Cart',
      data:{"productid":productid,"quantity":quantity},
      success: function(result){
          $('#cartdata').html(result);
          
        }
  })
}
function checkout(){

console.log("Ghourab");
checkout=$('#checkout').val();


$.ajax({
      type: 'POST',
      url: 'Cart',
      data:{"checkout":checkout},
      success: (result)=>{
        
        $('#cartdata').html(result);
        $('#exampleModal').modal('show');
     
        
      }
  })
  event.preventDefault();
  $( this ).parent().parent().parent().hide( 400 );

}
</script>

      <?php
      $quantity=$values["quantity"];
      
       $productname=$values["productName"];

       
       $productprice=$values["productPrice"];
       $str.=$productname." (".$quantity.") ,";
       
     }
     $finaltotal=number_format($total, 2);
     ?>
     <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                  aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header border-bottom-0">
                       
                      </div>
                      <div class="modal-body text-start text-black p-4">
                        <h5 class="modal-title text-uppercase mb-5" id="exampleModalLabel"><?php echo $profileData['fullName']; ?></h5>
                        <h4 class="mb-5" style="color: #35558a;">Thanks for your order</h4>
                        <p class="mb-0" style="color: #35558a;">Payment summary</p>
                        <hr class="mt-2 mb-4"
                          style="height: 0; background-color: transparent; opacity: .75; border-top: 2px dashed #9e9e9e;">
        
                        <div class="d-flex justify-content-between">
                          <p class="fw-bold mb-0"><?php echo $str?></p>
                          <p class="text-muted mb-0">$<?php echo $finaltotal?></p>
                        </div>
        
                        <!-- <div class="d-flex justify-content-between">
                          <p class="small mb-0">Shipping</p>
                          <p class="small mb-0">$175.00</p>
                        </div>
        
                        <div class="d-flex justify-content-between pb-1">
                          <p class="small">Tax</p>
                          <p class="small">$200.00</p>
                        </div> -->
        
                        <div class="d-flex justify-content-between">
                          <p class="fw-bold">Total</p>
                          <p class="fw-bold" style="color: #35558a;">$<?php echo $finaltotal?></p>
                        </div>
        
                      </div>
                      <div class="modal-footer d-flex justify-content-center border-top-0 py-4">
                        <button type="button" class="btn btn-primary btn-lg mb-1" style="background-color: #35558a;">
                          Track your order
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
     
    </ul>
    <div class="promoCode"><label for="promo">Have A Promo Code?</label><input type="text" name="promo" placholder="Enter Code" />
  <a href="#" class="btn"></a></div>
  
  <div class="subtotal cf" id="total">
    <ul>

            <li class="totalRow final"><span class="label">Total</span><span class="value">$<?php echo number_format($total, 2);?></span></li>
      <li class="totalRow"><a href="" class="btn continue" name="checkout" onclick="checkout()" id="checkout" value=checkout>Checkout</a></li>
    </ul>
  </div>
</div>
  </div>
  
</div>


<script>
// Just for testing, show all items
  $('a.btn.continue').click(function(){
    $('li.items').show(400);
  })
  </script>
            <?php
}
else{
  echo "";
}
}
}
?>