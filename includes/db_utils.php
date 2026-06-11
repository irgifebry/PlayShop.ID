<?php





function db_has_column(PDO $pdo, string $table, string $column): bool {
    $dbName = $pdo->query('SELECT DATABASE()')->fetchColumn();
    if (!$dbName) return false;

    $stmt = $pdo->prepare("
        SELECT COUNT(*)
        FROM INFORMATION_SCHEMA.COLUMNS
        WHERE TABLE_SCHEMA = ?
          AND TABLE_NAME = ?
          AND COLUMN_NAME = ?
    ");
    $stmt->execute([$dbName, $table, $column]);
    return (int)$stmt->fetchColumn() > 0;
}




function post(string $key, $default = '') {
    return $_POST[$key] ?? $default;
}




function app_root_dir(): string {
    return realpath(__DIR__ . '/..') ?: (__DIR__ . '/..');
}








function app_base_url_path(): string {
    $docRoot = realpath($_SERVER['DOCUMENT_ROOT'] ?? '');
    $appRoot = realpath(app_root_dir());

    if (!$docRoot || !$appRoot) return '';

    
    $docRootNorm = strtolower(str_replace('\\', '/', $docRoot));
    $appRootNorm = strtolower(str_replace('\\', '/', $appRoot));

    if (strpos($appRootNorm, $docRootNorm) !== 0) return '';

    $rel = substr($appRootNorm, strlen($docRootNorm));
    $rel = '/' . trim($rel, '/');
    return $rel === '/' ? '' : $rel;
}






function public_rel_path_from_abs(string $absPath): string {
    $root = realpath(app_root_dir());
    $abs = realpath($absPath) ?: $absPath;

    if ($root) {
        $rootNorm = str_replace('\\', '/', $root);
        $absNorm = str_replace('\\', '/', $abs);

        
        if (strpos(strtolower($absNorm), strtolower($rootNorm)) === 0) {
            $rel = substr($absNorm, strlen($rootNorm));
            $rel = ltrim($rel, '/');
            return $rel;
        }
    }

    
    return basename($abs);
}








function asset_url(string $path): string {
    $path = trim((string)$path);
    if ($path === '') return '';

    
    if (preg_match('#^https?://#i', $path)) return $path;

    $base = app_base_url_path();

    
    if ($base !== '' && (strpos($path, $base . '/') === 0 || $path === $base)) {
        return $path;
    }

    if (substr($path, 0, 1) === '/') {
        return $base . '/' . ltrim($path, '/');
    }

    return $base . '/' . ltrim($path, '/');
}
