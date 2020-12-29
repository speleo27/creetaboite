<!-- sur cette page les conditions d'utilisations-->
<?php
session_start();
if (!isset($_SESSION['auth'])) {
    session_destroy();
    header("Location:accueil");
}
require_once 'template/header.php';

?>
<section class="mb-4">
    <h2 class="text-center">Définitions</h2>
    <p><b>Client :</b> tout professionnel ou personne physique capable au sens des articles 1123 et suivants du Code civil, ou personne morale, qui visite le Site objet des présentes conditions générales.<br>
        <b>Prestations et Services :</b> <a href="<?= $https ?>"><?= $https ?></a> met à disposition des Clients :</p>

    <p><b>Contenu :</b> Ensemble des éléments constituants l’information présente sur le Site, notamment textes – images – vidéos.</p>

    <p><b>Informations clients :</b> Ci après dénommé « Information (s) » qui correspondent à l’ensemble des données personnelles susceptibles d’être détenues par <a href="<?= $https ?>"><?= $https ?></a> pour la gestion de votre compte, de la gestion de la relation client et à des fins d’analyses et de statistiques.</p>


    <p><b>Utilisateur :</b> Internaute se connectant, utilisant le site susnommé.</p>
    <p><b>Informations personnelles :</b> « Les informations qui permettent, sous quelque forme que ce soit, directement ou non, l'identification des personnes physiques auxquelles elles s'appliquent » (article 4 de la loi n° 78-17 du 6 janvier 1978).</p>
    <p>Les termes « données à caractère personnel », « personne concernée », « sous traitant » et « données sensibles » ont le sens défini par le Règlement Général sur la Protection des Données (RGPD : n° 2016-679)</p>

    <h2>1. Présentation du site internet.</h2>
    <p>En vertu de l'article 6 de la loi n° 2004-575 du 21 juin 2004 pour la confiance dans l'économie numérique, il est précisé aux utilisateurs du site internet <a href="<?= $https ?>"><?= $https ?></a> l'identité des différents intervenants dans le cadre de sa réalisation et de son suivi:
    </p>
    <p><strong>Propriétaire</strong> : <?= $property?><br>

        <strong>Responsable publication</strong> : <?= $publi ?><br>
        Le responsable publication est une personne physique ou une personne morale.<br>
        <strong>Webmaster</strong> : <?= $webmaster ?><br>
        <strong>Hébergeur</strong> : <?= $heber ?><br>
        <strong>Délégué à la protection des données</strong> : <?= $dpo ?><br>
    </p>

    <h2>2. Conditions générales d’utilisation du site et des services proposés.</h2>

    <p>Le Site constitue une œuvre de l’esprit protégée par les dispositions du Code de la Propriété Intellectuelle et des Réglementations Internationales applicables.
        Le Client ne peut en aucune manière réutiliser, céder ou exploiter pour son propre compte tout ou partie des éléments ou travaux du Site.</p>

    <p>L’utilisation du site <a href="<?= $https ?>"><?= $https ?></a> implique l’acceptation pleine et entière des conditions générales d’utilisation ci-après décrites. Ces conditions d’utilisation sont susceptibles d’être modifiées ou complétées à tout moment, les utilisateurs du site <a href="<?= $https ?>"><?= $https ?></a> sont donc invités à les consulter de manière régulière.</p>

    <p>Ce site internet est normalement accessible à tout moment aux utilisateurs. Une interruption pour raison de maintenance technique peut être toutefois décidée par <a href="<?= $https ?>"><?= $https ?></a>, qui s’efforcera alors de communiquer préalablement aux utilisateurs les dates et heures de l’intervention.
        Le site web <a href="<?= $https ?>"><?= $https ?></a> est mis à jour régulièrement par <a href="<?= $https ?>"><?= $https ?></a> responsable. De la même façon, les mentions légales peuvent être modifiées à tout moment : elles s’imposent néanmoins à l’utilisateur qui est invité à s’y référer le plus souvent possible afin d’en prendre connaissance.</p>

    <h2>3. Description des services fournis.</h2>

    <p>Le site internet <a href="<?= $https ?>"><?= $https ?></a> a pour objet de fournir une information concernant l’ensemble des activités de la société.
        <a href="<?= $https ?>"><?= $https ?></a> s’efforce de fournir sur le site <a href="<?= $https ?>"><?= $https ?></a> des informations aussi précises que possible. Toutefois, il ne pourra être tenu responsable des oublis, des inexactitudes et des carences dans la mise à jour, qu’elles soient de son fait ou du fait des tiers partenaires qui lui fournissent ces informations.</p>

    <p>Toutes les informations indiquées sur le site <a href="<?= $https ?>"><?= $https ?></a> sont données à titre indicatif, et sont susceptibles d’évoluer. Par ailleurs, les renseignements figurant sur le site <a href="<?= $https ?>"><?= $https ?></a> ne sont pas exhaustifs. Ils sont donnés sous réserve de modifications ayant été apportées depuis leur mise en ligne.</p>

    <h2>4. Limitations contractuelles sur les données techniques.</h2>

    <p>Le site utilise la technologie JavaScript.

        Le site Internet ne pourra être tenu responsable de dommages matériels liés à l’utilisation du site. De plus, l’utilisateur du site s’engage à accéder au site en utilisant un matériel récent, ne contenant pas de virus et avec un navigateur de dernière génération mis-à-jour
        Le site <a href="<?= $https ?>"><?= $https ?></a> est hébergé chez un prestataire sur le territoire de l’Union Européenne conformément aux dispositions du Règlement Général sur la Protection des Données (RGPD : n° 2016-679)</p>

    <p>L’objectif est d’apporter une prestation qui assure le meilleur taux d’accessibilité. L’hébergeur assure la continuité de son service 24 Heures sur 24, tous les jours de l’année. Il se réserve néanmoins la possibilité d’interrompre le service d’hébergement pour les durées les plus courtes possibles notamment à des fins de maintenance, d’amélioration de ses infrastructures, de défaillance de ses infrastructures ou si les Prestations et Services génèrent un trafic réputé anormal.</p>

    <p><a href="<?= $https ?>"><?= $https ?></a> et l’hébergeur ne pourront être tenus responsables en cas de dysfonctionnement du réseau Internet, des lignes téléphoniques ou du matériel informatique et de téléphonie lié notamment à l’encombrement du réseau empêchant l’accès au serveur.</p>

    <h2>5. Propriété intellectuelle et contrefaçons.</h2>

    <p><a href="<?= $https ?>"><?= $https ?></a> est propriétaire des droits de propriété intellectuelle et détient les droits d’usage sur tous les éléments accessibles sur le site internet, notamment les textes, images, graphismes, logos, vidéos, icônes et sons.
        Toute reproduction, représentation, modification, publication, adaptation de tout ou partie des éléments du site, quel que soit le moyen ou le procédé utilisé, est interdite, sauf autorisation écrite préalable de : <a href="<?= $https ?>"><?= $https ?></a>.</p>

    <p>Toute exploitation non autorisée du site ou de l’un quelconque des éléments qu’il contient sera considérée comme constitutive d’une contrefaçon et poursuivie conformément aux dispositions des articles L.335-2 et suivants du Code de Propriété Intellectuelle.</p>

    <h2>6. Limitations de responsabilité.</h2>

    <p><a href="<?= $https ?>"><?= $https ?></a> agit en tant qu’éditeur du site. <a href="<?= $https ?>"><?= $https ?></a> est responsable de la qualité et de la véracité du Contenu qu’il publie. </p>

    <p><a href="<?= $https ?>"><?= $https ?></a> ne pourra être tenu responsable des dommages directs et indirects causés au matériel de l’utilisateur, lors de l’accès au site internet <a href="<?= $https ?>"><?= $https ?></a>, et résultant soit de l’utilisation d’un matériel ne répondant pas aux spécifications indiquées au point 4, soit de l’apparition d’un bug ou d’une incompatibilité.</p>

    <p><a href="<?= $https ?>"><?= $https ?></a> ne pourra également être tenu responsable des dommages indirects (tels par exemple qu’une perte de marché ou perte d’une chance) consécutifs à l’utilisation du site <a href="<?= $https ?>"><?= $https ?></a>.
        Des espaces interactifs (possibilité de poser des questions dans l’espace contact) sont à la disposition des utilisateurs. <a href="<?= $https ?>"><?= $https ?></a> se réserve le droit de supprimer, sans mise en demeure préalable, tout contenu déposé dans cet espace qui contreviendrait à la législation applicable en France, en particulier aux dispositions relatives à la protection des données. Le cas échéant, <a href="<?= $https ?>"><?= $https ?></a> se réserve également la possibilité de mettre en cause la responsabilité civile et/ou pénale de l’utilisateur, notamment en cas de message à caractère raciste, injurieux, diffamant, ou pornographique, quel que soit le support utilisé (texte, photographie …).</p>

    <h2>7. Gestion des données personnelles.</h2>

    <p>Le Client est informé des réglementations concernant la communication marketing, la loi du 21 Juin 2014 pour la confiance dans l’Economie Numérique, la Loi Informatique et Liberté du 06 Août 2004 ainsi que du Règlement Général sur la Protection des Données (RGPD : n° 2016-679). </p>

    <h3>7.1 Responsables de la collecte des données personnelles</h3>

    <p>Pour les Données Personnelles collectées dans le cadre de la création du compte personnel de l’Utilisateur et de sa navigation sur le Site, le responsable du traitement des Données Personnelles est : rossi sebastien. <a href="<?= $https ?>"><?= $https ?></a>est représenté par sebastien rossi, son représentant légal</p>

    <p>En tant que responsable du traitement des données qu’il collecte, <a href="<?= $https ?>"><?= $https ?></a> s’engage à respecter le cadre des dispositions légales en vigueur. Il lui appartient notamment au Client d’établir les finalités de ses traitements de données, de fournir à ses prospects et clients, à partir de la collecte de leurs consentements, une information complète sur le traitement de leurs données personnelles et de maintenir un registre des traitements conforme à la réalité.
        Chaque fois que <a href="<?= $https ?>"><?= $https ?></a> traite des Données Personnelles, <a href="<?= $https ?>"><?= $https ?></a> prend toutes les mesures raisonnables pour s’assurer de l’exactitude et de la pertinence des Données Personnelles au regard des finalités pour lesquelles <a href="<?= $https ?>"><?= $https ?></a> les traite.</p>

    <h3>7.2 Finalité des données collectées</h3>

    <p><a href="<?= $https ?>"><?= $https ?></a> est susceptible de traiter tout ou partie des données : </p>

    <ul>

        <li>pour permettre la navigation sur le Site et la gestion et la traçabilité des prestations et services commandés par l’utilisateur : données de connexion et d’utilisation du Site, facturation, historique des commandes, etc. </li>

        <li>pour prévenir et lutter contre la fraude informatique (spamming, hacking…) : matériel informatique utilisé pour la navigation, l’adresse IP, le mot de passe (hashé) </li>

        <li>pour améliorer la navigation sur le Site : données de connexion et d’utilisation </li>

        <li>pour mener des enquêtes de satisfaction facultatives sur <a href="<?= $https ?>"><?= $https ?></a> : adresse email </li>
        <li>pour mener des campagnes de communication (sms, mail) : numéro de téléphone, adresse email</li>


    </ul>

    <p><a href="<?= $https ?>"><?= $https ?></a> ne commercialise pas vos données personnelles qui sont donc uniquement utilisées par nécessité ou à des fins statistiques et d’analyses.</p>

    <h3>7.3 Droit d’accès, de rectification et d’opposition</h3>

    <p>
        Conformément à la réglementation européenne en vigueur, les Utilisateurs de <a href="<?= $https ?>"><?= $https ?></a> disposent des droits suivants : </p>
    <ul>

        <li>droit d'accès (article 15 RGPD) et de rectification (article 16 RGPD), de mise à jour, de complétude des données des Utilisateurs droit de verrouillage ou d’effacement des données des Utilisateurs à caractère personnel (article 17 du RGPD), lorsqu’elles sont inexactes, incomplètes, équivoques, périmées, ou dont la collecte, l'utilisation, la communication ou la conservation est interdite </li>

        <li>droit de retirer à tout moment un consentement (article 13-2c RGPD) </li>

        <li>droit à la limitation du traitement des données des Utilisateurs (article 18 RGPD) </li>

        <li>droit d’opposition au traitement des données des Utilisateurs (article 21 RGPD) </li>

        <li>droit à la portabilité des données que les Utilisateurs auront fournies, lorsque ces données font l’objet de traitements automatisés fondés sur leur consentement ou sur un contrat (article 20 RGPD) </li>

        <li>droit de définir le sort des données des Utilisateurs après leur mort et de choisir à qui <a href="<?= $https ?>"><?= $https ?></a> devra communiquer (ou non) ses données à un tiers qu’ils aura préalablement désigné</li>
    </ul>

    <p>Dès que <a href="<?= $https ?>"><?= $https ?></a> a connaissance du décès d’un Utilisateur et à défaut d’instructions de sa part, <a href="<?= $https ?>"><?= $https ?></a> s’engage à détruire ses données, sauf si leur conservation s’avère nécessaire à des fins probatoires ou pour répondre à une obligation légale.</p>

    <p>Si l’Utilisateur souhaite savoir comment <a href="<?= $https ?>"><?= $https ?></a> utilise ses Données Personnelles, demander à les rectifier ou s’oppose à leur traitement, l’Utilisateur peut contacter <a href="<?= $https ?>"><?= $https ?></a> par écrit à l’adresse suivante : </p>

    rossi sebastien – DPO, rossi sebastien <br>
    4 rue du four 10400 Pont sur Seine.

    <p>Dans ce cas, l’Utilisateur doit indiquer les Données Personnelles qu’il souhaiterait que <a href="<?= $https ?>"><?= $https ?></a> corrige, mette à jour ou supprime, en s’identifiant précisément avec une copie d’une pièce d’identité (carte d’identité ou passeport). </p>

    <p>
        Les demandes de suppression de Données Personnelles seront soumises aux obligations qui sont imposées à <a href="<?= $https ?>"><?= $https ?></a> par la loi, notamment en matière de conservation ou d’archivage des documents. Enfin, les Utilisateurs de <a href="<?= $https ?>"><?= $https ?></a> peuvent déposer une réclamation auprès des autorités de contrôle, et notamment de la CNIL (https://www.cnil.fr/fr/plaintes).</p>

    <h3>7.4 Non-communication des données personnelles</h3>

    <p>
        <a href="<?= $https ?>"><?= $https ?></a> s’interdit de traiter, héberger ou transférer les Informations collectées sur ses Clients vers un pays situé en dehors de l’Union européenne ou reconnu comme « non adéquat » par la Commission européenne sans en informer préalablement le client. Pour autant, <a href="<?= $https ?>"><?= $https ?></a> reste libre du choix de ses sous-traitants techniques et commerciaux à la condition qu’il présentent les garanties suffisantes au regard des exigences du Règlement Général sur la Protection des Données (RGPD : n° 2016-679).</p>

    <p>
        <a href="<?= $https ?>"><?= $https ?></a> s’engage à prendre toutes les précautions nécessaires afin de préserver la sécurité des Informations et notamment qu’elles ne soient pas communiquées à des personnes non autorisées. Cependant, si un incident impactant l’intégrité ou la confidentialité des Informations du Client est portée à la connaissance de <a href="<?= $https ?>"><?= $https ?></a>, celle-ci devra dans les meilleurs délais informer le Client et lui communiquer les mesures de corrections prises. Par ailleurs <a href="<?= $https ?>"><?= $https ?></a> ne collecte aucune « données sensibles ».</p>

    <p>
        Les Données Personnelles de l’Utilisateur peuvent être traitées par des filiales de <a href="<?= $https ?>"><?= $https ?></a> et des sous-traitants (prestataires de services), exclusivement afin de réaliser les finalités de la présente politique.</p>
    <p>
        Dans la limite de leurs attributions respectives et pour les finalités rappelées ci-dessus, les principales personnes susceptibles d’avoir accès aux données des Utilisateurs de <a href="<?= $https ?>"><?= $https ?></a> sont principalement les agents de notre service client.</p>

    <div ng-bind-html="rgpdHTML"></div>


    <h2>8. Notification d’incident</h2>
    <p>
        Quels que soient les efforts fournis, aucune méthode de transmission sur Internet et aucune méthode de stockage électronique n'est complètement sûre. Nous ne pouvons en conséquence pas garantir une sécurité absolue.
        Si nous prenions connaissance d'une brèche de la sécurité, nous avertirions les utilisateurs concernés afin qu'ils puissent prendre les mesures appropriées. Nos procédures de notification d’incident tiennent compte de nos obligations légales, qu'elles se situent au niveau national ou européen. Nous nous engageons à informer pleinement nos clients de toutes les questions relevant de la sécurité de leur compte et à leur fournir toutes les informations nécessaires pour les aider à respecter leurs propres obligations réglementaires en matière de reporting.</p>
    <p>
        Aucune information personnelle de l'utilisateur du site <a href="<?= $https ?>"><?= $https ?></a> n'est publiée à l'insu de l'utilisateur, échangée, transférée, cédée ou vendue sur un support quelconque à des tiers. Seule l'hypothèse du rachat de <a href="<?= $https ?>"><?= $https ?></a> et de ses droits permettrait la transmission des dites informations à l'éventuel acquéreur qui serait à son tour tenu de la même obligation de conservation et de modification des données vis à vis de l'utilisateur du site <a href="<?= $https ?>"><?= $https ?></a>.</p>

    <h3>Sécurité</h3>

    <p>
        Pour assurer la sécurité et la confidentialité des Données Personnelles et des Données Personnelles de Santé, <a href="<?= $https ?>"><?= $https ?></a> utilise des réseaux protégés par des dispositifs standards tels que par pare-feu, la pseudonymisation, l’encryption et mot de passe. </p>

    <p>
        Lors du traitement des Données Personnelles, <a href="<?= $https ?>"><?= $https ?></a>prend toutes les mesures raisonnables visant à les protéger contre toute perte, utilisation détournée, accès non autorisé, divulgation, altération ou destruction.</p>

    <h2>9. Liens hypertextes « cookies » et balises (“tags”) internet</h2>
    <p>
        Le site <a href="<?= $https ?>"><?= $https ?></a> contient un certain nombre de liens hypertextes vers d’autres sites, mis en place avec l’autorisation de <a href="<?= $https ?>"><?= $https ?></a>. Cependant, <a href="<?= $https ?>"><?= $https ?></a> n’a pas la possibilité de vérifier le contenu des sites ainsi visités, et n’assumera en conséquence aucune responsabilité de ce fait.</p>
    Sauf si vous décidez de désactiver les cookies, vous acceptez que le site puisse les utiliser. Vous pouvez à tout moment désactiver ces cookies et ce gratuitement à partir des possibilités de désactivation qui vous sont offertes et rappelées ci-après, sachant que cela peut réduire ou empêcher l’accessibilité à tout ou partie des Services proposés par le site.
    <p></p>

    <h3>9.1. « COOKIES »</h3>
    <p>
        Un « cookie » est un petit fichier d’information envoyé sur le navigateur de l’Utilisateur et enregistré au sein du terminal de l’Utilisateur (ex : ordinateur, smartphone), (ci-après « Cookies »). Ce fichier comprend des informations telles que le nom de domaine de l’Utilisateur, le fournisseur d’accès Internet de l’Utilisateur, le système d’exploitation de l’Utilisateur, ainsi que la date et l’heure d’accès. Les Cookies ne risquent en aucun cas d’endommager le terminal de l’Utilisateur.</p>
    <p>
        <a href="<?= $https ?>"><?= $https ?></a> est susceptible de traiter les informations de l’Utilisateur concernant sa visite du Site, telles que les pages consultées, les recherches effectuées. Ces informations permettent à <a href="<?= $https ?>"><?= $https ?></a> d’améliorer le contenu du Site, de la navigation de l’Utilisateur.</p>
    <p>
        Les Cookies facilitant la navigation et/ou la fourniture des services proposés par le Site, l’Utilisateur peut configurer son navigateur pour qu’il lui permette de décider s’il souhaite ou non les accepter de manière à ce que des Cookies soient enregistrés dans le terminal ou, au contraire, qu’ils soient rejetés, soit systématiquement, soit selon leur émetteur. L’Utilisateur peut également configurer son logiciel de navigation de manière à ce que l’acceptation ou le refus des Cookies lui soient proposés ponctuellement, avant qu’un Cookie soit susceptible d’être enregistré dans son terminal. <a href="<?= $https ?>"><?= $https ?></a> informe l’Utilisateur que, dans ce cas, il se peut que les fonctionnalités de son logiciel de navigation ne soient pas toutes disponibles.</p>
    <p>
        Si l’Utilisateur refuse l’enregistrement de Cookies dans son terminal ou son navigateur, ou si l’Utilisateur supprime ceux qui y sont enregistrés, l’Utilisateur est informé que sa navigation et son expérience sur le Site peuvent être limitées. Cela pourrait également être le cas lorsque <a href="<?= $https ?>"><?= $https ?></a> ou l’un de ses prestataires ne peut pas reconnaître, à des fins de compatibilité technique, le type de navigateur utilisé par le terminal, les paramètres de langue et d’affichage ou le pays depuis lequel le terminal semble connecté à Internet.</p>
    <p>
        Le cas échéant, <a href="<?= $https ?>"><?= $https ?></a> décline toute responsabilité pour les conséquences liées au fonctionnement dégradé du Site et des services éventuellement proposés par <a href="<?= $https ?>"><?= $https ?></a>, résultant (i) du refus de Cookies par l’Utilisateur (ii) de l’impossibilité pour <a href="<?= $https ?>"><?= $https ?></a> d’enregistrer ou de consulter les Cookies nécessaires à leur fonctionnement du fait du choix de l’Utilisateur. Pour la gestion des Cookies et des choix de l’Utilisateur, la configuration de chaque navigateur est différente. Elle est décrite dans le menu d’aide du navigateur, qui permettra de savoir de quelle manière l’Utilisateur peut modifier ses souhaits en matière de Cookies.</p>
    <p>
        À tout moment, l’Utilisateur peut faire le choix d’exprimer et de modifier ses souhaits en matière de Cookies. <a href="<?= $https ?>"><?= $https ?></a> pourra en outre faire appel aux services de prestataires externes pour l’aider à recueillir et traiter les informations décrites dans cette section.</p>
    <p>
        Enfin, en cliquant sur les icônes dédiées aux réseaux sociaux Twitter, Facebook, Linkedin et Google Plus figurant sur le Site de <a href="<?= $https ?>"><?= $https ?></a> ou dans son application mobile et si l’Utilisateur a accepté le dépôt de cookies en poursuivant sa navigation sur le Site Internet ou l’application mobile de <a href="<?= $https ?>"><?= $https ?></a>, Twitter, Facebook, Linkedin et Google Plus peuvent également déposer des cookies sur vos terminaux (ordinateur, tablette, téléphone portable).</p>
    <p>
        Ces types de cookies ne sont déposés sur vos terminaux qu’à condition que vous y consentiez, en continuant votre navigation sur le Site Internet ou l’application mobile de <a href="<?= $https ?>"><?= $https ?></a>. À tout moment, l’Utilisateur peut néanmoins revenir sur son consentement à ce que <a href="<?= $https ?>"><?= $https ?></a> dépose ce type de cookies.</p>

    <h3>Article 9.2. BALISES (“TAGS”) INTERNET</h3>


    <p>

        <a href="<?= $https ?>"><?= $https ?></a> peut employer occasionnellement des balises Internet (également appelées « tags », ou balises d’action, GIF à un pixel, GIF transparents, GIF invisibles et GIF un à un) et les déployer par l’intermédiaire d’un partenaire spécialiste d’analyses Web susceptible de se trouver (et donc de stocker les informations correspondantes, y compris l’adresse IP de l’Utilisateur) dans un pays étranger.</p>

    <p>
        Ces balises sont placées à la fois dans les publicités en ligne permettant aux internautes d’accéder au Site, et sur les différentes pages de celui-ci.
    </p>
    <p>
        Cette technologie permet à <a href="<?= $https ?>"><?= $https ?></a> d’évaluer les réponses des visiteurs face au Site et l’efficacité de ses actions (par exemple, le nombre de fois où une page est ouverte et les informations consultées), ainsi que l’utilisation de ce Site par l’Utilisateur. </p>
    <p>
        Le prestataire externe pourra éventuellement recueillir des informations sur les visiteurs du Site et d’autres sites Internet grâce à ces balises, constituer des rapports sur l’activité du Site à l’attention de <a href="<?= $https ?>"><?= $https ?></a>, et fournir d’autres services relatifs à l’utilisation de celui-ci et d’Internet.</p>
    <p>
    </p>
    <h2>10. Droit applicable et attribution de juridiction.</h2>
    <p>
        Tout litige en relation avec l’utilisation du site <a href="<?= $https ?>"><?= $https ?></a> est soumis au droit français.
        En dehors des cas où la loi ne le permet pas, il est fait attribution exclusive de juridiction aux tribunaux compétents de troyes</p>


</section>
<section class="mb-4">
    <h2>Privacy Policy</h2>
    <p>Last updated: December 10, 2020</p>
    <p>This Privacy Policy describes Our policies and procedures on the collection, use and disclosure of Your information when You use the Service and tells You about Your privacy rights and how the law protects You.</p>
    <p>We use Your Personal data to provide and improve the Service. By using the Service, You agree to the collection and use of information in accordance with this Privacy Policy. This Privacy Policy has been created with the help of the <a href="https://www.privacypolicies.com/privacy-policy-generator/" target="_blank">Privacy Policy Generator</a>.</p>
    <h2>Interpretation and Definitions</h2>
    <h2>Interpretation</h2>
    <p>The words of which the initial letter is capitalized have meanings defined under the following conditions. The following definitions shall have the same meaning regardless of whether they appear in singular or in plural.</p>
    <h2>Definitions</h2>
    <p>For the purposes of this Privacy Policy:</p>
    <ul>
        <li>
            <p><strong>Account</strong> means a unique account created for You to access our Service or parts of our Service.</p>
        </li>
        <li>
            <p><strong>Company</strong> (referred to as either &quot;the Company&quot;, &quot;We&quot;, &quot;Us&quot; or &quot;Our&quot; in this Agreement) refers to cree ta boite, 15 chemin des prés 10000 troyes.</p>
        </li>
        <li>
            <p><strong>Cookies</strong> are small files that are placed on Your computer, mobile device or any other device by a website, containing the details of Your browsing history on that website among its many uses.</p>
        </li>
        <li>
            <p><strong>Country</strong> refers to: France</p>
        </li>
        <li>
            <p><strong>Device</strong> means any device that can access the Service such as a computer, a cellphone or a digital tablet.</p>
        </li>
        <li>
            <p><strong>Personal Data</strong> is any information that relates to an identified or identifiable individual.</p>
        </li>
        <li>
            <p><strong>Service</strong> refers to the Website.</p>
        </li>
        <li>
            <p><strong>Service Provider</strong> means any natural or legal person who processes the data on behalf of the Company. It refers to third-party companies or individuals employed by the Company to facilitate the Service, to provide the Service on behalf of the Company, to perform services related to the Service or to assist the Company in analyzing how the Service is used.</p>
        </li>
        <li>
            <p><strong>Third-party Social Media Service</strong> refers to any website or any social network website through which a User can log in or create an account to use the Service.</p>
        </li>
        <li>
            <p><strong>Usage Data</strong> refers to data collected automatically, either generated by the use of the Service or from the Service infrastructure itself (for example, the duration of a page visit).</p>
        </li>
        <li>
            <p><strong>Website</strong> refers to cree ta boite, accessible from <a href="<?= $https?>" rel="external nofollow noopener" target="_blank"><?= $https?></a></p>
        </li>
        <li>
            <p><strong>You</strong> means the individual accessing or using the Service, or the company, or other legal entity on behalf of which such individual is accessing or using the Service, as applicable.</p>
        </li>
    </ul>
    <h2>Collecting and Using Your Personal Data</h2>
    <h2>Types of Data Collected</h2>
    <h3>Personal Data</h3>
    <p>While using Our Service, We may ask You to provide Us with certain personally identifiable information that can be used to contact or identify You. Personally identifiable information may include, but is not limited to:</p>
    <ul>
        <li>
            <p>Email address</p>
        </li>
        <li>
            <p>First name and last name</p>
        </li>
        <li>
            <p>Phone number</p>
        </li>
        <li>
            <p>Address, State, Province, ZIP/Postal code, City</p>
        </li>
        <li>
            <p>Usage Data</p>
        </li>
    </ul>
    <h3>Usage Data</h3>
    <p>Usage Data is collected automatically when using the Service.</p>
    <p>Usage Data may include information such as Your Device's Internet Protocol address (e.g. IP address), browser type, browser version, the pages of our Service that You visit, the time and date of Your visit, the time spent on those pages, unique device identifiers and other diagnostic data.</p>
    <p>When You access the Service by or through a mobile device, We may collect certain information automatically, including, but not limited to, the type of mobile device You use, Your mobile device unique ID, the IP address of Your mobile device, Your mobile operating system, the type of mobile Internet browser You use, unique device identifiers and other diagnostic data.</p>
    <p>We may also collect information that Your browser sends whenever You visit our Service or when You access the Service by or through a mobile device.</p>
    <h3>Tracking Technologies and Cookies</h3>
    <p>We use Cookies and similar tracking technologies to track the activity on Our Service and store certain information. Tracking technologies used are beacons, tags, and scripts to collect and track information and to improve and analyze Our Service. The technologies We use may include:</p>
    <ul>
        <li><strong>Cookies or Browser Cookies.</strong> A cookie is a small file placed on Your Device. You can instruct Your browser to refuse all Cookies or to indicate when a Cookie is being sent. However, if You do not accept Cookies, You may not be able to use some parts of our Service. Unless you have adjusted Your browser setting so that it will refuse Cookies, our Service may use Cookies.</li>
        <li><strong>Flash Cookies.</strong> Certain features of our Service may use local stored objects (or Flash Cookies) to collect and store information about Your preferences or Your activity on our Service. Flash Cookies are not managed by the same browser settings as those used for Browser Cookies. For more information on how You can delete Flash Cookies, please read &quot;Where can I change the settings for disabling, or deleting local shared objects?&quot; available at <a href="https://helpx.adobe.com/flash-player/kb/disable-local-shared-objects-flash.html#main_Where_can_I_change_the_settings_for_disabling__or_deleting_local_shared_objects_" rel="external nofollow noopener" target="_blank">https://helpx.adobe.com/flash-player/kb/disable-local-shared-objects-flash.html#main_Where_can_I_change_the_settings_for_disabling__or_deleting_local_shared_objects_</a></li>
        <li><strong>Web Beacons.</strong> Certain sections of our Service and our emails may contain small electronic files known as web beacons (also referred to as clear gifs, pixel tags, and single-pixel gifs) that permit the Company, for example, to count users who have visited those pages or opened an email and for other related website statistics (for example, recording the popularity of a certain section and verifying system and server integrity).</li>
    </ul>
    <p>Cookies can be &quot;Persistent&quot; or &quot;Session&quot; Cookies. Persistent Cookies remain on Your personal computer or mobile device when You go offline, while Session Cookies are deleted as soon as You close Your web browser. Learn more about cookies: <a href="https://www.privacypolicies.com/blog/cookies/" target="_blank">What Are Cookies?</a>.</p>
    <p>We use both Session and Persistent Cookies for the purposes set out below:</p>
    <ul>
        <li>
            <p><strong>Necessary / Essential Cookies</strong></p>
            <p>Type: Session Cookies</p>
            <p>Administered by: Us</p>
            <p>Purpose: These Cookies are essential to provide You with services available through the Website and to enable You to use some of its features. They help to authenticate users and prevent fraudulent use of user accounts. Without these Cookies, the services that You have asked for cannot be provided, and We only use these Cookies to provide You with those services.</p>
        </li>
        <li>
            <p><strong>Cookies Policy / Notice Acceptance Cookies</strong></p>
            <p>Type: Persistent Cookies</p>
            <p>Administered by: Us</p>
            <p>Purpose: These Cookies identify if users have accepted the use of cookies on the Website.</p>
        </li>
        <li>
            <p><strong>Functionality Cookies</strong></p>
            <p>Type: Persistent Cookies</p>
            <p>Administered by: Us</p>
            <p>Purpose: These Cookies allow us to remember choices You make when You use the Website, such as remembering your login details or language preference. The purpose of these Cookies is to provide You with a more personal experience and to avoid You having to re-enter your preferences every time You use the Website.</p>
        </li>
    </ul>
    <p>For more information about the cookies we use and your choices regarding cookies, please visit our Cookies Policy or the Cookies section of our Privacy Policy.</p>
    <h2>Use of Your Personal Data</h2>
    <p>The Company may use Personal Data for the following purposes:</p>
    <ul>
        <li>
            <p><strong>To provide and maintain our Service</strong>, including to monitor the usage of our Service.</p>
        </li>
        <li>
            <p><strong>To manage Your Account:</strong> to manage Your registration as a user of the Service. The Personal Data You provide can give You access to different functionalities of the Service that are available to You as a registered user.</p>
        </li>
        <li>
            <p><strong>For the performance of a contract:</strong> the development, compliance and undertaking of the purchase contract for the products, items or services You have purchased or of any other contract with Us through the Service.</p>
        </li>
        <li>
            <p><strong>To contact You:</strong> To contact You by email, telephone calls, SMS, or other equivalent forms of electronic communication, such as a mobile application's push notifications regarding updates or informative communications related to the functionalities, products or contracted services, including the security updates, when necessary or reasonable for their implementation.</p>
        </li>
        <li>
            <p><strong>To provide You</strong> with news, special offers and general information about other goods, services and events which we offer that are similar to those that you have already purchased or enquired about unless You have opted not to receive such information.</p>
        </li>
        <li>
            <p><strong>To manage Your requests:</strong> To attend and manage Your requests to Us.</p>
        </li>
        <li>
            <p><strong>For business transfers:</strong> We may use Your information to evaluate or conduct a merger, divestiture, restructuring, reorganization, dissolution, or other sale or transfer of some or all of Our assets, whether as a going concern or as part of bankruptcy, liquidation, or similar proceeding, in which Personal Data held by Us about our Service users is among the assets transferred.</p>
        </li>
        <li>
            <p><strong>For other purposes</strong>: We may use Your information for other purposes, such as data analysis, identifying usage trends, determining the effectiveness of our promotional campaigns and to evaluate and improve our Service, products, services, marketing and your experience.</p>
        </li>
    </ul>
    <p>We may share Your personal information in the following situations:</p>
    <ul>
        <li><strong>With Service Providers:</strong> We may share Your personal information with Service Providers to monitor and analyze the use of our Service, to contact You.</li>
        <li><strong>For business transfers:</strong> We may share or transfer Your personal information in connection with, or during negotiations of, any merger, sale of Company assets, financing, or acquisition of all or a portion of Our business to another company.</li>
        <li><strong>With Affiliates:</strong> We may share Your information with Our affiliates, in which case we will require those affiliates to honor this Privacy Policy. Affiliates include Our parent company and any other subsidiaries, joint venture partners or other companies that We control or that are under common control with Us.</li>
        <li><strong>With business partners:</strong> We may share Your information with Our business partners to offer You certain products, services or promotions.</li>
        <li><strong>With other users:</strong> when You share personal information or otherwise interact in the public areas with other users, such information may be viewed by all users and may be publicly distributed outside. If You interact with other users or register through a Third-Party Social Media Service, Your contacts on the Third-Party Social Media Service may see Your name, profile, pictures and description of Your activity. Similarly, other users will be able to view descriptions of Your activity, communicate with You and view Your profile.</li>
        <li><strong>With Your consent</strong>: We may disclose Your personal information for any other purpose with Your consent.</li>
    </ul>
    <h2>Retention of Your Personal Data</h2>
    <p>The Company will retain Your Personal Data only for as long as is necessary for the purposes set out in this Privacy Policy. We will retain and use Your Personal Data to the extent necessary to comply with our legal obligations (for example, if we are required to retain your data to comply with applicable laws), resolve disputes, and enforce our legal agreements and policies.</p>
    <p>The Company will also retain Usage Data for internal analysis purposes. Usage Data is generally retained for a shorter period of time, except when this data is used to strengthen the security or to improve the functionality of Our Service, or We are legally obligated to retain this data for longer time periods.</p>
    <h2>Transfer of Your Personal Data</h2>
    <p>Your information, including Personal Data, is processed at the Company's operating offices and in any other places where the parties involved in the processing are located. It means that this information may be transferred to — and maintained on — computers located outside of Your state, province, country or other governmental jurisdiction where the data protection laws may differ than those from Your jurisdiction.</p>
    <p>Your consent to this Privacy Policy followed by Your submission of such information represents Your agreement to that transfer.</p>
    <p>The Company will take all steps reasonably necessary to ensure that Your data is treated securely and in accordance with this Privacy Policy and no transfer of Your Personal Data will take place to an organization or a country unless there are adequate controls in place including the security of Your data and other personal information.</p>
    <h2>Disclosure of Your Personal Data</h2>
    <h3>Business Transactions</h3>
    <p>If the Company is involved in a merger, acquisition or asset sale, Your Personal Data may be transferred. We will provide notice before Your Personal Data is transferred and becomes subject to a different Privacy Policy.</p>
    <h3>Law enforcement</h3>
    <p>Under certain circumstances, the Company may be required to disclose Your Personal Data if required to do so by law or in response to valid requests by public authorities (e.g. a court or a government agency).</p>
    <h3>Other legal requirements</h3>
    <p>The Company may disclose Your Personal Data in the good faith belief that such action is necessary to:</p>
    <ul>
        <li>Comply with a legal obligation</li>
        <li>Protect and defend the rights or property of the Company</li>
        <li>Prevent or investigate possible wrongdoing in connection with the Service</li>
        <li>Protect the personal safety of Users of the Service or the public</li>
        <li>Protect against legal liability</li>
    </ul>
    <h2>Security of Your Personal Data</h2>
    <p>The security of Your Personal Data is important to Us, but remember that no method of transmission over the Internet, or method of electronic storage is 100% secure. While We strive to use commercially acceptable means to protect Your Personal Data, We cannot guarantee its absolute security.</p>
    <h2>Links to Other Websites</h2>
    <p>Our Service may contain links to other websites that are not operated by Us. If You click on a third party link, You will be directed to that third party's site. We strongly advise You to review the Privacy Policy of every site You visit.</p>
    <p>We have no control over and assume no responsibility for the content, privacy policies or practices of any third party sites or services.</p>
    <h2>Changes to this Privacy Policy</h2>
    <p>We may update Our Privacy Policy from time to time. We will notify You of any changes by posting the new Privacy Policy on this page.</p>
    <p>We will let You know via email and/or a prominent notice on Our Service, prior to the change becoming effective and update the &quot;Last updated&quot; date at the top of this Privacy Policy.</p>
    <p>You are advised to review this Privacy Policy periodically for any changes. Changes to this Privacy Policy are effective when they are posted on this page.</p>
    <h2>Contact Us</h2>
    <p>If you have any questions about this Privacy Policy, You can contact us:</p>
    <ul>
        <li>By email: contact@creetaboite.fr</li>
    </ul>
</section>
<section class="mb-4">
    <div class="container">
        <form action="controller/ctrlcgu.php" method="post">
            <div id="checkbox">
                <input type="checkbox" aria-label="Checkbox for control docs" id="validcgu" name="validcgu" value="validcgu" onclick=" validcheck();" required>
                <label for="validcgu">Je reconnais avoir pris connaissance des CGU et les approuvent</label>
            </div>
            <div id="checkbox">
                <input type="checkbox" aria-label="Checkbox for control docs" id="validcgu1" name="validcgu" value="validcgu" onclick=" validcheck();" required>
                <label for="validcgu">J'autorise la société <?= $nameboite ?>à utiliser les données fournies </label>
            </div>

            <button class="btn  btn-block btn-outline-light" type="submit" disabled='disabled' id="btnvalidcgu">Valider</button>
        </form>
    </div>
</section>
<script>
    function validcheck() {
        if (
            $('input[name=validcgu]').prop('checked')) {
            $('#btnvalidcgu').removeAttr('disabled');
        } else {
            $('#btnvalidcgu').attr('disabled', 'disabled');
        }
    }
</script>
<?php
require_once 'template/footer.php';
