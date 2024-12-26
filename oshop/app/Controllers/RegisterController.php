<?php

class RegisterController {
    public function store() {
        $config = parse_ini_file(__DIR__ . '/../Config/config.ini', true);

        try {
            $dsn = "pgsql:host={$config['database']['host']};port={$config['database']['port']};dbname={$config['database']['name']}";
            $pdo = new PDO($dsn, $config['database']['username'], $config['database']['password']);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }

        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($username) || empty($email) || empty($password)) {
            die("Tous les champs sont obligatoires.");
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        try {
            $stmt = $pdo->prepare('INSERT INTO users (username, email, password) VALUES (:username, :email, :password)');
            $stmt->execute([
                'username' => $username,
                'email' => $email,
                'password' => $hashedPassword,
            ]);

            session_start();
            $_SESSION['success_message'] = "Votre compte a été créé avec succès. Vous pouvez maintenant vous connecter.";
            header('Location: /oshop/public/login');
            exit;
        } catch (PDOException $e) {
            die("Erreur lors de la création du compte : " . $e->getMessage());
        }
    }
}