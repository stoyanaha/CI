<!DOCTYPE HTML>
<html lang = "de">
    <head>
        <!--header.html -->
        <title>Ändere diesen Titel </title>
        <meta charset = "UTF-8" />
    </head>
    <body>
        <h1>Bücher-Liste</h1>


        <table>
            <tr>

<!-- <a href="http://localhost/moi/CI/CI//bucher/display/Buchtitel/  -->
                
                <th>
                   Buchtitel </th>
                   
                <th>Untertitel</th>
                <th>Herausgeber</th>
                <th>Verlag</th>
                <th>Jahr</th>
            </tr>


<?php
if (is_array($rows) && count($rows) > 0) {

    foreach ($rows as $v) {
        ?>
                    <tr>
                        <td><?php echo $v->Buchtitel; ?></td>
                        <td><?php echo $v->Untertitel; ?></td>
                        <td><?php echo $v->Herausgeber; ?></td>
                        <td><?php echo $v->Verlag; ?></td>
                        <td><?php echo $v->Jahr; ?></td>
                    </tr>

        <?php
    }
}
?>

        </table>

        <div id="pagination">

<?php
if (isset($pagination)) {
    echo $pagination;
} else {
    echo 'keine pagginaltion verhanden';
}
?>
        </div>





    </body>
</html>
