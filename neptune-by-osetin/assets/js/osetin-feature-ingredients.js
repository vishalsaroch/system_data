( function( $ ){
    "use strict"; 


    $( function(){


      // function that handles recalculation of ingredient amounts after servings change
      function osetin_update_ingredient_amounts($elements, initial_serves, new_serves){
        $elements.each(function(){
          var ingredient_amount_text = $(this).text();
          var ingredient_initial_amount_text = String($(this).data('initial-amount'));
          if(ingredient_initial_amount_text != '' && initial_serves > 0){
            // extract only the numbers and dot before the first letter
            var amount_value = ingredient_initial_amount_text.match(/([0-9\.]+)[^0-9]*/);
            if(amount_value != null && typeof amount_value[1] !== 'undefined'){
              // extract letters from the amount text so we can use it later and join it with the number amount
              var amount_non_value = ingredient_initial_amount_text.replace(amount_value[1], '');
              var per_amount = parseFloat(amount_value[1])/initial_serves;
              // round the value properly so we dont have .00 if the value is plain number
              var new_amount = Math.round((per_amount * new_serves) * 100) / 100;
              $(this).text(new_amount + amount_non_value);
            }
          }
        });
      }

      // Servings increment button click
      $(".ingredient-serves-incr").click(function(){        
        var current_serves = parseInt($(".ingredient-serves-num").val());
        var initial_serves = parseInt($(".ingredient-serves-num").data('initial-service-num'));
        // check if current serves is proper number and not zero
        if (Number.isInteger(current_serves) && (current_serves > 0) && (initial_serves > 0) && Number.isInteger(initial_serves)){
          var new_serves = current_serves + 1;
          // set input box values to new serving value
          $(".ingredient-serves-num").val( new_serves ).data('current-serves-num', new_serves);
          // update ingredient amounts based on new servings
          osetin_update_ingredient_amounts($(".ingredient-amount"), initial_serves, new_serves);
        }
      }); 


      // Servings decrement button click
      $(".ingredient-serves-decr").click(function(){ 
        var current_serves = parseInt($(".ingredient-serves-num").val());
        var initial_serves = parseInt($(".ingredient-serves-num").data('initial-service-num'));
        // check if current serves is proper number and more than 1 so we can substract something from it
        if (Number.isInteger(current_serves) && (current_serves > 1) && Number.isInteger(initial_serves)){
          var new_serves = current_serves - 1;
          // set input box values to new serving value
          $(".ingredient-serves-num").val( new_serves ).data('current-serves-num', new_serves);
          // update ingredient amounts based on new servings
          osetin_update_ingredient_amounts($(".ingredient-amount"), initial_serves, new_serves);
        }
      }); 


      // Servings changing value
      $(".ingredient-serves-num").change(function(){
        
        var current_serves = parseInt( $(".ingredient-serves-num").data('current-serves-num') );
        var initial_serves = parseInt($(".ingredient-serves-num").data('initial-service-num'));
        var new_serves = parseInt($(".ingredient-serves-num").val());

        if (Number.isInteger(current_serves) && new_serves >= 1 && current_serves > 0){
          $(".ingredient-serves-num").val(new_serves).data('current-serves-num', new_serves);
          osetin_update_ingredient_amounts($(".ingredient-amount"), initial_serves, new_serves);
        }else{
          $(".ingredient-serves-num").val(current_serves);
        }
      });
    });
  } 
)( jQuery );