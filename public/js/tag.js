var counter = 0;
$(document).ready(function(){
     $('#add_tag').click(function(){
          counter++;
          if(counter <3)
               $('#tag_select').clone().appendTo('#tag_wrapper')
     });

     $('#remove_tag').click(function(){
          if(counter > 1)
          {
               $('#tag_select').remove();
               counter--;
          }

     });

     console.log(counter)
})
