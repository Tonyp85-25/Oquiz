<?php
namespace Oquiz\Controllers;
use Oquiz\Models\QuizModel;
use Oquiz\Models\UserModel;
use Oquiz\Utils\User;

class UserController extends CoreController{

    
    
    /**
     * shows the user's profile page
     * @param  $params
     * @return void
     */
    public function profile($params){

       
        $id= (int) $params['id'];
        $user = UserModel::findById($id);
        
        $quizzes= QuizModel::findQuizzesByUser($id);


         echo $this->templates->render('user/profile', [
             'user'=>$user,
             'quizzes' =>$quizzes,
             ]) ;
	}

    /**
     * get the user connected
     *
     * @return void
     */
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
                        'url' => $_SERVER['BASE_URI']
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
            'errorList' => $errorList
            
        ]);
    }


    /**
     * déconnecte l'utilisateur
     *
     * @return void
     */
	public function signout(){
		if (User::isConnected()){
            unset($_SESSION['user']);
			session_destroy();
			$this->redirectToRoute('home');
		} else {
			$this->redirectToRoute('signin');
		}

    }
    
    /**
     * fonction qui permet l'inscription de l'utilisateur
     * 
     * @return void
     */
    public function signup() {
        // On sauvegarde la liste des erreurs dans un tableau
        $errorList = array();
        
        // Je distinggue le POST du GET
        if (!empty($_POST)) { // => POST
            // Je récupère les données
            $first_name= isset($_POST['first_name']) ? trim($_POST['first_name']) : '';
            $last_name= isset($_POST['last_name']) ? trim($_POST['last_name']) : '';
            $email = isset($_POST['email']) ? trim($_POST['email']) : '';
            $password = isset($_POST['password']) ? trim($_POST['password']) : '';
            $confirmPassword = isset($_POST['confirmPassword']) ? trim($_POST['confirmPassword']) : '';
            
            // Traiter les données
            $first_name = htmlentities($first_name); // encode les caractères HTML
            $last_name = htmlentities($last_name);
            // Je valide les données
            if (empty($first_name)) {
                $errorList[] = 'Le prénom doit être renseigné';
            }
            if (empty($last_name)) {
                $errorList[] = 'Le nom doit être renseigné';
            }

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
            if ($password != $confirmPassword) {
                $errorList[] = 'Les 2 mots de passe doivent être égaux';
            }
            if (strlen($password) < 8) {
                $errorList[] = 'Le mot de passe doit faire au moins 8 caractères';
            }
            
            // Si tout est ok (aucune erreur)
            if (count($errorList) == 0) {
                
                // on vérifie que email n'existe pas déjà
                if(!UserModel::findByEmail($email)){
                    // J'encode, je hash le mot de passe avant de le stocker en DB
                    $hash = password_hash($password, PASSWORD_DEFAULT);
                
                // Pour sauvegarder en DB, je dois d'abord créer le Model
                    $userModel = new UserModel();

                    $userModel->setFirstName($first_name);
                    $userModel->setLastName($last_name);
                    $userModel->setEmail($email);
                    $userModel->setPassword($hash);

                // Je peux sauvegarder le model
                    $insertedRows = $userModel->save();
                    if ($insertedRows > 0) {
                    // Je peux rediriger car tout est ok
                    $this->redirectToRoute('home');
                   
                    }
                    else {
                        $errorList[] = 'Erreur dans l\'ajout à la DB';
                    }

                } else {
                     $errorList[] = 'Erreur ce mail existe déjà';
                }
                
            } 
            
        }
         // J'affiche le rendu de ma template
         echo $this->templates->render('user/signup', [
            'errorList' => $errorList
        ]);
    }

}
