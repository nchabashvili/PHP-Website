-- Populate users
INSERT INTO Users(
    firstname,
    lastname,
    email
) VALUES (
    'Nodar',
    'Chabashvili',
    'no.chabashvili@jacobs-university.de'
), (
    'Dachi',
    'Miller',
    'dachi1014@gmail.com'
), (
    'Luka',
    'Kvavilashvili',
    'lkvavilashvili@gmail.com'
), (
    'Ani',
    'Shalikashvili',
    'ashalik@jacobs-university.de'
), (
    'Sandro',
    'Gakharia',
    'sgakharia@jacobs-university.de'
), (
    'Keto',
    'Loladze',
    'klola@gmail.com'
), (
    'Nika',
    'Bodaveli',
    'nbodav@gmail.com'
);

INSERT INTO Customer(
    uid,
    address
) VALUES 
    (1, 'College Ring 6'), 
    (2, 'college Ring 5'),
    (3, 'College Ring 1'), 
    (4, 'college Ring 7');

INSERT INTO Courier(
    uid,
    vehicle
) VALUES 
    (5, 'foot'),
    (6, 'moped'),
    (7, 'car');

INSERT INTO Pharmacy(
    name,
    address
) VALUES 
    ('Kronen Apotheke', 'Friedrich-Humbert-Strasse 149'),
    ('Stadt Apotheke', 'Reeder-Bischoff-Strasse 28'),
    ('Machandel Apotheke', 'Dobbheide 52'),
    ('Aesculap-Apotheke', 'Gerhard-Rohlfs-Strasse 16A');

   
INSERT INTO Drug(
    name,
    price
) VALUES
    ('Atorvastatin', 1000),
    ('Paracetamol', 2300),
    ('Nurofen', 1400),
    ('mig 400', 450);