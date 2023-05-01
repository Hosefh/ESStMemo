<?php
    session_start();
    include "dbcon.php";
    include_once "loading.php";
    if (isset($_POST['username']) && isset($_POST['user_password']))
    {
        // if (isset($_POST['account']))
        // {
            function validate($data){
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            $username = validate($_POST['username']);
            $password = validate($_POST['user_password']);
            $privilege = validate($_POST['account']);

            $sql = "SELECT * FROM users WHERE username='$username' and `password`='$password';";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) === 1)
            {
                $row = mysqli_fetch_assoc($result);
                // $password = md5($password);
                if($row['username'] === $username && $row['password'] === $password){
                    // if($row['privilege'] === $privilege)
                    // {
                        echo "Logged IN";
                        $_SESSION['useridname'] = $row['employee_name'];
                        $_SESSION['username'] = $row['username'];
                        if($row['privilege']==="admin")
                        {
                            header("Location: admin/index.php");
                        }
                        else
                        {
                            header("Location: faculty/index.php");
                        }
                    // }
                    // else
                    // {
                    //     echo "<script>
                    //     alert('Invalid Account Privilege');
                    //     window.location.href='index.php';
                    //     </script>";
                    // }
                }
            } 
            else{
                echo "<script>
                alert('NO Account Registered under said credentials.');
                window.location.href='index.php';
                </script>";
            }
        // }
        // else
        // {
        //     echo "<script>
        //     alert('Please Choose Account Privilege');
        //     window.location.href='index.php';
        //     </script>";
        // }

    }
?>