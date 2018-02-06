$(function(){

  var pagination = {
    selector: '',
    slice: 0,
    duration: 0,
    upperFloor: 0,
    itemSum: 0,

    init: function(selector, slice, duration){
      this.selector = selector;
      this.slice = slice;
      this.suration =  duration;
      this.upperFloor = slice;
      this.itemSum = $(selector).length;

      this.hideAbove();
      this.insertButton();
      this.initEvents();

    },

    hideAbove: function(){
      $(this.selector).slice(this.slice, this.itemSum).hide();
    },

    nextSlice: function(){
      this.upperFloor += this.slice;
      $(this.selector).slice(0, this.upperFloor).fadeIn(this.duration);
      $('body, html').animate({scrollTop: $('#show-next-slice').offset().top}, 800);
      if( this.upperFloor >= this.itemSum){
        $('#show-next-slice').replaceWith('<p class="help-block">Il n\'y a plus de commentaires à afficher.</p>');
      }
    },

    insertButton: function(){
      $(this.selector).parent().after('<button id="show-next-slice" class="btn btn-info btn-xs"> Voir plus </button>');
    },

    initEvents: function(){
      $('#show-next-slice').on('click', function(){
        pagination.nextSlice()});
      }

  }


pagination.init('.comments-list .comment', 5, 800);










})
