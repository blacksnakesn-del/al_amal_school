
<?php

require_once dirname(__DIR__) . '/models/auth.models.php';
require_once dirname(__DIR__) . '/core/sessionmanager.php';

function login() {
    $error = '';
    $oldEmail = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $oldEmail = $email;

        if ($email === '' || $password === '') {
            $error = 'Veuillez saisir votre email et votre mot de passe.';
        } else {
            $user = authenticateUser($email, $password);
            if ($user !== false) {
                set_session('user', [
                    'id' => $user['id'] ?? null,
                    'email' => $user['email'] ?? '',
                    'name' => $user['name'] ?? $user['email'] ?? ''
                ]);

                header('Location: /');
                exit();
            }

            $error = 'Identifiants invalides, veuillez réessayer.';
        }
        
    }

    require_once dirname(__DIR__) . '/views/login.html.php';
}

function logout() {
    destroy_session();
    header('Location: /login');
    exit();
    
}

?>