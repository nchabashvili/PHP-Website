CREATE TABLE Users(
    uid INT NOT NULL AUTO_INCREMENT,
    firstname VARCHAR(255) NOT NULL,
    lastname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,

    PRIMARY KEY(uid)
);

CREATE TABLE Customer(
    uid INT NOT NULL,
    cid INT NOT NULL AUTO_INCREMENT,

    address VARCHAR(255) NOT NULL,

    PRIMARY KEY(cid),
    FOREIGN KEY(uid) REFERENCES Users(uid)
);

CREATE TABLE Pharmacy(
    pid INT NOT NULL AUTO_INCREMENT,

    name VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,

    PRIMARY KEY(pid)
);

-- Delivery person
CREATE TABLE Courier(
    uid INT NOT NULL,
    cid INT NOT NULL AUTO_INCREMENT,

    vehicle ENUM('foot', 'bicycle', 'moped', 'car'),

    PRIMARY KEY(cid),
    FOREIGN KEY(uid) REFERENCES Users(uid)
);

-- List of existing drugs
CREATE TABLE Drug(
    did INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    -- In cents 2499
    price INT NOT NULL,

    PRIMARY Key(did)
);

-- Pharmacy has in stock drugs
CREATE TABLE HasInStock(
    id INT NOT NULL AUTO_INCREMENT,

    pid INT NOT NULL,
    did INT NOT NULL,
    
    PRIMARY KEY(id),

    FOREIGN KEY(pid) REFERENCES Pharmacy(pid),
    FOREIGN KEY(did) REFERENCES Drug(did)
);

-- Courier Delivers_from Pharmacy (Many to many)
CREATE TABLE DeliversFrom(
    id INT NOT NULL AUTO_INCREMENT,

    cid INT NOT NULL,
    pid INT NOT NULL,

    PRIMARY KEY(id),
    FOREIGN KEY(cid) REFERENCES Courier(cid),
    FOREIGN KEY(pid) REFERENCES Pharmacy(pid)
);

