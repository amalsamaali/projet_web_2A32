CREATE TABLE IF NOT EXISTS ratings (
    rating_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_blog INT(11) NOT NULL,
    rating_value INT(11) NOT NULL,
    FOREIGN KEY (id_blog) REFERENCES blog(id_blog) ON DELETE CASCADE
);