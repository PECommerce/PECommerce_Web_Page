$(function(){
    $('.library').on('click',function(){
        $("#library_modal").modal({
            backdrop: 'static',
            effect: 'ajax', 
            keyboard: false
        });
    });

    $('#library_modal').on('hidden', function(){
        $(this).data('modal', null);
    });

    $('#library_modal').on('click','#tabContent a',function (e) {
      e.preventDefault();
      var url = $(this).attr("data-url");

      if (typeof url !== "undefined") {
      var pane = $(this), href = this.hash;

      // ajax load from data-url
      $(href).load(url,function(result){      
        pane.tab('show');
      });
      } else {
        $(this).tab('show');
      }
    });

});