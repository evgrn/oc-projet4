<?php
define('ROOT', dirname(__DIR__));
require ROOT . '/app/App.php';
App::init();
$auth = new \Core\Auth\DBAuth(App::getInstance()->getDb()); // utile ?



// Routeur
function checkPage(){
  $pathCategories = ['home', 'admin', 'logged', 'users', 'guest'];
  $results = false;
  $pathCategoriesSum =  sizeof($pathCategories);
  $path = explode('.', $_GET['page']);

  if(sizeof($path) > 1){

    for ($i = 0; $i < $pathCategoriesSum; $i++){
      if($pathCategories[$i] === $path[0]){
        if($path[0] == 'admin' || $path[0] == 'logged' || $path[0] == 'guest'){
          if(sizeof($path) == 3 ){
            if($path[1] == 'comments' || $path[1] == 'posts'){
              return true;
            }

          }

        }
        elseif(sizeof($path) < 3){
          return true;
        }
        return false;
      }
    }

  }


}

if(isset($_GET['page'])){
    if(checkPage()){
      $page = $_GET['page'];
    }
    else{
      $page = 'home.notfound';
    }
} else {
  $page = 'home.index';
}


$page = explode('.', $page);
if(sizeof($page) < 2){
  $page = ['home', 'notfound'];
}
if(sizeof($page) === 3){
  $controller = '\App\Controller\\' . ucfirst($page[0]) . '\\' . ucfirst($page[1]). 'Controller';
  $action = $page[2];
}else{
  $action = $page[1];
  $controller = '\App\Controller\\' . ucfirst($page[0]) . 'Controller';
}

$controller = new $controller();
$controller->$action();

?>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=rw9lllvwivegvt1gptpquf6km3i5u8n7aynhbwhutuxe9db0"></script>
<script type="text/javascript">
tinymce.init({
 selector: "#comment-form textarea",
 menubar: false,
 plugins: [
   'advlist autolink lists link image charmap print preview anchor textcolor',
   'searchreplace visualblocks code fullscreen',
   'insertdatetime media table contextmenu paste code help wordcount'
 ],
 toolbar: 'insert | undo redo | bold italic | bullist numlist outdent indent | removeformat | help',
 content_css: [
   '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
   '//www.tinymce.com/css/codepen.min.css']

});
tinymce.init({
 selector: "#post-form textarea",
 menubar: false,
 plugins: [
   'advlist autolink lists link image charmap print preview anchor textcolor',
   'searchreplace visualblocks code fullscreen',
   'insertdatetime media table contextmenu paste code help wordcount'
 ],
 height: 400,
 toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
 content_css: [
   '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
   '//www.tinymce.com/css/codepen.min.css']

});
</script>
