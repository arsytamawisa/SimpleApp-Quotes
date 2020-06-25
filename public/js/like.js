$(document).on('click', '.btn-like', function(){
     var _like = $('#count');
     var _this = $(this);
     var _url  = "/like/" + _this.attr('data-type')
               + "/" + _this.attr('data-model-id');

     $.get(_url, function(data){
          _count = parseInt(_like.html());
          _count +=1;
          _html  = `<i class="fa fa-thumbs-down" aria-hidden="true"></i> <span id="count">`+ _count +`</span>`;
          _this.addClass('btn-danger').html(_html);
     });
})
