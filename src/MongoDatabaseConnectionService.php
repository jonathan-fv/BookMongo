<?php

abstract class MongoDatabaseConnectionService
{
	protected static $connection = null;

	public static function get(): MongoDB\Database
	{
		if (!self::$connection) {
			try {
				self::$connection = self::createConnection();
			} catch (\Exception $e) {
				// Log db error message
				// $e->getMessage()
				throw new Exception('Database ERROR');
			}
		}

		return self::$connection;
	}


	protected static function createConnection()
	{
		$host = 'localhost';
		$port = 27017;
		$database = 'BookApp';
		
        $dsn = "mongodb://{$host}:{$port}";

		return (new MongoDB\Client($dsn))->selectDatabase($database);
	}
}