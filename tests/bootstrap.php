<?php

require_once(__DIR__ . '/setup/yii_init.php');


ini_set('display_errors', 1);


        $command = Yii::$app->db->createCommand("SET @@sql_mode = ''");
        try {
            $result = $command->execute();
        } catch (Exception $e) {
            echo 'Exception: ' . $e->getMessage() . "\n";
            echo "Possilbe cause: MySQL is not running!\n";
            exit;
        }

        $command = Yii::$app->db->nocache(function (\yii\db\Connection $db) {
            $SqlStr = file_get_contents(__DIR__ . '/setup/mysql.sql');

            return $db->createCommand($SqlStr);
        });
        $result = $command->execute();


        // closing and opening connection below is needed otherwise Yii gives error:
        // "Cannot execute queries while other unbuffered queries are active."
        Yii::$app->db->close();


        // SimpleActiveRecordTest::setDSN();
        if (strpos(Yii::$app->db->dsn, 'dbname') === false) {
            Yii::$app->db->dsn .= ';dbname=simpleactiverecord';
        }

        Yii::$app->db->open();

        $command = Yii::$app->db->createCommand("SET @@sql_mode = ''");
        $result = $command->execute();
