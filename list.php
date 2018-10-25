<?php
    $allFiles = glob('tests/*.json');
?>

<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title>Список тестов</title>
  </head>
  <body>
    <a href="admin.php"><div><< НАЗАД</div></a>
    <hr>
    <h2>Список тестов:</h2>
    <?php if (!empty($allFiles)): ?>
        <?php foreach ($allFiles as $file): ?>
            <div>
                <h3><?php echo str_replace('tests/', '', $file); ?></h3><br>
                <a href="test.php?number=<?php echo array_search($file, $allFiles); ?>">ПРОЙТИ ТЕСТ >></a>
            </div>
            <hr>
        <?php endforeach; ?>
    <?php endif; ?>
    <?php if (empty($allFiles)) echo 'Нет ни одного теста!';?>	
  </body>
</html>
