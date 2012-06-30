USE inceptionfog;
CREATE TABLE IF NOT EXISTS Boards (
Id int NOT NULL AUTO_INCREMENT,
PRIMARY KEY (Id)
);
CREATE TABLE IF NOT EXISTS Notes (
Id int NOT NULL AUTO_INCREMENT,
PRIMARY KEY (Id)
);
CREATE TABLE IF NOT EXISTS Requirement (
Id int NOT NULL AUTO_INCREMENT,
PRIMARY KEY (Id)
);

CREATE TABLE IF NOT EXISTS Votes (
Id int NOT NULL AUTO_INCREMENT,
PRIMARY KEY (Id)
);

ALTER TABLE Notes ADD Content VARCHAR(2000);
ALTER TABLE Notes ADD AddedBy VARCHAR(100);
ALTER TABLE Notes ADD AddedOn DATETIME;
ALTER TABLE Notes
  ADD BoardId INT ,
  ADD FOREIGN KEY (BoardId) REFERENCES Boards(Id) ON DELETE CASCADE;
  
ALTER TABLE Requirement ADD Content VARCHAR(2000);

ALTER TABLE Votes ADD VotedBy VARCHAR(100);
ALTER TABLE Votes ADD VotedOn DATETIME;
ALTER TABLE Votes
  ADD RequirementId INT ,
  ADD FOREIGN KEY (RequirementId) REFERENCES Requirement(Id) ON DELETE CASCADE;
ALTER TABLE Votes
  ADD NotesId INT ,
  ADD FOREIGN KEY (NotesId) REFERENCES Notes(Id) ON DELETE CASCADE; 