<?php
    $pageTitle = 'List';
    include 'header.php';
?>
<a href="form.php">Add new cost</a>
<form method="GET">
    <select name="filter">
        <option value="0">All</option>
        <?php
            foreach ($typeCosts as $key => $value) {
                echo '<option ';
                if(isset($_GET['filter'])&& $_GET['filter']==$key)
                {
                    echo ' selected ';
                }
                echo 'value="'.$key.'">'.$value.'</option>';
            }
        ?>
    </select>
    <input type="submit" value="Filter" />
</form>
<table border="1">
    <tr>
        <td>Date</td>
        <td>Cost name</td>
        <td>Price</td>
        <td>Type</td>
    </tr>
    <?php
        if(file_exists('data.txt')){
            $result=file('data.txt');
            $sum=0;
            foreach($result as $value){
                $columns=explode('!',$value);
                if(isset($_GET['filter'])&& $_GET['filter']>0 && (int)$_GET['filter']!=(int)$columns[3])
                {
                    continue;
                }
                echo '<tr>
                        <td>'.$columns[0].'</td>
                        <td>'.$columns[1].'</td>
                        <td>'.number_format($columns[2],2,'.','').'</td>
                        <td>'.$typeCosts[trim($columns[3])].'</td>
                    </tr>';
                $sum+=$columns[2];
           
            }
        }
    ?>
    <tr>
        <td>---</td>
        <td>---</td>
        <td><?= number_format($sum,2,'.','');?></td>
        <td>---</td>
    </tr>
</table>

<?php
    include 'footer.php';
?>