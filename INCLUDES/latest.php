<?php 
require("./INCLUDES/ar.php");
require("./INCLUDES/connect.php");

try{
    if(isset($_POST['getNews'])){
        
    $prepare=$con->prepare("select * from services");
    if($prepare->execute()){
        $result=$prepare->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
    }
}

}catch(PDOException $e){

}

// try{
  
        
//     $prepare=$con->prepare("select * from projects");
//     if($prepare->execute()){
//         $result=$prepare->fetchAll(PDO::FETCH_ASSOC);
//         echo ( json_encode( $result));
//     }


// }catch(PDOException $e){

// }