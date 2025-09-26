<?php
namespace App\Controllers\Admin;
use App\Models\Tag;
class TagAdminController {
  public function index(){
    \requireRole(['admin','author']);
    $tags=(new Tag())->all(); render('admin/tags-index', compact('tags'));
  }
  public function store(){
    \requireRole(['admin','author']);
    $name=trim($_POST['name']??''); if(!$name){ return redirect('/admin/tags'); }
    (new Tag())->create($name, slugify($name));
    $_SESSION['flash']=['type'=>'success','msg'=>'Tag créé']; return redirect('/admin/tags');
  }
  public function destroy($id){
    \requireRole(['admin']); (new Tag())->delete((int)$id);
    $_SESSION['flash']=['type'=>'success','msg'=>'Tag supprimé']; return redirect('/admin/tags');
  }
}
