<?php
$pageTitle='Add new cost';
include 'header.php';

if($_POST)
{
    $costName=$_POST['costName'];
    $costName=trim($costName);
    $costName=str_replace('!','',$costName);
    $price=(float)(str_replace(',','.',$_POST['price']));
    $selectedType=(int)$_POST['typeCost'];
    $today= date('d.m.Y',$timestamp=time());  
    $error=false;
    
    if(mb_strlen($costName)<3)
    {
       echo 'Too short name'; 
       $error=true;
    }
    if($price<=0){
        echo 'not valid number';
        $error=true;
    }
    if(!array_key_exists($selectedType, $typeCosts)){
        echo 'not valid type of cost';
        $error=true;
    }
    if(!$error)
    {
        $result = $today.'!'.$costName.'!'.$price.'!'.$selectedType."\n";
        if(file_put_contents('data.txt', $result, FILE_APPEND))
        {
           echo 'File was successfully saved.';
        }
    }
    
}

?>
<a href="index.php">List</a>
<form method="POST">
    <div>Cost name:<input type="text" name="costName" /></div>
    <div>Price:<input type="text" name="price" /></div>
    <div>Type:
        <select name="typeCost">
            <?php
                foreach ($typeCosts as $key => $value) {
                    echo '<option value="'.$key.'">'.$value.'</option>';
                }
            ?>
        </select>
    </div>
    <input type="submit" value="Add cost" />
</form>
<?php
include 'footer.php'
?>
