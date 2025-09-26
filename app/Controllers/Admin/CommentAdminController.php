<?php
namespace App\Controllers\Admin;
use App\Models\Comment;
class CommentAdminController {
  public function index(){
    \requireRole(['admin','author']);
    $status=$_GET['status']??'pending';
    $comments=(new Comment())->listByStatus($status);
    render('admin/comments-index', compact('comments','status'));
  }
  public function setStatus($id){
    \requireRole(['admin','author']);
    $status=in_array($_POST['status']??'', ['approved','pending','spam'], true) ? $_POST['status'] : 'pending';
    (new Comment())->setStatus((int)$id, $status);
    $_SESSION['flash']=['type'=>'success','msg'=>'Statut mis à jour']; return redirect('/admin/comments');
  }
}
