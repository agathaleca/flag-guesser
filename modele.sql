#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: Flags
#------------------------------------------------------------

CREATE TABLE Flags(
        ISO      Varchar (10) NOT NULL ,
        nom_fr   Varchar (50) NOT NULL ,
        nom_en   Varchar (50) NOT NULL ,
        Category Varchar (50) NOT NULL
	,CONSTRAINT Flags_PK PRIMARY KEY (ISO)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Users
#------------------------------------------------------------

CREATE TABLE Users(
        pseudo     Varchar (50) NOT NULL ,
        Mail       Varchar (50) NOT NULL ,
        Password   Varchar (50) NOT NULL ,
        created_on Datetime NOT NULL
	,CONSTRAINT Users_PK PRIMARY KEY (pseudo)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Games
#------------------------------------------------------------

CREATE TABLE Games(
        id_game Int  Auto_increment  NOT NULL ,
        catgory Varchar (50) NOT NULL
	,CONSTRAINT Games_PK PRIMARY KEY (id_game)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Answers
#------------------------------------------------------------

CREATE TABLE Answers(
        id_answer Int  Auto_increment  NOT NULL ,
        Answer    Varchar (50) NOT NULL
	,CONSTRAINT Answers_PK PRIMARY KEY (id_answer)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: is in quiz
#------------------------------------------------------------

CREATE TABLE is_in_quiz(
        id_game Int NOT NULL ,
        ISO     Varchar (10) NOT NULL ,
        asked   Bool NOT NULL
	,CONSTRAINT is_in_quiz_PK PRIMARY KEY (id_game,ISO)

	,CONSTRAINT is_in_quiz_Games_FK FOREIGN KEY (id_game) REFERENCES Games(id_game)
	,CONSTRAINT is_in_quiz_Flags0_FK FOREIGN KEY (ISO) REFERENCES Flags(ISO)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: plays
#------------------------------------------------------------

CREATE TABLE plays(
        id_game Int NOT NULL ,
        pseudo  Varchar (50) NOT NULL ,
        date    Datetime NOT NULL
	,CONSTRAINT plays_PK PRIMARY KEY (id_game,pseudo)

	,CONSTRAINT plays_Games_FK FOREIGN KEY (id_game) REFERENCES Games(id_game)
	,CONSTRAINT plays_Users0_FK FOREIGN KEY (pseudo) REFERENCES Users(pseudo)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: to the quizz
#------------------------------------------------------------

CREATE TABLE to_the_quizz(
        id_answer    Int NOT NULL ,
        id_game      Int NOT NULL ,
        score_answer Int NOT NULL
	,CONSTRAINT to_the_quizz_PK PRIMARY KEY (id_answer,id_game)

	,CONSTRAINT to_the_quizz_Answers_FK FOREIGN KEY (id_answer) REFERENCES Answers(id_answer)
	,CONSTRAINT to_the_quizz_Games0_FK FOREIGN KEY (id_game) REFERENCES Games(id_game)
)ENGINE=InnoDB;

