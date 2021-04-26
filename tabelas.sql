CREATE DATABASE teste_php;
USE teste_php;


CREATE TABLE chaves(
    chave INTEGER NOT NULL,
    PRIMARY KEY(chave)
);


CREATE TABLE usuario(
    idUsuario INTEGER NOT NULL AUTO_INCREMENT,
    tipoUsuario VARCHAR(55) NOT NULL,
    nomeUsuario VARCHAR(255) NOT NULL,
    dataNascimentoUsuario DATE NOT NULL,
    emailUsuario VARCHAR(255) NOT NULL,
    senhaUsuario VARCHAR(255) NOT NULL,
    cpfUsuario VARCHAR(20),
    generoUsuario VARCHAR(20),
    PRIMARY KEY(idUsuario)
);


CREATE TABLE prova(
    idProva INTEGER NOT NULL AUTO_INCREMENT,
    nomeProva VARCHAR(255) NOT NULL,
    siglaProva VARCHAR(55) NOT NULL,
    anoAplicacao VARCHAR(10) NOT NULL,
    PRIMARY KEY(idProva)
);

CREATE TABLE area (
	idArea INTEGER NOT NULL AUTO_INCREMENT, 
    nomeArea VARCHAR(255) NOT NULL,
    PRIMARY KEY (idArea)
);

CREATE TABLE materia (
	idMateria INTEGER NOT NULL AUTO_INCREMENT,
	nomeMateria VARCHAR(255) NOT NULL,
    areaMateria VARCHAR(255) NOT NULL,
	idArea INTEGER NOT NULL,
	PRIMARY KEY (idMateria),
	CONSTRAINT fk_area_materia FOREIGN KEY (idArea) REFERENCES area (idArea)
);


CREATE TABLE conteudo (
	idConteudo INTEGER NOT NULL AUTO_INCREMENT, 
    nomeConteudo VARCHAR(255) NOT NULL,
    linkConteudo TEXT NOT NULL,
    materiaConteudo VARCHAR(255) NOT NULL,
    idMateria INTEGER NOT NULL,
    PRIMARY KEY (idConteudo),
    CONSTRAINT fk_materia_conteudo FOREIGN KEY (idMateria) REFERENCES materia (idMateria)
);


CREATE TABLE topico (
    idTopico INTEGER NOT NULL AUTO_INCREMENT, 
    nomeTopico VARCHAR(255) NOT NULL,
    linkTopico TEXT,
    conteudoTopico VARCHAR(244) NOT NULL, 
    idConteudo INTEGER NOT NULL,
    PRIMARY KEY (idTopico),
    CONSTRAINT fk_conteudo_topico FOREIGN KEY (idConteudo) REFERENCES conteudo (idConteudo)
);


CREATE TABLE questao (
	idQuestao INTEGER NOT NULL AUTO_INCREMENT, 
    provaQuestao VARCHAR (255) NOT NULL, 
    areaQuestao VARCHAR (255) NOT NULL, 
    materiaQuestao VARCHAR (255) NOT NULL, 
    conteudoQuestao VARCHAR (255) NOT NULL, 
    topicoQuestao VARCHAR (255) NOT NULL, 
    enunciadoQuestao TEXT NOT NULL,
    tituloEnunciado1 VARCHAR(255),
    arquivoEnunciado1 LONGBLOB,
    fonteEnunciado1 VARCHAR(255),
    tituloEnunciado2 VARCHAR(255),
    arquivoEnunciado2 LONGBLOB,
    fonteEnunciado2 VARCHAR(255),
    alternativaA TEXT NOT NULL,
    tituloAlternativaA VARCHAR(255),
    arquivoAlternativaA LONGBLOB,
    fonteAlternativaA VARCHAR(255),
    alternativaB TEXT NOT NULL,
    tituloAlternativaB VARCHAR(255),
    arquivoAlternativaB LONGBLOB,
    fonteAlternativaB VARCHAR(255),
    alternativaC TEXT NOT NULL,
    tituloAlternativaC VARCHAR(255),
    arquivoAlternativaC LONGBLOB,
    fonteAlternativaC VARCHAR(255),
    alternativaD TEXT NOT NULL,
    tituloAlternativaD VARCHAR(255),
    arquivoAlternativaD LONGBLOB,
    fonteAlternativaD VARCHAR(255),
    alternativaE TEXT NOT NULL,
    tituloAlternativaE VARCHAR(255),
    arquivoAlternativaE LONGBLOB,
    fonteAlternativaE VARCHAR(255),
    alternativaCorreta VARCHAR (55),
    resolucaoQuestao TEXT NOT NULL, 
    tituloResolucao1 VARCHAR(255),
    arquivoResolucao1 LONGBLOB,
    fonteResolucao1 VARCHAR(255),
    tituloResolucao2 VARCHAR(255),
    arquivoResolucao2 LONGBLOB,
    fonteResolucao2 VARCHAR(255),
    idProva INTEGER NOT NULL, 
    idArea INTEGER NOT NULL, 
    idMateria INTEGER NOT NULL, 
    idConteudo INTEGER NOT NULL, 
    idTopico INTEGER NOT NULL,  
    PRIMARY KEY (idQuestao),
	CONSTRAINT fk_prova_questao FOREIGN KEY (idProva) REFERENCES prova (idProva),
    CONSTRAINT fk_area_questao FOREIGN KEY (idArea) REFERENCES area (idArea),
    CONSTRAINT fk_materia_questao FOREIGN KEY (idMateria) REFERENCES materia (idMateria),
    CONSTRAINT fk_conteudo_questao FOREIGN KEY (idConteudo) REFERENCES conteudo (idConteudo),
    CONSTRAINT fk_topico_questao FOREIGN KEY (idTopico) REFERENCES topico (idTopico)
);

CREATE TABLE sequencia (
    id INTEGER AUTO_INCREMENT,
    PRIMARY KEY (id)
);

CREATE TABLE jornada (
idJornada INTEGER NOT NULL AUTO_INCREMENT,
dataAtual DATE NOT NULL,
diasSemana INT NOT NULL,
questoesRoteiro INT NOT NULL,
emailEstudante VARCHAR(255) NOT NULL,
idUsuario INTEGER NOT NULL,
idArea VARCHAR(55) NOT NULL,
PRIMARY KEY (idJornada),
CONSTRAINT fk_usuario_jornada FOREIGN KEY (idUsuario) REFERENCES usuario(idUsuario),
CONSTRAINT fk_area_jornada FOREIGN KEY (idArea) REFERENCES area(idArea)
);


CREATE TABLE roteiro (
      idRoteiro INTEGER NOT NULL,
      idQuestao INTEGER NOT NULL,
      roteiroRespondido BOOLEAN NOT NULL, 
      horaDataRespostaRoteiro DATETIME,
      semana INTEGER,
      acertoErroRoteiro BOOLEAN,
      idArea INTEGER NOT NULL,
      idJornada INTEGER NOT NULL,
      idUsuario INTEGER NOT NULL,
     PRIMARY KEY  (idRoteiro, idQuestao),
     CONSTRAINT fk_questoes_roteiro FOREIGN KEY (idQuestao) REFERENCES questao(idQuestao),
     CONSTRAINT fk_areaQuestoes_roteiro FOREIGN KEY (idArea) REFERENCES questao(idArea),
     CONSTRAINT fk_jornada_roteiro FOREIGN KEY (idJornada) REFERENCES jornada(idJornada),
     CONSTRAINT fk_usuario_roteiro FOREIGN KEY (idUsuario) REFERENCES usuario(idUsuario)
);


CREATE TABLE desempenho (
    idDesempenho INTEGER NOT NULL AUTO_INCREMENT,
    idArea INTEGER NOT NULL,
    idJornada INTEGER NOT NULL,
    totalQuestoes INTEGER NOT NULL,
    totalAcertos INTEGER NOT NULL,
    totalErros INTEGER NOT NULL,
    PRIMARY KEY (idDesempenho),
    CONSTRAINT fk_area_desempenho FOREIGN KEY (idArea) REFERENCES area (idArea)
);





    

    


