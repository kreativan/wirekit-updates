<?php
/**
 *  Ajax Actions
 *  @author Ivan Milincic <kreativan.dev@gmail.com>
 *  @link http://www.kraetivan.dev
*/

$ajax_bulk = $this->input->get->ajax_bulk;

if($ajax_bulk) {

  // disable all notice for ajax actions
  // to prevent errors and return fails
  @error_reporting(E_ALL ^ E_NOTICE);

  // Get the pages
  $ids = $this->input->post->admin_items;
  $items = $this->pages->find("id=$ids, include=all");
  if($items->count < 1) exit();


  //
  //  Publish
  //

  if($ajax_bulk == "publish") {

    foreach($items as $p) {
      if($p->isUnpublished()) {
        $p->of(false);
        $p->removeStatus('unpublished');
        $p->save();
        $p->of(true);
      } else {
        $p->of(false);
        $p->status('unpublished');
        $p->save();
        $p->of(true);
      }
    }

    exit();

  }

  //
  //  Hide
  //

  if($ajax_bulk == "hide") {

    foreach($items as $p) {
      if($p->isHidden()) {
        $p->of(false);
        $p->removeStatus('unpublished');
        $p->save();
        $p->of(true);
      } else {
        $p->of(false);
        $p->status('unpublished');
        $p->save();
        $p->of(true);
      }
    }

    exit();

  }

  //
  //  Trash
  //

  if($ajax_bulk == "trash") {

    foreach($items as $p) $p->trash();
    exit();

  }

  //
  //  Delete
  //

  if($ajax_bulk == "delete") {
    
    foreach($items as $p) $this->pages->delete($p);
    exit();

  }

  //
  //  Restore
  //
  if($ajax_bulk == "restore") {

    foreach($items as $p) $this->pages->restore($p);
    exit();

  }

}