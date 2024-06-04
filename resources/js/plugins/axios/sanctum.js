import axios from "axios";

const sanctum = axios.create({
  baseURL: import.meta.env.VITE_API_AUTH_URL,
  headers: {
    Accept: "application/json",
    "Content-Type": "application/json",
  },
  withCredentials: true,
});

export default sanctum;
