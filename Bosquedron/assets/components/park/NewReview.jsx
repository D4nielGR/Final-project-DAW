import React, { useState } from 'react';

const NewReview = ({ parkId, userId }) => {
    const [showModal, setShowModal] = useState(false);
    const [rating, setRating] = useState(0);
    const [hover, setHover] = useState(0);
    const [textReview, setTextReview] = useState('');
    const [errorMessage, setErrorMessage] = useState('');

    const handleOpenModal = () => { setShowModal(true); };
    const handleCloseModal = () => { 
        setShowModal(false);
        setErrorMessage('');
    };

    const handleSubmit = async (event) => {
        event.preventDefault();

        // VALIDAR REVIEW
        if (rating === 0) {
            setErrorMessage('Por favor, selecciona una puntuación antes de enviar.');
            return;
        }

        // VALIDAR TEXT
        const trimmedTextReview = textReview.trim().replace(/\s+/g, ' '); //Quita espacios en blanco
        const regex = /^[a-zA-Z0-9\s.,?!áéíóúÁÉÍÓÚüÜñÑ]*$/; // Only allow letters, numbers, spaces, and basic punctuation
        if (trimmedTextReview.length > 0 && !regex.test(trimmedTextReview)) {
            setErrorMessage('El texto contiene caracteres inválidos.');
            return;
        }

        // Si las validaciones se realizan correctamente no hay error
        setErrorMessage('');

        const reviewData = { rating, textReview: trimmedTextReview, parkId, userId };

        try {
            const response = await fetch('http://127.0.0.1:8000/api/review/newReview', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', },
                body: JSON.stringify(reviewData),
            });
            
            if (!response.ok) { throw new Error('Algo salió mal'); }
            
            const result = await response.json();
            window.location.replace('');

            // Reset form
            setRating(0);
            setHover(0);
            setTextReview('');
            handleCloseModal();
        } catch (error) {
            console.error('Error al enviar la reseña:', error);
            setErrorMessage('Hubo un problema al enviar tu reseña. Inténtalo de nuevo más tarde.');
        }
    };

    return (
        <div>
            <button className="addReview" onClick={handleOpenModal}>Añadir Reseña</button>

            {showModal && (
                <div className="modal">
                    <div className="modal-content">
                        <span className="close" onClick={handleCloseModal}>&times;</span>
                        <h2>Nueva reseña</h2>
                        <form onSubmit={handleSubmit}>
                            <div className="submitStar-rating">
                                {[...Array(5)].map((star, index) => {
                                    index += 1;
                                    return (
                                        <button
                                            type="button"
                                            key={index}
                                            className={index <= (hover || rating) ? "on" : "off"}
                                            onClick={() => setRating(index)}
                                            onMouseEnter={() => setHover(index)}
                                            onMouseLeave={() => setHover(rating)}
                                        >
                                            <span className="star">&#9733;</span>
                                        </button>
                                    );
                                })}
                            </div>
                            <label htmlFor="textReview"> Dinos sobre tu opinión </label>
                            <textarea name='textReview' value={textReview} onChange={(e) => setTextReview(e.target.value)} />
                            <br />
                            {errorMessage && <p className="error-message">{errorMessage}</p>}
                            <button type="submit">Subir reseña</button>
                        </form>
                    </div>
                </div>
            )}

            <style jsx>{`
                .modal {
                    display: block;
                    position: fixed;
                    z-index: 1;
                    left: 0;
                    top: 0;
                    width: 100%;
                    height: 100%;
                    overflow: auto;
                    background-color: rgba(0, 0, 0, 0.5);
                    padding-top: 60px;
                }
                
                .modal-content {
                    background: linear-gradient(135deg, #fed3b3, #97be4c);
                    margin: 5% auto;
                    padding: 20px;
                    border: 1px solid #67912f;
                    width: 80%;
                    border-radius: 10px;
                    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.5);
                    animation: fadeIn 0.3s ease-in-out;
                }
                
                .close {
                    color: #67912f;
                    float: right;
                    font-size: 28px;
                    font-weight: bold;
                }
                
                .close:hover,
                .close:focus {
                    color: #456423;
                    text-decoration: none;
                    cursor: pointer;
                }
                
                @keyframes fadeIn {
                    from {
                        opacity: 0;
                        transform: scale(0.8);
                    }
                    to {
                        opacity: 1;
                        transform: scale(1);
                    }
                }
                
                .submitStar-rating {
                    display: flex;
                    flex-direction: row;
                    margin-bottom: 20px;
                }
                
                .submitStar-rating button {
                    background: none;
                    border: none;
                    cursor: pointer;
                    padding: 0;
                    font-size: 2rem;
                    color: #ccc;
                    transition: color 0.2s;
                }
                
                .submitStar-rating button.on .star {
                    color: #ffb400;
                }
                
                .submitStar-rating button.off .star:hover {
                    color: #ffb400;
                }

                input[type="text"],
                textarea {
                    width: 100%;

                    padding: 12px 20px;
                    margin: 8px 0;
                    display: inline-block;
                    border: 1px solid #ccc;
                    border-radius: 4px;
                    box-sizing: border-box;
                    transition: border 0.3s, box-shadow 0.3s;
                }
                
                input[type="text"]:focus,
                textarea:focus {
                    border: 1px solid #67912f;
                    box-shadow: 0 0 8px rgba(103, 145, 47, 0.6);
                    outline: none;
                }
                
                textarea {
                    width: 100%;
                    box-sizing: border-box;
                }

                .addReview {
                    background-color: rgb(11, 190, 76, 0.5);
                    border: none;
                    border-radius: 5px;
                }
                
                .addReview:hover {
                    background-color: rgb(103, 145, 47, 0.5);
                    border: 0 solid #67912f;
                    box-shadow: 0 0 8px rgba(103, 145, 47, 0.6);
                    border-radius: 5px;
                }
                
                .error-message {
                    color: red;
                    margin-top: 10px;
                }

                button[type="submit"] {
                    width: 100%;
                    background-color: #97be4c;
                    color: white;
                    padding: 14px 20px;
                    margin: 8px 0;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;
                    transition: background-color 0.3s;
                }
                
                button[type="submit"]:hover {
                    background-color: #67912f;
                }
            `}</style>
        </div>
    );
};

export default NewReview;