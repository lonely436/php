import axios from 'axios';

const api = axios.create({
    baseURL: '/api',
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
    },
});

export default {
    getAll() {
        return api.get('/enterprise');
    },

    getById(id) {
        return api.get(`/enterprise/${id}`);
    },

    create(data) {
        return api.post('/enterprise', data, {
            headers: {
                'Content-Type': 'multipart/form-data',
            },
        });
    },

    update(id, data) {
        return api.put(`/enterprise/${id}`, data, {
            headers: {
                'Content-Type': 'multipart/form-data',
            },
        });
    },

    delete(id) {
        return api.delete(`/enterprise/${id}`);
    },
};