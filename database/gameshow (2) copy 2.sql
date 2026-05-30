-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 03, 2025 at 01:09 PM
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
  `id` int NOT NULL,
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
(5, 'What is the thundercall trainer called?', 'Blight', 'Electroz', 'Surge', 'c', 0),
(7, 'What is the name of the location bridging miners landing to the starfield veldt', 'Saramaed Crossing', 'Saramaed Summit', 'Chariot\'s Spire', 'a', 0),
(8, 'Which of the following is NOT a stat that counts towards the Chainwarden stat requirement?', 'Willpower', 'Agility', 'Strength', 'b', 0),
(9, 'The glowing core of the black diver outfit is typically what colour?', 'White', 'Red', 'Yellow', 'c', 0),
(10, 'Who gives you the pleeksty inferno', 'Amorus Pleeksty', 'Aska', 'Amashi', 'b', 0),
(11, 'Which of these weapons has a unique critical', 'Forgotten Gladius', 'Canor Fang', 'Master Hawk\'s Handaxe', 'b', 0),
(12, 'Swift Rebound is a prerequisite to which of the following talents?', 'Evasive Expert', 'In a Hurry', 'Leaf in the Wind', 'a', 1),
(14, 'The description \"After you land a flourish, gain the ability to shoot bullets for 5 seconds.\" belongs to what talent?', 'Parting Gift', 'Rapid Fire', 'Quick Draw', 'a', 0),
(15, 'The Nestmind, the Visionshaper oath giver, has how many faces?', '5', '6', '7', 'c', 0),
(16, 'What shrine rerolls your mantras?', 'Shrine of Mastery', 'Shrine of Conceit', 'Shrine of Temptation', 'c', 0),
(17, '\"An esoteric place even the most pious of men are known to seek out, though all take the secret to their graves.\" is the description of which area?', 'Temple of Hearts', 'Temple of the Forgotten Flame', 'Lightkeepers\' Temple', 'a', 1),
(18, 'When was the deepwoken discord established?', 'December 2021', 'October 2019', 'March 2020', 'a', 1),
(19, 'Which of these effects does the mantle of enmity not possess', 'Proccing critical talents on hit', 'Applying Wither on hit', 'Dealing true damage on hit', 'c', 0),
(20, 'Which number prophet is the Lord Regent?', '3rd', '4th', '5th', 'b', 1),
(21, 'What oath requires level 15?', 'Starkindred', 'Fadetrimmer', 'Dawnwalker', 'c', 0),
(22, 'Which weapon summons 3 pillars upon critical', 'Relic Axe', 'Master Hawk\'s Handaxe', 'Adretian Axe', 'a', 0),
(23, 'Which of these oaths cannot be re-obtained after oathbreaking?', 'Bladeharper', 'Arcwarder', 'Blindseer', 'b', 0),
(24, 'Which of the following mantras is compatible with a Magnet Spark?', 'Lightning Stream', 'Iron Tether', 'Ice Chains', 'b', 0),
(25, 'What monster weapon was remodeled?', 'Enforcer', 'Sand Knight', 'Krysguards', 'a', 0),
(26, 'Which of these oaths cannot be skipped using knowledge', 'Blightsurger', 'Chainwarden', 'Starkindred', 'b', 0),
(27, 'What talent tree does \"STRENGTH UNBOUNDED\" belong to?', 'Beast', 'Strongman', 'One Eyed King', 'c', 0),
(28, 'Where is the NPC \"The Guy\" located?', 'Bluster Rift', 'Aratel Sea', 'Meteor Isle', 'a', 0),
(29, 'Which of these enemies is never seen wearing a head accessory', 'Grudge', 'Gigamed', 'Ministry Scout', 'b', 0),
(30, 'What exclusive item does \"The Guy\" give?', 'The Guy\'s Glasses', 'The Guy\'s Outfit', 'The Guy\'s Hat', 'a', 1),
(31, 'Which of these can a Wishmaker NOT do', 'Give you the EXP to reach P20', 'Grant an extra trait', 'Enchant a weapon with Astral', 'b', 0),
(32, 'Which of the following locations does NOT feature a Carbuncle spawn?', 'Starfield Tundra', 'Starfield Grove', 'Starfield Veldt', 'b', 0),
(33, 'Which of these oaths does not have a permanent visual indicator', 'Fadetrimmer', 'Arcwarder', 'Bladeharper', 'b', 0),
(34, 'Which talent gives you 10% extra resistance', 'Padded Armour', 'Exposed Durability', 'Exoskeleton', 'c', 0),
(35, 'How many gliders are in deepwoken?', '2', '4', '3', 'b', 0),
(36, 'Who is not a dev for deepwoken?', 'Agamatsu', 'MikePike', 'Melonbeard', 'b', 0),
(37, 'Which spark makes dash usable twice in a row', 'Multiplying Spark', 'Spring Spark', 'Blast Spark', 'b', 0),
(38, 'What does it mean to be a deepwoken', 'Eating a Drowned God', 'Being a Prophet', 'Mastering an Attunement', 'a', 0),
(39, 'How many variants of skinned instruments are there?', '3', '2', '4', 'a', 0),
(40, 'Clicking on a mantra modifier is supposed to lead you to the nearest', 'Blacksmith', 'Banker', 'Mantra Modifying Table', 'c', 0),
(41, 'Which equipment piece has the talent \"Temple Guard\"', 'Evanspear Warplate', 'Ascended Outlaw Hat', 'Monastery Champion\'s Robes', 'c', 0),
(42, 'What health percentage range do you need to be to proc shadow assault blast spark', 'Below 50%', 'Below 40%', 'Above 60%', 'b', 0),
(43, 'What color eyes does Elder Primadon have?', 'Yellow', 'Light Blue', 'Green', 'a', 0),
(44, 'How many legs does Widow have?', '8', '6', '10', 'a', 0),
(46, 'How many working eyes do Stone Knights have?', '5', '3', '4', 'c', 0),
(48, 'How many Crazy Slot weapons are there?', '5', '6', '7', 'b', 0),
(49, 'What color are the Crazy Slot weapons when corrupted', 'Vantablack', 'Purple', 'Pale White', 'b', 0),
(51, 'How many Eyes do Enforcers have?', '4', '6', '2', 'b', 0),
(53, 'How many main antenae does Ethiron have?', '2', '4', '0', 'b', 0),
(54, 'How many ships are in Deepwoken?', '5', '6', '7', 'b', 0),
(55, 'How many rooms does it say a max guild base has?', '12', '13', '11', 'b', 0),
(56, 'How many disguise variants are there?', '3', '7', '11', 'b', 0),
(58, 'How many Ganymede hats are there currently?', '3', '4', '5', 'a', 0),
(60, 'Which foot does a brainsucker kick with', 'Right', 'Left', 'Hands', 'a', 0),
(61, '\"Your natural skill in mediating conflict makes people think more highly of you.\" is a part of which talent\'s description?', 'Pardon Me', 'Cult of Personality', 'Celebrity', 'c', 0),
(62, 'What is Warmonger\'s talent called?', 'Pugnacious', 'Warlord', 'True Soldier', 'a', 0),
(63, 'What\'s the old Whistling Periapt name?', 'Unstable Pendant', 'Wind Amulet', 'Ishamon\'s Necklace', 'b', 1),
(64, 'What is Nuttoon\'s main slot called?', 'Stag Acrosses', 'Stag Abcrossus', 'Stag Acrossus', 'c', 0),
(65, 'What is a Twinblade\'s Spinecutter talent called?', 'Turning of the Wheel', 'Bone Cutter', 'Face Cutter', 'c', 1),
(66, 'Find which bell pip combo doesn\'t exist:', 'Blood Scourge: Throw, Size', 'Sacred Field: Sanity, Elemental, Physical Resistances', 'Teleportation: Cooldown, Speed, Waypoints', 'c', 1),
(67, 'What talent makes your Graceful Flame burn in the Depths?', 'Flame of Denial', 'Dying Flame', 'Undying Flame', 'c', 0),
(68, 'What Surge talent converts your Surge stacks into Ether?', 'Human Battery', 'Fried Circuits', 'Living Battery', 'a', 0),
(69, 'For what oath obtainment do you have to speak to the NPC Cerulian?', 'Jetstriker', 'Oathless', 'Chainwarden', 'b', 0),
(70, 'What is the price of a Megurger at Lance Leshi\'s Restaurant?', '15', '20', '25', 'a', 0),
(71, 'What is the base damage of the starter sword?', '20', '18', '16', 'b', 0),
(72, 'Which direction does the loading icon spin on the Deepwoken menu?', 'It doesn\'t', 'Counter-Clockwise', 'Clockwise', 'c', 0),
(73, 'What weapon does Polis polish at his resting spot?', 'Shattered Katana', 'Darksteel Greatsword', 'Anklets of Alsin', 'b', 0),
(74, 'What text appears when obtaining a Jetstriker Orb?', 'I feel the ancients rush past me...', 'I feel the winds rush through my body...', 'I must seek out more to further my training...', 'b', 0),
(75, 'What is the race of the chef \"Chef Odiolavoro\"?', 'Felinor', 'Etrean', 'Gremor', 'a', 0),
(76, 'Which one of these weapons has the slowest swing speed?', 'Quartzone Pickaxe', 'Messer', 'Formless Shard', 'b', 0),
(77, 'What are the equip requirements for the chef weapons?', '70 WPN, 15 INT', '75 WPN, 15 CHA', '70 WPN, 15 CHA, 15 INT', 'c', 0),
(78, 'Which food does NOT exist?', 'Heavy Steak', 'Pufferfish Stew', 'Crab Pizza', 'b', 0),
(79, 'What was the original default TP location after speaking to Voidmother for the first time?', 'Songseeker', 'Lower Erisia', 'The Shores of Etris', 'a', 0),
(80, 'What is Fadetrimmer\'s Barber Skillset Hair Spray healing?', '10% healing, percent based healing', '50 flat HP healing', '25 flat HP healing', 'a', 0),
(81, 'What is the NPC named for the quest dubbed \"Mantra quest\"?', 'Calsius', 'Kelsieus', 'Kelsius', 'c', 0),
(82, 'Which is NOT an existing aspect/subrace?', 'Auroran', 'Aberrant Capra', 'Elder Vesperian', 'c', 0),
(83, 'What is the name of the person you need to avenge for Arthur\'s Megalodaunt Slayer quest?', 'Amara', 'Maria', 'Ivory', 'b', 1),
(84, 'Which one of these is not a real Deepwoken book?', 'The Interrogation of Ranger Santiago Talo', 'Ossuary Maintenance', 'Operation \'Contractor\'', 'c', 0),
(85, 'How many Aces are awarded by completing Elykris\'s Ministry book quest at Minityrsa?', '3', '5', '2', 'a', 0),
(86, 'What does Duke Ishamon Erisia\'s bell do?', 'Summons Prime Golems', 'Activates his parry shield', 'Summons & controls his subordinate NPCs', 'a', 0),
(87, '\"Perpetual Distillery\" is a talent from which oath?', 'Visionshaper', 'Fadetrimmer', 'Saltchemist', 'c', 0),
(88, 'Which emote doesn\'t come from a gamepass?', 'Griddy', 'Caramell', 'Headbang', 'c', 0),
(89, 'Which of these attacks does the most damage on light weapons (no talents)?', 'Running Attack', 'Aerial', 'Uppercut', 'c', 0);

-- Appended new multiple choice questions (IDs 90-106). Ambiguity note: For the
-- "WORST teams" question both A and C were marked in source chat; selected C as the single correct answer.
INSERT INTO `multiple_choice_questions` (`id`, `question`, `option_a`, `option_b`, `option_c`, `correct`, `used`) VALUES
(90, 'Which team won the 2024 April Fools event?', 'Blue Skippers', 'Red Daunts', 'Green Threshers', 'b', 0),
(91, 'What were the WORST teams in the 2024 April Fools event?', 'Blue Skippers', 'Red Daunts', 'Green Threshers', 'c', 0),
(92, 'What was the renamed and now unobtainable version of the Rifle Spear called?', 'Moonseye Scalpel', 'Serpant\'s Eclipse', 'Nightveil Longshot', 'a', 0),
(93, 'Which of these weapons does not have a unique critical?', 'Darksteel Longsword', 'Avenger', 'Halberd', 'b', 0),
(94, 'What were the Worldpiercer Gauntlets named before the Titus Dungeon release', 'Titus Gauntlets', 'Imperius Gauntlets', 'Fists of Domination', 'a', 0),
(95, 'What pitch must you choose for the Rhythm Murmur trials?', 'Low', 'Medium', 'High', 'a', 0),
(96, 'What stat does Tacet scale with', 'Weapon', 'Agility', 'Willpower', 'b', 0),
(97, 'What ring makes your rhythm detection radius 50% larger', 'Charged Ring', 'Akira\'s Ring', 'Ferryman\'s Ring', 'c', 0),
(98, 'How many ores do you need to obtain Ironsing?', '6', '5', '7', 'a', 0),
(99, 'What talent is required to gain Ether from consuming elemental ingredients?', 'Pleeksty\'s Will', 'Termite', 'Elemental Ether', 'a', 0),
(100, 'What trial lets you enter the Diluvian Mechanism with as many players as you\'d like (below Power 3)?', 'Trial of One', 'Trial of the Meek', 'Trial of Many', 'b', 0),
(101, 'Which attuned monster type gives them 50% physical resistance?', 'Flamewreathed', 'Frostmantle', 'Shadowmeld', 'c', 0),
(102, 'What is the green Sharko rarely found in the Depths named?', 'Prime Sharko', 'Lifelord Sharko', 'Exotic Sharko', 'c', 0),
(103, 'What is the name of the Linkstrider meteor near Sibex (Bell progress NPC)', 'Eunomia', 'Fortuna', 'Ceres', 'a', 0),
(104, 'Which Oath requires you to kill people to obtain?', 'Contractor', 'Linkstrider', 'Blindseer', 'b', 0),
(105, 'What does the NPC “Rook Rethige” sell?', 'Krulian Knives', 'Gilded Knives', 'Whaling Knives', 'c', 0),
(106, 'What\'s the requirement for obtaining The Guy\'s Glasses?', '0 CHA', '40 CHA', '50 CHA', 'c', 0);

-- --------------------------------------------------------

--
-- Table structure for table `qa_pairs`
--

CREATE TABLE `qa_pairs` (
  `id` int UNSIGNED NOT NULL,
  `question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `difficulty` tinyint NOT NULL DEFAULT '1',
  `used` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `qa_pairs`
--

INSERT INTO `qa_pairs` (`id`, `question`, `answer`, `difficulty`, `used`) VALUES
(1, 'What is the name of the Bat race in Deepwoken?', 'Kiron', 1, 0),
(2, 'What''s Dawnwalker''s talent which empowers your strikes with pure light?', 'Luminous Flash', 2, 0),
(3, 'What level do you stop escaping the Depths for free?', 'Power 3', 1, 0),
(4, 'Volu unlocks which legendary weapon by giving him three tomes?', 'Bloodfouler', 2, 0),
(5, 'What was the name of the secret cave near Summer Isle that now is gone?', 'The Hidden Grove', 3, 0),
(6, 'How was Astral obtained before the addition of the Resonant Dawn event?', 'The Wishmaker / Iltria', 3, 0),
(7, 'What fighting style is buffed by the Navaen War Chief schematic?', 'Way of Navae', 1, 0),
(8, 'Which shrine lets you advance 3 power?', 'Shrine of Blasphemy', 1, 0),
(9, 'Which oath is obtained directly from Yun''Shul?', 'Soulbreaker', 2, 0),
(10, 'What weapon requires Heartstars to craft?', 'Sanguine Transfuser', 2, 0),
(11, 'The Den Master is located at which location in the Etrean Luminant?', 'Etris / Isle of Vigils', 2, 0),
(12, 'What is the location of the other Shadowcast trainer in the overworld?', 'Derelict Highchurch', 2, 0),
(13, 'What star mantra is Metal Fakeout?', '2-Star', 2, 0),
(14, 'Which race is based on a moth?', 'Chrysid', 1, 0),
(15, 'Where in Layer 2 do you gain the Union Hook talent?', 'The Frontier Furnace', 2, 0),
(16, 'Which Stone Knight has around a 1-2% chance to drop Astral?', 'Moon Knight', 2, 0),
(17, 'Which race is commonly depicted with halos?', 'Lightborn', 1, 0),
(18, 'Which (Spec) enchant has the ability to proc every enchant on-hit?', 'Unstable', 2, 0),
(19, 'Which legendary weapon currently in the game was community made?', 'Light''s Final Toll', 1, 0),
(20, 'Which NPC untarnishes your Bell for 1 Knowledge?', 'Carrion', 2, 0),
(21, 'What is the Hivelord''s Hubris Strength stat requirement?', '60 Strength', 2, 0),
(22, 'Which weapon has a baseball swing-like critical?', 'Kanabo', 2, 0),
(23, 'What attunement is Layer 3 based on?', 'Flamecharm', 1, 0),
(24, 'Who does Lord Regent wind up crucifying in the Duke quest?', 'Kennith', 1, 0),
(25, 'Naerotiv is a Kyrsan NPC involved in obtaining what?', 'The Kyrswynter', 2, 0),
(26, 'Where else do the Layer 2 winds appear outside of Floor 1?', 'Moon''s Eyrie', 2, 0),
(27, 'Where is the Dreadstar located?', 'Beloved Zofia', 1, 0),
(28, 'What is the name of the dagger you can start with?', 'Stiletto', 1, 0),
(29, 'Where can you find the NPC "Rook Rethige"?', 'Voidheart', 2, 0),
(30, 'Name one thing the "Vacant" flaw does.', 'You cannot enter Castle Light OR partake in a Vow of Mastery', 2, 0),
(31, 'What flaw do you gain normally when rerolling your Resonance?', 'Tarnished', 1, 0),
(32, 'How many disciples do you need to talk to in order to get Oathless?', '3', 1, 0),
(33, 'Which emote emits a red and black stream from your eye?', 'Hoss', 1, 0),
(34, 'Which area''s description is: "A place remembered only by the waves."', 'Boatman''s Watch', 1, 0),
(35, 'How many echoes are given when S Rank is obtained?', '140', 2, 0),
(36, 'What is the only Echo modifier that gives 0.5x echoes?', 'Fragile Heart', 3, 0),
(37, 'What oath gives the talent "Protagonist Syndrome"?', 'Dawnwalker', 2, 0),
(38, 'What is considered the source of power for the Stormseye?', 'Kyrsan Medallions', 1, 0),
(39, 'How much Knowledge does Beiruul''s quest give?', '2', 2, 0),
(40, 'What level is required for the Bloodforged Crown?', '10', 2, 0),
(41, 'What area''s description is: "What was stolen from below lies within."', 'Duke Erisia''s Manor', 2, 0),
(42, 'How many Dying Embers are required to gain the talent "Pleeksty''s Will"?', '3', 2, 0),
(43, 'Where is the rep-resetting NPC of The Hive located?', 'The Lordsgrove', 1, 0),
(44, 'Meteor Isle is territory of what faction?', 'Children of Navae', 1, 0),
(45, 'What item is needed to light the flame pedestals in the Birdcage?', 'Soul Hearthgem', 2, 0),
(46, 'What is the name of the Coral Fever assistant?', 'Destroyman III', 1, 0),
(47, 'What building is the Flamecharm trainer located?', 'Songseeker Temple', 1, 0),
(48, 'Is the Worshipper Longshield a real item?', 'No', 1, 0),
(49, 'Is the Sweetgourd a real item?', 'Yes', 1, 0),
(50, 'Where is Korilfiend found?', 'The vents in the Third Layer/Layer 3', 2, 0),
(51, 'What talent has the highest stat requirement?', 'Chorus of Souls (210)', 3, 0),
(52, 'What guild base room has an Artisan in it?', 'Trophy Room', 3, 0),
(53, 'What origin used to be a flaw?', 'Deepbound', 1, 0),
(54, 'Who says the line: "A rose, a cornflower, and perhaps a hyacinth appear to me in a dream."', 'Miserables', 2, 0),
(55, 'Which mantra is unlocked from beating Duke Erisia?', 'Pillars of Erisia', 1, 0),
(56, 'What weapon skin was won by winning an artist competition?', 'PaintBrush', 2, 0),
(57, 'Who are the Hundred Legions investigating in the Etrean Luminant?', 'The Central Authority', 3, 0),
(58, 'What is the name of the main island in the Central Luminant?', 'Markor', 3, 0),
(59, 'What weapon does the Ironsing trainer use against Silenthearts?', 'Darksteel Greatsword', 1, 0),
(60, 'Obtaining an oath (aside from Oathless) disables which shrine?', 'Shrine of Order', 1, 0),
(61, 'What color do your eyes turn when you get Linkstrider?', 'Light Blue', 1, 0),
(62, 'What is the name of the NPC that gives you the Windwaker talent?', 'Stratos', 1, 0),
(63, 'What potion does the Shadowcast trainer give you to unlock Shadowcast?', 'Nightblood', 2, 0),
(64, 'What enemy is the only enemy that can attack you with a pickaxe?', 'Mineskipper', 2, 0),
(65, 'How much Knowledge does the Harrowing Enchant Stone cost?', '10 Knowledge', 2, 0),
(66, 'How much Joy did the Halloween ''22 Medal cost?', '200', 3, 0),
(67, 'What enemy is the only enemy that can directly drop Markor''s Inheritor?', 'Lost Divers', 3, 0),
(68, 'What NPC says: "If you value your life, you will run."', 'Windrunner', 2, 0),
(69, 'Who corrupts the Kyrsgarde minds in New Kyrsa?', 'Ethiron', 2, 0),
(70, 'Who is a Lightborn trapped in the outskirts of New Kyrsa?', 'Kaide', 2, 0),
(71, 'What is the "snow" in Floor 1 made out of?', 'Parasites', 1, 0),
(72, 'What group of people still believes in using the Song from the Old World?', 'Songseekers', 2, 0),
(73, 'What is one of the two mantras that a Round Spark can be used on?', 'Fire Gun / Ice Eruption', 2, 0),
(74, 'What NPC says: "Do you have the knowledge within you then, my dull friend?"', 'Miserables', 2, 0),
(75, 'What is the only element that will never be an attunement?', 'Water', 2, 0),
(76, 'What wisp grants passive Tempo?', 'Shadow Wisp', 1, 0),
(77, 'Which triumph gives the most echoes at one time?', 'Obtaining a Resonance', 2, 0),
(78, 'The weapon''s unbound talents are in which talent category?', 'Saint of Blades', 3, 0),
(79, 'What structure helps people cross the voidsea within lore?', 'The Interstitial Lighthouse', 2, 0),
(80, 'What is your Depths Trial at Power 1 with Diver origin?', 'Enforcer', 1, 0),
(81, 'Besides Sanity, what stat does Willpower also increase?', 'Tempo', 1, 0),
(82, 'How much Thundercall does Surge Path require?', '40', 1, 0),
(83, 'What talent allows Lord''s Slice to be used?', 'Hidden Tendril', 2, 0),
(84, 'How many Sky Statues exist?', '3', 2, 0),
(85, 'What is the name of the miniboss that drops the Deepspindle?', 'Ministry Cache Agent', 2, 0),
(86, 'What enchant deals AoE damage on all weapon hits?', 'Wild', 1, 0),
(87, 'What talent used to make blood drain faster when hitting downed players?', 'Bloodletter', 2, 0),
(88, 'Which type of mantra is Lightning Cloak?', 'Mobility', 1, 0),
(89, 'What star mantra is Tornado?', '1-Star', 1, 0),
(90, 'In what location is the Skyvalor Lotus located?', 'Crypt of the Unbroken and Starfield grove', 2, 0),
(91, 'Which weapon has a 30 second cooldown on its critical?', 'First Light', 2, 0),
(92, 'Which Deep Shrine can trade one trait for another?', 'Shrine of Mastery', 1, 0),
(93, 'Pleeksty''s Inferno initially required how much Flamecharm?', '90', 2, 0),
(94, 'All Hero Blades require how much Attunement stat?', '100', 1, 0),
(95, 'Which oath saves Pathfinders from the Depths?', 'Blindseer', 1, 0),
(96, 'Name one talent needed to obtain Blindseer.', 'Breathing Exercise / Conquer Your Fears / Disbelief', 1, 0),
(97, 'What are the entities called that spot you and spawn angels on you?', 'Watchers', 1, 0),
(98, 'What equipment piece do you need equipped to obtain Blindseer?', 'A blindfold', 1, 0),
(99, 'What is the second obtainment method for Soulbreaker involving a boss?', 'Using a Sinner''s Ash in Duke''s dungeon', 2, 0),
(100, 'What is the talent reroll shrine called?', 'Shrine of Chance', 1, 0),
(101, 'Which Prophet of the Ministry gave Chaser and his apprentices the power of Bloodrend?', 'The Second Prophet', 1, 0),
(102, 'Finish this sentence: "Vermin! You seek to let Celtor..."', 'Repeat', 1, 0),
(103, 'How many 0-Star mantras does Flamecharm currently have?', '7', 2, 0),
(104, 'Finish this sentence: "This one''s sanity must''ve..."', 'Already crumbled', 1, 0),
(105, 'Name an island containing an NPC selling mantra modifiers?', 'Isle of Vigils / Etris / Miner''s Landing / Meteor Isle', 1, 0),
(106, 'Before the name "Deepwoken," what was the game called?', 'Drowned Gods', 2, 0),
(107, 'Finish this Starswept Valley description: "Glimmers of starlight mingle with the pungent rot that afflicts these..."', 'Lifeless sands', 2, 0),
(108, 'What is the maximum amount of Kyrsan Medallions you can hold outside Layer 2?', '250', 1, 0),
(109, 'Which oath was the first to get reworked: Jetstriker, Silentheart, or Visionshaper?', 'Jetstriker', 1, 0),
(110, 'True or False: Ironsing has no talents with mutual exclusives.', 'False', 1, 0),
(111, 'True or False: A fully charged Veinbreaker instantly guardbreaks most builds.', 'False, It bypasses block instead of dealing extra posture damage', 2, 0),
(112, 'Which monster mantra is in the Support category?', 'Enforcer Pull', 1, 0),
(113, 'True or False: Visionshaper once had a Willpower requirement.', 'True', 1, 0),
(114, 'Which oath has this oathbreak dialogue from Yun''Shul: "Was this not the future we sought? Perhaps not."', 'Bladeharper', 2, 0),
(115, 'What was the name of Deepwoken''s first April Fools event?', 'Mudwoken', 2, 0),
(116, 'What is the name of Aelita''s brother?', 'Tillian', 1, 0),
(117, 'What''s the crafting recipe for candles?', '1 Fiber + 1 Beeswax', 2, 0),
(118, 'What 2 players have the spec "Moon Blades"?', 'Supaa and Valekis', 1, 0),
(119, 'Where is the NPC Marcus found?', 'The Hidden Village', 1, 0),
(120, 'How many notes does one item from the Meat Lord cost?', '2', 2, 0),
(121, 'What stat is unbound at The Birdcage?', 'Intelligence', 1, 0),
(122, 'Which advanced talent is unlocked from obtaining all "Immolator" talents?', 'Phoenix Flames', 1, 0),
(123, 'What color of Capra race gives the talent "Mark of Jurik"?', 'Blue', 2, 0),
(124, 'Trigi is the last name of which race?', 'Vesperian', 1, 0),
(125, '"The 72 Seasons" is a location from what event?', 'The Metallica crossover event', 1, 0),
(126, 'Gold bars can be crafted at a campfire using what item?', 'Gold Rings / Gold', 2, 0),
(127, 'What tool is given to Drakkard''s in the Pathfinder gamemode?', 'Teachings of the Edenkite', 2, 0),
(128, 'The "Aazel''s Horns" head accessory is a reference to what game?', 'Rogue Lineage', 1, 0),
(129, '"Conjure a protective energy that will guide those fallen in battle towards you." This description belongs to what ability?', 'Preservation', 1, 0),
(130, '"The conditions have been fulfilled, they are to leave unscathed." This is said by which voice of the Depths Trials?', 'Voice of Authority', 1, 0),
(131, 'What is the name of the winning weapon from the 2023 Weapon Art Concept competition?', 'Bloodsworn Effigy', 1, 0),
(132, 'The family controlling The Floating Keep goes by what surname?', 'Spellhardt / Spellhardt Family', 1, 0),
(133, 'How many stars is the mantra Scarlet Cyclone?', '2-Stars', 1, 0),
(134, 'Who was the sole chef available during the events of Vow of Iron?', 'Chef Buongustino', 3, 0),
(135, 'What catastrophic event led to the creation of Galebreathe and Shadowcast?', 'The Godstorm', 3, 0),
(136, 'When is Vow of Iron set in lore?', '1233', 2, 0),
(137, 'What aspect is Knell?', 'Anansi', 2, 0),
(138, 'Where does the Royal Etrean Guard think the Adrets came from?', 'The Sea', 2, 0),
(139, 'What rare item do you need in order to get the Cap''n Greene enchant?', 'Exotic Hide', 1, 0),
(140, 'Which weapon is stabbed through a Kyrsan Scroll within the Second Floor of Layer Two?', 'Frostthorn', 3, 0),
(141, 'Name a known krulian.', 'The Ferryman, Gaunt man.', 1, 0),
(142, 'What is the cake variant of the Dormant Splinter weapon called?', 'Fondant Splitter', 1, 0),
(143, 'What talent accompanies the Thrall of Enmity?', 'Lose Your Mind', 1, 0),
(144, 'What percentage does Snake Oil increase your sales by?', '40%', 1, 0),
(145, 'Name one (obtainable) manmade attunement.', 'Ironsing, Bloodrend', 1, 0),
(146, 'How much combined weapon stat do you need to obtain Bladeharper if you don''t have 75 medium?', '90', 2, 0),
(147, 'Which NPC do you unbound charisma with?', 'Karliah', 1, 0),
(148, 'What is the name of Titus''s combat theme?', 'Chainbreaker', 1, 0),
(149, 'Which memento grants the mantra "Hell''s Judgement"?', 'Flame Worshipper', 2, 0),
(150, 'The Strange Merchant memento starts off with what weapon?', 'Vortex Echo', 2, 0),
(151, 'What island do you fight Knell on?', 'Simforea', 1, 0),
(152, 'Which memento gives you infinitely scaling health?', 'Void Glutton', 1, 0),
(153, 'What does the modifier "Dealbreaker" do?', 'Makes you sell things for less / 25% less', 2, 0),
(154, 'What does the ironsing cantrip do?', 'Allow you to harvest ore without the use of a pickaxe', 2, 0),
(155, 'Which Vow of Iron boss is optional and not needed to start fighting Lord Regent?', 'Shogun of the prophet''s guard', 2, 0),
(156, 'Name a mob that only appears when you are past power 5 in a Vow of Iron depths trial.', 'Parliament/Prime Megalodaunt', 2, 0),
(157, 'What is the name of the affliction that blinds you whenever you take damage?', 'Amaurosis', 3, 0),
(158, 'What equipment shares its name with its equipment talent?', 'Star Duster', 3, 0),
(159, 'What is the maximum amount of heal boost you can reach?', '15%, as different sources do not stack', 3, 0),
(160, 'What does the sluggish PvE effect do?', 'Reduce damage dealt, scaling with slow', 2, 0),
(161, 'What are Shadowmeld mobs weak to?', 'Elemental attacks', 2, 0),
(162, 'What is a monster imbued with Frostdraw called?', 'Frostmantle', 2, 0),
(163, 'What are Galeforce mobs weak to?', 'Thundercall', 1, 0),
(164, 'What are Flamewreathed mobs weak to?', 'Galebreathe', 1, 0),
(165, 'What monster can cause you to fall asleep, similarly to paralytic dust?', 'Arkasid', 2, 0),
(166, 'Before being reworked into Lord''s Tithe, what was the talent called?', 'Blood Shadow', 3, 0),
(167, 'Which monster spawns from Parasol''s Blight but is notably missing from Parasol itself?', 'Alpha Megalodaunt/Prime Megalodaunt', 2, 0),
(168, 'What does the "Sapped" effect do?', 'Increase mantra cooldowns', 3, 0),
(169, 'Who unbounds your fortitude?', 'Brutus', 1, 0),
(170, 'Who gives you Blightsurger?', 'Brutus', 1, 0),
(171, 'Who gives you contractor?', 'Lord Regent/ Zi''eer', 1, 0),
(172, 'What is the goal of the Circle of honor?', 'To defeat the lord regent', 3, 0),
(173, 'What is Ethiron''s title?', 'The maelstrom''s eye', 3, 0),
(174, 'True or False: You can use the Summer Isle hieroglyphs to obtain Blindseer.', 'False', 2, 0),
(175, 'How much knowledge does it cost to use the Sacrificial Boon Talent?', '5 Knowledge', 2, 0),
(176, 'What is The Lord Regent''s true name?', 'Zi''eer', 1, 0),
(177, 'What band did Deepwoken collaborate with, where the Headbang emote was given?', 'Metallica', 2, 0),
(178, 'How many variants of the Stone Knight are there?', '5', 2, 0),
(179, 'What resonance does Titus wield?', 'Chorus Divide', 1, 0),
(180, '"The sea of the heavens" is a nickname given to what location in lore?', 'The Nightsea', 3, 0),
(181, 'What armor enchant was removed within a week of the game''s public release?', 'Auto repair', 3, 0),
(182, 'What is the name of the thundercall trainer?', 'Funke', 2, 0),
(183, 'Which enchant has received the most balancing changes?', 'Curse of the no life king', 1, 0),
(184, 'How do you avoid an attack with a white indicator?', 'Crouch', 1, 0),
(185, 'Where do you fight the Shogun Captain in Vow of Iron?', 'Temple of Mur', 2, 0),
(186, 'How many times must you successfully fish to get the talent "Hook, Like, and Sinker"?', '30 times', 2, 0),
(187, 'The makers of the Serpent''s Edge are of what aspect?', 'Capras', 3, 0),
(188, 'During a specific event, what instrument skin could the ferryman give you?', 'Gilded Set', 2, 0),
(189, 'What weapon has the ability to speak outloud?', 'Gran Sudaruska', 1, 0),
(190, 'What equipment allows you to talk with the watchers?', 'Angel masks', 2, 0),
(191, 'What is the lore-wise purpose of watching Worms in the depths?', 'To be able to tell the time.', 3, 0),
(192, 'What is the Duke Of Erisia''s title?', 'The stonelife lord.', 2, 0),
(193, 'The Shattered Katana''s description state the weapon was modeled after what?', 'The Splinterblade', 3, 0),
(194, 'What is the name of the Maestro in Iron Vow?', 'Maestro Alkhurst Legato', 3, 0),
(195, 'Felinors passive talent grants a buff when interacting with what surface material?', 'Wood', 2, 0),
(196, 'What is the rarest item you can obtain from Elder Primadon?', 'Bloodbane', 2, 0),
(197, 'Name one monster that cannot spawn corrupted during hell mode.', 'King Thresher / Broodlord', 2, 0),
(198, 'What item is obtained from The Guy''s quest?', 'The Guy''s Glasses', 2, 0),
(199, 'What Enchant applies the "Confusion" status effect in PvE.', 'Harrowing', 2, 0),
(200, 'What was the first completely new mantra to be added in an update?', 'Lightning Cloak', 3, 0),
(201, 'What talent increases the level of your elemental mantras?', 'Ether Proselyte', 3, 0),
(202, 'Which oath''s name is not made of compound words? (e.x Silent/heart)', 'Contractor', 3, 0),
(203, 'What is the name of the regalia which grants an extra resonance card on rerolling?', 'Oscillator', 3, 0);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `qa_pairs`
--
ALTER TABLE `qa_pairs`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
