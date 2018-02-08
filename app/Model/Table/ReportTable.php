<?php
namespace App\Model\Table;

/**
 *
 * Modèle de table des signalements
 */
class ReportTable extends \Core\Model\Table\Table{



  /**
   * Récupère la somme des signalements liés au commentaire ayant l'id passé en paramètre.
   * @param  string   $id   Id du commentaire
   * @return int            Somme des signalements liés au post ayant l'id passé en paramètre
   */
  public function getAttachedReportSum($id){
    return $this->query("SELECT COUNT(*) FROM {$this->table} WHERE comment_id = ?",
    [$id],
    true);
  }

  /**
   * Affiche la somme des commentaires signalés liés à un post dont l'id est entré en paramètre;
   * l'affiche sous forme de lien si cette somme n'est pas nulle.
   * @param  int  $id           Id du post
   * @return string/int         Le nombre de commentaires signalés liés au post, sous forme de lien ou brut.
   */
  public function getReportedAttachedCommentSum($id){
    $AttachedCommentReports = $this->query("SELECT * FROM {$this->table} WHERE post_id = ?",
    [$id],
    false);

    $commentIds = [];
    $sum = 0;
    foreach($AttachedCommentReports as $report){
      if(!in_array($report->comment_id, $commentIds)){
        $commentIds[] = $report->comment_id;
        $sum++;
      }
    }
    if($sum == 0){
      return $sum;
    }
    else{
      return '<a href="index.php?page=admin.comments.reported&amp;id=' . $id . '">' . $sum . '</a>';
    }


  }

  /**
   * Affiche le cas échéant un message notifiant que le commentaire dont l'id est passé en paramètre a été signalé.
   * @param  string $id   Id du commentaire
   * @return string       Message notifiant que le commentaire dont l'id est passé en paramètre a été signalé ou null;
   */
  public function getAttachedReportMessage($id){
    if($this->getAttachedReportSum($id) == 0){
      return;
    }
    return '<p class="alert alert-warning">Ce commentaire a fait l\'objet d\'un signalement.</p>';
  }

  /**
   * Retourne la totalité des Id des commentaires signalés liés à un post dont l'id est récupéré en paramètre.
   * @param  int    $id   Id du post
   * @return array        Tableau comprenant la totalité des Id des commentaires signalés dudit post
   */
  public function getAllReportedAttachedCommentsId($id){
      $reports = $this->query("SELECT comment_id FROM {$this->table} WHERE post_id = ?", [$id], false);
      $commentIds = [];
      foreach($reports as $report){
        $commentIds[] = $report->comment_id;
      }
      return $commentIds;
  }

  /**
   * Affiche, si le commentaire dont l'id est passé en paramètre a été signalé, un bouton d'annulation de signalement.
   * @param  int    $commentId  Id du commentaire
   * @param  int    $postId     Id du post auquel le commentaire est lié
   * @param  string $originPage Nom de la page sur laquelle est inséré le bouton
   * @return string             Si le commentaire a été signalé, affiche un formulaire d'annulation de signalement dont seul le bouton de soumission est visible
   * et dont les champs cachés ont pour valeurs les paramètres entrés;
   */
  public function getUnReportButton($commentId, $postId, $originPage){

    if($this->query("SELECT COUNT(*) FROM {$this->table} WHERE comment_id = ?", [$commentId], true) === 0){
            return;
        }
    $unreportForm = '<form action="?page=admin.comments.unreport" method="post" style="display: inline;">';
    $unreportForm .= '<input type="hidden" name="commentId" value="' .  $commentId . '">';
    $unreportForm .= '<input type="hidden" name="postId" value="' . $postId .'">';
    $unreportForm .= '<input type="hidden" name="originPage" value="' . $originPage .'">';
    $unreportForm .= '<button type="submit" class="btn btn-warning "><i class="fas fa-flag"></i></button>';
    $unreportForm .=   '</form>';

    return $unreportForm;
  }

  /**
   * Crée un signalement lié aux valeurs entrées en paramètres en créant une nouvelle entrée dans le tableau "reports".
   * @param  array $values Tableau comprenant l'Id du commentaire à signaler, l'Id du post auquel il est lié et l'Id de l'utilisateur à l'origine de la requête
   * @return bool          True si la requête a fonctionné, false sinon
   */
  public function create($values){
    $values[] = $_SESSION['loggedAs'];
    return $this->query("INSERT INTO  " . $this->table . ' (comment_id, post_id, user_id) VALUES (?, ?, ?)', $values);
    }

  /**
   * Supprime tous les signalements liés au commentaire dont l'Id est entré en paramètre en supprimant les entrées correspondantes audit Id dans le tableau "reports".
   * @param  string $commentId   Id du commentaire
   * @return bool                True si la requête a fonctionné, false sinon
   */
  public function unreport($commentId){
    return $this->query("DELETE FROM " . $this->table . ' WHERE comment_id = ?', [$commentId]);
    }

  /**
   *  Affiche, si le commentaire dont l'id est passé en paramètre n'a pas été signalé par l'utilisateur dont l'Id est récupéré via la variable $_SESSION['loggedAs'], un bouton de signalement.
   * @param  int      $commentId  Id du commentaire
   * @param  int      $postId     Id du post
   * @return string               Si le commentaire n'a pas été signalé par l'autetr, affiche un formulaire de signalement dont seul le bouton de soumission est visible
   * et dont les champs cachés ont pour valeurs les paramètres entrés;
   */
  public function getReportButton($commentId, $postId){

    if($this->query("SELECT COUNT(*) FROM {$this->table} WHERE comment_id = ? AND user_id = ?", [$commentId, $_SESSION['loggedAs']], true) === 0){
      $reportForm = '<form action="?page=logged.comments.report" method="post">';
      $reportForm .= '<input type="hidden" name="commentId" value="' .  $commentId . '">';
      $reportForm .= '<input type="hidden" name="postId" value="' . $postId .'">';
      $reportForm .= '<button type="submit" class="btn btn-danger">Singaler</button>';
      $reportForm .=   '</form>';
      return $reportForm;
      }
      return '<p class=""><strong>Commentaire signalé</strong><br/>En attente de modération</p>';
  }

  /**
   * Supprime tous les signalements liés au post dont l'id est entré en paramètre en supprimant les entrées correspondantes dans la table "reports".
   * @param  int  $id   Id du post
   * @return bool       True si la requête a réussi, false sinon
   */
  public function deleteAttachedToPost($id){
      $this->query("DELETE FROM {$this->table} WHERE post_id = ?", [$id]);
  }

  }
