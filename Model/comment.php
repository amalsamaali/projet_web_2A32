<?php

class Commentaire{

    private $id_commentaire, $id_blog, $image_commentaire, $contenu_commentaire, $date_commentaire;

    public function __construct($id_commentaire, $id_blog, $image_commentaire, $contenu_commentaire, $date_commentaire)
    {
        $this->id_commentaire = $id_commentaire;
        $this->id_blog = $id_blog;
        $this->image_commentaire = $image_commentaire;
        $this->contenu_commentaire = $contenu_commentaire;
        $this->date_commentaire = $date_commentaire;
    }

    public function set_id_commentaire($val){
        $this->id_commentaire = $val;
    }

    public function get_id_commentaire(){
        return $this->id_commentaire;
    }

    public function set_id_blog($val){
        $this->id_blog = $val;
    }

    public function get_id_blog(){
        return $this->id_blog;
    }

    public function set_image_commentaire($val){
        $this->image_commentaire = $val;
    }

    public function get_image_commentaire(){
        return $this->image_commentaire;
    }

    public function set_contenu_commentaire($val){
        $this->contenu_commentaire = $val;
    }
    
    public function get_contenu_commentaire(){
        return $this->contenu_commentaire;
    }

    public function set_date_commentaire($val){
        $this->date_commentaire = $val;
    }

    public function get_date_commentaire(){
        return $this->date_commentaire;
    }
}

?>