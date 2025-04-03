CREATE TABLE Users(
    id_user VARCHAR(255) PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    firstname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone INT(10)
)


CREATE TABLE Sessions(
    id_session VARCHAR(255) PRIMARY KEY,
    id_user INT NOT NULL,
    date CURRENT_DATE NOT NULL,
    auth_id VARCHAR(255) NOT NULL,
    auth_pass VARCHAR(255) NOT NULL,

    FOREIGN KEY (id_user) REFERENCES Users(id_user)
)