<?php
require_once __DIR__.'/../models/mainModel.php';    
class NewsModel extends MainModel{
    function getNews(){
        $request = "SELECT * FROM `news`";
        $news = $this->request($request);
        return $news;
    }


    function getNewsById($id){
        $request = "SELECT * FROM `news` WHERE `id` = $id";
        $new = $this->request($request);
        return $new;
    }

    function getParagraphsByNewsId($id){
        $request = "SELECT * FROM `newsparagraph` WHERE `news_id` = $id";
        $paragraphs = $this->request($request);
        return $paragraphs;
    }

}