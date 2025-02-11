/*
 Navicat Premium Data Transfer

 Source Server         : localhost_5432
 Source Server Type    : PostgreSQL
 Source Server Version : 170002 (170002)
 Source Host           : localhost:5432
 Source Catalog        : postgres
 Source Schema         : public

 Target Server Type    : PostgreSQL
 Target Server Version : 170002 (170002)
 File Encoding         : 65001

 Date: 11/02/2025 16:46:57
*/


-- ----------------------------
-- Sequence structure for reviews_logs_reviewLogID_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."reviews_logs_reviewLogID_seq";
CREATE SEQUENCE "public"."reviews_logs_reviewLogID_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for reviews_reviewID_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."reviews_reviewID_seq";
CREATE SEQUENCE "public"."reviews_reviewID_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for users_logs_logID_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."users_logs_logID_seq";
CREATE SEQUENCE "public"."users_logs_logID_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for users_userID_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."users_userID_seq";
CREATE SEQUENCE "public"."users_userID_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Table structure for reviews
-- ----------------------------
DROP TABLE IF EXISTS "public"."reviews";
CREATE TABLE "public"."reviews" (
  "reviewID" int4 NOT NULL GENERATED ALWAYS AS IDENTITY (
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1
),
  "userID" int4 NOT NULL,
  "reviewTitle" text COLLATE "pg_catalog"."default" NOT NULL,
  "title" text COLLATE "pg_catalog"."default" NOT NULL,
  "description" text COLLATE "pg_catalog"."default" NOT NULL,
  "stars" int2 NOT NULL DEFAULT 0,
  "image" text COLLATE "pg_catalog"."default" NOT NULL
)
;

-- ----------------------------
-- Records of reviews
-- ----------------------------
INSERT INTO "public"."reviews" OVERRIDING SYSTEM VALUE VALUES (88, 7, 'Great! Love it!', 'Game of Thrones', 'Try it, you won''t regret it!', 8, 'review_67ab62d0e99d65.51606040.jpg');
INSERT INTO "public"."reviews" OVERRIDING SYSTEM VALUE VALUES (89, 7, 'It''s real!', 'Half Life 3', 'Very fun, very enjoyable!', 8, 'review_67ab6a4b586131.34118193.jpg');
INSERT INTO "public"."reviews" OVERRIDING SYSTEM VALUE VALUES (90, 7, 'Great storytelling', 'Cyberpunk 2077', 'Wish I could explore the Night City for the first time...', 10, 'review_67ab6a80083837.64515276.jpg');
INSERT INTO "public"."reviews" OVERRIDING SYSTEM VALUE VALUES (91, 7, '3 witcher 3 best', 'The Witcher 3: Wild Hunt', '', 10, 'review_67ab6aad180d84.09219831.jpg');
INSERT INTO "public"."reviews" OVERRIDING SYSTEM VALUE VALUES (92, 7, 'Highly recommended!', 'Dreadloop', '', 9, 'review_67ab6adb6c5b77.27998696.png');
INSERT INTO "public"."reviews" OVERRIDING SYSTEM VALUE VALUES (93, 16, 'Fun Adventure!', 'The Witcher 3: Wild Hunt', 'A must-play!', 10, 'review_67ab6d07668270.11135525.jpg');
INSERT INTO "public"."reviews" OVERRIDING SYSTEM VALUE VALUES (80, 15, 'My favorite movie ever!', 'Lord of the Rings: The Fellowship of the Ring', 'This is totally objective review of the first Lord of the Rings movie. Totally. Not based. Only honest thoughts. Seriously.', 10, 'review_67aabea8651215.50086784.jpg');
INSERT INTO "public"."reviews" OVERRIDING SYSTEM VALUE VALUES (83, 13, 'Knights & Blood and Treason', 'Game of Thrones', 'Just like in the real world, love it!', 8, 'review_67aac3f596de41.64350943.jpg');
INSERT INTO "public"."reviews" OVERRIDING SYSTEM VALUE VALUES (87, 9, 'Great!', 'Lord of the Rings: The Two Towers', 'Whatever else became of Peter Jackson after this, the man who made Fellowship of the Ring is a great filmmaker, an artist known for his clever post-Raimi horror who emerged suddenly and boldly to leapfrog Spielberg as the director who came closest to truly to succeeding David Lean. A century''s worth of camera tricks are used here: forced perspective, miniatures, camera angles and more. A film supplemented, not defined, by computer animation.

Consider the first half hour of the film. After a brief prologue that runs down the core mythos of the MacGuffin, Jackson manages to 1) establish The Shire as the most idyllic place to ever exist in fiction (the production design on the hill homes and Bilbo''s house interior are so sublime), 2) complicate that bliss with the inherent conservatism of hobbits, 3) sets up Bilbo well enough to convey all of his weariness with this forced placidity, 4) introduces and gives clear personalities to all of the main hobbits and 5) even turns into brief gothic horror in the way Bilbo''s internal struggle to leave the Ring behind brings out spikes of rage that Jackson films with quick cuts and angular close-ups that say everything about the splintering mind beneath his sweet exterior. None of this is rushed, yet the narrative, character, thematic and stylistic ground that the film covers could fill entire franchises.

There is so much soul to this. Consider the space that the film makes to linger on Aragorn''s various doubts, both of his lineage and his devotion to a woman who would have to sacrifice her strength to be with him. (The Hobbit would awkwardly insert a Strong Female Heroine into Tolkien to mitigate the author''s notorious chauvinism and dated gender roles, but the subtext that is subtly emphasized here, of a man knowing that his love would lose what makes her special to be with him, wrings something pointed and modern from Tolkien''s retrograde mythmaking.) When Frodo stands up amid all the bickering in Rivendell and says he will take the Ring, the way his voice is drowned out as the camera looks down on his tiny form ignored by all the rest is so heartbreaking, all the more so when Gandalf hears and we get a close-up of him closing his eyes sadly, knowing even as he hates to hear it that this is the only way. Every single character here is so fully rendered, you feel all the pleasure of them growing closer and the absolute tragedy of that fellowship breaking. Even Boromir isn''t shortchanged, and if anything he feels more human, and therefore more tragic, than he did on the page.

This is a love letter to Tolkien''s text, which Jackson, Fran Walsh and Philippa Boyens adapt with a judicious eye that manages to prune so many of the novel''s diversions while only strengthening its core and devoting as much time as possible not to action but to the longueurs that give the material its poignancy. The script leaves in all the quiet moments of reflection and ruefulness that undercut the magnitude and pomp of the journey almost before it starts.

And the production design shows such care in making that tragedy all the more explicit, from the way that the Shire seems wistful and destined to be forgotten almost as soon as you''ve gotten used to its beauty to the horror of Moria, a colossal grave centered by that haunting shot of moonlight piercing its subterranean catacomb to illuminate the one tomb of its leader.

When the Fellowship meets Galadriel, she utters a line that is condensed from the novel: "For the world has grown full of peril, and in all lands, love is now mingled with grief." This omits the original tag of that line "it grows perhaps the greater," removing hope for the feeling of resigned sadness. We spend 15-20 minutes in Lothlorien, yet I cannot recall anything in another blockbuster coming close to the wave of melancholia that erupts when the Fellowship leaves it. Tolkien, of course, wrote LOTR at least partially as a means of processing his trauma over WWI, and Jackson homes in on the singular way in which the text is an introduction that is also a farewell, how every location that looks so gorgeous is viewed with an immediate pang of loss in the knowledge that it will likely never be seen again.', 9, 'review_67ab6082e5f6a2.63454298.jpg');

-- ----------------------------
-- Table structure for reviews_logs
-- ----------------------------
DROP TABLE IF EXISTS "public"."reviews_logs";
CREATE TABLE "public"."reviews_logs" (
  "reviewLogID" int4 NOT NULL GENERATED ALWAYS AS IDENTITY (
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1
),
  "reviewID" int4 NOT NULL,
  "userID" int4 NOT NULL,
  "operationName" text COLLATE "pg_catalog"."default",
  "operationDate" timestamptz(6)
)
;

-- ----------------------------
-- Records of reviews_logs
-- ----------------------------
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (3, 64, 9, 'delete', '2025-02-10 17:50:53.627595+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (4, 63, 9, 'delete', '2025-02-10 17:51:01.950678+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (5, 62, 9, 'edit', '2025-02-10 17:53:38.267726+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (6, 62, 9, 'delete', '2025-02-10 17:53:50.521749+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (7, 65, 9, 'delete', '2025-02-10 17:54:39.690519+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (8, 67, 9, 'insert', '2025-02-10 18:00:50.64259+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (9, 68, 9, 'insert', '2025-02-10 20:30:30.961989+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (10, 68, 9, 'delete', '2025-02-10 21:30:55.22735+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (11, 69, 9, 'insert', '2025-02-10 21:31:06.054281+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (12, 70, 9, 'insert', '2025-02-10 22:17:53.181455+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (13, 69, 9, 'edit', '2025-02-10 22:18:00.759585+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (14, 70, 9, 'edit', '2025-02-10 22:18:07.708781+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (15, 70, 9, 'edit', '2025-02-10 22:18:15.508269+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (16, 70, 9, 'edit', '2025-02-10 22:18:23.161931+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (17, 70, 9, 'edit', '2025-02-10 22:18:27.641602+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (18, 71, 9, 'insert', '2025-02-10 22:18:51.842417+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (19, 69, 9, 'delete', '2025-02-10 23:19:36.334667+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (20, 71, 9, 'delete', '2025-02-10 23:46:04.661403+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (21, 66, 9, 'edit', '2025-02-11 00:07:22.093087+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (22, 66, 9, 'edit', '2025-02-11 00:07:26.783497+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (23, 66, 9, 'edit', '2025-02-11 00:52:30.69926+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (24, 72, 9, 'insert', '2025-02-11 00:53:01.900831+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (25, 70, 9, 'edit', '2025-02-11 01:08:12.56959+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (26, 70, 9, 'edit', '2025-02-11 01:08:18.793072+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (27, 66, 9, 'edit', '2025-02-11 01:18:19.282005+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (28, 66, 9, 'edit', '2025-02-11 01:24:00.920758+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (29, 66, 9, 'edit', '2025-02-11 01:28:40.440699+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (30, 66, 9, 'edit', '2025-02-11 01:28:44.185766+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (31, 66, 9, 'edit', '2025-02-11 01:28:47.571676+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (32, 66, 9, 'edit', '2025-02-11 01:29:08.206012+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (33, 66, 9, 'edit', '2025-02-11 01:29:19.536106+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (34, 70, 9, 'edit', '2025-02-11 01:31:43.030111+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (35, 70, 9, 'edit', '2025-02-11 01:32:05.632303+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (36, 70, 9, 'edit', '2025-02-11 01:32:44.752449+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (37, 70, 9, 'edit', '2025-02-11 01:32:51.69772+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (38, 70, 9, 'edit', '2025-02-11 01:32:57.82111+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (39, 70, 9, 'edit', '2025-02-11 01:33:15.901937+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (40, 70, 9, 'edit', '2025-02-11 01:35:02.912001+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (41, 70, 9, 'edit', '2025-02-11 01:35:12.874495+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (42, 70, 9, 'edit', '2025-02-11 01:35:18.420159+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (43, 70, 9, 'edit', '2025-02-11 01:35:23.965733+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (44, 70, 9, 'edit', '2025-02-11 01:35:40.559587+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (45, 66, 9, 'edit', '2025-02-11 01:38:14.486356+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (46, 66, 9, 'edit', '2025-02-11 01:38:25.881526+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (47, 66, 9, 'edit', '2025-02-11 01:39:23.286672+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (48, 66, 9, 'edit', '2025-02-11 01:39:28.593923+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (49, 66, 9, 'edit', '2025-02-11 01:40:07.695076+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (50, 70, 9, 'edit', '2025-02-11 01:53:19.181749+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (51, 70, 9, 'edit', '2025-02-11 01:53:26.794278+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (52, 70, 9, 'edit', '2025-02-11 01:55:57.921225+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (53, 70, 9, 'edit', '2025-02-11 01:56:01.33221+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (54, 70, 9, 'edit', '2025-02-11 01:57:22.738325+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (55, 70, 9, 'edit', '2025-02-11 01:57:47.372088+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (56, 70, 9, 'delete', '2025-02-11 01:58:19.644598+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (57, 66, 9, 'delete', '2025-02-11 01:58:22.75344+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (58, 67, 9, 'edit', '2025-02-11 01:58:29.350511+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (59, 67, 9, 'edit', '2025-02-11 01:58:36.946414+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (60, 67, 9, 'edit', '2025-02-11 01:59:24.687114+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (61, 67, 9, 'edit', '2025-02-11 02:01:30.174732+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (62, 67, 9, 'edit', '2025-02-11 02:01:53.375843+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (63, 67, 9, 'edit', '2025-02-11 02:02:25.023477+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (64, 67, 9, 'edit', '2025-02-11 02:02:48.27385+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (65, 67, 9, 'edit', '2025-02-11 02:02:51.442693+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (66, 67, 9, 'edit', '2025-02-11 02:03:21.53859+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (67, 67, 9, 'edit', '2025-02-11 02:03:31.499499+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (68, 67, 9, 'edit', '2025-02-11 02:04:17.231713+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (69, 67, 9, 'edit', '2025-02-11 02:06:02.889809+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (70, 67, 9, 'edit', '2025-02-11 02:06:22.53536+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (71, 67, 9, 'edit', '2025-02-11 02:08:37.701916+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (72, 67, 9, 'edit', '2025-02-11 02:09:50.841901+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (73, 67, 9, 'edit', '2025-02-11 02:10:29.344904+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (74, 67, 9, 'edit', '2025-02-11 02:10:32.527888+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (75, 67, 9, 'edit', '2025-02-11 02:10:37.264174+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (76, 67, 9, 'edit', '2025-02-11 02:12:23.536176+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (77, 67, 9, 'edit', '2025-02-11 02:12:38.822192+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (78, 67, 9, 'edit', '2025-02-11 02:13:14.043924+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (79, 67, 9, 'edit', '2025-02-11 02:14:05.693765+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (80, 67, 9, 'edit', '2025-02-11 02:14:20.413725+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (81, 67, 9, 'edit', '2025-02-11 02:14:32.490036+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (82, 67, 9, 'edit', '2025-02-11 02:14:40.969609+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (83, 67, 9, 'edit', '2025-02-11 02:17:25.012141+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (84, 67, 9, 'edit', '2025-02-11 02:17:27.936671+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (85, 67, 9, 'edit', '2025-02-11 02:18:10.797121+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (86, 67, 9, 'edit', '2025-02-11 02:18:13.372749+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (87, 67, 9, 'edit', '2025-02-11 02:18:22.7664+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (88, 72, 9, 'edit', '2025-02-11 02:18:39.660522+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (89, 72, 9, 'edit', '2025-02-11 02:19:52.543638+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (90, 72, 9, 'edit', '2025-02-11 02:20:43.788057+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (91, 72, 9, 'edit', '2025-02-11 02:22:11.378772+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (92, 72, 9, 'edit', '2025-02-11 02:22:16.653375+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (93, 72, 9, 'edit', '2025-02-11 02:24:12.059401+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (94, 72, 9, 'edit', '2025-02-11 02:24:22.841986+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (95, 72, 9, 'edit', '2025-02-11 02:24:26.260261+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (96, 72, 9, 'edit', '2025-02-11 02:24:29.083851+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (97, 72, 9, 'edit', '2025-02-11 02:24:32.869678+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (98, 72, 9, 'edit', '2025-02-11 02:25:15.796821+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (99, 72, 9, 'edit', '2025-02-11 02:25:20.183074+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (100, 72, 9, 'edit', '2025-02-11 02:25:40.63395+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (101, 72, 9, 'edit', '2025-02-11 02:26:19.124672+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (102, 72, 9, 'edit', '2025-02-11 02:27:09.937614+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (103, 72, 9, 'edit', '2025-02-11 02:27:12.843654+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (104, 72, 9, 'edit', '2025-02-11 02:42:34.178794+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (105, 72, 9, 'edit', '2025-02-11 02:43:03.325859+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (106, 72, 9, 'edit', '2025-02-11 02:43:19.19915+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (107, 72, 9, 'edit', '2025-02-11 02:43:43.821412+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (108, 72, 9, 'edit', '2025-02-11 02:49:46.703071+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (109, 72, 9, 'edit', '2025-02-11 02:50:21.714944+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (110, 72, 9, 'edit', '2025-02-11 02:50:53.896529+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (111, 72, 9, 'edit', '2025-02-11 02:51:01.530346+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (112, 72, 9, 'edit', '2025-02-11 02:52:24.163724+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (113, 72, 9, 'edit', '2025-02-11 02:52:34.291467+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (114, 72, 9, 'delete', '2025-02-11 02:54:56.369687+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (115, 73, 9, 'insert', '2025-02-11 02:54:56.375121+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (116, 73, 9, 'edit', '2025-02-11 02:56:02.222729+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (117, 73, 9, 'edit', '2025-02-11 02:56:08.143527+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (118, 73, 9, 'edit', '2025-02-11 02:56:13.35876+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (119, 73, 9, 'edit', '2025-02-11 02:56:23.218801+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (120, 73, 9, 'edit', '2025-02-11 02:56:30.080692+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (121, 73, 9, 'edit', '2025-02-11 02:56:37.918563+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (122, 73, 9, 'delete', '2025-02-11 02:56:44.418278+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (123, 67, 9, 'delete', '2025-02-11 02:56:48.096116+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (124, 74, 9, 'insert', '2025-02-11 02:56:48.105132+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (125, 74, 9, 'delete', '2025-02-11 02:57:34.215183+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (126, 75, 9, 'insert', '2025-02-11 02:57:51.526248+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (127, 75, 9, 'delete', '2025-02-11 02:58:04.702571+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (128, 76, 9, 'insert', '2025-02-11 02:58:33.386746+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (129, 76, 9, 'delete', '2025-02-11 02:58:42.341018+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (130, 77, 9, 'insert', '2025-02-11 02:59:51.108041+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (131, 77, 9, 'delete', '2025-02-11 03:00:19.733858+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (132, 78, 9, 'insert', '2025-02-11 03:00:19.740115+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (133, 79, 9, 'insert', '2025-02-11 03:02:50.170452+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (134, 80, 15, 'insert', '2025-02-11 03:06:16.435441+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (135, 58, 7, 'delete', '2025-02-11 03:06:59.471853+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (136, 81, 7, 'insert', '2025-02-11 03:06:59.480509+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (137, 57, 7, 'delete', '2025-02-11 03:07:14.892421+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (138, 82, 7, 'insert', '2025-02-11 03:07:14.897711+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (139, 60, 7, 'delete', '2025-02-11 03:07:21.235907+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (140, 83, 13, 'insert', '2025-02-11 03:28:53.63144+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (141, 84, 13, 'insert', '2025-02-11 03:34:05.854789+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (142, 84, 13, 'delete', '2025-02-11 03:34:10.76784+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (143, 85, 13, 'insert', '2025-02-11 03:35:43.189508+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (144, 85, 13, 'delete', '2025-02-11 03:37:03.647592+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (145, 86, 9, 'insert', '2025-02-11 14:36:28.35495+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (146, 87, 9, 'insert', '2025-02-11 14:36:50.953152+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (147, 87, 9, 'delete', '2025-02-11 14:42:03.121256+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (148, 87, 9, 'delete', '2025-02-11 14:44:25.045017+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (149, 86, 9, 'delete', '2025-02-11 14:44:29.66725+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (150, 78, 9, 'delete', '2025-02-11 14:44:43.516899+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (151, 87, 9, 'delete', '2025-02-11 14:45:20.02836+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (152, 87, 9, 'delete', '2025-02-11 14:46:00.005711+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (153, 87, 9, 'delete', '2025-02-11 14:46:22.113312+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (154, 88, 7, 'insert', '2025-02-11 14:46:40.967437+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (155, 88, 7, 'delete', '2025-02-11 14:46:45.18063+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (156, 82, 7, 'delete', '2025-02-11 14:47:36.74556+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (157, 82, 7, 'delete', '2025-02-11 14:50:40.383408+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (158, 82, 7, 'delete', '2025-02-11 14:51:16.381399+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (159, 82, 7, 'delete', '2025-02-11 14:52:58.189884+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (160, 82, 7, 'delete', '2025-02-11 14:53:07.159383+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (161, 82, 7, 'delete', '2025-02-11 14:53:28.109348+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (172, 81, 7, 'edit', '2025-02-11 14:55:51.998074+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (173, 82, 7, 'edit', '2025-02-11 14:55:51.998074+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (174, 82, 7, 'delete', '2025-02-11 14:55:55.447206+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (175, 82, 7, 'delete', '2025-02-11 14:56:03.486247+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (176, 82, 7, 'delete', '2025-02-11 14:56:26.171209+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (177, 82, 7, 'delete', '2025-02-11 14:59:56.090796+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (178, 82, 7, 'delete', '2025-02-11 14:59:58.84759+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (179, 82, 7, 'delete', '2025-02-11 15:01:45.881794+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (180, 82, 7, 'delete', '2025-02-11 15:01:57.541816+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (181, 82, 7, 'delete', '2025-02-11 15:02:03.900762+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (182, 82, 7, 'delete', '2025-02-11 15:04:12.936347+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (183, 82, 7, 'delete', '2025-02-11 15:04:16.462921+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (184, 81, 7, 'delete', '2025-02-11 15:04:18.903169+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (186, 78, 9, 'delete', '2025-02-11 15:12:26.036043+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (188, 88, 7, 'edit', '2025-02-11 15:16:37.05679+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (189, 88, 7, 'edit', '2025-02-11 15:16:40.182912+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (190, 88, 7, 'edit', '2025-02-11 15:16:43.549293+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (191, 88, 7, 'edit', '2025-02-11 15:17:09.901529+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (192, 79, 9, 'delete', '2025-02-11 15:17:28.468917+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (193, 89, 7, 'insert', '2025-02-11 15:18:35.37416+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (194, 90, 7, 'insert', '2025-02-11 15:19:28.042031+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (195, 91, 7, 'insert', '2025-02-11 15:20:13.107551+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (196, 92, 7, 'insert', '2025-02-11 15:20:59.456582+00');
INSERT INTO "public"."reviews_logs" OVERRIDING SYSTEM VALUE VALUES (197, 93, 16, 'insert', '2025-02-11 15:30:15.435806+00');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS "public"."users";
CREATE TABLE "public"."users" (
  "userID" int4 NOT NULL GENERATED ALWAYS AS IDENTITY (
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1
),
  "email" text COLLATE "pg_catalog"."default" NOT NULL,
  "nickname" text COLLATE "pg_catalog"."default" NOT NULL,
  "password" text COLLATE "pg_catalog"."default" NOT NULL,
  "name" text COLLATE "pg_catalog"."default" NOT NULL,
  "surname" text COLLATE "pg_catalog"."default" NOT NULL,
  "isAdmin" bool NOT NULL DEFAULT false
)
;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO "public"."users" OVERRIDING SYSTEM VALUE VALUES (9, 'admin@admin.com', 'PoteznyAdministrator', '$2y$10$Q3owrsWy5AdtVmoJWnc3LOC4IBYdccd0IBxsOKFU0KMBFQuWCC8ie', 'Jan', 'Kowalski', 't');
INSERT INTO "public"."users" OVERRIDING SYSTEM VALUE VALUES (11, '4@gmail.com', 'MonsterWhite', '$2y$10$AMIaFivZgd2BXZRXvble9uix80nwt.R4SE6.HFQbxvSOQYub4MvX.', 'Grzegorz', 'Baton', 'f');
INSERT INTO "public"."users" OVERRIDING SYSTEM VALUE VALUES (13, '8@gmail.com', 'ArthurMorgan', '$2y$10$kMNDYsmcKMIfjA.T5.BpQeilxPqhgV6R0sKbY7pfmldKpq6a/X02u', 'Arthur', 'Morgan', 'f');
INSERT INTO "public"."users" OVERRIDING SYSTEM VALUE VALUES (7, '1@gmail.com', 'NotGordonFreeman', '$2y$10$g3FGI.RiZuzicKr1M.wx6ualUJHas4Z9J3/y4Mrot71gWSBJXQ68O', 'Gordon', 'Freeman', 'f');
INSERT INTO "public"."users" OVERRIDING SYSTEM VALUE VALUES (15, '2@gmail.com', 'FrodoBagginsLover2003', '$2y$10$ELlAFFcbYuogPyy2FQeNNeBQjfc3ClqQN7LW7RBUX4EEyCx.sa1p6', 'Frodo', 'Baggins', 'f');
INSERT INTO "public"."users" OVERRIDING SYSTEM VALUE VALUES (16, '12@gmail.com', 'LeonKennedy2', '$2y$10$esVXnTI3kGs8GmESjlmMiewfHiYVTWfDQB9G7B3lEZ0dgBuCHSlMu', 'Leon', 'Kennedy', 'f');

-- ----------------------------
-- Table structure for users_logs
-- ----------------------------
DROP TABLE IF EXISTS "public"."users_logs";
CREATE TABLE "public"."users_logs" (
  "logID" int4 NOT NULL GENERATED ALWAYS AS IDENTITY (
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1
),
  "userID" int4 NOT NULL,
  "operationName" text COLLATE "pg_catalog"."default" NOT NULL,
  "operationDate" timestamp(6) NOT NULL
)
;

-- ----------------------------
-- Records of users_logs
-- ----------------------------
INSERT INTO "public"."users_logs" OVERRIDING SYSTEM VALUE VALUES (1, 16, 'edit', '2025-02-11 15:32:44.38344');

-- ----------------------------
-- Function structure for log_review_deletion
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."log_review_deletion"();
CREATE OR REPLACE FUNCTION "public"."log_review_deletion"()
  RETURNS "pg_catalog"."trigger" AS $BODY$BEGIN
    INSERT INTO reviews_logs ("reviewID", "userID", "operationName", "operationDate") 
    VALUES (OLD."reviewID", OLD."userID", 'delete', NOW());
    RETURN OLD;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;

-- ----------------------------
-- Function structure for log_review_edit
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."log_review_edit"();
CREATE OR REPLACE FUNCTION "public"."log_review_edit"()
  RETURNS "pg_catalog"."trigger" AS $BODY$
BEGIN

  INSERT INTO reviews_logs ("reviewID", "userID", "operationName", "operationDate") 
  VALUES (OLD."reviewID", OLD."userID", 'edit', NOW());
	RETURN NEW;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;

-- ----------------------------
-- Function structure for log_review_operation
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."log_review_operation"();
CREATE OR REPLACE FUNCTION "public"."log_review_operation"()
  RETURNS "pg_catalog"."trigger" AS $BODY$
BEGIN
    IF TG_OP = 'DELETE' THEN
        INSERT INTO reviews_logs ("reviewID", "userID", "operationName", "operationDate") 
        VALUES (OLD."reviewID", OLD."userID", 'delete', NOW());
    ELSIF TG_OP = 'UPDATE' THEN
        INSERT INTO reviews_logs ("reviewID", "userID", "operationName", "operationDate") 
        VALUES (OLD."reviewID", OLD."userID", 'edit', NOW());
    ELSIF TG_OP = 'INSERT' THEN
        INSERT INTO reviews_logs ("reviewID", "userID", "operationName", "operationDate") 
        VALUES (NEW."reviewID", NEW."userID", 'insert', NOW());
    END IF;
    RETURN NEW;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;

-- ----------------------------
-- Function structure for log_users_operation
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."log_users_operation"();
CREATE OR REPLACE FUNCTION "public"."log_users_operation"()
  RETURNS "pg_catalog"."trigger" AS $BODY$BEGIN
    IF TG_OP = 'DELETE' THEN
        INSERT INTO users_logs ("userID", "operationName", "operationDate") 
        VALUES (OLD."userID", 'delete', NOW());
    ELSIF TG_OP = 'UPDATE' THEN
        INSERT INTO users_logs ("userID", "operationName", "operationDate") 
        VALUES (OLD."userID", 'edit', NOW());
    ELSIF TG_OP = 'INSERT' THEN
        INSERT INTO users_logs ("userID", "operationName", "operationDate") 
        VALUES (NEW."userID", 'insert', NOW());
    END IF;
    RETURN NEW;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."reviews_logs_reviewLogID_seq"
OWNED BY "public"."reviews_logs"."reviewLogID";
SELECT setval('"public"."reviews_logs_reviewLogID_seq"', 197, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."reviews_reviewID_seq"
OWNED BY "public"."reviews"."reviewID";
SELECT setval('"public"."reviews_reviewID_seq"', 93, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."users_logs_logID_seq"
OWNED BY "public"."users_logs"."logID";
SELECT setval('"public"."users_logs_logID_seq"', 1, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."users_userID_seq"
OWNED BY "public"."users"."userID";
SELECT setval('"public"."users_userID_seq"', 16, true);

-- ----------------------------
-- Auto increment value for reviews
-- ----------------------------
SELECT setval('"public"."reviews_reviewID_seq"', 93, true);

-- ----------------------------
-- Triggers structure for table reviews
-- ----------------------------
CREATE TRIGGER "log_review_delete" BEFORE DELETE ON "public"."reviews"
FOR EACH ROW
EXECUTE PROCEDURE "public"."log_review_deletion"();
CREATE TRIGGER "log_review_edit" BEFORE UPDATE ON "public"."reviews"
FOR EACH ROW
EXECUTE PROCEDURE "public"."log_review_edit"();
CREATE TRIGGER "log_review_insert" AFTER INSERT ON "public"."reviews"
FOR EACH ROW
EXECUTE PROCEDURE "public"."log_review_operation"();

-- ----------------------------
-- Primary Key structure for table reviews
-- ----------------------------
ALTER TABLE "public"."reviews" ADD CONSTRAINT "reviews_pkey" PRIMARY KEY ("reviewID");

-- ----------------------------
-- Auto increment value for reviews_logs
-- ----------------------------
SELECT setval('"public"."reviews_logs_reviewLogID_seq"', 197, true);

-- ----------------------------
-- Primary Key structure for table reviews_logs
-- ----------------------------
ALTER TABLE "public"."reviews_logs" ADD CONSTRAINT "reviewLogID" PRIMARY KEY ("reviewLogID");

-- ----------------------------
-- Auto increment value for users
-- ----------------------------
SELECT setval('"public"."users_userID_seq"', 16, true);

-- ----------------------------
-- Triggers structure for table users
-- ----------------------------
CREATE TRIGGER "users_delete" BEFORE DELETE ON "public"."users"
FOR EACH ROW
EXECUTE PROCEDURE "public"."log_users_operation"();
CREATE TRIGGER "users_insert" AFTER INSERT ON "public"."users"
FOR EACH ROW
EXECUTE PROCEDURE "public"."log_users_operation"();
CREATE TRIGGER "users_update" BEFORE UPDATE ON "public"."users"
FOR EACH ROW
EXECUTE PROCEDURE "public"."log_users_operation"();

-- ----------------------------
-- Primary Key structure for table users
-- ----------------------------
ALTER TABLE "public"."users" ADD CONSTRAINT "users_pkey" PRIMARY KEY ("userID");

-- ----------------------------
-- Auto increment value for users_logs
-- ----------------------------
SELECT setval('"public"."users_logs_logID_seq"', 1, true);

-- ----------------------------
-- Primary Key structure for table users_logs
-- ----------------------------
ALTER TABLE "public"."users_logs" ADD CONSTRAINT "users_logs_pkey" PRIMARY KEY ("logID");

-- ----------------------------
-- Foreign Keys structure for table reviews
-- ----------------------------
ALTER TABLE "public"."reviews" ADD CONSTRAINT "userID" FOREIGN KEY ("userID") REFERENCES "public"."users" ("userID") ON DELETE NO ACTION ON UPDATE NO ACTION;
