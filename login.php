<?php
session_start();

require('INCLUDES/connect.php');

$errors = array(
    'global' => '',
    'email' => '',
    'password' => ''
);

$values = array(
    'email' => null,
    'password' => null,
);
if (isset($_POST['submit'])) {
    if (empty($_POST['email'])) {
        $errors['email'] = 'Required*';
    } else {
        $values['email'] = htmlspecialchars($_POST['email']);
    }

    if (empty($_POST['password'])) {
        $errors['password'] = 'Required*';
    } else {
        $values['password'] = sha1(htmlspecialchars($_POST['password']));
    }

    if (!empty($values['email']) || empty($values['password'])) {

        try {
            $prepare = $con->prepare("SELECT * FROM users WHERE email=?  AND password=? ");
            $prepare->execute(array($values['email'], $values['password']));
            $count = $prepare->rowCount();
            $result = $prepare->fetchAll(PDO::FETCH_ASSOC);

            if ($count > 0) {

                
                $userId = $result[0]['id'];
                $userGroup = $result[0]['userGroup'];

                $_SESSION['userId'] = $userId;
                $_SESSION['userGroup'] = $userGroup;


                if ($userGroup == 1) {
                    $prepareLog=$con->prepare('Insert into log (userId,time,message)Values(?,now(),?)');
                    if($prepareLog->execute(array($userId,'in'))){
                        header("Location:Admin/cover.php");
                    }
                } elseif ($userGroup == 0) {
                    $prepareLog=$con->prepare('Insert into log (userId,time,message)Values(?,now(),?)');
                    if($prepareLog->execute(array($userId,'in'))){
                        header("Location:AdminPages/index.php");
                    }
                }
            } else {
                $errors['global'] = 'Incorrect email or password';
            }
        } catch (PDOException $e) {
        }
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- <link rel="stylesheet" href=<?php //echo $cssHome . "admin_style.css" 
                                        ?>> -->
    <link rel="stylesheet" href="CSS/userInformations.css">
</head>

<body>

    <section class="msection">
        <div class="overlay"></div>
        
        <div class="container">
            <h3>login</h3>
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" autocomplete="off">
                <span style="color: red; display:inline-block;"><?php echo $errors['global']; ?></span>
                <input type="email" name="email" placeholder="enter your email" required class="box">
                <input type="password" name="password" placeholder="enter your password" required class="box">
                <input type="submit" name="submit" value="Login" class="btn">
            </form>
        </div>

    </section>
</body>

</html>