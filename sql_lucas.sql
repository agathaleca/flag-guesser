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
        id_user         Int  Auto_increment  NOT NULL ,
        pseudo     Varchar (50) NOT NULL ,
        Mail       Varchar (50) NOT NULL ,
        Password   Varchar (50) NOT NULL ,
        created_on Datetime NOT NULL
	,CONSTRAINT Users_PK PRIMARY KEY (id_user)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Games
#------------------------------------------------------------

CREATE TABLE Games(
        id_game Int  Auto_increment  NOT NULL ,
        category Varchar (50) NOT NULL,
        played_on Datetime,
        played_by Int
	,CONSTRAINT Games_PK PRIMARY KEY (id_game)
        ,CONSTRAINT Games_Users_FK FOREIGN KEY (played_by) REFERENCES Users(id_user)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Answers
#------------------------------------------------------------

CREATE TABLE Answers(
        id_answer    Int  Auto_increment  NOT NULL ,
        answer       Varchar (50) NOT NULL ,
        score_answer Int NOT NULL ,
        id_game      Int  NOT NULL
	,CONSTRAINT Answers_PK PRIMARY KEY (id_answer)
	,CONSTRAINT Answers_Games_FK FOREIGN KEY (id_game) REFERENCES Games(id_game)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: is in quiz
#------------------------------------------------------------

CREATE TABLE is_in_quiz(
        id_game    Int NOT NULL ,
        ISO        Varchar (10) NOT NULL ,
        asked      Bool NOT NULL ,
        time_asked Datetime
	,CONSTRAINT is_in_quiz_PK PRIMARY KEY (id_game,ISO)
	,CONSTRAINT is_in_quiz_Games_FK FOREIGN KEY (id_game) REFERENCES Games(id_game)
	,CONSTRAINT is_in_quiz_Flags_FK FOREIGN KEY (ISO) REFERENCES Flags(ISO)
)ENGINE=InnoDB;
