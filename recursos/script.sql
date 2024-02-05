drop database if exists p2_votos;
create database p2_votos;
use p2_votos;
 create table countries (  
	country_id INT AUTO_INCREMENT PRIMARY KEY,
	 name VARCHAR(255));
CREATE TABLE users (
	user_id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(255),
	email VARCHAR(255),
	password VARCHAR(255),
	phone INT,
	country_id int,
	city VARCHAR(255),
	postal_code INT,
	token VARCHAR(255) NOT NULL,
    token_status BOOLEAN NOT NULL,
    conditions_status BOOLEAN NOT NULL,
	FOREIGN KEY (`country_id`) references `countries`(`country_id`)
);


CREATE TABLE questions(
 question_id INT AUTO_INCREMENT PRIMARY KEY, 
date_start DATETIME, 
date_end DATETIME, 
question VARCHAR(255), 
estadoPregunta enum('public','private','hidden') DEFAULT NULL,
estadoRespuesta enum('public','private','hidden') DEFAULT NULL,
creator_id INT,
FOREIGN KEY (creator_id) REFERENCES users(user_id));

CREATE TABLE options(
	option_id INT AUTO_INCREMENT PRIMARY KEY,
	question_id INT,
	option_text VARCHAR(255),
	FOREIGN KEY (question_id) REFERENCES questions(question_id));

CREATE TABLE votes(
	vote_id INT AUTO_INCREMENT PRIMARY KEY,
	option_id INT,
	email VARCHAR(255),
	vote_date DATETIME,
	FOREIGN KEY (user_id) REFERENCES users(user_id),
	FOREIGN KEY (option_id) REFERENCES options(option_id));

CREATE TABLE invitations (
    invitation_id INT AUTO_INCREMENT PRIMARY KEY,
    question_id INT,
    email VARCHAR(255),
	token VARCHAR(255) NOT NULL,
	invited BOOLEAN DEFAULT false,
    FOREIGN KEY (question_id) REFERENCES questions(question_id)
);




INSERT INTO countries (name) VALUES ('Afganistán');
INSERT INTO countries (name) VALUES ('Islas Gland');
INSERT INTO countries (name) VALUES ('Albania');
INSERT INTO countries (name) VALUES ('Alemania');
INSERT INTO countries (name) VALUES ('Andorra');
INSERT INTO countries (name) VALUES ('Angola');
INSERT INTO countries (name) VALUES ('Anguilla');
INSERT INTO countries (name) VALUES ('Antártida');
INSERT INTO countries (name) VALUES ('Antigua y Barbuda');
INSERT INTO countries (name) VALUES ('Antillas Holandesas');
INSERT INTO countries (name) VALUES ('Arabia Saudí');
INSERT INTO countries (name) VALUES ('Argelia');
INSERT INTO countries (name) VALUES ('Argentina');
INSERT INTO countries (name) VALUES ('Armenia');
INSERT INTO countries (name) VALUES ('Aruba');
INSERT INTO countries (name) VALUES ('Australia');
INSERT INTO countries (name) VALUES ('Austria');
INSERT INTO countries (name) VALUES ('Azerbaiyán');
INSERT INTO countries (name) VALUES ('Bahamas');
INSERT INTO countries (name) VALUES ('Bahréin');
INSERT INTO countries (name) VALUES ('Bangladesh');
INSERT INTO countries (name) VALUES ('Barbados');
INSERT INTO countries (name) VALUES ('Bielorrusia');
INSERT INTO countries (name) VALUES ('Bélgica');
INSERT INTO countries (name) VALUES ('Belice');
INSERT INTO countries (name) VALUES ('Benin');
INSERT INTO countries (name) VALUES ('Bermudas');
INSERT INTO countries (name) VALUES ('Bhután');
INSERT INTO countries (name) VALUES ('Bolivia');
INSERT INTO countries (name) VALUES ('Bosnia y Herzegovina');
INSERT INTO countries (name) VALUES ('Botsuana');
INSERT INTO countries (name) VALUES ('Isla Bouvet');
INSERT INTO countries (name) VALUES ('Brasil');
INSERT INTO countries (name) VALUES ('Brunéi');
INSERT INTO countries (name) VALUES ('Bulgaria');
INSERT INTO countries (name) VALUES ('Burkina Faso');
INSERT INTO countries (name) VALUES ('Burundi');
INSERT INTO countries (name) VALUES ('Cabo Verde');
INSERT INTO countries (name) VALUES ('Islas Caimán');
INSERT INTO countries (name) VALUES ('Camboya');
INSERT INTO countries (name) VALUES ('Camerún');
INSERT INTO countries (name) VALUES ('Canadá');
INSERT INTO countries (name) VALUES ('República Centroafricana');
INSERT INTO countries (name) VALUES ('Chad');
INSERT INTO countries (name) VALUES ('República Checa');
INSERT INTO countries (name) VALUES ('Chile');
INSERT INTO countries (name) VALUES ('China');
INSERT INTO countries (name) VALUES ('Chipre');
INSERT INTO countries (name) VALUES ('Isla de Navidad');
INSERT INTO countries (name) VALUES ('Ciudad del Vaticano');
INSERT INTO countries (name) VALUES ('Islas Cocos');
INSERT INTO countries (name) VALUES ('Colombia');
INSERT INTO countries (name) VALUES ('Comoras');
INSERT INTO countries (name) VALUES ('República Democrática del Congo');
INSERT INTO countries (name) VALUES ('Congo');
INSERT INTO countries (name) VALUES ('Islas Cook');
INSERT INTO countries (name) VALUES ('Corea del Norte');
INSERT INTO countries (name) VALUES ('Corea del Sur');
INSERT INTO countries (name) VALUES ('Costa de Marfil');
INSERT INTO countries (name) VALUES ('Costa Rica');
INSERT INTO countries (name) VALUES ('Croacia');
INSERT INTO countries (name) VALUES ('Cuba');
INSERT INTO countries (name) VALUES ('Dinamarca');
INSERT INTO countries (name) VALUES ('Dominica');
INSERT INTO countries (name) VALUES ('República Dominicana');
INSERT INTO countries (name) VALUES ('Ecuador');
INSERT INTO countries (name) VALUES ('Egipto');
INSERT INTO countries (name) VALUES ('El Salvador');
INSERT INTO countries (name) VALUES ('Emiratos Árabes Unidos');
INSERT INTO countries (name) VALUES ('Eritrea');
INSERT INTO countries (name) VALUES ('Eslovaquia');
INSERT INTO countries (name) VALUES ('Eslovenia');
INSERT INTO countries (name) VALUES ('España');
INSERT INTO countries (name) VALUES ('Islas ultramarinas de Estados Unidos');
INSERT INTO countries (name) VALUES ('Estados Unidos');
INSERT INTO countries (name) VALUES ('Estonia');
INSERT INTO countries (name) VALUES ('Etiopía');
INSERT INTO countries (name) VALUES ('Islas Feroe');
INSERT INTO countries (name) VALUES ('Filipinas');
INSERT INTO countries (name) VALUES ('Finlandia');
INSERT INTO countries (name) VALUES ('Fiyi');
INSERT INTO countries (name) VALUES ('Francia');
INSERT INTO countries (name) VALUES ('Gabón');
INSERT INTO countries (name) VALUES ('Gambia');
INSERT INTO countries (name) VALUES ('Georgia');
INSERT INTO countries (name) VALUES ('Islas Georgias del Sur y Sandwich del Sur');
INSERT INTO countries (name) VALUES ('Ghana');
INSERT INTO countries (name) VALUES ('Gibraltar');
INSERT INTO countries (name) VALUES ('Granada');
INSERT INTO countries (name) VALUES ('Grecia');
INSERT INTO countries (name) VALUES ('Groenlandia');
INSERT INTO countries (name) VALUES ('Guadalupe');
INSERT INTO countries (name) VALUES ('Guam');
INSERT INTO countries (name) VALUES ('Guatemala');
INSERT INTO countries (name) VALUES ('Guayana Francesa');
INSERT INTO countries (name) VALUES ('Guinea');
INSERT INTO countries (name) VALUES ('Guinea Ecuatorial');
INSERT INTO countries (name) VALUES ('Guinea-Bissau');
INSERT INTO countries (name) VALUES ('Guyana');
INSERT INTO countries (name) VALUES ('Haití');
INSERT INTO countries (name) VALUES ('Islas Heard y McDonald');
INSERT INTO countries (name) VALUES ('Honduras');
INSERT INTO countries (name) VALUES ('Hong Kong');
INSERT INTO countries (name) VALUES ('Hungría');
INSERT INTO countries (name) VALUES ('India');
INSERT INTO countries (name) VALUES ('Indonesia');
INSERT INTO countries (name) VALUES ('Irán');
INSERT INTO countries (name) VALUES ('Iraq');
INSERT INTO countries (name) VALUES ('Irlanda');
INSERT INTO countries (name) VALUES ('Islandia');
INSERT INTO countries (name) VALUES ('Israel');
INSERT INTO countries (name) VALUES ('Italia');
INSERT INTO countries (name) VALUES ('Jamaica');
INSERT INTO countries (name) VALUES ('Japón');
INSERT INTO countries (name) VALUES ('Jordania');
INSERT INTO countries (name) VALUES ('Kazajstán');
INSERT INTO countries (name) VALUES ('Kenia');
INSERT INTO countries (name) VALUES ('Kirguistán');
INSERT INTO countries (name) VALUES ('Kiribati');
INSERT INTO countries (name) VALUES ('Kuwait');
INSERT INTO countries (name) VALUES ('Laos');
INSERT INTO countries (name) VALUES ('Lesotho');
INSERT INTO countries (name) VALUES ('Letonia');
INSERT INTO countries (name) VALUES ('Líbano');
INSERT INTO countries (name) VALUES ('Liberia');
INSERT INTO countries (name) VALUES ('Libia');
INSERT INTO countries (name) VALUES ('Liechtenstein');
INSERT INTO countries (name) VALUES ('Lituania');
INSERT INTO countries (name) VALUES ('Luxemburgo');
INSERT INTO countries (name) VALUES ('Macao');
INSERT INTO countries (name) VALUES ('ARY Macedonia');
INSERT INTO countries (name) VALUES ('Madagascar');
INSERT INTO countries (name) VALUES ('Malasia');
INSERT INTO countries (name) VALUES ('Malawi');
INSERT INTO countries (name) VALUES ('Maldivas');
INSERT INTO countries (name) VALUES ('Malí');
INSERT INTO countries (name) VALUES ('Malta');
INSERT INTO countries (name) VALUES ('Islas Malvinas');
INSERT INTO countries (name) VALUES ('Islas Marianas del Norte');
INSERT INTO countries (name) VALUES ('Marruecos');
INSERT INTO countries (name) VALUES ('Islas Marshall');
INSERT INTO countries (name) VALUES ('Martinica');
INSERT INTO countries (name) VALUES ('Mauricio');
INSERT INTO countries (name) VALUES ('Mauritania');
INSERT INTO countries (name) VALUES ('Mayotte');
INSERT INTO countries (name) VALUES ('México');
INSERT INTO countries (name) VALUES ('Micronesia');
INSERT INTO countries (name) VALUES ('Moldavia');
INSERT INTO countries (name) VALUES ('Mónaco');
INSERT INTO countries (name) VALUES ('Mongolia');
INSERT INTO countries (name) VALUES ('Montserrat');
INSERT INTO countries (name) VALUES ('Mozambique');
INSERT INTO countries (name) VALUES ('Myanmar');
INSERT INTO countries (name) VALUES ('Namibia');
INSERT INTO countries (name) VALUES ('Nauru');
INSERT INTO countries (name) VALUES ('Nepal');
INSERT INTO countries (name) VALUES ('Nicaragua');
INSERT INTO countries (name) VALUES ('Níger');
INSERT INTO countries (name) VALUES ('Nigeria');
INSERT INTO countries (name) VALUES ('Niue');
INSERT INTO countries (name) VALUES ('Isla Norfolk');
INSERT INTO countries (name) VALUES ('Noruega');
INSERT INTO countries (name) VALUES ('Nueva Caledonia');
INSERT INTO countries (name) VALUES ('Nueva Zelanda');
INSERT INTO countries (name) VALUES ('Omán');
INSERT INTO countries (name) VALUES ('Países Bajos');
INSERT INTO countries (name) VALUES ('Pakistán');
INSERT INTO countries (name) VALUES ('Palau');
INSERT INTO countries (name) VALUES ('Palestina');
INSERT INTO countries (name) VALUES ('Panamá');
INSERT INTO countries (name) VALUES ('Papúa Nueva Guinea');
INSERT INTO countries (name) VALUES ('Paraguay');
INSERT INTO countries (name) VALUES ('Perú');
INSERT INTO countries (name) VALUES ('Islas Pitcairn');
INSERT INTO countries (name) VALUES ('Polinesia Francesa');
INSERT INTO countries (name) VALUES ('Polonia');
INSERT INTO countries (name) VALUES ('Portugal');
INSERT INTO countries (name) VALUES ('Puerto Rico');
INSERT INTO countries (name) VALUES ('Qatar');
INSERT INTO countries (name) VALUES ('Reino Unido');
INSERT INTO countries (name) VALUES ('Reunión');
INSERT INTO countries (name) VALUES ('Ruanda');
INSERT INTO countries (name) VALUES ('Rumania');
INSERT INTO countries (name) VALUES ('Rusia');
INSERT INTO countries (name) VALUES ('Sahara Occidental');
INSERT INTO countries (name) VALUES ('Islas Salomón');
INSERT INTO countries (name) VALUES ('Samoa');
INSERT INTO countries (name) VALUES ('Samoa Americana');
INSERT INTO countries (name) VALUES ('San Cristóbal y Nevis');
INSERT INTO countries (name) VALUES ('San Marino');
INSERT INTO countries (name) VALUES ('San Pedro y Miquelón');
INSERT INTO countries (name) VALUES ('San Vicente y las Granadinas');
INSERT INTO countries (name) VALUES ('Santa Helena');
INSERT INTO countries (name) VALUES ('Santa Lucía');
INSERT INTO countries (name) VALUES ('Santo Tomé y Príncipe');
INSERT INTO countries (name) VALUES ('Senegal');
INSERT INTO countries (name) VALUES ('Serbia y Montenegro');
INSERT INTO countries (name) VALUES ('Seychelles');
INSERT INTO countries (name) VALUES ('Sierra Leona');
INSERT INTO countries (name) VALUES ('Singapur');
INSERT INTO countries (name) VALUES ('Siria');
INSERT INTO countries (name) VALUES ('Somalia');
INSERT INTO countries (name) VALUES ('Sri Lanka');
INSERT INTO countries (name) VALUES ('Suazilandia');
INSERT INTO countries (name) VALUES ('Sudáfrica');
INSERT INTO countries (name) VALUES ('Sudán');
INSERT INTO countries (name) VALUES ('Suecia');
INSERT INTO countries (name) VALUES ('Suiza');
INSERT INTO countries (name) VALUES ('Surinam');
INSERT INTO countries (name) VALUES ('Svalbard y Jan Mayen');
INSERT INTO countries (name) VALUES ('Tailandia');
INSERT INTO countries (name) VALUES ('Taiwán');
INSERT INTO countries (name) VALUES ('Tanzania');
INSERT INTO countries (name) VALUES ('Tayikistán');
INSERT INTO countries (name) VALUES ('Territorio Británico del Océano Índico');
INSERT INTO countries (name) VALUES ('Territorios Australes Franceses');
INSERT INTO countries (name) VALUES ('Timor Oriental');
INSERT INTO countries (name) VALUES ('Togo');
INSERT INTO countries (name) VALUES ('Tokelau');
INSERT INTO countries (name) VALUES ('Tonga');
INSERT INTO countries (name) VALUES ('Trinidad y Tobago');
INSERT INTO countries (name) VALUES ('Túnez');
INSERT INTO countries (name) VALUES ('Islas Turcas y Caicos');
INSERT INTO countries (name) VALUES ('Turkmenistán');
INSERT INTO countries (name) VALUES ('Turquía');
INSERT INTO countries (name) VALUES ('Tuvalu');
INSERT INTO countries (name) VALUES ('Ucrania');
INSERT INTO countries (name) VALUES ('Uganda');
INSERT INTO countries (name) VALUES ('Uruguay');
INSERT INTO countries (name) VALUES ('Uzbekistán');
INSERT INTO countries (name) VALUES ('Vanuatu');
INSERT INTO countries (name) VALUES ('Venezuela');
INSERT INTO countries (name) VALUES ('Vietnam');
INSERT INTO countries (name) VALUES ('Islas Vírgenes Británicas');
INSERT INTO countries (name) VALUES ('Islas Vírgenes de los Estados Unidos');
INSERT INTO countries (name) VALUES ('Wallis y Futuna');
INSERT INTO countries (name) VALUES ('Yemen');
INSERT INTO countries (name) VALUES ('Yibuti');
INSERT INTO countries (name) VALUES ('Zambia');
INSERT INTO countries (name) VALUES ('Zimbabue');
