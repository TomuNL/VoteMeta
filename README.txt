Lors de ce projet, nous avons développé VoteMeta, l'application permettant de voter et d'organiser des scrutins en ligne.
L'application dispose d'une interface simple et épurée afin d'apporter de la lisibilité aux utilisateurs.
Le site nécessite une connexion via Login/Mot de passe afin d'y accéder. Il propose une interface ou l'on peux retrouver la liste de tous les scrutins de l'utilisateur connecté.
On peux également concevoir de nouveaux scrutins (de plusieurs types : par défaut ou par vote préferentiel). 
Il est possible pour un organisateur de cloturer un scrutin et pour toutes les personnes conviés de voter.
Tous les votes sont anonymes et cryptés de manière sécurisée (grâce a JSEncrypt notamment).
Les utilisateurs sont conviés lors de la création de leur compte de renseigner le groupe auquelle ils appartiennent.
Il est possible de renseigner un certain nombre de procuration (jusqu'a 2 maximum).
Le site est entièrement mono-page et ne nécessite aucun raffraichissement de page ni n'en effectue aucun.
En effet, ce projet a été conçu en mettant lourdement en avant les appels ajax qui sont très nombreux dans notre projet (plus d'une vingtaine).
Ce fut un projet très mouvementé car de nombreuses nouvelles notions a apprendre en peu de temps ce qui n'était pas pour nous déplaire.
De nombreuses difficultés ont étés rencontrés lors de cette aventure, notamment aux niveaux des votes préferentiels et des encryptions des mots de passes.

Important : Lorsque vous souhaiterez tester l'application, nous avons mis en place différents login/mots de passe tel que le login est identique au mot de passe.
De plus nous n'avons pas créer de scrutin test car utilisant localStorage, vous n'auriez pas eu accès aux privateKeys permettant de décrypter les votes.