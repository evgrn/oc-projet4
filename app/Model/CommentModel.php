<?php
namespace App\Model;

/**
 *
 * Modèle des commentaires
 */
class CommentModel extends \Core\Model\Model{

  /**
   * Affiche un extrait du commentaire
   * @return string L'etrait du commentaire
   */
  public function getExcerpt(){
    $excerpt = substr($this->content, 0, 500) . ' (...)';
    $html = '<p>' . $excerpt . '</p>';
    return $html;
  }

  /**
   * Affiche, selon si le commentaire a été signalé ou pas, un bouton de signalement ou un message notifiant son signalement.
   * @return string   Bouton ou message
   */
  public function getReportButton(){
    if($this->reported == 0){
      return ' <a class="btn btn-danger pull-right" href="index.php?page=logged.comments.report&id=' . $this->id . '">Signaler</a>';
    }
    return ' <p class="pull-right"><strong>Commentaire signalé</strong><br>En attente de modération</a>';
  }

  /**
   * Affiche, si le commentaire a été signalé, un bouton pour annuler ledit signalement.
   * @return string Bouton d'annulation de signalement
   */
  public function getunReportButton(){
    if($this->reported == 1){
      return '<a class="btn btn-warning" href="index.php?page=admin.comments.unreport&amp;id=' . $this->id . '">Annuler signalement</a>';
    }
  }

  /**
   * Affiche, si le commentaire a été signalé, une icône.
   * @return string icône notifiant le signalement
   */
  public function getReportedIcon(){
    if($this->reported > 0){
      return 'X';
    }
  }

  /**
   * Affiche, si le commentaire a été signalé, une message le notifiant.
   * @return string Message notifiant le caractère signalé du message 
   */
  public function getReportedMessage(){
    return '<p class="alert alert-warning"><em>Commentaire signalé</em></p>';
}







}
