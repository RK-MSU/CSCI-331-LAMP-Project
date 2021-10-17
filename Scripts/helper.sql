--- AVAILABLE CHARACTER SETS
--- The following character sets are available:

show character set;


--
-- Create database
--

CREATE DATABASE mydb
	CHARACTER SET utf8mb4
	COLLATE utf8mb4_general_ci;

---
--- Alter a Database
--- 
ALTER DATABASE mydb
	CHARACTER SET utf8mb4
	COLLATE utf8mb4_general_ci;

---
--- How do I see what character set a MySQL database / table / column is
---

--- For Schemas (or Databases - they are synonyms)
SELECT default_character_set_name, default_collation_name
	FROM information_schema.SCHEMATA
	WHERE schema_name = "db36";

SELECT *
	FROM information_schema.SCHEMATA
	WHERE schema_name = "db36";

--- For Tables:
SELECT CCSA.character_set_name FROM information_schema.`TABLES` T,
       information_schema.`COLLATION_CHARACTER_SET_APPLICABILITY` CCSA
WHERE CCSA.collation_name = T.table_collation
  AND T.table_schema = "schemaname"
  AND T.table_name = "tablename";

 --- For Columns:
SELECT character_set_name FROM information_schema.`COLUMNS` 
WHERE table_schema = "schemaname"
  AND table_name = "tablename"
  AND column_name = "columnname";

--
-- Create tables and their structure
--

DROP TABLE IF EXISTS `exp_actions`;

CREATE TABLE `exp_actions` (
  `action_id` int unsigned NOT NULL AUTO_INCREMENT,
  `class` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `csrf_exempt` tinyint unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`action_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;





ENGINE=InnoDB DEFAULT CHARSET=latin1;
















