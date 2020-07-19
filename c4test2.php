<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<table border="1px">
    <tr>
        <td>id</td>
        <td>название прибора</td>
        <td>номер</td>
        <td>дата поверки</td>
        <td>примечание</td>
    </tr>
    
    <?php

    require 'rb.php';
    R::setup('mysql:host=localhost;dbname=test', 'echo', 'Jerome112');
    if (!R::testConnection())
    R::dispense('testlist3');
    for($i=1;$i<=46;$i++){
            $req=R::load('testlist3',$i);

    ?>

        <tr <?php
        if($req->sost==1){
            print("class=\"powern\"");
        }
        else
        if(date("n",strtotime($req->nextdatep))==date("n")){
                print("class=\"new\"");
            }?> >
            <form action="c4test.php" method="post">
            <td><?php echo $req->id; ?></td>
            <td><?php echo $req->name ;?></td>
            <td><?php echo $req->num; ?></td>
            <td><?php echo "c ".$req-> datep." до ".date("m.Y",strtotime($req-> nextdatep));?></td>
            <td><?php echo $req-> exet;?></td>
            <td>
                        <input type="checkbox" name="check<?php print("$i"); ?>">
                        <input type="submit" value="Отправить">
                    </td>
        </tr>
<?php

if (isset($_POST["check$i"]) && $_POST["check$i"]) {
    $us=R::load('testlist2',$i);
    $us->sost=1;
    R::store($us);
    
}

}
?></form>
    </table>
</body>
</html>
