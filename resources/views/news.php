<?php 

foreach ($newsList as $key => $news) {
    $key++;
    echo "<h2> {$news} </h2> <a href='".route('news.show', ['id' => $key])."'> show </a>";
}
