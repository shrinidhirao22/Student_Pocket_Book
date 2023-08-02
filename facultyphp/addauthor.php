<?php
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_email']))
{
    /*Database Connection*/
    include "../connection.php";

    //checks if author name is submitted
    if(isset($_POST['author_name']))
    {
        //Get data from POST request and store it in variable
        $name=$_POST['author_name'];
        if(preg_match('/^([^0-9]*)$/',$name))
        {
            //Inserting into Database
            $sql="insert into author(author_name,faculty_id) values (?,?)";
            $stmt=$conn->prepare($sql);
            $res=$stmt->execute([$name,$_SESSION['user_id']]);

            //If there is no error while inserting the data
            if($res)
            {
                $_SESSION['success']="Added New Author Successfully.....";
                header("Location: ../faculty/facultydashboard.php");
                exit;
            }
            else
            {
                $_SESSION['failed']="Unknown Error occured!!!";
                header("Location: ../faculty/facultydashboard.php");
                exit;
            }
        }
        else
        {
            $_SESSION['failed']="Please Enter Valid Author name!!!";
            header("Location: ../faculty/facultydashboard.php");
            exit;
        }
    
        
    }
    else
    {
        header("Location: ../faculty/facultydashboard.php");
        exit;
    }
}
?>
