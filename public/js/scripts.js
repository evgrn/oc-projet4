$(function(){

  /**
   * Initialisatoin de tynyMCE pour le formulaire de commentaires
   */
  tinymce.init({
   selector: "#comment-form textarea",
   language_url: 'js/tinymce/langs/fr_FR.js',
   language: 'fr_FR',
   menubar: false,
   plugins: [
     'advlist autolink lists link image charmap print preview anchor textcolor',
     'searchreplace visualblocks code fullscreen',
     'insertdatetime media table contextmenu paste code help wordcount'
   ],
   toolbar: 'insert | undo redo | bold italic | bullist numlist outdent indent | removeformat',
  });

  /**
   * Initialisatoin de tynyMCE pour le formulaire d'édition de chapitres.
   */
  tinymce.init({
   selector: "#post-form textarea",
   language_url: 'js/tinymce/langs/fr_FR.js',
   language: 'fr_FR',
   menubar: false,
   plugins: [
     'advlist autolink lists link image charmap print preview anchor textcolor',
     'searchreplace visualblocks code fullscreen',
     'insertdatetime media table contextmenu paste code help wordcount'
   ],
   height: 400,
   toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat',
  });







})
