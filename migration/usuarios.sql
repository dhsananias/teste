create table teste_mosyle.usuarios
(
	id int auto_increment
		primary key,
	nome varchar(50) null,
	usuario varchar(25) null,
	email varchar(150) null,
	senha varchar(255) null,
	drink_counter int(7) null,
	criado_em datetime null,
	atualizado_em datetime null,
	deletado_em int null,
	constraint usuarios_usuario_uindex
		unique (usuario)
);

