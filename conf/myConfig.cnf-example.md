[mysqld]
# Ajusta la codificación de caracteres según tus necesidades
character-set-server = utf8mb4
collation-server = utf8mb4_unicode_ci

# Configuración de memoria y cache
key_buffer_size = 256M
innodb_buffer_pool_size = 1G

# Asegura que los registros binarios estén habilitados para fines de recuperación y replicación
log-bin = /var/lib/mysql/mysql-bin
expire_logs_days = 7
max_binlog_size = 100M

# Ajusta el límite de conexiones simultáneas según tu carga de trabajo esperada
max_connections = 200

# Ajustes de seguridad
sql_mode = STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION

# Ajustes de rendimiento de consultas
query_cache_type = 1
query_cache_size = 128M

# Configuración de innodb
innodb_file_per_table = 1
innodb_flush_log_at_trx_commit = 2
innodb_log_buffer_size = 8M
innodb_log_file_size = 256M

# Ajustes para evitar bloqueos y aumentar la eficiencia
innodb_autoinc_lock_mode = 2
innodb_buffer_pool_instances = 8
innodb_flush_method = O_DIRECT
innodb_io_capacity = 2000
innodb_read_io_threads = 8
innodb_write_io_threads = 8

# Configuración de seguridad adicional
secure-file-priv = ""

# Limita las conexiones entrantes solo a la interfaz localhost
bind-address = 127.0.0.1

# Ajusta el tamaño máximo de paquete (puede aumentar la seguridad en algunos casos)
max_allowed_packet = 16M

# Ajusta el tiempo de espera de conexiones
wait_timeout = 28800
interactive_timeout = 28800
