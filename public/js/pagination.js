$(function(){

  /**
   * Permet de paginer des éléments placés à la suite dans le dom.
   * @type {Object}
   */
  var pagination = {
    selector: '',
    slice: 0,
    duration: 0,
    upperFloor: 0,
    itemSum: 0,

    /**
     * Initialisation de l'objet : initialise la pagination des éléments correspondant au paramètre "selector"
     * par tranches dont la longueur est définie par le paramètre "slice";
     * affiche les tranches à la vitesse définie par le paramètre "duration".
     * @param  {string} selector Sélecteur des éléments qui seront paginés
     * @param  {int} slice    Quantité d'éléments par pagination
     * @param  {int} duration Durée de l'effet de pagination
     */
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

    /**
     * Cache les éléments paginés au dessus du nombre d'éléments définis par la propriété slice.
     */
    hideAbove: function(){
      $(this.selector).slice(this.slice, this.itemSum).hide();
    },

    /**
     * Affiche la tranche suivante ou affiche un message disant qu'il n'y a plus d'élements à afficher le cas échéant.
     */
    nextSlice: function(){
      this.upperFloor += this.slice;
      $(this.selector).slice(0, this.upperFloor).fadeIn(this.duration);
      $('body, html').animate({scrollTop: $('#show-next-slice').offset().top}, 800);
      if( this.upperFloor >= this.itemSum){
        $('#show-next-slice').replaceWith('<p class="help-block">Il n\'y a plus de commentaires à afficher.</p>');
      }
    },

    /**
     * Insère le bouton permettant d'afficher la nouvelle tranche.
     */
    insertButton: function(){
      $(this.selector).parent().append('<div class="row"><button id="show-next-slice" class=""> Voir plus </button></div>');
    },

    /**
     * Initialise l'écoute du clic sur le bouton permettant d'afficher la nouvelle tranche
     * et lui assigne l'affichage de la tranche suivante.
     */
    initEvents: function(){
      $('#show-next-slice').on('click', function(){
        pagination.nextSlice()});
      }

  }


pagination.init('.comments-list .comment-block', 5, 800);










})
