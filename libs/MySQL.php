<?php

/**
 * Description of MySQL
 *
 */
class MySQL {
    use tSingleton;
    
    protected ?PDO $connection = null;
    protected function __construct() {
        $this->connection = new PDO('mysql:host='.SQL_HOST.';dbname='.SQL_DB, SQL_USER, SQL_PWD, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
    }
    
    public function q(string $q, array $args = []): PDOStatement {
        $stmt = $this->connection->prepare($q);
        $stmt->execute($args);
        return $stmt;
    }
    
    public function x(string $q, array $args = [], bool $emptyIsFine = true): bool {
        try {
            $stmt = $this->q($q, $args);
        } catch(Exception $e) {
            return false;
        }
        return $emptyIsFine || (0 < $stmt->rowCount());
    }
    
    public function o(string $q, array $args = []): ?array {
        $returns = null;
        try {
            $stmt = $this->q($q, $args);
            $returns = $stmt->fetch(PDO::FETCH_ASSOC);
            if(false === $returns) {
                $returns = null;
            }
        } catch(Exception $e) {
            $returns = null;
        }
        return $returns;
    }
    
    public function l(string $q, array $args = []): array {
        try {
            $stmt = $this->q($q, $args);
        } catch(Exception $e) {
            return [];
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
