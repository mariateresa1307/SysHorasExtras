--
-- PostgreSQL database dump
--

-- Dumped from database version 10.9
-- Dumped by pg_dump version 10.9

-- Started on 2020-12-07 17:29:43 -04

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

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 215 (class 1259 OID 32939)
-- Name: cargo; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.cargo (
    id integer NOT NULL,
    nombre character varying,
    salario_base numeric,
    departamento_id integer
);


--
-- TOC entry 214 (class 1259 OID 32937)
-- Name: cargo_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.cargo_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2370 (class 0 OID 0)
-- Dependencies: 214
-- Name: cargo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.cargo_id_seq OWNED BY public.cargo.id;


--
-- TOC entry 217 (class 1259 OID 32955)
-- Name: control_asistencia; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.control_asistencia (
    id integer NOT NULL,
    entrada timestamp without time zone,
    salida timestamp without time zone,
    funcionario_id integer,
    tiempo_extra character varying,
    tiempo_atraso character varying,
    registro_asistencia_mensual_id integer
);


--
-- TOC entry 213 (class 1259 OID 32914)
-- Name: departamento; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.departamento (
    id integer NOT NULL,
    nombre character varying
);


--
-- TOC entry 212 (class 1259 OID 32912)
-- Name: departamento_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.departamento_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2371 (class 0 OID 0)
-- Dependencies: 212
-- Name: departamento_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.departamento_id_seq OWNED BY public.departamento.id;


--
-- TOC entry 211 (class 1259 OID 32904)
-- Name: funcionario; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.funcionario (
    id integer NOT NULL,
    cedula numeric NOT NULL,
    primer_nombre character varying,
    segundo_nombre character varying,
    primer_apellido character varying,
    segundo_apellido character varying,
    direccion character varying,
    telefono numeric,
    estado boolean,
    cargo_id integer
);


--
-- TOC entry 210 (class 1259 OID 32902)
-- Name: funcionario_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.funcionario_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2372 (class 0 OID 0)
-- Dependencies: 210
-- Name: funcionario_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.funcionario_id_seq OWNED BY public.funcionario.id;


--
-- TOC entry 219 (class 1259 OID 32968)
-- Name: miscelaneas; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.miscelaneas (
    id integer NOT NULL,
    data json
);


--
-- TOC entry 218 (class 1259 OID 32966)
-- Name: miscelaneas_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.miscelaneas_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2373 (class 0 OID 0)
-- Dependencies: 218
-- Name: miscelaneas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.miscelaneas_id_seq OWNED BY public.miscelaneas.id;


--
-- TOC entry 216 (class 1259 OID 32953)
-- Name: recontrol_asistencia_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.recontrol_asistencia_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2374 (class 0 OID 0)
-- Dependencies: 216
-- Name: recontrol_asistencia_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.recontrol_asistencia_id_seq OWNED BY public.control_asistencia.id;


--
-- TOC entry 225 (class 1259 OID 33019)
-- Name: registro_asistencia_mensual; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.registro_asistencia_mensual (
    id integer NOT NULL,
    aprobado_coordinador boolean,
    aprobado_rrhh boolean,
    tiempo_ date
);


--
-- TOC entry 224 (class 1259 OID 33017)
-- Name: registro_asistencia_mensual_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.registro_asistencia_mensual_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2375 (class 0 OID 0)
-- Dependencies: 224
-- Name: registro_asistencia_mensual_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.registro_asistencia_mensual_id_seq OWNED BY public.registro_asistencia_mensual.id;


--
-- TOC entry 197 (class 1259 OID 24590)
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 221 (class 1259 OID 32979)
-- Name: usuario; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.usuario (
    id integer NOT NULL,
    primer_nombre character varying,
    primer_apellido character varying,
    cedula numeric,
    estado boolean,
    clave character varying NOT NULL,
    usuario_tipo_id integer,
    departamento_id integer,
    bloqueado boolean
);


--
-- TOC entry 220 (class 1259 OID 32977)
-- Name: usuario_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.usuario_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2376 (class 0 OID 0)
-- Dependencies: 220
-- Name: usuario_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.usuario_id_seq OWNED BY public.usuario.id;


--
-- TOC entry 223 (class 1259 OID 32990)
-- Name: usuario_tipo; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.usuario_tipo (
    id integer NOT NULL,
    nombre character varying
);


--
-- TOC entry 222 (class 1259 OID 32988)
-- Name: usuario_tipo_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.usuario_tipo_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2377 (class 0 OID 0)
-- Dependencies: 222
-- Name: usuario_tipo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.usuario_tipo_id_seq OWNED BY public.usuario_tipo.id;


--
-- TOC entry 2198 (class 2604 OID 32942)
-- Name: cargo id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cargo ALTER COLUMN id SET DEFAULT nextval('public.cargo_id_seq'::regclass);


--
-- TOC entry 2199 (class 2604 OID 32958)
-- Name: control_asistencia id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.control_asistencia ALTER COLUMN id SET DEFAULT nextval('public.recontrol_asistencia_id_seq'::regclass);


--
-- TOC entry 2197 (class 2604 OID 32917)
-- Name: departamento id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.departamento ALTER COLUMN id SET DEFAULT nextval('public.departamento_id_seq'::regclass);


--
-- TOC entry 2196 (class 2604 OID 32907)
-- Name: funcionario id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.funcionario ALTER COLUMN id SET DEFAULT nextval('public.funcionario_id_seq'::regclass);


--
-- TOC entry 2200 (class 2604 OID 32971)
-- Name: miscelaneas id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.miscelaneas ALTER COLUMN id SET DEFAULT nextval('public.miscelaneas_id_seq'::regclass);


--
-- TOC entry 2203 (class 2604 OID 33038)
-- Name: registro_asistencia_mensual id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.registro_asistencia_mensual ALTER COLUMN id SET DEFAULT nextval('public.registro_asistencia_mensual_id_seq'::regclass);


--
-- TOC entry 2201 (class 2604 OID 32982)
-- Name: usuario id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.usuario ALTER COLUMN id SET DEFAULT nextval('public.usuario_id_seq'::regclass);


--
-- TOC entry 2202 (class 2604 OID 32993)
-- Name: usuario_tipo id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.usuario_tipo ALTER COLUMN id SET DEFAULT nextval('public.usuario_tipo_id_seq'::regclass);


--
-- TOC entry 2353 (class 0 OID 32939)
-- Dependencies: 215
-- Data for Name: cargo; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.cargo VALUES (1, 'programador', 1200000, 1);
INSERT INTO public.cargo VALUES (2, 'sws', 22, 1);
INSERT INTO public.cargo VALUES (3, 'inf', 323, 1);


--
-- TOC entry 2355 (class 0 OID 32955)
-- Dependencies: 217
-- Data for Name: control_asistencia; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.control_asistencia VALUES (46, '2020-12-07 17:12:21', NULL, 1, NULL, '2:42', 6);


--
-- TOC entry 2351 (class 0 OID 32914)
-- Dependencies: 213
-- Data for Name: departamento; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.departamento VALUES (2, 'proyecto');
INSERT INTO public.departamento VALUES (1, 'informaticassxx');
INSERT INTO public.departamento VALUES (3, '   sws  sw sxsxs');
INSERT INTO public.departamento VALUES (4, 'xs');
INSERT INTO public.departamento VALUES (5, 'swsw');


--
-- TOC entry 2349 (class 0 OID 32904)
-- Dependencies: 211
-- Data for Name: funcionario; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.funcionario VALUES (2, 1, '2', '', '4', '5', 'opcion-1', 6, NULL, NULL);
INSERT INTO public.funcionario VALUES (3, 1, '2', '', '4', '5', '1', 6, NULL, NULL);
INSERT INTO public.funcionario VALUES (4, 12, '2', '3', '4', '5', '7', 6, false, 1);
INSERT INTO public.funcionario VALUES (5, 1, '1', '1', '1', '1', '1', 1, NULL, 1);
INSERT INTO public.funcionario VALUES (1, 123, 'alei', 'df', 'hr', '1', '2', 23, false, 1);


--
-- TOC entry 2357 (class 0 OID 32968)
-- Dependencies: 219
-- Data for Name: miscelaneas; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.miscelaneas VALUES (1, '{
  "hora_oficial_entrada": "14:30",
  "hora_oficial_salida": "14:00"
}');


--
-- TOC entry 2363 (class 0 OID 33019)
-- Dependencies: 225
-- Data for Name: registro_asistencia_mensual; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.registro_asistencia_mensual VALUES (2, true, NULL, '2020-01-01');
INSERT INTO public.registro_asistencia_mensual VALUES (3, true, NULL, '2020-01-02');
INSERT INTO public.registro_asistencia_mensual VALUES (4, true, NULL, '2020-02-01');
INSERT INTO public.registro_asistencia_mensual VALUES (5, true, NULL, '2020-03-01');
INSERT INTO public.registro_asistencia_mensual VALUES (6, false, false, '2020-12-07');


--
-- TOC entry 2359 (class 0 OID 32979)
-- Dependencies: 221
-- Data for Name: usuario; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.usuario VALUES (2, '1s', '2w', 3, false, '', 1, 1, true);
INSERT INTO public.usuario VALUES (3, '1ss', '2', 358, false, '', 1, 1, false);
INSERT INTO public.usuario VALUES (1, '1sss', '2', 3, false, '', 1, 1, true);
INSERT INTO public.usuario VALUES (5, 'sw', 'ws', 12, false, '2', 1, 1, NULL);
INSERT INTO public.usuario VALUES (6, 'ded', 'dede MOD', 323232323, false, '', 1, 1, true);
INSERT INTO public.usuario VALUES (7, 'aleisei', '22', 222, false, '', 1, 1, true);
INSERT INTO public.usuario VALUES (8, '1w2', 'w2w', 222, false, '222', 1, 2, NULL);
INSERT INTO public.usuario VALUES (9, '1', '2f', 3, false, '', 1, 1, true);
INSERT INTO public.usuario VALUES (10, '1', '1', 1, false, '1', 1, 2, NULL);


--
-- TOC entry 2361 (class 0 OID 32990)
-- Dependencies: 223
-- Data for Name: usuario_tipo; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.usuario_tipo VALUES (1, 'admin');
INSERT INTO public.usuario_tipo VALUES (2, 'asistente');


--
-- TOC entry 2378 (class 0 OID 0)
-- Dependencies: 214
-- Name: cargo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.cargo_id_seq', 3, true);


--
-- TOC entry 2379 (class 0 OID 0)
-- Dependencies: 212
-- Name: departamento_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.departamento_id_seq', 5, true);


--
-- TOC entry 2380 (class 0 OID 0)
-- Dependencies: 210
-- Name: funcionario_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.funcionario_id_seq', 5, true);


--
-- TOC entry 2381 (class 0 OID 0)
-- Dependencies: 218
-- Name: miscelaneas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.miscelaneas_id_seq', 1, true);


--
-- TOC entry 2382 (class 0 OID 0)
-- Dependencies: 216
-- Name: recontrol_asistencia_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.recontrol_asistencia_id_seq', 46, true);


--
-- TOC entry 2383 (class 0 OID 0)
-- Dependencies: 224
-- Name: registro_asistencia_mensual_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.registro_asistencia_mensual_id_seq', 6, true);


--
-- TOC entry 2384 (class 0 OID 0)
-- Dependencies: 197
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.users_id_seq', 1, false);


--
-- TOC entry 2385 (class 0 OID 0)
-- Dependencies: 220
-- Name: usuario_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.usuario_id_seq', 10, true);


--
-- TOC entry 2386 (class 0 OID 0)
-- Dependencies: 222
-- Name: usuario_tipo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.usuario_tipo_id_seq', 2, true);


--
-- TOC entry 2209 (class 2606 OID 32947)
-- Name: cargo cargo_pk; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cargo
    ADD CONSTRAINT cargo_pk PRIMARY KEY (id);


--
-- TOC entry 2207 (class 2606 OID 32924)
-- Name: departamento departamento_pk; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.departamento
    ADD CONSTRAINT departamento_pk PRIMARY KEY (id);


--
-- TOC entry 2205 (class 2606 OID 32922)
-- Name: funcionario funcionario_pk; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.funcionario
    ADD CONSTRAINT funcionario_pk PRIMARY KEY (id);


--
-- TOC entry 2213 (class 2606 OID 32976)
-- Name: miscelaneas miscelaneas_pk; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.miscelaneas
    ADD CONSTRAINT miscelaneas_pk PRIMARY KEY (id);


--
-- TOC entry 2211 (class 2606 OID 32960)
-- Name: control_asistencia recontrol_asistencia_pk; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.control_asistencia
    ADD CONSTRAINT recontrol_asistencia_pk PRIMARY KEY (id);


--
-- TOC entry 2219 (class 2606 OID 33040)
-- Name: registro_asistencia_mensual registro_asistencia_mensual_pk; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.registro_asistencia_mensual
    ADD CONSTRAINT registro_asistencia_mensual_pk PRIMARY KEY (id);


--
-- TOC entry 2215 (class 2606 OID 32987)
-- Name: usuario usuario_pk; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT usuario_pk PRIMARY KEY (id);


--
-- TOC entry 2217 (class 2606 OID 32998)
-- Name: usuario_tipo usuario_tipo_pk; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.usuario_tipo
    ADD CONSTRAINT usuario_tipo_pk PRIMARY KEY (id);


--
-- TOC entry 2221 (class 2606 OID 33004)
-- Name: cargo cargo_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cargo
    ADD CONSTRAINT cargo_fk FOREIGN KEY (departamento_id) REFERENCES public.departamento(id);


--
-- TOC entry 2223 (class 2606 OID 33041)
-- Name: control_asistencia control_asistencia_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.control_asistencia
    ADD CONSTRAINT control_asistencia_fk FOREIGN KEY (registro_asistencia_mensual_id) REFERENCES public.registro_asistencia_mensual(id);


--
-- TOC entry 2220 (class 2606 OID 32948)
-- Name: funcionario funcionario_cargo_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.funcionario
    ADD CONSTRAINT funcionario_cargo_fk FOREIGN KEY (cargo_id) REFERENCES public.cargo(id);


--
-- TOC entry 2222 (class 2606 OID 32961)
-- Name: control_asistencia recontrol_asistencia_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.control_asistencia
    ADD CONSTRAINT recontrol_asistencia_fk FOREIGN KEY (funcionario_id) REFERENCES public.funcionario(id);


--
-- TOC entry 2224 (class 2606 OID 32999)
-- Name: usuario usuario_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT usuario_fk FOREIGN KEY (usuario_tipo_id) REFERENCES public.usuario_tipo(id);


--
-- TOC entry 2225 (class 2606 OID 33012)
-- Name: usuario usuario_fk_dp; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT usuario_fk_dp FOREIGN KEY (departamento_id) REFERENCES public.departamento(id);


-- Completed on 2020-12-07 17:29:44 -04

--
-- PostgreSQL database dump complete
--

