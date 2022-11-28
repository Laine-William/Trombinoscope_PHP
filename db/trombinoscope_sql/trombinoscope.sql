SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Base de données : `trombinoscope`

-- Structure de la table `classes`
CREATE TABLE `classes` (
  `class_id` int(11) NOT NULL,
  `class_name` varchar(255) NOT NULL,
  `class_localisation` varchar(255) NOT NULL,
  `class_image` varchar(255) NOT NULL,
  `class_cat_id` int(11) NOT NULL,
  `class_number_pupils` int(11) NOT NULL,
  `class_year` datetime NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Déchargement des données de la table `classes`
INSERT INTO `classes` (`class_id`, `class_name`, `class_localisation`, `class_image`, `class_cat_id`, `class_number_pupils`, `class_year`, `user_id`) VALUES
(1, 'Lycee Jean Moulin', 'Paris', 'image_1.jpg', 2, 25, '2021-04-16 00:00:00', 1);

-- Structure de la table `classes_categories`
CREATE TABLE `classes_categories` (
  `class_cat_id` int(11) NOT NULL,
  `class_cat_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Déchargement des données de la table `classes_categories`
INSERT INTO `classes_categories` (`class_cat_id`, `class_cat_name`) VALUES
(1, 'Ecole primaire'),
(2, 'Sixieme'),
(3, 'Cinquieme'),
(4, 'Quatrieme'),
(5, 'Troisieme'),
(6, 'Seconde generale'),
(7, 'Seconde technologique'),
(8, 'Seconde professionnelle'),
(9, 'Premiere generale'),
(10, 'Premiere technologique'),
(11, 'Premiere professionnelle'),
(12, 'Terminale generale'),
(13, 'Terminale technologique'),
(14, 'Terminale professionnelle'),
(15, 'BTS'),
(16, 'DUT'),
(17, 'Licence generale'),
(18, 'Licence professionnelle'),
(19, 'Licence generale'),
(20, 'Master');

-- Structure de la table `pupils`
CREATE TABLE `pupils` (
  `pupil_id` int(11) NOT NULL,
  `pupil_first_name` varchar(255) NOT NULL,
  `pupil_last_name` varchar(255) NOT NULL,
  `pupil_age` int(11) NOT NULL,
  `pupil_image` varchar(255) NOT NULL,
  `class_cat_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Déchargement des données de la table `pupils`
INSERT INTO `pupils` (`pupil_id`, `pupil_first_name`, `pupil_last_name`, `pupil_age`, `pupil_image`, `class_cat_id`, `class_id`, `user_id`) VALUES
(2, 'gaetan', 'laine', 16, 'image_1.jpg', 5, 1, 1);

-- Structure de la table `users`
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_nickname` varchar(150) NOT NULL,
  `user_password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Déchargement des données de la table `users`
INSERT INTO `users` (`user_id`, `user_nickname`, `user_password`) VALUES
(1, 'JD', 'JohnDoe1');

-- Index pour les tables déchargées
-- Index pour la table `classes`
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`),
  ADD KEY `classes_users_FK` (`user_id`);
  ADD KEY `classes_class_cat_id_FK` (`class_cat_id`);

-- Index pour la table `pupils`
ALTER TABLE `pupils`
  ADD PRIMARY KEY (`pupil_id`),
  ADD KEY `pupils_users_FK` (`user_id`),
  ADD KEY `pupils_class_id_FK` (`class_id`),
  ADD KEY `pupils_class_cat_id_FK` (`class_cat_id`);

-- Index pour la table `users`
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

-- AUTO_INCREMENT pour les tables déchargées
-- AUTO_INCREMENT pour la table `classes`
ALTER TABLE `classes`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

-- AUTO_INCREMENT pour la table `pupils`
ALTER TABLE `pupils`
  MODIFY `pupil_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

-- AUTO_INCREMENT pour la table `users`
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

-- Contraintes pour les tables déchargées
-- Contraintes pour la table `classes`
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_users_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

-- Contraintes pour la table `pupils`
ALTER TABLE `pupils`
  ADD CONSTRAINT `pupils_class_cat_id_FK` FOREIGN KEY (`class_cat_id`) REFERENCES `classes_categories` (`class_cat_id`),
  ADD CONSTRAINT `pupils_class_FK` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`),
  ADD CONSTRAINT `pupils_users_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;