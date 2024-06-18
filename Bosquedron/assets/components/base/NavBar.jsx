import React, { useEffect, useState } from 'react';
import { Navbar, Nav, NavDropdown, Container } from 'react-bootstrap';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faListCheck, faStar, faGear, faArrowRightFromBracket,faScrewdriverWrench } from '@fortawesome/free-solid-svg-icons';
import '../../styles/base/NavBar.css';
import config from '../ip.js';

const apiUrl = config.apiUrl;

const NavBar = () => {
    const [profile, setProfile] = useState([]);
    const [checkUser, setCheckUser] = useState(false);
    

    useEffect(() => {
        const isProfileCookie = getCookie('profile');
        const isCheckedLogInCookie = getCookie('checkUser');
        setCheckUser(isCheckedLogInCookie === 'true');
        setProfile(JSON.parse(isProfileCookie));
    }, []);
    
    useEffect(() => {
        fetchProfile(); 
        fetchCheckLogIn();
    }, []);
    
    const fetchProfile = async () => {
        const response = await fetch(`${apiUrl}/profile`);
        if (!response.ok) {throw new Error('Error al obtener los datos del perfil');}
        const data = await response.json();
        setProfile(data);
        document.cookie = `profile=${JSON.stringify(data)}; path=/`;
    };

    const fetchCheckLogIn = async () => {
        const response = await fetch(`${apiUrl}/checkLogIn`);
        if (!response.ok) {throw new Error('Error el checkeo del inicio de sesión');}
        const data = await response.text();
        setCheckUser(data === "true");
        document.cookie = `checkUser=${data === 'true'}; path=/`;
    };

    const getCookie = (name) => {
        const cookies = document.cookie.split(';');
        for (let cookie of cookies) {
            const [cookieName, cookieValue] = cookie.split('=');
            if (cookieName.trim() === name) {
                return cookieValue;
            }
        }
        return '';
    };

    return (
        <Navbar expand="lg" className="custom-navbar">
            <Container>
                <Navbar.Brand href="/" className="custom-navbar-brand">
                    <img src="/img/BosquedronLogo0.png" alt="Logo" width={100}/> 
                </Navbar.Brand>
                <Navbar.Toggle aria-controls="basic-navbar-nav" />
                {/* <Nav className="me-auto">
                    <a href="/" className="navbar-title-logo"><span className="navbar-title">BOSQUEDRON</span></a>
                </Nav> */}
                <Navbar.Collapse id="basic-navbar-nav">
                    <Nav className="me-auto">
                        <Nav.Link href="/parks" className='nav-link'>Parques Naturales</Nav.Link>
                        {/* <Nav.Link href="/contact" className='nav-link'>Pase de naturaleza</Nav.Link> */}
                        {checkUser && profile ? (<NavDropdown title={"Hola, " + profile.username} id="basic-nav-dropdown">
                                                    {/* <NavDropdown.Item href="/level"> <FontAwesomeIcon icon={faListCheck}/> Nivel</NavDropdown.Item> */}
                                                    {/* <NavDropdown.Item href="/reviews"> <FontAwesomeIcon icon={faStar}/> Mis reseñas</NavDropdown.Item>
                                                    <NavDropdown.Item href="/settings"> <FontAwesomeIcon icon={faGear}/> Ajustes </NavDropdown.Item>
                                                    <NavDropdown.Divider /> */}
                                                    {profile.roles.includes("ROLE_ADMIN") && (
                                                        <NavDropdown.Item href="/admin"> <FontAwesomeIcon icon={faScrewdriverWrench}/> Panel de control </NavDropdown.Item>
                                                    )}
                                                    <NavDropdown.Item href="/logout"> <FontAwesomeIcon icon={faArrowRightFromBracket}/> Cerrar Sesión </NavDropdown.Item>
                                                </NavDropdown>)

                                                : <Nav.Link href="/login" className='nav-link'>Identifícate</Nav.Link>}
                    </Nav>
                </Navbar.Collapse>
            </Container>
        </Navbar>
    );
};

export default NavBar;