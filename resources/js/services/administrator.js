import api from "../plugins/axios/index.js";

export const getAdministrator = async () => {
    return await axios.post(`/get_administrator`);
};

export const fetchUnfinishedRegistrations = async (page) => {
    return await axios.get(`/fetch_unfinished_registration?page=${page}`);
};
