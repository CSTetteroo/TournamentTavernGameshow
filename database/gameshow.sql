-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 28, 2025 at 01:05 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gameshow`
--

-- --------------------------------------------------------

--
-- Table structure for table `multiple_choice_questions`
--

CREATE TABLE `multiple_choice_questions` (
  `id` int UNSIGNED NOT NULL,
  `question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_a` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_b` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_c` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correct` enum('a','b','c') COLLATE utf8mb4_unicode_ci NOT NULL,
  `used` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `multiple_choice_questions`
--

INSERT INTO `multiple_choice_questions` (`id`, `question`, `option_a`, `option_b`, `option_c`, `correct`, `used`) VALUES
(1, 'Which was the first of these oaths to get reworked', 'Jetstriker', 'Silentheart', 'Visionshaper', 'a', 0),
(2, 'Which of these islands can you not purchase mantra modifiers from', 'Summer Isle', 'Miners Landing', 'Meteor Isle', 'a', 0),
(3, 'Which island got the biggest rework when verse 2 dropped', 'Summer Island', 'Songseeker Isle', 'Starswept Valley', 'b', 0),
(4, 'How many fins does primadon have?', '4', '6', '7', 'b', 0),
(5, 'What is the thundercall trainer called?', 'Blight', 'Electroz', 'Surge', 'c', 0),
(6, 'How many medium weapons have a 75 investment? (as of 2025-09-22)', '19', '20', '11', 'c', 0),
(7, 'What is the name of the location bridging miners landing to the starfield veldt', 'Saramaed Crossing', 'Saramaed Summit', 'Chariot\'s Spire', 'a', 0),
(8, 'Which of the following is NOT a stat that counts towards the Chainwarden stat requirement?', 'Willpower', 'Agility', 'Strength', 'b', 0),
(9, 'The glowing core of the black diver outfit is typically what colour?', 'White', 'Red', 'Yellow', 'c', 0),
(10, 'Who gives you the pleeksty inferno', 'Amorus Pleeksty', 'Aska', 'Amashi', 'b', 0),
(11, 'Which of these weapons has a unique critical', 'Forgotten Gladius', 'Canor Fang', 'Master Hawk\'s Handaxe', 'b', 0),
(12, 'Swift Rebound is a prerequisite to which of the following talents?', 'Evasive Expert', 'In a Hurry', 'Leaf in the Wind', 'a', 0),
(13, 'How many origins currently exist as of 2025-09-22?', '6', '8', '10', 'b', 0),
(14, 'The description \"After you land a flourish, gain the ability to shoot bullets for 5 seconds.\" belongs to what talent?', 'Parting Gift', 'Rapid Fire', 'Quick Draw', 'a', 0),
(15, 'The Nestmind, the Visionshaper oath giver, has how many faces?', '5', '6', '7', 'c', 0),
(16, 'What shrine rerolls your mantras?', 'Shrine of Mastery', 'Shrine of Conceit', 'Shrine of Temptation', 'c', 0),
(17, '\"An esoteric place even the most pious of men are known to seek out, though all take the secret to their graves.\" is the description of which area?', 'Temple of Hearts', 'Temple of the Forgotten Flame', 'Lightkeepers\' Temple', 'a', 0),
(18, 'When was the deepwoken discord established?', 'December 2021', 'October 2019', 'March 2020', 'a', 0),
(19, 'Which of these effects does the mantle of enmity not possess', 'Proccing critical talents on hit', 'Applying Wither on hit', 'Dealing true damage on hit', 'c', 0),
(20, 'Which number prophet is the Lord Regent?', '3rd', '4th', '5th', 'b', 0),
(21, 'What oath requires level 15?', 'Starkindred', 'Fadetrimmer', 'Dawnwalker', 'c', 0),
(22, 'Which weapon summons 3 pillars upon critical', 'Relic Axe', 'Master Hawk\'s Handaxe', 'Adretian Axe', 'a', 0),
(23, 'Which of these oaths cannot be re-obtained after oathbreaking?', 'Bladeharper', 'Arcwarder', 'Blindseer', 'b', 0),
(24, 'Which of the following mantras is compatible with a Magnet Spark?', 'Lightning Stream', 'Iron Tether', 'Ice Chains', 'b', 0),
(25, 'What monster weapon was retextured?', 'Enforcer', 'Sand Knight', 'Krysguards', 'a', 0),
(26, 'Which of these oaths cannot be skipped using knowledge', 'Blightsurger', 'Chainwarden', 'Starkindred', 'b', 0),
(27, 'What talent tree does \"STRENGTH UNBOUNDED\" belong to?', 'Beast', 'Strongman', 'One Eyed King', 'c', 0),
(28, 'Where is the NPC \"The Guy\" located?', 'Bluster Rift', 'Aratel Sea', 'Meteor Isle', 'a', 0),
(29, 'Which of these enemies is never seen wearing a head accessory', 'Grudge', 'Gigamed', 'Ministry Scout', 'b', 0),
(30, 'What exclusive item does \"The Guy\" give?', 'The Guy\'s Glasses', 'The Guy\'s Outfit', 'The Guy\'s Hat', 'a', 0),
(31, 'Which of these can a Wishmaker NOT do', 'Give you the EXP to reach P20', 'Grant an extra trait', 'Enchant a weapon with Astral', 'b', 0),
(32, 'Which of the following locations does NOT feature a Carbuncle spawn?', 'Starfield Tundra', 'Starfield Grove', 'Starfield Veldt', 'b', 0),
(33, 'Which of these oaths does not have a permanent visual indicator', 'Fadetrimmer', 'Arcwarder', 'Bladeharper', 'b', 0),
(34, 'Which talent gives you 10% extra resistance', 'Padded Armour', 'Exposed Durability', 'Exoskeleton', 'c', 0),
(35, 'How many gliders are in deepwoken', '3', '4', '5', 'b', 0),
(36, 'Who is not a dev for deepwoken?', 'Agamatsu', 'MikePike', 'Melonbeard', 'b', 0),
(37, 'Which spark makes dash usable twice in a row', 'Multiplying Spark', 'Spring Spark', 'Blast Spark', 'b', 0),
(38, 'What does it mean to be a deepwoken', 'Eating a Drowned God', 'Being a Prophet', 'Mastering an Attunement', 'a', 0),
(39, 'How many variants of skinned instruments are there', '3', '2', '4', 'a', 0),
(40, 'Clicking on a mantra modifier is supposed to lead you to the nearest', 'Blacksmith', 'Banker', 'Mantra Modifying Table', 'c', 0),
(41, 'Which equipment piece has the talent \"Temple Guard\"', 'Evanspear Warplate', 'Ascended Outlaw Hat', 'Monastery Champion\'s Robes', 'c', 0),
(42, 'What health percentage range do you need to be to proc shadow assault blast spark', 'Below 50%', 'Below 40%', 'Above 60%', 'b', 0),
(43, 'What color eyes does Primadon have', 'Yellow', 'Light Blue', 'Green', 'a', 0),
(44, 'How many legs does Widow have', '8', '6', '10', 'a', 0),
(45, 'How many scars does Elder Primadon have', '6', '7', '2', 'b', 0),
(46, 'How many eyes do Stone Knights have', '5', '3', '4', 'c', 0),
(47, 'How many naturally spawning event meteors are there?', '4', '5', '6', 'b', 0),
(48, 'How many Crazy Slot weapons are there', '5', '6', '7', 'b', 0),
(49, 'What color are the Crazy Slot weapons when corrupted', 'Vantablack', 'Purple', 'Pale White', 'b', 0),
(50, 'How many horns do Mudskippers have', '3', '4', '5', 'b', 0),
(51, 'How many eyes do Enforcers have', '4', '6', '2', 'b', 0),
(52, 'How many eyes does Bounder have', '8', '10', '12', 'c', 0),
(53, 'How many horns does Ethiron have', '2', '4', '0', 'b', 0),
(54, 'How many ships are there', '5', '6', '7', 'b', 0),
(55, 'How many rooms does a max guild base have?', '12', '13', '11', 'b', 0),
(56, 'How many disguise variants are there', '6', '7', '8', 'b', 0),
(57, 'How many non gold fish items are in the game', '5', '6', '7', 'b', 0),
(58, 'How many Ganymede hats are there', '3', '5', '6', 'a', 0),
(59, 'How many cannons does an Ironclad have?', '16', '18', '20', 'c', 0),
(60, 'Which foot does a brainsucker kick with', 'Right', 'Left', 'Hands', 'a', 0),
(61, '\"Your natural skill in mediating conflict makes people think more highly of you.\" is a part of which talent\'s description?', 'Pardon Me', 'Cult of Personality', 'Celebrity', 'c', 0);

-- --------------------------------------------------------

--
-- Table structure for table `qa_pairs`
--

CREATE TABLE `qa_pairs` (
  `id` int UNSIGNED NOT NULL,
  `question` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `used` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `qa_pairs`
--

INSERT INTO `qa_pairs` (`id`, `question`, `answer`, `used`) VALUES
(1, 'What is the name of the Bat race in Deepwoken?', 'Kiron', 0),
(2, 'What\'s dawnwalkers\' talent which empower your strikes with pure light.', 'luminous flash', 0),
(3, 'What level do you stop escaping the depths for free', 'Power 3', 1),
(4, 'Volu unlocks which legendary weapon by giving him three tomes?', 'Bloodfouler', 0),
(5, 'What was the name of the secret cave near summer isle that now is gone?', 'The hidden grove', 0),
(6, 'What was the og player for astral obtainment called?', 'The Wishmaker or Iltria', 0),
(7, 'What fighting style is supported by the Navaen War Chief schematic?', 'Way of Navae', 0),
(8, 'Which shrine lets you advance 3 power?', 'Shrine of Blasphemy', 0),
(9, 'Which oath is obtained directly from Yun’Shul?', 'Soulbreaker', 0),
(10, 'Name a weapon which requires a dormant splinter, but not a razor cutlass?', 'Fondant Splitter or Sanguine Transfuser', 0),
(11, 'Frosviernr Joraelnaero gives you which weapon?', 'Kyrswynter', 0),
(12, 'The Den Master is located at which location in the Etrean luminant?', 'Etris, Isle of Vigils', 1),
(13, 'What is the location of the other shadowcast trainer in the overworld?', 'Derelict Highchurch', 1),
(14, 'What star mantra is metal fakeout?', '2', 0),
(15, 'Which race is based on a moth?', 'Chrysid', 0),
(16, 'Where in layer two do you gain the union hook talent?', 'The Frontier Furnace', 0),
(17, 'Which stone knight has around a 1-2% chance to drop astral?', 'Moon Knight', 0),
(18, 'Which race is commonly depicted with Halos?', 'Lightborn', 1),
(19, 'What was the original obtainment method for Rhythm?', 'Ferryman', 0),
(20, 'Which (Spec) Enchant has the ability to proc every enchant on-hit?', 'Unstable', 0),
(21, 'Which legendary weapon currently in the game was community made?', 'Light’s Final Toll', 0),
(22, 'Which NPC untarnishes your bell for 1 knowledge?', 'Carrion', 0),
(23, 'Which ministry prophet granted Chaser his blood powers?', 'The Second Prophet', 0),
(24, 'What is the Hivelord’s Hubris strength stat requirement?', '60', 0),
(25, 'Which weapon has a baseball swing like critical?', 'Kanabo', 0),
(26, 'What attunement is layer three based on?', 'Flamecharm', 0),
(27, 'Who does Lord Regent wind up crucifying in the Duke quest?', 'Kennith', 0),
(28, 'Naerotiv is a Kyrsan NPC that is involved in obtaining which weapon?', 'Kyrswynter', 1),
(29, 'Where else do the layer two winds appear in the game outside of floor one?', 'Moon’s Eyrie', 0),
(30, 'Where is the dreadstar located?', 'Beloved Zofia', 0),
(31, 'What is the name of the dagger you can start with?', 'Stiletto', 0),
(32, 'The mace is a powerful weapon from which weapon class?', 'Medium Weapons', 0),
(33, 'Where can you find the NPC \"Rook Rethige\"?', 'Voidheart', 1),
(34, 'What do you give to arch_mage for a level 6 mantra?', 'Your soul', 1),
(35, 'Name one thing the \'vacant\' flaw does.', 'You cannot enter Castle Light nor can you partake in a Vow of Mastery.', 0),
(36, 'What flaw do you OFTEN gain when rerolling your Resonance?', 'Tarnished', 0),
(37, 'How many disciples do you need to talk to in order to get oathless?', '3', 1),
(38, 'Which emote emits a red and black stream from your eye?', 'Hoss', 0),
(39, 'Which area’s description is “A place remembered only by the waves.”?', 'Boatman’s Watch', 0),
(40, 'How many echoes are given when S rank is obtained?', '140', 0),
(41, 'What is the only echo modifier that gives 0.5x echoes?', 'Fragile Heart', 1),
(42, 'What oath gives the talent “Protagonist Syndrome”?', 'Dawnwalker', 0),
(43, 'What is considered the source of power for the Stormseye?', 'Kyrsan Medallions', 1),
(44, 'How much knowledge does Beiruul’s quest give?', '2', 0),
(45, 'What level is required for the Bloodforged Crown?', '15', 0),
(46, 'What area’s description is “What was stolen from below lies within.”?', 'Duke Erisia’s Manor', 0),
(47, 'What color is the Manor Key when not glowing?', 'Gray', 1),
(48, 'How many dying embers are required to gain the talent “Pleeksty’s Will”?', '3', 0),
(49, 'Where is the rep resetting NPC of The Hive located?', 'The Lordsgrove', 0),
(50, 'The Meteor Isle is territory of what faction?', 'Children of Navae', 0),
(51, 'What item is needed to light the flame pedestals in the Birdcage?', 'Soul Hearthgem', 0),
(52, 'What is the name of the Coral Fever assistant?', 'Destroyman III', 0),
(53, 'Where is the Flamecharm trainer located?', 'Songseeker Temple', 1),
(54, 'Is the worshipper longshield a real item?', 'no', 0),
(55, 'What is the colour of The Ferryman\'s Lightning?', 'Purple', 0),
(56, 'What color of flame is seen in game but not as a part of weapons or mantras?', 'Purple', 0),
(57, 'where is the body of fire korilfiend found? [lore]', 'the vents the third layer', 0),
(58, 'What talent has the highest stat requirement?', 'Chorus of souls (210)', 0),
(59, 'What guild base room has an Artisan in it?', 'Trophy Room', 0),
(60, 'What origin used to be a flaw?', 'Deepbound', 0),
(61, 'What character says the line: “A rose, a cornflower, and perhaps a hyacinth appear to me in a dream.”?', 'Miserables', 0),
(62, 'Which mantra is unlocked from beating Duke Erisia?', 'Pillars of Erisia', 0),
(63, 'What is the name of the person who unbounds your fortitude?', 'Brutus', 0),
(64, 'Which stat is trained by getting spam grip cancelled?', 'Fortitude', 0),
(65, 'What is the weapon skin won by winning a artist competition', 'PaintBrush', 1),
(66, 'Who are the Hundred Legions investigating in the Etrean Luminant?', 'The Central Authority', 0),
(67, 'What is the name of the main island in the Central Luminant?', 'Markor', 1),
(68, 'What is the hero blade oath called?', 'Saintsworn', 0),
(69, 'What weapon does the ironsing trainer use against Silenthearts?', 'Darksteel Greatsword', 0),
(70, 'Obtaining an oath disables which shrine?', 'Shrine of Order', 0),
(71, 'What color do your eyes turn when you get Linkstrider?', 'Light blue', 0),
(72, 'What is the name of the NPC that gives you the Windwaker talent?', 'Stratos', 0),
(73, 'What potion does the Shadowcast trainer give you to unlock Shadowcast?', 'Nightblood', 0),
(74, 'What enemy is the only enemy that can attack you with a pickaxe?', 'Mudskipper', 0),
(75, 'How much knowledge does the Harrowing Enchant Stone cost?', '10 knowledge', 0),
(76, 'How much joy did the Halloween ‘22 Medal cost?', '200', 0),
(77, 'What enemy is the only enemy that can drop the Markor’s Inheritor directly?', 'Lost Divers', 0),
(78, 'What NPC says “If you value your life, you will run”?', 'Windrunner', 0),
(79, 'What is the smallest amount of medallions that can be found in a Kyrsan Medallion chest?', '5', 0),
(80, 'Who corrupts the Kyrsgarde minds in New Kyrsa?', 'Ethiron', 0),
(81, 'Who is a lightborn trapped in the outskirts of New Kyrsa?', 'Kaide', 0),
(82, 'What is the “snow” in Floor 1 made out of?', 'Parasites', 0),
(83, 'What group of people still believes in using the Song from the Old World?', 'Songseekers', 0),
(84, 'What is one of the two mantras that a round spark can be used on?', 'Fire Gun or Ice Eruption', 0),
(85, 'What NPC says “Do you have the knowledge within you then, my dull friend?”?', 'Miserables', 0),
(86, 'What is the last echo talent to be unlocked?', 'Thresher Scales', 0),
(87, 'What is the only element that will never be an attunement?', 'Water', 0),
(88, 'What wisp grants passive tempo?', 'Shadow', 0),
(89, 'What mechanic allows you to get a Stormseye and Crypt Blade in the same chest?', 'Fishing', 0),
(90, 'Which triumph gives the most echoes at one time?', 'Obtaining a Resonance', 0),
(91, 'What is the most amount of points that you can have in one attribute at once?', '102', 0),
(92, 'Aside from Akira, who is the only seen character with a ring named after them?', 'Maestro Evengarde Rest', 1),
(93, 'The weapons unbound talents are in which talent category?', 'Saint of Blades', 0),
(94, 'How is it possible for the players to go across luminants? [lore]', 'the interstitial lighthouse/lighthouse', 0),
(95, 'What origin does bounties to progress', 'Voidwalker', 0),
(96, 'What is your depths trial at power 1, with diver origin?', 'Enforcer', 0),
(97, 'Next to sanity what stat does willpower also increase?', 'Tempo', 0),
(98, 'What Layer is New Kyrsa in?', 'two', 0),
(99, 'How much Thundercall does surge path require?', '40', 0),
(100, 'What talent allows Lord’s Slice to be used?', 'Hidden Tendril', 0),
(101, 'How many Sky Statues exist?', '3', 0),
(102, 'What is the name of the miniboss that drops the Deepspindle?', 'Ministry Cache Agent', 0),
(103, 'What enchant deals AoE damage on all weapon hits?', 'Wild', 0),
(104, 'What talent used to make blood run out faster when hitting people whilst downed?', 'Bloodletter', 0),
(105, 'Which type of mantra is lightning cloak?', 'Mobility', 0),
(106, 'What star mantra is Tornado?', '0', 0),
(107, 'In what location is the Skyvalor Lotus located?', 'Crypt of the Unbroken', 0),
(108, 'Which weapon has a 30 second cooldown on its critical?', 'First Light', 0),
(109, 'Which deep shrine has the ability to trade out one trait for another?', 'Shrine of Mastery', 0),
(110, 'The Pleeksty’s Inferno initially required how much Flamecharm?', '90', 0),
(111, 'All hero blades require how much attunement stat?', '75', 0),
(112, 'Which oath saves pathfinders from the depths?', 'Blindseer', 0),
(113, 'Name one talent needed to get Blindseer.', 'Breathing Exercise, Conquer your Fears and Disbelief', 0),
(114, 'What are the entities called that spot you and spawn angels on you?', 'Watchers', 0),
(115, 'What is the name of the event that lead to the start of Deepwoken? [lore]', 'The Tides', 0),
(116, 'What equipment piece do you need to have equipped to obtain blindseer?', 'A blindfold', 0),
(117, 'What is the second obtainment method for soulbreaker, involving a boss?', 'Using a sinner\'s ash in Duke\'s dungeon', 1),
(118, 'What is the talent reroll shrine called?', 'Shrine of Chance', 0),
(119, 'Who is the strongest character known in Deepwoken? [lore]', 'The First Prophet', 0),
(120, 'Which Prophet of the Ministry gave Chaser and his apprentices the power of Bloodrend?', 'The Second Prophet', 1),
(121, 'Finish this sentence: \"Vermin! You seek to let Celtor What?\"', 'Repeat / You seek to let Celtor repeat', 0),
(122, 'How many 0 star mantras does Flamecharm currently have?', '7', 0),
(123, 'Finish this sentence: \"This one\'s sanity must\'ve What?\"', 'Already Crumbled / This one\'s sanity must\'ve already crumbled', 1),
(124, 'What is the name of every island containing an NPC selling mantra modifiers?', 'Isle of Vigils, Miners Landing, Meteor Isle', 0),
(125, 'What single ingame item sells for the most notes without any selling modifiers?', 'Champion\'s Alloy', 0),
(126, 'Before the name \"Deepwoken\", what was the game called?', 'Drowned Gods', 0),
(127, 'Finish this sentence for the description of Starswept Valley: \"Glimmers of starlight mingle with the pungent rot that afflicts these What?\"', 'Lifeless sands / sentence + lifeless sands', 0),
(128, 'What is the max amount of Kyrsan Medallions you can hold outside of Layer 2?', '250', 0),
(129, 'Which was the first of these Oath to get reworked? Was it either, Jetstriker, Silentheart, or Visionshaper?', 'Jetstriker', 0),
(130, 'True or False: Ironsing has no talents with mutual exclusives', 'False, the Rending Needle talents are exclusive with each other', 0),
(131, 'True or False: A fully charged Veinbreaker does enough damage to instantly guardbreak most builds.', 'False, rather then dealing higher posture, it instead fully bypasses block', 0),
(132, 'How many 3 star mantras does Frostdraw and Ironsing have combined?', '9', 0),
(133, 'True or False: There are no monster mantras in the Support category', 'False, Enforcer Pull', 0),
(134, 'Which of these is not a real talent? Is it either, Devastating Power, Vasculitis, Dispatch, or Haemostasis?', 'Haemostasis', 0),
(135, 'True or False: Visionshaper once had a Willpower requirement?', 'True', 0),
(136, 'Which oath has this oathbreak dialogue from Yun\'shul?: \"Was this not the future we sought? Perhaps not.\"', 'Bladeharper', 0),
(137, 'What was the name of Deepwokens first April Fools Event?', 'Mudwoken', 0),
(138, 'What is the name of Aelita\'s brother?', 'Tillian', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `multiple_choice_questions`
--
ALTER TABLE `multiple_choice_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qa_pairs`
--
ALTER TABLE `qa_pairs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `multiple_choice_questions`
--
ALTER TABLE `multiple_choice_questions`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `qa_pairs`
--
ALTER TABLE `qa_pairs`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
