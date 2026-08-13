
<?php

require_once dirname(__DIR__) . '/core/database.php';
require_once dirname(__DIR__) . '/core/sessionmanager.php';

function authenticateUser(string $email, string $password) {
    $connexion = connexionDB();
    $sql = 'SELECT * FROM users WHERE email = :email LIMIT 1';
    $statement = prepare($connexion, $sql, ['email' => $email]);
    $user = $statement->fetch();

    if ($user === false) {
        return false;
    }

    if (isset($user['password']) && password_verify($password, $user['password'])) {
        return $user;
    }

    if (isset($user['password']) && $user['password'] === $password) {
        return $user;
    }

    return false;
}

function addConnexion() {
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'];

        if(!empty($email) && !empty($password)) {
            $user = authenticateUser($email, $password);

            if($user !== false) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['nom'] = $user['nom'];
                $_SESSION['prenom'] = $user['prenom'];

                header('Location: http://localhost:5001/accueil');
                exit();
            }
        }
        header('Location: /login.php?error=invalid_credentials');
        exit();
    }
}


?>
