<?php
if(!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])){
    require_once 'inc/functions.php';
    require_once 'inc/db.php';
    $req = $pdo->prepare('SELECT * FROM users WHERE (username = :username OR email = :username) and statu = :statu ');
    $req->execute(['username' => $_POST['username'],
                    'statu' =>$_POST["statu"]]);
    $user = $req->fetch();
    if(password_verify($_POST['password'], $user->password)){
        $_SESSION['auth'] = $user;
        print_r($_SESSION);
        if(!empty($_SESSION['auth']) && $_SESSION['auth']->statu=='Admin'){
            header("Location:acc.php");
                        }
                        else{
                            header("Location:../../website/index.php");
                        }
$_SESSION['flash']['success'] = 'Vous êtes maintenant connecté';
exit();
}else{
    header('location:login.php');
        $_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorrecte';

    }
}
?>

 

<?php require './inc/header.php'; ?>

    <h1>Se connecter</h1>

    <form action="" method="POST">

        <div class="form-group">
            <label for="">Pseudo ou email</label>
            <input type="text" name="username" class="form-control"/>
        </div>
        <div id="form-group">
        <input type="text" placeholder="Status"  name="statu" class="form-control" list="status"/>
        <datalist id="status">
        <option value="Admin"/>
        <option value="User"/>
        </datalist>
    </div>
        <div class="form-group">
            <label for="">Mot de passe <a href="forget.php">(J'ai oublié mon mot de passe)</a></label>
            <input type="password" name="password" class="form-control"/>
        </div>

        <div class="form-group">
            <label>
                <input type="checkbox" name="remember" value="1"/> Se souvenir de moi
            </label>
        </div>

        <button type="submit" class="btn btn-primary">Se connecter</button>

    </form>

<?php require './inc/footer.php'; ?>