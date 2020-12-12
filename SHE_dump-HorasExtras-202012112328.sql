--
-- PostgreSQL database dump
--

-- Dumped from database version 10.9
-- Dumped by pg_dump version 10.9

-- Started on 2020-12-11 23:28:55 -04

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
-- TOC entry 2385 (class 0 OID 0)
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
-- TOC entry 2386 (class 0 OID 0)
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
-- TOC entry 2387 (class 0 OID 0)
-- Dependencies: 210
-- Name: funcionario_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.funcionario_id_seq OWNED BY public.funcionario.id;


--
-- TOC entry 227 (class 1259 OID 33054)
-- Name: historico_balance; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.historico_balance (
    id integer NOT NULL,
    datos json,
    resgisto_asistencia_mensual integer
);


--
-- TOC entry 226 (class 1259 OID 33052)
-- Name: historico_balance_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.historico_balance_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2388 (class 0 OID 0)
-- Dependencies: 226
-- Name: historico_balance_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.historico_balance_id_seq OWNED BY public.historico_balance.id;


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
-- TOC entry 2389 (class 0 OID 0)
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
-- TOC entry 2390 (class 0 OID 0)
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
    tiempo_ date,
    usuario_id integer
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
-- TOC entry 2391 (class 0 OID 0)
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
    bloqueado boolean DEFAULT false
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
-- TOC entry 2392 (class 0 OID 0)
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
-- TOC entry 2393 (class 0 OID 0)
-- Dependencies: 222
-- Name: usuario_tipo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.usuario_tipo_id_seq OWNED BY public.usuario_tipo.id;


--
-- TOC entry 2205 (class 2604 OID 32942)
-- Name: cargo id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cargo ALTER COLUMN id SET DEFAULT nextval('public.cargo_id_seq'::regclass);


--
-- TOC entry 2206 (class 2604 OID 32958)
-- Name: control_asistencia id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.control_asistencia ALTER COLUMN id SET DEFAULT nextval('public.recontrol_asistencia_id_seq'::regclass);


--
-- TOC entry 2204 (class 2604 OID 32917)
-- Name: departamento id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.departamento ALTER COLUMN id SET DEFAULT nextval('public.departamento_id_seq'::regclass);


--
-- TOC entry 2203 (class 2604 OID 32907)
-- Name: funcionario id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.funcionario ALTER COLUMN id SET DEFAULT nextval('public.funcionario_id_seq'::regclass);


--
-- TOC entry 2212 (class 2604 OID 33057)
-- Name: historico_balance id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.historico_balance ALTER COLUMN id SET DEFAULT nextval('public.historico_balance_id_seq'::regclass);


--
-- TOC entry 2207 (class 2604 OID 32971)
-- Name: miscelaneas id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.miscelaneas ALTER COLUMN id SET DEFAULT nextval('public.miscelaneas_id_seq'::regclass);


--
-- TOC entry 2211 (class 2604 OID 33038)
-- Name: registro_asistencia_mensual id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.registro_asistencia_mensual ALTER COLUMN id SET DEFAULT nextval('public.registro_asistencia_mensual_id_seq'::regclass);


--
-- TOC entry 2208 (class 2604 OID 32982)
-- Name: usuario id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.usuario ALTER COLUMN id SET DEFAULT nextval('public.usuario_id_seq'::regclass);


--
-- TOC entry 2210 (class 2604 OID 32993)
-- Name: usuario_tipo id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.usuario_tipo ALTER COLUMN id SET DEFAULT nextval('public.usuario_tipo_id_seq'::regclass);


--
-- TOC entry 2366 (class 0 OID 32939)
-- Dependencies: 215
-- Data for Name: cargo; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.cargo VALUES (3, 'programador II', 40000000, 1);
INSERT INTO public.cargo VALUES (4, 'asistente', 500000, 5);
INSERT INTO public.cargo VALUES (2, 'programador I', 500, 1);
INSERT INTO public.cargo VALUES (1, 'asistente', 250000, 2);


--
-- TOC entry 2368 (class 0 OID 32955)
-- Dependencies: 217
-- Data for Name: control_asistencia; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.control_asistencia VALUES (48, '2020-12-01 08:00:00', '2020-12-01 17:00:00', 1, '0:0', '0:0', 8);
INSERT INTO public.control_asistencia VALUES (49, '2020-12-02 08:00:00', '2020-12-02 17:30:00', 1, '5:00', '0:0', 8);
INSERT INTO public.control_asistencia VALUES (50, '2020-12-03 08:45:00', '2020-12-03 17:00:00', 1, '0:0', '1:50', 8);
INSERT INTO public.control_asistencia VALUES (58, '2020-12-03 08:45:00', '2020-12-03 17:00:00', 6, '0:0', '1:50', 8);
INSERT INTO public.control_asistencia VALUES (59, '2020-12-04 08:45:00', '2020-12-04 17:00:00', 6, '0:0', '1:50', 8);


--
-- TOC entry 2364 (class 0 OID 32914)
-- Dependencies: 213
-- Data for Name: departamento; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.departamento VALUES (3, 'soporte');
INSERT INTO public.departamento VALUES (4, 'notaria');
INSERT INTO public.departamento VALUES (5, 'rrhh');
INSERT INTO public.departamento VALUES (2, 'proyecto');
INSERT INTO public.departamento VALUES (1, 'informatica mod');


--
-- TOC entry 2362 (class 0 OID 32904)
-- Dependencies: 211
-- Data for Name: funcionario; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.funcionario VALUES (1, 123, 'funcionario test', 'df', 'hr', '1', '2', 23, false, 1);
INSERT INTO public.funcionario VALUES (6, 12344567, 'test', 'test', 'atest', 'test', 'caracas', 123, false, 1);


--
-- TOC entry 2378 (class 0 OID 33054)
-- Dependencies: 227
-- Data for Name: historico_balance; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- TOC entry 2370 (class 0 OID 32968)
-- Dependencies: 219
-- Data for Name: miscelaneas; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.miscelaneas VALUES (1, '{
  "hora_oficial_entrada": "14:30",
  "hora_oficial_salida": "14:00"
}');


--
-- TOC entry 2376 (class 0 OID 33019)
-- Dependencies: 225
-- Data for Name: registro_asistencia_mensual; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.registro_asistencia_mensual VALUES (8, false, false, '2020-12-01', 8);


--
-- TOC entry 2372 (class 0 OID 32979)
-- Dependencies: 221
-- Data for Name: usuario; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.usuario VALUES (2, '1s', '2w', 3, false, '', 1, 1, true);
INSERT INTO public.usuario VALUES (1, '1sss', '2', 3, false, '', 1, 1, true);
INSERT INTO public.usuario VALUES (6, 'ded', 'dede MOD', 323232323, false, '', 1, 1, true);
INSERT INTO public.usuario VALUES (9, '1', '2f', 3, false, '', 1, 1, true);
INSERT INTO public.usuario VALUES (11, 'maria josefina', 'hernandez', 25, false, '', 1, 1, true);
INSERT INTO public.usuario VALUES (3, '1ss', '2', 358, false, '', 1, 1, false);
INSERT INTO public.usuario VALUES (10, 'admin', 'admin', 55, false, '1', 3, 2, false);
INSERT INTO public.usuario VALUES (8, 'admin', 'w2w', 222, false, '222', 1, 2, false);
INSERT INTO public.usuario VALUES (12, 'a', 'b', 1, false, '2', 1, 2, false);
INSERT INTO public.usuario VALUES (13, 's', 'b', 1, false, '2', 1, 1, true);
INSERT INTO public.usuario VALUES (5, 'sw', 'ws', 24812469, false, '', 1, 1, false);
INSERT INTO public.usuario VALUES (7, 'test user', '22', 222, false, '', 1, 1, true);
INSERT INTO public.usuario VALUES (14, 'usuario test mo', 'test', 1234, false, '', 1, 3, false);


--
-- TOC entry 2374 (class 0 OID 32990)
-- Dependencies: 223
-- Data for Name: usuario_tipo; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.usuario_tipo VALUES (1, 'admin');
INSERT INTO public.usuario_tipo VALUES (2, 'asistente');
INSERT INTO public.usuario_tipo VALUES (3, 'coordinador');


--
-- TOC entry 2394 (class 0 OID 0)
-- Dependencies: 214
-- Name: cargo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.cargo_id_seq', 4, true);


--
-- TOC entry 2395 (class 0 OID 0)
-- Dependencies: 212
-- Name: departamento_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.departamento_id_seq', 5, true);


--
-- TOC entry 2396 (class 0 OID 0)
-- Dependencies: 210
-- Name: funcionario_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.funcionario_id_seq', 6, true);


--
-- TOC entry 2397 (class 0 OID 0)
-- Dependencies: 226
-- Name: historico_balance_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.historico_balance_id_seq', 1, false);


--
-- TOC entry 2398 (class 0 OID 0)
-- Dependencies: 218
-- Name: miscelaneas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.miscelaneas_id_seq', 1, true);


--
-- TOC entry 2399 (class 0 OID 0)
-- Dependencies: 216
-- Name: recontrol_asistencia_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.recontrol_asistencia_id_seq', 59, true);


--
-- TOC entry 2400 (class 0 OID 0)
-- Dependencies: 224
-- Name: registro_asistencia_mensual_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.registro_asistencia_mensual_id_seq', 8, true);


--
-- TOC entry 2401 (class 0 OID 0)
-- Dependencies: 197
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.users_id_seq', 1, false);


--
-- TOC entry 2402 (class 0 OID 0)
-- Dependencies: 220
-- Name: usuario_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.usuario_id_seq', 14, true);


--
-- TOC entry 2403 (class 0 OID 0)
-- Dependencies: 222
-- Name: usuario_tipo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.usuario_tipo_id_seq', 3, true);


--
-- TOC entry 2218 (class 2606 OID 32947)
-- Name: cargo cargo_pk; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cargo
    ADD CONSTRAINT cargo_pk PRIMARY KEY (id);


--
-- TOC entry 2216 (class 2606 OID 32924)
-- Name: departamento departamento_pk; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.departamento
    ADD CONSTRAINT departamento_pk PRIMARY KEY (id);


--
-- TOC entry 2214 (class 2606 OID 32922)
-- Name: funcionario funcionario_pk; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.funcionario
    ADD CONSTRAINT funcionario_pk PRIMARY KEY (id);


--
-- TOC entry 2230 (class 2606 OID 33062)
-- Name: historico_balance historico_balance_pk; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.historico_balance
    ADD CONSTRAINT historico_balance_pk PRIMARY KEY (id);


--
-- TOC entry 2222 (class 2606 OID 32976)
-- Name: miscelaneas miscelaneas_pk; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.miscelaneas
    ADD CONSTRAINT miscelaneas_pk PRIMARY KEY (id);


--
-- TOC entry 2220 (class 2606 OID 32960)
-- Name: control_asistencia recontrol_asistencia_pk; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.control_asistencia
    ADD CONSTRAINT recontrol_asistencia_pk PRIMARY KEY (id);


--
-- TOC entry 2228 (class 2606 OID 33040)
-- Name: registro_asistencia_mensual registro_asistencia_mensual_pk; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.registro_asistencia_mensual
    ADD CONSTRAINT registro_asistencia_mensual_pk PRIMARY KEY (id);


--
-- TOC entry 2224 (class 2606 OID 32987)
-- Name: usuario usuario_pk; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT usuario_pk PRIMARY KEY (id);


--
-- TOC entry 2226 (class 2606 OID 32998)
-- Name: usuario_tipo usuario_tipo_pk; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.usuario_tipo
    ADD CONSTRAINT usuario_tipo_pk PRIMARY KEY (id);


--
-- TOC entry 2232 (class 2606 OID 33004)
-- Name: cargo cargo_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cargo
    ADD CONSTRAINT cargo_fk FOREIGN KEY (departamento_id) REFERENCES public.departamento(id);


--
-- TOC entry 2234 (class 2606 OID 33041)
-- Name: control_asistencia control_asistencia_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.control_asistencia
    ADD CONSTRAINT control_asistencia_fk FOREIGN KEY (registro_asistencia_mensual_id) REFERENCES public.registro_asistencia_mensual(id);


--
-- TOC entry 2231 (class 2606 OID 32948)
-- Name: funcionario funcionario_cargo_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.funcionario
    ADD CONSTRAINT funcionario_cargo_fk FOREIGN KEY (cargo_id) REFERENCES public.cargo(id);


--
-- TOC entry 2238 (class 2606 OID 33063)
-- Name: historico_balance historico_balance_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.historico_balance
    ADD CONSTRAINT historico_balance_fk FOREIGN KEY (resgisto_asistencia_mensual) REFERENCES public.registro_asistencia_mensual(id);


--
-- TOC entry 2233 (class 2606 OID 32961)
-- Name: control_asistencia recontrol_asistencia_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.control_asistencia
    ADD CONSTRAINT recontrol_asistencia_fk FOREIGN KEY (funcionario_id) REFERENCES public.funcionario(id);


--
-- TOC entry 2237 (class 2606 OID 33047)
-- Name: registro_asistencia_mensual registro_asistencia_mensual_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.registro_asistencia_mensual
    ADD CONSTRAINT registro_asistencia_mensual_fk FOREIGN KEY (usuario_id) REFERENCES public.usuario(id);


--
-- TOC entry 2235 (class 2606 OID 32999)
-- Name: usuario usuario_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT usuario_fk FOREIGN KEY (usuario_tipo_id) REFERENCES public.usuario_tipo(id);


--
-- TOC entry 2236 (class 2606 OID 33012)
-- Name: usuario usuario_fk_dp; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT usuario_fk_dp FOREIGN KEY (departamento_id) REFERENCES public.departamento(id);


-- Completed on 2020-12-11 23:28:56 -04

--
-- PostgreSQL database dump complete
--

