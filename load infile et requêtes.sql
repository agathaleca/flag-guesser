

LOAD data local infile '/home/student/Desktop/flag-guesser/flags.csv'
into table Flags
fields terminated by ','
enclosed by '"'
lines terminated by '\n'
ignore 1 rows;

select * from 
((((is_in_quiz inner join Flags on is_in_quiz.iso=Flags.iso)
inner join Games on Games.id_game=is_in_quiz.id_game)
inner join plays on Games.id_game=plays.id_game)
inner join Users on Users.pseudo=plays.pseudo);

SELECT Games.id_game, SUM(score_answer)
FROM (((Answers
INNER JOIN to_the_quiz 
ON Answers.id_answers=to_the_quiz.id_answers)
INNER JOIN Games
ON Answers.id_game=Games.id_game)
INNER JOIN Users
ON Users.id=Games.id)
ORDER BY score ASC;

    public function highscores(int $id_game): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            "SELECT Games.id_game, SUM(score_answer)
            FROM ((Games
            INNER JOIN Anwsers 
            ON Answers.id_game=Games.id_game)
            INNER JOIN Users
            ON Users.id=Games.id)
            ORDER BY score ASC"
        )->setParameter('id_game', $id_game);

        // returns an array of Product objects
        return $query->getResult();
    }

    public function totalScore(int $id_game): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT Games.id_game, SUM(score_answer)
            FROM Games
            INNER JOIN Answers
            ON :id_game=Answer.id_game AND Answer.id_game=Games.id_game)
            GROUP BY Games.id_game'
        )->setParameter('id_game', $id_game);

        // returns an array of Product objects
        return $query->getResult();
    }
