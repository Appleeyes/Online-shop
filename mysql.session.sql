CREATE TABLE `users` (
    user_id INTEGER NOT NULL AUTO_INCREMENT,
    fullname VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    is_active TINYINT(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '0 = not active, 1 = active',
    PRIMARY KEY(user_id)
);

-- CLASSROOMS TABLE
CREATE TABLE `classrooms` (
    classroom_id TINYINT NOT NULL AUTO_INCREMENT,
    name VARCHAR(30) NOT NULL,
    is_active TINYINT(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '0 = not active, 1 = active',
    PRIMARY KEY(classroom_id)
);

-- STUDENTS TABLE
CREATE TABLE `students` (
    student_id INTEGER NOT NULL AUTO_INCREMENT,
    full_name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    classroom_id TINYINT NOT NULL,
    grade INTEGER NOT NULL,
    is_active TINYINT(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '0 = not active, 1 = active',
    PRIMARY KEY(student_id),
    FOREIGN KEY(classroom_id) REFERENCES classrooms(classroom_id)
);

ALTER TABLE students
ADD CONSTRAINT fk_classroom
FOREIGN KEY (classroom_id)
REFERENCES classrooms (classroom_id)
ON DELETE CASCADE
ON UPDATE CASCADE;
