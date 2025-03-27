CREATE TABLE Users(
    id_user INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    firstname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone INT(10)
)


CREATE TABLE Sessions(
    id_session INT PRIMARY KEY AUTO_INCREMENT,
    id_user INT NOT NULL,
    date CURRENT_DATE NOT NULL,
    auth_id VARCHAR(255) NOT NULL,
    auth_pass INT(10)

    FOREIGN KEY (id_user) REFERENCES Users(id_user)
)