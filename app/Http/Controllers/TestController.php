<?php
/**
 * Created by PhpStorm.
 * User: vanth
 * Date: 6/3/2019
 * Time: 11:12 PM
 */

namespace App\Http\Controllers;
include('../app/crawl/simple_html_dom.php');

class TestController
{
    public function test()
    {
        $html = file_get_html('https://viblo.asia/p/crawl-du-lieu-tu-web-su-dung-php-ORNZq3DN50n')->plaintext;
        echo($html);
    }
    public function test1()
    {
        $html = file_get_html('https://viblo.asia/p/crawl-du-lieu-tu-web-su-dung-php-ORNZq3DN50n');
        foreach($html->find('article.post-content') as $article) {
            $item['title']     = $article->find('h1.article-content__title', 0)->plaintext;
            $item['intro']    = $article->find('div.md-contents', 0)->plaintext;
            $articles[] = $item;
        }
        var_dump($articles);
    }
}
