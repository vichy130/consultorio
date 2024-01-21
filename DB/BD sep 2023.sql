/* UPDATED ON JAN 20 24, CONSULTORIO AUTO INCREMENT MODIFY REMOVED */
create database consultorio;
use consultorio;

create table usuario ( username varchar(20) primary key not null, nombre varchar(50), apellidoPaterno varchar(50), apellidoMaterno varchar(50), 
telefono varchar(45), correo varchar(50), contrasena varchar(45), tipoUsuario char(1));

create table paciente ( id int(10) primary key not null auto_increment, nombre varchar(45), apellidoPaterno varchar(45), apellidoMaterno varchar(45), fechaNacimiento date, 
sexo varchar(45), lugarNacimiento varchar(45), calle varchar(45), colonia varchar(45), ciudad varchar(45), codigoPostal int(5), telCasa varchar(45), telOficina varchar(45), celular varchar(45), edoCivil varchar(45),
 ocupacion varchar(45), escolaridad varchar(45), correo varchar(45));
 
 create table ficha (id int(10) primary key not null auto_increment, paciente int(10), tipoSangre varchar(3), quienRecomendo varchar(100), embarazo int(2), 
partos int(2), cesareas int(2), abortos int(2), muertos int(2), enfs int(2), fuma bool, cigarrosDia int(2), fumaAntiguedad varchar(45), alcohol bool, 
alcFrecuencia varchar(45), alcoholCantidad varchar(45), alcoholTipos varchar(100), adicciones varchar(1000), alergias varchar(1000), desayuno varchar(200),
comida varchar(200), cena varchar(200), entreComidas varchar(200), vasoAguaDia int(1), otrosLiquidos varchar(200), intolerancias varchar(1000), orinaDia varchar(200),
 orinaNoche varchar(200), orinaColor varchar(45), orinaOlor varchar(45), orinaMolestias varchar(200), excrementoDia varchar(45), exConsistencia varchar(45), exOlor varchar(45),
 exColor varchar(45), exDolor varchar(45), fechaMenstruacion date, mensPeriodicidad varchar(200), mensMolestias varchar(200), ejercicioSemana varchar(500), fecha date, 
 firmaPaciente blob, firmaUsuario blob, hora time, usuario varchar(20));

create table antecedentesFamilia (id bigint primary key not null, familiar varchar(45), enfermedad varchar(200), descripcion varchar(2000), ficha int(10));

create table antecedentes (id bigint primary key not null, enfermedad varchar(200), descripcion varchar(2000), estaActiva tinyint(1), ficha int(10));

create table consulta (id int(10) primary key not null auto_increment, fecha date, usuario varchar(20), paciente int(10), ta varchar(7), oxigeno int(3), pulso int(3), peso double(5,2), estatura double(5,2), 
temperatura double(4,2), motivoConsulta varchar(5000), exploracion varchar(5000), receta int(10), consultorio int(10));
 
create table consultaPrevia (id int(10) primary key not null, comentarios varchar(1000), diagnostico varchar(2000), estudios varchar(2000), tratamiento varchar(2000), consulta int(10));

create table estudiosSolicitados (id int(10) primary key not null, estudio varchar(100), receta int(10));

 create table terapiasAplicadas (id int(10) primary key not null, terapia varchar(500), consulta int(10));
 
 create table medicamentoIndicacion (id bigint primary key not null, medicamento bigint, hora time, indicaciones varchar(500), receta int(10));
 
create table medicamento (id bigint primary key not null, medicamento varchar(100), tipo varchar(500), descripcion varchar(500));
 
 create table consultorio (id int(10) primary key not null auto_increment, nombre varchar(100),calle varchar(45), colonia varchar(45), ciudad varchar(45), codigoPostal int(5), telefono varchar(45));

create table hijo (id bigint primary key not null, sexo varchar(45), edad int(2), ficha int(10));

create table receta (id int(10) primary key not null);



/* FOREIGN KEYS*/
alter table ficha add constraint fk_usuario_ficha foreign key (usuario) references usuario(username) on update cascade on delete cascade;
alter table antecedentesFamilia add constraint fk_antecedentesFamilia foreign key (ficha) references ficha(id) on update cascade on delete cascade;
alter table antecedentes add constraint fk_antecedentesPaciente foreign key (ficha) references ficha(id) on update cascade on delete cascade;
alter table ficha add constraint fk_ficha_paciente foreign key (paciente) references paciente(id) on update cascade on delete cascade;
alter table consulta add constraint fk_consulta_usuario foreign key (usuario) references usuario(username) on update cascade on delete cascade;
alter table consulta add constraint fk_consulta_paciente foreign key (paciente) references paciente(id) on update cascade on delete cascade;
alter table consultaPrevia add constraint fk_consultaPrevia_consulta foreign key (consulta) references consulta(id) on update cascade on delete cascade;
alter table estudiosSolicitados add constraint fk_estudiosSolicitados_consulta foreign key (receta) references receta(id) on update cascade on delete cascade;
alter table terapiasAplicadas add constraint fk_terapiasAplicadas_consulta foreign key (consulta) references consulta(id) on update cascade on delete cascade;
alter table medicamentoIndicacion add constraint fk_medicamentoIndicacion_consulta foreign key (receta) references receta(id) on update cascade on delete cascade;
alter table consulta add constraint fk_consulta_consultorio foreign key (consultorio) references consultorio(id) on update cascade on delete cascade;
alter table hijo add constraint fk_hijo_ficha foreign key (ficha) references ficha(id) on update cascade on delete cascade;
alter table consulta add constraint fk_receta foreign key (receta) references receta(id) on update cascade on delete cascade;
alter table medicamentoIndicacion add constraint fk_medicamentoIndicacion_medicamento foreign key (medicamento) references medicamento(id) on update cascade on delete cascade;
/* FOREIGN KEYS*/

/* INSERT ITEMS*/
insert into paciente (nombre, apellidoPaterno, apellidoMaterno, sexo, lugarNacimiento, calle, colonia, ciudad, codigoPostal, telCasa,telOficina,celular, edoCivil, ocupacion, escolaridad, correo) values ("Alfonso", "Perez", "Gomez",
"femenino", "Zapopan", "Perez Verdia #58", "La normal", "Guadalajara", "45900",33,33,33,"soltero", "Tecnico radiologo", "Licenciatura", "perez@aol.com");
insert into paciente (nombre, apellidoPaterno, apellidoMaterno, sexo, lugarNacimiento, calle, colonia, ciudad, codigoPostal, telcasa, telOficina,celular, edoCivil, ocupacion, escolaridad, correo) values ("Josefina", "Montes", "Abelar",
"masculino", "Zapopan", "Los reyes 22", "Lomas altas", "Guadalajara", "45433",33,33,33,"soltero", "Costurera", "Preparatoria", "josefinaMontes@aol.com");

insert into usuario values ("admin", "Victoria", "Cruz", "Gutierrez", "3322597920", "viki_ccg@hotmail.com", "admin", "A");
insert into usuario values ("UsuarioJane", "Jane", "Miller", "", "5566776655", "janemiller@aol.com", "pass123", "M");

 insert into consultorio (nombre,calle,colonia,ciudad,codigoPostal,telefono) values ("Consultorio Homeopatico Zapopan", "Lazaro Cardenas 54", "El zapote","Zapopan","45000","3366556677");
 
insert into ficha (paciente,tipoSangre,quienRecomendo,embarazo,partos,cesareas,abortos,muertos,enfs,fuma,cigarrosDia,fumaAntiguedad,alcohol,alcFrecuencia,alcoholCantidad,alcoholTipos,
        adicciones,alergias,desayuno,comida,cena,entreComidas,vasoAguaDia,otrosLiquidos,intolerancias,orinaDia,orinaNoche,orinaColor,orinaOlor,orinaMolestias,excrementoDia,exConsistencia,exOlor,
        exColor,exDolor,fechaMenstruacion,mensPeriodicidad,mensMolestias,ejercicioSemana,fecha,hora,usuario) values (1,'B+','Pariente',2,2,2,2,2,2,1,3,
        'desde hace 3 meses',1,'cada semana','2 botellas','brandy y tequila','fumar y tomar','polvo','sandwich','pollo','cereal','fruta',5,'coca-cola','lactosa','3 veces','2 veces','amarillo',
        'normal','ninguna','1 vez','regular','normal','cafe','no','2022/02/22','cada 30 dias', 'ninguna', '1 vez por semana', '2022/02/22',
        '12:30:00','admin' );

insert into receta values();
INSERT INTO consulta (fecha, usuario, paciente,ta,oxigeno,pulso,peso,estatura,temperatura, motivoConsulta, exploracion, receta, consultorio)  
    VALUES ('2022/02/22','admin',1,"1",1,1,65,1.2,38.8,"motivo consulta","exploracion",1,1);
    
/*insert into receta values ();*/
INSERT INTO consulta (fecha, usuario, paciente,ta,oxigeno,pulso,peso,estatura,temperatura, motivoConsulta, exploracion, receta, consultorio) 
VALUES ('2023-09-14','admin','1','1','3','3','3','3','3','3 ','3 dmdm','1','1'); 

insert into ficha (paciente,tipoSangre, quienRecomendo, embarazo, partos, cesareas, abortos, 
muertos,enfs, fuma, cigarrosDia, fumaAntiguedad,  alcohol, alcFrecuencia, alcoholCantidad, 
alcoholTipos, adicciones, alergias, desayuno, comida, cena, entreComidas, vasoAguaDia, otrosLiquidos, 
intolerancias, orinaDia, orinaNoche, orinaColor, orinaOlor, orinaMolestias, excrementoDia, 
exConsistencia, exOlor, exColor, exDolor, fechaMenstruacion, mensPeriodicidad, mensMolestias, 
ejercicioSemana, fecha, firmaUsuario, firmaPaciente, hora, usuario) values ('3', 'B-', 'NIETO', 
'2', '2', '0', '0', '0', '0', '1', '2', '2 AÑOS', '0', 'NA', 'NA', 'NA','NA', 'NINGUNA', 'NINGUNA', 
'NINGUNA', 'NINGUNA', 'NINGUNA', '1', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', '2023-09-09', '1 VEZ CADA 30 DIAS', 'NINGUNA', 'NINGUNA', '2023-09-18', '', '', '00:41:20', 'admin');

/* INSERT ITEMS*/

SET SQL_SAFE_UPDATES = 0;

select * from ficha;
select * from antecedentesFamilia where ficha=10;

select * from hijo;
SELECT * FROM hijo WHERE ficha= 11;
select * from antecedentes;
select * from ficha;
select * from paciente;
select * from antecedentesFamilia where ficha=34;
select firmaPaciente from ficha;
select * from receta;
select * from consulta;
use consultorio;
/* SELECT ITEMS */
SELECT * FROM antecedentesFamilia where ficha=2;

/*ALTER TABLES*/
ALTER TABLE consultaPrevia modify id int(10);
alter table estudiosSolicitados modify id int(10);
alter table terapiasAplicadas modify id int(10);
alter table receta modify id int(10);
use consultorio;
