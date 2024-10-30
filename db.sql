--
-- PostgreSQL database dump
--

-- Dumped from database version 16.4 (Ubuntu 16.4-0ubuntu0.24.04.2)
-- Dumped by pg_dump version 16.4 (Ubuntu 16.4-0ubuntu0.24.04.2)

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
-- Name: currency_type; Type: TYPE; Schema: public; Owner: postgres
--

CREATE TYPE public.currency_type AS ENUM (
    'RUB',
    'USD',
    'BONUS'
);


ALTER TYPE public.currency_type OWNER TO postgres;

--
-- Name: user_type; Type: TYPE; Schema: public; Owner: postgres
--

CREATE TYPE public.user_type AS ENUM (
    'юр',
    'физ'
);


ALTER TYPE public.user_type OWNER TO postgres;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: bonus_company_coefs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.bonus_company_coefs (
    id character varying(16),
    coef real
);


ALTER TABLE public.bonus_company_coefs OWNER TO postgres;

--
-- Name: transaction; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.transaction (
    id character varying(16),
    senderid character varying(16),
    recipientid character varying(16),
    currencytype public.currency_type,
    value real
);


ALTER TABLE public.transaction OWNER TO postgres;

--
-- Name: userbalance; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.userbalance (
    id character varying(16),
    value real,
    balancetype public.currency_type
);


ALTER TABLE public.userbalance OWNER TO postgres;

--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id character varying(16) NOT NULL,
    login character varying(64),
    password character varying(64),
    usertype public.user_type
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Data for Name: bonus_company_coefs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.bonus_company_coefs (id, coef) FROM stdin;
\.


--
-- Data for Name: transaction; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.transaction (id, senderid, recipientid, currencytype, value) FROM stdin;
\.


--
-- Data for Name: userbalance; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.userbalance (id, value, balancetype) FROM stdin;
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (id, login, password, usertype) FROM stdin;
\.


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: userbalance users_balance_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.userbalance
    ADD CONSTRAINT users_balance_fk FOREIGN KEY (id) REFERENCES public.users(id);


--
-- Name: bonus_company_coefs users_company_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.bonus_company_coefs
    ADD CONSTRAINT users_company_fk FOREIGN KEY (id) REFERENCES public.users(id);


--
-- Name: transaction users_recipient_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.transaction
    ADD CONSTRAINT users_recipient_fk FOREIGN KEY (recipientid) REFERENCES public.users(id);


--
-- Name: transaction users_sender_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.transaction
    ADD CONSTRAINT users_sender_fk FOREIGN KEY (senderid) REFERENCES public.users(id);


--
-- Name: transaction users_transaction_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.transaction
    ADD CONSTRAINT users_transaction_fk FOREIGN KEY (id) REFERENCES public.users(id);


--
-- PostgreSQL database dump complete
--

