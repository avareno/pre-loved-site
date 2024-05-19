CREATE TABLE IF NOT EXISTS MESSAGES (
  ID INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  CONVERSATION_ID int NOT NULL ,
  ACCOUNT_ID int NOT NULL,
  MSG varchar(255) NOT NULL,
  SUBMIT_DATE datetime NOT NULL,
  FOREIGN KEY (CONVERSATION_ID) REFERENCES conversations(ID),
  FOREIGN KEY (ACCOUNT_ID) REFERENCES USERS(ID)
);



INSERT INTO MESSAGES (CONVERSATION_ID, ACCOUNT_ID, MSG, SUBMIT_DATE) VALUES
(1, 1, 'Hello, how are you?', '2023-05-01 10:01:00'),
(1, 2, 'I am good, thanks! How about you?', '2023-05-01 10:02:00'),
(1, 1, 'I am fine too. What are you up to?', '2023-05-01 10:03:00'),
(1, 2, 'Just working on a project.', '2023-05-01 10:04:00'),
(2, 2, 'Hey! Are you coming to the meeting?', '2023-05-02 11:01:00'),
(2, 3, 'Yes, I will be there in 10 minutes.', '2023-05-02 11:02:00'),
(2, 2, 'Great! See you then.', '2023-05-02 11:03:00');