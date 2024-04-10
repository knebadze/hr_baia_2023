import axios from 'axios';


// export const add = () => axios.post('add_vacancy_persona')

export const getClassificatory = (url, data) => {
    return axios.post(url, {
        data: data,
    })
}
