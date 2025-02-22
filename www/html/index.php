<!DOCTYPE html>
<html>
     <head>
          <title>Hello PHP8!</title>
     </head>  

     <body>
          <h1>Hello, PHP8 + SQLite3!</h1>
          <?php
               $db = new SQLite3('testing.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
               // Create a table.
               $db->query(
                    'CREATE TABLE IF NOT EXISTS "users" (
                         "id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
                         "name" VARCHAR
                         )'
                    );
               // Insert some sample data.
               $db->query('INSERT INTO "users" ("name") VALUES ("Karl")');
               $db->query('INSERT INTO "users" ("name") VALUES ("Linda")');
               $db->query('INSERT INTO "users" ("name") VALUES ("John")');

               // Get the name of the tables in SQLite3 database
               $tableQuery = $db->query("SELECT name FROM sqlite_master WHERE type='table';");
               while ($myTable = $tableQuery->fetchArray(SQLITE3_ASSOC)) {
                    echo "Table: " . $myTable['name'] . "<br />";
               }
               echo "<br />";
               
               
               // Get a count of the number of users
               $userCount = $db->querySingle('SELECT COUNT(DISTINCT "id") FROM "users"');
               echo("User count: $userCount\n");
               // Close the connection
               $db->close();
          ?>

          <h1> <?php echo 'Welcome to PHP ' . phpversion(); ?> </h1>
          <p> <?php phpinfo(); ?> </p>
     </body>
</html>