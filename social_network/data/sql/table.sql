USE blog;

CREATE TABLE IF NOT EXISTS carousel
(
	id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    image_1 NCHAR(30),
    image_2 NCHAR(30),
    image_3 NCHAR(30),
    image_4 NCHAR(30),
    image_5 NCHAR(30)

);
CREATE TABLE IF NOT EXISTS user
(
	id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    first_name NCHAR(30),
    second_name NCHAR(30),
    email NCHAR(50) NOT NULL,
    pass NCHAR(30) NOT NULL,
    descr NCHAR(100),
    avatar NCHAR(50)
);

CREATE TABLE IF NOT EXISTS post
(
	id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    id_carousel INT NOT NULL,
    id_user INT NOT NULL,
    publish_date datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    descr NCHAR(100),
    likes INT,
    
    FOREIGN KEY (id_carousel) REFERENCES carousel(id),
    FOREIGN KEY (id_user) REFERENCES user(id)
);



