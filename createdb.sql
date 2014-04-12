DROP SCHEMA IF EXESTS DICH CASCADE;
CREATE SCHEMA DICH;
SET search_path = dich;

DROP TABLE IF EXISTS trip CASCADE;
CREATE TABLE trip(
  user_id SERIAL PRIMARY KEY,
  name varchar(30) NOT NULL,
  location varchar(100) NOT NULL,
  start_date date NOT NULL,
  end_date date NOT NULL,
  user_email varchar(30) NOT NULL,
  contact_email varchar(30) NOT NULL,
  message varchar(200),
  status int default 0 NOT NULL
);
