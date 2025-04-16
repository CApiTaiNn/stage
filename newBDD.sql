CREATE TABLE Users(
    id_user BIGINT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    firstname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone INT(10)
)


CREATE TABLE Sessions(
    id_session BIGINT PRIMARY KEY,
    id_user BIGINT NOT NULL,
    date CURRENT_DATE NOT NULL,
    auth_id VARCHAR(255) NOT NULL,
    auth_pass VARCHAR(255) NOT NULL,
    adr_ip VARCHAR(255) NOT NULL,

    FOREIGN KEY (id_user) REFERENCES Users(id_user)
)

CREATE TABLE Traffic(
    id_traffic BIGINT PRIMARY KEY,
    adr_ip VARCHAR(255) NOT NULL,
    date CURRENT_DATE NOT NULL,
    url VARCHAR(255) NOT NULL,

    FOREIGN KEY (adr_ip) REFERENCES Sessions(adr_ip)
)