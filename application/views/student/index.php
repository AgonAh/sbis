<h2><?=$title?></h2>


ALTER TABLE generations ALTER COLUMN id SET DEFAULT nextval('id');
ALTER TABLE generations ALTER COLUMN id SET not null;
ALTER TABLE generations add primary key(id);

ALTER TABLE manager ALTER COLUMN id SET DEFAULT nextval('id');
ALTER TABLE manager ALTER COLUMN id SET not null;
ALTER TABLE manager add primary key(id);

ALTER TABLE professor ALTER COLUMN id SET DEFAULT nextval('id');
ALTER TABLE professor ALTER COLUMN id SET not null;
ALTER TABLE professor add primary key(id);

ALTER TABLE professor_subject ALTER COLUMN id SET DEFAULT nextval('id');
ALTER TABLE professor_subject ALTER COLUMN id SET not null;
ALTER TABLE professor_subject add primary key(id);

ALTER TABLE psa ALTER COLUMN id SET DEFAULT nextval('id');
ALTER TABLE psa ALTER COLUMN id SET not null;
ALTER TABLE psa add primary key(id);

ALTER TABLE roles ALTER COLUMN id SET DEFAULT nextval('id');
ALTER TABLE roles ALTER COLUMN id SET not null;
ALTER TABLE roles add primary key(id);

ALTER TABLE staff ALTER COLUMN id SET DEFAULT nextval('id');
ALTER TABLE staff ALTER COLUMN id SET not null;
ALTER TABLE staff add primary key(id);

ALTER TABLE student ALTER COLUMN id SET DEFAULT nextval('id');
ALTER TABLE student ALTER COLUMN id SET not null;
ALTER TABLE student add primary key(id);

ALTER TABLE student_subject ALTER COLUMN id SET DEFAULT nextval('id');
ALTER TABLE student_subject ALTER COLUMN id SET not null;
ALTER TABLE student_subject add primary key(id);

ALTER TABLE subject ALTER COLUMN id SET DEFAULT nextval('id');
ALTER TABLE subject ALTER COLUMN id SET not null;
ALTER TABLE subject add primary key(id);



ALTER TABLE manager ALTER COLUMN id SET DEFAULT nextval('id');
ALTER TABLE professor ALTER COLUMN id SET DEFAULT nextval('id');
ALTER TABLE professor_subject ALTER COLUMN id SET DEFAULT nextval('id');
ALTER TABLE psa ALTER COLUMN id SET DEFAULT nextval('id');
ALTER TABLE roles ALTER COLUMN id SET DEFAULT nextval('id');
ALTER TABLE staff ALTER COLUMN id SET DEFAULT nextval('id');
ALTER TABLE student ALTER COLUMN id SET DEFAULT nextval('id');
ALTER TABLE student_subject ALTER COLUMN id SET DEFAULT nextval('id');
ALTER TABLE subject ALTER COLUMN id SET DEFAULT nextval('id');






SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;



SET default_tablespace = '';

SET default_with_oids = false;

CREATE TABLE public .branches (
id serial,
name character varying(7) DEFAULT NULL::character varying
);


CREATE TABLE public .generations (
id serial,
name character varying(9) DEFAULT NULL::character varying
);



CREATE TABLE public .manager (
id serial,
staff_id serial
);




CREATE TABLE public .professor (
id serial,
staff_id serial
);


CREATE TABLE public .professor_subject (
id serial,
professor_id serial,
subject_id serial
);



CREATE TABLE public .roles (
id serial,
name character varying(9) DEFAULT NULL::character varying
);



CREATE TABLE public .staff (
id serial,
name character varying(13) DEFAULT NULL::character varying,
username character varying(10) DEFAULT NULL::character varying,
password character varying(32) DEFAULT NULL::character varying,
role_id serial,
created_at character varying(19) DEFAULT NULL::character varying
);


CREATE TABLE public.student (
id serial,
name character varying(15) DEFAULT NULL::character varying,
username character varying(14) DEFAULT NULL::character varying,
password character varying(32) DEFAULT NULL::character varying,
generation_id serial,
branch_id serial,
created_at character varying(19) DEFAULT NULL::character varying
);


CREATE TABLE public .student_subject (
id serial,
professor_subject_id serial,
student_id serial,
subject_id serial,
grade character varying(1) DEFAULT NULL::character varying,
active smallint
);


CREATE TABLE public .subject (
id serial,
name character varying(16) DEFAULT NULL::character varying,
ects smallint,
branch_id serial,
generation_id serial
);




drop table generations;
drop table manager;
drop table professor;
drop table professor_subject;
drop table psa;
drop table roles;
drop table staff;
drop table student;
drop table student_subject;
drop table subject;
drop table branches;
