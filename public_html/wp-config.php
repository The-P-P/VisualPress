<?php
// Configuração do banco de dados WordPress
define('DB_NAME', 'wordpress');
define('DB_USER', 'wpuser');
define('DB_PASSWORD', 'wppassword');
define('DB_HOST', 'localhost');
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');

// Chaves de segurança únicas
define('AUTH_KEY',         'coloque sua chave única aqui');
define('SECURE_AUTH_KEY',  'coloque sua chave única aqui');
define('LOGGED_IN_KEY',    'coloque sua chave única aqui');
define('NONCE_KEY',        'coloque sua chave única aqui');
define('AUTH_SALT',        'coloque sua chave única aqui');
define('SECURE_AUTH_SALT', 'coloque sua chave única aqui');
define('LOGGED_IN_SALT',   'coloque sua chave única aqui');
define('NONCE_SALT',       'coloque sua chave única aqui');

// Prefixo da tabela
$table_prefix = 'wp_';

// Modo de depuração
define('WP_DEBUG', false);

// URL e diretório base
define('WP_SITEURL', 'http://localhost/wordpress');
define('WP_HOME', 'http://localhost/wordpress');

// Configurações adicionais para ambiente VPS
define('WP_MEMORY_LIMIT', '256M');
define('WP_MAX_MEMORY_LIMIT', '512M');

// Desativar editor de arquivos
define('DISALLOW_FILE_EDIT', true);

// Configuração para atualizações automáticas
define('AUTOMATIC_UPDATER_DISABLED', false);
define('WP_AUTO_UPDATE_CORE', 'minor');

// Configuração para cache
define('WP_CACHE', false);

// Configuração para SSL (quando estiver em produção)
// define('FORCE_SSL_ADMIN', true);

// Configuração para múltiplos sites (quando necessário)
// define('WP_ALLOW_MULTISITE', true);

// Configuração para ambiente de desenvolvimento/produção
define('WP_ENVIRONMENT_TYPE', 'development');

// Configuração para idioma
define('WPLANG', 'pt_BR');

// Configuração absoluta para o diretório WordPress
if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

// Configuração do WordPress
require_once ABSPATH . 'wp-settings.php';
