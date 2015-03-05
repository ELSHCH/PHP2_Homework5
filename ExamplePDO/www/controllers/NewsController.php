<?php
/**
 * Created by PhpStorm.
 * User: shcheki
 * Date: 05.03.2015
 * Time: 08:55
 */

class NewsController
{
    public function actionOne()
    {
        $article = new NewsModel();
        $id = $_GET['id'];
        $article->findOneByPk($id);
        $article->display('news/one.php');
    }

    public function actionAll()
    {
        $article = new NewsModel();
        $article->findAll();
        $article->display('news/all.php');
    }
}