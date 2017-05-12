INSERT INTO users(id, email, password, permit) VALUES(1,'jorgebeauregard@outlook.com','secret',1);

insert into patients values(1,'Jorge','Beauregard',10,10.0,10.0,'masculine','O-','2010/10/10','ju','2222222222',0.0,'true');


INSERT INTO users(id, email, password, permit) VALUES(2,'fany@gmail.com','secret',2);

INSERT INTO medical_personnel(id, name, last_name, specialty, active) VALUES(2,"Fany","Pitol","Proctologa",TRUE);

INSERT INTO medical_procedures(id, patient_id, cause, procedure_type, observations, doctor_id, date_realized) VALUES(1,1,"Cosa de la prostata","consultation","Le va muy bien",2,"2017-02-02");



SELECT medical_procedures.cause, medical_procedures.procedure_type, medical_procedures.observations,medical_procedures.date_realized, CONCAT(medical_personnel.name,' ', medical_personnel.last_name) AS name, medical.medical_personnel.specialty FROM medical_procedures INNER JOIN medical_personnel ON medical_procedures.doctor_id = medical_personnel.id WHERE medical_procedures.id = 1;

INSERT INTO medical_procedure_drugs(id, medical_procedure_id, drug, description) VALUES(1,1,"Paracetamol","Le ayuda a ir al baño");