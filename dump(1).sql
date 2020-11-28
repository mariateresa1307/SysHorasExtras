--
-- PostgreSQL database dump
--

-- Dumped from database version 13.0
-- Dumped by pg_dump version 13.0

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: he; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA he;


ALTER SCHEMA he OWNER TO postgres;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: cargo; Type: TABLE; Schema: he; Owner: postgres
--

CREATE TABLE he.cargo (
    id_cargo integer NOT NULL,
    nombre_cargo character varying NOT NULL
);


ALTER TABLE he.cargo OWNER TO postgres;

--
-- Name: configuracionHrasExtras; Type: TABLE; Schema: he; Owner: postgres
--

CREATE TABLE he."configuracionHrasExtras" (
    "Id_configuracion" integer NOT NULL,
    cargo integer NOT NULL,
    estado boolean NOT NULL,
    departamento integer NOT NULL,
    sueldo character varying(25)[] NOT NULL
);


ALTER TABLE he."configuracionHrasExtras" OWNER TO postgres;

--
-- Name: configuracionHrasExtras_Id_configuracion_seq; Type: SEQUENCE; Schema: he; Owner: postgres
--

CREATE SEQUENCE he."configuracionHrasExtras_Id_configuracion_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE he."configuracionHrasExtras_Id_configuracion_seq" OWNER TO postgres;

--
-- Name: configuracionHrasExtras_Id_configuracion_seq; Type: SEQUENCE OWNED BY; Schema: he; Owner: postgres
--

ALTER SEQUENCE he."configuracionHrasExtras_Id_configuracion_seq" OWNED BY he."configuracionHrasExtras"."Id_configuracion";


--
-- Name: configuracionHrasExtras_cargo_seq; Type: SEQUENCE; Schema: he; Owner: postgres
--

CREATE SEQUENCE he."configuracionHrasExtras_cargo_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE he."configuracionHrasExtras_cargo_seq" OWNER TO postgres;

--
-- Name: configuracionHrasExtras_cargo_seq; Type: SEQUENCE OWNED BY; Schema: he; Owner: postgres
--

ALTER SEQUENCE he."configuracionHrasExtras_cargo_seq" OWNED BY he."configuracionHrasExtras".cargo;


--
-- Name: configuracionHrasExtras_departamento_seq; Type: SEQUENCE; Schema: he; Owner: postgres
--

CREATE SEQUENCE he."configuracionHrasExtras_departamento_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE he."configuracionHrasExtras_departamento_seq" OWNER TO postgres;

--
-- Name: configuracionHrasExtras_departamento_seq; Type: SEQUENCE OWNED BY; Schema: he; Owner: postgres
--

ALTER SEQUENCE he."configuracionHrasExtras_departamento_seq" OWNED BY he."configuracionHrasExtras".departamento;


--
-- Name: departamento; Type: TABLE; Schema: he; Owner: postgres
--

CREATE TABLE he.departamento (
    id_departamento integer NOT NULL,
    nombre_departamento character varying NOT NULL
);


ALTER TABLE he.departamento OWNER TO postgres;

--
-- Name: estado_registro; Type: TABLE; Schema: he; Owner: postgres
--

CREATE TABLE he.estado_registro (
    id_estado_registro integer NOT NULL,
    "descripción_estado" character varying NOT NULL
);


ALTER TABLE he.estado_registro OWNER TO postgres;

--
-- Name: estado_trabajador; Type: TABLE; Schema: he; Owner: postgres
--

CREATE TABLE he.estado_trabajador (
    id_estado_trabajador integer NOT NULL,
    nombre_estado character varying NOT NULL
);


ALTER TABLE he.estado_trabajador OWNER TO postgres;

--
-- Name: hras_extras; Type: TABLE; Schema: he; Owner: postgres
--

CREATE TABLE he.hras_extras (
    id_hras_extras integer NOT NULL,
    trabajador integer NOT NULL,
    condicion bigint NOT NULL,
    fecha_hras_extras date NOT NULL,
    salario integer NOT NULL,
    "Hora_ingreso_oficial" date NOT NULL,
    "HoraOficialSalida" date NOT NULL
);


ALTER TABLE he.hras_extras OWNER TO postgres;

--
-- Name: registro_diario; Type: TABLE; Schema: he; Owner: postgres
--

CREATE TABLE he.registro_diario (
    id_registro_diario integer NOT NULL,
    trabajador integer NOT NULL,
    "fechaEntradaOficial" date NOT NULL,
    "fechaSalidaOficial" date NOT NULL,
    estado_registro integer NOT NULL,
    "Hora_ingreso_oficial" date NOT NULL,
    "HoraOficialSalida" date NOT NULL,
    "Hora_ingreso" date NOT NULL,
    "HoraSalida" date NOT NULL,
    "HorasExtras" date NOT NULL,
    "Horas_atraso" date NOT NULL
);


ALTER TABLE he.registro_diario OWNER TO postgres;

--
-- Name: tipo_usuario; Type: TABLE; Schema: he; Owner: postgres
--

CREATE TABLE he.tipo_usuario (
    id_tipo_usuario bigint NOT NULL,
    nombre_tipo_usuario character varying NOT NULL
);


ALTER TABLE he.tipo_usuario OWNER TO postgres;

--
-- Name: trabajador; Type: TABLE; Schema: he; Owner: postgres
--

CREATE TABLE he.trabajador (
    id_trabajador bigint NOT NULL,
    ci_trabajador integer NOT NULL,
    primer_nombre character varying NOT NULL,
    segundo_nombre character varying NOT NULL,
    primer_apellido character varying NOT NULL,
    segundo_apellido character varying NOT NULL,
    telefono numeric NOT NULL,
    estado_trabajador integer NOT NULL,
    direccion character varying NOT NULL,
    departamento integer NOT NULL,
    cargo integer NOT NULL,
    "Hora_ingreso" date NOT NULL,
    "Hora_ingreso_oficial" date NOT NULL,
    "Horas_atraso" date NOT NULL,
    "HorasExtras" date NOT NULL,
    "HoraSalida" date NOT NULL,
    "HoraOficialSalida" date NOT NULL,
    "HorasSalidasTempranas" date NOT NULL,
    "TotalHorasDiurnas" integer NOT NULL,
    "TotalHorasNocturnas" integer NOT NULL
);


ALTER TABLE he.trabajador OWNER TO postgres;

--
-- Name: usuario; Type: TABLE; Schema: he; Owner: postgres
--

CREATE TABLE he.usuario (
    id_usuario bigint NOT NULL,
    nombre_usuario character varying NOT NULL,
    apellido_usuario character varying NOT NULL,
    usuario character varying,
    "contraseña" character varying NOT NULL,
    status boolean NOT NULL,
    tipo_usuario integer NOT NULL
);


ALTER TABLE he.usuario OWNER TO postgres;

--
-- Name: configuracionHrasExtras Id_configuracion; Type: DEFAULT; Schema: he; Owner: postgres
--

ALTER TABLE ONLY he."configuracionHrasExtras" ALTER COLUMN "Id_configuracion" SET DEFAULT nextval('he."configuracionHrasExtras_Id_configuracion_seq"'::regclass);


--
-- Name: configuracionHrasExtras cargo; Type: DEFAULT; Schema: he; Owner: postgres
--

ALTER TABLE ONLY he."configuracionHrasExtras" ALTER COLUMN cargo SET DEFAULT nextval('he."configuracionHrasExtras_cargo_seq"'::regclass);


--
-- Name: configuracionHrasExtras departamento; Type: DEFAULT; Schema: he; Owner: postgres
--

ALTER TABLE ONLY he."configuracionHrasExtras" ALTER COLUMN departamento SET DEFAULT nextval('he."configuracionHrasExtras_departamento_seq"'::regclass);


--
-- Data for Name: cargo; Type: TABLE DATA; Schema: he; Owner: postgres
--

COPY he.cargo (id_cargo, nombre_cargo) FROM stdin;
\.


--
-- Data for Name: configuracionHrasExtras; Type: TABLE DATA; Schema: he; Owner: postgres
--

COPY he."configuracionHrasExtras" ("Id_configuracion", cargo, estado, departamento, sueldo) FROM stdin;
\.


--
-- Data for Name: departamento; Type: TABLE DATA; Schema: he; Owner: postgres
--

COPY he.departamento (id_departamento, nombre_departamento) FROM stdin;
\.


--
-- Data for Name: estado_registro; Type: TABLE DATA; Schema: he; Owner: postgres
--

COPY he.estado_registro (id_estado_registro, "descripción_estado") FROM stdin;
\.


--
-- Data for Name: estado_trabajador; Type: TABLE DATA; Schema: he; Owner: postgres
--

COPY he.estado_trabajador (id_estado_trabajador, nombre_estado) FROM stdin;
\.


--
-- Data for Name: hras_extras; Type: TABLE DATA; Schema: he; Owner: postgres
--

COPY he.hras_extras (id_hras_extras, trabajador, condicion, fecha_hras_extras, salario, "Hora_ingreso_oficial", "HoraOficialSalida") FROM stdin;
\.


--
-- Data for Name: registro_diario; Type: TABLE DATA; Schema: he; Owner: postgres
--

COPY he.registro_diario (id_registro_diario, trabajador, "fechaEntradaOficial", "fechaSalidaOficial", estado_registro, "Hora_ingreso_oficial", "HoraOficialSalida", "Hora_ingreso", "HoraSalida", "HorasExtras", "Horas_atraso") FROM stdin;
\.


--
-- Data for Name: tipo_usuario; Type: TABLE DATA; Schema: he; Owner: postgres
--

COPY he.tipo_usuario (id_tipo_usuario, nombre_tipo_usuario) FROM stdin;
\.


--
-- Data for Name: trabajador; Type: TABLE DATA; Schema: he; Owner: postgres
--

COPY he.trabajador (id_trabajador, ci_trabajador, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, telefono, estado_trabajador, direccion, departamento, cargo, "Hora_ingreso", "Hora_ingreso_oficial", "Horas_atraso", "HorasExtras", "HoraSalida", "HoraOficialSalida", "HorasSalidasTempranas", "TotalHorasDiurnas", "TotalHorasNocturnas") FROM stdin;
\.


--
-- Data for Name: usuario; Type: TABLE DATA; Schema: he; Owner: postgres
--

COPY he.usuario (id_usuario, nombre_usuario, apellido_usuario, usuario, "contraseña", status, tipo_usuario) FROM stdin;
\.


--
-- Name: configuracionHrasExtras_Id_configuracion_seq; Type: SEQUENCE SET; Schema: he; Owner: postgres
--

SELECT pg_catalog.setval('he."configuracionHrasExtras_Id_configuracion_seq"', 1, false);


--
-- Name: configuracionHrasExtras_cargo_seq; Type: SEQUENCE SET; Schema: he; Owner: postgres
--

SELECT pg_catalog.setval('he."configuracionHrasExtras_cargo_seq"', 1, false);


--
-- Name: configuracionHrasExtras_departamento_seq; Type: SEQUENCE SET; Schema: he; Owner: postgres
--

SELECT pg_catalog.setval('he."configuracionHrasExtras_departamento_seq"', 1, false);


--
-- Name: cargo cargo_pk; Type: CONSTRAINT; Schema: he; Owner: postgres
--

ALTER TABLE ONLY he.cargo
    ADD CONSTRAINT cargo_pk PRIMARY KEY (id_cargo);


--
-- Name: departamento departamento_pk; Type: CONSTRAINT; Schema: he; Owner: postgres
--

ALTER TABLE ONLY he.departamento
    ADD CONSTRAINT departamento_pk PRIMARY KEY (id_departamento);


--
-- Name: estado_registro estado_registro_pk; Type: CONSTRAINT; Schema: he; Owner: postgres
--

ALTER TABLE ONLY he.estado_registro
    ADD CONSTRAINT estado_registro_pk PRIMARY KEY (id_estado_registro);


--
-- Name: estado_trabajador estado_trabajador_pk; Type: CONSTRAINT; Schema: he; Owner: postgres
--

ALTER TABLE ONLY he.estado_trabajador
    ADD CONSTRAINT estado_trabajador_pk PRIMARY KEY (id_estado_trabajador);


--
-- Name: hras_extras hras_extras_pk; Type: CONSTRAINT; Schema: he; Owner: postgres
--

ALTER TABLE ONLY he.hras_extras
    ADD CONSTRAINT hras_extras_pk PRIMARY KEY (id_hras_extras);


--
-- Name: registro_diario registro_diario_pk; Type: CONSTRAINT; Schema: he; Owner: postgres
--

ALTER TABLE ONLY he.registro_diario
    ADD CONSTRAINT registro_diario_pk PRIMARY KEY (id_registro_diario);


--
-- Name: tipo_usuario tipo_usuario_pk; Type: CONSTRAINT; Schema: he; Owner: postgres
--

ALTER TABLE ONLY he.tipo_usuario
    ADD CONSTRAINT tipo_usuario_pk PRIMARY KEY (id_tipo_usuario);


--
-- Name: trabajador trabajador_pk; Type: CONSTRAINT; Schema: he; Owner: postgres
--

ALTER TABLE ONLY he.trabajador
    ADD CONSTRAINT trabajador_pk PRIMARY KEY (id_trabajador);


--
-- Name: usuario usuario_pk; Type: CONSTRAINT; Schema: he; Owner: postgres
--

ALTER TABLE ONLY he.usuario
    ADD CONSTRAINT usuario_pk PRIMARY KEY (id_usuario);


--
-- Name: cargo_id_cargo_idx; Type: INDEX; Schema: he; Owner: postgres
--

CREATE UNIQUE INDEX cargo_id_cargo_idx ON he.cargo USING btree (id_cargo);


--
-- Name: departamento_id_departamento_idx; Type: INDEX; Schema: he; Owner: postgres
--

CREATE UNIQUE INDEX departamento_id_departamento_idx ON he.departamento USING btree (id_departamento);


--
-- Name: estado_id_estado_idx; Type: INDEX; Schema: he; Owner: postgres
--

CREATE UNIQUE INDEX estado_id_estado_idx ON he.estado_trabajador USING btree (id_estado_trabajador);


--
-- Name: tipo_usuario_id_tipo_usuario_idx; Type: INDEX; Schema: he; Owner: postgres
--

CREATE INDEX tipo_usuario_id_tipo_usuario_idx ON he.tipo_usuario USING btree (id_tipo_usuario);


--
-- Name: trabajador_id_trabajador_idx; Type: INDEX; Schema: he; Owner: postgres
--

CREATE UNIQUE INDEX trabajador_id_trabajador_idx ON he.trabajador USING btree (id_trabajador);


--
-- Name: usuario_id_usuario_idx; Type: INDEX; Schema: he; Owner: postgres
--

CREATE INDEX usuario_id_usuario_idx ON he.usuario USING btree (id_usuario);


--
-- Name: hras_extras hras_extras_fk; Type: FK CONSTRAINT; Schema: he; Owner: postgres
--

ALTER TABLE ONLY he.hras_extras
    ADD CONSTRAINT hras_extras_fk FOREIGN KEY (trabajador) REFERENCES he.trabajador(id_trabajador);


--
-- Name: hras_extras hras_extras_fk_1; Type: FK CONSTRAINT; Schema: he; Owner: postgres
--

ALTER TABLE ONLY he.hras_extras
    ADD CONSTRAINT hras_extras_fk_1 FOREIGN KEY (salario) REFERENCES he.cargo(id_cargo);


--
-- Name: registro_diario registro_diario_fk; Type: FK CONSTRAINT; Schema: he; Owner: postgres
--

ALTER TABLE ONLY he.registro_diario
    ADD CONSTRAINT registro_diario_fk FOREIGN KEY (trabajador) REFERENCES he.trabajador(id_trabajador);


--
-- Name: registro_diario registro_diario_fk_1; Type: FK CONSTRAINT; Schema: he; Owner: postgres
--

ALTER TABLE ONLY he.registro_diario
    ADD CONSTRAINT registro_diario_fk_1 FOREIGN KEY (estado_registro) REFERENCES he.estado_registro(id_estado_registro);


--
-- Name: trabajador trabajador_fk; Type: FK CONSTRAINT; Schema: he; Owner: postgres
--

ALTER TABLE ONLY he.trabajador
    ADD CONSTRAINT trabajador_fk FOREIGN KEY (estado_trabajador) REFERENCES he.estado_trabajador(id_estado_trabajador);


--
-- Name: trabajador trabajador_fk_1; Type: FK CONSTRAINT; Schema: he; Owner: postgres
--

ALTER TABLE ONLY he.trabajador
    ADD CONSTRAINT trabajador_fk_1 FOREIGN KEY (cargo) REFERENCES he.cargo(id_cargo);


--
-- Name: trabajador trabajador_fk_2; Type: FK CONSTRAINT; Schema: he; Owner: postgres
--

ALTER TABLE ONLY he.trabajador
    ADD CONSTRAINT trabajador_fk_2 FOREIGN KEY (departamento) REFERENCES he.departamento(id_departamento);


--
-- Name: usuario usuario_fk; Type: FK CONSTRAINT; Schema: he; Owner: postgres
--

ALTER TABLE ONLY he.usuario
    ADD CONSTRAINT usuario_fk FOREIGN KEY (tipo_usuario) REFERENCES he.tipo_usuario(id_tipo_usuario);


--
-- PostgreSQL database dump complete
--

