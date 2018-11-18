<?php
namespace Oquiz\Controllers;
use Oquiz\Models\QuizModel;
use Oquiz\Models\UserModel;
use Oquiz\Utils\User;

class UserController extends CoreController{

	public function profile(){

		$quizzes =QuizModel::findAll();


         echo $this->templates->render('main/home', [
             'quizzes'=>$quizzes,
             ]) ;
	}

    public function signin(){

        echo $this->templates->render('user/signin');
    }

    public function signinPost(){
         // On sauvegarde la liste des erreurs dans un tableau
        $errorList = array();


        // Je récupère les données
        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $password = isset($_POST['password']) ? trim($_POST['password']) : '';


        // Je valide les données
        if (empty($email)) {
            $errorList[] = 'L\'adresse email doit être renseignée';
        }
        // Vérfification par un filtre de PHP que l'email est correct
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $errorList[] = 'L\'adresse email n\'est pas correcte';
        }
        if (empty($password)) {
            $errorList[] = 'Le mot de passe doit être renseigné';
        }
        // Si tout est ok (aucune erreur)
        if (count($errorList) == 0) {
            // Je récupère le user correspondant au mot de passe
            // la méthode renvoie false si aucun résultat
            $userModel = UserModel::findByEmail($email);

                    // Si j'ai un résultat sous forme d'objet
            if ($userModel !== false) {
                // Alors je test le mot de passe
                if (password_verify($password, $userModel->getPassword())) {
                    // On stocke le user en session


                    // $_SESSION['user'] = $userModel;
                    User::setUser($userModel);
                     // On affiche un JSON disant que tout est ok
                    $this->sendJSON([
                        'code' => 1,
                        'url' => $this->redirectToRoute('home')
                    ]);
                   
                }
                else {
                    $errorList[] = 'Le mot de passe est incorrect pour cet email';
                }
            }
            else {
                $errorList[] = 'Aucun compte n\'a été trouvé pour cet email';
            }
        }
        // J'envoie (j'affiche) les erreurs au format JSON
        $this->sendJSON([
            'code' => 2,
            'errorList' => $errorList,
            //'url' => $this->redirectToRoute('signin')
        ]);
    }

	public function signout(){
		if (User::isConnected()){
            unset($_SESSION['user']);
			session_destroy();
			$this->redirectToRoute('home');
		} else {
			$this->redirectToRoute('signin');
		}

	}


}
