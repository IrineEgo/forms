<?php   
    $allTests = glob('tests/*.json');
    if (isset($_GET['number']) === false || $_GET['number'] == '' || $_GET['number'] > count($allTests)-1) {
        header('Location: list.php');
        exit;
    }
    
    // Получаем файл с номером из GET-запроса
    $allTests = glob('tests/*.json');
    $number = $_GET['number'];
    
    /////////////////////   
    $answers = []; 
    if(isset($_POST['answers']))
        $answers = $_POST['answers'];
   
    $test = file_get_contents($allTests[$number]);
    $test = json_decode($test, true);

    $correct_answers = 0;    
?>

<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title>ТЕСТ</title>
    <style type="text/css">
        .green { color:green; }
        .red { color:red; }
    </style>
  </head>
  <body>   
    <a href="list.php"><< НАЗАД</a><br>
	
        <?php if(count($answers) < 3):?>
            Должны быть решены все задания!            
        <?php endif?>    
    
        <form method="POST">           
            <h1><?php echo $test['name'] ?></h1>           
            <?php foreach($test['questions'] as $qkey => $item):  ?>          
            <fieldset>
                <legend><?php echo $item['question'] ?></legend>              
                <?php foreach($item['answers'] as $value => $answer): ?>
                    <label>
                        <input type="radio" name="answers[<?=$qkey?>]" value="<?=$value?>" required <?php if(isset($answers[$qkey]) && $value == $answers[$qkey]):?> checked <?php endif;?>>
                        <?php echo $answer ?>
                    </label><br>              
                <?php endforeach; ?>

                <?php if(isset($answers[$qkey])): ?>
                <?php if($item['correct_answer'] == $answers[$qkey]) $correct_answers++; ?>    
                
                <p class="<?php if($item['correct_answer'] == $answers[$qkey]):?>green<?php else:?>red<?php endif?>">
                    Правильный ответ: <i><?=$item['answers'][$item['correct_answer']]?></i>
                </p>
                
                <?php endif?>  
				
            </fieldset>
            
            <?php endforeach; ?>
            <br>
            <br>
            <input type="submit" name="check-test" value="Результат">
        </form>
    

    <!-- Проверка результатов теста -->
    <div>
        <?php if (isset($_POST['check-test'])): ?>
        <br><br>Всего правильных ответов: <?=$correct_answers?>
        <?php endif;?>
    </div>
  </body>
</html>
