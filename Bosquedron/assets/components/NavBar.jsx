import React from 'react';
import { Navbar, Nav, NavDropdown, Container } from 'react-bootstrap';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faListCheck, faStar, faGear, faArrowRightFromBracket } from '@fortawesome/free-solid-svg-icons';
import '../styles/navBar.css';

const NavBar = () => {
    return (
        <Navbar expand="lg" className="custom-navbar">
            <Container>
                <Navbar.Brand href="/" className="custom-navbar-brand">
                    <img src="/img/BosquedronLogo0.png" alt="Logo" width={100} /> 
                    <a href="/" className="navbar-title-logo"><span className="navbar-title">BOSQUEDRON</span></a>
                </Navbar.Brand>
                <Navbar.Toggle aria-controls="basic-navbar-nav" />
                <Navbar.Collapse id="basic-navbar-nav">
                    <Nav className="me-auto">
                        <Nav.Link href="/parks" className='nav-link'>Parques Naturales</Nav.Link>
                        <Nav.Link href="/contact" className='nav-link'>Pase de naturaleza</Nav.Link>
                        {/* <Nav.Link href="/about" className='nav-link'>About Us</Nav.Link>
                        <Nav.Link href="/contact" className='nav-link'>Contact</Nav.Link> */}
                        <Nav.Link href="/login" className='nav-link'>Identifícate</Nav.Link>
                        <NavDropdown title="Usuario" id="basic-nav-dropdown">
                            <NavDropdown.Item href="/level"> <FontAwesomeIcon icon={faListCheck}/> Nivel</NavDropdown.Item>
                            <NavDropdown.Item href="/reviews"> <FontAwesomeIcon icon={faStar}/> Mis reseñas</NavDropdown.Item>
                            <NavDropdown.Item href="/settings"> <FontAwesomeIcon icon={faGear}/> Ajustes </NavDropdown.Item>
                            <NavDropdown.Divider />
                            <NavDropdown.Item href="/logout"> <FontAwesomeIcon icon={faArrowRightFromBracket}/> Cerrar Sesión </NavDropdown.Item>
                        </NavDropdown>
                    </Nav>
                </Navbar.Collapse>
            </Container>
        </Navbar>
    );
};

export default NavBar;