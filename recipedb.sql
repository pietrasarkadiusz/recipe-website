-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 30 Sie 2022, 19:34
-- Wersja serwera: 10.4.24-MariaDB
-- Wersja PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `recipedb`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Breakfast'),
(2, 'Cake'),
(4, 'Dinner'),
(5, 'Dessert'),
(6, 'Lunch'),
(7, 'Snack');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ingredients`
--

CREATE TABLE `ingredients` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `ingredients`
--

INSERT INTO `ingredients` (`id`, `name`, `description`) VALUES
(1, 'eggs', ''),
(2, 'butter', 'softened'),
(3, 'white sugar', ''),
(4, 'lemon zest', ''),
(5, 'flour', ''),
(6, 'baking powder', ''),
(7, 'plums', 'pitted and quartered'),
(8, 'butter', 'softened'),
(9, 'white sugar', ''),
(10, 'egg yolks', ''),
(11, 'baking soda', ''),
(12, 'buttermilk', ''),
(13, 'flour', ''),
(14, 'bananas', 'mashed'),
(15, 'chopped pecans', ''),
(16, 'egg whites', ''),
(17, 'vegetable oil', ''),
(18, 'eggs', ''),
(19, 'white sugar', ''),
(20, 'vanilla extract', ''),
(21, 'flour', ''),
(22, 'ground cinnamon', ''),
(23, 'baking soda', ''),
(24, 'salt', ''),
(25, 'apples', 'peeled, cored and diced');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `measurements`
--

CREATE TABLE `measurements` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `measurements`
--

INSERT INTO `measurements` (`id`, `name`) VALUES
(1, 'cup'),
(2, 'cups'),
(3, 'teaspoon'),
(4, ' '),
(5, 'large ripe');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `quantities`
--

CREATE TABLE `quantities` (
  `id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `ingredient_id` int(11) NOT NULL,
  `measurement_id` int(11) NOT NULL,
  `quantity` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `quantities`
--

INSERT INTO `quantities` (`id`, `recipe_id`, `ingredient_id`, `measurement_id`, `quantity`) VALUES
(51, 56, 1, 5, 3),
(52, 56, 2, 5, 0.5),
(53, 56, 3, 5, 0.5),
(54, 56, 4, 4, 1),
(55, 56, 5, 3, 1),
(56, 56, 6, 2, 0.5),
(57, 56, 7, 1, 1.25),
(58, 57, 8, 5, 0.5),
(59, 57, 9, 4, 1.5),
(60, 57, 10, 4, 2),
(61, 57, 11, 3, 1),
(62, 57, 12, 2, 0.3),
(63, 57, 13, 2, 2),
(64, 57, 14, 1, 3),
(65, 57, 15, 1, 1),
(66, 57, 16, 1, 2),
(67, 58, 17, 4, 1),
(68, 58, 18, 3, 2),
(69, 58, 19, 3, 2),
(70, 58, 20, 3, 1),
(71, 58, 21, 3, 2),
(72, 58, 22, 2, 2),
(73, 58, 23, 2, 1),
(74, 58, 24, 2, 0.5),
(75, 58, 25, 1, 4);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `recipes`
--

CREATE TABLE `recipes` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `difficulty` varchar(20) NOT NULL,
  `servings` int(5) NOT NULL,
  `prep_time` int(11) NOT NULL,
  `cook_time` int(11) NOT NULL,
  `image` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `recipes`
--

INSERT INTO `recipes` (`id`, `category_id`, `user_id`, `name`, `description`, `difficulty`, `servings`, `prep_time`, `cook_time`, `image`) VALUES
(56, 2, 3, 'Plum Cake', 'This is a great cake for those who find the usual cakes too filling', 'Intermediate', 8, 20, 40, 'uploads/1661879941_happy-birthday-g4f8ff3568_1280.jpg'),
(57, 2, 3, 'Banana Layer Cake', 'This moist, delicious banana cake is topped with a rich caramel frosting.', 'Expert', 12, 30, 30, 'uploads/1661879925_cake-ga17a0929e_1280.jpg'),
(58, 2, 2, 'German Apple Cake', 'German apple cake is a moist, dense cake that keeps well. It has been a family favorite for 20 years', 'Expert', 24, 15, 45, 'uploads/1661879908_cake-gc33e86c5f_1280.jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `steps`
--

CREATE TABLE `steps` (
  `id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `description` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `steps`
--

INSERT INTO `steps` (`id`, `recipe_id`, `number`, `description`) VALUES
(1, 56, 1, 'Preheat oven to 375 degrees F (190 degrees C). Grease and flour one 9-inch tube pan.'),
(2, 56, 2, 'Separate the eggs. In a small bowl, beat the egg whites until stiff peaks form, and set aside.'),
(3, 56, 3, 'In a large bowl, cream the butter and sugar. Beat in the egg yolks and the lemon zest.'),
(4, 56, 4, 'Stir together the flour and baking powder and then blend the flour mixture into the creamed mixture. Gently fold in the egg whites. Spread the batter evenly into the prepared pan. There will only be a little over an inch of batter. Arrange the plums, skin'),
(5, 56, 5, 'Bake in preheated oven until a tester inserted in the center comes out clean, about 40 minutes. Transfer to a cooling rack and allow to cool before serving.'),
(6, 57, 1, 'Preheat oven to 350 degrees F (175 degrees C). Grease and flour 2 (8 inch) round pans.'),
(7, 57, 2, 'In a large bowl, cream together 1/2 cup butter and 1 1/2 cups sugar until light and fluffy. Beat in the egg yolks one at a time. Dissolve soda in buttermilk; add to creamed mixture alternately with flour, beginning and ending with flour. Stir in the mashe'),
(8, 57, 3, 'In a large glass or metal mixing bowl, beat egg whites until stiff peaks form. Fold 1/3 of the whites into the batter, then quickly fold in remaining whites until no streaks remain. Pour batter into prepared pans.'),
(9, 57, 4, 'Bake in the preheated oven for 30 to 35 minutes, or until a toothpick inserted into the center of the cake comes out clean. Let cool in pans for 10 minutes, then turn out onto a wire rack and cool completely. Spread Caramel Frosting between layers and on '),
(10, 57, 5, 'To make the Caramel Frosting: In a heavy saucepan, combine 1 1/4 cup sugar, 3/4 cup brown sugar, evaporated milk and 1/2 cup butter. Cook over medium heat, stirring frequently, until mixture reaches softball stage (240 degrees F; 116 degrees C). Remove fr'),
(11, 58, 1, 'Preheat the oven to 350 degrees F (175 degrees C). Grease and flour a 9x13-inch cake pan.'),
(12, 58, 2, 'Beat oil and eggs in a mixing bowl with an electric mixer until creamy. Add sugar and vanilla; beat well.'),
(13, 58, 3, 'Stir together flour, cinnamon, baking soda, and salt in a bowl. Slowly add flour mixture to egg mixture; mix until combined. The batter will be very thick. Fold in apples by hand using a wooden spoon. Spread batter into the prepared pan.'),
(14, 58, 4, 'Bake cake in the preheated oven until a toothpick inserted into the center comes out clean, about 45 minutes. Cool cake on a wire rack.');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `date` datetime NOT NULL,
  `permission` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `date`, `permission`, `password`, `image`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', '2022-08-20 12:03:20', 'super_admin', '$2y$10$8PKe4tMQtaIQOzUML2qDoOxxgcpyzQJR6oJ9I1gFo0W67IKn69.Di', ''),
(2, 'Jack', 'Smith', 'smith@gmail.com', '2022-08-20 22:30:53', 'admin', '$2y$10$8PKe4tMQtaIQOzUML2qDoOxxgcpyzQJR6oJ9I1gFo0W67IKn69.Di', ''),
(3, 'James', 'Shelton', 'shelton@gmail.com', '2022-08-21 18:16:18', 'user', '$2y$10$8PKe4tMQtaIQOzUML2qDoOxxgcpyzQJR6oJ9I1gFo0W67IKn69.Di', '');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `measurements`
--
ALTER TABLE `measurements`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `quantities`
--
ALTER TABLE `quantities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_recipe` (`recipe_id`),
  ADD KEY `fk_ingredient` (`ingredient_id`),
  ADD KEY `fk_measurement` (`measurement_id`);

--
-- Indeksy dla tabeli `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_category` (`category_id`),
  ADD KEY `fk_user` (`user_id`);

--
-- Indeksy dla tabeli `steps`
--
ALTER TABLE `steps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_recipe_steps` (`recipe_id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT dla tabeli `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT dla tabeli `measurements`
--
ALTER TABLE `measurements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `quantities`
--
ALTER TABLE `quantities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT dla tabeli `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT dla tabeli `steps`
--
ALTER TABLE `steps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `quantities`
--
ALTER TABLE `quantities`
  ADD CONSTRAINT `fk_ingredient` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`),
  ADD CONSTRAINT `fk_measurement` FOREIGN KEY (`measurement_id`) REFERENCES `measurements` (`id`),
  ADD CONSTRAINT `fk_recipe` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`);

--
-- Ograniczenia dla tabeli `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `fk_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ograniczenia dla tabeli `steps`
--
ALTER TABLE `steps`
  ADD CONSTRAINT `fk_recipe_steps` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
