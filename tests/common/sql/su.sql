CREATE USER 'rdig_test'@'localhost' IDENTIFIED BY '@rdigpw_Test20';

GRANT ALTER, CREATE, CREATE VIEW, DROP, INDEX, REFERENCES, SHOW DATABASES, SHOW VIEW, SUPER, TRIGGER
    ON *.*
    TO 'rdig_test'@'localhost'
    IDENTIFIED BY '@rdigpw_Test20';

GRANT ALL
    ON rdig_next_test.*
    TO 'rdig_test'@'localhost'
    IDENTIFIED BY '@rdigpw_Test20';

FLUSH PRIVILEGES;
