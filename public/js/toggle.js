$(function(){

  /**
   * Objet permettant d'afficher/cacher des élements au clic d'un autre.
   * @type {Object}
   */
  var toggle = {
    toggleButton: '',
    menuListElements: '',

    /**
     * Initialise l'objet toggle.
     * @param  {string} toggleButtonSelector     Sélecteur de l'élement sur lequel le clic génèrera le toggle
     * @param  {string} menuListElementsSelector Elements auxquels appliquer le toggle
     */
    init: function(toggleButtonSelector, menuListElementsSelector){
      this.toggleButton = toggleButtonSelector;
      this.menuListElements = menuListElementsSelector;
      this.initListElements();
      this.initEventListeners();
    },

    /**
     * Cache les éléments à cacher s'il s'agit d'un petit écran orienté en portrait, sinon les affiche.
     */
    initListElements: function(){
      if(this.hasToBeUsed()){
        this.hideListElements();
      }
      else{
        this.showListElements();
      }
    },

    /**
     * Initialise le toggle au clic du bouton désigné et réinitialise la visiblité des éléments à cacher/afficher au besoin lors du changement de taille de la fenêtre.
     */
    initEventListeners: function(){
      $(this.toggleButton).on('click', function(){toggle.toggle();});
      $(window).on('resize', function(){toggle.initListElements();});
    },

    /**
     * Cache les éléments à cacher/afficher.
     */
    hideListElements: function(){
        $(toggle.menuListElements).not(this.toggleButton).addClass('hidden');
    },

    /**
     * Affiche les éléments à cacher/aficher.
     */
    showListElements: function(){
        $(toggle.menuListElements).not(this.toggleButton).removeClass('hidden');
    },

    /**
     * Toggle le caractère caché des éléments à cacher/afficher
     */
    toggle: function(){
      console.log(toggle.menuListElements);
      $(toggle.menuListElements).not(this.toggleButton).toggleClass('hidden');
    },

    /**
     * Définit si le toggle doit être utilisé ou pas.
     * @return {bool} True si l'orientation est en portrait et qu'il s'agit d'un petit écran, false sinon
     */
    hasToBeUsed: function(){
      if(this.responsive.isPortrait() || this.responsive.isMobile()){
        return true;
      }
      return false;
    },

    /**
     * Captation de la taille et de l'orientation de l'écran
     * @type {Object}
     */
    responsive: {

      /**
       * Vérifie si l'orientation de l'écran est en portrait.
       * @return {bool} True si elle l'est, false sinon.
       */
      isPortrait: function(){
        $(function(){
          if($(window).height() > $(window).width()){
            console.log('portrait');
            return true;
          }
          return false;
        })
      },

      /**
       * Vérifie s'il s'agit d'un écran dont la largeur est inférieure à 768px
       * @return {bool} True si elle l'est, false sinon
       */
      isMobile: function(){
        if($(window).width() < 768){
          return true;
        }
        return false;
      }
    }

  }

  toggle.init('.menu-toggle', '.navbar ul li');

})
