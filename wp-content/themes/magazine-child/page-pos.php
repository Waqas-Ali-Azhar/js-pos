<?php 

get_header();

global $post;

$post_desc = $post->post_content;

echo $post_desc;


?>

<div class="container-fluid">

  <div id="POS">
      
      <div class="outerbox">


        <div class="innerbox">


          <div id="products">
            <?php

             $products = array(
              array(
                'name' => 'Apple',
                'price' => '300'
              ),
              array(
                'name' => 'Grapes',
                'price' => '400'
              ),
              array(
                'name' => 'Pineapple',
                'price' => '200'
              ),
              array(
                'name' => 'Gauva',
                'price' => '100'
              ),
              array(
                'name' => 'Pomegeranate',
                'price' => '600'
              ),
              array(
                'name' => 'Banana',
                'price' => '150'
              ),
              array(
                'name' => 'Apple',
                'price' => '300'
              ),
              array(
                'name' => 'Grapes',
                'price' => '400'
              ),
              array(
                'name' => 'Pineapple',
                'price' => '200'
              ),
              array(
                'name' => 'Gauva',
                'price' => '100'
              ),
              array(
                'name' => 'Pomegeranate',
                'price' => '600'
              ),
              array(
                'name' => 'Banana',
                'price' => '150'
              ),
             );


             foreach($products as $key => $product){
              if($key == 4 || $key == 7)
                $id = "cells";
              else
                $id = "";
              ?>

              <div  class="cell" >
                <div class="name" ><?php echo $product['name']; ?></div>
                <div class="price"><?php echo $product['price']; ?></div>
              </div>

              <?php

             }

             ?>
            

          </div>


          <div id="controls">

            <div class="subtotal">
              <div class="list-wrapper">
                <div class="item">
                  <div class="inc-wrapper ib">
                    <div class="inc">+</div>
                  </div>  
                  
                  <div class="ib qty ib">0</div>
                  
                  <div class="dec-wrapper ib">
                    <div class="dec">-</div>
                  </div>
                    
                  
                  <div class="ib name">------</div>
                  <div class="ib subprice">0</div>
                  <div class="cross">x</div>
                </div>
              </div>
            </div>
            <div class="total">
              <div>
                <label>Total</label>
                <span id="total">RS. 900</span>
              </div>
              <div class="buttons"></div>
          </div>
        
        </div>
      

      </div>

  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script type="text/javascript">
  var posItem = [];

  // $('.cell').click(function(){
  //   alert('clicked');
  // });


/*
  var currentValue = '';
  $('.inc').click(function(){
    currentValue = parseInt($(this).parent().next().html());
    ++currentValue;
    $(this).parent().next().html(currentValue);
  });
 */ 


  $('.dec').click(function(){
    currentValue = parseInt($(this).parent().prev().html());
    if(currentValue > 0){
      --currentValue;  
    }
    
    $(this).parent().prev().html(currentValue);
  });
  /* 
  function ShowCellValue(event){

    var cell = event.target;
    var child = '';
    if(cell){
      child = cell.children;
      var name = child[0].innerHTML;
      var price = child[1].innerHTML;

      var item = '';
      item += '<div class="item">';
      item += '<div class="ib qty">1</div>';
      item += '<div class="ib name">'+name+'</div>';
      item += '<div class="ib subprice">'+price+'</div>';
      item += '</div>';

      posItem.push(item);

      document.getElementsByClassName('list-wrapper')[0].innerHTML = '';
      for(var i=0; i<posItem.length; ++i){
        if(i==0){
          document.getElementsByClassName('list-wrapper')[0].innerHTML = item;
        }
        else{
          var t = document.getElementsByClassName('list-wrapper')[0].innerHTML; 
          document.getElementsByClassName('list-wrapper')[0].innerHTML = t + item;
        }  

      }
      

      // console.log(item);
       
    }
    
  }
  */

  // function ShowCellValue(event){

  //   var name = $(event.target.children[0]).html();
  //   var price = $(event.target.children[1]).html();

  //   posItem[name] = price;

  //   console.log(name);
  //   console.log(price);

  // }
  // 
  // 
  // 
 


  var postElements = [];
  
  $('.cell').click(function(){
    var name = $(this).children()[0].innerHTML;
    var price = $(this).children()[1].innerHTML;

    var insert = 1;
    if(postElements[0]){

      


      for(var i=0; i<postElements.length; ++i){
        if(postElements[0]){
          if(postElements[i][0] == name){
           var qty = postElements[i][2];
           postElements[i][2] = qty + 1;
           insert = 0;
           break;
          }
        }
      }







      if(insert){
        postElements.push([name,price,1]);  
      }
    


    }
    else{
      postElements.push([name,price,1]); 
    }


    update_view();
    console.log('ok');
      

    
    
    
});


function update_view(){

  var html = '';
    for(var i=0; i<postElements.length; ++i){
      var name = postElements[i][0];
      var price = parseInt(postElements[i][1]);
      var qty = postElements[i][2];

      var subPrice = qty * price;

      html += '<div class="item" data="'+name+'"><div class="inc-wrapper ib"><div class="inc">+</div></div><div class="ib qty ib">'+qty+'</div><div class="dec-wrapper ib"><div class="dec">-</div></div><div class="ib name" >'+name+'</div><div class="ib subprice">'+subPrice+'</div><div class="cross">x</div></div>';
    }

    $('.list-wrapper').html('')
    $('.list-wrapper').html(html);
    bindEvents();
    sumTotal();
}

function bindEvents(){

  $('.inc').click(function(){

    var  name = $(this).parent().parent().attr('data');
       for(var i=0; i<postElements.length; ++i){
        if(postElements[0]){
          if(postElements[i][0] == name){
           var qty = postElements[i][2];
           postElements[i][2] = qty + 1;
           break;
          }
        }
      }

      update_view();
  });

  $('.dec').click(function(){

    var  name = $(this).parent().parent().attr('data');
       for(var i=0; i<postElements.length; ++i){
        if(postElements[0]){
          if(postElements[i][0] == name){
           var qty = postElements[i][2];
           if(qty > 1){
            postElements[i][2] = qty - 1; 
           }
           
           break;
          }
        }
      }

      update_view();
  });


   $('.cross').click(function(){

    var  name = $(this).parent().attr('data');
       for(var i=0; i<postElements.length; ++i){
        if(postElements[0]){
          if(postElements[i][0] == name){
            postElements.splice(i,1);
            break;
          }
        }
      }

      update_view();
      
  });



}


function sumTotal(){
  var sum = 0;
  for (var i = 0; i <postElements.length; ++i) {
    var qty = postElements[i][2];
    var unit_price  = parseInt(postElements[i][1]);

    sum += qty*unit_price;
 }
 $('#total').html(sum);
 console.log(sum);
}


  
</script>

<?php 


get_footer();


?>