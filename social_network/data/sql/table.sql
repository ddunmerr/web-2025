USE blog;

CREATE TABLE IF NOT EXISTS carousel
(
	id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    image_1 VARCHAR(250),
    image_2 VARCHAR(250),
    image_3 VARCHAR(250),
    image_4 VARCHAR(250),
    image_5 VARCHAR(250)

);
CREATE TABLE IF NOT EXISTS user
(
	id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    first_name VARCHAR(250),
    second_name VARCHAR(250),
    email VARCHAR(250) NOT NULL,
    pass VARCHAR(250) NOT NULL,
    descr VARCHAR(250),
    avatar VARCHAR(250)
);

CREATE TABLE IF NOT EXISTS post
(
	id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    id_carousel INT NOT NULL,
    id_user INT NOT NULL,
    publish_date datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    descr VARCHAR(250),
    likes INT,
    
    FOREIGN KEY (id_carousel) REFERENCES carousel(id),
    FOREIGN KEY (id_user) REFERENCES user(id)
);



