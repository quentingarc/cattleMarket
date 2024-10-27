import axios from 'axios';

const instance = axios.create({
    baseURL: 'http://localhost:8000/api/',
    headers: {
        'Content-Type': 'application/json',
    },
});

export const fetchAnimals = () => {
    return instance.get('/animals');
};

export default instance;
