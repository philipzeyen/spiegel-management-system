Vor der Einrichtung des Projektes müssen folgende Programme installiert werden
------------------------------------------------------------------------------
    1. Composer
    2. NodeJS
    3. GIT
    4. XAMPP (Apache, PHP, MySQL)

Bei Neueinrichtung des Projekts müssen folgende Befehle vorher in der Konsole abgesetzt werden
    
    - composer install
    - npm install
    - Kopiere die .env.example nach .env und ergänze notwenidge Angaben
    - php artisan key:generate
    - npm run dev
    - Datenbank Verbindung einrichten
    - Datenbank erstellen und Nutzer Zugriff gewähren
    - "php artisan migrate --seed" ausführen um Tabellen zu erstellen und mit Standardwerten zu befüllen
    - Bei lokaler Entwicklung kann "PHP artisan serve" verwendet werden