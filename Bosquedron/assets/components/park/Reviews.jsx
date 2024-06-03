import React, { useEffect, useState } from 'react';
import '../../styles/park/Reviews.css';

const Reviews = ({ parkId }) => {
    const [reviews, setReviews] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);
    // const [sortOrder, setSortOrder] = useState('date');
    // const [ascending, setAscending] = useState(true);


    const fetchReviews = async () => {
        try {
            const response = await fetch(`http://127.0.0.1:8000/review/${parkId}`);
            if (!response.ok) {throw new Error('Error al obtener los datos de las reviews');}
            const data = await response.json();
            setReviews(data.reviews);
            setLoading(false);
        } catch (error) {
            setError(error.message);
            setLoading(false);
        }
    };


    useEffect(() => {
        fetchReviews();
    }, [parkId]);
     //[parkId, sortOrder, ascending]


    // const toggleSortOrder = () => {
    //     setAscending(!ascending);
    // };

    if (loading) { return <div>Cargando...</div>; }
    if (error) { return <div>Error: {error}</div>; }
    if (reviews.length === 0) { return <div>No hay reviews disponibles.</div>; }

    return (
        <div>
            <div>
                {/* <span>Ordenar por:</span>
                <select onChange={(e) => setSortOrder(e.target.value)} value={sortOrder}>
                    <option value="date">Fecha</option>
                    <option value="valoration">Valoración</option>
                </select>
                <button onClick={toggleSortOrder}>
                    {ascending ? '▲' : '▼'}
                </button> */}
            </div>
            <div>
                {reviews.map(review => (
                    <div key={review.id} className="review-container">
                        {/* Imagen de perfil */}
                        {/* <img src={`uploads/images/fotosPerfil/${review.userPhoto}`} alt="User" width="50" /> */}
                
                        <div className="review-details">
                            {/* ID del usuario */}
                            <p className="user-id">User ID: {review.userId}</p>
                
                            {/* Valoración */}
                            <p className="valoration">Valoración: {review.valoration}</p>
                
                            {/* Texto de la revisión */}
                            <p className="review-text">Texto de la revisión: {review.reviewText}</p>
                
                            {/* Fecha de la revisión */}
                            <p className="review-date">Fecha de la revisión: {new Date(review.reviewDate).toLocaleDateString()}</p>
                        </div>
                
                        <div className="user-info">
                            {/* Nombre de usuario */}
                            <p className="username">Nombre de usuario: {review.username}</p>
                
                            {/* Foto del usuario */}
                            <div className="user-photo">
                                <img src={review.userphoto} alt="User" />
                            </div>
                        </div>
                    </div>
                ))}
            </div>
        </div>
    );
};

export default Reviews;