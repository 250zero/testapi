TestApi

Es Una API de prueba minimalista, desarrollada sin utilizar ningún framework, diseñada para crear y gestionar una lista de contactos.

Estos son los End-points de la api

Para la creacion de un contacto:   

Descripcion: Crea un contacto con sus numeros telefonicos
EndPoint : /contact
Metodo: POST
Parametros / Body: {
        "name": "adalberto",   ---- requerido
        "last_name": "turby", ---- requerido
        "email": "email",     ---- requerido
        "telephone": [
            "343434343434",
             "829-759-66699"
        ]
}

Descripcion: Agrega un numero telefonico a un contacto
EndPoint : /contact/add-phone
Metodo: POST
Parametros / Body: {
        "phone": "829-666-6666",   ---- requerido
        "id_contact": "10", ---- requerido
         
}

Descripcion: Elimina segun configuracion por delete o por estado
EndPoint : /contact
Metodo: DELETE
Parametros / Body: {
        "id_contact":10 ---- requerido
}

Descripcion: Poder ver todos los contactos activos
EndPoint : /contact/list
Metodo: GET
 

Descripcion: Poder ver la ficha de un contacto
EndPoint : /contact/detail
Metodo: GET
Parametros / Body: {
        "id_contact": "12",   ---- requerido 
}

Aqui dejo el script de Base de datos: 

-- Volcando estructura de base de datos para testapi
CREATE DATABASE IF NOT EXISTS `testapi` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci */;
USE `testapi`;

-- Volcando estructura para tabla testapi.contact
CREATE TABLE IF NOT EXISTS `contact` (
  `id_contact` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(70) NOT NULL DEFAULT '',
  `last_name` varchar(70) NOT NULL DEFAULT '',
  `email` varchar(70) NOT NULL DEFAULT '',
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_contact`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
 
CREATE TABLE IF NOT EXISTS `telephone` (
  `id_telephone` int(11) NOT NULL AUTO_INCREMENT,
  `id_contact` int(11) NOT NULL DEFAULT 0,
  `phone_number` varchar(70) NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_telephone`),
  KEY `FK_contact` (`id_contact`),
  CONSTRAINT `FK_contact` FOREIGN KEY (`id_contact`) REFERENCES `contact` (`id_contact`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
 
 

