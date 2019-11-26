<? foreach($news as $article): ?>
    <a href="<?= ROOT . 'article/' ?><?=$article['id']?>"><?=$article['title']?></a><br>
<? endforeach; ?>
<hr>
<a href="<?= ROOT . 'login' ?>">Войти</a>
