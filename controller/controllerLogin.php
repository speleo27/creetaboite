<?php


//var_dump($_POST);

if(isset($_POST['connectbtn']))
{
    
    $email=filter_var($_POST['connect_email'],FILTER_VALIDATE_EMAIL);
    //$email='seb@orange.fr';
    //var_dump($email);
    if($email === false){
        header('Location:../index.php');
        die();
    }
        include '../setting.php';
        include ('connectbdd.php');
        $req=$bdd->prepare('SELECT * FROM connect WHERE connect_email=? LIMIT 1');
        $req->execute(array(
        $email
    ));
        
        $data= $req->fetch(PDO::FETCH_ASSOC);

        $emaildb=$data['connect_email'];
        $guizmodb=$data['guizmo'];
        $guizmoSend=$_POST['guizmo'];
       //echo password_hash('test123', PASSWORD_BCRYPT);
        //var_dump($guizmodb);
        //var_dump($guizmoSend);

       // var_dump($emaildb);
       // var_dump($email);

        if($email == $emaildb)
        {
            //var_dump(password_verify($guizmoSend,$guizmodb));

            if(password_verify($guizmoSend,$guizmodb))
            {
                session_start();
               
                $_SESSION['auth']=$data;
                $_SESSION['auth']['admin']=intval($data['admin']);
                unset($_SESSION['auth']['guizmo']);
                //var_dump($_SESSION);
                // var_dump($_SESSION);
                // var_dump($_SESSION['auth']['admin']);
                // die();
                if($_SESSION['auth']['admin'] ==  1 )
                {
                   // echo 'connecter en admin';
                    header('Location:../dashboard.php');

                }
                else
                {
                    // var_dump($_SESSION);
                    // die();
                    //echo 'connecter en user';
                    header('Location:../accueil');
                }
                    
            }
            else
            {
                header('Location:../accueil');
            }
        }
        else
        {
            header('Location:../accueil');
        }
   
}



 

       






  