<?php
require_once "./app/controllers/mainController.php";
require_once "./app/models/newsModel.php";

class NewsController  extends MainController {
    function getNews(){
        $model = new NewsModel();
        $news = $model->getNews();
        return $news;
    }

    function getNewsById($id){
        $model = new NewsModel();
        $new = $model->getNewsById($id);
        return $new;
    }

    function getParagraphsByNewsId($id){
        $model = new NewsModel();
        $paragraphs = $model->getParagraphsByNewsId($id);
        return $paragraphs;
    }   
    
}