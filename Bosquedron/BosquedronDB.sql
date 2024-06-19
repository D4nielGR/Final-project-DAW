--
-- PostgreSQL database dump
--

-- Dumped from database version 16.3
-- Dumped by pg_dump version 16.2

-- Started on 2024-06-19 02:48:37

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

SET default_table_access_method = heap;

--
-- TOC entry 215 (class 1259 OID 16399)
-- Name: doctrine_migration_versions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.doctrine_migration_versions (
    version character varying(191) NOT NULL,
    executed_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    execution_time integer
);


ALTER TABLE public.doctrine_migration_versions OWNER TO postgres;

--
-- TOC entry 217 (class 1259 OID 16406)
-- Name: natural_parks; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.natural_parks (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    photo character varying(255) NOT NULL,
    location character varying(255) DEFAULT NULL::character varying NOT NULL,
    phone character varying(255) DEFAULT NULL::character varying NOT NULL,
    email character varying(255) DEFAULT NULL::character varying NOT NULL,
    website character varying(255) DEFAULT NULL::character varying NOT NULL,
    presentation character varying(4000) DEFAULT NULL::character varying NOT NULL,
    opening_times character varying(255) DEFAULT NULL::character varying NOT NULL,
    entry_fee numeric(10,2) DEFAULT NULL::numeric NOT NULL,
    declared_in character varying(255) DEFAULT NULL::character varying NOT NULL
);


ALTER TABLE public.natural_parks OWNER TO postgres;

--
-- TOC entry 216 (class 1259 OID 16405)
-- Name: natural_parks_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.natural_parks_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.natural_parks_id_seq OWNER TO postgres;

--
-- TOC entry 221 (class 1259 OID 32779)
-- Name: review; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.review (
    id integer NOT NULL,
    user_id integer NOT NULL,
    valoration integer NOT NULL,
    review_text character varying(255) DEFAULT NULL::character varying,
    park_id integer NOT NULL,
    review_date timestamp(0) without time zone DEFAULT NULL::timestamp without time zone NOT NULL
);


ALTER TABLE public.review OWNER TO postgres;

--
-- TOC entry 220 (class 1259 OID 32778)
-- Name: review_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.review_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.review_id_seq OWNER TO postgres;

--
-- TOC entry 219 (class 1259 OID 32769)
-- Name: user; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."user" (
    id integer NOT NULL,
    email character varying(180) NOT NULL,
    roles json NOT NULL,
    password character varying(255) NOT NULL,
    username character varying(255) NOT NULL,
    userphoto character varying(255) DEFAULT NULL::character varying
);


ALTER TABLE public."user" OWNER TO postgres;

--
-- TOC entry 218 (class 1259 OID 32768)
-- Name: user_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.user_id_seq OWNER TO postgres;

--
-- TOC entry 4812 (class 0 OID 16399)
-- Dependencies: 215
-- Data for Name: doctrine_migration_versions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.doctrine_migration_versions (version, executed_at, execution_time) FROM stdin;
DoctrineMigrations\\Version20240516182805	2024-05-16 20:28:35	11
DoctrineMigrations\\Version20240522213939	2024-05-22 23:40:23	9
DoctrineMigrations\\Version20240522224645	2024-05-23 00:46:57	12
DoctrineMigrations\\Version20240528233259	2024-05-29 01:33:17	62
DoctrineMigrations\\Version20240531155744	2024-05-31 17:58:15	7
DoctrineMigrations\\Version20240531215212	2024-05-31 23:52:48	65
DoctrineMigrations\\Version20240531230518	2024-06-01 01:05:22	4
DoctrineMigrations\\Version20240611005946	2024-06-11 03:00:40	34
DoctrineMigrations\\Version20240611010628	2024-06-11 03:06:47	34
DoctrineMigrations\\Version20240611011220	2024-06-11 03:12:23	6
DoctrineMigrations\\Version20240611022232	2024-06-11 04:22:44	7
\.


--
-- TOC entry 4814 (class 0 OID 16406)
-- Dependencies: 217
-- Data for Name: natural_parks; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.natural_parks (id, name, photo, location, phone, email, website, presentation, opening_times, entry_fee, declared_in) FROM stdin;
3	Cabo de Gata-Níjar	2024-05-22-24c7cf346e41a60202eaedf5d8eaefb0b01cdbbf.jpg	Andalucía, en el extremo sureste de la provincia de Almería	950 380 299	pn.cabodegata.cmaot@juntadeandalucia.es	https://www.cabodegata-nijar.com/	En esta comarca se localiza el Parque Natural de Cabo de Gata-Níjar, primer parque marítimo terrestre de Andalucía; impresionantes acantilados, pequeñas y recónditas calas, doradas playas de fina arena y fondos marinos de increible belleza, ideales para la práctica del submarinismo.\r\n\r\nPero además, en la localidad de Níjar podrás visitar su iglesia mudéjar, antigua mezquita y pasear por sus estrechas y blancas callejuelas de trazado árabe.\r\n\r\nMerecen un recorrido el poblado minero de Rodalquilar y las instalaciones industriales de Agua Amarga, así como las playas de los Genoveses y el Mónsul, en San José.\r\n\r\nEn la zona más oriental del Parque, los municipios de Cuevas del Almanzora, Garrucha, Mojácar, Vera y Carboneras son tambien visita obligada.\r\n\r\nDescubre aquí todos los atractivos que te ofrecen los municipios de la comarca del Cabo de Gata y Níjar.	9:00-19:00	0.00	1997
2	Teide	2024-05-23-ce751dd8abad5ce0ced37f1d6a763c671b6fc8d9.jpg	Calle Doctor Sixto Perera Gonzalez, 25, 38300 La Orotava, Santa Cruz de Tenerife	922 92 23 71	teide.maot@gobiernodecanarias.org	https://www.tenerife.es/portalcabtfe/en/discover-tenerife/que-ver/parque-nacional-del-teide	Es sin duda el lugar que más identifica a Tenerife. El Parque Nacional del Teide fue declarado Patrimonio Mundial de la Humanidad por la Unesco en 2007 con la categoría de Bien Natural. Es también Diploma Europeo por el Consejo de Europa y forma parte de los Lugares Red Natura 2000. Y razones para recibir tales reconocimientos no le faltan. Por un lado, es la más completa muestra de vegetación de piso supramediterráneo que existe. Por otro, constituye una de las manifestaciones más espectaculares de vulcanismo en todo el mundo, y por supuesto, la más destacada de Canarias.  El P.N. del Teide está situado en el centro de la isla, a una altitud media de 2.000 metros, y su cima representa el pico más alto de España, con 3.718 metros. Sus cifras de récord también incluyen que es el parque nacional más visitado de España y Europa, al recibir unos tres millones de turistas al año.  Desde el punto de vista geomorfológico estamos ante una maravilla de la naturaleza. La estructura de la caldera y el estratovolcán Teide-Pico-Viejo son únicos en el planeta. Aunque no queda ahí su valor. Los cientos de conos, coladas o cuevas con las que cuenta enriquecen su interés científico y paisajístico. A ello se añaden su riqueza de fauna y flora, con una gran cantidad de endemismos canarios y especies exclusivas del parque.  El parque se creó en 1954 en reconocimiento a su singularidad volcánica y biológica. Su extensión es de casi 19.000 hectáreas, lo que lo convierte en el mayor y más antiguo de entre todos los parques nacionales de las Islas Canarias. Cuenta con una Zona Periférica de Protección, y está rodeado del Parque Natural de la Corona Forestal, que con 46.612,9 hectáreas de extensión, es el espacio natural protegido de mayor extensión de toda la Comunidad Autónoma de Canarias.	Lunes a Viernes: 9:00-14:00, 15:30-18:00	41.00	1954
1	Doñana	2024-05-23-60a89417533ea75da90c4d4be954110b79ed88e4.jpg	Extremo sureste de la provincia de Huelva, suroeste de la de Sevilla y noroeste de la de Cádiz	959 430 432	en.donana.cma@juntadeandalucia.es	https://www.donanareservas.com/	El Parque Nacional de Doñana, declarado en 1969, es uno de los espacios protegidos más importantes del territorio andaluz y la mayor reserva ecológica de Europa. Con 54.251 hectáreas de extensión, está situado en el suroeste de la comunidad autónoma, en las provincias de Huelva y Sevilla.  Los ecosistemas acuáticos y terrestres le confieren unas características específicas para albergar una biodiversidad única, destacando algunas especies tan emblemáticas como el lince ibérico y el águila imperial, ambas en peligro de extinción. La marisma es lugar de paso, cría e invernada para miles de aves europeas y africanas, lo que la convierte en un ecosistema de altísimo valor ecológico.  En 1994, tras la evaluación del estado y proyección a futuros del Parque Nacional de Doñana, UNESCO procede a inscribirlo en la lista de Patrimonio Mundial; y meses después, en 1995, el Consejo de Europa le reconoce tal riqueza que le concede el Diploma Europeo para Áreas Protegidas, dada la conservación, planificación y gestión integrada de sus recursos naturales.   Doñana es, a su vez, Zona Especial de Conservación (ZEC ES0000024) desde 2012, asi como Zona de Especial Protección para las Aves (ZEPA ES0000024) y, en consecuencia, espacio protegido Red Natura 2000. También recaen sobre este territorio las figuras de Reserva de la Biosfera (1980) y Sitio Ramsar (1982). Colinda con el Parque Natural Doñana, formando, desde el año 2007, la figura de gestión Espacio Natural de Doñana. Además, está adherido a la Carta Europea de Turismo Sostenible (CETS).  El Parque Nacional de Doñana está integrado en la Red de Parques Nacionales y, desde el 1 de julio de 2006, su gestión corresponde en exclusiva a la comunidad autónoma de Andalucía.  Por último, está incluido en la Lista Verde de Áreas Protegidas y Conservadas de la UICN, junto con Sierra Nevada, siendo los dos únicos españoles que forman parte de este estándar que busca ser sinónimo de éxito en la gestión de estos espacios.	Lunes a Domingo: 24 horas	33.50	1994
10	Natural del Estrecho	2024-06-11-be0cb8eb2ccf11c657b33ee380a56b6c490ef86b.jpg	Se encuentra en el extremo sur de la península ibérica y protege el espacio marítimo-terrestre del litoral desde la ensenada de Getares hasta el Cabo de Gracia.	600 16 18 85	pn.delestrecho.cma@juntadeandalucia.es	https://www.cadizturismo.com/naturaleza/espacios-naturales/del-estrecho	Este parque natural marítimo-terrestre, situado entre el Atlántico y el Mediterráneo, alberga una gran riqueza natural de gran singularidad. Marcado por las duras condiciones climáticas de la zona y el paso de civilizaciones desde tiempos remotos, cobija una flora y fauna muy adaptadas y fruto de la convergencia de áreas naturales muy distintas. Esta diversidad se refleja en un importante recurso, el paisaje, encontrándose acantilados y plataformas de abrasión a un lado de Tarifa y playas arenosas por el otro; en el extremo oeste del parque, desde Faro Camarinal se disfruta de preciosas vistas del mar y del litoral; tierra adentro, desde la Silla del Papa, se contemplan la campiña de la Janda y las sierras del sur de Cádiz.\r\nLos vientos de levante y poniente juegan un papel fundamental en la esencia de este espacio: han configurado el terreno, definido las rutas migratorias de las aves y construido dunas. El hombre ha sabido aprovechar su fuerza para generar energía limpia y practicar deportes como el surf en todas sus variantes. En Tarifa, internacionalmente conocida por windsurf, el viento ha conseguido, entre otros aspectos, frenar el urbanismo de sol y playa de la década de los 70.\r\nEl visitante disfrutará de bellas playas como la de Los Lances, amparada bajo la figura de protección de Paraje Natural Playa de Los Lances, o la de Bolonia, cuya famosa duna ha sido declarada Monumento Natural Duna de Bolonia. En estos arenales costeros crecen plantas adaptadas a la sequedad y el viento como el barrón, el enebro y la típica camarina, que da nombre al faro de la zona. Alrededor existen pinos piñoneros, procedentes de la repoblación practicada en los años 60 del siglo pasado para contener las dunas, junto con un matorral de alto valor ecológico. Adentrándose en la sierra aparecen encinas, alcornoques y acebuches junto con eucaliptos de repoblación. En los acantilados destacan los hinojos marinos y por doquier narcisos y genistas.\r\nPero las protagonistas del parque son, sin duda, las aves. Entre las residentes, las de mayor presencia son la cigüeña blanca, el halcón abejero, el milano negro y el buitre leonado. También es posible avistar águilas imperiales, elanios azules, alimoches, águilas perdiceras e incluso halcones peregrinos. Esta riqueza ornitológica se multiplica con el paso de las aves migratorias, un espectáculo del que se puede disfrutar en la red de observatorios del parque en distintas épocas del año.\r\nLas aguas del Estrecho albergan valores naturales muy importantes, por lo que en esta zona aún se producen descubrimientos de nuevas especies para la ciencia. Se han contabilizado más de 1.900 especies de flora y fauna marina, siendo las más frecuentes e importantes la tortuga boba, el delfín o la marsopa. En este lugar, ideal para el buceo, se disfruta de extensas praderas de algas, indicadores de la calidad ambiental del agua, destacando por su porte espectacular las laminarias. Para los interesados en el medio marino, existen paseos en barco desde Tarifa o Algeciras en los que se puede disfrutar de avistamientos de cetáceos.\r\nEl patrimonio cultural es otro reclamo más del parque; de los numerosos restos arqueológicos, sobresale la antigua ciudad romana de Baelo Claudia, enclave estratégico para la industria salazonera de la Bética. Además, el legado arqueológico del Estrecho no se limita a la superficie terrestre, sino que el patrimonio submarino ocupa un importante lugar, resultando llamativa la cantidad de restos de naufragios. Destaca asimismo como foco de patrimonio inmueble el centro urbano de Tarifa, que cuenta con la categoría de Conjunto Histórico.	Martes a Sabado: 9:00-22:00	14.00	1970
13	Sierra de Grazalema	2024-06-12-b3e7b39fe47f3485249490eddb264a3b60411907.jpg	Provincias de Cádiz y Málaga	956 70 97 33	pn.grazalema.cmaot@juntadeandalucia.es	https://www.andalucia.org/es/espacios-naturales-sierra-de-grazalema	La Sierra de Grazalema se eleva inexpugnable frente a las aguas del Mediterráneo, a modo de gigantesca muralla salpicada de pequeños pueblos blancos. Es por ello que recibe con agradecimiento las generosas borrascas que llegan desde el Atlántico, temporales que hacen de este macizo el lugar más lluvioso de toda la Península Ibérica.\r\n\r\nSituadas en la zona más occidental de los macizos béticos, a medio camino entre las provincias de Cádiz y Málaga, estas sierras han sido talladas al antojo de las lluvias dando lugar a una de las sierras más abruptas de la geografía andaluza. De tal modo, da cobijo a una de las cavidades más extensas de Andalucía, el sistema Hundidero-Gato, con casi 8 kilómetros de galerías y más de 200 metros de desnivel. Pero alberga también otros hitos topográficos de interés, como la Sierra del Endrinal, un karst elevado que presenta vistosos lapiaces activos que alternan con anchos llanos, y espectaculares dolinas y poljés, como los presentes en Líbar y los de los Llanos del Republicano. De la misma manera, también acoge sierras con magníficas panorámicas, como las del Caíllo y Ubrique, que dan lugar a asombrosos escarpes, profundos desfiladeros -Salto del Cabrero y El Saltadero- e imponentes cañones de paredes verticales que llegan a alcanzar los 400 metros de profundidad -Garganta Seca y Garganta Verde.\r\n\r\nFauna y flora\r\nDominan los bosques de encina y una cohorte de lentiscos, majuelos y aulagas, dejando lugar en la umbría a quejigos de excelente porte. En los suelos de arenisca, la encina da paso al alcornoque y a un sotobosque formado por diversas especies de brezos y jaras, así como arrayanes y helechos. Pero el protagonista botánico de estas sierras lo tiene el pinsapo, un abeto aferrado a eras pasadas solo presente en las cotas más altas de las sierras de Cádiz, Málaga y el Rif Marroquí. Se localizan bosquetes dispersos por la Sierra del Pinar, las sierras de Zafalgar, Endrinal y Margarita. También destaca su variedad florística, pues no en vano podemos contabilizar más de 1.300 especies, de ellas casi medio centenar endemismos ibéricos y siete de ellas exclusivas de este espacio natural, como es el caso de la amapola de Grazalema o el geranio llamado relojillo de recoder. En lo que respecta a la fauna, los mamíferos son numerosos, como ponen de manifiesto cabra montés, nutria, meloncillo, garduña, gineta o tejones. Pero la especie representativa viene condicionado por el gran número de grutas existentes, que dan cobijo a singulares colonias de murciélago: herradura y cueva. La profusión de roquedos favorece también la existencia de numerosas comunidades de aves rupícolas, como buitre leonado, alimoche o águila-azor perdicera.\r\nEspacios Naturales\r\nParque Natural\r\nCompartir en	Juaves a Domingo: 10-14 y 16-18	0.00	1977
11	Sierra de Aracena y Picos de Aroche	2024-06-12-a222f29cd247f701ef4c126ba28cfb8b0e358635.png	Provincia de Huelva	959 12 50 00	pn.aracena.picos.aroche.cmaot@juntadeandalucia.es	http://www.juntadeandalucia.es/medioambiente/portal/web/guest/ventana-del-visitante/-/equipamiento/detalle/6358	La Sierra de Aracena y Picos de Aroche ocupa la zona occidental de Sierra Morena donde, batida por los vientos húmedos del Atlántico, da cobijo a blancos pueblos de calles empedradas que se derraman entre amplias dehesas de encinas y alcornoques, olivares ecológicos, huertas y castaños.\r\n\r\nLa pizarra que la compone da a esta sierra un carácter alomado, de pendientes suaves, donde grandes valles adehesados alternan con cimas coronadas por bosques cerrados y barrancos encajados, casi mágicos, por los que discurren los principales ejes fluviales: Ribera del Chanza, Múrtigas y Ribera de Huelva. En las cotas más elevadas, donde la caliza toma protagonismo, aparecen las formas geológicas más singulares, como la Gruta de las Maravillas en Aracena, o los travertinos de Alájar y Zufre, vinculados a surgencias de agua. También está presente el granito, como así ocurre en el batolito de las Peñas de Aroche, que acoge los ricos filones metálicos que han condicionado la intensa actividad minera de la comarca: Minas de Cala o el Coto Minero de Teuler.\r\n\r\nFauna y flora\r\nEncina y alcornoque dominan un bosque adehesado que, allí donde se cierra, viene acompañado de un sotobosque formado por madroños, lavanda, lentisco, majuelos y distintas especies de jara y enebro. A mayor altitud, la humedad permite la presencia de quejigos y rebollos dando lugar a una imagen más propia de la España verde septentrional. En la zona central del parque natural, de dominios calizos, el castaño los releva formando uno de las mayores masas boscosas de toda la Península. El buen estado de los montes permite la presencia de una importante comunidad de aves rapaces, pues no en vano posee la mayor colonia nidificante de buitre negro de Europa, que está presente en Sierra Pelada y Rivera del Aserrador. También tienen una buena representación las aves forestales y los mamíferos -gineta, ciervo, jabalí-. La Rivera del Múrtigas, el arroyo del Sillo o en la rivera de Montemayor son buenos ejemplos de los excepcionales bosques galería que esta sierra cobija, donde una espléndida arboleda permite la existencia de anfibios, aves y una comunidad excepcional de peces continentales: barbos comiza y cabecicorto, jarabugo, boga del Guadiana, pardilla y calandino. No pueden pasar desapercibidas las poblaciones de hongos y setas, siendo la tana y el gurumelo dos de sus más afamados representantes.	Lunes a Viernes: 9:00-14:00	0.00	1989
12	Sierras de Cazorla, Segura y Las Villas	2024-06-12-dd2a49f929a7250e6f5f706f4d4a676c226292ad.jpg	Provincia de Jaén	953 72 02 00	pn.cazorla.segura.villas.cmaot@juntadeandalucia.es	https://www.jaenparaisointerior.es/es/parque-natural/inicio	El parque natural de las Sierras de Cazorla, Segura y Las Villas es un espacio natural situado en el noreste de la provincia de Jaén, Andalucía (España) y cuenta con una extensión de 214 336 ha, se trata del mayor espacio protegido de España y el segundo de Europa. Está declarado como Reserva de la Biosfera por la Unesco desde 1983, como parque natural desde 1986 así como también Zona de Especial Protección para las Aves (ZEPA) desde 1988.\r\n\r\nToda su belleza paisajística y riqueza biológica se unen al patrimonio cultural que existe en la zona, haciendo de su entorno una de las zonas naturales más visitadas de toda España. Dada su gran extensión, abarca 23 municipios con una población de aproximadamente 80 000 habitantes y por tanto el grado de protección varía de unas zonas a otras, permitiéndose en la mayoría del territorio la coexistencia con actividades económicas diversas.\r\n\r\nGeografía\r\nOrografía\r\nEstas sierras se encuentran integradas en el sistema Prebético, uniéndose con Sierra Morena en su parte más noroccidental. El parque natural cuenta con una altura que varía desde los 500 m s. n. m. al sur del límite, en el río Guadiana Menor, y los 2107 m s. n. m. del Cerro las Empanadas. En la estructura de su relieve podemos distinguir algunos calares que limitan profundos cañones que, de forma general, siguen una orientación de suroeste a noreste; una alineación montañosa externa que va de Villarrodrigo hasta el Pantano del Tranco, delimitando los valles del Guadalimar y el río Hornos; el Yelmo (1809 m s. n. m.), los calares de la Nava del Espino (1722 m s. n. m.) y muchos otros de los términos de la Comarca de Sierra de Segura; el calar del Cobo (Puntal de la Misa, (1796 m s. n. m.), que vigila el cañón del Segura y el embalse de Anchuricas, al igual que los calares del término municipal de Santiago-Pontones y la Sierra de Almorchón (1914 m s. n. m.).\r\n\r\nMás al Sur se disponen externamente la sierra de Las Villas (Blanquillo o Pedro Miguel, (1831 m s. n. m.), Los Hermanillos (1787 m s. n. m.), Caballo Torraso (1726 m s. n. m.), Hoyacillo (1719 m s. n. m.), Peña Corva (1560 m s. n. m.), Cerro Avellano (1550 m s. n. m.)); y la sierra de Cazorla (Gilillo (1848 m s. n. m.), Cerro de La Laguna (1662 m), Los Castellones (1653 m s. n. m.), Peña de Los Halcones (1448 m s. n. m.); en la vertiente occidental del gran valle del Alto Guadalquivir, limitado a oriente por la Sierra del Pozo (Pico Cabañas del término municipal de Quesada (2027 m s. n. m.), Puntal del Buitre (2007 m s. n. m.), Pico del Águila (1985 m s. n. m.), Calar de Juana (1887 m s. n. m.), y la principal alineación de la sierra de Segura, que culmina con el pico de Las Banderillas (1993 m s. n. m.), la cumbre más alta de la Sierra de Segura. Al este de esta sierra se eleva un singular altiplano conocido como los Campos de Hernán Perea o Pelea, el altiplano más extenso de España con más de 5000 hectáreas y una altitud media de 1600 m s. n. m., limitado por calares desprovistos de vegetación, como el Calar de las Palomas (1964 m s. n. m.) Calar de las Chaparras (1897 m s. n. m.) y Pinar Negro (1815 m s. n. m.).	Martes a Domingo: 10-13:30 y 16:00-19:00	0.00	1986
14	Caldera de Taburiente	2024-06-12-96df0de93a63ff28f5c2d93156075d85a4a0cbd5.jpg	Andalucia	615461	parque@gmail.com	https://www.tenerife.es/portalcabtfe/en/discover-tenerife/que-ver/parque-nacional-del-teide	El Parque Nacional de la Caldera de Taburiente, se caracteriza por ser un enorme circo de 8 km de diámetro con aspecto de caldera, donde múltiples erupciones volcánicas, grandes deslizamientos, la fuerza erosiva del agua y el tiempo han ido modelando su geomorfología, convirtiéndola en un escarpado paisaje con casi 2.000 m de desnivel. El paisaje de La Caldera de Taburiente está dominado por un circo de cumbre de 8 km de diámetro con desniveles de hasta 2.000 m, con una red de arroyos y torrentes espectacular y de gran fuerza erosiva. En este medio se han desarrollado una gran variedad de especies vegetales y animales, que incluyen un gran número de endemismos canarios.	Lunes a Viernes: 9:00-14:00, 15:30-18:00	0.00	1954
\.


--
-- TOC entry 4818 (class 0 OID 32779)
-- Dependencies: 221
-- Data for Name: review; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.review (id, user_id, valoration, review_text, park_id, review_date) FROM stdin;
1	23	5	Bonito bosque	1	2024-06-06 00:00:00
2	23	4	Buena ubicación, pero muy poco ambientado	2	2024-06-07 00:00:00
3	24	1	No me gustan los árboles\n	2	2024-06-08 00:00:00
4	24	2	Aburrido	3	2024-06-09 00:00:00
5	25	1	\N	2	2024-06-10 00:00:00
6	25	1	\N	2	2024-06-11 00:00:00
7	25	4	\N	2	2024-06-11 03:26:40
9	25	5		2	2024-06-11 03:40:22
10	25	1	Que feo es	1	2024-06-11 03:45:58
11	25	5		1	2024-06-11 03:56:06
13	25	4		1	2024-06-11 04:02:09
14	25	3	Holi	1	2024-06-11 04:08:08
16	25	5	El mejor parque de mi vida	3	2024-06-11 04:11:23
19	0	5		2	2024-06-11 17:03:28
20	0	5		2	2024-06-11 17:03:33
21	0	5		2	2024-06-11 17:03:38
22	0	5		2	2024-06-11 17:03:43
23	0	4	Mu bonico el parquesito	3	2024-06-11 20:26:20
8	25	1	No me gusta nada	2	2024-06-11 03:39:58
12	25	3	Ta guapa la cosa	1	2024-06-11 03:56:31
15	25	5	 	1	2024-06-11 04:08:25
17	26	1	No vuelvo más nunca	10	2024-06-11 04:59:21
24	31	4	Me gusta el parque, pero los hay mejores.	3	2024-06-12 02:27:03
25	31	1	No me gusta	12	2024-06-12 02:27:44
26	32	5	A mi si me gusta	12	2024-06-12 02:29:06
27	32	3	Regular	2	2024-06-12 02:29:43
\.


--
-- TOC entry 4816 (class 0 OID 32769)
-- Dependencies: 219
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."user" (id, email, roles, password, username, userphoto) FROM stdin;
23	test@test.test	[]	$2y$13$9uNugQpramCv6gb.nfl5v.OiAQeX5XSqUCzDAhqiydUB5808Rs8u2	test	userPhotoPre.jpg
25	test@gmail.com	[]	$2y$13$jYRk6SRhQQ0ulHLHgAZ1V.JVSrHgrPw/T6rVZpsPcj1GyFn9QAnBi	Test	luffy-666772b23b34e.jpg
26	angela@gmail.com	[]	$2y$13$wWXmy5NRFBk4wPQrpyA6rePx6cjkcmTTzWruD2vLAzIPy0G0RdfyS	Angela	userPhotoPre.jpg
0	admin@admin.com	["ROLE_ADMIN"]	$2y$13$uGCBBwNUuZhUO3NR8kCQcuBOh8RXyLt68ZpXoM3GLV5Ox1boRkgIS	admin	userPhotoPre.jpg
27	123456@gmail.com	[]	$2y$13$QQ9Vh/avzgY.y2s.t/PtdO1UpigK8IaZu22li.Loiwb5cpMmuRieO	123456	luffy-6667c11648f05.jpg
28	Juan@gmail.com	[]	$2y$13$LKePXtPvKVxZt6ViDVV67uVaIG.yo.OE9qWyOmOn9RnP/lTIa8UQC	Juanito	userPhotoPre.jpg
24	aaa@aa.aa	[]	$2y$13$PAJBSK4HwlRvwQR1IxD8POn716bliKbpK9pATaxzoSD9QOtcAU.p.	aaaaa	userPhotoPre.jpg
32	luis@gmail.com	[]	$2y$13$DU4dMB12H5e.17IEFmETyOBw9tRdsoTDYy9aSyRBoBzVPFHJRGKOi	Luis	luffy-6668ebc1dcf79.jpg
31	ango@gmail.com	["ROLE_USER","ROLE_ADMIN"]	$2y$13$yeUI4i1uE1.K/XX6LhWxuOamFQcdlTRrEpi6/43I.8fbFK3.EYOEK	Ango	userPhotoPre.jpg
\.


--
-- TOC entry 4824 (class 0 OID 0)
-- Dependencies: 216
-- Name: natural_parks_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.natural_parks_id_seq', 14, true);


--
-- TOC entry 4825 (class 0 OID 0)
-- Dependencies: 220
-- Name: review_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.review_id_seq', 27, true);


--
-- TOC entry 4826 (class 0 OID 0)
-- Dependencies: 218
-- Name: user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.user_id_seq', 33, true);


--
-- TOC entry 4661 (class 2606 OID 16404)
-- Name: doctrine_migration_versions doctrine_migration_versions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.doctrine_migration_versions
    ADD CONSTRAINT doctrine_migration_versions_pkey PRIMARY KEY (version);


--
-- TOC entry 4663 (class 2606 OID 16412)
-- Name: natural_parks natural_parks_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.natural_parks
    ADD CONSTRAINT natural_parks_pkey PRIMARY KEY (id);


--
-- TOC entry 4668 (class 2606 OID 32784)
-- Name: review review_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.review
    ADD CONSTRAINT review_pkey PRIMARY KEY (id);


--
-- TOC entry 4666 (class 2606 OID 32775)
-- Name: user user_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);


--
-- TOC entry 4664 (class 1259 OID 32776)
-- Name: uniq_identifier_email; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX uniq_identifier_email ON public."user" USING btree (email);


-- Completed on 2024-06-19 02:48:37

--
-- PostgreSQL database dump complete
--

