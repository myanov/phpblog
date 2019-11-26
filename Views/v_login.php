<p style="color: red;"><?= $msg ?></p>
<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
    <label for="name">Login</label>
    <input type="text" id="name" name="name" value="<?= $name ?>">
    <label for="password">Password</label>
    <input type="password" id="password" name="password"><br>
    <label for="check">Запомнить меня</label>
    <input type="checkbox" name="check" id="check"><br>
    <input type="submit" value="Login">
</form>