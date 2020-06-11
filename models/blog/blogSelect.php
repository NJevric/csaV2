<?php

if(isset($_GET['id'])){

    $id=$_GET['id'];

    $queryBlog="SELECT * FROM news WHERE id_news=?";
    $resultBlog=$conn->prepare($queryBlog);

    try{
        if($resultBlog->execute([$id])){
            $code=200;
        }
        else{
            $code=422;
        }
    }

    catch(PDOException $e){
        $code=500;
        $error=["errorMsg"=>$e->getMessage()];
        errorLog($e->getMessage());
    }
   
}

?>