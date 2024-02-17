import axios from 'axios';


export const add = () => axios.post('add_vacancy_persona')

export const mainSearch = (page, data) => {

    return api.post(`/api/search?page=${page}`, data)
}
