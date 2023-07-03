<?php

namespace App\Helper;

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Tools\DsnParser;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Symfony\Component\Dotenv\Dotenv;

class EntityManagerCreator
{
    public static function createEntityManager(): EntityManager
    {
        $config = ORMSetup::createAttributeMetadataConfiguration(
            paths: [__DIR__."/.."],
            isDevMode: true,
        );

        $dotenv = new Dotenv();
        $dotenv->load(__DIR__.'/../../.env');

        $dsnParser = new DsnParser(['postgresql' => 'pdo_pgsql']);
        $connectionParams = $dsnParser->parse($_ENV['DATABASE_URL']);
        $connectionParams['user'] = $_ENV['POSTGRES_USER'];
        $connectionParams['password'] = $_ENV['POSTGRES_PASSWORD'];

        $connection = DriverManager::getConnection($connectionParams, $config);

        return new EntityManager($connection, $config);
    }
}
