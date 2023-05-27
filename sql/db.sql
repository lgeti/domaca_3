DROP DATABASE IF EXISTS recipesi;
CREATE DATABASE recipesi;
USE recipesi;

-- Create the user table
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Insert data into the user table
INSERT INTO `user` (`username`, `password`) VALUES
('john', 'password123'),
('emma', 'securepass'),
('mark', 'letmein'),
('sarah', '123456');

-- Create the group table
CREATE TABLE IF NOT EXISTS `group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Insert data into the group table
INSERT INTO `group` (`name`, `description`) VALUES
('Family Recipes', 'A group for sharing favorite family recipes'),
('Baking Enthusiasts', 'A group for passionate baking enthusiasts'),
('Healthy Eaters', 'A group for exchanging healthy eating tips and recipes');

-- Create the recipe table
CREATE TABLE IF NOT EXISTS `recipe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `ingredients` text NOT NULL,
  `instructions` text NOT NULL,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`group_id`) REFERENCES `group` (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Insert data into the recipe table
INSERT INTO `recipe` (`title`, `description`, `ingredients`, `instructions`, `group_id`, `user_id`) VALUES
('Chocolate Chip Cookies', 'Classic homemade chocolate chip cookies', '1 cup butter, 1 cup sugar, 1 cup brown sugar, 2 eggs, 1 tsp vanilla extract, 3 cups all-purpose flour, 1 tsp baking soda, 1/2 tsp salt, 2 cups chocolate chips', '1. Preheat oven to 375°F. 2. In a large bowl, cream together butter, sugar, and brown sugar. 3. Beat in eggs and vanilla. 4. In a separate bowl, combine flour, baking soda, and salt. Gradually add dry ingredients to the creamed mixture. 5. Stir in chocolate chips. 6. Drop rounded tablespoonfuls of dough onto ungreased baking sheets. 7. Bake for 9-11 minutes or until golden brown. 8. Allow to cool on baking sheets for a few minutes before transferring to wire racks to cool completely.', 1, 1),
('Vegetable Stir-Fry', 'Quick and healthy vegetable stir-fry', '2 cups mixed vegetables (broccoli, bell peppers, carrots, snap peas), 2 cloves garlic (minced), 2 tbsp soy sauce, 1 tbsp sesame oil, 1 tbsp olive oil, 1 tsp ginger (minced), salt and pepper to taste', '1. Heat olive oil in a large skillet or wok over medium-high heat. 2. Add minced garlic and ginger, and cook for 1 minute. 3. Add mixed vegetables and stir-fry for 3-5 minutes, until tender-crisp. 4. In a small bowl, whisk together soy sauce, sesame oil, salt, and pepper. 5. Pour the sauce over the vegetables and stir to coat evenly. 6. Cook for an additional 1-2 minutes. 7. Serve hot.', 3, 2),
('Spaghetti Bolognese', 'Classic Italian pasta dish', '8 oz spaghetti, 1 lb ground beef, 1 onion (chopped), 2 cloves garlic (minced), 1 can crushed tomatoes, 2 tbsp tomato paste, 1 tsp dried basil, 1 tsp dried oregano, salt and pepper to taste, grated Parmesan cheese (for serving)', '1. Cook spaghetti according to package instructions. 2. In a large skillet, brown ground beef over medium heat. 3. Add chopped onion and minced garlic, and cook until onion is translucent. 4. Stir in crushed tomatoes, tomato paste, dried basil, dried oregano, salt, and pepper. Simmer for 15-20 minutes. 5. Serve the Bolognese sauce over cooked spaghetti. 6. Sprinkle with grated Parmesan cheese before serving.', 1, 3);

-- Create the message table
CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`group_id`) REFERENCES `group` (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
