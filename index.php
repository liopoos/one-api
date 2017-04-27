<?php
$type = $_GET['type'];
$date = $_GET['date'];
$value = $_GET['value'];
if (!isset($type)) {
    $type = 'json';
}
if (!isset($date)) {
    $date = 0;
}
if (!isset($value)) {
    $value = 1;
}
get_result($date, $type, $value);
function get_result($date, $type, $value)
{
//准备对接
    header('Content-type: application/x-javascript');
    header("Content-type: text/html; charset=utf-8");
//对接完成
//准备接收数据
    $url = 'http://wufazhuce.com';//one一个url
    $data = get_file($url);
//数据接收完成
//准备分析数据
    $article_url = $article_url[0][$date];
    $article_data = get_file($article_url);
    preg_match('/(?<=<h2 class="articulo-titulo">).*?(?=<\/h2>)/si', $article_data, $article_title);//匹配文章标题
    preg_match('/(?<=<p class="articulo-autor">).*?(?=<\/p>)/si', $article_data, $article_autor);//匹配文章作者
    preg_match('/(?<=<div class="articulo-contenido">).*?(?=<\/div>)/si', $article_data, $article_content);//匹配文章内容

    $question_url_num = preg_match_all('/(http:\/\/wufazhuce.com\/question\/\d{4})/si', $data, $question_url);//匹配文章url
    $question_url = $question_url[0][$date];
    $question_data = get_file($question_url);
    preg_match('/(?<=<h4>).*?(?=<\/h4>)/si', $question_data, $question_title);//匹配问答标题
    preg_match_all('/(?<=<div class="cuestion-contenido">).*?(?=<\/div>)/si', $question_data, $question_qa);//匹配文章作者


//数据分析完成
//准备连接数据库
//准备处理数据
    if ($type == 'json') {
        $result = array();
        $result['code'] = 1;
        if ($value == 0) {
            $result['titulo_title'] = $title[0][$date];
            $result['titulo_img_url'] = $img_url[0][$date];
            $result['titulo_img_title'] = $img_title[0][$date];
            $content = preg_replace('/<br \/>/', '', $content[0][($date * 2) + 1]);
            $result['titulo_content'] = $content;
            $result['article_title'] = $article_title[0];
            $result['article_autor'] = $article_autor[0];
            $result['article_content'] = $article_content[0];
            $result['question_title'] = $question_title[0];
            $result['question_q'] = $question_qa[0][0];
            $result['question_a'] = $question_qa[0][1];
        } elseif ($value == 1) {
            $result['titulo_title'] = $title[0][$date];
            $result['titulo_img_url'] = $img_url[0][$date];
            $result['titulo_img_title'] = $img_title[0][$date];
            $content = preg_replace('/<br \/>/', '', $content[0][($date * 2) + 1]);
            $result['titulo_content'] = $content;
        } elseif ($value == 2) {
            $result['article_title'] = $article_title[0];
            $result['article_autor'] = $article_autor[0];
            $result['article_content'] = $article_content[0];
        } elseif ($value == 3) {
            $result['question_title'] = $question_title[0];
            $result['question_q'] = $question_qa[0][0];
            $result['question_a'] = $question_qa[0][1];
        } else {
            $code['code'] = -2;
            $code['status'] = 'parameter[value] error';
            echo json_encode($code);
        }

        echo json_encode($result);
    } else {
        $code['code'] = -2;
        $code['status'] = 'parameter[type] error';
        echo json_encode($code);
    }
}



//数据处理完成
function get_file($url)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $data = curl_exec($curl);
    curl_close($curl);
    return $data;
}

//对接成功
?>
