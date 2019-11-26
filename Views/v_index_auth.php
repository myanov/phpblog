<? foreach($news as $article): ?>
    <a href="<?= ROOT . 'article/' ?><?=$article['id']?>"><?=$article['title']?> | </a>
    <a href="<?= ROOT . 'article/edit/' ?><?=$article['id']?>" style='font-size: 12px;'>Редактировать | </a>
    <a href="<?= ROOT . 'article/delete/' ?><?=$article['id']?>" style='font-size: 12px;'>Удалить</a><br>
<? endforeach; ?>
<hr>
<a href="<?= ROOT . 'article/add' ?>">Добавить</a>
<a href="<?= ROOT . 'user/logout' ?>">Выйти</a>
