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
  `used` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `qa_pairs`
--

INSERT INTO `qa_pairs` (`id`, `question`, `answer`, `used`) VALUES
(1, 'What is the name of the Bat race in Deepwoken?', 'Kiron', 1),
(2, 'What\'s dawnwalkers\' talent which empowers your strikes with pure light?', 'luminous flash', 0),
(3, 'What level do you stop escaping the depths for free?', 'Power 3', 0),
(4, 'Which legendary weapon does NPC \"Volu\" unlock, by giving him three tomes?', 'Bloodfouler', 0),
(5, 'What was the name of the secret cave near summer isle, which now is gone?', 'The hidden grove', 0),
(6, 'What was the player for the original astral obtainment called?', 'The Wishmaker or Iltria', 0),
(7, 'What fighting style is supported by the \"Navaen War Chief\" schematic?', 'Way of Navae', 0),
(8, 'Which shrine let\'s you advance 3 powers?', 'Shrine of Blasphemy', 0),
(9, 'Which oath is obtained directly from Yun’Shul?', 'Soulbreaker', 0),
(10, 'Name a weapon which requires a dormant splinter, but not a razor cutlass.', 'Fondant Splitter or Sanguine Transfuser', 0),
(11, 'Frosviernr Joraelnaero gives you which weapon?', 'Kyrswynter', 0),
(12, 'Name a location in the etrean luminant \"The Den Master\" is located.', 'Etris, Isle of Vigils', 0),
(13, 'What is the exact location of the shadowcast trainer in the overworld called?', 'Derelict Highchurch', 0),
(14, 'What star mantra is metal fakeout?', '2', 0),
(15, 'Which race is based on a moth?', 'Chrysid', 1),
(16, 'What is the exact name for the area where you unlock union hook?', 'The Frontier Furnace', 0),
(17, 'Which stone knight variant has an extremely low chance to drop astral?', 'Moon Knight', 0),
(18, 'Which race is commonly depicted with Halos?', 'Lightborn', 0),
(19, 'What was the original obtainment method for Rhythm?', 'Ferryman', 0),
(20, 'Which (Spec) Enchant has the ability to proc every enchant on-hit?', 'Unstable', 0),
(21, 'Which obtainable legendary weapon was community made?', 'Light’s Final Toll', 0),
(22, 'Which NPC untarnishes your bell for 1 knowledge?', 'Dr. Carrion', 0),
(23, 'Which ministry prophet granted Chaser his blood powers?', 'The Second Prophet', 0),
(24, 'What is the Hivelord’s Hubris strength stat requirement?', '60', 0),
(25, 'Which weapon has a baseball swing looking critical?', 'Kanabo', 0),
(26, 'What attunement is layer three based on?', 'Flamecharm', 0),
(27, 'Who does Lord Regent wind up crucifying in the Duke quest?', 'Kennith', 0),
(29, 'Where else do the layer 2 winds appear in the game, outside of a dungeon?', 'Moon’s Eyrie', 0),
(30, 'What is the exact name for the place the dreadstar is located at?', 'Beloved Zofia', 1),
(31, 'What is the name of the starter dagger?', 'Stiletto', 0),
(33, 'Where can you find the NPC \"Rook Rethige\"?', 'Voidheart', 0),
(34, 'What do you give to arch_mage in trade for a level 6 mantra?', 'Your soul', 1),
(35, 'Name one thing the \'vacant\' flaw does.', 'You cannot enter Castle Light nor can you partake in a Vow of Mastery.', 0),
(36, 'What flaw do you get when you reroll your Resonance?', 'Tarnished', 0),
(37, 'How many disciples do you need to talk to in order to get oathless?', '3', 0),
(38, 'Which emote emits a red and black stream from your eye?', 'Hoss', 1),
(39, 'Which area’s description is “A place remembered only by the waves.”?', 'Boatman’s Watch', 0),
(41, 'What is the only echo modifier that gives 0.5x echoes?', 'Fragile Heart', 0),
(42, 'What oath gives the talent “Protagonist Syndrome”?', 'Dawnwalker', 0),
(43, 'What is considered the source of power for the Stormseye?', 'Kyrsan Medallions', 0),
(44, 'How much knowledge does Beiruul’s quest give?', '2', 0),
(45, 'What level is required to equip the Bloodforged Crown?', '15', 0),
(46, 'What area’s description is “What was stolen from below lies within.”?', 'Duke Erisia’s Manor', 0),
(47, 'What color is the Manor Key when not glowing?', 'Gray', 0),
(48, 'How many dying embers are required to gain the talent “Pleeksty’s Will”?', '3', 0),
(49, 'In what area is the NPC that removes your negative Hive reputation?', 'The Lordsgrove', 0),
(50, 'The Meteor Isle is territory of what faction?', 'Children of Navae', 0),
(51, 'What item is needed to light the flame pedestals in the Birdcage?', 'Soul Hearthgem', 0),
(52, 'What is the name of the Coral Fever assistant?', 'Destroyman III', 0),
(53, 'What building is the Flamecharm trainer located?', 'Songseeker Temple', 0),
(54, 'Is the \"Worshipper Longshield\" a real item?', 'No it\'s not', 0),
(55, 'What is the colour of The Ferryman\'s Lightning?', 'Purple', 0),
(56, 'What color of flame is seen in game but not as a part of (obtainable) weapons or mantras?', 'Purple', 0),
(57, 'Where is Korilfiend found? [lore]', 'The Vents / Layer Three', 0),
(58, 'What talent has the highest stat requirement?', 'Chorus of souls (210)', 0),
(59, 'Name the guild base room that has an Artisan in it.', 'Trophy Room', 0),
(60, 'What origin used to be a flaw?', 'Deepbound (Before 8/22/2022)', 0),
(61, 'What character says the line: “A rose, a cornflower, and perhaps a hyacinth appear to me in a dream.”?', 'Miserables', 1),
(62, 'Which mantra is unlocked from beating Duke Erisia?', 'Pillars of Erisia', 0),
(63, 'What is the name of the person who unbounds your fortitude?', 'Brutus', 0),
(64, 'Which stat is trained by getting \"spam grip cancelled\"?', 'Fortitude', 0),
(65, 'What is the weapon skin won by winning an artist competition?', 'The Paintbrush', 0),
(66, 'Who are the Hundred Legions investigating in the Etrean Luminant?', 'The Central Authority', 0),
(67, 'What is the name of the main island in the Central Luminant?', 'Markor', 0),
(68, 'What is the \"hero blade oath\" called?', 'Saintsworn', 0),
(69, 'What weapon does the ironsing trainer use against Silenthearts?', 'Darksteel Greatsword', 1),
(70, 'Obtaining an oath disables which shrine?', 'Shrine of Order', 0),
(71, 'What color do your eyes turn when you get Linkstrider?', 'Light blue (Blue is okay too)', 1),
(72, 'What is the name of the NPC that gives you the Windwaker talent?', 'Stratos', 0),
(73, 'What is the exact name of the potion which unlocks shadowcast?', 'Nightblood', 0),
(74, 'What enemy is the only enemy that can attack you with a pickaxe?', '\"Mudskipper\" or \"Mineskipper\"', 0),
(75, 'How much knowledge does the Harrowing Enchant Stone cost?', '10 knowledge', 0),
(76, 'How much joy did the Halloween ‘22 Medal cost?', '200', 0),
(77, 'What enemy is the only enemy that can drop the Markor’s Inheritor directly?', 'Lost Divers (New kyrsa)', 0),
(78, 'What NPC says “If you value your life, you will run”?', 'Windrunner (Top of Etris wilds)', 1),
(80, 'Who corrupts the Kyrsgarde\'s minds in New Kyrsa?', 'Ethiron', 0),
(81, 'Who is a lightborn trapped in the outskirts of New Kyrsa?', 'Kaide', 0),
(82, 'What is the “snow” in Floor 1 made out of?', 'Parasites', 0),
(83, 'What group of people still believes in using the Song from the Old World?', 'Songseekers', 1),
(84, 'Name a frostdraw mantra that a round spark be used on.', 'Ice Eruption or Ice Carve', 0),
(85, 'What NPC says “Do you have the knowledge within you then, my dull friend?”?', 'Miserables', 0),
(86, 'What is the last echo talent to be unlocked?', 'Thresher Scales', 0),
(87, 'Name the element that will never be a Deepwoken Attunement.', 'Water', 1),
(88, 'What wisp grants passive tempo?', 'Shadow/Shade wisp', 0),
(90, 'Which triumph (accomplishment) gives the most echoes?', 'Obtaining a Resonance', 0),
(92, 'Aside from Akira & Ferryman, who is a seen character with a ring named after them?', 'Maestro Evengarde Rest', 0),
(93, 'The weapons unbound talents are in which talent category?', 'Saint of Blades', 1),
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
(106, 'What star mantra is Tornado?', '1 Star', 0),
(108, 'Name a weapon which has a 30 second cooldown on its critical.', 'First Light or Vortex Echo', 0),
(109, 'Which deep shrine has the ability to trade out one trait for another?', 'Shrine of Mastery', 0),
(110, 'The Pleeksty’s Inferno initially required how much Flamecharm?', '90', 0),
(111, 'All hero blades require how much attunement stat?', '75', 0),
(112, 'Which oath saves pathfinders from the depths?', 'Blindseer', 0),
(113, 'Name one talent needed to get Blindseer.', 'Breathing Exercise, Conquer your Fears and Disbelief', 0),
(114, 'What are the entities called that spot you and spawn angels on you?', 'Watchers', 0),
(115, 'What is the name of the event that lead to the start of Deepwoken? [lore]', 'The Tides', 1),
(116, 'What equipment piece do you need to have equipped to obtain blindseer?', 'A blindfold', 0),
(117, 'What is the second obtainment method for soulbreaker, involving a boss?', 'Using a sinner\'s ash in Duke\'s dungeon', 0),
(118, 'What is the talent reroll shrine called?', 'Shrine of Chance', 0),
(120, 'Which Prophet of the Ministry gave Chaser and his apprentices the power of Bloodrend?', 'The Second Prophet', 0),
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
(137, 'What was the name of Deepwokens first April Fools Event?', 'Mudwoken', 1),
(138, 'What is the name of Aelita\'s brother?', 'Tillian', 0),
(139, 'What\'s the crafting recipe for candles?', '1 Fiber, 1 Beeswax', 0),
(140, 'What 2 players have the spec \"Moon Blades\"?', 'Supaa and Valekis', 1),
(141, 'Where is the NPC Marcus found?', 'The Hidden Village', 0),
(142, 'How many notes does one item from the Meat Lord cost?', '2', 0),
(143, 'What stat is unbound at The Birdcage?', 'Intelligence', 0),
(144, 'Which advanced talent is unlocked from having all of the \"Immolator\" talents?', 'Phoenix Flames', 0),
(145, 'What color of Capra race gives the talent \"Mark of Jurik\"?', 'Blue', 0),
(146, 'Trigi is a last name of which race?', 'Vesperian', 0),
(147, '\"The 72 Seasons\" is a location from what event?', 'The Metallica crossover event', 0),
(148, 'Gold bars can be crafted at a campfire utilizing what item?', 'Gold Rings', 0),
(149, 'Drakkards can passively train their stats through the use of what talent?', 'Teachings of the Edenkite', 1),
(150, 'The \"Aazel\'s Horns\" head accessory are a reference to what game?', 'Rogue Lineage', 0),
(151, 'The Teleportation Resonance was once often referred to by what community-given name?', 'Flying Raijin / Gate / Fast Travel', 0),
(152, '\"Conjure a protective energy that will guide those fallen in battle towards you.\" is a description belonging to what ability?', 'Preservation', 0),
(153, '\"The conditions have been fulfilled, they are to leave unscathed.\" is said by which voice of the Depths Trials?', 'Voice of Authority', 0),
(154, 'What is the name of the winning weapon from the 2023 Weapon Art Concept competition, still yet to be added?', 'Bloodsworn Effigy', 0),
(155, 'The family controlling The Floating Keep go by what name?', 'Spellhardt / Spellhardt Family', 0);

-- Additional inserted Q&A (appended)
INSERT INTO `qa_pairs` (`id`, `question`, `answer`, `used`) VALUES
(156, 'What is the name of the now-reverted update that reworked movement?', 'Rock The Boat', 0),
(157, 'What is the most amount of crowns you can possibly have at once?', '999', 0),
(158, 'True or False: King Gigameds have a chance to spawn wearing a Strapped Hat', 'False, they wear a Ten-Gallon Hat', 0),
(159, 'Which NPC must be talked to to put you on the Summer Company Business List', 'The Guy', 0),
(160, 'True or False: The Phoenix Duster has a rare chance to drop from The Voidsea and Starswept Valley', 'False, it is not an obtainable item.', 0),
(161, 'What items are required to craft a Champions Alloy?', 'Enmity Armor Piece, Doom of Caeranthil Scale and a Titus Armor Piece', 0),
(162, 'An Etrean Guardsman can use what Galebreathe mantra?', 'Gale Lunge', 0),
(163, 'What face are you occasionally jumpscared by inside the Firfire Caverns?', 'A Bounder face', 0),
(164, 'What overworld monster is able to be talked with, excluding owls.', 'Watchers', 0),
(165, 'What is the name of Linkstriders talent that lets you teleport between meteorites', 'Entropy Link', 0),
(166, 'The Vow required to bank items with knowledge is called what?', 'Vow of Safekeeping', 0),
(167, 'What Official Roblox award has Deepwoken won?', 'Best New Experience', 0),
(168, 'The badge given to you for obtaining your first Oath is called what?', 'Oathsworn', 0),
(169, 'What song played on the menu screen during the 2023 April Fools event?', 'To Sleep, Layer 2 Bell', 0),
(170, 'Name at least one ironsing mantra that was shown in the sneak peaks given leading up to the attunements release', 'Metal Rain / Needle Barrage / Metal Ball', 0),
(171, 'Who is the NPC in Celtor City that can be given Deep Gems in exchange for random items?', 'Jeremiah', 0),
(172, 'What is one base vow of mastery command besides Sleep, Leech and Run?', 'Say / Use / Locate / Drop / Eat', 0),
(173, 'What Vow of Mastery command has the highest charisma requirement?', 'Summon', 0),
(174, 'Name at least one monster the now-removed talent "Mirage from the Deep" could spawn', 'Sharko / Deep Owl / Squibbo', 0),
(175, 'What symbol is depicted on the Bishop chess piece in voidheart?', 'The Suncross', 0),
(176, 'What is Eylis\'s name title?', 'The Punished Dreamer', 0),
(177, '"Dark Receiver" is a talent requiring which attunement?', 'Thundercall AND Shadowcast', 0),
(178, 'What is the name of the Hero of Frost?', 'Faust', 0),
(179, 'Which NPC will uppercut you high in the sky if you fail to fulfil the quest they give you', 'The Weird Trader', 0),
(180, 'What does the "Winded" status effect do?', 'Reduce your swing speed', 0),
(181, 'What is the name of the 1 star flame mantra that summons a single explosion directly beneath your cursor?', 'Searing Snare', 0),
(182, 'The mantra \'Ice Blade\' can perform a unique slide-jump attack using what talent?', 'Glacial Mobility', 0),
(183, 'Lightning Impact can be modified by what mantra spark?', 'Reversal Spark', 0),
(184, 'What lore book was originally thought to be related to Contractors obtainment back when the oath was released?', 'Operation \'Puppet Master\'', 0),
(185, 'How many Gold Plates must you give to the Golden Bouncer to recieve a chest?', '5', 0),
(186, 'How many notes do the "Ancient Dagger Remains" sell for?', '5', 0);

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
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=187;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
