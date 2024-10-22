<?php
    include('../common/connection.php');
    $term=$_POST['term'];
    $sql="select title from blogs where title like '".$term."%'";
    $result=mysqli_query($connect,$sql);

    $output='';

    while($data=mysqli_fetch_array($result))
    {
        $output.="<li onclick='putdata(this.innerHTML)'>".$data['title']."</li>";
    }
    echo $output;
?>