
Log in to your MySQL server, then run the following: 

```
CREATE TABLE microblog (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
txt VARCHAR(320) NOT NULL,
tim VARCHAR(40) NOT NULL,
pluses INT(6) UNSIGNED DEFAULT 0
)
```
