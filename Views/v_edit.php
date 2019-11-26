<form method="post">
    Название<br>
    <input type="text" name="title" value="<?= $result['title'] ?>"><br>
    Контент<br>
    <textarea name="content" rows="12" cols="120"><?= $result['content'] ?></textarea><br>
    <input type="submit" value="Добавить">
</form>
<p style="color: red;"><?= $msg ?? '' ?></p>
