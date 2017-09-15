DROP DATABASE IF EXISTS simpleactiverecord;

CREATE DATABASE simpleactiverecord;

USE simpleactiverecord;

DROP TABLE IF EXISTS t2;

DROP TABLE IF EXISTS t1;

CREATE TABLE t1
(
    col_id          INTEGER PRIMARY KEY AUTO_INCREMENT,
    
    col_bit1        BIT,
    col_bit2        BIT NOT NULL,
    col_bit3        BIT(1),
    col_bit4        BIT(1) NOT NULL,
    col_bit5        BIT(2),
    col_bit6        BIT(2) NOT NULL,
    
    col_tinyint1    TINYINT,
    col_tinyint2    TINYINT NOT NULL,
    col_tinyint3    TINYINT UNSIGNED,
    col_tinyint4    TINYINT UNSIGNED NOT NULL,
    col_tinyint5    TINYINT NOT NULL DEFAULT 11,
    col_tinyint6    TINYINT DEFAULT 11,
    col_tinyint7    TINYINT UNSIGNED DEFAULT 111,
    col_tinyint8    TINYINT UNSIGNED NOT NULL DEFAULT 112,
    col_bool1       BOOL,
    col_bool2       BOOL NOT NULL,
    col_bool3       BOOL NOT NULL DEFAULT TRUE,
    col_boolean1    BOOLEAN,
    col_boolean2    BOOLEAN NOT NULL,
    col_boolean3    BOOLEAN NOT NULL DEFAULT FALSE,
    col_smallint1   SMALLINT,
    col_smallint2   SMALLINT NOT NULL,
    col_smallint3   SMALLINT UNSIGNED,
    col_smallint4   SMALLINT UNSIGNED NOT NULL,
    col_smallint5   SMALLINT NOT NULL DEFAULT 11,
    col_mediumint1  MEDIUMINT,
    col_mediumint2  MEDIUMINT NOT NULL,
    col_mediumint3  MEDIUMINT UNSIGNED,
    col_mediumint4  MEDIUMINT UNSIGNED NOT NULL,
    col_mediumint5  MEDIUMINT NOT NULL DEFAULT 12,
    col_int1        INT,
    col_int2        INT NOT NULL,
    col_int3        INT UNSIGNED,
    col_int4        INT UNSIGNED NOT NULL,
    col_int5        INT NOT NULL DEFAULT 13,
    col_integer1    INTEGER,
    col_integer2    INTEGER NOT NULL,
    col_integer3    INTEGER UNSIGNED,
    col_integer4    INTEGER UNSIGNED NOT NULL,
    col_integer5    INTEGER NOT NULL DEFAULT 13,
    col_bigint1     BIGINT,
    col_bigint2     BIGINT NOT NULL,
    col_bigint3     BIGINT UNSIGNED,
    col_bigint4     BIGINT UNSIGNED NOT NULL,
    col_bigint5     BIGINT,
    col_bigint6     BIGINT NOT NULL DEFAULT 14,
    col_decimal1    DECIMAL,
    col_decimal2    DECIMAL NOT NULL,
    col_decimal3    DECIMAL UNSIGNED,
    col_decimal4    DECIMAL UNSIGNED NOT NULL,
    col_decimal5    DECIMAL NOT NULL DEFAULT 15,
    col_dec1        DEC,
    col_dec2        DEC NOT NULL,
    col_dec3        DEC UNSIGNED,
    col_dec4        DEC UNSIGNED NOT NULL,
    col_dec5        DEC NOT NULL DEFAULT 16,
    col_float1      FLOAT,
    col_float2      FLOAT NOT NULL,
    col_float3      FLOAT UNSIGNED,
    col_float4      FLOAT UNSIGNED NOT NULL,
    col_float5      FLOAT NOT NULL DEFAULT 17,
    col_double1     DOUBLE,
    col_double2     DOUBLE NOT NULL,
    col_double3     DOUBLE UNSIGNED,
    col_double4     DOUBLE UNSIGNED NOT NULL,
    col_double5     DOUBLE NOT NULL DEFAULT 18,
    col_doubleprecision1     DOUBLE PRECISION,
    col_doubleprecision2     DOUBLE PRECISION NOT NULL,
    col_doubleprecision3     DOUBLE PRECISION UNSIGNED,
    col_doubleprecision4     DOUBLE PRECISION UNSIGNED NOT NULL,
    col_doubleprecision5     DOUBLE PRECISION NOT NULL DEFAULT 19,
    
    col_char1       CHAR,
    col_char2       CHAR NOT NULL,
    col_char3       CHAR(2),
    col_char4       CHAR(2) NOT NULL,
    col_char5       CHAR NOT NULL DEFAULT 'a',
    col_char6       CHAR DEFAULT 'b',
    col_varchar1    VARCHAR(2),
    col_varchar2    VARCHAR(3) NOT NULL,
    col_varchar3    VARCHAR(2) DEFAULT 'cd',
    col_varchar4    VARCHAR(3) NOT NULL DEFAULT 'efg',
    col_binary1     BINARY,
    col_binary2     BINARY NOT NULL,
    col_binary3     BINARY(2),
    col_binary4     BINARY(2) NOT NULL,
    col_binary5     BINARY(2) DEFAULT 'hi',
    col_binary6     BINARY(2) NOT NULL DEFAULT 'jk',
    col_varbinary1  VARBINARY(2),
    col_varbinary2  VARBINARY(3) NOT NULL,
    col_varbinary3  VARBINARY(2) DEFAULT 'lm',
    col_varbinary4  VARBINARY(3) NOT NULL DEFAULT 'no',
    col_tinyblob1   TINYBLOB,
    col_tinyblob2   TINYBLOB NOT NULL,
    col_tinytext1   TINYTEXT,
    col_tinytext2   TINYTEXT NOT NULL,
    col_blob1       BLOB,
    col_blob2       BLOB NOT NULL,
    col_text1       TEXT,
    col_text2       TEXT NOT NULL,
    col_mediumblob1 MEDIUMBLOB,
    col_mediumblob2 MEDIUMBLOB NOT NULL,
    col_mediumtext1 MEDIUMTEXT,
    col_mediumtext2 MEDIUMTEXT NOT NULL,
    col_longblob1   LONGBLOB,
    col_longblob2   LONGBLOB NOT NULL,
    col_longtext1   LONGTEXT,
    col_longtext2   LONGTEXT NOT NULL,


    col_enum1       ENUM('value1', 'value2'),
    col_enum2       ENUM('value1', 'value2', 'value3') NOT NULL,
    col_enum3       ENUM('value1', 'value2') DEFAULT 'value2',
    col_enum4       ENUM('value', 'value2', 'value3') NOT NULL DEFAULT 'value3',
    col_set1        SET('value1', 'value2'),
    col_set2        SET('value1', 'value2', 'value3') NOT NULL,
    col_set3        SET('value1', 'value2') DEFAULT 'value2',
    col_set4        SET('value1', 'value2', 'value3') NOT NULL DEFAULT 'value3',

    col_date1       DATE,
    col_date2       DATE NOT NULL,
    col_datetime1   DATETIME,
    col_datetime2   DATETIME NOT NULL,
    col_datetime3   DATETIME DEFAULT '2014-01-02 00:01:02',
    col_datetime4   DATETIME NOT NULL DEFAULT '2015-03-04 09:10:20',
    col_timestamp1  TIMESTAMP NULL,
    col_timestamp2  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    col_time1       TIME,
    col_time2       TIME NOT NULL,

    UNIQUE single_column_unique (col_int1),
    UNIQUE double_columns_unique (col_integer1, col_integer3),
    UNIQUE triple_columns_unique (col_bigint1, col_bigint3, col_bigint5),

    UNIQUE (col_timestamp1) -- to test that col_timestamp1 won't have 'safe' validator

);

CREATE TABLE t2
(
    col_id  INTEGER PRIMARY KEY,
    FOREIGN KEY (col_id) REFERENCES t1(col_id) ON DELETE CASCADE
);

CREATE TABLE person
(
  person_id         INT PRIMARY KEY AUTO_INCREMENT,
  person_firstname  VARCHAR(35) NOT NULL COMMENT 'First name',
  person_lastname   VARCHAR(35) NOT NULL COMMENT 'Last name',
  person_gender     ENUM('male', 'female'),
  person_dob        DATE NULL,
  person_salary     DECIMAL UNSIGNED
);
