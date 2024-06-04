import api from "../plugins/axios/index.js";

export const getHr = async () => {
  return await axios.post(`/get_hr`);
};
