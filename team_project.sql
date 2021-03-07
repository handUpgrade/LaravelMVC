-- MySQL dump 10.17  Distrib 10.3.14-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: laravel_ll
-- ------------------------------------------------------
-- Server version	10.3.14-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `answers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `question_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `answers_question_id_foreign` (`question_id`),
  KEY `answers_user_id_foreign` (`user_id`),
  CONSTRAINT `answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `answers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `answers`
--

LOCK TABLES `answers` WRITE;
/*!40000 ALTER TABLE `answers` DISABLE KEYS */;
INSERT INTO `answers` VALUES (10,6,10,'안녕하세요.\n관리자 입니다.\n질문 감사합니다.','2019-12-07 19:48:16','2019-12-07 19:48:16'),(12,6,11,'답변 감사합니다.','2019-12-07 19:51:15','2019-12-07 19:51:15'),(16,6,2,'dsafsdfasdf','2019-12-07 21:43:21','2019-12-07 21:43:21'),(32,16,2,'답변!','2019-12-08 00:44:54','2019-12-08 00:44:54');
/*!40000 ALTER TABLE `answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `intros`
--

DROP TABLE IF EXISTS `intros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `intros` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `append` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `place` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `master` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `weekset` int(10) unsigned NOT NULL,
  `starttime` time NOT NULL,
  `endtime` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `intros`
--

LOCK TABLES `intros` WRITE;
/*!40000 ALTER TABLE `intros` DISABLE KEYS */;
INSERT INTO `intros` VALUES (1,'일본어 수업','훌륭한 원어민 선생님들과 함께하는 즐거운 일본어 수업을 할 수 있는 시간 수업시간 50분과 쉬는 시간 10분으로 결정되어 있음.','나레 아카데미','나레 아카데미','SDTnwaxLqekFH7f.jpg',12345,'09:00:00','12:00:00','2019-12-07 15:00:42','2019-12-07 15:00:42'),(2,'일본어 수업','훌륭한 원어민 선생님들과 함께하는 즐거운 일본어 수업을 할 수 있는 시간 수업시간 50분과 쉬는 시간 10분으로 결정되어 있음.','나레 아카데미','나레 아카데미','PoVCm2R9fPF0JdY.jpg',12345,'13:00:00','16:00:00','2019-12-07 15:07:54','2019-12-07 15:07:54'),(5,'조별계획 회의시간','조별 주말 활동을 계획하고 회의하는 즐거운 시간','みんなの401호','김종률 교수','Mp9OK6uSDtAcFhq.jpg',1,'16:00:00','18:00:00','2019-12-07 15:25:45','2019-12-07 15:25:45'),(6,'SPI 시간','SPI시험을 보고 공부를 하는 즐거운 수학시간','みんなの401호','김종률','a89GAtvHZpzt9eWspi.gif',23,'16:00:00','18:00:00','2019-12-07 15:26:45','2019-12-07 15:26:45'),(7,'자기개발 시간','엔트리시트를 작성하면서 일본에 취업에 대한 고민과 결정 자기개발을 실시하는 시간','みんなの401호','김종률 교수','',4,'16:00:00','18:00:00','2019-12-07 15:27:42','2019-12-07 15:27:42'),(8,'조별 과제 발표','매주 주말마다 실시하는 활동을 PPT와 UCC로 만들어서 발표하는 즐거운 시간','みんなの401호','김종률 교수','nrIGkXhlJ2GABXl.png',5,'16:00:00','18:00:00','2019-12-07 15:29:18','2019-12-07 15:29:18'),(11,'조별활동','각 조 계획한 대로 매주 활동하는  특별활동( 공휴일도 동일 )','계획서 참조','각 조 조장','vxeDqU6oWxW8upA.jpg',67,'09:00:00','18:00:00','2019-12-07 15:38:44','2019-12-07 15:38:44'),(12,'점심시간','근처 식당에서 점심','근처 식당','김종률 교수','mnehU9zXSV878Pt.jpg',23451,'12:00:00','13:00:00','2019-12-07 15:42:46','2019-12-07 15:53:32');
/*!40000 ALTER TABLE `intros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `members` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `intro` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `goal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` VALUES (4,'조준경','3조 , よりよい 조장 조준경 입니다.','JLPT 1급 따자!','VPsJ2YINmNNHVBjKakaoTalk_20191207_174039660.jpg','2019-12-03 18:40:48','2019-12-07 00:06:44'),(7,'오정훈','3조 , よりよい 프론트 담당 오정훈 입니다.','JPLT 2급 합격하자!','09NnvGeBTLW1QqYKakaoTalk_20191207_174256097.jpg','2019-12-03 19:27:54','2019-12-07 00:07:39'),(8,'sdfdsaf','3조 , よりよい  벡엔드 담당 서은우 입니다.','일본 취업 하자!','9iFhBxNrnLoEXcrKakaoTalk_20191207_175942468.jpg','2019-12-03 19:27:58','2019-12-07 00:00:59'),(12,'김나경','3조 , よりよい 프론트 담당 김나경 입니다.','좋은 기업 갑시다!','o3bRUJyP3kytwvHKakaoTalk_20191207_180013058.jpg','2019-12-07 00:02:00','2019-12-07 00:06:08'),(13,'박형준','3조 , よりよい  백엔드 담당 박형준 입니다.','JLPT 2급 따자!','R7i25MhDzIJ77xoKakaoTalk_20191207_180149953.jpg','2019-12-07 00:03:07','2019-12-07 00:05:53'),(14,'최민석','3조 , よりよい 백엔드 담당 최민석입니다.','JPT 점수 올리자!','pVG9oKIPVYd9dv8KakaoTalk_20191207_180946235.jpg','2019-12-07 00:04:02','2019-12-07 00:10:07');
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=150 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (143,'2014_10_12_000000_create_users_table',1),(144,'2014_10_12_100000_create_password_resets_table',1),(145,'2019_08_19_000000_create_failed_jobs_table',1),(146,'2019_11_11_051948_create_questions_table',1),(147,'2019_11_11_052014_create_answers_table',1),(148,'2019_11_20_111325_create_inrtos_table',1),(149,'2019_11_27_032008_create_members_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `questions_user_id_foreign` (`user_id`),
  CONSTRAINT `questions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (6,11,'첫 질문입니다.','안녕하세요. \r\n질문 드립니다.','2019-12-07 19:47:34','2019-12-07 19:47:34'),(13,2,'두번째 질문','질문질문질문','2019-12-07 22:30:43','2019-12-07 22:30:43'),(14,2,'세번째 질문','질문질문질문','2019-12-07 22:30:53','2019-12-07 22:30:53'),(15,2,'네번째 질문','질문질문질문','2019-12-07 22:31:02','2019-12-07 22:31:02'),(16,2,'다섯번째 질문','질문질문질문','2019-12-07 22:31:09','2019-12-07 22:31:09'),(18,2,'여섯번째 질문','질문질문질문','2019-12-07 22:32:04','2019-12-07 22:32:04');
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_user_id_unique` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'aaa','aaa@admin.com','안녕','010-5286-4257','1999-01-01','$2y$10$iXgEy/UNr.VwYAAV46HvgeylFJv/gPLNXkF8FOBBcjJ1v9de5DcJu',1,'2019-12-02 18:56:13','2019-12-07 22:31:47'),(10,'admin','admin@admin.com','관리자','010-0000-0000','1999-01-01','$2y$10$cCCh3KEy4/bThpnzor5vYOQmMuta4DC6CQc5a7I6zMYmGEXedDzre',1,'2019-12-07 19:46:08','2019-12-07 19:46:25'),(11,'mmm','mmm@mmm.com','최민석','010-0000-0000','1999-01-01','$2y$10$ZKKYjljAQy0I63H9TQfOA.7onAGmefCoMCD5Ys/YF6qpIYOaD3Ywe',0,'2019-12-07 19:47:05','2019-12-07 21:41:45'),(12,'test','ttt@ttt.com','테스트','010-1234-5678','1999-09-09','$2y$10$DVanbatiQhwub4x93yAtLeICkLOBdUbSEmRmI828Cn2hx7Tk9HaPe',0,'2019-12-08 02:00:25','2019-12-08 02:00:25');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-12-08 20:03:49
