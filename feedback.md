# Feedback du prof

La plupart des commentaires ci-dessous sont des pistes pour améliorer encore la qualité de ton code ; à quelques exceptions près ça ne veut pas dire que ton code est faux dans l'absolu, juste que tu peux toujours optimiser, encore et encore. C'est ce qui différencie un bon ~~chasseur~~ développeur, d'un développeur !

## Etape 1 : La page d'accueil

### Enoncé

- Créer un model Quiz.php et ses propriétés, getters/setters
- Créer une méthode de récupération de tous les quizzes
- Mettre en place une route pour la home avec un controller adapté
- Template de liste des quizzes ...réutilisable sur la page "mon compte"

### Notions

- [x] Setup : config, altorouter, Plates, namespace
- [x] Route / et controller indexAction
- [x] Model pour le quiz
- [x] Méthode findAll
- [x] Template home/liste de quiz

### Commentaires

- Oulah, attention à ton .gitignore : certains fichiers ne sont vraiment pas censés être commités :scream: L'idéal serait de commit uniquement un config.dist.conf, de manière à indiquer aux personnes récupérant ton projet ce qu'ils doivent mettre dans la config, sans pour autant révéler ton config.conf qui ne devrait _jamais_ sortir de ton environnement.
- Pour les bonnes pratiques, l'idéal est de mettre le mot clef action dans la déclaration des noms de méthodes des controllers, car dans la plupart des framework celui ci est obligatoire (`IndexAction` par exemple)
- Certaines méthodes comme `findAll()` pouvant te servir ailleurs, tu peux l'abstraire dans un CoreModel (ce n'est pas obligatoire)
- Bien joué pour les requêtes. Pour être au top du top, tu peux aussi récupérer les quizzes et les informations de l'auteur simultanément, en une seule requête joignant quizzes et users. Moins de requêtes = meilleures performances :rocket:
- C'est bien d'avoir pensé à mettre le nom de la table dans une constante.





## Etape 2 : La consultation d'un quizz

### Enoncé

- Créer la page qui affiche le détail d'un quiz à partir de son id
- Créer un model pour les questions (propriétés, setters, getters, méthode de récupération des questions d'un quiz)
- Les titres de quizz renvoient vers la page détail nouvellement créée
- Les 4 propositions doivent être mélangées

### Notions

- [x] Route `/quiz/[id]` et controller
- [x] Méthode pour trouver le quiz demandé
- [x] Model pour les questions
- [x] Méthode pour récupérer les questions d'un quiz
- [x] Liens de la page liste vers la page détail
- [x] Shuffle sur les questions
- [x] Template détail de quiz

### Commentaires

- Bien le shuffle !
- Tes requêtes sont bonnes mais tu peux faire encore mieux : récupérer les niveaux directement dans ta requête qui va chercher les questions du quiz ! Join power. Moins de requêtes = meilleures performances :rocket:
- Puisque tu as mis la table "questions" en constante, autant le faire aussi pour la table "levels" :wink :
- Puisque tes réponses possibles sont dans un array, tu peux faire un foreach dessus pour les afficher. Just sayin' :smirk:








## Etape 3 : Login-logout

### Enoncé

- Les utilisateurs présents en base de données peuvent se connecter au site
- Un utilisateur ne peut pas se connecter avec des identifiants erronés
- Rediriger en page d'accueil un utilisateur à son authentification
- Différencier l'affichage de l'utilisateur connecté

### Notions

- [x] Routes login/logout et controller
- [ ] Redirections
- [x] Template et formulaire de la page de login
- [x] Modèle User
- [x] Gestion de sessions

### Commentaires

- L'authentification fonctionne bien, tu as juste oublié la redirection vers la home (j'ai le JSON qui s'affiche, à la place)
- la page « mon compte » n’était pas loin de fonctionner, il te manquait pour cela deux choses :
  - 1/ Passer le modèle à ton template dans la variable `quizz` comme ce que tu as fait pour la home et
  - 2/ Filtrer la liste des quizz pour n’avoir que ceux dont l’auteur est la personne connectée (dont tu peux obtenir l’id grâce à la méthode `getId()` de la classe `User`). Sinon la page fait doublon avec la page d’accueil, elle affiche tout.




## Etape 4 : Le système de quizz

### Enoncé

- Changer le template du quizz pour les connectés, sans changement de la route
- Créer un formulaire de quiz
- Vérifier la validité des réponses et y associer un code couleur
- Afficher l'anecdote + lien Wikipedia correspondant aux questions répondues

### Notions

- [x] Même route, affichage différent pour les loggués
- [x] Template et formulaire de quiz
- [x] Route `/quiz/[id]` en POST
- [ ] Méthode de traitement du résultat
- [ ] Visualisation du résultat + informations complémentaires

### Commentaires

- Presque, des petites erreurs sur le template du formulaire de question :
  - d’abord, il aurait fallut faire une boucle sur l’array de propositions, plutôt que de les afficher une par une (automatise au max, ça évite les erreurs et c’est d’avantage maintenable !)
  - ensuite, il y a un `checked` sur deux propositions qui ne devrait pas être là :smile:
  - enfin, il y un souci sur la définition du `name` de tes inputs qui ne correspond pas au `for` de tes labels. Le name devrait être unique à la proposition, donc contenir à la fois l’id de la question et celui de la proposition. Ça provoque des bugs : parfois, quand je veut cocher une réponse sur une question en cliquant sur son label, c’est la réponse d’à côté qui se coche xD
- Oh, dommage, pourquoi s'être arrêté au submit du formulaire ? Tu n'étais vraiment pas loin de finir !







## Général

- Qualité du code
  - [x] Indentation et lisibilité du code
  - [x] Présence de commentaires dans le code
  - [x] Intégration correcte
- Professionnalisme
  - [x] Respect du CDC
  - [x] Livraison dans les temps
  - [ ] Nomenclature des commits
  - [ ] Commentaires en anglais (bonus)


### Pistes de révisions

- `¯\_(ツ)_/¯`


### Commentaires

- Les noms de tes commits sont là pour t'aider à te repérer dans le temps et par groupes de modifications, surtout si tu reviens sur ton code 1 an et demi plus tard :grimacing: Autant les soigner. Je te conseille [ce post](https://chris.beams.io/posts/git-commit/) si tu veux en savoir plus sur les best practices en la matière.
- Des améliorations possibles sur l’intégration (au moins que le header et footer ne restent pas collé aux bords, des codes couleurs différents pour les niveaux de difficulté)
- C'est dommage l’évaluation ne semble pas complète :disappointed: Était-elle trop compliquée ou tu n'as pas eu assez de temps ?
- :dancer: Bonne éval' :dancer:

Plutôt bon boulot, dans l’ensemble. On voit que tu n’as pas eu assez de temps pour tout faire et c’est bien dommage, parce que ça commençait bien !
