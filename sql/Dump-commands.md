# Para crear un archivo dump.sql desde la terminal:

- Leader@codewithleader: `docker compose exec db mysqldump -u root -ptest -h localhost --triggers --routines realstate_crud > docker/dump/mydump.sql`
  - Despues de ejecutar este comando pedirá la contraseña.
  - Luego creará el archivo dump.sql con todas las instrucciones para regenerar la base de datos.
  - Al crear el container se creará la base de datos con todos lo que teniamos guardado ya que el container `db` leerá el `mydump.sql` al iniciar.
