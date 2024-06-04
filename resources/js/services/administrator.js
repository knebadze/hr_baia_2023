import api from "../plugins/axios/index.js";

export const getAdministrator = async () => {
  return await axios.post(`/get_administrator`);
};
