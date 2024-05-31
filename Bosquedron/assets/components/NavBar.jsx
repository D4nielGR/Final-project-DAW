import React from 'react';
import Container from 'react-bootstrap/Container';
import Nav from 'react-bootstrap/Nav';
import Navbar from 'react-bootstrap/Navbar';
import NavDropdown from 'react-bootstrap/NavDropdown';
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
                        <Nav.Link href="/about" className='nav-link'>About Us</Nav.Link>
                        <Nav.Link href="/contact" className='nav-link'>Contact</Nav.Link>
                        <Nav.Link href="/login" className='nav-link'>Identifícate</Nav.Link>
                    </Nav>
                </Navbar.Collapse>
            </Container>
        </Navbar>
    );
};

export default NavBar;